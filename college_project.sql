-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2020 at 03:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_db`
--

CREATE TABLE `alert_db` (
  `teacher_id` text NOT NULL,
  `branch` text NOT NULL,
  `sub` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alert_db`
--

INSERT INTO `alert_db` (`teacher_id`, `branch`, `sub`, `sem`, `year`, `message`, `status`) VALUES
('v_patil', 'Computers', 'DSIP', '7', '2018-19', 'v_patil task\n', 0),
('v_patil', 'Computers', 'DSIP', '7', '2018-19', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'lmm', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'DSIP', '7', '2018-19', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'db', '4', '2019-20', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'dc', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'DSIP', '7', '2018-19', 'Alert from the HOD for completion of the task !!', 0),
('v_patil', 'Computers', 'lmm', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 1),
('v_patil', 'Computers', 'lmm', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 1),
('v_patil', 'Computers', 'lmm', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 1),
('v_patil', 'Computers', 'db', '4', '2019-20', 'Alert from the HOD for completion of the task !!', 1),
('v_patil', 'Computers', 'dc', '1', '2015-16', 'Alert from the HOD for completion of the task !!', 1),
('v_patil', 'Computers', 'DSIP', '7', '2018-19', 'Alert from the HOD for completion of the task !!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assign_data`
--

CREATE TABLE `assign_data` (
  `PRN` text NOT NULL,
  `teacher_id` text NOT NULL,
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `ques` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_data`
--

INSERT INTO `assign_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES
('1', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '13'),
('2', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '23'),
('3', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '32'),
('4', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '23'),
('5', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '31'),
('6', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '34'),
('7', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '54'),
('8', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '32'),
('9', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '12'),
('10', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '45'),
('11', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '33'),
('12', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '11'),
('13', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '66'),
('14', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '32'),
('15', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '41'),
('16', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '35'),
('17', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '23'),
('18', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '67'),
('19', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '43'),
('20', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '67'),
('1', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '13'),
('2', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '23'),
('3', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '32'),
('4', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '23'),
('5', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '31'),
('6', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '34'),
('7', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '54'),
('8', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '32'),
('9', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '12'),
('10', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '45'),
('11', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '33'),
('12', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '11'),
('13', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '66'),
('14', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '32'),
('15', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '41'),
('16', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '35'),
('17', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '23'),
('18', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '67'),
('19', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '43'),
('20', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '67'),
('1', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '13'),
('2', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '23'),
('3', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '32'),
('4', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '23'),
('5', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '31'),
('6', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '34'),
('7', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '54'),
('8', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '32'),
('9', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '12'),
('10', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '45'),
('11', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '33'),
('12', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '11'),
('13', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '66'),
('14', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '32'),
('15', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '41'),
('16', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '35'),
('17', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '23'),
('18', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '67'),
('19', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '43'),
('20', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '67');

-- --------------------------------------------------------

--
-- Table structure for table `Computers`
--

CREATE TABLE `Computers` (
  `Teacher-fname` text NOT NULL,
  `Teacher-sname` text NOT NULL,
  `sub_name` text NOT NULL,
  `teacher_id` text NOT NULL,
  `year` text NOT NULL,
  `semester` text NOT NULL,
  `subject-code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Computers`
--

INSERT INTO `Computers` (`Teacher-fname`, `Teacher-sname`, `sub_name`, `teacher_id`, `year`, `semester`, `subject-code`) VALUES
('Varsha', 'Patil', 'DSIP', 'v_patil', '2018-19', '7', 'CS701'),
('Varsha', 'Patil', 'NLP', 'v_patil', '2019-20', '8', 'CS801'),
('Aparna ', 'Bannore', 'DBMS', 'a_bannore', '2018-19', '3', 'CS501'),
('Deepti', 'Reddy', 'DC', 'deepti_reddy', '2019-20', '8', 'CS801'),
('Varsha', 'Patil', 'NLP', 'v_patil', '2017-18', '8', 'CS801'),
('Varsha', 'Patil', 'NLP', 'v_patil', '2025-26', '1', 'CS801'),
('Aparna ', 'Bannore', 'dbs', 'a_bannore', '2015-16', '1', '909'),
('Aparna ', 'Bannore', 'dbm', 'a_bannore', '2019-20', '8', '806'),
('Varsha', 'Patil', 'asd', 'v_patil', '2015-16', '2', 'jnge'),
('Aparna ', 'Bannore', 'rajasthan', 'a_bannore', '2019-20', '4', 'kota');

-- --------------------------------------------------------

--
-- Table structure for table `co_db`
--

CREATE TABLE `co_db` (
  `branch` text NOT NULL,
  `sub_name` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `co1` mediumtext NOT NULL,
  `co2` mediumtext NOT NULL,
  `co3` mediumtext NOT NULL,
  `co4` mediumtext NOT NULL,
  `co5` mediumtext NOT NULL,
  `co6` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_db`
--

INSERT INTO `co_db` (`branch`, `sub_name`, `sub_code`, `sem`, `year`, `co1`, `co2`, `co3`, `co4`, `co5`, `co6`) VALUES
('Computers', 'DSIP', 'CS701', '7', '2018-19', 'Understand Data Warehouse fundamentals, Data Mining Principles', 'Design data warehouse with dimensional modelling and apply OLAP operations	', 'Identify appropriate data mining algorithms to solve real world problems	', 'Compare and evaluate different data mining techniques like classification, prediction, clustering Credits and association rule mining	', 'Describe complex data types with respect to spatial and web mining.	', 'Benefit the user experiences towards research and innovation.	'),
('Computers', 'NLP', 'CS801', '8', '2019-20', 'Benefit the user experiences towards research and innovation. Benefit the user experiences towards research and innovation.	', 'Compare and evaluate different data mining techniques like classification, prediction, clustering Credits and association rule mining	', 'Identify appropriate data mining algorithms to solve real world problems	Identify appropriate data mining algorithms to solve real world problems	', 'Compare and evaluate different data mining techniques like classification, prediction, clustering Credits and association rule mining	', 'Identify appropriate data mining algorithms to solve real world problems	Design data warehouse with dimensional modelling and apply OLAP operations	', 'Design data warehouse with dimensional modelling and apply OLAP operations	Design data warehouse with dimensional modelling and apply OLAP operations	'),
('Computers', 'DBMS', 'CS501', '3', '2018-19', 'turks', 'hello', 'night', 'Otto', 'yut', 'bam ');

-- --------------------------------------------------------

--
-- Table structure for table `dash_data`
--

CREATE TABLE `dash_data` (
  `t_id` text NOT NULL,
  `f_name` text NOT NULL,
  `s_name` text NOT NULL,
  `sub` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `branch` text NOT NULL,
  `co_spec` int(11) NOT NULL,
  `po_spec` int(11) NOT NULL,
  `co_po_map` int(11) NOT NULL,
  `marks_map` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dash_data`
--

INSERT INTO `dash_data` (`t_id`, `f_name`, `s_name`, `sub`, `sem`, `year`, `branch`, `co_spec`, `po_spec`, `co_po_map`, `marks_map`) VALUES
('v_patil', 'abc', 'xyz', 'DSIP', '7', '2018-19', 'Computers', 0, 0, 0, 0),
('deepti_reddy', 'abc', 'xyz', 'DC', '8', '2019-20', 'Computers', 1, 1, 0, 1),
('v_patil', 'abc', 'xyz', 'NLP', '8', '2015-16', 'Computers', 0, 0, 0, 0),
('v_patil', 'Varsha', 'Patil', 'lmm', '1', '2015-16', 'Computers', 0, 0, 0, 0),
('v_patil', 'Varsha', 'Patil', 'dc', '1', '2015-16', 'Computers', 0, 0, 0, 0),
('v_patil', 'Varsha', 'Patil', 'db', '4', '2019-20', 'Computers', 0, 0, 0, 0),
('a_bannore', 'Aparna ', 'Bannore', 'dbs', '1', '2015-16', 'Computers', 0, 0, 0, 0),
('a_bannore', 'Aparna ', 'Bannore', 'dbm', '8', '2019-20', 'Computers', 0, 0, 0, 0),
('v_patil', 'Varsha', 'Patil', 'asd', '2', '2015-16', 'Computers', 0, 0, 0, 0),
('a_bannore', 'Aparna ', 'Bannore', 'rajasthan', '4', '2019-20', 'Computers', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oral_data`
--

CREATE TABLE `oral_data` (
  `PRN` text NOT NULL,
  `teacher_id` text NOT NULL,
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `ques` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oral_data`
--

INSERT INTO `oral_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES
('1', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '17'),
('2', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('3', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('4', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '16'),
('5', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('6', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '16'),
('7', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('8', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '19'),
('9', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '22'),
('10', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '17'),
('11', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('12', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('13', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '19'),
('14', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('15', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('16', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('17', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('18', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '19'),
('19', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('20', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '14');

-- --------------------------------------------------------

--
-- Table structure for table `po_db`
--

CREATE TABLE `po_db` (
  `branch` text NOT NULL,
  `year` text NOT NULL,
  `po1` text NOT NULL,
  `po2` text NOT NULL,
  `po3` text NOT NULL,
  `po4` text NOT NULL,
  `po5` text NOT NULL,
  `po6` text NOT NULL,
  `po7` text NOT NULL,
  `po8` text NOT NULL,
  `po9` text NOT NULL,
  `po10` text NOT NULL,
  `po11` text NOT NULL,
  `po12` text NOT NULL,
  `pso1` text NOT NULL,
  `pso2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_db`
--

INSERT INTO `po_db` (`branch`, `year`, `po1`, `po2`, `po3`, `po4`, `po5`, `po6`, `po7`, `po8`, `po9`, `po10`, `po11`, `po12`, `pso1`, `pso2`) VALUES
('Computers', '2019-20', 'hello', 'qwnj', 'jnqj', 'fejn', 'jkenfkj', 'nkjewn', 'nkjewn', 'jvewn', 'newj', 'newlvj', 'Junenejw', 'qwjnf', 'vnek', 'hi'),
('Computers', '2015-16', 'asfw', 'few', 'hbjhb', 'by', 'bb', 'fe', 'bh', 'bb', 'uhb', 'buy', 'bu', 'b', 'by', 'b'),
('Computers', '2025-26', 'erv', 'vgv', 'ginger', 'bread', 'yv', 'v', 'yv', 'v', 'wife', 'v', 'ghvhg', 'vhg', 're', 'gv');

-- --------------------------------------------------------

--
-- Table structure for table `sem_data`
--

CREATE TABLE `sem_data` (
  `PRN` text NOT NULL,
  `teacher_id` text NOT NULL,
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `1a` text NOT NULL,
  `1b` text NOT NULL,
  `1c` text NOT NULL,
  `1d` text NOT NULL,
  `2a` text NOT NULL,
  `2b` text NOT NULL,
  `3a` text NOT NULL,
  `3b` text NOT NULL,
  `4a` text NOT NULL,
  `4b` text NOT NULL,
  `5a` text NOT NULL,
  `5b` text NOT NULL,
  `6a` text NOT NULL,
  `6b` text NOT NULL,
  `6c` text NOT NULL,
  `6d` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sem_data`
--

INSERT INTO `sem_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `2a`, `2b`, `3a`, `3b`, `4a`, `4b`, `5a`, `5b`, `6a`, `6b`, `6c`, `6d`) VALUES
('1', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '1.5', '2', '1.5', '2', '2', '5', '1', '0', '5', '2', '2', '5', '1', '0', '5'),
('2', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '2', '3', '5', '2', '2', '4', '2', '3', '5'),
('3', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '0', '1', '0', '1', '1', '2', '3', '4', '4', '1', '1', '2', '3', '4', '4'),
('4', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '1', '4', '4', '4', '1', '1', '1', '4', '4', '4'),
('5', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('6', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '2', '2', '2', '2', '2', '5', '2', '1', '0', '2', '2', '5', '2', '1', '0'),
('7', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('8', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('9', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '1', '2', '1', '2', '2', '3', '4', '1', '3', '2', '2', '3', '4', '1', '3'),
('10', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '1', '2', '1', '2', '2', '5', '2', '1', '5', '2', '2', '5', '2', '1', '5'),
('11', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('12', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('13', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('14', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('15', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('16', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('17', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('18', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('19', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('20', 'v_patil', 'DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('1', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '1.5', '2', '1.5', '2', '2', '5', '1', '0', '5', '2', '2', '5', '1', '0', '5'),
('2', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '2', '3', '5', '2', '2', '4', '2', '3', '5'),
('3', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '0', '1', '0', '1', '1', '2', '3', '4', '4', '1', '1', '2', '3', '4', '4'),
('4', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '1', '4', '4', '4', '1', '1', '1', '4', '4', '4'),
('5', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('6', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '2', '2', '2', '2', '2', '5', '2', '1', '0', '2', '2', '5', '2', '1', '0'),
('7', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('8', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('9', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '1', '2', '1', '2', '2', '3', '4', '1', '3', '2', '2', '3', '4', '1', '3'),
('10', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '1', '2', '1', '2', '2', '5', '2', '1', '5', '2', '2', '5', '2', '1', '5'),
('11', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('12', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('13', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('14', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('15', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('16', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('17', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('18', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('19', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('20', 'v_patil', 'NLP', 'CS801', '7', '2018-19', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('1', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '1.5', '2', '1.5', '2', '2', '5', '1', '0', '5', '2', '2', '5', '1', '0', '5'),
('2', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '2', '2', '2', '2', '2', '4', '2', '3', '5', '2', '2', '4', '2', '3', '5'),
('3', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '0', '1', '0', '1', '1', '2', '3', '4', '4', '1', '1', '2', '3', '4', '4'),
('4', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '1', '4', '4', '4', '1', '1', '1', '4', '4', '4'),
('5', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('6', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '2', '2', '2', '2', '2', '5', '2', '1', '0', '2', '2', '5', '2', '1', '0'),
('7', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('8', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('9', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '1', '2', '1', '2', '2', '3', '4', '1', '3', '2', '2', '3', '4', '1', '3'),
('10', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '1', '2', '1', '2', '2', '5', '2', '1', '5', '2', '2', '5', '2', '1', '5'),
('11', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('12', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('13', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('14', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('15', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('16', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('17', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('18', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '2', '2', '2', '2', '2', '2', '4', '4', '5', '0', '2', '2', '4', '4', '5', '0'),
('19', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1.5', '1', '1.5', '1', '1', '3', '3', '1', '0', '1', '1', '3', '3', '1', '0'),
('20', 'deepti_reddy', 'DC', 'CS801', '8', '2019-20', '1', '1', '1', '1', '1', '1', '2', '5', '1', '0', '1', '1', '2', '5', '1', '0'),
('1', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', ''),
('2', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('3', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('4', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', ''),
('5', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '2', '2', '2', '2', '', '', '8', '8', '5', '', '', '', '4', '4', '5', '0'),
('6', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('7', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', ''),
('8', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('9', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('10', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('11', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', ''),
('12', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('13', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('14', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('15', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', ''),
('16', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('17', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('18', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '4', '4', '4', '', '', '7', '7', '', '', '8', '8', '5', '4', '3', '5'),
('19', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '4', '0', '4', '4', '8', '9', '', '', '8', '9', '', '', '5', '5', '5', '4'),
('20', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '5', '4', '5', '3', '9', '8', '', '', '6', '5', '7', '6', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_acc_db`
--

CREATE TABLE `teacher_acc_db` (
  `f_name` text NOT NULL,
  `s_name` text NOT NULL,
  `id` text NOT NULL,
  `password` text NOT NULL,
  `branch` text NOT NULL,
  `designation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_acc_db`
--

INSERT INTO `teacher_acc_db` (`f_name`, `s_name`, `id`, `password`, `branch`, `designation`) VALUES
('Varsha', 'Patil', 'v_patil', 'varsha123', 'Computers', 3),
('Aparna ', 'Bannore', 'a_bannore', 'aparna', 'Computers', 2),
('Atul', 'Kemkar', 'a_kemkar', 'kemkar_123', 'College', 1),
('Molly', 'Jackson', 'm_jackson', 'm_jack123', 'IT', 3),
('Allen', 'John', 'allen_john', 'allen_123', 'IT', 2),
('Deepti', 'Reddy', 'deepti_reddy', 'reddy1234', 'Computers', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tw_data`
--

CREATE TABLE `tw_data` (
  `PRN` text NOT NULL,
  `teacher_id` text NOT NULL,
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `ques` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tw_data`
--

INSERT INTO `tw_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES
('1', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '18'),
('2', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('3', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '18'),
('4', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '13'),
('5', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '22'),
('6', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('7', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('8', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '19'),
('9', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '22'),
('10', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '19'),
('11', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '16'),
('12', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '17'),
('13', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '16'),
('14', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '18'),
('15', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('16', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '21'),
('17', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '22'),
('18', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '17'),
('19', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '20'),
('20', 'a_bannore', 'DBMS', 'CS501', '3', '2018-19', '18');

-- --------------------------------------------------------

--
-- Table structure for table `ut2_co_marks`
--

CREATE TABLE `ut2_co_marks` (
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `1a` text NOT NULL,
  `1b` text NOT NULL,
  `1c` text NOT NULL,
  `1d` text NOT NULL,
  `1e` text NOT NULL,
  `1f` text NOT NULL,
  `2a` text NOT NULL,
  `2b` text NOT NULL,
  `3a` text NOT NULL,
  `3b` text NOT NULL,
  `teacher_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ut2_co_marks`
--

INSERT INTO `ut2_co_marks` (`sub`, `sub_code`, `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`, `teacher_id`) VALUES
('DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'v_patil'),
('DBMS', 'CS501', '3', '2018-19', '1', '2', '3', '1', '2', '3', '1', '2', '3', '1', 'a_bannore');

-- --------------------------------------------------------

--
-- Table structure for table `ut2_data`
--

CREATE TABLE `ut2_data` (
  `PRN` text NOT NULL,
  `Teacher_ID` text NOT NULL,
  `Subject` text NOT NULL,
  `Semester` text NOT NULL,
  `year` text NOT NULL,
  `1a` text NOT NULL,
  `1b` text NOT NULL,
  `1c` text NOT NULL,
  `1d` text NOT NULL,
  `1e` text NOT NULL,
  `1f` text NOT NULL,
  `2a` text NOT NULL,
  `2b` text NOT NULL,
  `3a` text NOT NULL,
  `3b` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ut2_data`
--

INSERT INTO `ut2_data` (`PRN`, `Teacher_ID`, `Subject`, `Semester`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`) VALUES
('1', 'v_patil', 'DSIP', '7', '2018-19', '2', '1', '2', '2', '1', '0', '0', '4', '4', '0'),
('2', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('3', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('4', 'v_patil', 'DSIP', '7', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('5', 'v_patil', 'DSIP', '7', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('6', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('7', 'v_patil', 'DSIP', '7', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('8', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('9', 'v_patil', 'DSIP', '7', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('10', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('11', 'v_patil', 'DSIP', '7', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('12', 'v_patil', 'DSIP', '7', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('13', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('14', 'v_patil', 'DSIP', '7', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('15', 'v_patil', 'DSIP', '7', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('16', 'v_patil', 'DSIP', '7', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('17', 'v_patil', 'DSIP', '7', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('18', 'v_patil', 'DSIP', '7', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('19', 'v_patil', 'DSIP', '7', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('20', 'v_patil', 'DSIP', '7', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('1', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '0', '0', '4', '4', '0'),
('2', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('3', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('4', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('5', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('6', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('7', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('8', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('9', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('10', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('11', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('12', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('13', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('14', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('15', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('16', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('17', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('18', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('19', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('20', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `ut_co_marks`
--

CREATE TABLE `ut_co_marks` (
  `sub` text NOT NULL,
  `sub_code` text NOT NULL,
  `sem` text NOT NULL,
  `year` text NOT NULL,
  `1a` text NOT NULL,
  `1b` text NOT NULL,
  `1c` text NOT NULL,
  `1d` text NOT NULL,
  `1e` text NOT NULL,
  `1f` text NOT NULL,
  `2a` text NOT NULL,
  `2b` text NOT NULL,
  `3a` text NOT NULL,
  `3b` text NOT NULL,
  `teacher_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ut_co_marks`
--

INSERT INTO `ut_co_marks` (`sub`, `sub_code`, `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`, `teacher_id`) VALUES
('DBMS', 'CS501', '3', '2018-19', '4', '3', '2', '4', '3', '2', '2', '1', '1', '3', 'a_bannore'),
('DSIP', 'CS701', '7', '2018-19', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'v_patil'),
('dbs', '909', '1', '2015-16', '1', '1', '1', '1', '1', '6', '1', '1', '1', '1', 'a_bannore');

-- --------------------------------------------------------

--
-- Table structure for table `ut_data`
--

CREATE TABLE `ut_data` (
  `PRN` text NOT NULL,
  `Teacher_ID` text NOT NULL,
  `Subject` text NOT NULL,
  `Semester` text NOT NULL,
  `year` text NOT NULL,
  `1a` text NOT NULL,
  `1b` text NOT NULL,
  `1c` text NOT NULL,
  `1d` text NOT NULL,
  `1e` text NOT NULL,
  `1f` text NOT NULL,
  `2a` text NOT NULL,
  `2b` text NOT NULL,
  `3a` text NOT NULL,
  `3b` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ut_data`
--

INSERT INTO `ut_data` (`PRN`, `Teacher_ID`, `Subject`, `Semester`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`) VALUES
('1', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '0', '0', '4', '4', '0'),
('2', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('3', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('4', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('5', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('6', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('7', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('8', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('9', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('10', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('11', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('12', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('13', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('14', 'a_bannore', 'DBMS', '3', '2018-19', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('15', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('16', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('17', 'a_bannore', 'DBMS', '3', '2018-19', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('18', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('19', 'a_bannore', 'DBMS', '3', '2018-19', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('20', 'a_bannore', 'DBMS', '3', '2018-19', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('1', 'v_patil', 'NLP', '8', '2019-20', '2', '1', '2', '2', '1', '0', '0', '4', '4', '0'),
('2', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('3', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('4', 'v_patil', 'NLP', '8', '2019-20', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('5', 'v_patil', 'NLP', '8', '2019-20', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('6', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('7', 'v_patil', 'NLP', '8', '2019-20', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('8', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('9', 'v_patil', 'NLP', '8', '2019-20', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('10', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('11', 'v_patil', 'NLP', '8', '2019-20', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('12', 'v_patil', 'NLP', '8', '2019-20', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('13', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('14', 'v_patil', 'NLP', '8', '2019-20', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('15', 'v_patil', 'NLP', '8', '2019-20', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('16', 'v_patil', 'NLP', '8', '2019-20', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('17', 'v_patil', 'NLP', '8', '2019-20', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('18', 'v_patil', 'NLP', '8', '2019-20', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('19', 'v_patil', 'NLP', '8', '2019-20', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('20', 'v_patil', 'NLP', '8', '2019-20', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('1', 'a_bannore', 'dbs', '1', '2015-16', '2', '1', '2', '2', '1', '0', '0', '4', '4', '0'),
('2', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('3', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('4', 'a_bannore', 'dbs', '1', '2015-16', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('5', 'a_bannore', 'dbs', '1', '2015-16', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('6', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('7', 'a_bannore', 'dbs', '1', '2015-16', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('8', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('9', 'a_bannore', 'dbs', '1', '2015-16', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('10', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('11', 'a_bannore', 'dbs', '1', '2015-16', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('12', 'a_bannore', 'dbs', '1', '2015-16', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('13', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', ''),
('14', 'a_bannore', 'dbs', '1', '2015-16', '2', '1', '2', '2', '1', '2', '0', '4', '4', '0'),
('15', 'a_bannore', 'dbs', '1', '2015-16', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('16', 'a_bannore', 'dbs', '1', '2015-16', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('17', 'a_bannore', 'dbs', '1', '2015-16', '2', '2', '2', '0', '2', '2', '0', '5', '0', '5'),
('18', 'a_bannore', 'dbs', '1', '2015-16', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('19', 'a_bannore', 'dbs', '1', '2015-16', '1', '1', '1', '2', '2', '0', '3', '0', '0', '2'),
('20', 'a_bannore', 'dbs', '1', '2015-16', '0', '2', '1', '2', '2', '2', '5', '0', '5', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher_acc_db`
--
ALTER TABLE `teacher_acc_db`
  ADD UNIQUE KEY `id` (`id`) USING HASH;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
