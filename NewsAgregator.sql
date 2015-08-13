-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 13 2015 г., 16:52
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
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `moduleId` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Category`
--

INSERT INTO `Category` (`id`, `name`, `moduleId`) VALUES
('news_all', 'all', 'news'),
('news_articles', 'articles', 'news'),
('news_capital', 'capital', 'news'),
('news_culture', 'culture', 'news'),
('news_economics', 'economics', 'news'),
('news_interview', 'interview', 'news'),
('news_news', 'news', 'news'),
('news_photo', 'photo', 'news'),
('news_politics', 'politics', 'news'),
('news_smi', 'smi', 'news'),
('news_society', 'society', 'news'),
('news_sport', 'sport', 'news'),
('news_top', 'top', 'news'),
('news_ua_all', 'ua_all', 'news'),
('news_ua_top', 'ua_top', 'news'),
('news_video', 'video', 'news'),
('news_world', 'world', 'news');

-- --------------------------------------------------------

--
-- Структура таблицы `Item`
--

CREATE TABLE IF NOT EXISTS `Item` (
  `id` varchar(64) NOT NULL,
  `name` varchar(256) NOT NULL,
  `link` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `pubDate` varchar(64) NOT NULL,
  `text` text,
  `moduleId` varchar(64) DEFAULT NULL,
  `categoryId` varchar(64) DEFAULT NULL,
  `sourceId` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Module`
--

CREATE TABLE IF NOT EXISTS `Module` (
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Module`
--

INSERT INTO `Module` (`id`, `name`) VALUES
('currency', 'currency'),
('finance', 'finance'),
('fuel', 'fuel'),
('news', 'news'),
('weather', 'weather');

-- --------------------------------------------------------

--
-- Структура таблицы `Source`
--

CREATE TABLE IF NOT EXISTS `Source` (
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(64) NOT NULL,
  `xml` varchar(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `moduleId` varchar(64) NOT NULL,
  `categoryId` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Source`
--

INSERT INTO `Source` (`id`, `name`, `url`, `xml`, `title`, `description`, `moduleId`, `categoryId`) VALUES
('news_all_liga', 'liga', 'www.liga.net', 'http://news.liga.net/all/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_all'),
('news_articles_liga', 'liga', 'www.liga.net', 'http://news.liga.net/articles/rss.xml', 'Настоящие новости Украины : ЛІГА.Новости', 'Ежедневные новости: политика, власть, экономика и финансы, общество, мир, технологии. Фотографии с места событий.', 'news', 'news_articles'),
('news_capital_liga', 'liga', 'www.liga.net', 'http://news.liga.net/capital/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_capital'),
('news_culture_liga', 'liga', 'www.liga.net', 'http://news.liga.net/culture/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_culture'),
('news_economics_liga', 'liga', 'www.liga.net', 'http://news.liga.net/economics/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_economics'),
('news_interview_liga', 'liga', 'www.liga.net', 'http://news.liga.net/interview/rss.xml', 'Настоящие новости Украины : ЛІГА.Новости', 'Ежедневные новости: политика, власть, экономика и финансы, общество, мир, технологии. Фотографии с места событий.', 'news', 'news_interview'),
('news_news_liga', 'liga', 'www.liga.net', 'http://news.liga.net/news/rss.xml', 'Настоящие новости Украины : ЛІГА.Новости', 'Ежедневные новости: политика, власть, экономика и финансы, общество, мир, технологии. Фотографии с места событий.', 'news', 'news_news'),
('news_photo_liga', 'liga', 'www.liga.net', 'http://news.liga.net/photo/rss.xml', 'Настоящие новости Украины : ЛІГА.Новости', 'Ежедневные новости: политика, власть, экономика и финансы, общество, мир, технологии. Фотографии с места событий.', 'news', 'news_photo'),
('news_politics_liga', 'liga', 'www.liga.net', 'http://news.liga.net/politics/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_politics'),
('news_smi_liga', 'liga', 'www.liga.net', 'http://news.liga.net/smi/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_smi'),
('news_society_liga', 'liga', 'www.liga.net', 'http://news.liga.net/society/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_society'),
('news_sport_liga', 'liga', 'www.liga.net', 'http://news.liga.net/sport/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_sport'),
('news_top_liga', 'liga', 'www.liga.net', 'http://news.liga.net/top/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_top'),
('news_ua_all_liga', 'liga', 'www.liga.net', 'http://news.liga.net/ua/all/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_ua_all'),
('news_ua_top_liga', 'liga', 'www.liga.net', 'http://news.liga.net/ua/top/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_ua_top'),
('news_video_liga', 'liga', 'www.liga.net', 'http://news.liga.net/video/rss.xml', 'Настоящие новости Украины : ЛІГА.Новости', 'Ежедневные новости: политика, власть, экономика и финансы, общество, мир, технологии. Фотографии с места событий.', 'news', 'news_video'),
('news_world_liga', 'liga', 'www.liga.net', 'http://news.liga.net/world/rss.xml', 'Новости Украины 24 часа в сутки : ЛІГАБізнесІнформ', 'Ежедневные новости Украины: Оперативно, Достоверно, 24 часа в сутки. Последние новости, фотографии с места событий. Горячие новости: политика, экономика и финансы, общество, мир, культура, спорт и новости Киева.', 'news', 'news_world');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `settings` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
