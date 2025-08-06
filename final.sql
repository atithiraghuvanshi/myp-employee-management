-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 08:21 AM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `posted_on` datetime DEFAULT current_timestamp(),
  `posted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `posted_on`, `posted_at`) VALUES
(1, 'New engine launch', 'It is going to be launched tomorrow\r\n', '2025-07-23 09:28:00', '2025-07-23 09:28:00'),
(2, 'Today is holiday', 'stay at home', '2025-07-23 09:41:25', '2025-07-23 09:41:25'),
(3, 'Holiday', 'Shivratri', '2025-07-23 10:09:26', '2025-07-23 10:09:26');

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
(5, 'Atithi Singh', 'ABC', '2003-08-30', 'atithiraghuvanshi@gmail.com', '123456', 'female', 'divorced', 'Shamshan Ghat', '6006141058', 'Bhojpuri Hindi English Farasi Sanskrit ', 'Sleeping, Sudoku', 'India', 'KIET Group of Institutions', 'Ghaziabad', 'CS', 'Btech', '7.4', 'Java', 'Sleeping Coach', 'Software Developer', '30803', '2025-07-16', '100000000', 22, 'Yes, I am interested', 'Good', 'Not Accepted'),
(28, 'Shaurya Raghuvanshi', 'Arvind Kumar Singh', '2018-07-15', 'atithi.2226cs1179@kiet.edu', '', 'Male', 'Married', 'KIET Group of Institutions Muradnagar', '564654545654', 'Hindi', 'playing', 'INDIAN', 'St Mary\'s Convent School', 'Varanasi', 'CS', 'Btech', '97', 'fewfew', 'fwef', 'fefe', 'fefef', '2008-05-06', '4585456435', 0, 'KIET Group of Institutions', 'dkl', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `applied_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `leave_type`, `from_date`, `to_date`, `reason`, `status`, `applied_on`, `email`) VALUES
(1, 'Sick', '2026-02-05', '2026-02-06', 'Sick', 'Approved', '2025-07-23 04:21:40', 'atithiraghuvanshi@gmail.com'),
(2, 'Sick', '2026-02-05', '2026-02-06', 'sick', 'Approved', '2025-07-23 04:38:13', 'atithiraghuvanshi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `email`, `pass`) VALUES
(2, 'atithiraghuvanshi@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_details`
--
ALTER TABLE `emp_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
