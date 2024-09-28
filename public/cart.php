<?php
session_start();
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

//Xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id_product'])) {
    $id_product_to_remove = $_GET['id_product'];
    unset($_SESSION['cart'][$id_product_to_remove]);
    redirect('cart.php');
    exit();
}

// Thay đổi số lượng sản phẩm
if (isset($_POST['id_product']) && isset($_POST['new_quantity'])) {
    $id_product = $_POST['id_product'];
    $new_quantity = $_POST['new_quantity'];

    $_SESSION['cart'][$id_product]['quantity'] = $new_quantity;
}


//Đặt hàng
if (isset($_POST['btn_agree_order_cart'])) {
    // Kiểm tra nếu khách hàng chưa đăng nhập thì chuyển hướng đến trang đăng nhập
    if (!isset($_SESSION['user']['email'])) {
        echo "<script>
            alert('Hãy đăng nhập để tiếp tục.');
            window.location.href = 'login.php';
        </script>";
    }else{

        // Lấy thông tin khách hàng từ form
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address_order = $_POST['address_order'];
        $note = $_POST['note'];
        $payments = $_POST['payments'];
        $total_cart_value = $_POST['total_cart_value'];

        // Kết nối đến database và thực hiện thêm dữ liệu đơn hàng và chi tiết đơn hàng
        try {
            $sql = "INSERT INTO donhang (email, hoten, sodt, diachi, ghichu, htttoan, ngaydat, tongtien) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$_SESSION['user']['email'], $fullname, $phone, $address_order, $note, $payments, $total_cart_value])) {
                $order_id = $pdo->lastInsertId();  // Lấy ID của đơn hàng vừa chèn

                // Thêm chi tiết đơn hàng vào bảng order_details
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $id_product => $product) {
                        $sql = "INSERT INTO chitiet_dh (madh, masp, soluong, ttien) VALUES (?, ?, ?, ?)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$order_id, $id_product, $product['quantity'], $product['price']*$product['quantity']]);
                    }

                    // Xóa giỏ hàng sau khi đặt hàng thành công
                    unset($_SESSION['cart']);
                    $total_cart_value = 0;
                    // Hiển thị thông báo thành công
                    echo "<script>
                        alert('Đặt hàng thành công.');
                        window.location.href = 'info_user.php';
                    </script>";
                }else{
                    echo "<script>
                    alert('Không có sản phẩm trong giỏ hàng.');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Lỗi: Không thể thêm đơn hàng.');
                    window.location.href = 'cart.php';
                </script>";
                
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}


include_once __DIR__. '/../src/partials/header.php'
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">GIỎ HÀNG</h2>
    </div>

    <div class="row">
        <div class="table-cart">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="text-center tbody-cart">
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $total_cart_value = 0;
                        foreach ($_SESSION['cart'] as $id_product => $product) :
                            $total_cart_value += $product['quantity'] * $product['price']; ?>

                        <tr>
                            <td><img src="<?= $product['img'] ?>" alt="<?= $product['name_product'] ?>">
                            </td>
                            <td class="align-content-center"><?= html_escape($product['name_product']) ?></td>
                            <td class="align-content-center"><?= number_format($product['price']) ?>đ</td>
                            <td class="align-content-center">
                                <div class="d-flex justify-content-center">
                                    <input type="number" name="quantity[<?= $id_product ?>]"
                                        value="<?= $product['quantity'] ?>" min="1" class="form-control"
                                        aria-label="Số lượng" style="max-width: 70px;">
                                </div>
                            </td>
                            <td class="align-content-center">
                                <?= number_format($product['price'] * $product['quantity']) ?>đ
                            </td>
                            <td class="align-content-center"><a href="?action=remove&id_product=<?= $id_product ?>"
                                    class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach; }?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2">
                                <h4 class="text-right">Tổng đơn hàng: </h4>
                            </td>
                            <td>
                                <h4><?php if (isset($total_cart_value)) {echo number_format($total_cart_value, 0, ",", ".") . "đ";}?>
                                </h4>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="row m-5">
        <h3 class="mb-5 text-center">Thông tin thanh toán</h3>
        <div class="col-6 offset-3">
            <form id="form_info_customer_cart" class="col" method="post">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên:</label>
                    <input type="text" name="fullname" class="form-control" id="fullname"
                        value="<?= isset($_SESSION['user']['fullname']) ? html_escape($_SESSION['user']['fullname']) : "";?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                        value="<?= isset($_SESSION['user']['email']) ? html_escape($_SESSION['user']['email']) : "";?>"
                        maxlength="254" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="number" name="phone" class="form-control" id="phone"
                        value="<?= isset($_SESSION['user']['phone']) ? html_escape($_SESSION['user']['phone']) : "";?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="address_order" class="form-label">Địa chỉ nhận hàng:</label>
                    <input type="text" name="address_order" class="form-control" id="address_order"
                        value="<?= isset($_SESSION['user']['address']) ? html_escape($_SESSION['user']['address']) : "";?>"
                        maxlength="300" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Ghi chú:</label>
                    <textarea class="form-control" name="note" id="note" rows="3" maxlength="300"></textarea>
                </div>
                <div class="mb-3">
                    <label for="payments" class="form-label">Hình thức thanh toán:</label>
                    <input type="text" id="payments" class="form-control border-0" name="payments"
                        value="Thanh toán khi nhận hàng (COD)" readonly>
                </div>
                <input type="hidden" name="total_cart_value" value="<?php echo $total_cart_value; ?>">
                <button type="submit" class="btn btn-primary" id="btn_agree_order_cart" name="btn_agree_order_cart">
                    Đồng ý đặt hàng</button>
                <button class="btn btn-success"><a class="link" href="index.php">
                        Tiếp tục mua hàng</a>
                </button>
            </form>

        </div>

    </div>
</div>
<?php include_once __DIR__. '/../src/partials/footer.php' ?>