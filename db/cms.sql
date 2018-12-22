-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2018 at 09:29 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Javascript'),
(3, 'PHP'),
(17, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) DEFAULT NULL,
  `comment` text,
  `comment_author` varchar(255) DEFAULT NULL,
  `comment_email` varchar(255) DEFAULT NULL,
  `comment_status` varchar(255) DEFAULT NULL,
  `comment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment`, `comment_author`, `comment_email`, `comment_status`, `comment_date`) VALUES
(40, 20, 'great post', 'Niel', 'niel@outlook.com', 'Approved', '2018-12-01'),
(41, 22, 'well, this is a really good post.', 'tony', 'tony@gmail.com', 'Approved', '2018-12-05'),
(42, 22, 'cool post', 'tony', 'tony@gmail.com', 'Unapproved', '2018-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_img` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(20, 17, 'Programming with Python', 'John Doe', '2018-12-22', 'img-code1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec semper justo. Nunc odio nunc, rhoncus eget porttitor nec, eleifend eget mauris. Morbi lorem libero, ultricies non sem nec, rhoncus vestibulum quam. Etiam sit amet velit ut risus rhoncus maximus id eu purus. Mauris interdum eu ante ac aliquam. In lacinia diam lorem, vel porta lorem hendrerit sed. Sed in nulla eu elit sodales rutrum. Cras fermentum, tortor bibendum lacinia pharetra, lectus nulla accumsan felis, id euismod urna leo eget urna. Donec porttitor quam ac urna vestibulum, ac commodo velit faucibus.\r\n\r\nPhasellus et posuere urna. Etiam ut pellentesque nunc, in consequat lorem. Integer iaculis dui nec velit imperdiet euismod. Nam fermentum varius tortor et condimentum. Praesent sollicitudin augue neque, dignissim dignissim mi finibus a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas vel dignissim arcu. Fusce tempor purus ut sapien viverra condimentum. Vestibulum at leo sodales, malesuada elit vitae, hendrerit neque. Aliquam vehicula lacinia erat, in vestibulum tortor facilisis sed. Integer ut libero fermentum, gravida ex non, convallis mi. Ut porta fermentum tellus eget tincidunt.', 'python', 3, 'published'),
(21, 3, 'PHP Programming', 'Angelica', '2018-12-21', 'img-code_js4.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam et, molestiae odio nam? Libero iste, recusandae adipisci consectetur consequatur sint delectus eum illo! Eius earum ipsa incidunt nihil, ipsum nulla nobis autem quam eligendi minima quaerat, pariatur explicabo quae magni, reiciendis nostrum modi eum hic? Corrupti autem cupiditate tempora porro, quam, doloremque aspernatur ipsam impedit deserunt, accusamus beatae. Officiis veniam, ipsam? Ut nobis suscipit laboriosam, quae, similique explicabo voluptas quia amet itaque dignissimos, odio assumenda?\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec semper justo. Nunc odio nunc, rhoncus eget porttitor nec, eleifend eget mauris. Morbi lorem libero, ultricies non sem nec, rhoncus vestibulum quam. Etiam sit amet velit ut risus rhoncus maximus id eu purus. Mauris interdum eu ante ac aliquam. In lacinia diam lorem, vel porta lorem hendrerit sed. Sed in nulla eu elit sodales rutrum. Cras fermentum, tortor bibendum lacinia pharetra, lectus nulla accumsan felis, id euismod urna leo eget urna. Donec porttitor quam ac urna vestibulum, ac commodo velit faucibus.\r\n\r\nPhasellus et posuere urna. Etiam ut pellentesque nunc, in consequat lorem. Integer iaculis dui nec velit imperdiet euismod. Nam fermentum varius tortor et condimentum. Praesent sollicitudin augue neque, dignissim dignissim mi finibus a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas vel dignissim arcu. Fusce tempor purus ut sapien viverra condimentum. Vestibulum at leo sodales, malesuada elit vitae, hendrerit neque. Aliquam vehicula lacinia erat, in vestibulum tortor facilisis sed. Integer ut libero fermentum, gravida ex non, convallis mi. Ut porta fermentum tellus eget tincidunt.', 'PHP, sessions', 2, 'published'),
(22, 17, 'Python OOP', 'Maria', '2018-12-21', 'img-code_python.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec semper justo. Nunc odio nunc, rhoncus eget porttitor nec, eleifend eget mauris. Morbi lorem libero, ultricies non sem nec, rhoncus vestibulum quam. Etiam sit amet velit ut risus rhoncus maximus id eu purus. Mauris interdum eu ante ac aliquam. In lacinia diam lorem, vel porta lorem hendrerit sed. Sed in nulla eu elit sodales rutrum. Cras fermentum, tortor bibendum lacinia pharetra, lectus nulla accumsan felis, id euismod urna leo eget urna. Donec porttitor quam ac urna vestibulum, ac commodo velit faucibus.\r\n\r\nPhasellus et posuere urna. Etiam ut pellentesque nunc, in consequat lorem. Integer iaculis dui nec velit imperdiet euismod. Nam fermentum varius tortor et condimentum. Praesent sollicitudin augue neque, dignissim dignissim mi finibus a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas vel dignissim arcu. Fusce tempor purus ut sapien viverra condimentum. Vestibulum at leo sodales, malesuada elit vitae, hendrerit neque. Aliquam vehicula lacinia erat, in vestibulum tortor facilisis sed. Integer ut libero fermentum, gravida ex non, convallis mi. Ut porta fermentum tellus eget tincidunt.', 'Python, oop', 2, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(3) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `usr_email` varchar(255) DEFAULT NULL,
  `avatar` text,
  `usr_role` varchar(255) DEFAULT NULL,
  `rand_salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `username`, `password`, `first_name`, `last_name`, `usr_email`, `avatar`, `usr_role`, `rand_salt`) VALUES
(1, 'manoj', 'manojmm', 'Manoj', 'Borkar', 'm4noj98@gmail.com', 'avatar_2.png', 'admin', NULL),
(2, 'julia', 'julia', 'Julia ', 'Robertson', 'julia@gmail.com', 'avatar_female.png', 'subscriber', NULL),
(11, 'johnd', 'johnd', 'John', 'Doe', 'john@gmail.com', 'avatar.png', 'subscriber', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
