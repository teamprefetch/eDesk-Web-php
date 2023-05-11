-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 06:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edeskdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaddoffice`
--

CREATE TABLE `adminaddoffice` (
  `id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminaddoffice`
--

INSERT INTO `adminaddoffice` (`id`, `title`, `description`) VALUES
(1, 'hfgh hfgth', 'fgfljk'),
(2, 'cse office', 'r rt t rewt ret '),
(3, 'jnu office', 'wser we twe4 wer');

-- --------------------------------------------------------

--
-- Table structure for table `adminmanagement`
--

CREATE TABLE `adminmanagement` (
  `id` int(20) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminmanagement`
--

INSERT INTO `adminmanagement` (`id`, `userid`, `password`) VALUES
(1, 'admin', 'admin'),
(3, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `office_id` int(20) NOT NULL,
  `author_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `picture`, `office_id`, `author_id`, `user_id`, `type`, `date_time`) VALUES
(1, 'Rouddra fuck nahid', 'tewfuyerw iu yriuuiewyoyeoi  u eu eyuiewyru ', '168370257420230209_145053.jpg', 3, 0, 6, 'Complain', '2023-05-10 13:22:53'),
(2, 'nishat fuck asif', 'ewfew  i ouoe e erwuir', '168370265020230209_145053.jpg', 2, 0, 6, 'Complain', '2023-05-10 13:22:53'),
(3, 'regfgdf', 'dsgfdgfdgfdg r r g', '16837027391675267474219.jpg', 2, 0, 6, 'Suggestion', '2023-05-10 13:22:53'),
(4, 'fgr regtr tr ', 'ert ret rere re', '16837028101664598142908.jpg', 2, 0, 6, 'Request', '2023-05-10 13:22:53'),
(5, 'ehwtfewfw f', 'ew fewf e eww ', '1683702975201187167_1143761759700989_24436171607090174_n.jpg', 2, 0, 0, 'Admin', '2023-05-10 13:22:53'),
(6, 'fdg rdg', 'r rere rete', '1683703112IMG_20210722_174944.jpg', 2, 0, 0, 'Admin', '2023-05-10 13:22:53'),
(7, 'uytutyuyt', 'tyu tyu tyu ytuty', '1683725095119259549_3441740135891285_5227993086288146132_n.jpg', 2, 0, 0, 'Admin', '2023-05-10 13:24:55'),
(8, 'edger ert tey', 'er er ert tyt e', '1683738390a00AA6C.jpg', 2, 1, 0, 'Admin', '2023-05-10 17:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `usermanagement`
--

CREATE TABLE `usermanagement` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermanagement`
--

INSERT INTO `usermanagement` (`id`, `firstname`, `lastname`, `userid`, `email`, `password`, `picture`, `stat`) VALUES
(6, 'Waliul', 'Islam', 'rayhan', 'rayhan@gmail.com', '$2y$10$aHe34KNyWA1NwRHO82zQM.FUclFSu8EeezY9BvEXrUMBJ3ijxHeCO', '1683623421Scan2.jpg', 'active'),
(7, 'Nishat', 'Mahmud', 'nishat', 'nishat@gmai.com', '$2y$10$u2962fW3XX28RCfuRquANunN2d5bytOOD3r7MGssSW0WUTkYvSU9S', '1683623531Nishat Mahmud.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaddoffice`
--
ALTER TABLE `adminaddoffice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminmanagement`
--
ALTER TABLE `adminmanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermanagement`
--
ALTER TABLE `usermanagement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaddoffice`
--
ALTER TABLE `adminaddoffice`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adminmanagement`
--
ALTER TABLE `adminmanagement`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usermanagement`
--
ALTER TABLE `usermanagement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
