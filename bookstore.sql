-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2021 lúc 04:11 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--
CREATE DATABASE IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bookstore`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `masach` char(10) NOT NULL,
  `tensach` varchar(100) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `giasach` int(11) NOT NULL,
  `nxb` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `nhacungcap` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vitri` int(11) NOT NULL,
  `anh` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinhthucbia` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tacgia` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`masach`, `tensach`, `giasach`, `nxb`, `nhacungcap`, `vitri`, `anh`, `hinhthucbia`, `tacgia`) VALUES
('ms1', 'Những Cô Gái Mất Tích', 125400, 'NXB Thanh Niên', '1980 Books', 2, 'cogaimattich.jpg', 'Bìa Mềm', 'Megan Miranda'),
('ms10', 'Goth - Những Kẻ Hắc Ám (Tái Bản 2019)', 89600, 'NXB Hà Nội', 'Nhã Nam', 2, 'goth.jpg', 'Bìa Mềm', 'Otsuichi'),
('ms11', 'Hạnh Ngộ Trong Bóng Tối', 89640, 'NXB Hà Nội', 'Nhã Nam', 2, 'hanhngo.jpg', 'Bìa Cứng', 'Otsuichi'),
('ms12', 'Bố Già (Đông A)', 88000, 'NXB Dân Đầu Cặc', 'Đông A', 1, 'bogia.jpg', 'Bìa Cứng', 'Mario Puzo'),
('ms2', 'Nhà Giả Kim (Tái Bản 2020)', 67150, 'NXB Hội Nhà Văn', 'Nhã Nam', 1, 'nhagiakim.jpg', 'Bìa Mềm', 'Paulo Coelho'),
('ms3', 'Ngôi Làng Cổ Mộ', 159200, 'NXB Hội Nhà Văn', 'CÔNG TY TNHH SÁCH & TRUYỀN THÔNG VIỆT NAM', 1, 'ngoilangcomo.jpg', 'Bìa Mềm', 'Thục Linh'),
('ms4', 'Đắc Nhân Tâm (Khổ Lớn) (Tái Bản)', 59280, 'NXB Tổng Hợp TPHCM', 'FIRST NEWS', 1, 'nhantam.jpg', 'Bìa Cứng', 'Dale Carnegie'),
('ms5', 'Hoàng Tử Bé (Bản Minh Hoạ Màu Việt - Bìa Cứng)', 124800, 'NXB Kim Đồng', 'Nhà Xuất Bản Kim Đồng', 2, 'hoangtube.jpg', 'Bìa Cứng', 'Saint Exupéry'),
('ms6', 'Cho Tôi Xin Một Vé Đi Tuổi Thơ (Bìa Mềm) (Tái Bản 2018)', 64000, 'NXB Trẻ', 'NXB Trẻ', 2, 'tuoitho.jpg', 'Bìa Mềm', 'Nguyễn Nhật Ánh'),
('ms7', 'Cuốn Theo Chiều Gió (Bìa Cứng)', 171600, 'NXB Văn Học', 'Nhà Sách Minh Thắng', 1, 'chieugio.jpg', 'Bìa Cứng', 'Margaret Mitchell'),
('ms8', 'Đồi Gió Hú (Bìa Cứng) - Tái Bản 2020', 96000, 'NXB Văn Học', 'Nhà Sách Minh Thắng', 2, 'doigiohu.jpg', 'Bìa Cứng', 'Emily Dronte'),
('ms9', 'Hành Lang U Tối - Down A Dark Hall', 66500, 'NXB Kim Đồng', 'Nhà Xuất Bản Kim Đồng', 2, 'hanhlang.jpg', 'Bìa Mềm', 'Lois Duncan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `tendangnhap` char(50) NOT NULL,
  `masach` char(10) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`tendangnhap`, `masach`, `soluong`) VALUES
('duchung', 'ms1', 3),
('duchung', 'ms11', 2),
('vuhau', 'ms2', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `sdt` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `huyen` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `xa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mauser` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `masach` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tongtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `tenkh`, `sdt`, `tinh`, `huyen`, `xa`, `diachi`, `mauser`, `masach`, `tongtien`) VALUES
('55946446', 'Trần Đức Hưng', '0985789999', 'TP. Hồ Chí Minh', 'Quận 7', 'Phường Tân Phong', '19 Nguyễn Hữu Thọ', 'duchung', 'ms1', 555480),
('55946446', 'Trần Đức Hưng', '0985789999', 'TP. Hồ Chí Minh', 'Quận 7', 'Phường Tân Phong', '19 Nguyễn Hữu Thọ', 'duchung', 'ms11', 555480);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tennv` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gioitinh` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `vitri` int(11) NOT NULL,
  `chucvu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `tennv`, `gioitinh`, `ngaysinh`, `vitri`, `chucvu`) VALUES
('nv1', 'Trần Đức Hưng', 'Nam', '2001-08-20', 1, 'Nhân Viên Đại Lý'),
('nv2', 'Nguyễn Sang Sinh', 'Nam', '2001-12-23', 1, 'Nhân Viên Hỗ Trợ'),
('nv3', 'Vũ Trung Hậu', 'Nam', '2001-12-13', 1, 'Nhân Viên Đai Lý'),
('nv4', 'Nguyễn Hữu Huy', 'Nam', '2001-07-23', 2, 'Nhân Viên Đại lý'),
('nv5', 'Dương Bảo Thi', 'Nữ', '2001-01-01', 2, 'Nhân Viên Hỗ Trợ'),
('nv6', 'Dương Thị Bảo Ngọc', 'Nữ', '2001-01-04', 2, 'Nhân Viên Đại Lý'),
('nv7', 'Nguyễn Lưu Thanh Hằng', 'Nữ', '2001-06-02', 2, 'Nhân Viên Hỗ Trợ'),
('nv8', 'Vương Ngọc Trang Đài', 'Nữ', '2001-07-02', 1, 'Nhân Viên Đại Lý'),
('nv9', 'Hoàng Vân Anh', 'Nữ', '2001-06-04', 1, 'Nhân Viên Hỗ Trợ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `tendangnhap` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `sdt` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`tendangnhap`, `matkhau`, `hoten`, `ngaysinh`, `sdt`, `type`) VALUES
('baothi', '$2y$10$t.QkMrhQjI3tV5K4nC5JhugQPlPJZ/rHY/Qw9xDsz20UIBZwZs/qq', 'Dương Bảo Thi', '2001-01-01', '0986445727', 2),
('duchung', '$2y$10$R9WqLJtRi1s9qLJPQgy4fuZmWy5O4pZkz6lbwKYRAZbNnHMfR7j72', 'Trần Đức Hưng', '2021-04-18', '0965756566', 2),
('huuhuy', '$2y$10$5Zki/ePOK2tFlJnhzx/mjelVZA4LfUn.kKLRTMLTkyXTvi2YsFt8y', 'Nguyễn Hữu Huy', '2001-07-23', '0987432112', 2),
('quanlycuahang1', '$2y$10$FABD/IRDUIVpe.MWX1ROpeHUK3/1R2EIsJwOwrFmSYlFr92d/8g3m', 'Người Quản Lý 1', '2001-02-20', '0968484343', 3),
('quanlycuahang2', '$2y$10$01vlMiqETs.mbdOwYZLCSO8zg3Brf0QtEhQX.rAIYX.dWpWtye7He', 'Người Quản Lý 2', '2001-08-02', '0968868653', 4),
('sangsinh', '$2y$10$8BX6ViwZiaP1vVPy5ZIMn.6zOogs6nMFEzUEbWDZynfZXzSsTdsQW', 'Nguyễn Sang Sinh', '2001-12-23', '0968686886', 2),
('tongquanly', '$2y$10$0/WwNLqEJ8dALTETDMQvzO5EyTMDG8/82Tc2Lm9hoNUKueS7d/x9.', 'Tổng quản lý', '2001-10-06', '0976653228', 1),
('vuhau', '$2y$10$u7fd6ciAPiCtlSHuPbnpp.pXsMaKWmVWRw2AOa9KZBCa7CEyDXbNS', 'Vũ Trung Hậu', '2001-12-13', '0968372722', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`masach`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`tendangnhap`,`masach`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`,`mauser`,`masach`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`tendangnhap`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
