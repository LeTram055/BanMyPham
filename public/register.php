<?php
include __DIR__ . '/../src/connect.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (strlen($fullname) < 5) {
        $errors['fullname'] = "Họ tên ít nhất 5 kí tự";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ";
    }

    if (strlen($password) < 8) {
        $errors['password'] = "Mật khẩu ít nhất 8 kí tự";
    }

    if ($password_confirm !== $password) {
        $errors['password_confirm'] = "Mật khẩu không khớp";
    }

    $stmt = $pdo->prepare("SELECT * FROM nguoidung WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $errors['eamil'] = "Hãy đăng ký bằng email khác.";
    }

    // Nếu không có lỗi, thêm người dùng mới vào cơ sở dữ liệu
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO nguoidung (email, hoten, sodt, diachi, matKhau) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$email, $fullname, $phone, $address, $hashed_password])) {
            
            echo "<script>
                    alert ('Đăng ký thành công!')
                    window.location.href = 'login.php';
                </script>";

            exit();
        } else {
            $errors[] = "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại sau.";
        }
    }
}

?>

<?php
include_once __DIR__. '/../src/partials/header.php'
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="text-center my-4">ĐĂNG KÝ</h2>
            <form id="registerForm" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                        id="email" name="email"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                        placeholder="Nhập email" required>
                    <?php if (isset($errors['email'])) : ?>
                    <span class="text-danger"><?= $errors['email'] ?></span>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                        id="fullname" name="fullname"
                        value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>"
                        placeholder="Nhập học và tên" required>
                    <?php if (isset($errors['fullname'])) : ?>
                    <span class="text-danger">
                        <strong><?=$errors['fullname'] ?></strong>
                    </span>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="number" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                        id="phone" name="phone"
                        value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>"
                        placeholder="Nhập số điện thoại" required>
                    <?php if (isset($errors['phone'])) : ?>
                    <span class="text-danger">
                        <strong><?=$errors['phone'] ?></strong>
                    </span>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                        id="address" name="address"
                        value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>"
                        placeholder="Nhập địa chỉ" required>
                    <?php if (isset($errors['address'])) : ?>
                    <span class="text-danger">
                        <strong><?=$errors['address'] ?></strong>
                    </span>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control <?= isset($errors['password']) ? ' is-invalid' : '' ?>"
                        id="password" name="password" placeholder="Nhập mật khẩu" required>
                    <?php if (isset($errors['password'])) : ?>
                    <span class="text-danger"><?= $errors['password'] ?></span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password"
                        class="form-control <?= isset($errors['password_confirmation']) ? ' is-invalid' : '' ?>"
                        id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu" required>
                    <?php if (isset($errors['password_confirm'])) : ?>
                    <span class="text-danger"><?= $errors['password_confirm'] ?></span>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
            <div class="text-center my-3">
                <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>.</p>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<?php
include_once __DIR__. '/../src/partials/footer.php'
?>