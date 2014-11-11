-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2014 at 12:34 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eduvisor`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE IF NOT EXISTS `course_list` (
  `Coordinator` varchar(18) DEFAULT NULL,
  `Number` int(4) DEFAULT NULL,
  `CourseTitle` varchar(89) DEFAULT NULL,
  `CourseID` int(2) NOT NULL,
  `Credits` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`Coordinator`, `Number`, `CourseTitle`, `CourseID`, `Credits`) VALUES
('Mallon', 1110, 'Introduction to Computing Technology', 1, 3),
('Rice', 1111, 'Introduction to Computer+AC0-Assisted Problem Solving', 2, 3),
('Rice', 1112, 'Introduction to Computer+AC0-Assisted Problem Solving for Construction Systems Management', 3, 3),
('Rice', 1113, 'Spreadsheet Programming for Business', 4, 3),
('Heym', 1211, 'Computational Thinking in Context: Images Animation and Games', 5, 3),
('Sivilotti', 1212, 'Computational Thinking in Context: Mobile Applications', 6, 3),
('non+AC0-cse', 1221, 'Introduction to Computer Programming in MATLAB for Engineers and Scientists', 7, 3),
('Shareef', 1222, 'Introduction to Computer Programming in C for Engineers and Scientists', 8, 3),
('Morris', 1223, 'Introduction to Computer Programming in Java', 9, 3),
('Rice', 2111, 'Modeling and Problem Solving with Spreadsheets and Databases', 10, 3),
('Wenger', 2122, 'Data Structures Using C', 11, 3),
('Morris', 2123, 'Data Structures Using Java', 12, 3),
('Reeves', 2133, 'Business Programming with File Processing', 13, 3),
('Bucci', 2221, 'Software I: Software Components', 14, 3),
('Bucci', 2231, 'Software II: Software Development and Design', 15, 3),
('Bucci', 2231, 'Software II+AC0-Transition: Software Development and Design', 16, 3),
('Bucci', 2232, 'Software II.5+AC0-Transition: Software Development in Java', 17, 3),
('Supowit', 2321, 'Foundations I: Discrete Structures', 18, 3),
('Wenger', 2331, 'Foundations II: Data Structures and Algorithms', 19, 3),
('Agrawal', 2421, 'Systems I: Introduction to Low+AC0-Level Programming and Computer Organization', 20, 3),
('Close', 2431, 'Systems II: Introduction to Operating Systems', 21, 3),
('Agrawal', 2451, 'Advanced C Programming', 22, 3),
('Mallon', 2501, 'Social Ethical and Professional Issues in Computing', 23, 3),
('Ramnath', 3231, 'Software Engineering Techniques', 24, 3),
('Bair', 3232, 'Software Requirements Analysis', 25, 3),
('Parthasarathy', 3241, 'Introduction to Database Systems', 26, 3),
('McDowell', 3321, 'Automata and Formal Languages', 27, 3),
('Soundarajan', 3341, 'Principles of Programming Languages', 28, 3),
('Stewart', 3421, 'Introduction to Computer Architecture', 29, 3),
('Sinha', 3461, 'Computer Networking and Internet Technologies', 30, 3),
('Davis', 3521, 'Survey of Artificial Intelligence I: Basic Techniques', 31, 3),
('Boggus', 3541, 'Computer Game and Animation Techniques', 32, 3),
('Sivilotti', 3901, 'Project: Design Development and Documentation of Web Applications', 33, 3),
('Crawfis', 3902, 'Project: Design Development and Documentation of Interactive Systems', 34, 3),
('Heym', 3903, 'Project: Design Development  and Documentation of System Software', 35, 3),
('Babic', 4251, 'The UNIX Programming Environment', 36, 3),
('Soundarajan', 4252, 'Programming in C', 37, 3),
('Crawfis', 4253, 'Programming in C+ACM-', 38, 3),
('Davis', 4254, 'Programming in Lisp', 39, 3),
('Rountev', 4255, 'Programming in Perl', 40, 3),
('Xuan', 4471, 'Information Security', 41, 3),
('Strader', 4689, 'Professional Practice in Industry', 42, 3),
('Davis', 5052, 'Survey of Artificial Intelligence for Non+AC0-Majors', 43, 3),
('Ramnath', 5235, 'Applied Enterprise Architectures and Services', 44, 3),
('Ramnath', 5236, 'Mobile Application Development', 45, 3),
('Shareef', 5242, 'Advanced Database Management Systems', 46, 3),
('Parthasarathy', 5243, 'Introduction to Data Mining', 47, 3),
('Parthasarathy', 5245, 'Introduction to Network Science', 48, 3),
('Bond', 5343, 'Compiler Design and Implementation', 49, 3),
('Lai', 5351, 'Introduction to Cryptography', 50, 3),
('Supowit', 5361, 'Numerical Methods', 51, 3),
('Xuan', 5432, 'Mobile Handset Systems and Networking', 52, 3),
('Qin', 5433, 'Operating Systems Laboratory', 53, 3),
('Sadayappan', 5441, 'Introduction to Parallel Computing', 54, 3),
('Sinha', 5462, 'Network Programming', 55, 3),
('Sinha', 5463, 'Introduction to Wireless Networking', 56, 3),
('Xuan', 5472, 'Information Security Projects', 57, 3),
('Arora', 5473, 'Network Security', 58, 3),
('Fosler+AC0-Lussier', 5522, 'Survey of Artificial Intelligence II: Advanced Techniques', 59, 3),
('Belkin', 5523, 'Machine Learning and Statistical Pattern Recognition', 60, 3),
('Davis', 5524, 'Computer Vision for Human+AC0-Computer Interaction', 61, 3),
('Fosler+AC0-Lussier', 5525, 'Foundations of Speech and Language Processing', 62, 3),
('WangD', 5526, 'Introduction to Neural Networks', 63, 3),
('non+AC0-cse', 5531, 'Introduction to Cognitive Science', 64, 3),
('Shen', 5542, 'Real+AC0-Time Rendering', 65, 3),
('Dey', 5543, 'Geometric Modeling', 66, 3),
('Machiraju', 5544, 'Introduction to Scientific Visualization', 67, 3),
('Machiraju', 5545, 'Advanced Computer Graphics', 68, 3),
('non+AC0-cse', 5891, 'Pro seminar in Cognitive Science', 69, 3),
('Ramnath', 5911, 'Capstone Design: Software Applications', 70, 4),
('Crawfis', 5912, 'Capstone Design: Game Design and Development', 71, 4),
('WangH', 5913, 'Capstone Design: Computer Animation', 72, 4),
('Davis', 5914, 'Capstone Design: Knowledge+AC0-Based Systems', 73, 4),
('Parthasarathy', 5915, 'Capstone Design: Information Systems', 74, 4),
('Rountev', 6231, 'Formal Foundations of Software Engineering', 75, 3),
('Rademacher', 6321, 'Computability and Complexity', 76, 3),
('Lai', 6331, 'Algorithms', 77, 3),
('Dey', 6332, 'Advanced Algorithms', 78, 3),
('Arora', 6333, 'Distributed Algorithms', 79, 3),
('Rountev', 6341, 'Foundations of Programming Languages', 80, 3),
('Teodorescu', 6421, 'Computer Architecture', 81, 3),
('Panda', 6422, 'Advanced Computer Architecture', 82, 3),
('Agrawal', 6431, 'Advanced Operating Systems', 83, 3),
('Sadayappan', 6441, 'Parallel Computing', 84, 3),
('Shroff', 6461, 'Computer Communication Networks', 85, 3),
('Bucci', 5022, 'Software I: Software Components', 86, 2),
('Bucci', 5023, 'Software II: Software Development and Design', 87, 2),
('Wenger', 5331, 'Foundations II: Data Structures and Algorithms', 88, 2),
('Close', 5431, 'Systems II: Introduction to Operating Systems', 89, 2),
('Mallon', 5501, 'Social Ethical and Professional Issues in Computing', 90, 2),
('Ramnath', 5231, 'Software Engineering Techniques', 91, 2),
('Bair', 5232, 'Software Requirements Analysis', 92, 2),
('Parthasarathy', 5241, 'Introduction to Database Systems', 93, 2),
('McDowell', 5321, 'Automata and Formal Languages', 94, 2),
('Soundarajan', 5341, 'Principles of Programming Languages', 95, 2),
('Stewart', 5421, 'Introduction to Computer Architecture', 96, 2),
('Sinha', 5461, 'Computer Networking and Internet Technologies', 97, 2),
('Davis', 5521, 'Survey of Artificial Intelligence I: Basic Techniques', 98, 2),
('Boggus', 5541, 'Computer Game and Animation Techniques', 99, 2);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
`id` int(5) NOT NULL,
  `name` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `name`, `description`) VALUES
(1, 'BA', 'Bachelor of Arts'),
(2, 'BS', 'Bachelor of Science'),
(3, 'MS', 'Master of Science'),
(4, 'PhD', 'Doctor of Philosophy');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`student_id` int(5) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `department` varchar(100) NOT NULL,
  `degree_id` int(5) NOT NULL,
  `enroll_sem` varchar(10) NOT NULL,
  `enroll_year` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `department`, `degree_id`, `enroll_sem`, `enroll_year`) VALUES
(1, 'Nimit', 'kumar', 'goyal.71@osu.edu', '0a2ede56f6523e16b6a2794c26921580', '2147483647', 'Computer Science and Engineering', 1, 'Autumn', 2013),
(2, 'ravi', 'kumar', 'ravi@ravi.com', '952bb4fb8fb20787d2d130e752c77d1b', '6145566570', 'Computer Science and Engineering', 1, 'autumn', 2013),
(3, 'firstname', 'lastname', 'first@last.com', '0a2ede56f6523e16b6a2794c26921580', '6985741236', 'Computer Science and Engineering', 4, 'Spring', 2014),
(4, 'firstname', 'lastname', 'first@last.com', '0a2ede56f6523e16b6a2794c26921580', '6985741236', 'Computer Science and Engineering', 4, 'Spring', 2014);

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE IF NOT EXISTS `student_courses` (
`id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `type`) VALUES
(1, 2, 77, 'core');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
 ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `student_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
