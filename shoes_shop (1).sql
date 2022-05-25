-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 09:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `Bank_Name` varchar(255) NOT NULL,
  `Bank_Owner` varchar(255) NOT NULL,
  `Bank_Num` varchar(255) NOT NULL,
  `Bank_Branch` varchar(255) NOT NULL,
  `Bank_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`Bank_Name`, `Bank_Owner`, `Bank_Num`, `Bank_Branch`, `Bank_Type`) VALUES
('ไทยพาณิชย์', 'สุขกัญญา พระสมุทร', '6742364326', 'ตลิ่งชัน', 'ออมทรัพย์'),
('กรุงไทย', 'สุขกัญญา พระสมุทร', '6601545562', 'ตลิ่งชัน', 'ออมทรัพย์');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `Coupon_Code` varchar(255) NOT NULL,
  `Coupon_Price` int(255) NOT NULL,
  `Coupon_Quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`Coupon_Code`, `Coupon_Price`, `Coupon_Quantity`) VALUES
('Sale50', 50, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_ID` varchar(255) NOT NULL,
  `detail_size` int(255) NOT NULL,
  `detail_color` varchar(255) NOT NULL,
  `detail_qty` int(255) NOT NULL,
  `detail_subtotal` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `product_ID`, `detail_size`, `detail_color`, `detail_qty`, `detail_subtotal`) VALUES
(22, 53, 'Gw43106', 0, '', 1, 299),
(23, 54, 'Gw43106', 0, '', 1, 299),
(24, 55, 'Gw43106', 0, '', 1, 299),
(25, 56, 'Gw43106', 0, '', 1, 299),
(26, 57, 'Gw43106', 39, '', 1, 299),
(27, 57, 'Gw43107', 39, '', 1, 299),
(28, 57, 'GM12078', 39, '', 1, 299),
(29, 58, 'Gw43106', 39, '', 1, 299),
(30, 59, 'Gw43106', 39, 'ดำ', 1, 299);

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `order_id` int(255) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_phone` int(255) NOT NULL,
  `order_total` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`order_id`, `order_name`, `order_address`, `order_email`, `order_phone`, `order_total`, `order_status`, `order_owner`) VALUES
(8, 'Jack', 'บนโลก', 'jackza@j.com', 191, 648, 'พัสดุถูกจัดส่งเรียบร้อย', 'jack'),
(9, 'Jack', 'asdasd', 'asda@asd.com', 1515515, 648, 'ชำระเงินสำเร็จ', 'jack'),
(11, 'จันทนา', '37 ถ.มหาราช แขวงพระบรมมหาราชวัง', 'eiei@hotmail.com', 191, 349, 'พัสดุถูกจัดส่งเรียบร้อย', 'jack'),
(53, 'asdad', 'asdasd', 'asda@asd.com', 1515515, 349, 'ยังไม่ได้ชำระเงิน', 'jack'),
(54, 'asdasd', 'asdasd', 'asda@asd.com', 1515515, 349, 'รอตรวจสอบ', 'admin'),
(55, 'sadasd', 'asdasdas', 'asda@asd.com', 1515515, 349, 'ยังไม่ได้ชำระเงิน', 'admin'),
(56, 'asdas', 'sadasdas', 'asda@asd.com', 1515515, 349, 'ยังไม่ได้ชำระเงิน', 'admin'),
(57, 'asdasd', 'asdasd', 'asda@asd.com', 1515515, 947, 'รอตรวจสอบ', 'jack'),
(58, 'asdasd', 'adasdas', 'asda@asd.com', 1515515, 349, 'ชำระเงินสำเร็จ', 'jack'),
(59, 'asdasd', 'asdasd', 'asda@asd.com', 1515515, 349, 'ชำระเงินสำเร็จ', 'jack');

-- --------------------------------------------------------

--
-- Table structure for table `payment_order`
--

CREATE TABLE `payment_order` (
  `payment_id` int(255) NOT NULL,
  `payment_owner` varchar(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `payment_total` int(255) NOT NULL,
  `payment_bank` varchar(255) NOT NULL,
  `payment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_order`
--

INSERT INTO `payment_order` (`payment_id`, `payment_owner`, `order_id`, `payment_total`, `payment_bank`, `payment_img`) VALUES
(1, '', 8, 648, 'กรุงเทพ', 'young-man-observing-laptop-with-magnifying-glass-job-search-job-search-concept.jpg'),
(2, 'admin', 7, 648, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(3, 'jack', 9, 648, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(4, 'jack', 11, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(5, 'jack', 12, 947, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(6, 'jack', 12, 947, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(7, 'jack', 8, 648, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(8, 'jack', 8, 648, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(9, 'jack', 36, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(10, 'jack', 36, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(11, 'jack', 43, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(12, 'jack', 46, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(13, 'admin', 54, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(14, 'jack', 57, 947, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(15, 'jack', 58, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg'),
(16, 'jack', 59, 349, 'กรุงเทพ', '242877457_577426066905268_7080129664423204854_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `postcode_detail`
--

CREATE TABLE `postcode_detail` (
  `postcode_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `postcode_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postcode_detail`
--

INSERT INTO `postcode_detail` (`postcode_id`, `order_id`, `postcode_code`) VALUES
(1, 11, 'KFC1150'),
(3, 8, '5678');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_Name` varchar(255) NOT NULL,
  `Report_Phone` varchar(255) NOT NULL,
  `Report_Email` varchar(255) NOT NULL,
  `Report_Topic` varchar(255) NOT NULL,
  `Report_Detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`Report_Name`, `Report_Phone`, `Report_Email`, `Report_Topic`, `Report_Detail`) VALUES
('asdasd', 'asdasd', 'ad@asd.com', 'asdasd', ''),
('ฟหกฟห', '123', 'sda@see.com', 'asdasdas', 'asdasd'),
('asdasd', 'asdas', 'asd@asd.com', 'asdasd', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_ID` int(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Forbuy` int(255) NOT NULL,
  `Forsell` int(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Detail` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_ID`, `Code`, `Name`, `Forbuy`, `Forsell`, `Type`, `Detail`, `Img`) VALUES
(1, 'Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 150, 299, 'men', 'น้ำหนักเบา สะดวก กันน้ำ พร้อมลุยไปทุกๆที่', 'Gw43106.webp'),
(2, 'Gw43107', 'รองเท้าแตะแตะชาย รุ่นGm/Gw43107', 150, 299, 'men', 'น้ำหนักเบา สะดวก กันน้ำ พร้อมลุยไปทุกๆที่', 'Gw43107.webp'),
(3, 'GM12078', 'รองเท้าแตะแตะชาย รุ่นGm/GM12078', 150, 299, 'men', 'น้ำหนักเบา สะดวก กันน้ำ พร้อมลุยไปทุกๆที่', 'GM12078.webp'),
(4, 'GM11276', 'รองเท้าแตะแตะเดินชิว', 250, 399, 'men', 'น้ำหนักเบา สะดวก กันน้ำ พร้อมลุยไปทุกๆที่', 'GM11276.webp'),
(5, 'Gw120093', 'รองเท้าแตะแตะเดินชิวริมหาดทราย', 250, 399, 'men', 'น้ำหนักเบา สะดวก กันน้ำ พร้อมลุยไปทุกๆที่', 'Gw120093.webp'),
(6, 'Gk120966', 'รองเท้าสลิปออน', 250, 499, 'men', 'ใส่ง่าย ใส่สบาย น้ำหนักเบา เหมาะสำหรับทุกคน', 'Gk120966.webp'),
(7, 'Gk120777', 'รองเท้าผ้าใบพร้อมออกกำลังกาย', 250, 499, 'men', 'ใส่ปุ้บเล่นกีฬาเก่งปั้บ', 'Gk120777.webp'),
(8, 'Gw120088', 'รองเท้าหูหนีบหลายสี หลายสไตล์', 150, 299, 'men', 'ใส่ปุ้บเล่นกีฬาเก่งปั้บ', 'Gw120088.webp'),
(9, 'Gw120069', 'รองเท้าหูหนีบ/Gw120069', 150, 299, 'men', 'พร้อมลุยทุกที่ เท่ทุกเวลา', 'Gw120069.webp'),
(10, 'WM001', 'รองเท้าแตะลายวัว ', 89, 199, 'สินค้าผู้หญิง', 'รองเท้าน้ำหนักเบา ใส่ง่ายใส่สบาย ลายน้อลวัว', 'WM001.webp'),
(11, 'WM002', 'รองเท้าแตะขัดสีผิวพื้นหนัง', 89, 199, 'women', 'รองเท้าสไตล์มินิมอล สีนอมอลสวยๆเกร๋ๆ', 'WM002.webp'),
(12, 'WM003', 'รองเท้าแตะน้องหมีสุดน่ารัก', 89, 199, 'women', 'รองเท้าน้องหมีสุดแสนน่ารัก', 'WM003.webp'),
(13, 'WM004', 'รองเท้าแตะดอกเดซี่', 89, 199, 'women', 'รองเท้าดอกเดซี่ พื้นนุ่ม ใส่สบาย', 'WM004.webp'),
(14, 'WM005', 'รองเท้าแตะบ๊อบบี้', 89, 199, 'women', 'รองเท้าแตะบ๊อบบี้ ดูหรู ใส่สบาย', 'WM005.webp'),
(15, 'WM006', 'รองเท้าแตะหูไขว้', 89, 199, 'women', 'รองเท้าแตะหูไขว้ ใส่ง่าย เดินสบาย', 'WM006.webp'),
(16, 'WM007', 'รองเท้ารัดส้นสีดำ', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM007.webp'),
(17, 'WM008', 'รองเท้าส้นแหลมสีนูด', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM008.webp'),
(18, 'WM009', 'รองเท้ารัดส้นลายดอกไม้', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM009.webp'),
(19, 'WM010', 'รองเท้ารัดส้นลายเงา', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM010.webp'),
(20, 'WM011', 'รองเท้ารัดส้นสายคาดไขว้', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM011.webp'),
(21, 'WM012', 'รองเท้ารัดส้นลายโบว์', 159, 299, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM012.webp'),
(22, 'WM013', 'รองเท้าผ้าใบสีลายสายรุ้ง', 259, 390, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM013.webp'),
(23, 'WM014', 'รองเท้าผ้าใบแทคสีชมพู', 259, 390, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM014.webp'),
(24, 'WM015', 'รองเท้าผ้าใบลายการ์ตูน', 259, 390, 'women', 'ดูหรู ใส่ง่าย เดินสบาย', 'WM015.webp'),
(25, 'K001', 'รองเท้าเด็กเล็กลายการ์ตูน', 89, 199, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K001.webp'),
(26, 'K002', 'รองเท้าเด็กเล็กลายผลไม้', 89, 199, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K002.webp'),
(27, 'K003', 'รองเท้าเด็กพื้นถักลายโบว์', 189, 299, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K003.webp'),
(28, 'K004', 'รองเท้าเด็กสไตล์กีฬา', 189, 299, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K004.webp'),
(29, 'K005', 'รองเท้าเด็กVans', 209, 399, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K005.webp'),
(30, 'K006', 'รองเท้าผ้าใบ', 209, 399, 'kid', 'รองเท้าเด็กสุดแสนจะน่ารัก พร้อมส่งสุดๆ', 'K006.webp');

-- --------------------------------------------------------

--
-- Table structure for table `stock_popular`
--

CREATE TABLE `stock_popular` (
  `popular_ID` int(255) NOT NULL,
  `product_ID` int(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Forsell` int(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_popular`
--

INSERT INTO `stock_popular` (`popular_ID`, `product_ID`, `Code`, `Name`, `Forsell`, `Type`, `Img`) VALUES
(13, 1, 'Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 299, 'สินค้าผู้ชาย', 'Gw43106.webp'),
(14, 2, 'Gw43107', 'รองเท้าแตะแตะชาย รุ่นGm/Gw43107', 299, 'สินค้าผู้ชาย', 'Gw43107.webp'),
(15, 10, 'WM001', 'รองเท้าแตะลายวัว ', 199, 'สินค้าผู้หญิง', 'WM001.webp'),
(16, 25, 'K001', 'รองเท้าเด็กเล็กลายการ์ตูน', 199, 'สินค้าเด็ก', 'K001.webp');

-- --------------------------------------------------------

--
-- Table structure for table `stock_product`
--

CREATE TABLE `stock_product` (
  `Code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Size` int(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Quatity` int(255) NOT NULL,
  `Forsell` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_product`
--

INSERT INTO `stock_product` (`Code`, `Name`, `Size`, `Color`, `Quatity`, `Forsell`) VALUES
('Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 39, 'ดำ', 8, 299),
('Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 40, 'ดำ', 9, 299),
('Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 41, 'ดำ', 15, 299),
('Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 42, 'ดำ', 14, 299),
('WM001', 'รองเท้าแตะลายวัว ', 39, 'ดำ', 10, 199),
('Gw43106', 'รองเท้าแตะลำลองชาย รุ่นGM/Gw43106', 40, 'ดำ', 9, 299),
('WM002', 'รองเท้าแตะขัดสีผิวพื้นหนัง', 39, 'ดำ', 10, 199),
('Gw43107', 'รองเท้าแตะแตะชาย รุ่นGm/Gw43107', 39, 'ดำ', 10, 299),
('GM12078', 'รองเท้าแตะแตะชาย รุ่นGm/GM12078', 39, 'ดำ', 10, 299);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(255) NOT NULL,
  `User_Username` varchar(255) NOT NULL,
  `User_Firstname` varchar(255) NOT NULL,
  `User_Lastname` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Phone` int(255) NOT NULL,
  `User_Address` varchar(255) NOT NULL,
  `User_Tambon` varchar(255) NOT NULL,
  `User_Amphoe` varchar(255) NOT NULL,
  `User_Province` varchar(255) NOT NULL,
  `User_Zipcode` int(255) NOT NULL,
  `User_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `User_Username`, `User_Firstname`, `User_Lastname`, `User_Password`, `User_Email`, `User_Phone`, `User_Address`, `User_Tambon`, `User_Amphoe`, `User_Province`, `User_Zipcode`, `User_Status`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@hotmail.com', 0, 'admin', '', '', '', 0, 'Admin'),
(4, 'ohm', 'ohm', 'ohm', 'ohm', 'ohm@hotmail.com', 0, 'ohmohm', '', '', '', 0, 'Admin'),
(5, 'golf', 'กอล์ฟ', 'มาแล้ว', '1234', 'golf@inw.com', 0, 'บนโลกนี้', '', '', '', 0, 'User'),
(6, 'ohmza', 'โอม', 'โอมซ่า', '1234', 'ohmza@hotmail.com', 0, 'ดาวเคราะห์', '', '', '', 0, 'Admin'),
(7, 'jack', 'แจ๊ค', 'แฟนฉัน', '1234', 'jackza@hotmail.com', 678910, '12/32 หมู่ 3', 'บางกระเจ้า', 'บางกระเจ้า', 'สมุทรสาคร', 74000, 'User'),
(8, 'testuser', 'เทส', 'ยูเซอร์', '1234', 'testuser@hotmail.com', 0, '111 จู่โจม กรุงเทพ 11111', '', '', '', 0, 'User'),
(9, 'fan', 'แฟน', 'ฉัน', '1234', 'fan@hotmail.com', 191, '111 ดาวดึง', 'ไก่โต้ง', 'ไก่โต้ง', 'กรุงเทพ', 11111, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_order`
--
ALTER TABLE `payment_order`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `postcode_detail`
--
ALTER TABLE `postcode_detail`
  ADD PRIMARY KEY (`postcode_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `stock_popular`
--
ALTER TABLE `stock_popular`
  ADD PRIMARY KEY (`popular_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `payment_order`
--
ALTER TABLE `payment_order`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `postcode_detail`
--
ALTER TABLE `postcode_detail`
  MODIFY `postcode_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `product_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `stock_popular`
--
ALTER TABLE `stock_popular`
  MODIFY `popular_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
