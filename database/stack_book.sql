-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 02:58 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stack_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_master`
--

CREATE TABLE `answer_master` (
  `id` smallint(10) UNSIGNED NOT NULL,
  `answer` text DEFAULT NULL,
  `question_master_id` mediumint(10) UNSIGNED DEFAULT NULL,
  `answer_master_id` smallint(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` mediumint(10) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer_master`
--

INSERT INTO `answer_master` (`id`, `answer`, `question_master_id`, `answer_master_id`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'The WebStorm editor enables breakpoints and step-by-step debugging. The program will break at the point where the breakpoint is attached. This functionality is like what you might expect from Java or C# application development.', 2, NULL, 1, '2023-07-14 13:14:46', NULL, 3, NULL),
(2, 'Java is an object-oriented programming language primarily used for developing complex enterprise applications. JavaScript is a scripting language used for creating interactive and dynamic web pages. Java applications can run in any virtual machine(JVM) or browser.1', 1, NULL, 1, '2023-07-14 13:15:26', NULL, 3, NULL),
(3, 'Elixir has roots in the practice of alchemy; it was used in the Middle Ages as the word for a substance believed to be capable of changing base metals into gold. Its later use for a drug purported to prolong one\'s life led to its use in the names of medicines of mostly questionable effectiveness. Today, it is often used generally for anything thought capable of remedying all ills or difficulties, be they physical or otherwise. The word came to us via Middle English and Medieval Latin from Arabic al-iksīr; it probably ultimately derives from Greek xērion, meaning \"desiccative powder.\"', 3, NULL, 1, '2023-07-14 13:28:47', NULL, 4, NULL),
(4, 'In Laravel\'s Query Builder, there are several aggregate methods available that allow you to perform calculations and aggregations on your database queries. These methods provide functionalities such as counting records, calculating sums, finding the minimum or maximum values, and more.  Here are some commonly used aggregate methods provided by Laravel\'s Query Builder: count() sum() avg() max() min() first() value() exists()', 4, NULL, 1, '2023-07-14 13:29:30', NULL, 4, NULL),
(5, 'An iOS app can be placed into an inactive state, for example, when a call or SMS message is received. Active - The app is running in the foreground, and receiving events. Background - The app is running in the background, and executing code. Suspended - The app is in the background, but no code is being executed.', 5, NULL, 1, '2023-07-14 13:30:26', NULL, 2, NULL),
(6, 'The query builder also provides a variety of aggregate methods, such as count<br> , max <br>, min<br> , avg <br>, and sum .', 4, NULL, 1, '2023-07-14 13:46:40', NULL, 3, NULL),
(7, 'i think this is unusual question you aksed.', 6, NULL, 1, '2023-07-14 13:48:00', NULL, 3, NULL),
(8, 'There are two types of memory in Java – stack memory and heap memory. Stack memory is the physical space or the RAM assigned to various Java objects during the run time. It is created for static memory allocation before executing a thread.', 7, NULL, 1, '2023-07-14 13:48:29', NULL, 3, NULL),
(9, 'What is the difference between background state , InActive State & Not-running state of iOS App? What is the difference between Main Bundle and Documents Directory? (Suppose I download a file/resource(e.g data.plist) from app ,so where can i find it? In Main Bundle or Documents directory or somewhere else?)', 5, NULL, 1, '2023-07-14 13:49:08', NULL, 3, NULL),
(10, 'yes you are right.', NULL, 5, 1, '2023-07-14 13:50:07', NULL, 3, NULL),
(11, 'Call by value and call by reference in C++ There are two ways to pass value or data to function in C language: call by value and call by reference. Original value is not modified in call by value but it is modified in call by reference.', 8, NULL, 1, '2023-07-14 13:50:50', NULL, 3, NULL),
(12, 'yeahh i will report this question', 6, NULL, 1, '2023-07-14 13:52:45', NULL, 2, NULL),
(13, '@_sheshank please make sure when you are posting any kind of doubt or question its valid.', 6, NULL, 1, '2023-07-14 13:57:21', NULL, 1, NULL),
(14, 'okk', NULL, 13, 1, '2023-07-14 13:58:34', NULL, 4, NULL),
(15, 'sorry for the inconvenience ', NULL, 12, 1, '2023-07-14 13:59:30', NULL, 4, NULL),
(16, 'this happen by mistake', NULL, 7, 1, '2023-07-14 13:59:49', NULL, 4, NULL),
(17, 'VS Code has built-in debugging support for the Node.js runtime and can debug JavaScript, TypeScript, or any other language that gets transpiled to JavaScript.  For debugging other languages and runtimes (including PHP, Ruby, Go, C#, Python, C++, PowerShell and many others), look for Debuggers extensions in the VS Code Marketplace or select Install Additional Debuggers in the top-level Run menu.', 2, NULL, 1, '2023-07-14 14:02:55', NULL, 4, NULL),
(18, 'In call by value, original value is not modified.  In call by value, value being passed to the function is locally stored by the function parameter in stack memory location. If you change the value of function parameter, it is changed for the current function only. It will not change the value of variable inside the caller method such as main().  Let\'s try to understand the concept of call by value in C++ language by the example given below:', 8, NULL, 1, '2023-07-14 14:05:06', NULL, 4, NULL),
(19, 'Call by reference in C++ In call by reference, original value is modified because we pass reference (address).  Here, address of the value is passed in the function, so actual and formal arguments share the same address space. Hence, value changed inside the function, is reflected inside as well as outside the function.', 8, NULL, 1, '2023-07-14 14:05:12', NULL, 4, NULL),
(20, 'Elixir is a functional, concurrent, high-level general-purpose programming language that runs on the BEAM virtual machine, which is also used to implement the Erlang programming language. Elixir builds on top of Erlang and shares the same abstractions for building distributed, fault-tolerant applications', 3, NULL, 1, '2023-07-14 14:10:05', NULL, 2, NULL),
(21, 'D = \'directory where the files are saved\'; <br>  S = dir(fullfile(D,\'name*.jpg\')); % pattern to match filenames.<br>   for k = 1:numel(S) <br>      F = fullfile(D,S(k).name); <br>      I = imread(F); <br>      imshow(I) <br>      S(k).data = I; % optional, save data.   end', 10, NULL, 0, '2023-07-14 14:18:52', '2023-07-14 14:52:10', 2, 2),
(22, ' D = \'directory where the files are saved\';\n \nS = dir(fullfile(D,\'name*.jpg\')); % pattern to match filenames.\n \nfor k = 1:numel(S)\n \n    F = fullfile(D,S(k).name);\n \n    I = imread(F);\n \n    imshow(I)\n \n    S(k).data = I; % optional, save data.\n \nend', 10, NULL, 1, '2023-07-14 14:43:34', NULL, 2, NULL),
(23, 'Java is statically-typed, so it expects its variables to be declared before they can be assigned values. Groovy is dynamically-typed and determines its variables\' data types based on their values, so this line is not required.', 8, NULL, 0, '2023-07-14 14:51:12', '2023-07-14 14:51:16', 2, 2),
(24, 'In call by value method of parameter passing, the values of actual parameters are copied to the function’s formal parameters.  There are two copies of parameters stored in different memory locations. One is the original copy and the other is the function copy. Any changes made inside functions are not reflected in the actual parameters of the caller.', NULL, 11, 1, '2023-07-14 14:51:50', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `like_masters`
--

CREATE TABLE `like_masters` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `post_master_id` smallint(5) UNSIGNED DEFAULT NULL,
  `user_master_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `like_masters`
--

INSERT INTO `like_masters` (`id`, `post_master_id`, `user_master_id`, `created_at`) VALUES
(2, 2, 2, '2023-07-14 13:10:38'),
(3, 1, 2, '2023-07-14 13:10:39'),
(4, 2, 3, '2023-07-14 13:14:51'),
(5, 1, 3, '2023-07-14 13:15:34'),
(6, 3, 4, '2023-07-14 13:28:58'),
(7, 4, 4, '2023-07-14 13:29:43'),
(8, 5, 2, '2023-07-14 13:30:22'),
(9, 8, 3, '2023-07-14 13:45:26'),
(10, 7, 3, '2023-07-14 13:48:36'),
(11, 2, 4, '2023-07-14 14:03:03'),
(13, 8, 2, '2023-07-14 14:09:04'),
(14, 3, 2, '2023-07-14 14:10:10'),
(15, 10, 2, '2023-07-14 14:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

CREATE TABLE `question_master` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `topic_master_id` smallint(10) UNSIGNED DEFAULT NULL,
  `user_master_id` mediumint(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` mediumint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_master`
--

INSERT INTO `question_master` (`id`, `question`, `topic_master_id`, `user_master_id`, `is_active`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, ' Enumerate the differences between Java and JavaScript?', 34, 2, 1, '2023-07-14 13:06:02', '2023-07-14 14:08:36', 2),
(2, 'Which editor is used to enable breakpoint and step-by-step debugging?', 22, 2, 1, '2023-07-14 13:10:14', NULL, NULL),
(3, 'what is elixir ?', 24, 3, 1, '2023-07-14 13:12:11', NULL, NULL),
(4, 'What are the name of some aggregates methods provided by the Laravel\'s query builder.', 28, 3, 1, '2023-07-14 13:14:17', NULL, NULL),
(5, 'can anyone please tell me the difference between active, inactive, not running, background, and suspended execution states.', 18, 4, 1, '2023-07-14 13:18:31', NULL, NULL),
(6, 'Explicabo Error aut', 19, 4, 1, '2023-07-14 13:19:38', NULL, NULL),
(7, 'What are the Memory Allocations available in Java?', 3, 4, 1, '2023-07-14 13:25:06', NULL, NULL),
(8, 'What do you mean by Call by Value and Call by Reference? \r\nDefine token in C++', 35, 2, 1, '2023-07-14 13:42:36', NULL, NULL),
(9, ' What\'s the advantage of using struct vs mutable struct\'s composite objects?', 21, 5, 1, '2023-07-14 14:16:06', NULL, NULL),
(10, 'How to read images in MATLAB from a folder?', 13, 5, 1, '2023-07-14 14:16:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topic_master`
--

CREATE TABLE `topic_master` (
  `id` smallint(10) UNSIGNED NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` mediumint(10) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_master`
--

INSERT INTO `topic_master` (`id`, `topic`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Python', 1, '2023-07-05 12:25:08', NULL, 1, NULL),
(2, '\"JavaScript\"', 0, '2023-07-05 12:25:18', '2023-07-14 09:52:41', 1, 1),
(3, 'Java', 1, '2023-07-05 12:25:30', NULL, 1, NULL),
(4, 'C++', 0, '2023-07-05 12:25:41', '2023-07-06 08:12:37', 1, 1),
(5, 'C#', 0, '2023-07-05 12:25:52', '2023-07-05 15:41:51', 1, 1),
(6, 'Ruby', 1, '2023-07-05 12:25:59', NULL, 1, NULL),
(7, 'Go', 1, '2023-07-05 12:26:08', NULL, 1, NULL),
(8, 'Swift', 1, '2023-07-05 12:26:39', NULL, 1, NULL),
(9, 'Kotlin', 1, '2023-07-05 12:26:47', NULL, 1, NULL),
(10, 'Rust', 1, '2023-07-05 12:26:58', NULL, 1, NULL),
(11, 'PHP', 1, '2023-07-05 12:27:21', NULL, 1, NULL),
(12, 'TypeScript', 1, '2023-07-05 12:27:29', NULL, 1, NULL),
(13, 'MATLAB', 1, '2023-07-05 12:27:37', '2023-07-06 07:43:14', 1, 1),
(14, 'R', 1, '2023-07-05 12:27:46', NULL, 1, NULL),
(15, 'Perl', 1, '2023-07-05 12:27:54', NULL, 1, NULL),
(16, 'Scala', 1, '2023-07-05 12:28:02', NULL, 1, NULL),
(17, 'Groovy', 1, '2023-07-05 12:28:08', NULL, 1, NULL),
(18, 'Objective-C', 1, '2023-07-05 12:28:18', NULL, 1, NULL),
(19, 'Lua', 1, '2023-07-05 12:28:27', NULL, 1, NULL),
(20, 'Haskell', 1, '2023-07-05 12:28:34', NULL, 1, NULL),
(21, 'Julia', 1, '2023-07-05 12:29:02', NULL, 1, NULL),
(22, 'Dart ', 1, '2023-07-05 12:29:12', '2023-07-06 08:13:09', 1, 1),
(23, 'Shell scripting (Bash)', 1, '2023-07-05 12:29:21', NULL, 1, NULL),
(24, 'Elixir', 1, '2023-07-05 12:29:28', NULL, 1, NULL),
(25, 'F#', 1, '2023-07-05 12:29:35', NULL, 1, NULL),
(26, 'Pageup', 1, '2023-07-05 15:40:07', NULL, 1, NULL),
(27, 'C+++', 0, '2023-07-06 08:31:02', '2023-07-14 10:18:52', 1, 1),
(28, 'Laravel', 1, '2023-07-06 08:31:33', NULL, 1, NULL),
(29, '                            1', 0, '2023-07-06 08:32:54', '2023-07-06 08:32:57', 1, 1),
(30, 'Java Script', 0, '2023-07-06 08:41:14', '2023-07-06 08:41:43', 1, 1),
(31, 'New language', 0, '2023-07-13 10:03:22', '2023-07-13 10:03:56', 1, 1),
(32, '         ', 0, '2023-07-14 08:27:59', '2023-07-14 08:28:03', 1, 1),
(33, '             ', 0, '2023-07-14 08:28:12', '2023-07-14 08:28:16', 1, 1),
(34, 'Java Script', 1, '2023-07-14 09:50:24', NULL, 1, NULL),
(35, 'C++', 1, '2023-07-14 10:20:43', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `role_id` tinyint(1) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` mediumint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `profile_img`, `name`, `email`, `mobile`, `password`, `is_active`, `role_id`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, '138191046996771736StackBookLogo.jpg', 'Admin StackBook', 'admin12@gmail.com', '7049614400', '0e7517141fb53f21ee439b355b5a1d0a', 1, 1, NULL, NULL, NULL),
(2, '2053105911112427803download.jpg', 'Hritik raj mishra', 'hritik@gmail.com', '7049614417', '3a32e5bd8a96ff7cfb5f30a6126acf96', 1, 2, NULL, '2023-07-14 14:57:51', 1),
(3, '62305923230767014demo2.jpg', 'Ratnesh Siddha', 'sidhha@gmail.com', '7049614418', '9d798fd06cf61454a422de6784328474', 1, 2, NULL, NULL, NULL),
(4, '2066627454112427803download.jpg', 'Sheshank Pandey', 'sheshank12@gmail.com', '7049614419', '6c9d5ebde01659421947f7ada486be7b', 1, 2, NULL, NULL, NULL),
(5, '47537349647359856download (1).jpg', 'Vikash PageUp', 'vikash12@gmail.com', '7049614420', '31c88b3cf68c18af9092b6cf578e5520', 1, 2, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_master`
--
ALTER TABLE `answer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_masters`
--
ALTER TABLE `like_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_master`
--
ALTER TABLE `question_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_master`
--
ALTER TABLE `topic_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_master`
--
ALTER TABLE `answer_master`
  MODIFY `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `like_masters`
--
ALTER TABLE `like_masters`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `question_master`
--
ALTER TABLE `question_master`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topic_master`
--
ALTER TABLE `topic_master`
  MODIFY `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
