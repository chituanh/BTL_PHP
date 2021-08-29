-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th8 28, 2021 lúc 02:52 PM
-- Phiên bản máy phục vụ: 8.0.17
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom22`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `idChucVu` int(11) NOT NULL,
  `nameChucVu` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`idChucVu`, `nameChucVu`) VALUES
(1, 'admmin'),
(2, 'giaovien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaovien`
--

CREATE TABLE `giaovien` (
  `idGiaoVien` int(11) NOT NULL,
  `nameGiaoVien` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phoneGiaoVien` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `matKhau` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idChucVu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giaovien`
--

INSERT INTO `giaovien` (`idGiaoVien`, `nameGiaoVien`, `phoneGiaoVien`, `email`, `matKhau`, `idChucVu`) VALUES
(1, 'Phùng Thế Tài', '0979649964', 'chituanh212@gmail.co', '123456', 1),
(2, 'Chí tử anh', '094353434', 'chituanh', '123456', 2),
(3, 'xem nào', '09534534', 'chituanh2222', '123456', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichhoc`
--

CREATE TABLE `lichhoc` (
  `idLichHoc` int(11) NOT NULL,
  `idPhongMay` int(11) DEFAULT NULL,
  `idMonHoc` int(11) DEFAULT NULL,
  `timeStart` date DEFAULT NULL,
  `timeEnd` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichtruc`
--

CREATE TABLE `lichtruc` (
  `idLichTruc` int(11) NOT NULL,
  `idPhongMay` int(11) NOT NULL,
  `idGiaoVien` int(11) NOT NULL,
  `timeStart` datetime NOT NULL,
  `timeEnd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichtruc`
--

INSERT INTO `lichtruc` (`idLichTruc`, `idPhongMay`, `idGiaoVien`, `timeStart`, `timeEnd`) VALUES
(1, 1, 1, '2021-08-31 09:00:00', '2021-09-02 12:00:00'),
(2, 1, 2, '2021-08-30 06:00:00', '2021-08-31 00:00:00'),
(4, 1, 1, '2021-08-25 00:00:00', '2021-08-25 05:00:00'),
(5, 1, 2, '2021-08-07 15:26:00', '2021-08-10 18:26:00'),
(6, 2, 2, '2021-09-03 15:26:00', '2021-09-05 15:26:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maytinh`
--

CREATE TABLE `maytinh` (
  `idMayTinh` int(11) NOT NULL,
  `tinhTrang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cauHinhMay` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phanCung` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idPhongMay` int(11) DEFAULT NULL,
  `nameMayTinh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `maytinh`
--

INSERT INTO `maytinh` (`idMayTinh`, `tinhTrang`, `cauHinhMay`, `phanCung`, `idPhongMay`, `nameMayTinh`) VALUES
(1, 'hoạt động', 'I9 9800HK', 'Bao gồm case, màn hình', 1, 'Máy Tính 1.1'),
(2, 'hoạt động', 'I9 9800HK', 'Bao gồm case, màn hình, bàn phím', 1, 'Máy Tính 1.2'),
(3, '', '', '', 1, ''),
(6, 'bảo trì', 'Đây là cấu hình máy', 'Đây là phần cứng máy', 2, 'Tên Máy Tính 2.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `idMonHoc` int(11) NOT NULL,
  `nameMonHoc` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ngayBatDau` date DEFAULT NULL,
  `ngayKetThuc` date DEFAULT NULL,
  `soTiet` float DEFAULT NULL,
  `yeuCauPhongMay` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idGiaoVien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`idMonHoc`, `nameMonHoc`, `ngayBatDau`, `ngayKetThuc`, `soTiet`, `yeuCauPhongMay`, `idGiaoVien`) VALUES
(1, 'Môn Học 1', '2021-08-28', '2021-09-05', 21, 'Không có gì', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongmay`
--

CREATE TABLE `phongmay` (
  `idPhongMay` int(11) NOT NULL,
  `namePhongMay` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tinhTrang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `soLuongMay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phongmay`
--

INSERT INTO `phongmay` (`idPhongMay`, `namePhongMay`, `tinhTrang`, `soLuongMay`) VALUES
(1, 'Phòng máy 1', 'hoạt động', 30),
(2, 'Phòng máy 2', 'hoạt động', 40);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`idChucVu`);

--
-- Chỉ mục cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`idGiaoVien`),
  ADD KEY `idChucVu` (`idChucVu`);

--
-- Chỉ mục cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD PRIMARY KEY (`idLichHoc`),
  ADD KEY `idPhongMay` (`idPhongMay`),
  ADD KEY `idMonHoc` (`idMonHoc`);

--
-- Chỉ mục cho bảng `lichtruc`
--
ALTER TABLE `lichtruc`
  ADD PRIMARY KEY (`idLichTruc`),
  ADD KEY `idGiaoVien` (`idGiaoVien`),
  ADD KEY `idPhongMay` (`idPhongMay`);

--
-- Chỉ mục cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  ADD PRIMARY KEY (`idMayTinh`),
  ADD KEY `idPhongMay` (`idPhongMay`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`idMonHoc`),
  ADD KEY `idGiaoVien` (`idGiaoVien`);

--
-- Chỉ mục cho bảng `phongmay`
--
ALTER TABLE `phongmay`
  ADD PRIMARY KEY (`idPhongMay`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `idChucVu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `idGiaoVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  MODIFY `idLichHoc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lichtruc`
--
ALTER TABLE `lichtruc`
  MODIFY `idLichTruc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  MODIFY `idMayTinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `idMonHoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `phongmay`
--
ALTER TABLE `phongmay`
  MODIFY `idPhongMay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`idChucVu`) REFERENCES `chucvu` (`idChucVu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD CONSTRAINT `lichhoc_ibfk_1` FOREIGN KEY (`idPhongMay`) REFERENCES `phongmay` (`idPhongMay`),
  ADD CONSTRAINT `lichhoc_ibfk_2` FOREIGN KEY (`idMonHoc`) REFERENCES `monhoc` (`idMonHoc`);

--
-- Các ràng buộc cho bảng `lichtruc`
--
ALTER TABLE `lichtruc`
  ADD CONSTRAINT `lichtruc_ibfk_1` FOREIGN KEY (`idGiaoVien`) REFERENCES `giaovien` (`idGiaoVien`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lichtruc_ibfk_2` FOREIGN KEY (`idPhongMay`) REFERENCES `phongmay` (`idPhongMay`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  ADD CONSTRAINT `maytinh_ibfk_1` FOREIGN KEY (`idPhongMay`) REFERENCES `phongmay` (`idPhongMay`);

--
-- Các ràng buộc cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `monhoc_ibfk_1` FOREIGN KEY (`idGiaoVien`) REFERENCES `giaovien` (`idGiaoVien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
