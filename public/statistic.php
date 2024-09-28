<?php
require_once __DIR__ . '/../src/connect.php';

$total_product = 0;
$total_category = 0;
$total_order = 0;
$total_order_cancel = 0;

//sanpham
$sql = "SELECT COUNT(*) FROM sanpham";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_product = $stmt->fetchColumn();

//loai
$sql = "SELECT COUNT(*) FROM loai";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_category = $stmt->fetchColumn();

//don hang
$sql = "SELECT COUNT(*) FROM donhang";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_order = $stmt->fetchColumn();

//don hang da huy
$sql = "SELECT COUNT(*) FROM donhang WHERE trangthai = 'Đã hủy'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_order_cancel = $stmt->fetchColumn();


include_once __DIR__. '/../src/partials/header_admin.php'
?>
<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">THỐNG KÊ</h2>
    </div>
    <div class="row mb-3">
        <div class="col-md-3 col-6  mb-3">
            <div class="bg-danger text-white text-center p-3">
                <p class="fs-2"><i class="fa-brands fa-product-hunt"></i></i></p>
                <p class="fs-4">SỐ SẢN PHẨM</p>
                <p class="fs-1"><?php echo html_escape($total_product); ?></p>
            </div>

        </div>

        <div class="col-md-3 col-6  mb-3">
            <div class="bg-danger-subtle text-center p-3">
                <p class="fs-2"><i class="fa-solid fa-layer-group"></i></p>
                <p class="fs-4">SỐ LOẠI</p>
                <p class="fs-1"><?php echo html_escape($total_category); ?></p>
            </div>

        </div>

        <div class="col-md-3 col-6  mb-3">
            <div class="bg-warning text-white text-center  p-3">
                <p class="fs-2"><i class="fa-solid fa-list"></i></i></p>
                <p class="fs-4">SỐ ĐƠN HÀNG</p>
                <p class="fs-1"><?php echo html_escape($total_order); ?></p>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-3">
            <div class="bg-warning-subtle text-center p-3">
                <p class="fs-2"><i class="fa-solid fa-ban"></i></i></p>
                <p class="fs-4">ĐƠN HÀNG BỊ HỦY</p>
                <p class="fs-1"><?php echo html_escape($total_order_cancel); ?></p>
            </div>
        </div>

    </div>

</div>

</div>


<?php
include_once __DIR__. '/../src/partials/footer.php'
?>