-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2023 at 10:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `aid` int(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`aid`, `uname`, `email`, `pass`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarktb`
--

CREATE TABLE `bookmarktb` (
  `bookmarkID` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookmarktb`
--

INSERT INTO `bookmarktb` (`bookmarkID`, `sid`, `tid`) VALUES
(24, 111, 1028),
(27, 114, 1028),
(29, 110, 1028);

-- --------------------------------------------------------

--
-- Table structure for table `booktb`
--

CREATE TABLE `booktb` (
  `bookid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `bookDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booktb`
--

INSERT INTO `booktb` (`bookid`, `sid`, `tid`, `bookDate`) VALUES
(9, 111, 1029, '2022-06-06 10:00:44'),
(13, 111, 1028, '2022-06-11 14:38:33'),
(17, 110, 1031, '2022-06-21 18:26:13'),
(18, 114, 1034, '2022-06-22 11:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `citymaster`
--

CREATE TABLE `citymaster` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `citymaster`
--

INSERT INTO `citymaster` (`cityID`, `cityName`) VALUES
(1, 'Surat'),
(2, 'Mumbai'),
(3, 'Banglore'),
(4, 'Ahmedabad'),
(5, 'Pune'),
(6, 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `ratingtb`
--

CREATE TABLE `ratingtb` (
  `ratingID` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ratingtb`
--

INSERT INTO `ratingtb` (`ratingID`, `rating`, `tid`, `sid`) VALUES
(52, 1, 1028, 110),
(53, 1, 1028, 111),
(54, NULL, 1028, 114),
(55, NULL, 1028, 112),
(57, NULL, 1029, 110),
(58, 4, 1029, 111),
(59, NULL, 1029, 114),
(60, NULL, 1029, 112),
(70, 4, 1028, 116),
(71, NULL, 1029, 116),
(72, 4, 1031, 110),
(73, NULL, 1031, 111),
(74, NULL, 1031, 116),
(75, NULL, 1031, 112),
(76, NULL, 1031, 114),
(87, NULL, 1034, 110),
(88, NULL, 1034, 111),
(89, NULL, 1034, 116),
(90, NULL, 1034, 112),
(91, NULL, 1034, 114);

-- --------------------------------------------------------

--
-- Table structure for table `requeststatus`
--

CREATE TABLE `requeststatus` (
  `reqID` int(11) NOT NULL,
  `reqStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `requeststatus`
--

INSERT INTO `requeststatus` (`reqID`, `reqStatus`) VALUES
(1, 'Pending'),
(2, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `requesttb`
--

CREATE TABLE `requesttb` (
  `rid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `reqID` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `reqDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statusmaster`
--

CREATE TABLE `statusmaster` (
  `statusID` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `statusmaster`
--

INSERT INTO `statusmaster` (`statusID`, `status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `studenttb`
--

CREATE TABLE `studenttb` (
  `sid` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `pic` varchar(200) DEFAULT '../images/defaultStud.jpg',
  `email` varchar(30) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mobno` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `cityID` int(11) NOT NULL,
  `regDate` datetime DEFAULT NULL,
  `loginDate` datetime DEFAULT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `studenttb`
--

INSERT INTO `studenttb` (`sid`, `fname`, `lname`, `pic`, `email`, `pass`, `mobno`, `address`, `cityID`, `regDate`, `loginDate`, `statusID`) VALUES
(110, 'Kushal', 'Majiwala', '../images/car1.jpg', 'kushal@gmail.com', 'kushal123', '9106884674', 'Adajan', 1, '2022-05-16 09:55:39', '2023-05-10 10:46:07', 1),
(111, 'yug', 'Majiwala', '../images/defaultStud.jpg', 'yug@gmail.com', 'yug12345', '9233567654', 'Adajan', 1, '2022-05-18 10:16:39', '2022-06-21 09:55:21', 2),
(112, 'ujjaval', 'patel', '../images/image3.jpg', 'ujjaval@gmail.com', 'ujjaval12', '9876789876', 'adajan', 1, '2022-05-24 19:42:34', '2022-05-24 19:42:48', 2),
(114, 'Aryan', 'Khuman', '../images/image3.jpg', 'aryan@gmail.com', 'aryan123', '9106884674', 'adajan', 1, '2022-06-04 19:25:16', '2022-06-22 11:12:46', 2),
(116, 'samarth', 'dastanwala', '../images/car.jpg', 'samarth@gmail.com', 'samarth123', '9233567657', 'Adajan', 1, '2022-06-17 09:29:49', '2022-06-17 09:30:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjectmaster`
--

CREATE TABLE `subjectmaster` (
  `subID` int(11) NOT NULL,
  `subName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjectmaster`
--

INSERT INTO `subjectmaster` (`subID`, `subName`) VALUES
(1, 'Mathematics'),
(2, 'English'),
(3, 'Physics'),
(4, 'Chemistry'),
(5, 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `tutortb`
--

CREATE TABLE `tutortb` (
  `tid` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `pic` varchar(200) DEFAULT '../images/defaultStud.jpg',
  `subID` int(11) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mobno` varchar(10) NOT NULL,
  `qual` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `cityID` int(11) DEFAULT NULL,
  `fee` int(20) DEFAULT NULL,
  `regDate` datetime DEFAULT NULL,
  `loginDate` datetime DEFAULT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tutortb`
--

INSERT INTO `tutortb` (`tid`, `fname`, `lname`, `pic`, `subID`, `email`, `pass`, `mobno`, `qual`, `address`, `cityID`, `fee`, `regDate`, `loginDate`, `statusID`) VALUES
(1028, 'Jayneel', 'Jariwala', '../images/car.jpg', 2, 'jayneel@gmail.com', 'jayneel12', '7878962975', 'bcom', 'Sagrampura', 2, 2000, '2022-06-06 09:53:47', '2023-01-09 12:39:15', 2),
(1029, 'meghna', 'Majiwala', '../images/defaultStud.jpg', 5, 'meghna@gmail.com', 'meghna12', '9106884674', 'bcom', 'Adajan', 1, 5000, '2022-06-06 09:55:22', '2022-06-22 08:05:32', 2),
(1031, 'Tara', 'Majiwala', '../images/defaultStud.jpg', 2, 'tara@gmail.com', 'tara1234', '7878962975', 'IT', 'Adajan', 1, 4000, '2022-06-21 18:10:15', '2022-06-21 18:23:12', 2),
(1034, 'Raj', 'Patel', '../images/defaultStud.jpg', 1, 'raj@gmail.com', 'raj12345', '9106884674', 'mscit', 'Adajan', 1, 4000, '2022-06-21 18:14:45', '2022-06-22 11:17:34', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `bookmarktb`
--
ALTER TABLE `bookmarktb`
  ADD PRIMARY KEY (`bookmarkID`),
  ADD KEY `sid` (`sid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `booktb`
--
ALTER TABLE `booktb`
  ADD PRIMARY KEY (`bookid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `citymaster`
--
ALTER TABLE `citymaster`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `ratingtb`
--
ALTER TABLE `ratingtb`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `tid` (`tid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `requeststatus`
--
ALTER TABLE `requeststatus`
  ADD PRIMARY KEY (`reqID`);

--
-- Indexes for table `requesttb`
--
ALTER TABLE `requesttb`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `reqID` (`reqID`);

--
-- Indexes for table `statusmaster`
--
ALTER TABLE `statusmaster`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `studenttb`
--
ALTER TABLE `studenttb`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `statusID` (`statusID`),
  ADD KEY `cityID` (`cityID`);

--
-- Indexes for table `subjectmaster`
--
ALTER TABLE `subjectmaster`
  ADD PRIMARY KEY (`subID`);

--
-- Indexes for table `tutortb`
--
ALTER TABLE `tutortb`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `subID` (`subID`),
  ADD KEY `statusID` (`statusID`),
  ADD KEY `cityID` (`cityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarktb`
--
ALTER TABLE `bookmarktb`
  MODIFY `bookmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `booktb`
--
ALTER TABLE `booktb`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `citymaster`
--
ALTER TABLE `citymaster`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratingtb`
--
ALTER TABLE `ratingtb`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `requeststatus`
--
ALTER TABLE `requeststatus`
  MODIFY `reqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requesttb`
--
ALTER TABLE `requesttb`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `statusmaster`
--
ALTER TABLE `statusmaster`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studenttb`
--
ALTER TABLE `studenttb`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `subjectmaster`
--
ALTER TABLE `subjectmaster`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tutortb`
--
ALTER TABLE `tutortb`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1036;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarktb`
--
ALTER TABLE `bookmarktb`
  ADD CONSTRAINT `bookmarktb_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `studenttb` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarktb_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tutortb` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booktb`
--
ALTER TABLE `booktb`
  ADD CONSTRAINT `booktb_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `studenttb` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booktb_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tutortb` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratingtb`
--
ALTER TABLE `ratingtb`
  ADD CONSTRAINT `ratingtb_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tutortb` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratingtb_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `studenttb` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requesttb`
--
ALTER TABLE `requesttb`
  ADD CONSTRAINT `requesttb_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `studenttb` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requesttb_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tutortb` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requesttb_ibfk_3` FOREIGN KEY (`reqID`) REFERENCES `requeststatus` (`reqID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studenttb`
--
ALTER TABLE `studenttb`
  ADD CONSTRAINT `studenttb_ibfk_1` FOREIGN KEY (`statusID`) REFERENCES `statusmaster` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studenttb_ibfk_2` FOREIGN KEY (`cityID`) REFERENCES `citymaster` (`cityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutortb`
--
ALTER TABLE `tutortb`
  ADD CONSTRAINT `tutortb_ibfk_1` FOREIGN KEY (`subID`) REFERENCES `subjectmaster` (`subID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutortb_ibfk_2` FOREIGN KEY (`statusID`) REFERENCES `statusmaster` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutortb_ibfk_3` FOREIGN KEY (`cityID`) REFERENCES `citymaster` (`cityID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
