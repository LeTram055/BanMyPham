<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

include_once __DIR__ . '/../src/partials/header.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">THÔNG TIN VỀ CHÚNG TÔI</h2>
    </div>
    <div class="row m-3">
        <div class="col-6 offset-3">
            <img src="images/contact.jpg" style="max-width: 100%; height: auto;">
            <hr>
        </div>
    </div>
    <div class="row m-3">
        <div class="col-6 offset-3">
            <p><b class="contact"><i class="fa-solid fa-star"></i> Email: </b>tncosmeticshop@gmail.com</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Hotline: </b>19001009</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Địa chỉ: </b>Đường 3/2, phường Xuân Khánh, quận Ninh
                Kiều, Thành Phố Cần Thơ</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Facebook: </b>https://www.facebook.com/t&n.vn/</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Instagram: </b>https://www.instagram.com/t&n.vn/</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Twitter: </b>https://www.twitter.com/t&n.vn/</p>
            <p><b class="contact"><i class="fa-solid fa-star"></i> Youtube: </b>https://www.youtube.com/channel/t&n</p>
        </div>

    </div>

    <div class="row m-3">
        <div class="col-6 offset-3">
            <a href="#">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.3201330185377!2d105.7694!3d10.036116899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31400c1af2ef9d0f%3A0x48839d65d1d48c2!2s%C4%90%E1%BA%A1i%20h%E1%BB%8Dc%20C%E1%BA%A7n%20Th%C6%A1!5e0!3m2!1sen!2suk!4v1649239167861!5m2!1sen!2suk"
                    width="100%" height="300px" frameborder="0" style="border: 0" scrolling="no" marginheight="0"
                    marginwidth="0"></iframe>
                <br />
            </a>
        </div>

    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>