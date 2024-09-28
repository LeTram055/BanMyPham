<?php
session_start();
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập header
    $header = ['Mã đơn hàng', 'Họ tên người nhận', 'Email', 'Số điện thoại', 'Địa chỉ nhận hàng', 'Ghi chú', 'Hình thức thanh toán', 'Ngày đặt', 'Tổng tiền', 'Trạng thái'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="sanpham.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}

$sql = "SELECT * FROM donhang";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
  // Xuất file Excel
  exportToExcel($rows);
}

include_once __DIR__ . '/../src/partials/header_admin.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">QUẢN LÝ ĐƠN HÀNG</h2>
    </div>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <form method="post">
                <button class="btn btn-success" type="submit" name="export">
                    Xuất Excel
                </button>
            </form>
        </div>
    </div>

    <div class="row my-3">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="align-content-start">Mã đơn hàng</th>
                            <th class="align-content-start">Họ tên người nhận</th>
                            <th class="align-content-start">Email</th>
                            <th class="align-content-start">Số điện thoại</th>
                            <th class="align-content-start">Địa chỉ nhận hàng</th>
                            <th class="align-content-start">Ghi chú</th>
                            <th class="align-content-start">Hình thức thanh toán</th>
                            <th class="align-content-start">Ngày đặt</th>
                            <th class="align-content-start">Tổng tiền</th>
                            <th class="align-content-start">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>

                        <tr>
                            <td class="text-center">
                                <a href="detail_order.php?id_order=<?= html_escape($row['madh']) ?>"
                                    style="text-decoration: none;"><?= $row['madh'] ?></a>
                            </td>
                            <td><?= html_escape($row['hoten']) ?></td>
                            <td><?= html_escape($row['email']) ?></td>
                            <td><?= html_escape($row['sodt']) ?></td>
                            <td><?= html_escape($row['diachi']) ?></td>
                            <td><?= html_escape($row['ghichu']) ?></td>
                            <td><?= html_escape($row['htttoan']) ?></td>
                            <td><?= html_escape($row['ngaydat']) ?></td>
                            <td class="text-end"><?= html_escape(number_format($row['tongtien'])) ?>đ</td>
                            <td><?= html_escape($row['trangthai']) ?></td>
                        </tr>


                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div id="delete-confirm" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Xác nhận</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>