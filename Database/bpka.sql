-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2015 at 01:28 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bpka`
--
CREATE DATABASE IF NOT EXISTS `bpka` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bpka`;

-- --------------------------------------------------------

--
-- Table structure for table `Activity`
--

CREATE TABLE IF NOT EXISTS `Activity` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Admin` int(10) NOT NULL,
  `Closed` tinyint(1) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  `Description` mediumtext,
  `End` time NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `Location` int(10) NOT NULL,
  `Note` mediumtext,
  `Period` int(10) NOT NULL,
  `Publish` tinyint(1) NOT NULL,
  `Start` time NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Type` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Activity`
--

INSERT INTO `Activity` (`Id`, `Admin`, `Closed`, `Code`, `Date`, `Description`, `End`, `LastUpdate`, `Location`, `Note`, `Period`, `Publish`, `Start`, `Title`, `Type`, `LockField`) VALUES
(1, 0, 0, 'A001', '2015-02-11 00:00:00', '123456768', '09:00:00', '2015-02-10 20:05:29', 1, 'asdafgfhk', 1, 1, '07:00:00', 'Seminar Bahasa Inggris', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ActivityCompetency`
--

CREATE TABLE IF NOT EXISTS `ActivityCompetency` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Activity` int(10) NOT NULL,
  `Competency` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ActivityCompetency`
--

INSERT INTO `ActivityCompetency` (`Id`, `Activity`, `Competency`, `LockField`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ActivityParticipant`
--

CREATE TABLE IF NOT EXISTS `ActivityParticipant` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Activity` int(10) NOT NULL,
  `AvailableSeat` int(10) NOT NULL,
  `ParticipantType` int(10) NOT NULL,
  `RegistrationLimit` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ActivityParticipant`
--

INSERT INTO `ActivityParticipant` (`Id`, `Activity`, `AvailableSeat`, `ParticipantType`, `RegistrationLimit`, `LockField`) VALUES
(1, 1, 70, 1, 70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ActivityStudent`
--

CREATE TABLE IF NOT EXISTS `ActivityStudent` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Activity` int(10) NOT NULL,
  `Note` varchar(10000) DEFAULT NULL,
  `Student` int(10) NOT NULL,
  `Attended` tinyint(1) NOT NULL,
  `ParticipantType` int(10) NOT NULL,
  `Status` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ActivityStudent`
--

INSERT INTO `ActivityStudent` (`Id`, `Activity`, `Note`, `Student`, `Attended`, `ParticipantType`, `Status`, `LockField`) VALUES
(1, 1, 'asdasdasdas', 11, 1, 3, 1, 11),
(2, 1, NULL, 12, 1, 1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Id`, `Username`, `Password`, `Name`, `Code`, `LockField`) VALUES
(1, 'wilson', '202cb962ac59075b964b07152d234b70', 'Wilson', '1131051', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Competency`
--

CREATE TABLE IF NOT EXISTS `Competency` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(1000) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Competency`
--

INSERT INTO `Competency` (`Id`, `Description`, `Name`, `Code`, `LockField`) VALUES
(1, 'Dapat berkomunikasi menggunakan bahasa jepang', 'Mampu Berbahasa Jepang', 'C001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `CompetencyPoint`
--

CREATE TABLE IF NOT EXISTS `CompetencyPoint` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ParticipantType` int(10) unsigned NOT NULL,
  `Admin` int(10) NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `Point` decimal(4,0) NOT NULL,
  `Competency` int(10) unsigned NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  `Period` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CompetencyPoint_ParticipantType` (`ParticipantType`),
  KEY `FK_CompetencyPoint_Competency` (`Competency`),
  KEY `FK_CompetencyPoint_Period` (`Period`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `CompetencyPoint`
--

INSERT INTO `CompetencyPoint` (`Id`, `ParticipantType`, `Admin`, `LastUpdate`, `Point`, `Competency`, `LockField`, `Period`) VALUES
(2, 3, 0, '1970-01-01 01:33:35', '85', 1, 1, 1),
(3, 1, 1, '1970-01-01 01:33:35', '100', 1, 0, 1),
(4, 2, 1, '1970-01-01 01:33:35', '85', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `CompetencySubject`
--

CREATE TABLE IF NOT EXISTS `CompetencySubject` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Competency` int(10) unsigned NOT NULL,
  `Subject` int(10) unsigned NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CompetencySubject_Competency` (`Competency`),
  KEY `FK_CompetencySubject_Subject` (`Subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `CompetencySubject`
--

INSERT INTO `CompetencySubject` (`Id`, `Competency`, `Subject`, `LockField`) VALUES
(2, 1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Competition`
--

CREATE TABLE IF NOT EXISTS `Competition` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Location` int(10) unsigned NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Status` int(10) NOT NULL,
  `Closed` tinyint(1) NOT NULL,
  `End` datetime NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Admin` int(10) unsigned NOT NULL,
  `Description` varchar(10000) DEFAULT NULL,
  `Start` datetime NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `Note` varchar(10000) DEFAULT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Competition_Location` (`Location`),
  KEY `FK_Competition_Admin` (`Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CompetitionParticipant`
--

CREATE TABLE IF NOT EXISTS `CompetitionParticipant` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AvailableSeat` int(10) NOT NULL,
  `Form` int(10) unsigned NOT NULL,
  `Competition` int(10) unsigned NOT NULL,
  `ParticipantType` int(10) unsigned NOT NULL,
  `RegistrationLimit` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CompetitionParticipant_Form` (`Form`),
  KEY `FK_CompetitionParticipant_Competition` (`Competition`),
  KEY `FK_CompetitionParticipant_ParticipantType` (`ParticipantType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CompetitionRank`
--

CREATE TABLE IF NOT EXISTS `CompetitionRank` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CompetitionStudent`
--

CREATE TABLE IF NOT EXISTS `CompetitionStudent` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FormResponse` int(10) unsigned DEFAULT NULL,
  `ParticipantType` int(10) unsigned NOT NULL,
  `Student` int(10) unsigned NOT NULL,
  `Rank` int(10) unsigned NOT NULL,
  `Atteded` tinyint(1) NOT NULL,
  `Approved` tinyint(1) NOT NULL,
  `Competition` int(10) unsigned NOT NULL,
  `Note` varchar(10000) DEFAULT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CompetitionStudent_FormResponse` (`FormResponse`),
  KEY `FK_CompetitionStudent_ParticipantType` (`ParticipantType`),
  KEY `FK_CompetitionStudent_Student` (`Student`),
  KEY `FK_CompetitionStudent_Rank` (`Rank`),
  KEY `FK_CompetitionStudent_Competition` (`Competition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CompetitionStudentCompetency`
--

CREATE TABLE IF NOT EXISTS `CompetitionStudentCompetency` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Competency` int(10) unsigned NOT NULL,
  `CompetitionStudent` int(10) unsigned NOT NULL,
  `Point` decimal(4,0) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CompetitionStudentCompetency_Competency` (`Competency`),
  KEY `FK_CompetitionStudentCompetency_CompetitionStudent` (`CompetitionStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `FieldsOfStudy`
--

CREATE TABLE IF NOT EXISTS `FieldsOfStudy` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `IndonesianName` varchar(50) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `FieldsOfStudy`
--

INSERT INTO `FieldsOfStudy` (`Id`, `Name`, `IndonesianName`, `Code`, `LockField`) VALUES
(2, 'Law Science', 'Ilmu Hukum', '01', 0),
(3, 'Accounting', 'Akuntansi', '02', 0),
(4, 'Management', 'Manajemen', '03', 0),
(5, 'Information System', 'Sistem Informasi', '31', 0),
(6, 'Electrical Engineering', 'teknik elektro', '04', 0),
(7, 'Civil Engineering', 'teknik sipil', '05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Form`
--

CREATE TABLE IF NOT EXISTS `Form` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `FormQuestion`
--

CREATE TABLE IF NOT EXISTS `FormQuestion` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Form` int(10) unsigned NOT NULL,
  `Question` int(10) unsigned NOT NULL,
  `Sequence` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_FormQuestion_Form` (`Form`),
  KEY `FK_FormQuestion_Question` (`Question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `FormResponse`
--

CREATE TABLE IF NOT EXISTS `FormResponse` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Answer` varchar(10000) DEFAULT NULL,
  `Sequence` int(10) NOT NULL,
  `Question` int(10) unsigned NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_FormResponse_Question` (`Question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`Id`, `Code`, `Name`, `LockField`) VALUES
(1, '001', 'UIB Gedung B Lantai I', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantType`
--

CREATE TABLE IF NOT EXISTS `ParticipantType` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ParticipantType`
--

INSERT INTO `ParticipantType` (`Id`, `Name`, `Code`, `LockField`) VALUES
(1, 'Participant', '001', 0),
(2, 'Jury', '002', 0),
(3, 'Organizer', '003', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Period`
--

CREATE TABLE IF NOT EXISTS `Period` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Note` varchar(10000) DEFAULT NULL,
  `LockField` int(10) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Period`
--

INSERT INTO `Period` (`Id`, `Code`, `Name`, `Note`, `LockField`, `Active`) VALUES
(1, '201501', 'Semester Ganjil 2015', NULL, 6, 0),
(3, 'jsahdka', 'kashdkahk', NULL, 5, 0),
(4, 'asjdkajl', 'asdasz', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(10000) NOT NULL,
  `AnswerType` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `QuestionAnswerList`
--

CREATE TABLE IF NOT EXISTS `QuestionAnswerList` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Question` int(10) unsigned NOT NULL,
  `Description` varchar(10000) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_QuestionAnswerList_Question` (`Question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Seminar`
--

CREATE TABLE IF NOT EXISTS `Seminar` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Note` varchar(10000) DEFAULT NULL,
  `LastUpdate` datetime NOT NULL,
  `Admin` int(10) unsigned NOT NULL,
  `End` datetime DEFAULT NULL,
  `Closed` tinyint(1) NOT NULL,
  `Status` int(10) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Location` int(10) unsigned NOT NULL,
  `Description` varchar(10000) DEFAULT NULL,
  `Start` datetime NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Seminar_Admin` (`Admin`),
  KEY `FK_Seminar_Location` (`Location`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SeminarCompetency`
--

CREATE TABLE IF NOT EXISTS `SeminarCompetency` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Seminar` int(10) unsigned NOT NULL,
  `Competency` int(10) unsigned NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_SeminarCompetency_Seminar` (`Seminar`),
  KEY `FK_SeminarCompetency_Competency` (`Competency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SeminarParticipant`
--

CREATE TABLE IF NOT EXISTS `SeminarParticipant` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Form` int(10) unsigned NOT NULL,
  `ParticipantType` int(10) unsigned NOT NULL,
  `Seminar` int(10) unsigned NOT NULL,
  `RegistrationLimit` int(10) NOT NULL,
  `AvailableSeat` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_SeminarParticipant_Form` (`Form`),
  KEY `FK_SeminarParticipant_ParticipantType` (`ParticipantType`),
  KEY `FK_SeminarParticipant_Seminar` (`Seminar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SeminarStudent`
--

CREATE TABLE IF NOT EXISTS `SeminarStudent` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ParticipantType` int(10) unsigned NOT NULL,
  `Seminar` int(10) unsigned NOT NULL,
  `Attended` tinyint(1) NOT NULL,
  `Approved` tinyint(1) NOT NULL,
  `Student` int(10) unsigned NOT NULL,
  `FormResponse` int(10) unsigned DEFAULT NULL,
  `Note` varchar(10000) DEFAULT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_SeminarStudent_ParticipantType` (`ParticipantType`),
  KEY `FK_SeminarStudent_Seminar` (`Seminar`),
  KEY `FK_SeminarStudent_Student` (`Student`),
  KEY `FK_SeminarStudent_FormResponse` (`FormResponse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `ContactNo01` varchar(15) DEFAULT NULL,
  `IDCardNo` varchar(30) DEFAULT NULL,
  `ContactNo02` varchar(15) DEFAULT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `FieldsOfStudy` int(10) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL,
  `No` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Student_FieldsOfStudy` (`FieldsOfStudy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`Id`, `Username`, `ContactNo01`, `IDCardNo`, `ContactNo02`, `Gender`, `Address`, `FieldsOfStudy`, `Name`, `No`, `Password`, `LockField`, `Email`) VALUES
(11, 'wilson', '081991231812', '12345678', NULL, 0, 'Batam Center', 5, 'Wilson Young', '1131051', '', 1, ''),
(12, 'andi', NULL, NULL, NULL, 0, NULL, 5, 'Andi Susanto', '1131049', '1131049', 0, 'andi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `StudentCompetency`
--

CREATE TABLE IF NOT EXISTS `StudentCompetency` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Point` decimal(6,2) NOT NULL,
  `Student` int(10) NOT NULL,
  `Competency` int(10) NOT NULL,
  `Activity` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `StudentCompetency`
--

INSERT INTO `StudentCompetency` (`Id`, `Point`, `Student`, `Competency`, `Activity`, `LockField`) VALUES
(92, '12.00', 11, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

CREATE TABLE IF NOT EXISTS `Subject` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `FieldsOfStudy` int(10) NOT NULL,
  `LockField` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Subject`
--

INSERT INTO `Subject` (`Id`, `Code`, `Name`, `FieldsOfStudy`, `LockField`) VALUES
(1, 'SI0004', 'Algoritma & Pemrograman', 5, 0),
(3, 'SIL0044', 'Lab. Algoritma dan Pemrograman', 5, 0),
(4, 'SI00069', 'Matematika Komputer', 5, 0),
(5, 'SI00029', 'Pemrograman Berorientasi Obyek', 5, 0),
(6, 'SIL0046', 'Lab. Pemrograman Berorientasi Obyek', 5, 0),
(7, 'SIL0034', 'Struktur Data', 5, 0),
(8, 'SIL0045', 'Lab. Sistem Komputer', 5, 0),
(9, 'UM99001', 'Agama', 5, 0),
(10, 'UM99012', 'Bahasa Inggris I', 5, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CompetencyPoint`
--
ALTER TABLE `CompetencyPoint`
  ADD CONSTRAINT `FK_CompetencyPoint_Competency` FOREIGN KEY (`Competency`) REFERENCES `Competency` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetencyPoint_ParticipantType` FOREIGN KEY (`ParticipantType`) REFERENCES `ParticipantType` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetencyPoint_Period` FOREIGN KEY (`Period`) REFERENCES `Period` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `CompetencySubject`
--
ALTER TABLE `CompetencySubject`
  ADD CONSTRAINT `FK_CompetencySubject_Competency` FOREIGN KEY (`Competency`) REFERENCES `Competency` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetencySubject_Subject` FOREIGN KEY (`Subject`) REFERENCES `Subject` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `Competition`
--
ALTER TABLE `Competition`
  ADD CONSTRAINT `FK_Competition_Admin` FOREIGN KEY (`Admin`) REFERENCES `Admin` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Competition_Location` FOREIGN KEY (`Location`) REFERENCES `Location` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `CompetitionParticipant`
--
ALTER TABLE `CompetitionParticipant`
  ADD CONSTRAINT `FK_CompetitionParticipant_Competition` FOREIGN KEY (`Competition`) REFERENCES `Competition` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionParticipant_Form` FOREIGN KEY (`Form`) REFERENCES `Form` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionParticipant_ParticipantType` FOREIGN KEY (`ParticipantType`) REFERENCES `ParticipantType` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `CompetitionStudent`
--
ALTER TABLE `CompetitionStudent`
  ADD CONSTRAINT `FK_CompetitionStudent_Competition` FOREIGN KEY (`Competition`) REFERENCES `Competition` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionStudent_FormResponse` FOREIGN KEY (`FormResponse`) REFERENCES `FormResponse` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionStudent_ParticipantType` FOREIGN KEY (`ParticipantType`) REFERENCES `ParticipantType` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionStudent_Rank` FOREIGN KEY (`Rank`) REFERENCES `CompetitionRank` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionStudent_Student` FOREIGN KEY (`Student`) REFERENCES `Student` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `CompetitionStudentCompetency`
--
ALTER TABLE `CompetitionStudentCompetency`
  ADD CONSTRAINT `FK_CompetitionStudentCompetency_Competency` FOREIGN KEY (`Competency`) REFERENCES `Competency` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompetitionStudentCompetency_CompetitionStudent` FOREIGN KEY (`CompetitionStudent`) REFERENCES `CompetitionStudent` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `FormQuestion`
--
ALTER TABLE `FormQuestion`
  ADD CONSTRAINT `FK_FormQuestion_Form` FOREIGN KEY (`Form`) REFERENCES `Form` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FormQuestion_Question` FOREIGN KEY (`Question`) REFERENCES `Question` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `FormResponse`
--
ALTER TABLE `FormResponse`
  ADD CONSTRAINT `FK_FormResponse_Question` FOREIGN KEY (`Question`) REFERENCES `Question` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `QuestionAnswerList`
--
ALTER TABLE `QuestionAnswerList`
  ADD CONSTRAINT `FK_QuestionAnswerList_Question` FOREIGN KEY (`Question`) REFERENCES `Question` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `Seminar`
--
ALTER TABLE `Seminar`
  ADD CONSTRAINT `FK_Seminar_Admin` FOREIGN KEY (`Admin`) REFERENCES `Admin` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Seminar_Location` FOREIGN KEY (`Location`) REFERENCES `Location` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `SeminarCompetency`
--
ALTER TABLE `SeminarCompetency`
  ADD CONSTRAINT `FK_SeminarCompetency_Competency` FOREIGN KEY (`Competency`) REFERENCES `Competency` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarCompetency_Seminar` FOREIGN KEY (`Seminar`) REFERENCES `Seminar` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `SeminarParticipant`
--
ALTER TABLE `SeminarParticipant`
  ADD CONSTRAINT `FK_SeminarParticipant_Form` FOREIGN KEY (`Form`) REFERENCES `Form` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarParticipant_ParticipantType` FOREIGN KEY (`ParticipantType`) REFERENCES `ParticipantType` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarParticipant_Seminar` FOREIGN KEY (`Seminar`) REFERENCES `Seminar` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `SeminarStudent`
--
ALTER TABLE `SeminarStudent`
  ADD CONSTRAINT `FK_SeminarStudent_FormResponse` FOREIGN KEY (`FormResponse`) REFERENCES `FormResponse` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarStudent_ParticipantType` FOREIGN KEY (`ParticipantType`) REFERENCES `ParticipantType` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarStudent_Seminar` FOREIGN KEY (`Seminar`) REFERENCES `Seminar` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SeminarStudent_Student` FOREIGN KEY (`Student`) REFERENCES `Student` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `FK_Student_FieldsOfStudy` FOREIGN KEY (`FieldsOfStudy`) REFERENCES `FieldsOfStudy` (`Id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
