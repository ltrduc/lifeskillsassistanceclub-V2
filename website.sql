-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2021 lúc 09:36 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_activityphoto`
--

CREATE TABLE `tbl_activityphoto` (
  `id` int(255) NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_attendances`
--

CREATE TABLE `tbl_attendances` (
  `id` int(255) NOT NULL,
  `idstudent` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schoolyear` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attendance` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_checkregister`
--

CREATE TABLE `tbl_checkregister` (
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_checkregister`
--

INSERT INTO `tbl_checkregister` (`level`) VALUES
(0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(255) NOT NULL,
  `subjects` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` int(255) NOT NULL,
  `period` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dates` date NOT NULL,
  `semesters` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `schoolyear` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `teacher` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_device`
--

CREATE TABLE `tbl_device` (
  `id` int(255) NOT NULL,
  `device` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_equipment`
--

CREATE TABLE `tbl_equipment` (
  `id` int(255) NOT NULL,
  `typedevice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `originalnumber` int(255) NOT NULL,
  `using` int(255) NOT NULL DEFAULT 0,
  `donotuse` int(255) NOT NULL DEFAULT 0,
  `normal` int(255) NOT NULL DEFAULT 0,
  `broken` int(255) NOT NULL DEFAULT 0,
  `lost` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_loanpayment`
--

CREATE TABLE `tbl_loanpayment` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `devices` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(255) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postgenre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posttype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL,
  `contentpost` text COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_postgenres`
--

CREATE TABLE `tbl_postgenres` (
  `id` int(255) NOT NULL,
  `postgenre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_recruitment`
--

CREATE TABLE `tbl_recruitment` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idstudent` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `faculty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `per_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stu_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resolution` int(30) NOT NULL,
  `content1` text COLLATE utf8_unicode_ci NOT NULL,
  `content2` text COLLATE utf8_unicode_ci NOT NULL,
  `content3` text COLLATE utf8_unicode_ci NOT NULL,
  `content4` text COLLATE utf8_unicode_ci NOT NULL,
  `content5` text COLLATE utf8_unicode_ci NOT NULL,
  `content6` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(255) NOT NULL,
  `idstudent` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_schoolyear`
--

CREATE TABLE `tbl_schoolyear` (
  `id` int(255) NOT NULL,
  `schoolyear` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_selective`
--

CREATE TABLE `tbl_selective` (
  `id` int(255) NOT NULL,
  `idstudent` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `faculty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content1` text COLLATE utf8_unicode_ci NOT NULL,
  `content2` text COLLATE utf8_unicode_ci NOT NULL,
  `content3` text COLLATE utf8_unicode_ci NOT NULL,
  `content4` text COLLATE utf8_unicode_ci NOT NULL,
  `content5` text COLLATE utf8_unicode_ci NOT NULL,
  `content6` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_structure`
--

CREATE TABLE `tbl_structure` (
  `id` int(255) NOT NULL,
  `idstudent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `id` int(255) NOT NULL,
  `subjects` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(255) NOT NULL,
  `user` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idstudent` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(30) NOT NULL,
  `feature` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user`, `password`, `idstudent`, `fullname`, `birthday`, `facebook`, `team`, `phone`, `level`, `feature`) VALUES
(1, '51900040', '51900040', '51900040', 'Lê Trí Đức', '05/03/2001', 'https://www.facebook.com/ltrduc', 'Hành Chính', '0377025449', 0, 0),
(2, '51900356', '51900356', '51900356', 'Tạ Quốc Khánh', '31/08/2001', 'https://www.facebook.com/khanh.taquoc.376', 'Hành Chính', '0923117058', 3, 0),
(3, 'H1900308', 'H1900308', 'H1900308', 'Nguyễn Nhật Quyên', '26/06/2001', 'https://www.facebook.com/nhatquyen26', 'Hành Chính', '0982817925', 3, 0),
(4, '11900067', '11900067', '11900067', 'Phạm Ngọc Minh Thư', '18/10/2001', 'https://www.facebook.com/minhthu.pham.58118774', 'Hành Chính', '0944996749', 3, 0),
(5, '219H0227', '219H0227', '219H0227', 'Bùi Thị Thuỳ Trang', '29/05/2001', 'https://m.facebook.com/trang.buithithuy.37?ref=bookmarks', 'Hành Chính', '0827540883', 3, 0),
(6, 'B1900443', 'B1900443', 'B1900443', 'Huỳnh Hữu Khang Vĩ', '20/04/2001', 'https://www.facebook.com/khangvi.huynhhuu', 'Hành Chính', '0704438192', 3, 0),
(7, '520H0401', '520H0401', '520H0401', 'Lê Gia Phú', '29/12/2002', 'https://www.facebook.com/GiaPhu2912/', 'Hành Chính', '0852068832', 3, 0),
(8, 'A2000244', 'A2000244', 'A2000244', 'Phan Phương Thảo', '04/07/2002', 'https://www.facebook.com/thao.phanphuong.5209000', 'Hành Chính', '0857141074', 3, 0),
(9, 'B20H0236', 'B20H0236', 'B20H0236', 'Vương Kim Trang', '21/07/2002', 'https://www.facebook.com/profile.php?id=100007927696233', 'Hành Chính', '0342969417', 3, 0),
(10, 'H2000514', 'H2000514', 'H2000514', 'Trần Kim Xuân', '23/12/2002', 'https://www.facebook.com/kimxuan.tran.927', 'Hành Chính', '0703874040', 3, 0),
(11, 'B19h0160', 'B19h0160', 'B19h0160', 'Nguyễn Trần Phương Anh', '18/10/2001', 'https://www.facebook.com/ntpa.1810', 'Nhân Sự', '0378790003', 3, 0),
(12, '020h0214', '020h0214', '020h0214', 'Ngô Nguyễn Minh Anh', '04/04/2002', 'https://www.facebook.com/profile.php?id=100044649050442', 'Nhân Sự', '0703090346', 3, 0),
(13, '61900381', '61900381', '61900381', 'Trần Ngọc Châu', '10/09/2001', 'https://www.facebook.com/NgocChau2k1', 'Nhân Sự', '0852419920', 3, 0),
(14, '720h1520', '720h1520', '720h1520', 'Trần Mỹ Châu', '04/08/2002', 'https://www.facebook.com/profile.php?id=100017586014144', 'Nhân Sự', '0911382340', 3, 0),
(15, '61900050', '61900050', '61900050', 'Lê Thị Hồng Gấm', '17/02/2001', 'https://www.facebook.com/profile.php?id=100007021936928', 'Nhân Sự', '0329830135', 3, 0),
(16, '01900631', '01900631', '01900631', 'Nguyễn Hoàng Hồng Giang', '07/01/2001', 'https://m.facebook.com/hoanghonggiang.nguyen?ref=bookmarks', 'Nhân Sự', '0773112675', 3, 0),
(17, '61900052', '61900052', '61900052', 'Đào Minh Hà', '07/06/2001', 'https://www.facebook.com/sunflower7601', 'Nhân Sự', '0918732274', 3, 0),
(18, 'C1900109', 'C1900109', 'C1900109', 'Nguyễn Thị Thanh Hoa', '18/01/2001', 'https://www.facebook.com/profile.php?id=100026071803296', 'Nhân Sự', '0889202896', 3, 0),
(19, '01900146', '01900146', '01900146', 'Huỳnh Thị Diễm Hồng', '17/08/2000', 'https://www.facebook.com/diemhong.huynh.90', 'Nhân Sự', '0945105919', 3, 0),
(20, '51900119', '51900119', '51900119', 'Lê Thành Đăng Khoa', '17/04/2001', 'https://www.facebook.com/profile.php?id=100013525358519', 'Nhân Sự', '0788765410', 3, 0),
(21, 'B1900124', 'B1900124', 'B1900124', 'Phạm Hoàng Long', '31/03/2001', 'https://www.facebook.com/profile.php?id=100009880309418', 'Nhân Sự', '0853803687', 3, 0),
(22, '31900474', '31900474', '31900474', 'Huỳnh Nguyễn Ngọc Minh', '25/01/2001', 'https://www.facebook.com/huynh.minh.7334504/', 'Nhân Sự', '0768868702', 3, 0),
(23, '41900468', '41900468', '41900468', 'Nguyễn Duy Khánh Minh', '03/09/2001', 'https://www.facebook.com/nguyenduykhanhminh6685/', 'Nhân Sự', '0862087931', 3, 0),
(24, '31901010', '31901010', '31901010', 'Trầm Tuyết Ngân', '16/04/2001', 'https://www.facebook.com/woominie/', 'Nhân Sự', '0378154674', 3, 0),
(25, '81900546', '81900546', '81900546', 'Trần Hiếu Ngân', '30/01/2001', 'https://www.facebook.com/profile.php?id=100008053782674', 'Nhân Sự', '0762936795', 3, 0),
(26, 'a2000221', 'a2000221', 'a2000221', 'Nguyễn Như Ngọc', '09/10/2002', 'https://www.facebook.com/khlongdyeu/', 'Nhân Sự', '0349583144', 3, 0),
(27, '51900444', '51900444', '51900444', 'Phạm Huỳnh Anh Tiến', '28/12/2001', 'https://www.facebook.com/profile.php?id=100040680214831', 'Nhân Sự', '0582564360', 3, 0),
(28, '41900552', '41900552', '41900552', 'Huỳnh Quốc Thắng', '08/10/2001', 'https://m.facebook.com/profile.php?ref=opera_for_android_speed_dial', 'Nhân Sự', '0387009188', 3, 0),
(29, '61900566', '61900566', '61900566', 'Ngô Trần Ngọc Thuận', '29/01/2001', 'https://www.facebook.com/ngocthuan2901', 'Nhân Sự', '0869320518', 3, 0),
(30, '41900587', '41900587', '41900587', 'Nguyễn Hoàng Trân', '23/12/2001', 'https://www.facebook.com/hoangtran.nguyen.353', 'Nhân Sự', '0865561178', 3, 0),
(31, '519H0247', '519H0247', '519H0247', 'Nguyễn Đức Trọng', '19/08/2001', 'https://www.facebook.com/profile.php?id=100034747113318', 'Nhân Sự', '0901346504', 3, 0),
(32, 'B19H0163', 'B19H0163', 'B19H0163', 'Trương Hoàng Anh', '05/05/2001', 'https://www.facebook.com/truong.hoanganh.395017', 'Nhân Sự', '0949735859', 3, 0),
(33, '81900518', '81900518', '81900518', 'Nguyễn Thị Kim Hằng', '10/10/2001', 'https://www.facebook.com/mi.hayley.9', 'Nhân Sự', '0388021437', 3, 0),
(34, '81900544', '81900544', '81900544', 'Nguyễn Thị My', '19/11/2001', 'https://www.facebook.com/profile.php?id=100013866451406', 'Nhân Sự', '0963938884', 3, 0),
(35, 'B19H0257', 'B19H0257', 'B19H0257', 'Trần Yến Ngọc', '14/02/2001', 'https://www.facebook.com/tyn.tran.712', 'Nhân Sự', '0917886665', 3, 0),
(36, '81900550', '81900550', '81900550', 'Nguyễn Ngọc Thảo Nguyên', '04/02/2001', 'https://www.facebook.com/mi2001ngguyen', 'Nhân Sự', '0765071246', 3, 0),
(37, 'C2000286', 'C2000286', 'C2000286', 'Nguyễn Hoàng Minh Khan', '12/07/2002', 'https://m.facebook.com/khan.minh.127', 'Nhân Sự', '0378570207', 3, 0),
(38, '62000831', '62000831', '62000831', 'Trần Phùng Hiếu Ngân', '15/03/2002', 'https://www.facebook.com/tphngan2002', 'Nhân Sự', '0528614706', 3, 0),
(39, '720H1569', '720H1569', '720H1569', 'Giang Tịnh Nghi', '07/12/2002', 'https://www.facebook.com/tinhnghi.giang.9/', 'Nhân Sự', '0777795237', 3, 0),
(40, '720H1575', '720H1575', '720H1575', 'Đỗ Uyên Nhi', '17/08/2002', 'https://www.facebook.com/profile.php?id=100012358297092', 'Nhân Sự', '0326776018', 3, 0),
(41, '32001095', '32001095', '32001095', 'Lê Thanh Thùy', '15/01/2002', 'https://www.facebook.com/profile.php?id=100027235023512', 'Nhân Sự', '0376523632', 3, 0),
(42, '720H1224', '720H1224', '720H1224', 'Bùi Thị Tố Trinh', '01/11/2002', 'https://www.facebook.com/trinh.to.9862273', 'Nhân Sự', '0358729992', 3, 0),
(43, 'B2000218', 'B2000218', 'B2000218', 'Trầm Thị Quỳnh Tươi', '03/10/2002', 'https://www.facebook.com/profile.php?id=100006832818379', 'Nhân Sự', '0352390586', 3, 0),
(44, '019h0292', '019h0292', '019h0292', 'Nguyễn Mỹ Anh', '10/06/2001', 'https://www.facebook.com/myanh.nguyen.35325074', 'Truyền Thông', '0779700642', 2, 0),
(45, '720h1519', '720h1519', '720h1519', 'Hoàng Ngọc Bảo Châu', '12/12/2002', 'https://www.facebook.com/profile.php?id=100008882825759', 'Truyền Thông', '0779603470', 3, 0),
(46, '51900030', '51900030', '51900030', 'Nguyễn Quốc Đạt', '11/10/2001', 'https://www.facebook.com/profile.php?id=100012335321609', 'Truyền Thông', '0961418516', 1, 0),
(47, '02000939', '02000939', '02000939', 'Hồ Thị Bích Tuyền', '10/06/2002', 'https://www.facebook.com/bichtuyen.hothi.731', 'Truyền Thông', '0373471411', 3, 0),
(48, 'E20H0347', 'E20H0347', 'E20H0347', 'Phùng Lữ Thế Hoài', '28/10/2002', 'https://www.facebook.com/thanhminh.7123tufkdkhnchruhcdjdjdjfhfgghruyrhchjhf', 'Truyền Thông', '0384633459', 3, 0),
(49, '020H0363', '020H0363', '020H0363', 'Nguyễn Phạm Kim Ngân', '12/08/2002', 'https://www.facebook.com/ngan.nguyenphamkim.5', 'Truyền Thông', '0813775042', 3, 0),
(50, '32001093', '32001093', '32001093', 'Nguyễn Thị Thư', '10/01/2002', 'https://www.facebook.com/thiendi.hoang.5030', 'Truyền Thông', '0346056637', 3, 0),
(51, 'H2000506', 'H2000506', 'H2000506', 'Lê Thanh Vy', '11/07/2002', 'https://www.facebook.com/profile.php?id=100048302023516', 'Truyền Thông', '0902857974', 3, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_activityphoto`
--
ALTER TABLE `tbl_activityphoto`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_checkregister`
--
ALTER TABLE `tbl_checkregister`
  ADD PRIMARY KEY (`level`);

--
-- Chỉ mục cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_device`
--
ALTER TABLE `tbl_device`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_loanpayment`
--
ALTER TABLE `tbl_loanpayment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_postgenres`
--
ALTER TABLE `tbl_postgenres`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_recruitment`
--
ALTER TABLE `tbl_recruitment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_selective`
--
ALTER TABLE `tbl_selective`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_structure`
--
ALTER TABLE `tbl_structure`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_activityphoto`
--
ALTER TABLE `tbl_activityphoto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_device`
--
ALTER TABLE `tbl_device`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_loanpayment`
--
ALTER TABLE `tbl_loanpayment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_postgenres`
--
ALTER TABLE `tbl_postgenres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_recruitment`
--
ALTER TABLE `tbl_recruitment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_selective`
--
ALTER TABLE `tbl_selective`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_structure`
--
ALTER TABLE `tbl_structure`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
