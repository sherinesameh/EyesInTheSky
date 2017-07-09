-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2017 at 08:18 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

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
(1, 'Updated government employee ', '2017-07-04 22:12:07'),
(1, 'Killed Process at Raspberry pi b8:27:eb:f5:d6:1c with container ID dwqdwq', '2017-07-05 19:20:20'),
(1, 'Added government employee mayar', '2017-07-05 19:21:33'),
(1, 'Added government employee ahmedsameh', '2017-07-05 19:32:57'),
(1, 'Added government employee boshrakandil', '2017-07-05 19:36:17'),
(1, 'Added government employee sherinesameh', '2017-07-05 19:41:26'),
(1, 'Added government employee sherine', '2017-07-05 19:44:16'),
(1, 'Added government employee yarakhaled', '2017-07-05 19:46:59'),
(1, 'Added government employee yomna98', '2017-07-05 19:57:58'),
(1, 'Deleted government employee yomna98', '2017-07-05 19:59:12'),
(1, 'Deleted government employee yarakhaled', '2017-07-05 19:59:14'),
(1, 'Deleted government employee boshrakandil', '2017-07-05 19:59:18'),
(1, 'Deleted government employee ahmedsameh', '2017-07-05 19:59:20'),
(1, 'Deleted government employee mayar', '2017-07-05 19:59:22'),
(1, 'Deleted government employee sherinesameh', '2017-07-05 19:59:23'),
(1, 'Deleted government employee Raspberry Pi', '2017-07-05 19:59:25'),
(1, 'Deleted government employee sherine', '2017-07-05 19:59:48'),
(1, 'Updated government employee yamen94', '2017-07-05 20:00:50'),
(1, 'Added government employee hamada', '2017-07-05 20:10:56'),
(1, 'Closed Raspberry pi b8:27:eb:d8:71:d5 ', '2017-07-05 20:26:18'),
(1, 'Closed Raspberry pi b8:27:eb:d8:71:d5 ', '2017-07-05 20:28:22'),
(1, 'Closed Raspberry pi b8:27:eb:d8:71:d5 ', '2017-07-07 16:37:55'),
(1, 'Closed Raspberry pi b8:27:eb:d8:71:d5 ', '2017-07-07 20:26:11');

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
  `State` int(5) NOT NULL DEFAULT '70707',
  `Location` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Criminals`
--

INSERT INTO `Criminals` (`Crim_id`, `Mname`, `Fname`, `Lname`, `Dir_path`, `priority`, `expiry_date`, `image`, `State`, `Location`) VALUES
(40, 'mahmoud', 'farida', 'menisy', '', 77777, '2017-07-10', '1499284664.png', 70707, NULL),
(41, 'sameh', 'sherine', 'aly', '', 77777, '2017-07-10', '1499285222.png', 70707, NULL),
(43, 'gamal', 'hany', 'elsayed', '', 77777, '2017-07-10', '1499287840.png', 70707, NULL);

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
('b8:27:eb:d8:71:d5', '192.168.43.249 172.17.0.1 ', 79.5, 0.5, 15, 46.2, 22894),
('b8:27:eb:f5:d6:1c', '172.20.10.3 172.17.0.1 ', 37.8, 2.7, 16.1, 47.2, 22198);

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
(2, 'yamen94', 'yamen', 'emad', 'yamen@gmail.com', '123123', 'x.png'),
(12, 'hamada', 'mohamed', 'samy', 'hamada@gmail.com', '123123', '1499278256.png');

-- --------------------------------------------------------

--
-- Table structure for table `Gov_Log`
--

CREATE TABLE `Gov_Log` (
  `Gov_id` int(10) NOT NULL,
  `Gov_username` varchar(70) NOT NULL,
  `Action` varchar(150) NOT NULL,
  `Start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Gov_Log`
--

INSERT INTO `Gov_Log` (`Gov_id`, `Gov_username`, `Action`, `Start_time`) VALUES
(2, 'yamen94', 'Deleted Criminal yamen eqwew ewqeqw', '2017-07-06 03:16:08'),
(2, 'yamen94', 'Added Criminal Fname usama kandil', '2017-07-07 16:45:24'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 16:52:20'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 17:05:20'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 17:17:09'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 17:22:17'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 17:28:21'),
(2, 'yamen94', 'Deleted Criminal mohamed sherif hosny', '2017-07-07 19:54:25'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 20:06:19'),
(2, 'yamen94', 'Added Criminal Fname sherif hosny', '2017-07-07 20:14:05'),
(2, 'yamen94', 'Deleted Criminal mohamed sherif hosny', '2017-07-08 17:18:30'),
(2, 'yamen94', 'Deleted Criminal mohamed sherif hosny', '2017-07-08 17:18:46'),
(2, 'yamen94', 'Added Criminal Fname sherif hosy', '2017-07-08 17:19:46'),
(2, 'yamen94', 'Deleted Criminal mohamed sherif hosy', '2017-07-08 17:24:51'),
(2, 'yamen94', 'Deleted Criminal yamen emad gebril', '2017-07-08 17:24:53');

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
('131be14646fb', 'Farida', '78a93fc02cba', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-07 19:49:43', 22198, 'Hello World!\n', '\n'),
('131be14646fb', 'Hello', '170901f98e22', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-07 19:52:58', 22198, 'Hello World!\n', '\n'),
('131be14646fb', 'sherine', 'a1dff03a9db7', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-08 17:12:09', 22894, 'Hello World!\n', '\n'),
('131be14646fb', 'test', 'ffd4f4ccb9a9', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-08 16:19:07', 22894, 'Hello World!\n', '\n'),
('131be14646fb', 'test2', '99cec5131de7', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-08 16:21:42', 22894, 'Hello World!\n', '\n'),
('131be14646fb', 'yamen', '62cce114dace', '\n', 'b8:27:eb:d8:71:d5', 1, '2017-07-07 20:24:27', 22198, 'Hello World!\n', '\n');

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
('b8:27:eb:d8:71:d5', 8, '2017-07-05 19:14:29'),
('b8:27:eb:f5:d6:1c', 5, '2017-07-02 19:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `Rp_Specs`
--

CREATE TABLE `Rp_Specs` (
  `Mac` varchar(50) NOT NULL,
  `Ram` int(10) NOT NULL,
  `Storage` int(20) NOT NULL,
  `HasCamera` tinyint(1) NOT NULL,
  `Generation` varchar(10) DEFAULT '3',
  `OS` varchar(40) NOT NULL,
  `Username` varchar(30) NOT NULL DEFAULT 'pi',
  `Password` varchar(30) NOT NULL DEFAULT 'pi',
  `PublicIP` varchar(30) NOT NULL,
  `LocationLat` float NOT NULL DEFAULT '0',
  `LocationLng` float NOT NULL DEFAULT '0',
  `LocationName` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rp_Specs`
--

INSERT INTO `Rp_Specs` (`Mac`, `Ram`, `Storage`, `HasCamera`, `Generation`, `OS`, `Username`, `Password`, `PublicIP`, `LocationLat`, `LocationLng`, `LocationName`) VALUES
('b8:27:eb:d8:71:d5', 859, 13, 0, '3', 'Raspbian GNU/Linux 8 (jessie)', 'pi', 'pi', '196.153.104.93', 0, 0, '0'),
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
(1, '131be14646fb', 'Farida', 19195, '2017-07-07 17:49:26'),
(1, '131be14646fb', 'Hello', 19195, '2017-07-07 17:52:45'),
(1, '131be14646fb', 'yamen', 19195, '2017-07-07 18:24:06'),
(1, '131be14646fb', 'test', 19195, '2017-07-08 14:19:01'),
(1, '131be14646fb', 'test2', 19195, '2017-07-08 14:21:27'),
(1, '131be14646fb', 'sherine', 19195, '2017-07-08 15:11:56');

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
  ADD PRIMARY KEY (`Gov_id`,`Start_time`);

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
  MODIFY `Crim_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `Government`
--
ALTER TABLE `Government`
  MODIFY `Gov_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `clear_log` ON SCHEDULE EVERY 3 DAY STARTS '2017-07-06 04:47:48' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM Gov_Log
WHERE Start_time NOT IN (
  SELECT Start_time
  FROM (
    SELECT Start_time
    FROM Gov_Log
    ORDER BY Start_time DESC
    LIMIT 100
  ) foo
)$$

CREATE DEFINER=`root`@`localhost` EVENT `clear_log2` ON SCHEDULE EVERY 3 DAY STARTS '2017-07-06 04:48:11' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM Admin_Log
WHERE Action_time NOT IN (
  SELECT Action_time
  FROM (
    SELECT Action_time
    FROM Admin_Log
    ORDER BY Action_time DESC
    LIMIT 100
  ) foo
)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
