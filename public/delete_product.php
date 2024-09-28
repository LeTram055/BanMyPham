<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'])) {
    $id_product = $_POST['id_product'];

    // Truy vấn để kiểm tra xem có đơn hàng nào không phải là đã hủy tham chiếu đến sản phẩm không
    $sql_check_order = "SELECT COUNT(*) FROM chitiet_dh JOIN donhang ON chitiet_dh.madh = donhang.madh 
                        WHERE chitiet_dh.masp = ? AND donhang.trangthai != 'Đã hủy'";
    $stmt_check_order = $pdo->prepare($sql_check_order);
    $stmt_check_order->execute([$id_product]);
    $order_count = $stmt_check_order->fetchColumn();

    // Nếu có đơn hàng không phải đã hủy tham chiếu đến sản phẩm, hiển thị thông báo và dừng quá trình xóa
    if ($order_count > 0) {
        echo "<script>
                alert('Không thể xóa vì đang có đơn hàng liên quan đến sản phẩm.');
                window.location.href = 'manage_product.php';
            </script>";
        exit(); 
    }

    // Truy vấn để lấy đường dẫn của hình ảnh sản phẩm cần xóa
    $sql_get_image_path = "SELECT hinhsp FROM sanpham WHERE masp = ?";
    $stmt_get_image_path = $pdo->prepare($sql_get_image_path);
    $stmt_get_image_path->execute([$id_product]);
    $image_path = $stmt_get_image_path->fetchColumn();
    
    // Xóa các dòng trong bảng chitiet_dh tham chiếu đến sản phẩm cần xóa
    $sql_delete_chitiet = "DELETE FROM chitiet_dh WHERE masp = ?";
    $stmt_delete_chitiet = $pdo->prepare($sql_delete_chitiet);
    $stmt_delete_chitiet->execute([$id_product]);

    // Xóa hình ảnh sản phẩm từ thư mục
    if ($image_path && file_exists($image_path)) {
        unlink($image_path);
    }

    // xóa sản phẩm
    $sql = "DELETE FROM sanpham WHERE masp = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_product]);

    redirect("manage_product.php");
    
}

?>