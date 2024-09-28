<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once __DIR__ . '/../src/connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['masp'])) {
    $id_product = $_GET['masp'];
    $sql = "SELECT tensp, motasp, gia, hinhsp 
            FROM sanpham
            WHERE masp = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_product]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


if (isset($_POST['btn_add_to_cart'])) {
        if (isset($_POST['quantity'])) {
            $number_product = $_POST['quantity'];
            $id_product = isset($_POST['id_product']) ? $_POST['id_product'] : '';


            if (isset($_SESSION['cart'][$id_product])) {
                $_SESSION['cart'][$id_product]['quantity'] += $number_product;
                echo '<script>alert("Sản phẩm đã được thêm vào giỏ hàng trước đó!")</script>';
            } else {

                //Lưu vào session
                $_SESSION['cart'][$id_product]['quantity'] = $number_product;
                $_SESSION['cart'][$id_product]['img'] = $row['hinhsp'];
                $_SESSION['cart'][$id_product]['name_product'] = $row['tensp'];
                $_SESSION['cart'][$id_product]['price'] = $row['gia'];
                echo '<script>alert("Sản phẩm đã được thêm vào giỏ hàng!")</script>';
            }
        }
    }
include_once __DIR__. '/../src/partials/header.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center mb-5">CHI TIẾT SẢN PHẨM</h2>
        <div class="col-md-5 col-sm d-flex justify-content-center align-items-center">
            <img src="<?= $row['hinhsp'] ?>" alt="<?= html_escape($row['tensp']) ?>">
        </div>
        <div class="col-md-7 col-sm">
            <h4><?= html_escape($row['tensp']) ?></h4>
            <p class="price"><?= number_format($row['gia']) ?>đ</p>
            <p style="text-align: justify;"><?= html_escape($row['motasp']) ?></p>
            <form id="form_add_into_cart" method="post" class="row mt-5">
                <div class="add-to-cart">
                    <label for="quantity" style="font-weight: 600;">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" min="1"
                        value="<?= isset($_POST['quantity']) ? $_POST['quantity'] : '1' ?>" style="max-width: 70px;">

                    <br>
                    <?php if (isset($id_product)): ?>
                    <input type="hidden" name="id_product" value="<?php echo $id_product; ?>">
                    <?php endif;?>
                    <!-- Nút thêm vào giỏ hàng -->
                    <button type="submit" class="btn btn-success mt-3" id="btn-add-to-cart" name="btn_add_to_cart">Thêm
                        vào giỏ hàng</button>
                </div>
            </form>
        </div>

    </div>

</div>

<?php
include_once __DIR__. '/../src/partials/footer.php'
?>