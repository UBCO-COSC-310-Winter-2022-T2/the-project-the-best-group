-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Apr 14, 2023 at 04:26 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instaquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `permission` bit(1) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rtoken` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `permission`, `fname`, `lname`, `email`, `password`, `rtoken`) VALUES
(1, b'0', 'John', 'Doe', 'johndoe@mail.com', 'johnpw', '790c996e-d707-11ed-ae3a-0242ac130002'),
(2, b'1', 'Jane', 'Doe', 'janedoe@mail.com', 'janepw', '790dd059-d707-11ed-ae3a-0242ac130002'),
(3, b'0', 'Henry', 'Smith', 'hsmith@mail.com', 'henrypw', '790f3f80-d707-11ed-ae3a-0242ac130002'),
(4, b'1', 'Harold', 'Smith', 'haroldsmith@mail.com', 'haroldpw', '79107db2-d707-11ed-ae3a-0242ac130002'),
(5, b'0', 'Greg', 'Green', 'greggreen@mail.com', 'gregpw', '7911c7bf-d707-11ed-ae3a-0242ac130002'),
(6, b'1', 'Al', 'Anderson', 'alanderson@mail.com', 'alpw', '7913acb1-d707-11ed-ae3a-0242ac130002');

--
-- Triggers `accounts`
--
DELIMITER $$
CREATE TRIGGER `set_rtoken_default` BEFORE INSERT ON `accounts` FOR EACH ROW BEGIN
    SET NEW.rtoken = UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `sid` int NOT NULL,
  `qid` int NOT NULL,
  `answer` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cid` int NOT NULL,
  `cname` varchar(255) NOT NULL,
  `Iid` int NOT NULL,
  `sessions_held` int DEFAULT (0),
  `live` bit(1) DEFAULT (0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `cname`, `Iid`, `sessions_held`, `live`) VALUES
(1, 'Computer Human Interaction', 6, 1, b'0'),
(2, 'Machine Architecture', 4, 1, b'0'),
(3, 'Data Structures', 2, 1, b'0'),
(4, 'Intro To Database Systems', 4, 1, b'0'),
(5, 'Software Engineering', 2, 2, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `cid` int NOT NULL,
  `sid` int NOT NULL,
  `student_attendance` int DEFAULT (0),
  `sessions_held` int DEFAULT (0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`cid`, `sid`, `student_attendance`, `sessions_held`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(2, 3, 1, 1),
(3, 5, 1, 1),
(4, 3, 1, 1),
(4, 5, 1, 1),
(5, 5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int NOT NULL,
  `cid` int NOT NULL,
  `prompt` varchar(255) DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `answer` char(1) DEFAULT NULL,
  `live` tinyint(1) DEFAULT '0',
  `was_asked` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `cid`, `prompt`, `a`, `b`, `c`, `d`, `answer`, `live`, `was_asked`) VALUES
(1, 1, 'Which of the following is a problem with low-level programming', 'takes too long', 'user expectations can be too high', 'they are too small to see', 'none of these answers', 'D', 0, b'0'),
(2, 1, 'Which of these is the best description of a conceptual model', 'a very tall model', 'a high level description of how a systems organization/operation', 'a fully functional model', 'none of these answers', 'B', 0, b'0'),
(3, 1, 'Which of the following is the name of a common physical input device', 'cat', 'dog', 'mouse', 'rabbit', 'C', 0, b'0'),
(4, 1, 'What does UI stand for in computer science', 'User Interface', 'Usable Item', 'Unsafe Internet', 'Uncommon Identifier', 'A', 0, b'0'),
(5, 2, 'Which common symbol represents a register in MIPS code', '#', '@', '&', '$', 'D', 0, b'0'),
(6, 2, 'What does CPU stand for in computer science', 'Central Processing Unit', 'Cat Pull Under', 'Center Pile Unit', 'Central Password User', 'A', 0, b'0'),
(7, 3, 'Which of the following is a common data structure', 'HashPath', 'HillTop', 'HashMap', 'HelpTable', 'C', 0, b'0'),
(8, 3, 'Which of the following is NOT a common data structure', 'Array', 'ArrayList', 'Skip List', 'Arrow List', 'D', 0, b'0'),
(9, 3, 'Select the invalid time complexity', 'O(1)', 'O(n)', 'O(-2)', 'O(logn)', 'C', 0, b'0'),
(10, 4, 'Which of these is a common database', 'MongoDB', 'MangoDB', 'MondoDB', 'OrangeDB', 'A', 0, b'0'),
(11, 4, 'What does DBMS stand for', 'Database Management System', 'Database More Secure', 'Data Before Making System', 'Dont Build More Stacks', 'A', 0, b'0'),
(12, 4, 'Which of the following is not a DBMS', 'Google', 'MySQL', 'IBM DB2', 'Mircosoft Acess', 'A', 0, b'0'),
(13, 5, 'Which of the following is not a programming language', 'Python', 'Java', 'HTML', 'CSS', 'C', 0, b'0'),
(14, 5, 'Which of the following is not a version control system', 'Git', 'Subversion', 'Mercurial', 'MySQL', 'D', 0, b'0'),
(15, 5, 'Which of the following is not an operating system', 'Windows', 'Linux', 'macOS', 'Oracle', 'D', 0, b'0'),
(16, 5, 'Which of the following is not a software development methodology', 'Agile', 'Waterfall', 'Crumb', 'Scrum', 'C', 0, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `scoreid` int NOT NULL,
  `sid` int DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `totalCorrect` int DEFAULT NULL,
  `totalAsked` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`scoreid`, `sid`, `cid`, `totalCorrect`, `totalAsked`) VALUES
(1, 1, 1, 2, 4),
(2, 1, 2, 1, 2),
(3, 5, 3, 3, 3),
(4, 5, 4, 3, 3),
(5, 5, 5, 4, 4),
(6, 3, 4, 3, 3),
(7, 3, 2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`sid`,`qid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD UNIQUE KEY `unique_entry` (`cid`,`sid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`scoreid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `scoreid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
