<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_product = isset($_POST['id_product']) ? $_POST['id_product'] : '';
    $name_product = isset($_POST['name_product']) ? $_POST['name_product'] : '';
    $dcr_product = isset($_POST['dcr_product']) ? $_POST['dcr_product'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    $img = '';
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

    $sql_check = "SELECT COUNT(*) AS count FROM sanpham WHERE masp = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$id_product]);
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
    if ($row['count'] > 0) {
        $error_message = "Mã sản phẩm đã tồn tại. Vui lòng chọn mã sản phẩm khác.";
    } else {
        // Thực hiện chèn sản phẩm vào cơ sở dữ liệu
        $sql = "INSERT INTO sanpham (masp, tensp, motasp, gia, hinhsp, maloai) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$id_product, $name_product, $dcr_product, $price, $img, $category]);

        // Kiểm tra kết quả cập nhật
        if ($result) {
            // Thêm sản phẩm thành công
            redirect("manage_product.php");
        } else {
            // Thêm sản phẩm không thành công
            $error_message = "Thêm sản phẩm không thành công. Vui lòng kiểm tra lại thông tin.";
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
        <h2 class="text-center">THÊM SẢN PHẨM</h2>
    </div>
    <div class="row m-3">
        <div class="col">
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="id_product" value="<?= $id_product ?>">

                <!-- Mã sản phẩm -->
                <div class="form-group m-1">
                    <label for="id_product">Mã sản phẩm</label>
                    <input type="text" name="id_product" class="form-control" maxlen="10" id="id_product"
                        placeholder="Nhập mã sản phẩm"
                        value="<?= isset($_POST['id_prodect']) ? html_escape($_POST['id_product']) : '' ?>" required />


                </div>

                <!-- Tên sản phẩm -->
                <div class="form-group m-1">
                    <label for="name_product">Tên sản phẩm</label>
                    <input type="text" name="name_product" class="form-control" maxlen="50" id="name_product"
                        placeholder="Nhập tên sản phẩm"
                        value="<?= isset($_POST['name_product']) ? html_escape($_POST['name_product']) : '' ?>"
                        required />


                </div>

                <!-- Mô tả -->
                <div class="form-group m-1">
                    <label for="dcr_product">Mô tả </label>
                    <textarea type="text" name="dcr_product" class="form-control" rows="5" id="dcr_product"
                        placeholder="Nhập mô tả"></textarea>


                </div>

                <!-- Giá -->
                <div class="form-group m-1">
                    <label for="price">Giá </label>
                    <input type="number" name="price" class="form-control" maxlen="50" id="price" placeholder="Nhập giá"
                        value="<?= isset($_POST['price']) ? html_escape($_POST['price']) : '' ?>" required />


                </div>

                <!-- Hình sản phẩm -->
                <div class="form-group m-1">
                    <label for="img">Hình sản phẩm </label>
                    <img id="product-preview" style="display: none;" alt="product" width="40px" height="40px">
                    <input type="file" name="img" id="img" class="form-control-file" maxlen="50" id="img" />


                </div>

                <!-- Tên loại -->
                <div class="form-group m-1">
                    <label for="category">Tên loại</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">Chọn mã loại</option>
                        <?php
                        $sql_categories = "SELECT maloai, tenloai FROM loai";
                        $stmt_categories = $pdo->prepare($sql_categories);
                        $stmt_categories->execute();
                        while ($row_category = $stmt_categories->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row_category['maloai'] . "'>" . $row_category['tenloai'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Thêm</button>
            </form>
        </div>

    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>