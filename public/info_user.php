<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

$email = $_SESSION['user']['email'];

// Lấy thông tin khách hàng từ cơ sở dữ liệu
$sql = "SELECT * FROM nguoidung WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy các đơn hàng của khách hàng từ cơ sở dữ liệu
$sql_orders = "SELECT * FROM donhang WHERE email = ?";
$stmt_orders = $pdo->prepare($sql_orders);
$stmt_orders->execute([$email]);
$orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

include_once __DIR__ . '/../src/partials/header.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">THÔNG TIN NGƯỜI DÙNG</h2>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <table class="table table-success table-striped border">
                <tbody>

                    <tr>
                        <th scope="row">Họ và tên:</th>
                        <td><?= $user_info['hoten'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td><?= $user_info['email'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Số điện thoại:</th>
                        <td><?= $user_info['sodt'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Địa chỉ:</th>
                        <td><?= $user_info['diachi'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center m-5">
        <h3 class="text-center">Các đơn hàng của bạn</h3>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th class="align-content-start" scope="col">Mã đơn hàng</th>
                            <th class="align-content-start" scope="col">Tên người nhận</th>
                            <th class="align-content-start" scope="col">Địa chỉ nhận hàng</th>
                            <th class="align-content-start" scope="col">Email</th>
                            <th class="align-content-start" scope="col">Số điện thoại</th>
                            <th class="align-content-start" scope="col">Tổng tiền</th>
                            <th class="align-content-start" scope="col">Hình thức thanh toán</th>
                            <th class="align-content-start" scope="col">Trạng thái</th>
                            <th class="align-content-start" scope="col">Ngày đặt</th>
                            <th class="align-content-start" scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td class="text-center">
                                <a href="detail_order.php?id_order=<?= html_escape($order['madh']) ?>"
                                    style="text-decoration: none;"><?= $order['madh'] ?></a>
                            </td>
                            <td><?= html_escape($order['hoten'])?></td>
                            <td><?= html_escape($order['diachi']) ?></td>
                            <td><?= html_escape($order['email']) ?></td>
                            <td><?= html_escape($order['sodt']) ?></td>
                            <td class="text-end"><?= html_escape(number_format($order['tongtien'])) ?>đ</td>
                            <td><?= html_escape($order['htttoan']) ?></td>
                            <td><?= html_escape($order['trangthai']) ?></td>
                            <td><?= html_escape($order['ngaydat']) ?></td>
                            <td>
                                <form class="form-inline m-1" action="/cancel_order.php" method="POST">
                                    <input type="hidden" name="madh" value="<?= $order['madh'] ?>">

                                    <?php if ($order['trangthai'] != 'Đã hủy') : ?>
                                    <button type="button" class="btn btn-xs btn-danger cancel-order-btn"
                                        data-toggle="modal" name="cancel-order" data-target="#cancel-confirm">
                                        Hủy
                                    </button>
                                    <?php else : ?>
                                    <button type="button" class="btn btn-xs btn-danger" disabled>Hủy</button>
                                    <!-- Vô hiệu hóa nút "Hủy" nếu đơn hàng đã hủy -->
                                    <?php endif; ?>

                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="cancel-confirm" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Xác nhận</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="cancel" data-bs-dismiss="modal">Đồng
                                ý</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>