<?php
require_once __DIR__ . '/../src/connect.php';

$category = $_GET['tenloai'] ??'';
$sort = $_GET['sort'] ??'';

if(isset($sort) && $sort=='asc'){

$sql = "SELECT masp, tensp, gia, hinhsp 
        FROM sanpham
        WHERE maloai = (SELECT maloai FROM loai WHERE tenloai = ?)
        ORDER BY gia ASC";

} else if(isset($sort) && $sort== "desc"){
$sql = "SELECT masp, tensp, gia, hinhsp 
        FROM sanpham
        WHERE maloai = (SELECT maloai FROM loai WHERE tenloai = ?)
        ORDER BY gia DESC";


}else{
$sql = "SELECT masp, tensp, gia, hinhsp 
        FROM sanpham
        WHERE maloai = (SELECT maloai FROM loai WHERE tenloai = ?)";

}
$stmt = $pdo->prepare($sql);
$stmt->execute([$category]);
$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);

include_once __DIR__. '/../src/partials/header.php';
?>

<div class="container">
    <div class="row m-5">
        <h2 class="text-center mb-5"><?= mb_strtoupper($category) ?></h2>
        <div class="row">
            <div class="dropdown">
                <a class="btn btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sắp xếp
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="product.php?tenloai=<?= urlencode($category) ?>&sort=asc">Giá
                            tăng dần</a>
                    </li>
                    <li><a class="dropdown-item" href="product.php?tenloai=<?= urlencode($category) ?>&sort=desc">Giá
                            giảm dần</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php foreach ($rows as $row) : ?>
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="detail_product.php?masp=<?= $row['masp'] ?>" class="product-link">
                    <div class="product-item">
                        <img src="<?= $row['hinhsp'] ?>" alt="<?= html_escape($row['tensp']) ?>">
                        <h5><?= html_escape($row['tensp']) ?></h5>
                        <p>Giá: <?= number_format($row['gia']) ?>đ</p>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
include_once __DIR__. '/../src/partials/footer.php'
?>