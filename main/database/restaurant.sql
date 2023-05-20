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
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` int(200) NOT NULL,
  `restaurant_name` varchar(200) NOT NULL,
  `restaurant_description` varchar(1000) NOT NULL,
  `restaurant_address` varchar(500) NOT NULL,
  `restaurant_website` varchar(500) NOT NULL,
  `cuisine_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `restaurant_name`, `restaurant_description`, `restaurant_address`, `restaurant_website`, `cuisine_id`) VALUES
(1, 'Bonfire Bistro', 'Bonfire Bistro\r\n\r\nComfort food. A meal to savour. Fresh ingredients make a meal extravagant. We live by this theory.\r\n\r\nHours \r\n\r\nCheck Instagram for specials & features\r\n\r\nTo reserve a table or place a takeout order (204) 487-4440\r\n\r\nLunch is back Thursdays & Fridays 11:30-2:30! Call to reserve.\r\n\r\nCurrent  Hours\r\n\r\nMonday – Thursday\r\n\r\n5:00\r\n\r\nFriday & Saturday\r\n\r\n4:30\r\n\r\nThursdays & Fridays we lunch!!\r\n\r\n11:30', '1433 Corydon Ave, Winnipeg, Manitoba R3N 0J2 Canada', 'https://bonfirebistro.ca/about/', 1),
(2, 'Kum Koon Garden', '\r\nHours\r\n\r\nTuesday — Sunday\r\n11am — 10pm\r\n', '257 King Street, Winnipeg, Manitoba R3B 1J6 Canada', 'http://www.kumkoongarden.com/', 2),
(3, 'Four Seasons Chinese Food', '4 Seasons Chinese Food first opened its doors on September 20th, 1988. The restaurant was started by the brother and sister team of Walter and Cathy. Together with their parents and aunt, they have built this pick-up and delivery restaurant into one of the more popular Chinese restaurants in Winnipeg.\r\n\r\nUsing only the finest and freshest ingredients, they have created a large and loyal clientele. Their reputation has grown to a point where the wait could be up to 2 to 3 hours on the weekends.\r\n\r\nPre-orders are recommended for the weekends and holidays. Their friendly staff will gladly assist you.', '10-35 Lakewood Blvd Southdale Centre, Winnipeg, Manitoba R2J 2M8 Canada', 'https://fourseasonschinesefood.com/', 2),
(4, 'Phoenix Square Chinese Restaurant & Buffet', 'Phoenix Square offers authentic and delicious tasting Chinese cuisine in Winnipeg, MB. Phoenix Square\'s convenient location and affordable prices make our restaurant a natural choice for dine-in, take-out meals in the Winnipeg community. Our restaurant is known for its variety of taste and high quality fresh ingredients. Come and experience our friendly atmosphere and excellent service.', 'Unit E-1765 Kenaston Blvd, Winnipeg, Manitoba Canada', 'https://www.phoenixsquarewinnipegmb.com/', 2),
(5, 'Santa Ana Pizzeria and Bistro\r\n', 'OUR DINING ROOM IS OPEN!\r\n\r\nOur space is limited! We are booking by reservations only. We offer booth style seating with plexiglass in between each table for your comfort and safety. Our first seating starts at 3:00 and last seating is at 7:30, Monday - Saturday. Call to book your reservation!', '1631 St. Mary\'s Road, Winnipeg, Manitoba Canada', 'http://www.santaanabistro.ca/', 1),
(6, 'Bellissimo Restaurant & Lounge\r\n', 'Bellissimo (meaning Beautiful) started out as a 25-seat dining room that through the years has grown to 140 seats, consisting of a main dining room, lounge and patio.\r\n\r\nAs a small owner/operated establishment, Bellissimo prides itself on creating a welcoming place where staff and patrons can feel like family.\r\n\r\nOur food gets people talking! The creative fare is a happy marriage of authentic Italian cuisine merged with contemporary practices, and is well served in a semi-fine dining atmosphere.', '1-877 Waverley St, Winnipeg, Manitoba R3T 5V3 Canada', 'https://www.bellissimo-restaurant.com/about', 1),
(7, 'Koya Japan', 'Koya Japan is committed to providing a premium Japanese Teppan-style quick-service experience. Featuring only the finest and freshest ingredients, our teppanyaki stir-fry dishes are prepared to order and have been enjoyed by our customers since 1985.\r\n\r\nAt Koya, we care and treat you like family. Our passion is in our food and our service—never compromised and always served with respect. Wherever you may be in Canada, you can find comfort in Koya Japan’s cuisine.', '2305 McPhillips St, Winnipeg, MB R2V 3E1', 'https://koyajapan.com/?utm_source=G&utm_medium=LPM&utm_campaign=MTY', 3),
(8, 'Utage Maple Sushi', 'Utage Maple Sushi offers delicious sushi and authentic Japanese cuisine. With an almost endless variety of sushi rolls, you’re bound to find a new favourite or several! Feast on tasty house specialty rolls like the Flamethrower roll or Jack Pot roll, indulge in traditional Japanese dishes like chirashi and beef yakisoba, and snack on dim sum favourites like hargow and siu mai. Order from Utage Maple Sushi, in Winnipeg, for pickup or delivery, through SkipTheDishes.com! Hours Mon – Thu: 11:30 AM – 10:00 PM\r\n\r\nFri: 11:30 AM – 11:00 PM\r\n\r\nSat: 12:00 AM – 11:00 PM\r\n\r\nSun: 12:00 AM – 9:00 PM', '1198 Jefferson Avenue, Winnipeg, MB, Canada, Winnipeg, R2P', 'https://utagemaplesushi.com/', 3),
(9, 'barBurrito', 'Ever since we opened the first Barburrito in Toronto in 2005, we’ve built on our reputation of offering great quality Tex-Mex food, fresh, fast, and without compromise. We may not be the only burrito in town, but we’ve certainly raised the bar. Find out what you’ve been missing at Barburrito.', '1385 McPhillips St, Winnipeg, MB R2V 3C4', 'https://www.barburrito.ca/', 4),
(10, 'QDOBA Mexican Eats', 'Welcome to QDOBA Mexican Eats, a modern Mexican restaurant where you can relax with friends and revel in the many unique flavors and varieties that you can’t find anywhere else. QDOBA 831 Dakota St Winnipeg, MB offers free WiFi to enjoy while you explore a full menu of classic Mexican entrées, including burritos (and burrito bowls!), quesadillas, nachos and signature flavors such as our craveable, creamy 3-Cheese Queso. And to sweeten the deal, we let you top your dish off with guacamole and queso, at no extra cost. Want to make an event a little more memorable? We offer catering, too. Let your guests create the flavorful Mexican dishes of their dreams with our hot bars – set up and party ready for when you need them. Sign up for QDOBA Rewards to earn points toward free food and other perks, and come see us today at 831 Dakota St Winnipeg, MB for a flavorful experience.', '831 Dakota St, Winnipeg, MB R2M 5M2', 'https://locations.qdoba.com/ca/mb/winnipeg/831-dakota-st.html?gclid=CjwKCAjw586hBhBrEiwAQYEnHZ_xi9LNvOGeNr9UdcT_FL9ObNJBL024S935Ikn0Ia-b35ZaPaJBCxoCXu0QAvD_BwE', 4),
(11, 'Thai Express Restaurant Winnipeg', 'AT THAI EXPRESS™, WE’VE LEARNED THAT WHEN YOU TREAT YOUR TASTE BUDS RIGHT, GREAT THINGS HAPPEN.\r\nIt all starts with fresh, delicious ingredients. No surprise there. But just as important is what we do to them. We specialize in traditional Thai recipes, but we have the vision to sprinkle in enough new-world creativity to keep you on your toes. And because our focus is on fresh, vibrant food, you can feel good about meals that taste great.\r\nIT’S\r\n\r\nSAME SAME\r\nBUT\r\n\r\nDIFFERENT™', 'Garden City Shopping Centre, 2305 McPhillips St, Winnipeg, MB R2V 3E1', 'https://thaiexpress.ca/locations/?utm_source=G&utm_medium=LPM&utm_campaign=MTY', 5),
(12, 'Pad Thai', 'People are saying\r\nEverything has just been fantastic! I would recommend this restaurant to anyone.', '2635 Portage Ave, Winnipeg, MB R3J 0P9', 'https://padthaiwinnipeg.com/?gclid=CjwKCAjw586hBhBrEiwAQYEnHdzOVQqkDJrfBewIhdTb-AJFWXDJnZ8l-qSo_dvCD3AAxE3zUEVOlBoC1ooQAvD_BwE', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `cuisineFK` (`cuisine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurant_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `cuisineFK` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisine` (`cuisine_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
