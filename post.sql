-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2012 at 09:06 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telltale`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `isSuggestedEnd` tinyint(1) NOT NULL DEFAULT '0',
  `isEnd` tinyint(1) NOT NULL DEFAULT '0',
  `isAppended` tinyint(1) NOT NULL DEFAULT '0',
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `nid` (`nid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `nid`, `parent`, `text`, `isSuggestedEnd`, `isEnd`, `isAppended`, `timeStamp`) VALUES
(1, 1, NULL, 'Write your story here', 0, 0, 0, '2012-11-16 16:03:33'),
(2, 1, NULL, 'Another story starts\n', 0, 0, 0, '2012-11-16 15:59:08'),
(3, 1, NULL, 'asdasd', 0, 0, 0, '2012-11-30 08:14:27'),
(4, 1, NULL, 'Android Posts !!!\n\nGo Android GO !!!', 0, 0, 0, '2012-11-30 08:16:24'),
(5, 1, NULL, 'Once upon a time there lived a king . He always liked to sleep. \nHe slept and slept. The kingdom was falling apart, but still he slept and slept. All his pupils were so disgusted on him.\n', 0, 0, 0, '2012-11-30 08:18:30'),
(7, 1, NULL, 'Once a apple fall', 0, 0, 0, '2012-11-30 08:22:45'),
(8, 1, NULL, 'AM PATA JORA JORA \nMARBO CHABUK CHORBO GHORA', 0, 0, 0, '2012-12-02 19:49:56'),
(9, 1, NULL, 'HELLO', 0, 0, 0, '2012-12-02 19:51:51');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `user` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
