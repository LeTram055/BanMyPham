<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_category'])) {
    $id_category = $_POST['id_category'];

    $sql_check = "SELECT COUNT(*) FROM sanpham
                        WHERE maloai = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$id_category]);
    $order_count = $stmt_check->fetchColumn();

    // Nếu có đơn hàng không phải đã hủy tham chiếu đến sản phẩm, hiển thị thông báo và dừng quá trình xóa
    if ($order_count > 0) {
        echo "<script>
                alert('Không thể xóa vì loại hàng này đang có sản phẩm tham chiếu.');
                window.location.href = 'manage_category.php';
            </script>";
        exit(); 
    }

    // xóa loại
    $sql = "DELETE FROM loai WHERE maloai = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_category]);

    redirect("manage_category.php");
    
}

?>