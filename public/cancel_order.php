<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['madh'])) {
    $id_order = $_POST['madh'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "UPDATE donhang SET trangthai = 'Đã hủy' WHERE madh = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_order]);

    echo "<script>
        alert('Đã hủy đơn hàng.');
        window.location.href = 'info_user.php';
    </script>";
}

?>