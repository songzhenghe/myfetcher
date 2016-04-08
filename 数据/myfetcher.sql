-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-04-02 16:55:23
-- 服务器版本： 5.5.27
-- PHP Version: 5.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myfetcher`
--
CREATE DATABASE IF NOT EXISTS `myfetcher` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `myfetcher`;

-- --------------------------------------------------------

--
-- 表的结构 `demo888`
--

CREATE TABLE IF NOT EXISTS `demo888` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `demo888_arc_url`
--

CREATE TABLE IF NOT EXISTS `demo888_arc_url` (
`id` int(10) unsigned NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `demo888_current_item`
--

CREATE TABLE IF NOT EXISTS `demo888_current_item` (
`id` int(10) unsigned NOT NULL,
  `n` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `demo888_list_url`
--

CREATE TABLE IF NOT EXISTS `demo888_list_url` (
`id` int(10) unsigned NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `deword`
--

CREATE TABLE IF NOT EXISTS `deword` (
`id` int(10) unsigned NOT NULL,
  `word` varchar(255) NOT NULL,
  `spell` varchar(200) NOT NULL,
  `explain` text NOT NULL,
  `aleph` char(1) NOT NULL,
  `sentence` varchar(500) NOT NULL,
  `src` char(32) NOT NULL,
  `a` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5001 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `deword_current_item`
--

CREATE TABLE IF NOT EXISTS `deword_current_item` (
`id` int(10) unsigned NOT NULL,
  `n` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `frword`
--

CREATE TABLE IF NOT EXISTS `frword` (
`id` int(10) unsigned NOT NULL,
  `word` varchar(255) NOT NULL,
  `spell` varchar(200) NOT NULL,
  `explain` text NOT NULL,
  `aleph` char(1) NOT NULL,
  `sentence` varchar(500) NOT NULL,
  `src` char(32) NOT NULL,
  `a` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7393 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `frword_current_item`
--

CREATE TABLE IF NOT EXISTS `frword_current_item` (
`id` int(10) unsigned NOT NULL,
  `n` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jpword`
--

CREATE TABLE IF NOT EXISTS `jpword` (
`id` int(10) unsigned NOT NULL,
  `japanese` varchar(50) NOT NULL COMMENT '日本语',
  `alias` varchar(50) NOT NULL COMMENT '假名',
  `chinese` text NOT NULL COMMENT '汉语',
  `tone` tinyint(3) unsigned NOT NULL COMMENT '声调',
  `prop` tinyint(3) unsigned NOT NULL COMMENT '词性',
  `level` tinyint(3) unsigned NOT NULL COMMENT '等级',
  `pron` tinyint(3) unsigned NOT NULL COMMENT '读音',
  `audio` char(32) NOT NULL COMMENT '音频',
  `sentence` varchar(500) NOT NULL COMMENT '例句',
  `spell` varchar(200) NOT NULL COMMENT '发音'
) ENGINE=MyISAM AUTO_INCREMENT=16449 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jpword_base`
--

CREATE TABLE IF NOT EXISTS `jpword_base` (
`id` int(10) unsigned NOT NULL,
  `japanese` varchar(50) NOT NULL COMMENT '日本语',
  `alias` varchar(50) NOT NULL COMMENT '假名',
  `chinese` text NOT NULL COMMENT '汉语',
  `tone` tinyint(3) unsigned NOT NULL COMMENT '声调',
  `prop` tinyint(3) unsigned NOT NULL COMMENT '词性',
  `level` tinyint(3) unsigned NOT NULL COMMENT '等级',
  `pron` tinyint(3) unsigned NOT NULL COMMENT '读音',
  `audio` char(32) NOT NULL COMMENT '音频',
  `sentence` varchar(500) NOT NULL COMMENT '例句',
  `spell` varchar(200) NOT NULL COMMENT '发音'
) ENGINE=MyISAM AUTO_INCREMENT=16449 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jpword_current_item`
--

CREATE TABLE IF NOT EXISTS `jpword_current_item` (
`id` int(10) unsigned NOT NULL,
  `n` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `dir` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `class` varchar(200) NOT NULL,
  `callback` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demo888`
--
ALTER TABLE `demo888`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo888_arc_url`
--
ALTER TABLE `demo888_arc_url`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `demo888_current_item`
--
ALTER TABLE `demo888_current_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo888_list_url`
--
ALTER TABLE `demo888_list_url`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `deword`
--
ALTER TABLE `deword`
 ADD PRIMARY KEY (`id`), ADD KEY ` ich` (`word`);

--
-- Indexes for table `deword_current_item`
--
ALTER TABLE `deword_current_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frword`
--
ALTER TABLE `frword`
 ADD PRIMARY KEY (`id`), ADD KEY ` ich` (`word`);

--
-- Indexes for table `frword_current_item`
--
ALTER TABLE `frword_current_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jpword`
--
ALTER TABLE `jpword`
 ADD PRIMARY KEY (`id`), ADD KEY `index_j` (`japanese`) USING BTREE, ADD KEY `index_a` (`alias`) USING BTREE;

--
-- Indexes for table `jpword_base`
--
ALTER TABLE `jpword_base`
 ADD PRIMARY KEY (`id`), ADD KEY `index_j` (`japanese`) USING BTREE, ADD KEY `index_a` (`alias`) USING BTREE;

--
-- Indexes for table `jpword_current_item`
--
ALTER TABLE `jpword_current_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demo888`
--
ALTER TABLE `demo888`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `demo888_arc_url`
--
ALTER TABLE `demo888_arc_url`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `demo888_current_item`
--
ALTER TABLE `demo888_current_item`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `demo888_list_url`
--
ALTER TABLE `demo888_list_url`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `deword`
--
ALTER TABLE `deword`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5001;
--
-- AUTO_INCREMENT for table `deword_current_item`
--
ALTER TABLE `deword_current_item`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `frword`
--
ALTER TABLE `frword`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7393;
--
-- AUTO_INCREMENT for table `frword_current_item`
--
ALTER TABLE `frword_current_item`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jpword`
--
ALTER TABLE `jpword`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16449;
--
-- AUTO_INCREMENT for table `jpword_base`
--
ALTER TABLE `jpword_base`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16449;
--
-- AUTO_INCREMENT for table `jpword_current_item`
--
ALTER TABLE `jpword_current_item`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
