-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2015 at 12:45 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecomplaints`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(25) NOT NULL,
  `step1password` varchar(75) NOT NULL,
  `step2password` varchar(75) NOT NULL,
  `loginhistory` varchar(250) NOT NULL,
  `adminid` int(11) NOT NULL,
  `emailid` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `step1password`, `step2password`, `loginhistory`, `adminid`, `emailid`) VALUES
('admin', 'admin', 'admin', '-------', 1, 'admin@ecomplaints.esy.es');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `complaintid` int(11) NOT NULL,
  `userid` int(15) NOT NULL,
  `deptid` int(4) NOT NULL,
  `status` varchar(15) NOT NULL,
  `subject` varchar(35) NOT NULL,
  `body` varchar(150) NOT NULL,
  `feedback` varchar(50) NOT NULL,
  `traversaldetails` varchar(250) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaintid`, `userid`, `deptid`, `status`, `subject`, `body`, `feedback`, `traversaldetails`, `date`) VALUES
(1, 1, 1, 'active', 'no problem', 'yes problem', 'Nothing', '...000...', '23-03-2015');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `sitename` varchar(35) NOT NULL,
  `sitestatus` int(1) NOT NULL,
  `allowregister` int(1) NOT NULL,
  `allowlogin` int(1) NOT NULL,
  `stopaddingcomplaints` int(1) NOT NULL,
  `supportemail` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`sitename`, `sitestatus`, `allowregister`, `allowlogin`, `stopaddingcomplaints`, `supportemail`) VALUES
('E-complaints', 1, 1, 1, 1, 'support@ecomplaints.esy.es');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contactuid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `subjects` varchar(100) NOT NULL,
  `ipaddress1` varchar(100) NOT NULL,
  `ipaddress2` varchar(100) NOT NULL,
  `ipaddress3` varchar(100) NOT NULL,
  `userid` varchar(15) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `replay` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactuid`, `username`, `subjects`, `ipaddress1`, `ipaddress2`, `ipaddress3`, `userid`, `email`, `replay`) VALUES
(1, 'pramodh', '----Testing----', '2225252', '222222', '2222222', '1', 'pramodh@in.com', '---vfgdg---');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `deptid` int(4) NOT NULL,
  `deptname` varchar(25) NOT NULL,
  `visibility` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`deptid`, `deptname`, `visibility`) VALUES
(1, 'police', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `users` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `roleid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`users`, `status`, `roleid`) VALUES
('complainer', 1, 0),
('monitors', 1, 1),
('managers', 1, 2),
('assoc managers', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userid` int(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL,
  `deptid` int(4) NOT NULL,
  `aadhar` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `verificationkey` varchar(15) NOT NULL,
  `block` int(1) NOT NULL,
  `address` varchar(40) NOT NULL,
  `phno` varchar(13) NOT NULL,
  `gender` varchar(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `username`, `password`, `type`, `deptid`, `aadhar`, `status`, `verificationkey`, `block`, `address`, `phno`, `gender`) VALUES
(3, 'kmubarak2010@gmail.com', 'mubarak', '123456', 'complainer', 0, '0', 0, '48062', 0, '0', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
 ADD PRIMARY KEY (`complaintid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`contactuid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userid`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userid` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
