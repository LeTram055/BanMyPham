<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    }
    echo "<script>
            alert('Bạn đã đăng xuất.');
            window.location.href = 'index.php';
        </script>";
    exit();
}
?>