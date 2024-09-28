<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

// Lấy mã đơn hàng từ tham số trên URL
if(isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];

    // Truy vấn chi tiết đơn hàng từ cơ sở dữ liệu
    $sql = "SELECT sp.tensp, sp.gia, ct.soluong, ct.ttien FROM chitiet_dh ct
            JOIN sanpham sp ON sp.masp = ct.masp
            WHERE ct.madh = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id_order]);
    $order_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') {
    include_once __DIR__ . '/../src/partials/header_admin.php';
} else{
    include_once __DIR__ . '/../src/partials/header.php';
}
?>

<!-- Hiển thị thông tin chi tiết đơn hàng -->
<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">CHI TIẾT ĐƠN HÀNG #<?= $id_order ?></h2>
    </div>

    <!-- Hiển thị chi tiết sản phẩm trong đơn hàng -->
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_detail as $product) : ?>
                        <tr>
                            <td><?= html_escape($product['tensp']) ?></td>
                            <td><?= number_format($product['gia']) ?>đ</td>
                            <td><?= html_escape($product['soluong']) ?></td>
                            <td><?= number_format($product['ttien']) ?>đ</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>