-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2011 at 10:45 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(20) COLLATE latin1_general_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` VALUES(2, 'Other', 'Questions');
INSERT INTO `cat` VALUES(5, 'hey', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `body` varchar(200) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `chatbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `time` varchar(15) NOT NULL,
  `detail` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` VALUES(1, 'hello, please reply i love your site', 'zach@360burst.com', 'Zach');
INSERT INTO `contact` VALUES(2, 'hey this site rocks!', 'blah@gmail.com', 'JD');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date` bigint(50) NOT NULL,
  `news` varchar(500) NOT NULL,
  `title` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` VALUES(0, 10, 'Thanks for testing out my amazing blog CMS!', 'iBlog 2.0 Alpha');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` VALUES(1, 'About', '*Test*\r\n\r\nHey!!!', 'about');
INSERT INTO `pages` VALUES(2, 'hi', 'wassaapppppp', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `body` varchar(5000) NOT NULL,
  `date` varchar(15) NOT NULL,
  `user` bigint(20) NOT NULL,
  `cat` int(11) NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES(1, 'Cool!', 'this is an example blog post powered by iBlog!', '1287944747', 0, 2, '', '');
INSERT INTO `posts` VALUES(10, 'iBlog test!', '### Awesome sites\r\n\r\ncheck out [wordpress](http://wordpress.com)', '1314573652', 1, 2, '', '');
INSERT INTO `posts` VALUES(20, 'Hey whats up', 'this is my first try posting!', '1315242978', 1, 2, '2011/09/05/hey-whats-up/', 'Publish');
INSERT INTO `posts` VALUES(21, 'testalicouewfewfwfwf2', 'AWWWWWW YES!!!\r\n===========\r\n\r\n', '1315243012', 1, 2, '2011/09/05/testalicouewfewfwfwf2/', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `siteinfo`
--

CREATE TABLE `siteinfo` (
  `name` varchar(20) NOT NULL,
  `short` varchar(140) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siteinfo`
--

INSERT INTO `siteinfo` VALUES('Zach''s iBlog', 'Zach''s iBlog is awesome!!', 'default', '2.0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `lvl` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `users`
--

