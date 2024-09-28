<?php
require_once __DIR__ . '/../src/connect.php';

if (isset($_GET['search'])) {
  $search_term = $_GET['search'];
  $sql = "SELECT * FROM sanpham WHERE tensp LIKE concat('%', ?, '%')";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$search_term]);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  
}

include_once __DIR__. '/../src/partials/header.php';
?>

<div class="container">
    <div class="row m-5">
        <h2 class="text-center mb-5"> KẾT QUẢ TÌM KIẾM SẢN PHẨM VỚI TỪ KHÓA "<?= $search_term ?>"</h2>
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