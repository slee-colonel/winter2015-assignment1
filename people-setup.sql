-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2015 at 05:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` varchar(64) NOT NULL,
  `mug` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `people` (`id`, `who`, `mug`) VALUES
(1, 'Scrooge McDuck', 'scrooge-mcduck.jpg'),
(2, 'Bruce Wayne', 'bruce-wayne.jpg'),
(3, 'Tony Stark', 'tony-stark.jpg'),
(4, 'Richie Rich', 'richie-rich.jpg');

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `owed` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `articles` (`id`, `who`, `title`, `text`, `owed`) VALUES
(1, 'Scrooge McDuck', 'Billionaire Found Guilty Of Child Labor', '"I fully intend to appeal this decision," said McDuck, "My nephews clearly volunteered in my endeavors."', 3600000),
(2, 'Tony Stark', 'Stark Industries Breach Defence Contract', 'After a five-month legal battle, the Supreme Court has ruled in favor of the Department of Defense.', 1500000000),
(3, 'Richie Rich', '3-Death Car Crash Fault Of Rich', 'After extensive police investigation, Rich was found at fault for the fatal car crash last month.', 350000),
(4, 'Richie Rich', 'Theme Park Land Dispute In Favor Of Condor', 'In a 3-2 decision, the Supreme Court has ruled that Condor does indeed own the 500 acres of land. Rich was not available for comment.', 4500000),
(5, 'Richie Rich', 'Theme Park Ruled Not Safe', 'The Court of Appeals has ruled that Rich was fully responsible for the injuries of Van Dough Jr. in the roller-coaster accident last month.', 200000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
