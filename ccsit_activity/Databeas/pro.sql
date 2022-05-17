-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 07:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Username` varchar(150) COLLATE latin1_bin NOT NULL,
  `ID` int(11) NOT NULL,
  `Fname` varchar(150) COLLATE latin1_bin NOT NULL,
  `Lname` varchar(150) COLLATE latin1_bin NOT NULL,
  `Email` varchar(150) COLLATE latin1_bin NOT NULL,
  `Pass` varchar(150) COLLATE latin1_bin NOT NULL,
  `Magor` varchar(2) COLLATE latin1_bin NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Username`, `ID`, `Fname`, `Lname`, `Email`, `Pass`, `Magor`, `Level`) VALUES
('Esoo', 216017755, 'Esraa', 'Alshareet', 'a.s.r.27718@gmail.com', '1234', 'CS', 6),
('Nabaa', 217018896, 'Nabaa', 'Jafar', 'nabaajafar3@gmail.com', '3333', 'CS', 5),
('hoor', 216088, 'hawraa', 'alsaleh', 'hwraalsaleh727@gmail.com', 'H123456', 'CS', 6),
('marwa', 12334321, 'marwa', 'sadiq', 'marwa_684@hotmail.com', '1234567890', 'IS', 6),
('mohammed_', 215099221, 'mohammed', 'Abdulmohsen', 'm.h.g.26298@gmail.com', '2222', 'CS', 7),
('zozo', 216019985, 'zinab', 'Ali', 'zinab244@hotmail.com', '8888', 'IS', 7);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(100) COLLATE latin1_bin NOT NULL,
  `password` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `clubrequest`
--

CREATE TABLE `clubrequest` (
  `No` int(11) NOT NULL,
  `Name` varchar(150) COLLATE latin1_bin NOT NULL,
  `About` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Vision` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Mission` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Objectives` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Programs` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Requirements` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Advantages` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Leader` varchar(150) COLLATE latin1_bin NOT NULL,
  `Img` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `clubrequest`
--

INSERT INTO `clubrequest` (`No`, `Name`, `About`, `Vision`, `Mission`, `Objectives`, `Programs`, `Requirements`, `Advantages`, `Leader`, `Img`) VALUES
(12, 'studentClup', 'general activity', '', '', '', '', '', '', 'hoor', 'img/clubs/game development.png'),
(13, 'examClup', 'for help student', '', '', '', '', '', '', 'hoor', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `No` int(11) NOT NULL,
  `Name` varchar(150) COLLATE latin1_bin NOT NULL,
  `About` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Vision` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Mission` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Objectives` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Programs` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Requirements` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Advantages` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Leader` varchar(150) COLLATE latin1_bin NOT NULL,
  `Img` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`No`, `Name`, `About`, `Vision`, `Mission`, `Objectives`, `Programs`, `Requirements`, `Advantages`, `Leader`, `Img`) VALUES
(1, 'Programming Club', 'The Programming Club is a club that is belong to the College of Computer Sciences and Information Technology at King Faisal University. It aims to promote and develop the programming culture by providing courses that enhance the knowledge and experience of programming.', 'Promoting and enhancing the knowledge of the different programming languages.', 'Supporting and motivating students to become professional and hardworking.', '- Motivating students\' self-learning.\r\n\r\n- Developing students\' skills in programming.\r\n\r\n- Motivating students to think, innovate, and show their talents.\r\n\r\n- Creating a spirit of teamwork.\r\n', '- Providing courses and workshops that are related to programming.\r\n\r\n- Participating in activities and conferences dealing with programming, whether inside or outside the college.\r\n\r\n- Organizing the programming contest and supervise it.', '-The member should be one of the King Faisal University students.\r\n-The member should have completed one or more programming courses.\r\n-The member should attend workshops, and participate, and be active\r\n-The member should attend the regular meetings of the club.', '', 'Esoo', 'img\\clubs\\PG.png'),
(2, 'Information Technology Club', 'Information Technology Club founded in 2007. It provides several lectures, programs and specialized training courses in Information Technology.', 'Preparing students with high abilities and skills which can allow them to perform their tasks efficiently and raise their skilled in the areas of Computer Science and Information Technology in order to achieve success and self-professional excellence.', 'Creating and raising the scientific and practical efficiency and helping students to achieve their academic goals, and to overcome technical problems. This is done by developing their skills, and giving them opportunities to solve technical problems.', '- Organizing training courses.\r\n- Organizing workshops.\r\n- Visiting external exhibitions.\r\n- Creating competitions among students by making some contests.\r\n- Preparing for internal exhibitions.', '', '- Being a student at King Faisal University.\r\n- Attending and participating in all meetings.\r\n- Contributing to the preparation and the coordination of the club’s activities.', '- The priority to attend sessions and activities.\r\n- Obtaining certificates of attendance for the made courses or workshops.\r\n- Getting support from the college when you show special skills.', 'mohammed_', 'img/clubs/IT.png'),
(10007, 'studentClup', 'general activity', '', '', '', '', '', '', 'hoor', 'img/clubs/game development.png');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `Email` varchar(150) COLLATE latin1_bin NOT NULL,
  `Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `user` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `No` int(11) NOT NULL,
  `Class` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `parent_comment_id`, `comment`, `user`, `date`, `No`, `Class`) VALUES
(23, 0, 'hi', 'marwa', '2019-12-18 05:01:40', 10001, 'news');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_bin NOT NULL,
  `start_event` date NOT NULL,
  `end_event` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `No` int(11) NOT NULL,
  `username` varchar(150) COLLATE latin1_bin NOT NULL,
  `club` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`No`, `username`, `club`) VALUES
(1, 'Esoo', 'Programming Club'),
(2, 'mohammed_', 'Information Technology Club'),
(3, 'mohammed_', 'Programming Club'),
(5, 'zozo', 'Information Technology Club'),
(6, 'hoor', 'studentClup');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `No` int(11) NOT NULL,
  `Title` varchar(150) COLLATE latin1_bin NOT NULL,
  `Details` varchar(2000) COLLATE latin1_bin NOT NULL,
  `Img` varchar(500) COLLATE latin1_bin NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`No`, `Title`, `Details`, `Img`, `Date`) VALUES
(10001, 'CCSIT\'s Programming Summer Camp\r\n', 'The College of Computer Science and Information Technology (female students sections) launched the activities of the technical camp \"CCSIT CAMP\" on Sunday morning, 17/12/1440 AH for its students in the college theater, in the presence of the Vice Dean Dr. Noura Al-Khalidi and faculty members and students participating in the camp, and the activities continue for two weeks continuously (4 Hours per day).\r\nThe college aims at organizing this camp to train students during the camp on a number of modern technologies such as smartphone applications, artificial intelligence and small control units, as well as informing students on the latest technical developments and the formation of groups of common interest between students and professors and to meet the needs of students by holding a number of workshops Through practical, realistic and entertaining activities.\r\nThe Program Committee oversees the implementation of the following scientific paths: the development of smartphone applications using Android, artificial intelligence and machine learning (Machine Learning), the basics of dealing with (Micro-Controllers), in addition to public seminars aimed at developing the skills of communication and interaction among students.\r\nThe camp is implemented by a number of distinguished faculty assistants. Safa Al-Salman The development of smartphone applications and remote Nora Al-Jaafari on the path of artificial intelligence and machine learning. Monira Al-Hajri is also in charge of dealing with small control units, and a number of faculty members conduct seminars related to the development of communication and interaction skills of students.\r\nThe Dean of the College of Computer Science and Information Technology, Dr. Majed bin Adi Al Shammari, explained that the objectives of the technical camp aim to cultivate a culture of teaching and learning outside the classroom and traditional boundaries in education to keep pace with rapid developments in the fields of technology and be', 'img/news/summer.png', '2019-09-17'),
(10002, 'Game Development Competition Exhibition', 'Computer Science and Information Technology launches its software competition for female students\r\nThe Committee of Programming Competitions at the Faculty of Computer Science and Information Technology, \"Female sections\", launched the activities of the Games Programming Contest during the fifth week of the first semester of the academic year 1439-1440.\r\nThe competition committee, represented by Ms. Safa Al-Salman, presented a workshop on the most important axes that the student should know before starting the development of game programming.\r\nThe Committee continued to monitor the progress of the students in the game programming process and the advertising campaign for the event continued throughout the current semester.\r\nTen students from the College of Computer Science and Information Technology were received from both departments: Department of Computer Science and Information Systems from all stages of study starting from first year to fourth year students.\r\n1. Keep the Balance By Student: Sarah Al-Nasser\r\n2. Cute Jumper by requesting: Triumph of Harthy\r\n3. Garfield by requesting: Reem Al-Hamid\r\n4. QMaze by requesting: Munira Tanm\r\n5. The Achiever by requesting: Aya Logo\r\n6. Wizards\' Battle by Female Students: Esraa Al-Shareet, Arwa Al-Ali\r\n7. Guess the Number By requesting: Vet potatoes\r\n8. Matching Game By: Maryam Al Bannai\r\n9. The Maze By Student: Wejdan Al-Muhaini\r\n10. X-O by the student: Batoul Abdullah\r\nThe Committee, represented by its members, Ms. Safa Al-Salman, Ms. Noura Al-Jaafari, and Ms. Mounira Al-Hajri evaluated the participating games within the criteria of knowledge. \'Battle came first, The Achiever came in second, and third came to Cute Jumper.\r\nThese games have won the admiration of everyone, both staff and students.', 'img/news/GameDevelopment.png', '2018-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `No` int(11) NOT NULL,
  `Title` varchar(150) COLLATE latin1_bin NOT NULL,
  `Description` varchar(1000) COLLATE latin1_bin NOT NULL,
  `Place` varchar(150) COLLATE latin1_bin NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `DateEnd` date NOT NULL,
  `Img` varchar(500) COLLATE latin1_bin NOT NULL,
  `Author` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`No`, `Title`, `Description`, `Place`, `Time`, `Date`, `DateEnd`, `Img`, `Author`) VALUES
(20002, 'sport day!', 'In cooperation with Almoosa wellness center \r\n-Running race\r\n-Table tennis \r\n-Jumping rope competition   \r\n-Yoga session (Almoosa wellness center)\r\n-Nutrition awareness corner  (Almoosa wellness center)', 'Lobby - Glass corridor', '10:30:00', '2019-12-03', '2019-12-03', 'img\\posters\\sport day.jpeg', 'admin'),
(20004, 'Programming Summer Camp Exhibition', 'We know how hard you are working these days on your summer camp projects to make them ready for the exhibition. You were able to transfer what you learned during the camp to functional projects in a few days which makes us so proud and happy. Please keep the hard work up and do your best to produce the best possible versions of your projects. \r\n\r\n\r\nIn this email we would like to share some important details, please read them carefully.\r\n\r\nCertification:\r\nIn addition to completing the required number of hours i.e. 30 hours, the followings are required to get certified:\r\nComplete your project.\r\nAttend the exhibition and showcase your project.\r\nNote: If you have completed more than 30 hours even if not 40 hours, we automatically adjust them to 40 in your certificates appreciating your dedication and hard work.\r\n\r\nVoting:\r\nMeeting the requirements above qualifies you to receive your certification. However, projects in each track will compete to win prizes. One project from each track ', 'Behend Browsing Area', '10:30:00', '2019-10-08', '2019-10-08', 'img/posters/SummerCampExhibitionInvitationCard.png', 'zozo'),
(20009, 'test', '', '', '00:00:00', '2019-12-25', '2019-12-25', ' ', 'admin'),
(20010, '', '', '', '00:00:00', '0000-00-00', '0000-00-00', ' ', 'admin'),
(20011, 'Programming Day', 'egrhtjykulkreatsygulhjgyrteawesydtfuglkysteretdfghkgfdfsagdhfjgkhjfd', 'Hall', '10:30:00', '2019-02-19', '2019-12-19', 'img/posters/EJG_HxOXYAc-iGi.png', 'Esoo');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `No` int(11) NOT NULL,
  `Email` varchar(150) COLLATE latin1_bin NOT NULL,
  `Subject` varchar(150) COLLATE latin1_bin NOT NULL,
  `Description` varchar(1500) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`No`, `Email`, `Subject`, `Description`) VALUES
(27, 'm.h.g.2628@gmail.com', 'can not find ', 'werthg'),
(28, '216017755@student.kfu.edu.sa', 'error', 'i can not see the buttun in commnt ');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `No` int(11) NOT NULL,
  `Username` varchar(150) COLLATE latin1_bin NOT NULL,
  `ID` int(11) NOT NULL,
  `Fname` varchar(150) COLLATE latin1_bin NOT NULL,
  `Lname` varchar(150) COLLATE latin1_bin NOT NULL,
  `Email` varchar(150) COLLATE latin1_bin NOT NULL,
  `Magor` varchar(2) COLLATE latin1_bin NOT NULL,
  `Level` int(11) NOT NULL,
  `Club` varchar(150) COLLATE latin1_bin NOT NULL,
  `Admin` varchar(150) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`No`, `Username`, `ID`, `Fname`, `Lname`, `Email`, `Magor`, `Level`, `Club`, `Admin`) VALUES
(15, 'marwa', 12334321, 'marwa', 'sadiq', 'marwa_684@hotmail.com', 'IS', 6, 'studentClup', 'hoor');

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `User` varchar(150) COLLATE latin1_bin NOT NULL,
  `No` int(11) NOT NULL,
  `Class` varchar(20) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`User`, `No`, `Class`) VALUES
('Esoo', 10001, 'news'),
('hoor', 10001, 'news'),
('marwa', 10001, 'news'),
('zozo', 20004, 'poster');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `clubrequest`
--
ALTER TABLE `clubrequest`
  ADD PRIMARY KEY (`No`,`Name`),
  ADD UNIQUE KEY `No` (`No`,`Name`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`No`,`username`,`club`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `Title` (`Title`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `Title` (`Title`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `Username` (`Username`,`Club`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`User`,`No`,`Class`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubrequest`
--
ALTER TABLE `clubrequest`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20012;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
