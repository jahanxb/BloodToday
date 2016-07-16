-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2016 at 11:28 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blooddbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressID` int(11) NOT NULL,
  `Country_CountryID` int(11) DEFAULT NULL,
  `City_CityID` int(11) DEFAULT NULL,
  `Province_ProvinceID` int(11) DEFAULT NULL,
  `CityArea_CityAreaID` int(11) DEFAULT NULL,
  `person_PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`AddressID`, `Country_CountryID`, `City_CityID`, `Province_ProvinceID`, `CityArea_CityAreaID`, `person_PersonID`) VALUES
(1, 1, 3, 1, 1, 1),
(3, 1, 2, 1, 3, 2),
(4, 1, 5, 2, 4, 3),
(5, 1, 10, 5, 5, 4),
(6, 1, 7, 3, 6, 5),
(7, 1, 2, 1, 7, 6),
(8, 1, 6, 3, 8, 7),
(9, 1, 4, 2, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`) VALUES
(1, 'jahanxbkhan@hotmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `bloodingre`
--

CREATE TABLE `bloodingre` (
  `ingredientID` int(11) NOT NULL,
  `incredientName` varchar(45) DEFAULT NULL,
  `incDescription` varchar(45) DEFAULT NULL,
  `incAmount` varchar(45) DEFAULT NULL,
  `Recipient_RecipientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityID` int(11) NOT NULL,
  `CityName` varchar(45) DEFAULT NULL,
  `Province_ProvinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `CityName`, `Province_ProvinceID`) VALUES
(1, 'Lahore', 1),
(2, 'Multan', 1),
(3, 'Khanewal', 1),
(4, 'Karachi', 2),
(5, 'Jamshoro', 2),
(6, 'Peshawar', 3),
(7, 'Swat', 3),
(8, 'Quetta', 4),
(9, 'Khuzdar', 4),
(10, 'Islamabad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cityarea`
--

CREATE TABLE `cityarea` (
  `CityAreaID` int(11) NOT NULL,
  `CityAreaName` varchar(150) DEFAULT NULL,
  `BlockNo` varchar(20) DEFAULT NULL,
  `StreetNo` varchar(20) DEFAULT NULL,
  `HouseNo` varchar(20) DEFAULT NULL,
  `City_CityID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cityarea`
--

INSERT INTO `cityarea` (`CityAreaID`, `CityAreaName`, `BlockNo`, `StreetNo`, `HouseNo`, `City_CityID`) VALUES
(1, 'Madina town', 'Camp Chowk', '2', '22', 3),
(2, '', '', '', '', 2),
(3, '', '', '', '', 2),
(4, 'Seetpur', '', '', '', 5),
(5, 'G8 Markaz', 'F8', 'Embassy Road', '89C', 10),
(6, 'Mangora', 'LoairDair Road', 'Kali Bazar', '', 7),
(7, '', '', '', '', 2),
(8, 'Liaqat Bazaar', 'Pakhtoon Colony', 'Veran Gali', '137-B', 6),
(9, 'North Nazimabad', 'Edhi Block', 'C Block', '987', 4),
(10, '', '', '', '', 10),
(11, '', '', '', '', 10),
(12, '', '', '', '', 10),
(13, '', '', '', '', 10),
(14, '', '', '', '', 10),
(15, '', '', '', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`CountryID`, `CountryName`) VALUES
(1, 'Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `currentlocation`
--

CREATE TABLE `currentlocation` (
  `CurrentLocID` int(11) NOT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL,
  `person_PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currentlocation`
--

INSERT INTO `currentlocation` (`CurrentLocID`, `latitude`, `longitude`, `DateTime`, `person_PersonID`) VALUES
(1, '30.3039', '71.9299', '2016-07-08 14:28:23', 1),
(2, '31.6266', '71.0617', '2016-07-07 06:13:24', 2),
(3, '29.3882', '70.9190', '2016-07-01 19:38:17', 3),
(4, '30.1984', '71.4687', '2016-06-30 07:25:26', 4),
(5, '21.4324562346', '34.637618612', '0000-00-00 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `donorinfo`
--

CREATE TABLE `donorinfo` (
  `DonorInfoID` int(11) NOT NULL,
  `DonorInfo` varchar(45) DEFAULT NULL,
  `DonorProfile_DonorID` int(11) NOT NULL,
  `person_PersonID` int(11) DEFAULT NULL,
  `complaintINFO` varchar(255) DEFAULT NULL,
  `contactedBy` varchar(45) DEFAULT NULL,
  `contactedTo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donorinfo`
--

INSERT INTO `donorinfo` (`DonorInfoID`, `DonorInfo`, `DonorProfile_DonorID`, `person_PersonID`, `complaintINFO`, `contactedBy`, `contactedTo`) VALUES
(1, NULL, 1, 1, 'SECTION:10:User Not Responding', 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `donorprofile`
--

CREATE TABLE `donorprofile` (
  `LastBleedDate` date DEFAULT NULL,
  `QuantityGiven` varchar(45) DEFAULT NULL,
  `RecipientDetail` varchar(255) DEFAULT NULL,
  `DonorID` int(11) NOT NULL,
  `BodyWeight` varchar(45) DEFAULT NULL,
  `person_PersonID` int(11) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donorprofile`
--

INSERT INTO `donorprofile` (`LastBleedDate`, `QuantityGiven`, `RecipientDetail`, `DonorID`, `BodyWeight`, `person_PersonID`, `counter`) VALUES
('2014-08-06', NULL, 'Ibn-Sina Hospital,Multan', 1, '87', 1, NULL),
('2010-01-01', NULL, 'Northern Hospital', 2, '79', 3, NULL),
('2015-01-01', NULL, 'Radiology Centre Islamabad', 3, '81', 4, NULL),
('2016-05-05', NULL, 'Swat Med Complex', 4, '90', 5, NULL),
('2015-09-08', NULL, 'Nishat Clinic,Khanewal', 5, '89', 6, NULL),
('2014-12-09', NULL, 'Hasmath clinic', 6, '98', 6, NULL),
('2015-04-12', NULL, 'Unknown', 7, '81', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `HistoryID` int(255) NOT NULL,
  `DateTime` datetime DEFAULT NULL,
  `RecipientFlag` varchar(45) DEFAULT NULL,
  `DonorFlag` varchar(45) DEFAULT NULL,
  `contactedBy` varchar(45) NOT NULL,
  `contactedTo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`HistoryID`, `DateTime`, `RecipientFlag`, `DonorFlag`, `contactedBy`, `contactedTo`) VALUES
(1, NULL, NULL, NULL, '0', '0'),
(2, NULL, NULL, NULL, '0', '0'),
(3, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'abdul@razzaq.com'),
(4, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com'),
(5, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@yandex.com'),
(6, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'abdul@razzaq.com'),
(7, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com'),
(8, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'abdul@razzaq.com'),
(9, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'hasahdh'),
(10, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'abdul@razzaq.com'),
(11, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'abdul@razzaq.com'),
(12, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'shah@shah.com'),
(13, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'ahmad123@yahoo.com'),
(14, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'kkkk@kk.com'),
(15, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(16, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(17, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(18, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(19, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(20, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(21, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'muhammadirtaza007008@gmail.com'),
(22, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'muhammadirtaza007008@gmail.com'),
(23, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'muhammadirtaza007008@gmail.com'),
(24, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'razzaq144@hotmail.com'),
(25, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'razzaq144@hotmail.com'),
(26, NULL, NULL, NULL, 'Jahanxbkhan@hotmail.com', 'razzaq144@hotmail.com'),
(27, '0000-00-00 00:00:00', NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(28, '2016-09-10 09:09:00', NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(29, '2016-10-10 11:11:00', NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(30, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(31, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(32, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(33, NULL, NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(34, '2016-09-09 21:09:00', NULL, '1', 'Jahanxbkhan@hotmail.com', 'jahanxbkhan@hotmail.com'),
(35, '2016-08-01 12:02:00', NULL, '1', 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com'),
(36, '2016-09-09 12:12:00', '1', NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com'),
(37, '2016-12-01 21:09:00', '1', NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com'),
(38, '2017-01-01 13:01:00', '1', NULL, 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Date_of_birth` date NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `bloodGroup` varchar(45) NOT NULL,
  `user_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`PersonID`, `FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`) VALUES
(1, 'Muhammad jahanzeb', 'Khan', '1993-09-18', 'male', 'B+', 1),
(2, 'Syed Muhammad Irtaza', 'Shah Bukhari', '1991-01-01', 'male', 'B+', 2),
(3, 'Muhammad Talha', 'Ghaffar', '1992-09-12', 'male', 'O-', 3),
(4, 'Abdul', 'Razzaq', '1986-01-01', 'male', 'A+', 4),
(5, 'Badshah', 'Pathan', '1994-08-09', 'male', 'A-', 12),
(6, 'Muhammad Irtaza', 'Shah', '1994-09-06', 'male', 'A+', 13),
(7, 'Arjumand', 'Khan', '1994-01-10', 'male', 'AB+', 15),
(8, 'Ali', 'Zafar', '2001-11-11', 'male', 'A+', 16),
(9, 'Zunaira', 'Afridi', '1992-11-11', 'female', 'B+', 18);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `ProvinceID` int(11) NOT NULL,
  `ProvinceName` varchar(45) DEFAULT NULL,
  `Country_CountryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`ProvinceID`, `ProvinceName`, `Country_CountryID`) VALUES
(1, 'Punjab', 1),
(2, 'Sindh', 1),
(3, 'Kyber Pakhtoonkha', 1),
(4, 'Balochistan', 1),
(5, 'Capital Territory', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `RecipientID` int(11) NOT NULL,
  `IsRecipient` varchar(45) DEFAULT NULL,
  `RecievedBloodDate` date DEFAULT NULL,
  `RecievedBloodQuantity` varchar(45) DEFAULT NULL,
  `RefferedByWhom` varchar(45) DEFAULT NULL,
  `CentreOrHospital` varchar(255) DEFAULT NULL,
  `ReasonCauseDisease` varchar(45) DEFAULT NULL,
  `person_PersonID` int(11) DEFAULT NULL,
  `CurrentlyNeed` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`RecipientID`, `IsRecipient`, `RecievedBloodDate`, `RecievedBloodQuantity`, `RefferedByWhom`, `CentreOrHospital`, `ReasonCauseDisease`, `person_PersonID`, `CurrentlyNeed`) VALUES
(1, NULL, '2016-09-10', '351-400(mg/L)', 'Others', 'City Hospital,Multan', 'NotSpeicific', 1, 'YES'),
(2, NULL, '2015-08-08', '300-350(mg/L)', 'Plattelets', '', 'NotSpeicific', 2, 'NO'),
(3, NULL, '2016-06-06', '401-450(mg/L)', 'Whitecells', 'Nishter Medical', 'NotSpeicific', 3, 'NO'),
(4, NULL, '2016-02-02', '300-350(mg/L)', 'General', 'Chenab Hospital,Multan', 'NotSpeicific', 4, 'NO'),
(5, NULL, '2016-06-28', '351-400(mg/L)', 'Others', 'Peshawar Hospital', 'NotSpeicific', 5, 'YES'),
(6, NULL, '2016-09-06', '-Select Blood Range-', '-Select One-', 'Noir Clinic', 'Thelesimia', 6, 'YES'),
(7, NULL, '2016-09-07', '300-350(mg/L)', 'General', 'Imperial Medical College Hospital', 'Thelesimia', 7, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `recpinfo`
--

CREATE TABLE `recpinfo` (
  `RecpInfoID` int(11) NOT NULL,
  `RecpINFO` varchar(45) DEFAULT NULL,
  `Recipient_RecipientID` int(11) NOT NULL,
  `person_PersonID` int(11) DEFAULT NULL,
  `complaintINFO` varchar(255) DEFAULT NULL,
  `contactedBy` varchar(45) DEFAULT NULL,
  `contactedTo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recpinfo`
--

INSERT INTO `recpinfo` (`RecpInfoID`, `RecpINFO`, `Recipient_RecipientID`, `person_PersonID`, `complaintINFO`, `contactedBy`, `contactedTo`) VALUES
(1, NULL, 1, 1, 'R:SECTION:11:User is fraud', 'Jahanxbkhan@hotmail.com', 'Jahanxbkhan@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `testname`
--

CREATE TABLE `testname` (
  `TestNameID` int(11) NOT NULL,
  `TestDescription` varchar(45) DEFAULT NULL,
  `MinValue` varchar(45) DEFAULT NULL,
  `MaxValue` varchar(45) DEFAULT NULL,
  `NormalValue` varchar(45) DEFAULT NULL,
  `Other` varchar(45) DEFAULT NULL,
  `TestType_TestTypeID` int(11) NOT NULL,
  `TestType_DonorProfile_DonorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testtype`
--

CREATE TABLE `testtype` (
  `TestTypeID` int(11) NOT NULL,
  `TestDate` date DEFAULT NULL,
  `TestCentreOrHospital` varchar(45) DEFAULT NULL,
  `DonorProfile_DonorID` int(11) NOT NULL,
  `BloodTestTaken` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testtype`
--

INSERT INTO `testtype` (`TestTypeID`, `TestDate`, `TestCentreOrHospital`, `DonorProfile_DonorID`, `BloodTestTaken`) VALUES
(1, '2015-01-01', 'Radiology Centre Islamabad', 3, 'YES'),
(2, '0000-00-00', '', 4, '-Select One-'),
(3, '1991-01-01', 'Northern Hospital', 5, 'YES'),
(4, '0000-00-00', '', 6, 'NO'),
(5, '2015-03-12', 'KPK Nagar Hospital', 7, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `emailConfirmFlag` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `phoneNo` varchar(13) DEFAULT NULL,
  `UserConfirm` varchar(45) DEFAULT NULL,
  `RandomNumber` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `emailConfirmFlag`, `password`, `phoneNo`, `UserConfirm`, `RandomNumber`) VALUES
(1, 'Jahanxbkhan@hotmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880801', '1', '261112'),
(2, 'irtazashah@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880802', NULL, '549084'),
(3, 'talha@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880803', NULL, NULL),
(4, 'abdul@razzaq.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880804', NULL, NULL),
(5, 'arslanarshad07@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03007654321', NULL, NULL),
(11, 'iet.hacker05@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880814', '1', '636606'),
(12, 'Jahanxbkhan@yandex.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216880890', '1', '246918'),
(13, 'muhammadirtaza007008@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '0333336601', '1', '775813'),
(14, 'razzaq144@hotmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03017157144', '1', '464749'),
(15, 'youandmewillbeonfacebook@yahoo.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03216888012', '1', '286127'),
(16, 'alizafar@yandex.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03001233322', '1', '333591'),
(18, 'talhashah123@yahoo.com', NULL, '25d55ad283aa400af464c76d713c07ad', '03016880801', '1', '465577');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `UserRoleID` int(11) NOT NULL,
  `UserInfo` varchar(45) DEFAULT NULL,
  `UserRights` varchar(45) DEFAULT NULL,
  `user_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`UserRoleID`, `UserInfo`, `UserRights`, `user_userID`) VALUES
(1, 'ADMIN', 'FULL_ACCESS', 1),
(2, 'MODERATOR', 'REQUEST_PRIVILEGE_ACCESS', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`,`person_PersonID`),
  ADD KEY `fk_Address_person1_idx` (`person_PersonID`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodingre`
--
ALTER TABLE `bloodingre`
  ADD PRIMARY KEY (`ingredientID`,`Recipient_RecipientID`),
  ADD KEY `fk_Bloodingre_Recipient1_idx` (`Recipient_RecipientID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityID`,`Province_ProvinceID`),
  ADD KEY `fk_City_Province1_idx` (`Province_ProvinceID`);

--
-- Indexes for table `cityarea`
--
ALTER TABLE `cityarea`
  ADD PRIMARY KEY (`CityAreaID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `currentlocation`
--
ALTER TABLE `currentlocation`
  ADD PRIMARY KEY (`CurrentLocID`,`person_PersonID`),
  ADD KEY `fk_CurrentLocation_person1_idx` (`person_PersonID`);

--
-- Indexes for table `donorinfo`
--
ALTER TABLE `donorinfo`
  ADD PRIMARY KEY (`DonorInfoID`,`DonorProfile_DonorID`),
  ADD KEY `fk_HisDonor_DonorProfile1_idx` (`DonorProfile_DonorID`);

--
-- Indexes for table `donorprofile`
--
ALTER TABLE `donorprofile`
  ADD PRIMARY KEY (`DonorID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`HistoryID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`PersonID`,`user_userID`),
  ADD UNIQUE KEY `user_userID_UNIQUE` (`user_userID`),
  ADD KEY `fk_person_user1_idx` (`user_userID`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`ProvinceID`,`Country_CountryID`),
  ADD KEY `fk_Province_Country1_idx` (`Country_CountryID`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`RecipientID`);

--
-- Indexes for table `recpinfo`
--
ALTER TABLE `recpinfo`
  ADD PRIMARY KEY (`RecpInfoID`,`Recipient_RecipientID`),
  ADD KEY `fk_HisRecp_Recipient1_idx` (`Recipient_RecipientID`);

--
-- Indexes for table `testname`
--
ALTER TABLE `testname`
  ADD PRIMARY KEY (`TestNameID`,`TestType_TestTypeID`,`TestType_DonorProfile_DonorID`),
  ADD KEY `fk_TestName_TestType1_idx` (`TestType_TestTypeID`,`TestType_DonorProfile_DonorID`);

--
-- Indexes for table `testtype`
--
ALTER TABLE `testtype`
  ADD PRIMARY KEY (`TestTypeID`,`DonorProfile_DonorID`),
  ADD KEY `fk_TestType_DonorProfile1_idx` (`DonorProfile_DonorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `phoneNo_UNIQUE` (`phoneNo`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`UserRoleID`,`user_userID`),
  ADD KEY `fk_UserRole_user1_idx` (`user_userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cityarea`
--
ALTER TABLE `cityarea`
  MODIFY `CityAreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `currentlocation`
--
ALTER TABLE `currentlocation`
  MODIFY `CurrentLocID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `donorinfo`
--
ALTER TABLE `donorinfo`
  MODIFY `DonorInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `donorprofile`
--
ALTER TABLE `donorprofile`
  MODIFY `DonorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `HistoryID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `ProvinceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `RecipientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `recpinfo`
--
ALTER TABLE `recpinfo`
  MODIFY `RecpInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testtype`
--
ALTER TABLE `testtype`
  MODIFY `TestTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `UserRoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_Address_person1` FOREIGN KEY (`person_PersonID`) REFERENCES `person` (`PersonID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bloodingre`
--
ALTER TABLE `bloodingre`
  ADD CONSTRAINT `fk_Bloodingre_Recipient1` FOREIGN KEY (`Recipient_RecipientID`) REFERENCES `recipient` (`RecipientID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_City_Province1` FOREIGN KEY (`Province_ProvinceID`) REFERENCES `province` (`ProvinceID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `currentlocation`
--
ALTER TABLE `currentlocation`
  ADD CONSTRAINT `fk_CurrentLocation_person1` FOREIGN KEY (`person_PersonID`) REFERENCES `person` (`PersonID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `donorinfo`
--
ALTER TABLE `donorinfo`
  ADD CONSTRAINT `fk_HisDonor_DonorProfile1` FOREIGN KEY (`DonorProfile_DonorID`) REFERENCES `donorprofile` (`DonorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_person_user1` FOREIGN KEY (`user_userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `fk_Province_Country1` FOREIGN KEY (`Country_CountryID`) REFERENCES `country` (`CountryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recpinfo`
--
ALTER TABLE `recpinfo`
  ADD CONSTRAINT `fk_HisRecp_Recipient1` FOREIGN KEY (`Recipient_RecipientID`) REFERENCES `recipient` (`RecipientID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `testname`
--
ALTER TABLE `testname`
  ADD CONSTRAINT `fk_TestName_TestType1` FOREIGN KEY (`TestType_TestTypeID`,`TestType_DonorProfile_DonorID`) REFERENCES `testtype` (`TestTypeID`, `DonorProfile_DonorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `testtype`
--
ALTER TABLE `testtype`
  ADD CONSTRAINT `fk_TestType_DonorProfile1` FOREIGN KEY (`DonorProfile_DonorID`) REFERENCES `donorprofile` (`DonorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `fk_UserRole_user1` FOREIGN KEY (`user_userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
