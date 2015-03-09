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
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` varchar(64) NOT NULL,
  `mug` varchar(64) NOT NULL,
  `what` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `quotes` (`id`, `who`, `mug`, `what`) VALUES
(1, 'Bob Monkhouse', 'bob-monkhouse-150x150.jpg', 'When I die, I want to go peacefully like my grandfather did–in his sleep. Not yelling and screaming like the passengers in his car.'),
(2, 'Elayne Boosler', 'elayne-boosler-150x150.jpg', 'I have six locks on my door all in a row. When I go out, I lock every other one. I figure no matter how long somebody stands there picking the locks, they are always locking three.'),
(3, 'Mark Russell', 'bob-monkhouse-150x150.jpg', 'The scientific theory I like best is that the rings of Saturn are composed entirely of lost airline luggage.'),
(4, 'Anonymous', 'Anonymous-150x150.jpg', 'How do you get a sweet little 80-year-old lady to say the F word? Get another sweet little 80-year-old lady to yell “BINGO!”'),
(5, 'Socrates', 'socrates-150x150.jpg', 'By all means, marry. If you get a good wife, you’ll become happy; if you get a bad one, you’ll become a philosopher.'),
(6, 'Isaac Asimov', 'isaac-asimov-150x150.jpg', 'Those people who think they know everything are a great annoyance to those of us who do.');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
