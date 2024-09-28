<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
    $name_category = isset($_POST['name_category']) ? $_POST['name_category'] : '';

    $sql_check = "SELECT COUNT(*) AS count FROM loai WHERE maloai = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$id_category]);
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
    if ($row['count'] > 0) {
        $error_message = "Mã loại đã tồn tại. Vui lòng chọn mã loại khác.";
    } else {
        // Thực hiện chèn loại vào cơ sở dữ liệu
        $sql = "INSERT INTO loai (maloai, tenloai) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$id_category, $name_category]);

        // Kiểm tra kết quả cập nhật
        if ($result) {
            // Thêm loại thành công
            redirect("manage_category.php");
        } else {
            // Thêm loại không thành công
            $error_message = "Thêm loại không thành công. Vui lòng kiểm tra lại thông tin.";
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
        <h2 class="text-center">THÊM LOẠI</h2>
    </div>
    <div class="row m-3">
        <div class="col">
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="id_category" value="<?= $id_category ?>">

                <!-- Mã loại -->
                <div class="form-group m-1">
                    <label for="id_category">Mã loại</label>
                    <input type="text" name="id_category" class="form-control" maxlen="10" id="id_category"
                        placeholder="Nhập mã loại"
                        value="<?= isset($_POST['id_prodect']) ? html_escape($_POST['id_category']) : '' ?>" required />
                </div>

                <!-- Tên loại -->
                <div class="form-group m-1">
                    <label for="name_category">Tên loại</label>
                    <input type="text" name="name_category" class="form-control" maxlen="50" id="name_category"
                        placeholder="Nhập tên loại"
                        value="<?= isset($_POST['name_category']) ? html_escape($_POST['name_category']) : '' ?>"
                        required />
                </div>

                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Thêm</button>
            </form>
        </div>

    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>