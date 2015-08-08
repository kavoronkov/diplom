-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 08 2015 г., 09:49
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
('201508010829131001', 'Террористы увеличили количество обстрелов в районе Донецка', 'http://news.liga.net/news/politics/6314151-terroristy_uvelichili_kolichestvo_obstrelov_v_rayone_donetska.htm', 'Во время обстрелов в районе Донецка боевики использовали минометы, танки и БТР. Они продолжили уничтожение жилых домов в Авдеевке и Верхнетроицком', 'http://news.liga.net/upload/iblock/f86/f8615c4fc5c3ef00db894cc3e989e33d.jpg', 'sat, 01 aug 2015 07:58:15 +0300', NULL, '1', '1', '1'),
('201508010829131002', 'В Крыму у экс-регионала Царева угнали внедорожник', 'http://news.liga.net/news/politics/6314129-v_krymu_u_eks_regionala_tsareva_ugnali_vnedorozhnik.htm', 'По словам беглого политика, авто якобы могли перегнать в Украину и уже перекрасили в черный цвет\n\n', 'http://news.liga.net/upload/iblock/e2c/e2c7a422f9804760f1206bb5ccbf5e39.jpg', 'sat, 01 aug 2015 05:00:00 +0300', NULL, '1', '1', '1'),
('201508010829131003', 'В Донецкой области для АТО создали спецбатальон милиции', 'http://news.liga.net/news/politics/6314125-v_donetskoy_oblasti_dlya_ato_sozdali_spetsbatalon_militsii.htm', 'На данный момент проходит доукомплектование батальона необходимой специальной техникой, оружием и боеприпасами\n\n', 'http://news.liga.net/upload/iblock/8f3/8f32e13487b0c805a1e0415b658efc39.jpg', 'sat, 01 aug 2015 04:00:00 +0300', NULL, '1', '1', '1'),
('201508010829131004', 'Чуркин предрек провал повторной попытки создать трибунал по МН17', 'http://news.liga.net/news/politics/6314110-churkin_predrek_proval_povtornoy_popytki_sozdat_tribunal_po_mn17.htm', 'Дипломат заявил, что Совбез ООН повторно провалит голосование за инициативу по организации работы международного суда в деле теракта против Боинга', 'http://news.liga.net/upload/iblock/4d1/4d190e866b15e7317695009a57de16ad.jpg', 'sat, 01 aug 2015 02:02:59 +0300', NULL, '1', '1', '1'),
('201508010829131005', 'Меджлис обвинил Россию в срыве участия татар в конгрессе в Турции', 'http://news.liga.net/news/politics/6314096-medzhlis_obvinil_rossiyu_v_sryve_uchastiya_tatar_v_kongresse_v_turtsii.htm', 'В представительском органе крымских татар обвиняют оккупантов в новых попытках не допустить представителей народа на важное мероприятие', 'http://news.liga.net/upload/iblock/f01/f01774ea3e5cee80c3f969b80c9284ff.jpg', 'sat, 01 aug 2015 01:20:00 +0300', NULL, '1', '1', '1'),
('201508010829131006', 'В Одессе задержали двух сепаратистов за пропаганду в соцсетях', 'http://news.liga.net/news/politics/6314087-v_odesse_zaderzhali_dvukh_separatistov_za_propagandu_v_sotssetyakh.htm', 'Подозреваемые распространяли призывы к свержению конституционного строя Украины, а также совершению терактов на украинской территории', 'http://news.liga.net/upload/iblock/ac9/ac9b3e964aef6b192eb3483c73cb761d.jpg', 'sat, 01 aug 2015 00:42:00 +0300', NULL, '1', '1', '1'),
('201508010829131007', 'Интерпол прекратил процессуальные действия в отношении Саакашвили', 'http://news.liga.net/news/politics/6314080-interpol_prekratil_protsessualnye_deystviya_v_otnoshenii_saakashvili.htm', 'Европейские правоохранители приняли решение отказать Грузии в запросе на объявление грузинского экс-президента в международный розыск', 'http://news.liga.net/upload/iblock/c8e/c8ed87a0504886dab3cfb584e7e1eb65.jpg', 'sat, 01 aug 2015 00:25:59 +0300', NULL, '1', '1', '1'),
('201508010829131008', 'Дело Лавриновича: ГПУ подала апелляцию на залог для экс-министра', 'http://news.liga.net/news/politics/6314072-delo_lavrinovicha_gpu_podala_apellyatsiyu_na_zalog_dlya_eks_ministra.htm', 'Генпрокуратура обжаловала решение Печерского райсуда Киева о снижении залоговой суммы для бывшего чиновника с 8 млн грн до 1,2 млн грн', 'http://news.liga.net/upload/iblock/1cb/1cb80d6d7c3438e97972681ecd803bee.jpg', 'fri, 31 jul 2015 23:58:00 +0300', NULL, '1', '1', '1'),
('201508010829131009', 'Франция не подтверждает расторжение контракта по Мистралям с РФ', 'http://news.liga.net/news/politics/6314069-frantsiya_ne_podtverzhdaet_rastorzhenie_kontrakta_po_mistralyam_s_rf.htm', 'Российские чиновники отказались комментировать опровержение Елисейского дворца по достижению соглашения о расторжении контракта по Мистралям', 'http://news.liga.net/upload/iblock/063/063b4136e61e94f9c08b41204727c3ee.jpg', 'fri, 31 jul 2015 23:50:30 +0300', NULL, '1', '1', '1'),
('201508010829131010', 'Война России против Украины: последние события в Донбассе', 'http://news.liga.net/articles/politics/6114109-voyna_rossii_protiv_ukrainy_poslednie_sobytiya_v_donbasse.htm', 'Что происходит в Луганске, Донецке, Мариуполе, Дебальцево, Горловке и других горячих точках востока Украины', 'http://news.liga.net/upload/iblock/8cb/8cb11e6439e92694455330cd37912bfe.jpg', 'fri, 31 jul 2015 23:00:00 +0300', NULL, '1', '1', '1'),
('201508010829131011', 'Народный депутат Ланьо вернулся на Закарпатье - СМИ', 'http://news.liga.net/news/politics/6314052-narodnyy_deputat_lano_vernulsya_na_zakarpate_smi.htm', 'По информации закарпатских СМИ народный депутат неделю отдыхал на море, а 30 июля вернулся в Украину', 'http://news.liga.net/upload/iblock/aad/aadbd9b6742d33fd48988d3cf9cb7804.jpg', 'fri, 31 jul 2015 22:20:05 +0300', NULL, '1', '1', '1'),
('201508010829131012', 'Селезнев: Демилитаризацию Широкино нужно согласовать к 3 августа', 'http://news.liga.net/video/politics/6314046-seleznev_demilitarizatsiyu_shirokino_nuzhno_soglasovat_k_3_avgusta.htm', 'После подписания документа о демилитаризации из поселка в течение 10 дней выведут тяжелое вооружение и танки, а военнослужащие останутся на позициях', 'http://news.liga.net/upload/iblock/88c/88c43603e91c60663f2cb9bbae6ac913.jpg', 'fri, 31 jul 2015 21:50:36 +0300', NULL, '1', '1', '1'),
('201508010829131013', 'Боевики ДНР выгнали представителей ОБСЕ из поселка Октябрь', 'http://news.liga.net/news/politics/6314029-boeviki_dnr_vygnali_predstaviteley_obse_iz_poselka_oktyabr.htm', 'Вблизи поселка патруль спецмиссии был остановлен двумя представителями ДНР, которые приказали наблюдателям вернуться назад', 'http://news.liga.net/upload/iblock/cd1/cd19ac51be0f3bd6b92e30cbca7963ba.jpg', 'fri, 31 jul 2015 20:19:02 +0300', NULL, '1', '1', '1'),
('201508010829131014', 'Ситуация в зоне АТО: 40 обстрелов и бой возле Золотого', 'http://news.liga.net/news/politics/6314014-situatsiya_v_zone_ato_40_obstrelov_i_boy_vozle_zolotogo.htm', 'В районе поселка Золотое на Луганщине украинские военные дали бой диверсионной группе, которая вынуждена была отступить', 'http://news.liga.net/upload/iblock/569/56940d8b524f32600bba0b867ef3c30a.jpg', 'fri, 31 jul 2015 19:26:34 +0300', NULL, '1', '1', '1'),
('201508010829131015', 'Суд продлил меру пресечения Ефремову до 30 сентября', 'http://news.liga.net/news/politics/6303161-sud_prodlil_meru_presecheniya_efremovu_do_30_sentyabrya.htm', 'Влиятельного экс-регионала подозревают в злоупотреблении служебным положением и подлоге во время голосования за диктаторские законы 16 января', 'http://news.liga.net/upload/iblock/ca2/ca2859c50966672164e021188352b080.jpg', 'fri, 31 jul 2015 19:01:31 +0300', NULL, '1', '1', '1'),
('201508010829131016', 'РФ прекратит сборку Ан-140 "из-за нехватки запчастей из Украины"', 'http://news.liga.net/news/politics/6303155-rf_prekratit_sborku_an_140_iz_za_nekhvatki_zapchastey_iz_ukrainy.htm', 'Быстрое импортозамещение украинских комплектующих для самолета не представляется возможным - российские СМИ', 'http://news.liga.net/upload/iblock/cb1/cb17ba866d745e9b0d0152e192523689.jpg', 'fri, 31 jul 2015 18:45:00 +0300', NULL, '1', '1', '1'),
('201508010829131017', 'За убийство в харьковском супермаркете ищут уроженца Сумщины', 'http://news.liga.net/news/politics/6303151-za_ubiystvo_v_kharkovskom_supermarkete_ishchut_urozhentsa_sumshchiny.htm', 'Прошлой ночью преступник убил мужчину в одном из харьковских супермаркетов', 'http://news.liga.net/upload/iblock/690/690ff8b2b60ee8fa3eda62bca4e3c75a.jpg', 'fri, 31 jul 2015 18:27:05 +0300', NULL, '1', '1', '1'),
('201508010829131018', 'СБУ аннулировала аккредитацию британской журналистке sky news', 'http://news.liga.net/news/politics/6303130-sbu_annulirovala_akkreditatsiyu_britanskoy_zhurnalistke_sky_news.htm', 'Журналистка британского телеканала sky news Китти Логан подстрекала боевиков к стрельбе по позициям украинских военных', 'http://news.liga.net/upload/iblock/287/287926bb343a5ed0b4d22cefce760b57.jpg', 'fri, 31 jul 2015 18:02:14 +0300', NULL, '1', '1', '1'),
('201508010829131019', 'Грибаускайте: РФ есть, что скрывать в отношении сбитого boeing', 'http://news.liga.net/news/politics/6303141-gribauskayte_rf_est_chto_skryvat_v_otnoshenii_sbitogo_boeing.htm', 'Вето России на предложение о создании трибунала по boeing является сигналом того, что Кремль пытается избежать расследования преступления', 'http://news.liga.net/upload/iblock/5d4/5d45a478cbb194268ce0ed502d473f73.jpg', 'fri, 31 jul 2015 18:00:34 +0300', NULL, '1', '1', '1'),
('201508010829131020', 'Как проходили военные учения rapid trident 2015 в Украине: фото', 'http://news.liga.net/photo/politics/6303097-kak_prokhodili_voennye_ucheniya_rapid_trident_2015_v_ukraine_foto.htm', 'Масштабные военные учения rapid trident в этом году прошли с участием военнослужащих из 18 стран', 'http://news.liga.net/upload/iblock/731/731362a6fbadc3fb8f58c951d5495fcd.jpg', 'fri, 31 jul 2015 17:34:47 +0300', NULL, '1', '1', '1'),
('201508011126121001', 'Москаль хочет привлечь табачные компании к борьбе с контрабандой', 'http://news.liga.net/news/politics/6314181-moskal_khochet_privlech_tabachnye_kompanii_k_borbe_s_kontrabandoy.htm', 'Губернатор Закарпатья попросил табачные компании провести лабораторные исследования изъятых сигарет, чтобы идентифицировать место их производства', 'http://news.liga.net/upload/iblock/217/217cd9078e6a275ff17e1e1a4b568d4b.jpg', 'sat, 01 aug 2015 11:00:00 +0300', NULL, '1', '1', '1');

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
('currency', 'currency'),
('fuel', 'fuel'),
('news', 'news'),
('weather', 'weather');

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
