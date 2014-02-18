-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 09 月 03 日 13:59
-- 服务器版本: 5.5.29
-- PHP 版本: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `nexus_rsss`
--

-- --------------------------------------------------------

--
-- 表的结构 `rss_source`
--

CREATE TABLE IF NOT EXISTS `rss_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `rss_source`
--

INSERT INTO `rss_source` (`id`, `url`, `enabled`, `note`) VALUES
(1, 'http://222.199.184.28/torrentrss2.php?startindex=0&rows=10&cat401=1&icat=1&ismalldescr=1&isize=1&iuplder=1', 1, '6xvod');

-- --------------------------------------------------------

--
-- 表的结构 `torrents`
--

CREATE TABLE IF NOT EXISTS `torrents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doubanid` bigint(20) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `small_descr` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `dl_url` varchar(255) NOT NULL,
  `length` bigint(20) NOT NULL,
  `descr` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `imdb` varchar(255) NOT NULL,
  `downloaded` int(11) NOT NULL,
  `uploaded` int(11) NOT NULL,
  `completed` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
