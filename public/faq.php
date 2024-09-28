<?php
session_start();
require_once __DIR__ . '/../src/connect.php';

include_once __DIR__ . '/../src/partials/header.php';
?>

<div class="container">
    <div class="row justify-content-center m-5">
        <h2 class="text-center">HỎI ĐÁP</h2>

    </div>
    <div class="row m-3">
        <div class="col">
            <h4 style="text-decoration: underline;" class="mb-3">Các câu hỏi về sản phẩm</h4>
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h5 class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. Các sản phẩm được bán tại T&N có nguồn gốc xuất xứ như thế
                            nào?
                        </h5>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>- Tất cả các sản phẩm được bán tại website T&N đều là các sản phẩm chính hãng, được nhập
                                trực tiếp từ các nhà phân phối có uy tín tại Mỹ, Pháp, Nhật... Chúng tôi cam kết không
                                bán hàng giả, hàng nhái, hết hạn sử dụng hoặc kém chất lượng.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            2. Tôi phải làm gì nếu sản phẩm nhận được bị hư hỏng hoặc không đúng nhưcam kết?
                        </button>
                    </h5>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>- Quý khách hãy liên hệ ngay với chúng tôi ngay khi nhận được hàng, nếu có
                                thể mong quý khách hãy kiểm tra tình trạng hàng trước khi nhận.</p>
                            <p>- Chúng tôi cam kết sẽ đổi lại cho quý khách tất cả các sản phẩm bị hư hỏng, đổ bể do quá
                                trình vận chuyển.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            3. Giá sản phẩm đăng tải có phải là giá chính xác không?
                        </button>
                    </h5>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>- Tất cả các sản phẩm đăng tải trên T&N đều ghi rõ giá tiền, quý khách có thể đặt hàng
                                ngay mà không cần kiểm tra xem giá có bị thay đổi hay không.</p>
                            <p>- Trong trường hợp giá đăng tải sai sót do lỗi kỹ thuật, chúng tôi sẽ thông báo ngay cho
                                quý khách, tuy nhiên điều này hiếm khi xảy ra (chưa từng xảy ra).</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            4. Tại sao mẫu mã sản phẩm của T&N không giống các sản phẩm tôi đã từng mua từ nơi khác
                            và/hoặc các sản phẩm từ bạn bè tôi?
                        </button>
                    </h5>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="accordion-body">
                            <p>- Các sản phẩm chăm sóc sắc đẹp cũng tương tự những mặt hàng tiêu dùng khác, luôn được
                                nhà sản xuất nghiên cứu nâng cao chất lượng, thay đổi mẫu mã để phù hợp với thị hiếu
                                theo từng năm, từng mùa. Do vậy việc hai sản phẩm cùng một dòng nhưng có hình thức khác
                                nhau là bình thường, tất nhiên những thay đổi này sẽ không quá lớn, sao cho khách hàng
                                vẫn có thể nhận ra và phân biệt
                                từng dòng sản phẩm.</p>
                            <p>- Điều tương tự cũng diễn ra với các chủng loại sản phẩm khác như xe máy, điện thoại,
                                TV... </p>
                            <p>- Mặc khác, một điều dễ dàng suy luận là: các sản phẩm giả mạo nếu có, sẽ luôn có hình
                                thức giống hệt với sản phẩm mà nó giả mạo, bới những người sản xuất hàng giả sẽ luôn cố
                                gắng bắt chước một cách giống nhất.
                            </p>
                            <p>- Những chi tiết như kiểu chữ, có hoa văn hoặc không, hình dạng nắp đậy (bằng phẳng hay
                                cong, cao hơn hay thấp hơn ...) không phải là tiêu chí để phân biệt hàng thật hay giả.
                            </p>
                            <p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row m-3">
        <div class="col">
            <h4 style="text-decoration: underline;" class="mb-3">Các câu hỏi về dịch vụ</h3>

                <div class="accordion" id="accordion">
                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                1. Sau khi đặt hàng, khoảng bao lâu tôi có thể nhận được?
                            </button>
                        </h5>
                        <div id="collapseOne2" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>- Tùy theo khu vực của bạn xa hay gần shop mà thời gian giao hàng có thể từ 3-7
                                    ngày.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
                                2. Tôi có thể hủy bỏ đặt hàng không?
                            </button>
                        </h5>
                        <div id="collapseTwo2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>- Được. Bạn có thể hủy bỏ đặt hàng khi đơn hàng chưa vận chuyển.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree2" aria-expanded="true" aria-controls="collapseThree2">
                                3. Tôi muốn kiểm tra hàng rồi mới trả tiền có được không?
                            </button>
                        </h5>
                        <div id="collapseThree2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>- T&N hỗ trợ khách hàng kiểm tra hàng trước khi thanh toán nên bạn có thể kiểm
                                    tra
                                    rồi mới trả tiền. Nếu đơn hàng giao không đúng bạn có thể hoàn hàng ngay.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '/../src/partials/footer.php' ?>