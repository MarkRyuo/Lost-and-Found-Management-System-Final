-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2023 at 01:32 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nt3102`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `EventManager`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EventManager` (IN `eventNameVal` VARCHAR(255), IN `eventDescVal` VARCHAR(255), IN `eventIDVal` INT, IN `eventDateVal` TIMESTAMP, IN `orgIDVal` INT)   BEGIN
	SET @statusID = 1;
    INSERT INTO events (eventID,eventName,eventDesc,e_date,org_ID,statusID) VALUES (eventIDVal,eventNameVal,eventDescVal,evenDateVal,orgIDVal,@statusID);
    SET @eventID = LAST_INSERT_ID();
    SET @superID = orgIDVal;
    INSERT INTO eventrecords(eventID,superID) VALUES ( @eventID, orgIDVal);
END$$

DROP PROCEDURE IF EXISTS `RegisterModerator`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegisterModerator` (IN `org_namevalue` VARCHAR(255), IN `passwordvalue` VARCHAR(255), IN `usernamevalue` VARCHAR(255), IN `deptIDvalue` INT)   BEGIN
	SET @salt = (SUBSTRING(MD5(RAND()), 1, 10));
    SET @password = SHA2(CONCAT(passwordvalue,@salt),256);
    INSERT INTO superusers (username,password,salt) VALUES (usernamevalue,@password,@salt);
    SET @superID = LAST_INSERT_ID();
    
    INSERT INTO organization (dept_ID,org_name,superID) VALUES ( deptIDvalue, org_namevalue,@superID);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseID` int NOT NULL AUTO_INCREMENT,
  `courseName` text NOT NULL,
  `dept_ID` int NOT NULL,
  PRIMARY KEY (`courseID`),
  KEY `dept_ID` (`dept_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`, `dept_ID`) VALUES
(1, 'Bachelor of Science in Business Administration', 1),
(2, 'Bachelor of Science in Management Accounting', 1),
(3, 'Bachelor of Science in Psychology', 2),
(4, 'Bachelor of Arts in Communication', 2),
(5, 'Bachelor of Industrial Technology', 3),
(6, 'Bachelor of Science in Information Technology', 4),
(7, 'Bachelor of Science in Computer Science', 4),
(8, 'Bachelor of Secondary Education', 5),
(9, 'Bachelor of Science in Industrial Engineering ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_ID` int NOT NULL AUTO_INCREMENT,
  `department_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`dept_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_ID`, `department_Name`) VALUES
(0, 'General Department'),
(1, 'CABEIHM'),
(2, 'CAS'),
(3, 'CIT'),
(4, 'CICS'),
(5, 'CTE'),
(6, 'CE');

-- --------------------------------------------------------

--
-- Table structure for table `eventattendees`
--

DROP TABLE IF EXISTS `eventattendees`;
CREATE TABLE IF NOT EXISTS `eventattendees` (
  `attendeeID` int NOT NULL,
  `eventID` int NOT NULL,
  `sr_code` varchar(11) NOT NULL,
  `DateRegistered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventattendees`
--

INSERT INTO `eventattendees` (`attendeeID`, `eventID`, `sr_code`, `DateRegistered`) VALUES
(1, 1, '21-33273', '2023-11-20 01:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `eventrecords`
--

DROP TABLE IF EXISTS `eventrecords`;
CREATE TABLE IF NOT EXISTS `eventrecords` (
  `recordID` int NOT NULL AUTO_INCREMENT,
  `eventID` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `superID` int NOT NULL,
  PRIMARY KEY (`recordID`),
  KEY `superID` (`superID`),
  KEY `statusID` (`eventID`(250)),
  KEY `fk_eventID` (`eventID`(250))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventrecords`
--

INSERT INTO `eventrecords` (`recordID`, `eventID`, `remarks`, `superID`) VALUES
(1, '1', 'NA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int NOT NULL AUTO_INCREMENT,
  `eventName` varchar(50) NOT NULL,
  `eventDesc` varchar(50) NOT NULL,
  `org_ID` int NOT NULL,
  `statusID` int NOT NULL,
  `e_date` datetime NOT NULL,
  PRIMARY KEY (`eventID`),
  KEY `org_ID` (`org_ID`),
  KEY `statusID` (`statusID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventName`, `eventDesc`, `org_ID`, `statusID`, `e_date`) VALUES
(1, 'sample', 'sample', 1, 1, '2023-11-19 09:32:12'),
(2, 'sample2', 'sample3', 1, 1, '2023-11-19 13:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `eventstatus`
--

DROP TABLE IF EXISTS `eventstatus`;
CREATE TABLE IF NOT EXISTS `eventstatus` (
  `statusID` int NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventstatus`
--

INSERT INTO `eventstatus` (`statusID`, `status`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

DROP TABLE IF EXISTS `lost_items`;
CREATE TABLE IF NOT EXISTS `lost_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `date_found` date NOT NULL,
  `date_claimed` date DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `item_number`, `item_name`, `date_found`, `date_claimed`, `user_id`, `student_id`) VALUES
(1, '000001', 'NoteBook', '2023-11-13', '2023-11-20', NULL, NULL),
(2, '000002', 'Iphone Xr ', '2023-11-14', '2023-11-20', NULL, NULL),
(3, '000003', 'Book', '2023-11-21', '2023-11-20', NULL, NULL),
(4, '000004', 'Umbrella', '2023-11-22', '2023-11-20', NULL, NULL),
(5, '000005', 'Mini Fan', '2023-11-23', '2023-11-20', NULL, NULL),
(6, '000006', 'Laptop ', '2023-11-13', '2023-11-20', NULL, NULL),
(7, '000007', 'ID', '2023-11-14', '2023-11-20', NULL, NULL),
(8, '000008', 'Cellphone', '2023-11-14', '2023-11-20', NULL, NULL),
(9, '000009', 'Bag', '2023-11-15', '2023-11-20', NULL, NULL),
(10, '000010', 'ID Lace', '2023-11-16', '2023-11-20', NULL, NULL),
(11, '000011', 'Bottle', '2023-11-17', '2023-11-20', NULL, NULL),
(12, '000012', 'Cellphone', '2023-11-17', '2023-11-20', NULL, NULL),
(13, '000013', 'NoteBook', '2023-11-17', '2023-11-20', NULL, NULL),
(14, '000014', 'Cellphone', '2023-11-21', '2023-11-20', NULL, NULL),
(15, '000015', 'ID Lace', '2023-11-22', '2023-11-20', NULL, NULL),
(16, '000016', 'Shoes', '2023-11-21', '2023-11-20', NULL, NULL),
(17, '000017', 'Ballpen', '2023-11-21', '2023-11-20', NULL, NULL),
(18, '000018', 'Shades', '2023-11-21', '2023-11-20', NULL, NULL),
(19, '000019', 'Shades', '2023-11-21', '2023-11-22', NULL, NULL),
(20, '000020', 'Ballpen', '2023-11-21', NULL, NULL, NULL),
(21, '000021', 'handkerchief', '2023-11-22', NULL, NULL, NULL),
(22, '000022', 'Relo', '2023-11-23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

DROP TABLE IF EXISTS `moderators`;
CREATE TABLE IF NOT EXISTS `moderators` (
  `org_Name` varchar(255) DEFAULT NULL,
  `superID` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `org_ID` int NOT NULL AUTO_INCREMENT,
  `dept_ID` int NOT NULL,
  `org_Name` varchar(255) NOT NULL,
  `superID` int NOT NULL,
  PRIMARY KEY (`org_ID`),
  KEY `superID` (`superID`),
  KEY `dept_ID` (`dept_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_ID`, `dept_ID`, `org_Name`, `superID`) VALUES
(1, 1, 'Junior Philippine Association of Management Accountants', 1),
(2, 1, 'Junior Marketing Executives', 2),
(3, 1, 'College of Accountancy, Business and Economics Council', 3),
(4, 1, 'Public Administration Student Association', 4),
(5, 1, 'Association Of Operation Management Students', 5),
(6, 1, 'Young People Management Association of the Philippines', 6),
(7, 2, 'Association of College of Arts and Sciences Students', 7),
(8, 2, 'Circle of Psychology Students', 8),
(9, 2, 'Poderoso Communicador Sociedad', 9),
(10, 3, 'Alliance of Industrial Technology Students', 10),
(11, 3, 'CTRL+A', 11),
(12, 4, 'Junior Philippine Computer Society - Lipa Chapter', 12),
(13, 4, 'Tech Innovators Society', 13),
(14, 5, 'Aspiring Future Educators Guild', 14),
(15, 5, 'Language Educators Association', 15),
(16, 6, 'Junior Philippine Institute of Industrial Engineers', 16),
(17, 0, 'Red Spartan Sports Council', 17),
(18, 0, 'Supreme Student Council Lipa Campus', 18),
(19, 4, 'Tech Innovator Society', 5);

-- --------------------------------------------------------

--
-- Table structure for table `security_lostnfound`
--

DROP TABLE IF EXISTS `security_lostnfound`;
CREATE TABLE IF NOT EXISTS `security_lostnfound` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','security') DEFAULT 'security',
  `usersign` varchar(50) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=2126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `security_lostnfound`
--

INSERT INTO `security_lostnfound` (`UserId`, `username`, `password`, `role`, `usersign`) VALUES
(1010, 'Admin_Sd', 'adminsd', 'admin', 'Seurity Department'),
(2125, 'jose2125', '2125', 'security', 'Security_G0');

-- --------------------------------------------------------

--
-- Table structure for table `studentinfoview`
--

DROP TABLE IF EXISTS `studentinfoview`;
CREATE TABLE IF NOT EXISTS `studentinfoview` (
  `courseID` int DEFAULT NULL,
  `courseName` text,
  `department_Name` varchar(100) DEFAULT NULL,
  `dept_ID` int DEFAULT NULL,
  `firstName` varchar(25) DEFAULT NULL,
  `lastName` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(10) DEFAULT NULL,
  `section` varchar(250) DEFAULT NULL,
  `sr_code` varchar(250) DEFAULT NULL,
  `stud_id` int DEFAULT NULL,
  `userID` int DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `sr_code` varchar(250) NOT NULL,
  `courseID` int NOT NULL,
  `year` varchar(255) NOT NULL,
  `section` varchar(250) NOT NULL,
  `stud_id` int NOT NULL,
  PRIMARY KEY (`sr_code`),
  KEY `courseID` (`courseID`),
  KEY `stud_id` (`stud_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sr_code`, `courseID`, `year`, `section`, `stud_id`) VALUES
('21-33273', 6, '3rd', 'NT-3102', 1),
('21-33470', 6, '3rd', 'NT-3102', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_lostnfound`
--

DROP TABLE IF EXISTS `student_lostnfound`;
CREATE TABLE IF NOT EXISTS `student_lostnfound` (
  `StudentId` int NOT NULL AUTO_INCREMENT,
  `Sr_code` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_lostnfound`
--

INSERT INTO `student_lostnfound` (`StudentId`, `Sr_code`, `password`) VALUES
(1, '21-36991', '21-36991');

-- --------------------------------------------------------

--
-- Table structure for table `superusers`
--

DROP TABLE IF EXISTS `superusers`;
CREATE TABLE IF NOT EXISTS `superusers` (
  `superID` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(10) NOT NULL,
  PRIMARY KEY (`superID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `superusers`
--

INSERT INTO `superusers` (`superID`, `userName`, `password`, `salt`) VALUES
(0, 'adminval', '95e1d817e753fe6392b68de89c337e4cbcf63d280e77245d5c7a3fc4938863d9', 'kckKVzx9k1'),
(1, 'JPAMA', '3913342ed7e247f86dc7bf83229b90a0cec7d8f7f9a6851927f7becc7fec9035', 'b79dc59cf1'),
(2, 'JME', '18d7d94a8343f46b943d963da0d1b8bb42520ba84d4329280be02e5c542a9ee4', 'fc39983032'),
(3, 'CABE Council', '423a577e2d08ee38ad7969840840efd3ebc0adde65ccce896eb93c3d2c491fc8', '02eb527701'),
(5, 'Tech Innovators Society', '5060f9a146da6d1494d1a6f6cf9de3c43c0c8d49a8561ddddb6332a305cec951', 'da0fd7826c');

-- --------------------------------------------------------

--
-- Table structure for table `tbemployee`
--

DROP TABLE IF EXISTS `tbemployee`;
CREATE TABLE IF NOT EXISTS `tbemployee` (
  `empid` int NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `department` varchar(20) NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbemployee`
--

INSERT INTO `tbemployee` (`empid`, `lastname`, `firstname`, `department`) VALUES
(1010, 'Admin_Sd', 'Admin_Sd', 'Seurity Department'),
(2125, 'Manabat', 'Jose', 'Seurity Department');

-- --------------------------------------------------------

--
-- Table structure for table `tb_studentinfo`
--

DROP TABLE IF EXISTS `tb_studentinfo`;
CREATE TABLE IF NOT EXISTS `tb_studentinfo` (
  `studid` int NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `course` varchar(20) NOT NULL,
  PRIMARY KEY (`studid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_studentinfo`
--

INSERT INTO `tb_studentinfo` (`studid`, `lastname`, `firstname`, `course`) VALUES
(1, 'Aleister', 'Alinsunurin', 'BSIT'),
(2, 'Emjay', 'Rongavilla', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `userstudents`
--

DROP TABLE IF EXISTS `userstudents`;
CREATE TABLE IF NOT EXISTS `userstudents` (
  `userID` int NOT NULL,
  `sr_code` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(10) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `sr_code` (`sr_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userstudents`
--

INSERT INTO `userstudents` (`userID`, `sr_code`, `password`, `salt`) VALUES
(1, '21-33470', 'e0999eedf060a2ee05ab267bdb52f827b5f0174d839ac30eae6cd235392531f6', '1ea831d0d9'),
(3, '21-33273', 'e0999eedf060a2ee05ab267bdb52f827b5f0174d839ac30eae6cd235392531f6', '1ea831d0d9');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
