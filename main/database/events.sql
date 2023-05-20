-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 06:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(250) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `event_address` varchar(200) NOT NULL,
  `event_description` varchar(1000) NOT NULL,
  `event_date` datetime NOT NULL DEFAULT current_timestamp(),
  `event_website` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_address`, `event_description`, `event_date`, `event_website`) VALUES
(1, 'Manitoba Food Truck Battles', 'Venue:\r\nAssiniboia Downs\r\nAddress:\r\n3975 Portage Avenue', 'Sat. 12pm- 11pm Sun. 12am -9pm\r\n\r\n Are you ready Winnipeg?\r\n\r\nWe are thrilled to announce that the Food Truck Battles will be back again this year at Assiniboia Downs! \r\n\r\nGet ready to fill your face with some of Winnipeg’s most delectable delights', '2023-05-27 13:23:17', 'https://www.tourismwinnipeg.com/festivals-and-events/upcoming-events'),
(2, 'Manitoba Night Market', 'Venue:\r\nAssiniboia Downs\r\nAddress:\r\n3975 Portage Avenue', '\r\n1 p.m. to 11 p.m.\r\nTickets only $7 (5 under are free.)\r\nWe are so happy to announce that the Manitoba Night Market will be back in full swing this year. \r\n\r\nThere will be kids activities, live bands, beer gardens, 15+ food trucks, shopping sprees, 100+ Artisans, a fire show and so much more!  \r\n\r\nCome to get some shopping done and a great way to  shop local! ', '2023-06-11 13:23:17', 'https://www.tourismwinnipeg.com/festivals-and-events/upcoming-events');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
