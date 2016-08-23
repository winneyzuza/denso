-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2015 at 02:09 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `denso_imv`
--

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_id` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_eng` text COLLATE utf8_unicode_ci,
  `name_th` text COLLATE utf8_unicode_ci,
  `region_name_eng` text COLLATE utf8_unicode_ci,
  `region_name_th` text COLLATE utf8_unicode_ci,
  `region_code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province_id`, `name_eng`, `name_th`, `region_name_eng`, `region_name_th`, `region_code`) VALUES
(1, 'P0001', 'BANGKOK', 'กรุงเทพฯ', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(2, 'P0002', 'CHACHOENGSAO', 'ฉะเชิงเทรา', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(3, 'P0003', 'LAO', 'ลาว', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(4, 'P0004', 'NAKHONPATHOM', 'นครปฐม', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(5, 'P0005', 'NONTHABURI', 'นนทบุรี', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(6, 'P0006', 'PRATHUMTHANI', 'ปทุมธานี', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(7, 'P0007', 'SAMUTPRAKARN', 'สมุทรปราการ', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(8, 'P0008', 'SAMUTSAKHON', 'สมุทรสาคร', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(9, 'P0009', 'SAMUTSONGKHAM', 'สมุทรสงคราม', 'BKK', 'กรุงเทพและปริมณฑล', 'BKK'),
(10, 'P0010', 'ANGTHONG', 'อ่างทอง', 'Central', 'กลาง', 'C'),
(11, 'P0011', 'AYUTTHAYA', 'อยุธยา', 'Central', 'กลาง', 'C'),
(12, 'P0012', 'CHAINAT', 'ชัยนาท', 'Central', 'กลาง', 'C'),
(13, 'P0013', 'KANCHANABURI', 'กาญจนบุรี', 'Central', 'กลาง', 'C'),
(14, 'P0014', 'LOPBURI', 'ลพบุรี', 'Central', 'กลาง', 'C'),
(15, 'P0015', 'NAKHONPATHOM', 'นครปฐม', 'Central', 'กลาง', 'C'),
(16, 'P0016', 'PETCHBURI', 'เพชรบุรี', 'Central', 'กลาง', 'C'),
(17, 'P0017', 'PRACHUABKHIRIKHAN', 'ประจวบคีรีขันธ์', 'Central', 'กลาง', 'C'),
(18, 'P0018', 'RATCHBURI', 'ราชบุรี', 'Central', 'กลาง', 'C'),
(19, 'P0019', 'SARABURI', 'สระบุรี', 'Central', 'กลาง', 'C'),
(20, 'P0020', 'SINGBURI', 'สิงห์บุรี', 'Central', 'กลาง', 'C'),
(21, 'P0021', 'SUPHANBURI', 'สุพรรณบุรี', 'Central', 'กลาง', 'C'),
(22, 'P0022', 'CHANTHABURI', 'จันทบุรี', 'East', 'ตะวันออก', 'E'),
(23, 'P0023', 'CHONBURI', 'ชลบุรี', 'East', 'ตะวันออก', 'E'),
(24, 'P0024', 'PRACHEENBURI', 'ปราจีนบุรี', 'East', 'ตะวันออก', 'E'),
(25, 'P0025', 'RAYONG', 'ระยอง', 'East', 'ตะวันออก', 'E'),
(26, 'P0026', 'SRAKAEW', 'สระแก้ว', 'East', 'ตะวันออก', 'E'),
(27, 'P0027', 'CHIANGMAI', 'เชียงใหม่', 'North', 'เหนือ', 'N'),
(28, 'P0028', 'CHIANGRAI', 'เชียงราย', 'North', 'เหนือ', 'N'),
(29, 'P0029', 'KAMPHAENGPHET', 'กำแพงเพชร', 'North', 'เหนือ', 'N'),
(30, 'P0030', 'LAMPANG', 'ลำปาง', 'North', 'เหนือ', 'N'),
(31, 'P0031', 'LAMPOON', 'ลำพูน', 'North', 'เหนือ', 'N'),
(32, 'P0032', 'MAEHONGSORN', 'แม่ฮ่องสอน', 'North', 'เหนือ', 'N'),
(33, 'P0033', 'NAKHONSAWAN', 'นครสวรรค์', 'North', 'เหนือ', 'N'),
(34, 'P0034', 'NAN', 'น่าน', 'North', 'เหนือ', 'N'),
(35, 'P0035', 'PAYAO', 'พะเยา', 'North', 'เหนือ', 'N'),
(36, 'P0036', 'PETCHBOON', 'เพชรบูรณ์', 'North', 'เหนือ', 'N'),
(37, 'P0037', 'PHRAE', 'แพร่', 'North', 'เหนือ', 'N'),
(38, 'P0038', 'PIJIT', 'พิจิตร', 'North', 'เหนือ', 'N'),
(39, 'P0039', 'PITSANULOKE', 'พิษณุโลก', 'North', 'เหนือ', 'N'),
(40, 'P0040', 'SUKHOTHAI', 'สุโขทัย', 'North', 'เหนือ', 'N'),
(41, 'P0041', 'TAK', 'ตาก', 'North', 'เหนือ', 'N'),
(42, 'P0042', 'UTHAITHANI', 'อุทัยธานี', 'North', 'เหนือ', 'N'),
(43, 'P0043', 'UTTARADIT', 'อุตรดิตถ์', 'North', 'เหนือ', 'N'),
(44, 'P0044', 'AMNATCHAROEN', 'อำนาจเจริญ', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(45, 'P0045', 'BURIRUM', 'บุรีรัมย์', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(46, 'P0046', 'CHAIYAPOOM', 'ชัยภูมิ', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(47, 'P0047', 'KALASIN', 'กาฬสินธ์', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(48, 'P0048', 'KHONKAEN', 'ขอนแก่น', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(49, 'P0049', 'LOEY', 'เลย', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(50, 'P0050', 'MAHASARAKAM', 'มหาสารคาม', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(51, 'P0051', 'MUKDAHAN', 'มุกดาหาร', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(52, 'P0052', 'NAKHONNAYOK', 'นครนายก', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(53, 'P0053', 'NAKHONPANOM', 'นครพนม', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(54, 'P0054', 'NAKHONRATCHSIMA', 'นครราชสีมา', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(55, 'P0055', 'NHONGBUALHAMPHU', 'หนองบัวลำภู ', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(56, 'P0056', 'NONGKHAI', 'หนองคาย', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(57, 'P0057', 'ROIET', 'ร้อยเอ็ด', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(58, 'P0058', 'SAKHONNAKHON', 'สกลนคร', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(59, 'P0059', 'SISAKET', 'ศรีสะเกษ', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(60, 'P0060', 'SURIN', 'สุรินทร์', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(61, 'P0061', 'UBONRATCHATHANI', 'อุบลราชธานี', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(62, 'P0062', 'UDONTHANI', 'อุดรธานี', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(63, 'P0063', 'YASOTHON', 'ยโสธร', 'Northeast', 'ตะวันออกเฉียงเหนือ', 'N-E'),
(64, 'P0064', 'CHUMPORN', 'ชุมพร', 'South', 'ใต้', 'S'),
(65, 'P0065', 'KRABI', 'กระบี่', 'South', 'ใต้', 'S'),
(66, 'P0066', 'NAKHONSRITHAMMARAT', 'นครศรีธรรมราช', 'South', 'ใต้', 'S'),
(67, 'P0067', 'NARATHIWAT', 'นราธิวาส', 'South', 'ใต้', 'S'),
(68, 'P0068', 'PANG-NGA', 'พังงา', 'South', 'ใต้', 'S'),
(69, 'P0069', 'PATTALUNG', 'พัทลุง', 'South', 'ใต้', 'S'),
(70, 'P0070', 'PATTANI', 'ปัตตานี', 'South', 'ใต้', 'S'),
(71, 'P0071', 'PHUKET', 'ภูเก็ต', 'South', 'ใต้', 'S'),
(72, 'P0072', 'RANONG', 'ระนอง', 'South', 'ใต้', 'S'),
(73, 'P0073', 'SATUL', 'สตูล', 'South', 'ใต้', 'S'),
(74, 'P0074', 'SONGKHLA', 'สงขลา', 'South', 'ใต้', 'S'),
(75, 'P0075', 'SURATTHANI', 'สุราษฏ์ธานี', 'South', 'ใต้', 'S'),
(76, 'P0076', 'TRUNG', 'ตรัง', 'South', 'ใต้', 'S'),
(77, 'P0077', 'YARA', 'ยะลา', 'South', 'ใต้', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
