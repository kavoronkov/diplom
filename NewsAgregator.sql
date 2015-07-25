-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 25 2015 г., 09:32
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
  `id` varchar(64) NOT NULL,
  `name` varchar(256) NOT NULL,
  `link` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `pubDate` varchar(64) NOT NULL,
  `text` text,
  `moduleId` varchar(16) DEFAULT NULL,
  `categoryId` varchar(16) DEFAULT NULL,
  `sourceId` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Item`
--

INSERT INTO `Item` (`id`, `name`, `link`, `description`, `image`, `pubDate`, `text`, `moduleId`, `categoryId`, `sourceId`) VALUES
('201507202244561001', 'ОБСЕ зафиксировала перемещение через границу с РФ 20 тыс. военных', 'http://news.liga.net/news/politics/6232025-obse_zafiksirovala_peremeshchenie_cherez_granitsu_s_rf_20_tys_voennykh.htm', 'Члены мониторинговой миссии сообщили, что у части вооруженных лиц были разные нашивки, а некоторые не имели никаких опознавательных знаков', 'http://news.liga.net/upload/iblock/f1b/f1b6988d17420943f749bf1dc504e8ee.jpg', 'Mon, 20 Jul 2015 22:06:30 +0300', NULL, NULL, NULL, '1'),
('201507202244561002', 'Боевики вновь обстреляли Станицу Луганскую, есть новые разрушения', 'http://news.liga.net/news/politics/6232022-boeviki_vnov_obstrelyali_stanitsu_luganskuyu_est_novye_razrusheniya.htm', 'При обстреле из гранатомета несколько снарядов попали в жилые дома по ул. Лермонтова, произошел пожар', 'http://news.liga.net/upload/iblock/a84/a8499f39295450cfd4de8d06032c17be.jpg', 'Mon, 20 Jul 2015 21:45:55 +0300', NULL, NULL, NULL, '1'),
('201507202244561003', 'Война России против Украины: последние события в Донбассе', 'http://news.liga.net/articles/politics/6114109-voyna_rossii_protiv_ukrainy_poslednie_sobytiya_v_donbasse.htm', 'Что происходит в Луганске, Донецке, Мариуполе, Дебальцево, Горловке и других горячих точках востока Украины', 'http://news.liga.net/upload/iblock/8cb/8cb11e6439e92694455330cd37912bfe.jpg', 'Mon, 20 Jul 2015 21:35:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561004', 'На СНБО обсудили нейтрализацию угроз госбезопасности', 'http://news.liga.net/news/politics/6232013-na_snbo_obsudili_neytralizatsiyu_ugroz_gosbezopasnosti.htm', 'На заседании Совета члены СНБО решили усилить координацию деятельности органов безопасности и обороны для предотвращения внутренних и внешних угроз', 'http://news.liga.net/upload/iblock/c83/c83ad390c1c15e8a6a6e9e7bd489f2f7.jpg', 'Mon, 20 Jul 2015 21:13:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561005', 'Обнародовано видео передвижной минометной установки боевиков ДНР', 'http://news.liga.net/video/politics/6232007-obnarodovano_video_peredvizhnoy_minometnoy_ustanovki_boevikov_dnr.htm', 'В кузове бывшего мусоровоза установлен миномет "Василек". Авто было дополнительно бронировано металлическими листами', 'http://news.liga.net/upload/iblock/cff/cffe870936ce53ffae58951db4c4a224.jpg', 'Mon, 20 Jul 2015 20:44:50 +0300', NULL, NULL, NULL, '1'),
('201507202244561006', 'СНБО взялся за дополнительные меры по безвизовому режиму с ЕС', 'http://news.liga.net/news/politics/6232003-snbo_vzyalsya_za_dopolnitelnye_mery_po_bezvizovomu_rezhimu_s_es.htm', 'На заседании Совета безопасности и обороны под председательством президента Украины члены СНБО рассмотрели темпы выполнения Украиной Плана действий', 'http://news.liga.net/upload/iblock/0f6/0f6bb6ec128093e66b35c090c557bb43.jpg', 'Mon, 20 Jul 2015 20:24:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561007', 'АТО: более 40 обстрелов позиций ВСУ и новые провокации оккупантов', 'http://news.liga.net/news/politics/6231996-ato_bolee_40_obstrelov_pozitsiy_vsu_i_novye_provokatsii_okkupantov.htm', 'По данным сил антитеррора, в Донбассе фиксируется новая эскалация ситуации, боевики продолжают вести обстрелы из запрещенного вооружения', 'http://news.liga.net/upload/iblock/424/424bb5b0eb80722c42c75962e9cc3fb1.jpg', 'Mon, 20 Jul 2015 19:52:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561008', 'Порошенко на СНБО заявил, что у Москаля - полный карт-бланш', 'http://news.liga.net/news/politics/6231986-poroshenko_na_snbo_zayavil_chto_u_moskalya_polnyy_kart_blansh.htm', 'Президент сообщил, что кадровые решения на Закарпатье - только начало по наведению порядка в регионе', 'http://news.liga.net/upload/iblock/0ad/0adfab0456fb55d0da230662a0528056.jpg', 'Mon, 20 Jul 2015 19:25:59 +0300', NULL, NULL, NULL, '1'),
('201507202244561009', 'Порошенко потребовал пустить наблюдателей ОБСЕ на границу с РФ', 'http://news.liga.net/news/politics/6221224-poroshenko_potreboval_pustit_nablyudateley_obse_na_granitsu_s_rf.htm', 'Президент прокомментировал срыв Минска-2 в Донбассе и необходимость возобновления контроля за неконтролируемой частью госграницы на востоке Украины', 'http://news.liga.net/upload/iblock/618/61856a69c8a7ae2fc8aff6f42d37f456.jpg', 'Mon, 20 Jul 2015 19:07:30 +0300', NULL, NULL, NULL, '1'),
('201507202244561010', 'Апелляционный суд отказался освобождать экс-зампрокурора Киевщины', 'http://news.liga.net/news/politics/6221214-apellyatsionnyy_sud_otkazalsya_osvobozhdat_eks_zamprokurora_kievshchiny.htm', 'Суд высшей инстанции отклонил требования защиты фигуранта коррупционного дела по изменению меры пресечения и снижению суммы залога', 'http://news.liga.net/upload/iblock/4cc/4cc77dfb45d1af467683c4c435398a05.jpg', 'Mon, 20 Jul 2015 18:55:59 +0300', NULL, NULL, NULL, '1'),
('201507202244561011', 'Порошенко требует от боевиков ДНР/ЛНР не проводить псевдовыборы', 'http://news.liga.net/news/politics/6221206-poroshenko_trebuet_ot_boevikov_dnr_lnr_ne_provodit_psevdovybory.htm', 'Президент заявил, что Украина готова рассматривать вопрос проведения выборов на оккупированном Донбассе, если боевики откажутся проводить свои', 'http://news.liga.net/upload/iblock/47a/47a4ef6dabbec9e53ebc93ec5361bc99.jpg', 'Mon, 20 Jul 2015 18:27:59 +0300', NULL, NULL, NULL, '1'),
('201507202244561012', 'Саакашвили взял штурмом резиденцию экс-регионала: фото рейда', 'http://news.liga.net/photo/politics/6221203-saakashvili_vzyal_shturmom_rezidentsiyu_eks_regionala_foto_reyda.htm', 'Глава Одесской ОГА добился открытия прохода к морю по территории резиденции Хмельницкого, замаскированной под строящийся пансионат', 'http://news.liga.net/upload/iblock/8fb/8fbf26f225300a1c43489a7e5bb5d737.jpg', 'Mon, 20 Jul 2015 18:15:59 +0300', NULL, NULL, NULL, '1'),
('201507202244561013', 'В Минобороны прокомментировали активность боевиков перед Минском', 'http://news.liga.net/news/politics/6221187-v_minoborony_prokommentirovali_aktivnost_boevikov_pered_minskom.htm', 'Боевики продолжают вести огонь из артиллерии, расположенной в жилых кварталах, используя гражданское население в качестве живого щита', 'http://news.liga.net/upload/iblock/129/129ac224e29e5414028dbf40df357517.jpg', 'Mon, 20 Jul 2015 17:59:42 +0300', NULL, NULL, NULL, '1'),
('201507202244561014', 'В МИД Украины вызвали посла Венгрии из-за шпионского скандала', 'http://news.liga.net/news/politics/6221167-v_mid_ukrainy_vyzvali_posla_vengrii_iz_za_shpionskogo_skandala.htm', 'Внешнеполитическое ведомство выразило возмущение из-за заявления венгерского министра Лазара о деятельности венгерских спецслужб в Украине', 'http://news.liga.net/upload/iblock/b15/b15777cbaf27d478ab2b3aa0b6dffbd3.jpg', 'Mon, 20 Jul 2015 17:39:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561015', 'Рейтинги: Критикуя Кабмин, Тимошенко отбирает голоса у Яценюка', 'http://news.liga.net/news/politics/6221155-reytingi_kritikuya_kabmin_timoshenko_otbiraet_golosa_u_yatsenyuka.htm', 'Критика коалиции изнутри со стороны Юлии Тимошенко, несмотря на популизм, способствует росту рейтинга. Голоса Народного фронта уходят к Батькивщине', 'http://news.liga.net/upload/iblock/f2e/f2e16e805eb60a55dac47009452c4317.jpg', 'Mon, 20 Jul 2015 17:33:32 +0300', NULL, NULL, NULL, '1'),
('201507202244561016', 'Саакашвили находится в процессе смены гражданства', 'http://news.liga.net/news/politics/6221121-saakashvili_nakhoditsya_v_protsesse_smeny_grazhdanstva.htm', 'Губернатор Одесской области находится в процессе отказа от грузинского гражданства - Одесская ОГА', 'http://news.liga.net/upload/iblock/568/56885979d6a95f296d4363a3c66edcc6.jpg', 'Mon, 20 Jul 2015 16:46:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561017', 'Турчинов прокомментировал угрозы террориста Захарченко', 'http://news.liga.net/news/politics/6221117-turchinov_prokommentiroval_ugrozy_terrorista_zakharchenko.htm', 'Секретарь СНБО считает, что заявления о захвате всего Донбасса свидетельствуют о том, что РФ хочет дискредитировать договоренности, принятые в Минске', 'http://news.liga.net/upload/iblock/e9b/e9b357cc8200ff40d1909b8d2c3ccc94.jpg', 'Mon, 20 Jul 2015 16:45:30 +0300', NULL, NULL, NULL, '1'),
('201507202244561018', 'Посольство Франции в Украине впервые возглавит женщина', 'http://news.liga.net/news/politics/6221102-posolstvo_frantsii_v_ukraine_vpervye_vozglavit_zhenshchina.htm', 'Чрезвычайным и полномочным послом Французской Республики в Украине назначена Изабель Дюмон', 'http://news.liga.net/upload/iblock/3a8/3a828bebb178194115dabd503e99d821.jpg', 'Mon, 20 Jul 2015 16:28:00 +0300', NULL, NULL, NULL, '1'),
('201507202244561019', 'Появилось новое видео руин Донецкого аэропорта', 'http://news.liga.net/video/politics/6221098-poyavilos_novoe_video_ruin_donetskogo_aeroporta.htm', 'На записи можно увидеть разрушенный терминал аэропорта и дорогу к нему', 'http://news.liga.net/upload/iblock/b82/b82b6b59055ac9b8c13a004a3c77cee1.jpg', 'Mon, 20 Jul 2015 16:25:59 +0300', NULL, NULL, NULL, '1'),
('201507202244561020', 'В Украине стартовали масштабные военные учения с армией США: фото', 'http://news.liga.net/photo/politics/6221092-v_ukraine_startovali_masshtabnye_voennye_ucheniya_s_armiey_ssha_foto.htm', 'Цель учений Rapid Trident - подготовка штабов и подразделений многонациональной бригады к ведению стабилизационных действий', 'http://news.liga.net/upload/iblock/e01/e010bdd0dccdbb0ac8e33b2438e9ee58.jpg', 'Mon, 20 Jul 2015 16:23:06 +0300', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `Module`
--

CREATE TABLE IF NOT EXISTS `Module` (
  `id` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
