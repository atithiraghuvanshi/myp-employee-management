-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2025 at 02:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `lang` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `cplace` varchar(100) DEFAULT NULL,
  `cdept` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `cgp` varchar(10) DEFAULT NULL,
  `clang` text DEFAULT NULL,
  `job_pos` varchar(100) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL,
  `emp_id` varchar(50) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `salary` varchar(20) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `work` varchar(20) DEFAULT NULL,
  `terms` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`id`, `name`, `fname`, `dob`, `email`, `Password`, `gender`, `marital_status`, `address`, `phone`, `lang`, `hobbies`, `nationality`, `college`, `cplace`, `cdept`, `course`, `cgp`, `clang`, `job_pos`, `dept`, `emp_id`, `doj`, `salary`, `experience`, `company`, `work`, `terms`) VALUES
(1, 'Priyanshu Tiwari', '', '2005-05-04', 'priyanshu22tiwari@gmail.com', '123456', 'male', 'single', 'Chhabinathpur ps jigna distc mirzapur Uttar pradesh', '56', 'dfd', 'df', 'india', 'Rajkiya engineering collage ', 'mirzapur', 'cse', 'btecgh', '8.544', '4', 'hr', 'Software Developer', '44646', '2025-07-31', '10000000', 5, 'Yes, I am interested', 'Good', 'Accepted Terms'),
(4, 'Amit kumar tiwari', 'Roshan singh', '2004-06-15', 'priyanshu33@gmail.com', '123456', 'male', 'single', 'varanshi', '635289635', 'English', 'football', 'india', 'Ajay kumar garg', 'noida', 'cse', 'Btech', '7.9', 'java', 'IT software', 'Adiministration', '57100', '2025-07-15', '532000', 4, 'Yes, I am interested', 'Good', 'Accepted Terms'),
(5, 'Atithi Singh', 'ABC', '2003-08-30', 'atithiraghuvanshi@gmail.com', '123456', 'female', 'divorced', 'Shamshan Ghat', '6006141058', 'Bhojpuri Hindi English Farasi Sanskrit ', 'Sleeping, Sudoku', 'India', 'KIET Group of Institutions', 'Ghaziabad', 'CS', 'Btech', '7.4', 'Java', 'Sleeping Coach', 'Software Developer', '30803', '2025-07-16', '100000000', 22, 'Yes, I am interested', 'Good', 'Not Accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_details`
--
ALTER TABLE `emp_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
