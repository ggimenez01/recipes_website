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
-- Table structure for table `grocery`
--

CREATE TABLE `grocery` (
  `grocery_id` int(150) NOT NULL,
  `grocery_name` varchar(250) NOT NULL,
  `grocery_address` varchar(250) NOT NULL,
  `grocery_website` varchar(250) NOT NULL,
  `grocery_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grocery`
--

INSERT INTO `grocery` (`grocery_id`, `grocery_name`, `grocery_address`, `grocery_website`, `grocery_description`) VALUES
(1, 'Lucky Supermarket', '1051 Winnipeg Ave  \r\n\r\nWinnipeg, MB  R3E 0S2', 'https://www.luckysupermarket.ca/', 'At Lucky Supermarket, we want all of our shoppers to shop, eat, and live well. We offer all of our shoppers special deals and discounts around the store throughout the year.\r\n\r\n \r\n\r\nInterested to see what we’ve got on sale today? Stop by and start shopping or click below to take a look at our in-store specials'),
(2, 'Real Canadian Superstore', '1385 Sargent Ave, Winnipeg, Manitoba R3E 3P8', 'https://www.realcanadiansuperstore.ca/', 'NEW REAL CANADIAN SUPERSTORE CAMPAIGN FOCUSES ON REAL CANADIAN FOOD, PEOPLE AND LIFE.\r\nToday, Real Canadian Superstore is launching a new campaign and brand design that focuses on who we are as Canadians. Everything from the foods from each other\'s cultures that we love, to our unique and diverse identities, and even what’s in our shopping carts.\r\n\r\nThe goal of the campaign, in development by Vancouver’s One Twenty Three West since October 2020, is to create a true reflection of who we are both individually and collectively and reinforce Real Canadian Superstore as a place where foods from all cultures can be found, and all people are welcome.\r\n'),
(3, 'COOP', '10 Prairie Way\r\nWinnipeg, MB,\r\nR2J 3J8', 'https://www.redriverco-op.crs/sites/redriver', 'The CO-OP® brand is used by a network of retail co-operative associations across Western Canada that own and operate Co-op Agro Centres, Food Stores, Gas Bars/Convenience Stores, Home Centres, Pharmacies and more.\r\n\r\nYour local association is a member of this network, which we call the Co-operative Retailing System. The associations are independent organizations owned by their members, who democratically elect a local board of directors to govern the business. The Co-op brand is built on the idea of being truly local and the promise of staying that way.\r\n\r\nAssociations may appear to be similar and often work together under the Co-op banner (e.g. marketing and procurement). However, each association works for the benefit of its respective members and communities. This is why locations across Western Canada – the way they’re operated and the products and services they offer – are slightly different. It’s a Co-op thing.'),
(4, 'Sobeys', '00-50 Sage Creek Blvd Winnipeg MB R3X 0J6', 'https://www.sobeys.com/en/', 'As a family nurturing families, we want to ensure Canadians are taken care of today, tomorrow and in the future.'),
(5, 'Save On Foods', '1399 McPhillips Street, Winnipeg, Manitoba R2V 3C4', 'https://www.saveonfoods.com/sm/pickup/rsid/1982/', 'At Save-On-Foods, going the extra mile is nothing new. Actually, we’ve gone above and beyond in all areas of our business since we started, way back in 1915. Originally, we were called Overwaitea Food Group because of the founder’s practice of selling 18 ounces of tea for the price of 16, and the name “overweight tea” stuck. Fast forward over 100 years and that name has changed, but we’re still known for delivering extra value to our customers. Today our company is best known for its most prominent banner—Save-On-Foods—but also includes PriceSmart Foods, Urban Fare and Bulkley Valley Wholesale.'),
(6, 'FreshCo', '920 Jefferson Ave, Winnipeg, MB R2P 1W1', 'https://freshco.com/', 'AT FRESHCO, WE DO EVERYTHING WE CAN\r\nAt FreshCo and Chalo! FreshCo, we do everything we can to improve and contribute to the communities we call home. After all, we live and work here too.\r\n\r\nFrom local food banks, to Cram the Cruiser events, our network of more than 125 stores across Ontario, Manitoba, Saskatchewan, Alberta and BC continues to support our communities and charities.'),
(7, 'Harris Meats And Grocery', '1840 Arlington St, Winnipeg, MB R2X 1W5', 'http://www.harrismeatsandgroceries.com/', 'Prices on this website are only effective at our 5 Charles Street location! \r\nArlington Street location PRICES AND MEAT PACKAGES are different, you can call them at 204-339-8406 for current prices. '),
(8, 'IGA', '1650 Main St, Winnipeg, MB R2V 1Y9', 'https://west.iga.ca/stores/iga-main-st-mb/', 'As a family nurturing families, we want to ensure Canadians are taken care of today, tomorrow and in the future.'),
(9, 'Hellard\'s NOFRILLS Winnipeg', '1445 Main St, Winnipeg, MB R2W 3V8', 'https://www.nofrills.ca/store-locator/details/3442?utm_source=G&utm_medium=LPM&utm_campaign=Loblaws', '\"We had to close the doors at 10:30 this morning and let people in as other people left.\" It was the kind of problem every store manager dreams of, especially on opening day. The first No Frills® prototype store had swung open its doors in East York, near Toronto. The reaction on the part of shoppers was enthusiastic, to say the least. \"The rush never stopped,\" explained Loblaws manager Robert St. Jean, back in July 1978. \"We\'re really excited about it... really excited!\"\r\n\r\nThe original No Frills® store was just that, no frills. No product advertising, no store displays, no meat counter, no clerks to bag your groceries, and you had to bring your own bags or pay 3 cents for each. \"It doesn\'t bother me a bit,\" replied first day customer Frank Atlas when asked about bagging his own groceries. \"I\'ve saved a couple dollars with this order.\"\r\n\r\n'),
(10, 'Young\'s Market', '1000 McPhillips St, Winnipeg, MB R2X 2K4', 'https://youngsmarket.ca/', 'Have You Shopped at Young\'s?\r\nWhether you\'re just a beginner, a foodie, or a professional chef...we know what you need. We stock the essential ethnic ingredients & housewares to help you create that exotic dish. The value we deliver to you from shopping at our stores ranges from every-day great savings, incredible sales, to free gifts with purchases!\r\n\r\nHow we do it:\r\nEfficiency is our philosophy. From our store format, what we merchandise, where our products are sourced from & who our suppliers are...this ultimately maximizes your shopping value.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grocery`
--
ALTER TABLE `grocery`
  ADD PRIMARY KEY (`grocery_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grocery`
--
ALTER TABLE `grocery`
  MODIFY `grocery_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
