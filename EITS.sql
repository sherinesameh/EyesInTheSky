-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 03:34 PM
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
(6, 'yara2017', 'yara', 'khaled', 'yara@gmail.com', '123123', '2017-03-19 08:18:56', 'x.png', '01111134242');

-- --------------------------------------------------------

--
-- Table structure for table `Admin_Log`
--

CREATE TABLE `Admin_Log` (
  `Admin_id` int(10) NOT NULL,
  `Action` varchar(140) DEFAULT NULL,
  `Action_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Admin_Log`
--

INSERT INTO `Admin_Log` (`Admin_id`, `Action`, `Action_time`) VALUES
(1, 'Added government employee sherinesameh', '2017-07-04 22:06:26'),
(1, 'Deleted government employee farida94', '2017-07-04 22:06:36'),
(1, 'Updated government employee ', '2017-07-04 22:12:07');

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
('Shutdown Pi', 12030),
('Finished', 19195),
('Not Found', 20202),
('Added Task', 20794),
('Closed', 22198),
('Running', 22894),
('Restart Pi', 23456),
('kill Process', 27693),
('In progress', 32141),
('Not Important', 33333),
('User', 40307),
('Low', 55555),
('Delete Criminal', 56489),
('Searching', 70707),
('Found', 76767),
('normal', 77777),
('Government', 80702),
('expired', 80808),
('RaspberryPi', 90201),
('Admin', 90901),
('Add criminal', 98312),
('High', 99999);

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
  `State` int(5) NOT NULL DEFAULT '70707'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('255.255.255.9', '', 36.5, 2, 14, 37, 22198),
('b8:27:eb:8d:24:80', '', 36.5, 2, 14, 37, 22198),
('b8:27:eb:f5:d6:1c', '172.20.10.3 172.17.0.1 ', 37.8, 2.7, 16.1, 47.2, 22894);

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
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Government`
--

INSERT INTO `Government` (`Gov_id`, `Gov_username`, `Fname`, `Lname`, `Email`, `Password`, `image`) VALUES
(2, 'yamen94', 'yamen', 'emad', 'yamen@gmail.com', 'yamen123', 'x.png'),
(3, 'Raspberry Pi', 'rasp', 'pi', 'pi@gmail.com', 'pi123123', ''),
(4, 'sherinesameh', 'sherine', 'sameh', 'sherine-sameh@hotmail.com', 's123123', '1499205986.jpg');

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
(2, 'yamen94', 98312, '2017-07-01 01:05:53', 11),
(2, 'yamen94', 98312, '2017-07-01 14:34:07', 12),
(2, 'yamen94', 98312, '2017-07-01 14:37:29', 13),
(2, 'yamen94', 98312, '2017-07-01 14:41:56', 14),
(2, 'yamen94', 98312, '2017-07-01 14:44:18', 15),
(2, 'yamen94', 98312, '2017-07-01 14:50:16', 16),
(2, 'yamen94', 98312, '2017-07-01 14:56:42', 17),
(2, 'yamen94', 98312, '2017-07-01 14:57:03', 18),
(2, 'yamen94', 98312, '2017-07-01 15:01:34', 19),
(2, 'yamen94', 98312, '2017-07-01 15:04:09', 20),
(2, 'yamen94', 98312, '2017-07-01 15:08:57', 21),
(2, 'yamen94', 98312, '2017-07-01 15:09:12', 22),
(2, 'yamen94', 98312, '2017-07-01 15:09:51', 23),
(2, 'yamen94', 98312, '2017-07-01 15:14:07', 24),
(2, 'yamen94', 98312, '2017-07-01 15:16:50', 25),
(2, 'yamen94', 98312, '2017-07-01 15:20:01', 26),
(2, 'yamen94', 98312, '2017-07-01 15:20:54', 27),
(2, 'yamen94', 98312, '2017-07-01 15:22:53', 28),
(2, 'yamen94', 98312, '2017-07-01 15:24:46', 29),
(2, 'yamen94', 98312, '2017-07-01 15:50:58', 30),
(2, 'yamen94', 98312, '2017-07-01 15:54:55', 31),
(2, 'yamen94', 98312, '2017-07-01 16:04:18', 32),
(2, 'yamen94', 98312, '2017-07-01 16:13:40', 33),
(2, 'yamen94', 98312, '2017-07-01 16:16:17', 34),
(2, 'yamen94', 98312, '2017-07-01 16:27:14', 35),
(2, 'yamen94', 98312, '2017-07-01 16:29:39', 36),
(2, 'yamen94', 98312, '2017-07-03 19:51:59', 0),
(2, 'yamen94', 98312, '2017-07-03 19:55:08', 0),
(2, 'yamen94', 98312, '2017-07-03 19:56:45', 0),
(2, 'yamen94', 98312, '2017-07-03 20:00:00', 0),
(2, 'yamen94', 98312, '2017-07-03 20:02:26', 0),
(2, 'yamen94', 98312, '2017-07-03 20:06:10', 0),
(2, 'yamen94', 98312, '2017-07-03 20:09:09', 0),
(2, 'yamen94', 98312, '2017-07-03 20:11:40', 0),
(2, 'yamen94', 98312, '2017-07-03 20:14:40', 0),
(2, 'yamen94', 98312, '2017-07-03 20:15:30', 0),
(2, 'yamen94', 98312, '2017-07-03 20:16:29', 0),
(2, 'yamen94', 98312, '2017-07-04 18:38:54', 0),
(2, 'yamen94', 98312, '2017-07-04 18:47:38', 0),
(2, 'yamen94', 98312, '2017-07-04 18:49:54', 0),
(2, 'yamen94', 98312, '2017-07-04 18:56:23', 0),
(2, 'yamen94', 98312, '2017-07-04 18:58:12', 0),
(2, 'yamen94', 98312, '2017-07-04 18:59:59', 0),
(2, 'yamen94', 98312, '2017-07-04 19:16:47', 0),
(2, 'yamen94', 98312, '2017-07-04 19:18:01', 0),
(2, 'yamen94', 98312, '2017-07-04 19:20:16', 0),
(2, 'yamen94', 98312, '2017-07-04 19:21:20', 0),
(2, 'yamen94', 98312, '2017-07-04 19:40:17', 0),
(2, 'yamen94', 56489, '2017-07-04 21:41:31', 20);

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
  `Img_id` varchar(20) NOT NULL,
  `Process_name` varchar(40) NOT NULL,
  `Cont_id` varchar(20) NOT NULL,
  `Cont_IP` varchar(20) NOT NULL DEFAULT 'None',
  `Mac` varchar(50) NOT NULL,
  `User_id` int(20) NOT NULL,
  `Start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Process_State` int(5) NOT NULL,
  `result` text,
  `port` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Process`
--

INSERT INTO `Process` (`Img_id`, `Process_name`, `Cont_id`, `Cont_IP`, `Mac`, `User_id`, `Start_time`, `Process_State`, `result`, `port`) VALUES
('e968adf61310', 'mayar 2', '1685f3f9f44b', '', 'b8:27:eb:f5:d6:1c', 1, '2017-07-04 17:55:37', 22894, 'Hello World!', ''),
('e968adf61310', 'mayar 3', '00210f022a31', '', 'b8:27:eb:f5:d6:1c', 1, '2017-07-04 18:04:55', 22894, 'Hello World!\n', ''),
('75f76658eb0c', 'yamen 6', 'b05e08054686', '172.17.0.2\n', 'b8:27:eb:f5:d6:1c', 1, '2017-07-03 04:28:47', 22894, NULL, ' 85/tcp -> 85 \n'),
('dwqdwqd', 'yamenTest', 'dwqdwq', '', 'b8:27:eb:f5:d6:1c', 1, '2017-07-04 16:04:11', 22894, '', '');

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
('b8:27:eb:8d:24:80', 0, '2017-06-30 16:15:04'),
('b8:27:eb:f5:d6:1c', 6, '2017-07-02 19:33:29');

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
  `OS` varchar(20) NOT NULL,
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

INSERT INTO `Rp_Specs` (`Mac`, `Ram`, `Storage`, `HasCamera`, `Generation`, `OS`, `Username`, `Password`, `PublicIP`, `LocationLat`, `LocationLng`, `LocationName`) VALUES
('255.255.255.9', 1024, 16384, 0, '3', '', 'pi', 'not real', '192.168.8.100', 0, 0, 'boukla'),
('b8:27:eb:8d:24:80', 3000, 18000, 1, '1', '', 'pi', '123123', '192.1', 0, 0, 'mandara'),
('b8:27:eb:f5:d6:1c', 2048, 16384, 0, '3', '', 'pi', 'pi123123', '192.168.8.100', 31.2099, 29.952, 'Semouha');

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
  `Img_id` varchar(20) DEFAULT '',
  `Process_name` varchar(40) NOT NULL DEFAULT '',
  `Action` int(5) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Log`
--

INSERT INTO `User_Log` (`User_id`, `Img_id`, `Process_name`, `Action`, `Time`) VALUES
(1, 'dwq2dq1dw', 'Task 1', 32141, '2017-06-29 23:12:26'),
(1, '', 'Task2', 32141, '2017-06-29 23:12:59'),
(1, 'gege', 'Task 1', 22894, '2017-06-29 23:16:32'),
(1, '', 'yamen2', 32141, '2017-07-02 15:47:24'),
(1, '', 'yamen 3', 32141, '2017-07-02 16:03:22'),
(1, '', 'yamen 4', 32141, '2017-07-02 16:15:16'),
(1, '', 'sherine', 32141, '2017-07-02 19:22:04'),
(1, '', 'Tamer', 32141, '2017-07-02 19:23:54'),
(1, '', 'sherif', 32141, '2017-07-02 19:27:16'),
(1, '', 'yamen 8', 32141, '2017-07-02 19:35:10'),
(1, '', 'yamen 5', 32141, '2017-07-02 19:37:09'),
(1, '75f76658eb0c', 'yamen 6', 22894, '2017-07-02 19:39:43'),
(1, '', 'yamen 7', 32141, '2017-07-02 19:41:13'),
(1, '', 'yamen 9', 32141, '2017-07-02 19:44:53'),
(1, '', 'yamen77', 32141, '2017-07-02 19:54:17'),
(1, '', 'yamen777', 32141, '2017-07-02 19:57:17'),
(1, '', 'sherine7', 32141, '2017-07-02 19:59:08'),
(1, '', 'sherine77', 32141, '2017-07-02 20:01:24'),
(1, '', 'sherinesameh7', 32141, '2017-07-02 20:06:10'),
(1, 'e968adf61310', 'sherinesameh77', 22894, '2017-07-02 20:13:33'),
(1, '', 'task yamen', 32141, '2017-07-04 15:47:02'),
(1, '', 'task yamen', 32141, '2017-07-04 15:47:50'),
(1, '', 'task yamen', 32141, '2017-07-04 15:50:51'),
(1, 'e968adf61310', 'task yamen', 22894, '2017-07-04 15:52:24'),
(1, '', 'dw', 32141, '2017-07-04 15:55:29'),
(1, '', 'task yamen', 32141, '2017-07-04 16:44:06'),
(1, '', 'task yamen', 32141, '2017-07-04 16:48:20'),
(1, 'e968adf61310', 'mayar', 22894, '2017-07-04 17:50:02'),
(1, '', 'mayar', 32141, '2017-07-04 17:54:02'),
(1, 'e968adf61310', 'mayar 2', 22894, '2017-07-04 17:55:07'),
(1, 'e968adf61310', 'mayar 3', 22894, '2017-07-04 18:04:34');

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
  ADD PRIMARY KEY (`Admin_id`,`Action_time`);

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
  ADD PRIMARY KEY (`Process_name`,`Img_id`,`Cont_id`),
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
  ADD PRIMARY KEY (`User_id`,`Time`),
  ADD KEY `User_Log_ibfk_1` (`User_id`),
  ADD KEY `User_Log_ibfk_4` (`Action`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `Admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Criminals`
--
ALTER TABLE `Criminals`
  MODIFY `Crim_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `Government`
--
ALTER TABLE `Government`
  MODIFY `Gov_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `Admin_Log_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `Admin` (`Admin_id`);

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
  ADD CONSTRAINT `User_Log_ibfk_4` FOREIGN KEY (`Action`) REFERENCES `Code_index` (`Code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
