<?php
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

// Mảng chứa các loại sản phẩm
$categories = ["Sửa rửa mặt", "Tẩy trang", "Kem chống nắng", "Tẩy tế bào chết"];

include_once __DIR__. '/../src/partials/header.php'
?>

<div class="container">
    <div class="row">

        <div class="col">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/banner1.jpg" class="d-block w-100 h-50" alt="banner1">
                    </div>
                    <div class="carousel-item">
                        <img src="images/banner2.jpg" class="d-block w-100 h-50" alt="banner2">
                    </div>
                    <div class="carousel-item">
                        <img src="images/banner3.jpg" class="d-block w-100 h-50" alt="banner3">
                    </div>
                    <div class="carousel-item">
                        <img src="images/banner4.jpg" class="d-block w-100 h-50" alt="banner4">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>

    <?php foreach ($categories as $category) : ?>
    <?php
    $sql = "SELECT sp.masp, sp.tensp, sp.gia, sp.hinhsp 
            FROM sanpham sp
            WHERE sp.maloai = (SELECT maloai FROM loai WHERE tenloai = ?)
            LIMIT 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="row my-5">
        <div class="row">
            <div class="col-6">
                <h2><?= mb_strtoupper($category) ?></h2>
            </div>
            <div class="col-6 text-end">
                <a href="product.php?tenloai=<?= urlencode($category) ?>" class="link">Xem tất cả sản phẩm</a>
            </div>
        </div>
        <hr class="line">
        <div class="row justify-content-center">
            <?php foreach ($products as $product) : ?>
            <div class="col-md-3 col-sm-6">
                <a href="detail_product.php?masp=<?= $product['masp'] ?>" class="product-link">
                    <div class="product-item">
                        <img src="<?= $product['hinhsp'] ?>" alt="<?= html_escape($product['tensp']) ?>"
                            class="img-fluid">
                        <h5><?= html_escape($product['tensp']) ?></h5>
                        <p>Giá: <?= number_format($product['gia']) ?>đ</p>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php endforeach ?>


</div>

<?php
include_once __DIR__. '/../src/partials/footer.php'
?>