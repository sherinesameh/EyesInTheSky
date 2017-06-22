-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2017 at 11:27 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EITS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `Admin_id` int(10) NOT NULL,
  `Admin_username` varchar(70) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(70) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Join_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text NOT NULL,
  `Phone_num` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Admin_id`, `Admin_username`, `Fname`, `Lname`, `Email`, `Password`, `Join_Date`, `image`, `Phone_num`) VALUES
(1, 'Yamen94', 'Yamen', 'Emad', 'yamenemad4@gmail.com', '123123', '2017-03-17 22:43:53', 'yamen.jpg', '01113747034'),
(2, 'Sherine2017', 'sherine', 'sameh', 'sherineSameh@gmail.com', '42537766', '2017-03-19 08:15:17', 'x.png', '01111134242'),
(3, 'Farida2017', 'Farida', 'menisy', 'Farida@gmail.com', '123123', '2017-03-19 08:18:55', 'x.png', '01111134242'),
(4, 'Sherif2017', 'Sherif', 'Hosny', 'Sherif@gmail.com', '123123', '2017-03-19 08:18:55', 'x.png', '01111134242'),
(5, 'boshra2017', 'boshra', 'kandil', 'boshra@gmail.com', '123123', '2017-03-19 08:18:56', 'x.png', '01111134242'),
(6, 'yara2017', 'yara', 'khaled', 'yara@gmail.com', '123123', '2017-03-19 08:18:56', 'x.png', '01111134242'),
(7, 'mayar2017', 'mayar', 'salaah', 'mayar@gmail.com', '123123', '2017-03-19 08:18:56', 'x.png', '01111134242');

-- --------------------------------------------------------

--
-- Table structure for table `Admin_Log`
--

CREATE TABLE `Admin_Log` (
  `Admin_id` int(10) NOT NULL,
  `The_Actions` varchar(40) DEFAULT NULL,
  `Mac` varchar(50) NOT NULL,
  `Action_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cont_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Code_index`
--

CREATE TABLE `Code_index` (
  `Action` varchar(30) NOT NULL,
  `Code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Code_index`
--

INSERT INTO `Code_index` (`Action`, `Code`) VALUES
('general', 10794),
('Not totally important', 11111),
('Shutdown Pi', 12030),
('Not Found', 20202),
('Added Task', 20794),
('Closed', 22198),
('Running', 22894),
('Restart Pi', 23456),
('kill Process', 27693),
('Not Important', 33333),
('User', 40307),
('Important', 55555),
('Delete Criminal', 56489),
('Found', 76767),
('Highly Important', 77777),
('Government', 80702),
('RaspberryPi', 90201),
('Admin', 90901),
('Add criminal', 98312),
('Extremly Important', 99999);

-- --------------------------------------------------------

--
-- Table structure for table `Criminals`
--

CREATE TABLE `Criminals` (
  `Crim_id` int(10) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(70) NOT NULL,
  `Dir_path` text,
  `priority` int(5) NOT NULL,
  `expiry_date` date NOT NULL,
  `image` text NOT NULL,
  `Status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Criminals`
--

INSERT INTO `Criminals` (`Crim_id`, `Mname`, `Fname`, `Lname`, `Dir_path`, `priority`, `expiry_date`, `image`, `Status`) VALUES
(1, 'mohamed', 'mayar', 'salah', 'tests', 3232, '0000-00-00', '', 0),
(2, 'sherif', 'mohamed', 'hosny', 'test', 5, '0000-00-00', 'test.png', 0),
(5, 'ahmed', 'hany', 'wagih', '10794', 10794, '0000-00-00', 'test.png', 0),
(6, 'mohamed', 'sherine', 'sameh', 'test', 3, '0000-00-00', 'test.png', 0),
(7, 'khaled', 'yara', 'ibrahim', 'test', 1194, '0000-00-00', 'test.png', 0),
(8, 'seka', 'hossam', 'ahmed', 'test', 55555, '0000-00-00', 'x.png', 20202),
(9, 'seka', 'hossam', 'ahmed', 'test', 55555, '2017-06-23', 'x.png', 20202);

-- --------------------------------------------------------

--
-- Table structure for table `Current_Specs`
--

CREATE TABLE `Current_Specs` (
  `Mac` varchar(50) NOT NULL,
  `PrivateIP` varchar(50) NOT NULL,
  `FreeStorage` float NOT NULL,
  `CpuUsage` float NOT NULL,
  `RamUsage` float NOT NULL,
  `Temperature` float NOT NULL,
  `State` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Current_Specs`
--

INSERT INTO `Current_Specs` (`Mac`, `PrivateIP`, `FreeStorage`, `CpuUsage`, `RamUsage`, `Temperature`, `State`) VALUES
('255.255.170', '', 512, 45, 0, 31, 22894),
('255.255.203', '', 900, 56, 0, 20, 22198),
('255.255.255', '', 190, 79, 0, 34, 22894),
('255.255.255.1', '', 2048, 50, 0, 30, 22894),
('255.255.255.10', '', 4120, 48, 0, 49, 22894),
('255.255.255.11', '', 2048, 50, 0, 47, 22894),
('255.255.255.12', '', 2048, 35, 0, 29, 22894),
('255.255.255.13', '', 6031, 40, 0, 36, 22894),
('255.255.255.14', '', 2048, 73, 0, 64, 22894),
('255.255.255.15', '', 2048, 80, 0, 69, 22894),
('255.255.255.16', '', 2048, 58, 0, 44, 22894),
('255.255.255.17', '', 2048, 60, 0, 52, 22894),
('255.255.255.18', '', 2048, 50, 0, 30, 22894),
('255.255.255.2', '', 2048, 35, 0, 26, 22894),
('255.255.255.3', '', 2048, 50, 0, 45, 22894),
('255.255.255.4', '', 2048, 50, 0, 37, 22894),
('255.255.255.6', '', 2048, 85, 0, 74, 22894),
('255.255.255.7', '', 2048, 35, 0, 39, 22894),
('255.255.255.8', '', 2048, 26, 0, 54, 22894),
('255.255.255.9', '', 3540, 60, 0, 51, 22894),
('b8:27:eb:8d:24:80', '', 8000, 0, 0, 10, 22894),
('b8:27:eb:f5:d6:1c', '192.168.1.33 172.17.0.1 ', 36.6, 1.1, 14, 37, 22894);

-- --------------------------------------------------------

--
-- Table structure for table `Government`
--

CREATE TABLE `Government` (
  `Gov_id` int(10) NOT NULL,
  `Gov_username` varchar(70) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(70) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `authority` int(5) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Government`
--

INSERT INTO `Government` (`Gov_id`, `Gov_username`, `Fname`, `Lname`, `Email`, `Password`, `authority`, `image`) VALUES
(1, 'farida94', 'yamenn', 'menisy', 'farida@gmail.com', '123123', 10194, 'test.png'),
(2, 'yamen94', 'yamen', 'emad', 'yamen@gmail.com', '123123', 10794, 'x.png');

-- --------------------------------------------------------

--
-- Table structure for table `Gov_Log`
--

CREATE TABLE `Gov_Log` (
  `Gov_id` int(10) NOT NULL,
  `Gov_username` varchar(70) NOT NULL,
  `Action` int(5) NOT NULL,
  `Start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Crim_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Gov_Log`
--

INSERT INTO `Gov_Log` (`Gov_id`, `Gov_username`, `Action`, `Start_time`, `Crim_id`) VALUES
(1, 'farida', 98312, '2017-03-23 14:14:58', 5),
(1, 'farida', 98312, '2017-03-23 14:26:33', 6),
(1, 'farida', 56489, '2017-03-23 14:30:14', 5),
(1, 'farida', 56489, '2017-03-23 14:31:31', 5),
(1, 'farida', 56489, '2017-03-23 14:37:29', 5);

-- --------------------------------------------------------

--
-- Table structure for table `IPs`
--

CREATE TABLE `IPs` (
  `Mac` varchar(50) NOT NULL,
  `IpAddress` varchar(30) NOT NULL,
  `Rpi_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Process`
--

CREATE TABLE `Process` (
  `Img_id` int(20) NOT NULL,
  `Process_name` varchar(40) NOT NULL,
  `Cont_id` int(20) NOT NULL,
  `Cont_IP` varchar(20) NOT NULL,
  `Mac` varchar(50) NOT NULL,
  `User_id` int(20) NOT NULL,
  `Start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Process_State` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Rp_Log`
--

CREATE TABLE `Rp_Log` (
  `Mac` varchar(50) NOT NULL,
  `Jobs_Num` int(20) DEFAULT NULL,
  `Start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rp_Log`
--

INSERT INTO `Rp_Log` (`Mac`, `Jobs_Num`, `Start_time`) VALUES
('255.255.255.1', 3, '2017-05-07 06:18:00'),
('255.255.255.10', 3, '2017-05-07 06:18:00'),
('255.255.255.11', 3, '2017-05-07 06:18:00'),
('255.255.255.12', 4, '2017-05-07 06:18:00'),
('255.255.255.13', 3, '2017-05-07 06:18:00'),
('255.255.255.14', 4, '2017-05-07 06:18:00'),
('255.255.255.15', 3, '2017-05-07 06:18:00'),
('255.255.255.16', 2, '2017-05-07 06:18:00'),
('255.255.255.17', 3, '2017-05-07 06:18:00'),
('255.255.255.18', 5, '2017-05-07 06:18:00'),
('255.255.255.2', 3, '2017-05-07 06:18:00'),
('255.255.255.3', 4, '2017-05-07 06:18:00'),
('255.255.255.4', 2, '2017-05-07 06:18:00'),
('255.255.255.6', 4, '2017-05-07 06:18:00'),
('255.255.255.7', 5, '2017-05-07 06:18:00'),
('255.255.255.8', 4, '2017-05-07 06:18:00'),
('255.255.255.9', 2, '2017-05-07 06:18:00'),
('b8:27:eb:f5:d6:1c', 0, '2017-05-07 06:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `Rp_Specs`
--

CREATE TABLE `Rp_Specs` (
  `Mac` varchar(50) NOT NULL,
  `Ram` int(10) NOT NULL,
  `Storage` int(20) NOT NULL,
  `HasCamera` tinyint(1) NOT NULL,
  `Generation` varchar(10) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `PublicIP` varchar(30) NOT NULL,
  `LocationLat` float NOT NULL,
  `LocationLng` float NOT NULL,
  `LocationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rp_Specs`
--

INSERT INTO `Rp_Specs` (`Mac`, `Ram`, `Storage`, `HasCamera`, `Generation`, `Username`, `Password`, `PublicIP`, `LocationLat`, `LocationLng`, `LocationName`) VALUES
('255.255.170', 2048, 2048, 1, 'X-25-200', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.203', 1024, 2048, 1, 'X-25-125', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255', 1024, 1024, 1, 'X-25-122', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.1', 1024, 16384, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.10', 1024, 8192, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.11', 1024, 8192, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.12', 512, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.13', 1024, 16384, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.14', 1024, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.15', 1024, 8192, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.16', 512, 8192, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.17', 1024, 16384, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.18', 1024, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.2', 1024, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.3', 1024, 8192, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.4', 1024, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.6', 1024, 8192, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.7', 1024, 16384, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.8', 512, 16384, 1, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('255.255.255.9', 1024, 16384, 0, '3', 'pi', 'not real', '192.168.8.100', 0, 0, ''),
('b8:27:eb:8d:24:80', 3000, 18000, 0, '1', 'pi', '123123', '192.1', 0, 0, ''),
('b8:27:eb:f5:d6:1c', 2048, 16384, 0, '3', 'pi', 'pi123123', '192.168.8.100', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_id` int(10) NOT NULL,
  `User_username` varchar(70) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(70) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `Premuim` tinyint(1) DEFAULT NULL,
  `Join_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_id`, `User_username`, `Fname`, `Lname`, `Email`, `Password`, `Premuim`, `Join_Date`) VALUES
(1, 'Tamer53', 'Tamer', 'Gamal', 'Tamer@gmail.com', '123', 0, '2017-03-19 08:22:11'),
(2, 'Samy53', 'Samy', 'Gamal', 'Samy@gmail.com', '123', 0, '2017-03-19 08:23:44'),
(3, 'Youssef53', 'Youssef', 'Gamal', 'Youssef@gmail.com', '123', 0, '2017-03-19 08:23:44'),
(4, 'mohamed53', 'Mohamed', 'Gamal', 'Mohamed@gmail.com', '123', 0, '2017-03-19 08:23:44'),
(5, 'Gaber53', 'Gaber', 'Gamal', 'Gaber@gmail.com', '123', 0, '2017-03-19 08:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `User_Log`
--

CREATE TABLE `User_Log` (
  `User_id` int(10) NOT NULL,
  `Img_id` int(20) NOT NULL,
  `Process_name` varchar(40) NOT NULL,
  `Action` int(5) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `Admin_username` (`Admin_username`);

--
-- Indexes for table `Admin_Log`
--
ALTER TABLE `Admin_Log`
  ADD PRIMARY KEY (`Admin_id`,`Action_time`),
  ADD UNIQUE KEY `Mac` (`Mac`),
  ADD KEY `Cont_id` (`Cont_id`);

--
-- Indexes for table `Code_index`
--
ALTER TABLE `Code_index`
  ADD PRIMARY KEY (`Code`),
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `Criminals`
--
ALTER TABLE `Criminals`
  ADD PRIMARY KEY (`Crim_id`);

--
-- Indexes for table `Current_Specs`
--
ALTER TABLE `Current_Specs`
  ADD PRIMARY KEY (`Mac`),
  ADD UNIQUE KEY `Mac` (`Mac`);

--
-- Indexes for table `Government`
--
ALTER TABLE `Government`
  ADD PRIMARY KEY (`Gov_id`),
  ADD UNIQUE KEY `Gov_username` (`Gov_username`);

--
-- Indexes for table `Gov_Log`
--
ALTER TABLE `Gov_Log`
  ADD PRIMARY KEY (`Gov_id`,`Start_time`),
  ADD KEY `Crim_id` (`Crim_id`);

--
-- Indexes for table `IPs`
--
ALTER TABLE `IPs`
  ADD PRIMARY KEY (`IpAddress`,`Mac`),
  ADD UNIQUE KEY `Mac` (`Mac`);

--
-- Indexes for table `Process`
--
ALTER TABLE `Process`
  ADD PRIMARY KEY (`Process_name`,`Img_id`),
  ADD UNIQUE KEY `Img_id` (`Img_id`),
  ADD UNIQUE KEY `Cont_id` (`Cont_id`),
  ADD KEY `Mac` (`Mac`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `Rp_Log`
--
ALTER TABLE `Rp_Log`
  ADD PRIMARY KEY (`Mac`),
  ADD UNIQUE KEY `Mac` (`Mac`);

--
-- Indexes for table `Rp_Specs`
--
ALTER TABLE `Rp_Specs`
  ADD PRIMARY KEY (`Mac`),
  ADD UNIQUE KEY `Mac` (`Mac`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_id`),
  ADD UNIQUE KEY `User_username` (`User_username`);

--
-- Indexes for table `User_Log`
--
ALTER TABLE `User_Log`
  ADD PRIMARY KEY (`User_id`,`Img_id`),
  ADD KEY `Img_id` (`Img_id`),
  ADD KEY `Process_name` (`Process_name`),
  ADD KEY `User_Log_ibfk_4` (`Action`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `Admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Criminals`
--
ALTER TABLE `Criminals`
  MODIFY `Crim_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Government`
--
ALTER TABLE `Government`
  MODIFY `Gov_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin_Log`
--
ALTER TABLE `Admin_Log`
  ADD CONSTRAINT `Admin_Log_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `Admin` (`Admin_id`),
  ADD CONSTRAINT `Admin_Log_ibfk_2` FOREIGN KEY (`Cont_id`) REFERENCES `Process` (`Cont_id`);

--
-- Constraints for table `Current_Specs`
--
ALTER TABLE `Current_Specs`
  ADD CONSTRAINT `Current_Specs_ibfk_1` FOREIGN KEY (`Mac`) REFERENCES `Rp_Specs` (`Mac`);

--
-- Constraints for table `Gov_Log`
--
ALTER TABLE `Gov_Log`
  ADD CONSTRAINT `Gov_Log_ibfk_1` FOREIGN KEY (`Gov_id`) REFERENCES `Government` (`Gov_id`);

--
-- Constraints for table `IPs`
--
ALTER TABLE `IPs`
  ADD CONSTRAINT `IPs_ibfk_1` FOREIGN KEY (`Mac`) REFERENCES `Rp_Specs` (`Mac`);

--
-- Constraints for table `Process`
--
ALTER TABLE `Process`
  ADD CONSTRAINT `Process_ibfk_1` FOREIGN KEY (`Mac`) REFERENCES `Rp_Specs` (`Mac`),
  ADD CONSTRAINT `Process_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `User` (`User_id`);

--
-- Constraints for table `Rp_Log`
--
ALTER TABLE `Rp_Log`
  ADD CONSTRAINT `Rp_Log_ibfk_1` FOREIGN KEY (`Mac`) REFERENCES `Rp_Specs` (`Mac`);

--
-- Constraints for table `User_Log`
--
ALTER TABLE `User_Log`
  ADD CONSTRAINT `User_Log_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `User` (`User_id`),
  ADD CONSTRAINT `User_Log_ibfk_2` FOREIGN KEY (`Img_id`) REFERENCES `Process` (`Img_id`),
  ADD CONSTRAINT `User_Log_ibfk_3` FOREIGN KEY (`Process_name`) REFERENCES `Process` (`Process_name`),
  ADD CONSTRAINT `User_Log_ibfk_4` FOREIGN KEY (`Action`) REFERENCES `Code_index` (`Code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
