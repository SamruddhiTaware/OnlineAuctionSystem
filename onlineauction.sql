-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 07:28 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `UID` varchar(120) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `ProductName` varchar(150) DEFAULT NULL,
  `BidAmount` int(100) DEFAULT NULL,
  `timestamp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`UID`, `productid`, `ProductName`, `BidAmount`, `timestamp`) VALUES
('tppg3d', 15, 'IphoneXS', 750, '1557552652'),
('zwjnt0', 16, 'Chair', 60, '1557630104'),
('tppg3d', 17, 'Jacket', 20, '1557624223'),
('zwjnt0', 18, 'Table', 70, '1557634892'),
('zwjnt0', NULL, NULL, NULL, '1557630032'),
('zwjnt0', NULL, NULL, NULL, '1557630049'),
('tppg3d', 19, 'Air Conditioner', 110, '1557678215');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` varchar(120) NOT NULL,
  `CategoryName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
('1', 'Furniture'),
('2', 'Footware'),
('3', 'Clothing'),
('4', 'Kitchenware'),
('5', 'Electronics'),
('6', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `UID` varchar(120) NOT NULL,
  `productid` int(11) NOT NULL,
  `ProductName` varchar(150) NOT NULL,
  `ProductDescription` varchar(150) DEFAULT NULL,
  `CategoryID` varchar(1000) DEFAULT NULL,
  `Price` varchar(20) DEFAULT NULL,
  `Curr_time` varchar(70) DEFAULT NULL,
  `Expiration_time` varchar(70) DEFAULT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `Active` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`UID`, `productid`, `ProductName`, `ProductDescription`, `CategoryID`, `Price`, `Curr_time`, `Expiration_time`, `Image`, `Active`) VALUES
('zwjnt0', 15, 'IphoneXS', 'New. ', '5', '700', '1557552393', '1557638793', 'images/image15iphonexs.jpg', '1'),
('4thodt', 16, 'Chair', 'Wooden chair. ', '1', '20', '1557589445', '1557762245', 'images/image16Chair.jpg', '1'),
('4thodt', 17, 'Jacket', 'Jacket', '3', '50', '1557593414', '1557628108', 'images/image17jacket.jpg', '1'),
('4thodt', 18, 'Table', 'Wooden Table. Good Condition.', '1', '30', '1557629777', '1557716177', 'images/image18Table.jpg', '1'),
('zwjnt0', 19, 'Air Conditioner', '', '5', '100', '1557638775', '1557725175', 'images/image19AirConditioner.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `UserID` varchar(120) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(1000) DEFAULT NULL,
  `MemberSince` varchar(255) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`UserID`, `UserName`, `FirstName`, `LastName`, `Email`, `Password`, `MemberSince`, `Active`, `role`) VALUES
('jh5if5', 'admin', 'admin', 'admin', 'admin@gmail.com', 'e961a44bd10d7e4589b27d1a793df084c0106c0192fa10df9e1bb2e7e1436b4ea', '1557705735', 1, 'admin'),
('tppg3d', 'PreetikaM', 'Preetika', 'Mittal', 'preetika@gmail.com', 'ed5e1f6c09d4381b7fcd2205d4604f2810e38aafa0076f9cae62ce73faf02413d', '1557552541', 1, NULL),
('4thodt', 'RohanT', 'Rohan', 'Tigadi', 'rohan@gmail.com', 'e628dcc9d8b27e54d3bc9b485101025c8569cb72e2e83dd03d03eb2882dedd55d', '1557552771', 1, NULL),
('zwjnt0', 'SamruddhiT', 'Samruddhi', 'Taware', 'samru.3011@gmail.com', '4b3774a3690b0788dd450a429160e56eac19437e276ca7955284a175983bad3e8', '1557551919', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`UserName`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
