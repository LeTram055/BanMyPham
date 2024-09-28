<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

// Kiểm tra xem có tham số id_category được truyền qua không
if (isset($_GET['id_category'])) {
    $id_category = $_GET['id_category'];

    // Lấy thông tin loại từ cơ sở dữ liệu để hiển thị trên form
    $sql = "SELECT * FROM loai WHERE maloai = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_category]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name_category = isset($_POST['name_category']) ? $_POST['name_category'] : '';
    

        // Cập nhật thông tin loại trong cơ sở dữ liệu
        $sql_update = "UPDATE loai SET tenloai = ? WHERE maloai = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $result = $stmt_update->execute([$name_category, $id_category]);

        if ($result) {
            // Nếu cập nhật thành công, chuyển hướng về trang quản lý loại
            redirect("manage_category.php");
        } else {
            // Nếu cập nhật không thành công, hiển thị thông báo lỗi
            $error_message = "Cập nhật loại không thành công. Vui lòng kiểm tra lại thông tin.";
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
        <h2 class="text-center">CẬP NHẬT LOẠI</h2>
    </div>
    <div class="row m-3">
        <div class="col">
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="id_category" value="<?= $id_category ?>">

                <!-- mã loại -->
                <div class="form-group m-1">
                    <label for="id_category">Tên loại</label>
                    <input type="text" name="id_category" class="form-control" maxlen="10" id="id_category"
                        placeholder="Nhập tên loại" value="<?= html_escape($id_category) ?>" readonly />
                </div>

                <!-- Tên loại -->
                <div class="form-group m-1">
                    <label for="name_category">Tên loại</label>
                    <input type="text" name="name_category" class="form-control" maxlen="50" id="name_category"
                        placeholder="Nhập tên loại" value="<?= html_escape($category['tenloai']) ?>" required />
                </div>


                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Cập nhật</button>
            </form>
        </div>

    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>