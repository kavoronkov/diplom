-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 20 2015 г., 21:54
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `NewsAgregator`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `id` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `moduleId` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Item`
--

CREATE TABLE IF NOT EXISTS `Item` (
  `id` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `link` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `pubDate` varchar(64) NOT NULL,
  `text` text,
  `moduleId` varchar(16) NOT NULL,
  `categoryId` varchar(16) NOT NULL,
  `sourceId` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Module`
--

CREATE TABLE IF NOT EXISTS `Module` (
  `id` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Module`
--

INSERT INTO `Module` (`id`, `name`) VALUES
('news', 'NEWS');

-- --------------------------------------------------------

--
-- Структура таблицы `Source`
--

CREATE TABLE IF NOT EXISTS `Source` (
  `id` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `url` varchar(64) NOT NULL,
  `xml` varchar(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `moduleId` varchar(16) NOT NULL,
  `categoryId` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
