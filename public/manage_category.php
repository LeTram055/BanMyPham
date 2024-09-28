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
    $header = ['Mã loại', 'Tên loại'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="loaisanpham.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}

$sql = "SELECT * FROM loai";
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
        <h2 class="text-center">QUẢN LÝ LOẠI HÀNG</h2>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <a href="/add_category.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <form method="post">
                <button class="btn btn-success" type="submit" name="export">
                    Xuất Excel
                </button>
            </form>
        </div>
    </div>

    <div class="row my-3">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="align-content-start">Mã loại</th>
                        <th class="align-content-start">Tên loại</th>
                        <th class="text-center align-content-start">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['maloai']) ?></td>
                        <td><?= html_escape($row['tenloai']) ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="<?= 'edit_category.php?id_category=' . $row['maloai'] ?>"
                                    class="btn btn-xs btn-warning m-1">
                                    Sửa</a>

                                <form class="form-inline m-1" action="/delete_category.php" method="POST">
                                    <input type="hidden" name="id_category" value="<?= $row['maloai'] ?>">
                                    <button id="delete-category-btn" type="button"
                                        class="btn btn-xs btn-danger  delete-btn" data-toggle="modal"
                                        name="delete-category" data-target="#delete-confirm">
                                        Xóa
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>


                    <?php endforeach ?>
                </tbody>
            </table>

            <div id="delete-confirm" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Xác nhận</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-danger"
                                id="delete">Xóa</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>