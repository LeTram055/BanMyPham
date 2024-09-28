<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['user']["email"])){
        $email = $_SESSION['user']["email"];
        $sql = "SELECT * FROM nguoidung WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION['user']['fullname'] = $row['hoten'];
        $_SESSION['user']['phone'] = $row['sodt'];
        $_SESSION['user']['address'] = $row['diachi'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mỹ phẩm T&N</title>
    <link href="images/cosmetic.png" rel="shortcut icon" type="image" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="container-fluid header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="manage_product.php"><img id="logo" src="images/logo.png" height="70px" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="manage_product.php">Quản lý sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="manage_category.php">Quản lý loại hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="manage_order.php">Quản lý đơn hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="statistic.php">Thống kê</a>
                        </li>
                    </ul>

                    <div class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false"><i class="fa-solid fa-user"></i></a>
                        <?php if(isset($_SESSION['user']['email'])): ?>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                        </ul>

                        <?php else: ?>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                        </ul>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </nav>
    </div>