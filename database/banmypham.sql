-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 12, 2024 lúc 05:16 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `banmypham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_dh`
--

CREATE TABLE `chitiet_dh` (
  `madh` int(10) NOT NULL,
  `masp` varchar(10) NOT NULL,
  `soluong` int(11) NOT NULL,
  `ttien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_dh`
--

INSERT INTO `chitiet_dh` (`madh`, `masp`, `soluong`, `ttien`) VALUES
(1, 'sp015', 2, 1360000),
(1, 'sp022', 1, 100000),
(1, 'sp001', 1, 100000),
(2, 'sp010', 3, 450000),
(3, 'sp007', 3, 660000),
(3, 'sp020', 1, 120000),
(4, 'sp005', 1, 180000),
(4, 'sp013', 1, 355000),
(4, 'sp001', 1, 100000),
(5, 'sp008', 1, 130000),
(5, 'sp015', 1, 680000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `madh` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `sodt` varchar(10) NOT NULL,
  `diachi` varchar(300) NOT NULL,
  `ghichu` varchar(300) DEFAULT NULL,
  `htttoan` varchar(100) DEFAULT NULL,
  `ngaydat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tongtien` int(11) NOT NULL,
  `trangthai` varchar(100) NOT NULL DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`madh`, `email`, `hoten`, `sodt`, `diachi`, `ghichu`, `htttoan`, `ngaydat`, `tongtien`, `trangthai`) VALUES
(1, 'me@example.com', 'lê me', '0773456789', 'quận Bình Thạnh, TP.HCM', '', 'Thanh toán khi nhận hàng (COD)', '2024-04-11 08:44:18', 1560000, 'Đang xử lý'),
(2, 'me@example.com', 'lê me', '0773456789', 'quận Bình Thạnh, TP.HCM', '', 'Thanh toán khi nhận hàng (COD)', '2024-04-11 08:44:43', 450000, 'Đã hủy'),
(3, 'tramle055@gmail.com', 'Lê Trâm', '0123456789', '3/2, phường Xuân Khánh, quân Ninh Kiều, TP. Cần Thơ', '', 'Thanh toán khi nhận hàng (COD)', '2024-04-11 08:51:19', 780000, 'Đang xử lý'),
(4, 'tramle055@gmail.com', 'Lê Trâm', '0345678901', '3/2, phường Xuân Khánh, quân Ninh Kiều, TP. Cần Thơ', '', 'Thanh toán khi nhận hàng (COD)', '2024-04-11 08:52:17', 635000, 'Đang xử lý'),
(5, 'tramle055@gmail.com', 'Lê Trâm', '0123456789', '3/2, phường Xuân Khánh, quân Ninh Kiều, TP. Cần Thơ', '', 'Thanh toán khi nhận hàng (COD)', '2024-04-11 08:52:34', 810000, 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `maloai` varchar(10) NOT NULL,
  `tenloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`maloai`, `tenloai`) VALUES
('l001', 'Sửa rửa mặt'),
('l002', 'Tẩy trang'),
('l003', 'Kem chống nắng'),
('l004', 'Tẩy tế bào chết');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `email` varchar(50) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `sodt` varchar(10) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `matkhau` varchar(300) NOT NULL,
  `quyennd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`email`, `hoten`, `sodt`, `diachi`, `matkhau`, `quyennd`) VALUES
('admin123@gmail.com', 'admin', '0987654321', 'Vĩnh Long', '$2y$10$8xl4o3nN2WIr592xOvGzNewv3fcDhU2c.ZW2KpOpAUhIj3U2thyDy', 'admin'),
('me@example.com', 'lê me', '0773456789', 'quận Bình Thạnh, TP.HCM', '$2y$10$2XZk4.A8jgULYVUwrq1vZeZweeXfePOiv2BvyW79syKwPMmxzcBg6', ''),
('tramle055@gmail.com', 'Lê Trâm', '0123456789', '3/2, phường Xuân Khánh, quân Ninh Kiều, TP. Cần Thơ', '$2y$10$UM.79OYj49RUz3aFxk4.qOrmCGkdDPI5LuEZHWjotPbOxF4T9JSl.', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` varchar(10) NOT NULL,
  `tensp` varchar(100) NOT NULL,
  `motasp` varchar(500) DEFAULT NULL,
  `gia` int(11) NOT NULL,
  `hinhsp` varchar(100) NOT NULL,
  `maloai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `motasp`, `gia`, `hinhsp`, `maloai`) VALUES
('sp001', 'Sữa Rửa Mặt Simple Giúp Da Sạch Thoáng 150ml', 'Sữa Rửa Mặt Simple Refreshing Facial Wash là sản phẩm sữa rửa mặt dạng gel dành cho mọi loại da nổi tiếng của thương hiệu mỹ phẩm Simple. Với công thức dịu nhẹ không chứa xà phòng cùng thành phần Pro-Vitamin B5 và Vitamin E, sản phẩm giúp làm sạch da hiệu quả, cuốn đi chất nhờn, bụi bẩn và các tạp chất khác mà không gây kích ứng, cho da mềm mịn, đồng thời mang lại cảm giác tươi mát và sạch thoáng cho da.', 100000, 'images/products/srm_simple.png', 'l001'),
('sp002', 'Sữa Rửa Mặt CeraVe Sạch Sâu Cho Da Thường Đến Da Dầu 473ml', 'Sữa Rửa Mặt Cerave Foaming Cleanser kết cấu dạng gel tạo bọt rất lý tưởng để loại bỏ dầu thừa, bụi bẩn và lớp trang điểm với công thức nhẹ nhàng, không phá vỡ hàng rào bảo vệ tự nhiên của da và chứa các thành phần giúp duy trì độ ẩm cân bằng da. Cerave Foaming Cleanser chứa Ceramides, Axit Hyaluronic và Niacinamide giúp duy trì hàng rào bảo vệ da, khóa ẩm và làm dịu làn da của bạn.', 400000, 'images/products/srm_cerave.png', 'l001'),
('sp003', 'Sữa Rửa Mặt Cetaphil Dịu Lành Cho Da Nhạy Cảm 125ml', 'Sữa Rửa Mặt Cetaphil Gentle Skin Cleanser phiên bản mới ra mắt năm 2022 từ thương hiệu Cetaphil với công thức khoa học mới cho làn da nhạy cảm, giúp làm sạch da, loại bỏ bụi bẩn, phù hợp cho mọi loại da, không làm khô da và duy trì hàng rào bảo vệ da suốt ngày dài.', 130000, 'images/products/srm_cetaphil.png', 'l001'),
('sp004', 'Sữa Rửa Mặt Senka Dành Cho Da Mụn 100g', 'Sữa Rửa Mặt Senka Dành Cho Da Mụn là dòng sản phẩm mới ra mắt từ thương hiệu mỹ phẩm Senka nổi tiếng trực thuộc tập đoàn Shiseido Nhật Bản, được thiết kế dành cho những làn da dễ bít tắc lỗ chân lông & dễ nổi mụn, da sống trong điều kiện không khí ô nhiễm ở các thành phố lớn… giúp tạo bọt bông mịn và len lỏi vào da, làm sạch sâu bụi bẩn, bã nhờn bên trong lỗ chân lông, mang lại cho bạn làn da sạch thoáng, hạn chế các tác nhân gây mụn, giảm mụn trong từ 4 tuần sử dụng. ', 90000, 'images/products/srm_senka.png', 'l001'),
('sp005', 'Sữa Rửa Mặt Cocoon Chiết Xuất Từ Nghệ Hưng Yên 140ml', 'Sữa Rửa Mặt Cocoon Chiết Xuất Từ Nghệ Hưng Yên là dòng sữa rửa mặt đến từ thương hiệu mỹ phẩm thuần chay Cocoon của Việt Nam, với công thức dịu nhẹ không sulfate và thành phần chính từ nghệ của vùng đất Hưng Yên, cà rốt và nồng độ 4% AHA nhẹ nhàng loại bỏ các bụi bẩn, tế bào chết, cấp ẩm và làm mềm da giúp da sáng mịn, đều màu.', 180000, 'images/products/srm_cocoon.png', 'l001'),
('sp006', 'Sữa Rửa Mặt Hatomugi Tạo Bọt Dưỡng Ẩm Và Làm Sáng Da 160ml', 'Sữa Rửa Mặt HATOMUGI The Facial Whip là sản phẩm làm sạch da đến từ HATOMUGI - một nhánh con thuộc thương hiệu mỹ phẩm KUMANO Cosmetics, được thiết kế ở dạng chai vòi nhấn tạo bọt sẵn vô cùng tiện dụng, chứa thành phần dưỡng ẩm tự nhiên chiết xuất từ Ý Dĩ giúp mang lại làn da mềm mượt sau khi rửa mặt, đồng thời nuôi dưỡng cho da sáng mịn hơn mỗi ngày.', 100000, 'images/products/srm_hatomugi.png', 'l001'),
('sp007', 'Nước Tẩy Trang Bí Đao Cocoon Làm Sạch & Giảm Dầu 500ml', 'Nước Tẩy Trang Bí Đao Cocoon Winter Melon Micellar Water mới từ thương hiệu mỹ phẩm thuần chay Cocoon là sản phẩm tẩy trang được thiết kế chuyên biệt dành cho da dầu và da mụn nhạy cảm. Với công nghệ Micellar, nước tẩy trang bí đao giúp làm sạch hiệu quả lớp trang điểm, bụi bẩn và dầu thừa, mang lại làn da sạch hoàn toàn và dịu nhẹ.', 220000, 'images/products/ttr_cocoon.png', 'l002'),
('sp008', 'Nước Tẩy Trang Simple Làm Sạch Trang Điểm Vượt Trội 400ml', 'Nước Tẩy Trang Simple Làm Sạch Trang Điểm Và Cấp Ẩm là sản phẩm tẩy trang mặt đến từ thương hiệu Simple xuất xứ Anh Quốc. Công thức cải tiến với công nghệ làm sạch Micellar chứa hàng triệu bong bóng Micelles thông minh giúp loại bỏ lớp trang điểm và bụi bẩn hiệu quả, làm thông thoáng lỗ chân lông, mang lại cảm giác tươi mát cho da sau khi sử dụng, đồng thời cấp ẩm lên đến 4 giờ mà không để lại dư lượng thừa trên da.', 130000, 'images/products/ttr_simple.png', 'l002'),
('sp009', 'Nước Tẩy Trang Senka Ngừa Mụn, Kiểm Soát Nhờn 230ml', 'Nước Tẩy Trang Senka All Clear Water Micellar Formula là dòng sản phẩm tẩy trang dạng nước từ thương hiệu mỹ phẩm SENKA Nhật Bản, với công thức Micellar giúp giúp làm sạch bụi bẩn, bã nhờn, lớp trang điểm lâu trôi tận sâu lỗ chân lông một cách hiệu quả mà vẫn dịu nhẹ cho làn da. Đặc biệt, mỗi phân loại được bổ sung các chiết xuất thiên nhiên giúp nuôi dưỡng và hỗ trợ cải thiện từng vấn đề về da riêng biệt.', 80000, 'images/products/ttr_senka.png', 'l002'),
('sp010', 'Nước Tẩy Trang Hatomugi Chiết Xuất Hạt Ý Dĩ 500ml', 'Nước Tẩy Trang Hatomugi Ý Dĩ Dưỡng Ẩm, Làm Sáng Da 500ml là sản phẩm tẩy trang đến từ thương hiệu mỹ phẩm Hatomugi của Nhật Bản, giúp làm sạch bụi bẩn, dầu thừa, loại bỏ lớp trang điểm, kem chống nắng hiệu quả. Ngoài ra sản phẩm chiết xuất hạt ý dĩ duy trì độ ẩm tự nhiên cho da, dưỡng da mềm mịn và làm sáng da.', 150000, 'images/products/ttr_hatomugi.png', 'l002'),
('sp011', 'Nước Tẩy Trang Hada Labo Sạch Sâu Dưỡng Ẩm 240ml', 'Nước Tẩy Trang Hada Labo Sạch Sâu là sản phẩm tẩy trang mặt đến từ thương hiệu mỹ phẩm Hada Labo của Nhật Bản, thành phần an toàn lành tính cho mọi làn da giúp làm sạch sâu, loại bỏ cả các lớp trang điểm lâu trôi, kem chống nắng, bụi mịn PM2.5 đồng thời bổ sung độ ẩm và dưỡng da sáng mịn, đều màu.', 105000, 'images/products/ttr_hadolabo.png', 'l002'),
('sp012', 'Nước Tẩy Trang Nivea Ngăn Ngừa Mụn 400ml', 'Nước Tẩy Trang Hada Labo Sạch Sâu là sản phẩm tẩy trang mặt đến từ thương hiệu mỹ phẩm Hada Labo của Nhật Bản, thành phần an toàn lành tính cho mọi làn da giúp làm sạch sâu, loại bỏ cả các lớp trang điểm lâu trôi, kem chống nắng, bụi mịn PM2.5 đồng thời bổ sung độ ẩm và dưỡng da sáng mịn, đều màu.', 145000, 'images/products/ttr_nivea.png', 'l002'),
('sp013', 'Kem Chống Nắng Cocoon Bí Đao Quang Phổ Rộng 50ml', 'Kem Chống Nắng Cocoon Bí Đao Quang Phổ Rộng 50ml là sản phẩm chống nắng da mặt đến từ thương hiệu mỹ phẩm Cocoon của Việt Nam, với công thức đột phá kết hợp các màng lọc thế hệ mới, chiết xuất bí đao và các thành phần chống oxi hoá, kem chống nắng bí đao mang lại khả năng bảo vệ phổ rộng chống lại bức xạ UVA và UVB là nguyên nhân gây ra tác hại lên da như bỏng rát, cháy nắng, kích ứng, lão hoá và tổn thương tế bào da. Cocoon Winter Melon Suncreen với khả năng bảo vệ rất cao SPF 50+, PA ++++ và h', 355000, 'images/products/kcn_cocoon.png', 'l003'),
('sp014', 'Kem Chống Nắng Hatomugi Nâng Tông & Dưỡng Ẩm Da 70g', 'Reihaku Hatomugi UV Milky Gel là dòng sản phẩm kem chống nắng dành cho da mặt và toàn thân đến từ thương hiệu mỹ phẩm Hatomugi của Nhật Bản, giúp bảo vệ làn da khỏi tác hại của tia UVA/UVB, đồng thời dưỡng ẩm và làm sáng da nhờ chiết xuất hạt Ý Dĩ đặc trưng của dòng sản phẩm Hatomugi.', 100000, 'images/products/kcn_hatomugi.png', 'l003'),
('sp015', 'Kem Chống Nắng Eucerin Cho Da Nhạy Cảm 50ml', 'Kem Chống Nắng Eucerin Hydro Ultra Light SPF 50+ Cho Da Nhạy Cảm 50ml là sản phẩm chống nắng da mặt đến từ thương hiệu dược mỹ phẩm Eucerin. Điểm nổi bật chính là công nghệ phổ quang tiên tiến giúp ngăn ngừa tia UVA/UVB. Sản phẩm có khả năng chống nước và giữ làn da mềm mịn cả ngày. Kết cấu fluid và finish bán lì (semi-matte) không khiến da có độ bóng nhẫy.', 680000, 'images/products/kcn_eucerin.png', 'l003'),
('sp016', 'Kem Chống Nắng SVR Làm Giảm Mụn SPF50+ 40ml ', 'Kem Chống Nắng SVR Sebiaclear Creme SPF50+ công thức mới từ thương hiệu Laboratoire SVR giúp bảo vệ và khắc phục các khuyết điểm dành cho da dầu, mụn. Sản phẩm giúp kềm dầu, làm giảm các tác hại của tia UV lên da để ngăn ngừa tăng sinh nhân mụn và vết thâm.', 450000, 'images/products/kcn_svr.png', 'l003'),
('sp017', 'Kem Chống Nắng Nivea Dưỡng Sáng Mịn Hoa Hồng Hokkaido 40ml', 'Kem Chống Nắng Nivea Triple Protect SPF50+ PA+++ 40ml là dòng kem chống nắng đến từ thương hiệu mỹ phẩm Nivea thuộc tập đoàn Beiersdorf của Đức, với công nghệ Triple Defense cùng chỉ số chống nắng SPF50+ PA+++ giúp chống nắng tối ưu bảo vệ da dưới tia UVA, UVB, ánh sáng xanh và ô nhiễm từ môi trường. Đồng thời sản phẩm sử dụng công thức Ultra Light cho lớp chống nắng thẩm thấu nhanh vào da, không gây cảm giác nhờn rít.', 195000, 'images/products/kcn_nivea.png', 'l003'),
('sp018', 'Kem Chống Nắng Vichy Thoáng Nhẹ Không Bóng Dầu SPF 50 50ml', 'Kem Chống Nắng Vichy Capital Soleil Dry Touch Protective Face Fluid SPF50 UVB+UVA là sản phẩm chống nắng đến từ thương hiệu dược mỹ phẩm Vichy của Pháp, với 3 màng lọc bảo vệ da trước  tác động của tia UVA và UVB, ngăn ngừa sạm nám, lão hoá và ung thư da. Hơn thế, thành phần sản phẩm còn chứa Alkyl Benzoate, giúp da khô thoáng khi thoa, không gây cảm giác nhờn rít khó chịu. Sản phẩm hứa hẹn sẽ là sự lựa chọn hoàn hảo của bạn trong mùa hè nắng nóng. ', 430000, 'images/products/kcn_vichy.png', 'l003'),
('sp019', 'Tẩy Tế Bào Chết Rosette Cho Mọi Loại Da 180g', 'Tẩy Tế Bào Chết ROSETTE Gommage Peeling Gel là dòng sản phẩm tẩy tế bào chết đến từ thương hiệu ROSETTE – thương hiệu mỹ phẩm nội địa Nhật Bản được yêu thích và tin dùng. Tại Nhật, dòng Rosette Gommage Peeling Gel đã liên tục nhận giải thưởng Best Award bởi tạp chí làm đẹp uy tín hàng đầu Cosme trong nhiều năm liền, đồng thời nhận được nhiều đánh giá tốt từ các tạp chí nổi tiếng khác trên toàn thế giới.', 100000, 'images/products/ttbc_rosette.png', 'l004'),
('sp020', 'Tẩy Tế Bào Chết Cocoon Cà Phê Đắk Lắk 150ml', 'Cà Phê Đắk Lắk làm sạch da chết mặt Dak Lak coffee face polish 150ml là dòng sản phẩm tẩy tế bào chết da mặt đến từ thương hiệu mỹ phẩm Cocoon Việt Nam. Thành phần được làm từ những hạt cà phê Đắk Lắk xay nhuyễn giàu cafeine hòa quyện với bơ cacao Tiền Giang giúp bạn loại bỏ lớp tế bào chết già cỗi và xỉn màu, đánh thức làn da tươi mới đầy năng lượng cùng cảm giác mượt mà và mềm mịn lan tỏa.', 120000, 'images/products/ttbc_cocoon.png', 'l004'),
('sp021', 'Tẩy Tế Bào Chết Eucerin Dành Cho Da Nhờn Mụn 100ml', 'Tẩy Tế Bào Chết Eucerin Pro ACNE Solution Scrub là sản phẩm tẩy tế bào chết đến từ thương hiệu dược mỹ phẩm Eucerin, với công thức không chứa dầu, kết hợp thành phần Lactic Acid giúp làm sạch nhẹ dịu, giảm các tác nhân gây mụn đầu trắng và mụn đầu đen, đồng thời loại bỏ cặn trang điểm hiệu quả. Sản phẩm thích hợp sử dụng cho những bạn có làn da nhờn mụn mong muốn sở hữu một làn da mịn màng và khỏe mạnh hơn.', 300000, 'images/products/ttbc_eucerin.png', 'l004'),
('sp022', 'Tẩy Tế Bào Chết Milaganics Cà Phê Sáng Da, Mờ Thâm 280g', 'Tẩy Da Chết Milaganics Natural Coffee & Brown Sugar Scrub là tẩy tế bào chết da mặt và toàn thân đến từ thương hiệu mỹ phẩm Milaganics của Việt Nam, giàu thành phần từ tự nhiên như hạt cà phê Robusta, đường nâu, dầu Oilve, Cám Gạo, Mật Ong,… dễ dàng lấy đi tế bào chết, lớp sừng trên da mà vẫn cung cấp đủ độ ẩm đồng thời làm giảm các vết thâm sạm, nuôi dưỡng da mềm mại, sáng mịn.', 100000, 'images/products/ttbc_milaganic.png', 'l004'),
('sp023', 'Tẩy Tế Bào Chết JMsolution Dạng Gel Dưỡng Sáng Da 120ml', 'Nature Green Tangerine Peeling Gel là tẩy tế bào chết và dưỡng sáng dạng gel thuộc dòng skincare thuần tự nhiên Nature mới của thương hiệu JMsolution - với ý nghĩa mang đến sự tối ưu phù hợp cho làn da của người Việt Nam.', 100000, 'images/products/ttbc_jmsolution.png', 'l004'),
('sp024', 'Tẩy Tế Bào Chết Evoluderm Mềm Mịn Da Chiết Xuất Đào 150g', 'Tẩy Tế Bào Chết Evoluderm Gommage Scrub Nuôi Dưỡng Sâu 150g là sản phẩm tẩy tế bào chết đến từ thương hiệu Evoluderm - Pháp. Sản phẩm có chứa hạt mịn chiết xuất từ thiên nhiên nhẹ nhàng lấy đi những chất bụi bẩn trên da mặt,kích thích sự sản sinh tế bào. Đồng thời sản phẩm bổ sung các thành phần dưỡng chất giúp cung cấp độ ẩm, làm tươi mới làn da, giúp da sáng mịn đều màu. ', 300000, 'images/products/ttbc_evoluderm.png', 'l004');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_dh`
--
ALTER TABLE `chitiet_dh`
  ADD KEY `madh` (`madh`),
  ADD KEY `masp` (`masp`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `email` (`email`);

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`maloai`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `maloai` (`maloai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_dh`
--
ALTER TABLE `chitiet_dh`
  ADD CONSTRAINT `chitiet_dh_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`),
  ADD CONSTRAINT `chitiet_dh_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`email`) REFERENCES `nguoidung` (`email`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loai` (`maloai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
