<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

// Kiểm tra xem có tham số id_product được truyền qua không
if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu để hiển thị trên form
    $sql = "SELECT * FROM sanpham WHERE masp = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_product]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name_product = isset($_POST['name_product']) ? $_POST['name_product'] : '';
        $dcr_product = isset($_POST['dcr_product']) ? $_POST['dcr_product'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';
    
        $img = $product['hinhsp'];
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $img_name = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            $img_folder = 'images/products/';
            $img_path = $img_folder . $img_name;

            // Di chuyển hình ảnh vào thư mục lưu trữ
            if (move_uploaded_file($img_tmp, $img_path)) {
                $img = $img_path; // Gắn đường dẫn hình ảnh vào biến
            } else {
                $error_message = "Không thể tải lên hình sản phẩm.";
            }
        }

        // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
        $sql_update = "UPDATE sanpham SET tensp = ?, motasp = ?, gia = ?, hinhsp = ?, maloai = ? WHERE masp = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $result = $stmt_update->execute([$name_product, $dcr_product, $price, $img, $category, $id_product]);

        if ($result) {
            // Nếu cập nhật thành công, chuyển hướng về trang quản lý sản phẩm
            redirect("manage_product.php");
        } else {
            // Nếu cập nhật không thành công, hiển thị thông báo lỗi
            $error_message = "Cập nhật sản phẩm không thành công. Vui lòng kiểm tra lại thông tin.";
        }
    }
}
if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}

include_once __DIR__ . '/../src/partials/header_admin.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">CẬP NHẬT SẢN PHẨM</h2>
    </div>
    <div class="row m-3">
        <div class="col">
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="id_product" value="<?= $id_product ?>">

                <!-- mã sản phẩm -->
                <div class="form-group m-1">
                    <label for="id_product">Tên loại</label>
                    <input type="text" name="id_product" class="form-control" maxlen="10" id="id_product"
                        placeholder="Nhập tên loại" value="<?= html_escape($id_product) ?>" readonly />
                </div>

                <!-- Tên sản phẩm -->
                <div class="form-group m-1">
                    <label for="name_product">Tên sản phẩm</label>
                    <input type="text" name="name_product" class="form-control" maxlen="50" id="name_product"
                        placeholder="Nhập tên sản phẩm" value="<?= html_escape($product['tensp']) ?>" required>
                </div>

                <!-- Mô tả -->
                <div class="form-group m-1">
                    <label for="dcr_product">Mô tả </label>
                    <textarea type="text" name="dcr_product" class="form-control" id="dcr_product" rows="5"
                        placeholder="Nhập mô tả"><?= html_escape($product['motasp']) ?></textarea>

                </div>

                <!-- Giá -->
                <div class="form-group m-1">
                    <label for="price">Giá </label>
                    <input type="number" name="price" class="form-control" maxlen="50" id="price" placeholder="Nhập giá"
                        value="<?= html_escape($product['gia']) ?>" required />
                </div>

                <!-- Hình sản phẩm -->
                <div class="form-group m-1">
                    <label for="img">Hình sản phẩm</label>
                    <!-- Hiển thị hình ảnh nếu đường dẫn hợp lệ -->
                    <?php if (!empty($product['hinhsp']) && file_exists($product['hinhsp'])) : ?>
                    <img src="<?= $product['hinhsp'] ?>" id="product-preview" alt="product" width="40px" height="40px">
                    <?php endif; ?>
                    <!-- Input cho việc tải lên hình ảnh mới -->
                    <input type="file" name="img" id="img" class="form-control-file" id="img">
                </div>



                <!-- Tên loại -->
                <div class="form-group m-1">
                    <label for="category">Tên loại</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">Chọn tên loại</option>
                        <?php
                        // Truy vấn SQL để lấy danh sách các loại sản phẩm
                        $sql_categories = "SELECT maloai, tenloai FROM loai";
                        $stmt_categories = $pdo->prepare($sql_categories);
                        $stmt_categories->execute();
                        while ($row_category = $stmt_categories->fetch(PDO::FETCH_ASSOC)) {
                            // Hiển thị tên loại trong dropdown list
                            echo "<option value='" . $row_category['maloai'] . "'";
                            if ($row_category['maloai'] == $product['maloai']) {
                                echo " selected"; // Chọn mặc định loại sản phẩm của sản phẩm đang cập nhật
                            }
                            echo ">" . $row_category['tenloai'] . "</option>";
                        }
                        ?>
                    </select>
                </div>


                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Cập nhật</button>
            </form>
        </div>

    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>