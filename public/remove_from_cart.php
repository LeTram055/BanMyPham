<?php
session_start();

if (isset($_GET['id_product'])) {
    $id_product_to_remove = $_GET['id_product'];

    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (isset($_SESSION['cart'][$id_product_to_remove])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$id_product_to_remove]);
    }
}

// Chuyển hướng trở lại trang giỏ hàng sau khi xóa sản phẩm
redirect('cart.php');
exit();
?>