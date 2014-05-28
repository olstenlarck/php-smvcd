-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2014 at 03:17 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.21-1+debphp.org~quantal+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mbash_feb9`
--

-- --------------------------------------------------------

--
-- Table structure for table `smvc2014_about`
--

CREATE TABLE IF NOT EXISTS `smvc2014_about` (
  `abText` text NOT NULL,
  `abDate` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smvc2014_about`
--

INSERT INTO `smvc2014_about` (`abText`, `abDate`) VALUES
('Здравейте.\r\nЗа повече информация по системата и за това какво предстой - пишете Лично съобщение на ник tuN.nckoCore във CS-BG.info, в темата на системата или скайп [b]Linn3x[/b].\r\n\r\nМолим Ви не спамете - изчаквайте - не злоупотребявайте.\r\nВсеки който не се държи нормално или не е заинтересуван има правото [u]ДА НЕ[/u] пише - молим го да не го прави, в противен случей ще бъде блокиран.', '1347171031');

-- --------------------------------------------------------

--
-- Table structure for table `smvc2014_config`
--

CREATE TABLE IF NOT EXISTS `smvc2014_config` (
  `sys_temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_temp_name` varchar(255) NOT NULL,
  `sys_default_temp` varchar(255) NOT NULL,
  PRIMARY KEY (`sys_temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `smvc2014_config`
--

INSERT INTO `smvc2014_config` (`sys_temp_id`, `sys_temp_name`, `sys_default_temp`) VALUES
(1, 'Envision', 'default'),
(2, 'smartFTP', '');

-- --------------------------------------------------------

--
-- Table structure for table `smvc2014_news`
--

CREATE TABLE IF NOT EXISTS `smvc2014_news` (
  `newID` int(11) NOT NULL AUTO_INCREMENT,
  `newName` varchar(100) NOT NULL,
  `newAuthor` varchar(52) NOT NULL,
  `newDate` varchar(100) NOT NULL,
  `newText` text NOT NULL,
  PRIMARY KEY (`newID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `smvc2014_news`
--

INSERT INTO `smvc2014_news` (`newID`, `newName`, `newAuthor`, `newDate`, `newText`) VALUES
(1, 'Добре дошли в сайта', 'tunnckoCore', '1347171309', 'Йеп. Тъп сам и от тест след тест изтрих първата новина.\r\nНищо и без това беше време да напиша втора с всички промени.\r\n\r\nСлушам си Kingsize - Офанзива и направих няколко малки промени за удобство. Та ще взема да напиша новината, междувременно след това ще хода за фаски и кафенце.\r\nКакто е написал [b]SKiLLeR[/b] , системата си е на [u]99% защитена[/u], но имаше неща, които не ми харесаха та ги добавих/промених. Мисля да пусна малко ъпдейтната версия до края на деня.\r\n\r\n\r\nЛошото, е че ме мързи да ровя да търся абсолютно всички промени, които направих. Та затова ще останем без [u]CHANGELOG[/u], но пък ще изредя накратко.\r\n\r\n\r\n[u]1. Добавено Смяна на парола[/u]\r\n- Като има 3 полета. Едно за Стара парола, Второ за Нова парола, трето за Повтори парола\r\n- Проверява написаното в Стара парола дали съществува като запис в ДБ.\r\n- Проверява дали новите пароли съвпадат.\r\n- Проверява дали са различни Старата и Новата парола (трябва да са различни)\r\n[u]2. Преглед на профил (недооформен, но това всеки може да си го направи, според зависи)[/u]\r\n[u]2.2 Преглед на други профили[/u]\r\n[u]3. Списък на последните 15 регистрирани потребители.[/u]\r\n[u]4. ErrorMessages - всичко което не е както трябва, показва как да е.[/u]\r\n- Ако няма регистрирани, изписва че няма потребители.\r\n- Ако въведеш през линка несъществуващ потребител - изписва че няма такъв.\r\n- Ако някое от полетата не е попълнено/валидно/кратко - показва..\r\n\r\n\r\nОбщо взето всичко каквото може да е като Error. Като пробвате из полетата, ще забележите\r\n\r\n\r\n[code]\r\nEdit: Междудругото има BBCODES, само че трябва сам да си ги пишеш.[br]\r\nВсмисъл, че няма бутончета - поне за сега.\r\n[/code]\r\n[code]\r\nEdit2: До довечера ще наравя още подобрения и най-вероятно ще ги кача. Ето  какви ще бъдат...\r\n- (5%) Добавяне/промяна на потребител от админи\r\n- (10%) Добавяне на админ от админ акаунта\r\n- (100%) Може би нов дизайн\r\n- (45%) Промяна на профила от логнатия акаунт\r\n- (50%) Система за езика\r\n- Контрол панел за админа\r\n- Записване на последния вход\r\n- Даване на точки при успешен вход\r\n-- По-нататък може да има и за други действия.\r\n--- Може примерно да бъде за смяна на потребителското име (което ще се вижда)\r\n--- (30%) Смяна на името за вход[br]\r\n- Промяна на потребителското име (което ще се вижда)\r\n- (100%) Оправяне на title-те\r\n[/code]'),
(2, 'Features....', 'tunnckoCore', '1347700297', 'Тази вечер ще добавя повечето работи, които бях написал в предната новина.\r\n(ok) Плюс странициране, и оправяне на правата на потребителите.\r\n(ok) Също `Забравена парола`..'),
(5, 'Changelog - скоро отделно от новините', 'tunnckoCore', '1347171762', '[b]Предвидени добавки[/b]: Повечето може да ги видите на 3-та страница.\r\n- Добавяне на коментари и/или книга за гости\r\n- Нов дизайн\r\n- Бутончета за съответните bbcodes  при добавяне/редактирането на новини и подобни.\r\n- Потребителски групи, вероятно и админ панел -  зависи от дизайна.\r\n- Естествено, да споменем инсталация за системата.\r\n- След завършване на всичко поддръжка на сайт със системата и документация/помощ за работа с нея.\r\n\r\n[b]New 9 Септ. 2012г[/b]: [u]`[b]Крачка напред в приятелството със SEO[/b]`[/u]\r\n- Направена е схема за динамично сменяне на titles на различните страници, както и сменянето на мета тагoвете description, keywords и още други възможности.\r\n- Временно показва грешки за липсващи 2 елемента при извикването на метода render. Това е защото трябва да се обиколи системата да се променят titles, desc &amp; keywords - за всяка страница по отделно. Или най-малкото да бъдат null.\r\nЗа момента работят само за `Начало` и `Вход`.\r\n- До вечерта ще бъде сменен дизайна със сигурност. Както и започването на по-сериозна работа върху системата с изграждането на други функции.\r\n\r\n[b] 8 Септ. 2012г[/b]: Добавено странициране.\r\n\r\n[b]По-стари:[/b]\r\n- Смяна на парола - генериране на нова парола, ако потребителя си я е забравил.\r\n- Списък с последните 15 регистрирани потребители.\r\n- Отделни профили за всеки потребител.\r\n- Преглеждане на профил.'),
(6, 'Преустановяване на работа', 'tunnckoCore', '1347358738', 'Здравейте гости,\r\nВременно ще бъде преустановена работата точно по тази система. Започвам набързо да спретна сайта за фирмата ми и евентуално ще се довърши тази. Като цяло не е било идея да се докарва до някъде.\r\nЕдин вид GNU GPL ... Всеки може да тегли свободно и да си развива source, това е идеята - който с каквото може , за каквото има желание.\r\nДо няколко часа ще кача последната версия докъдето е - оттам нататък всеки може да си я дооправя. Правенето на функциите е изключително лесно и логично.\r\n\r\n[b]..[/b] Това е от мен/&gt;\r\n&lt;/Айде весело.\r\n[b]..[/b] tunnckoCore/&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `smvc2014_users`
--

CREATE TABLE IF NOT EXISTS `smvc2014_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(52) NOT NULL,
  `userPass` varchar(52) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userRegDate` varchar(100) NOT NULL,
  `userIP` varchar(100) NOT NULL,
  `userGroup` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `smvc2014_users`
--

INSERT INTO `smvc2014_users` (`userID`, `userName`, `userPass`, `userEmail`, `userRegDate`, `userIP`, `userGroup`) VALUES
(1, 'tunnckoCore', '21232f297a57a5a743894a0e4a801fc3', 'admin@smvc.bg', '1346321100', '1.1.1.1', 1),
(2, 'demoUser', '62cc2d8b4bf2d8728120d052163a77df', 'demo@smvc.bg', '1346371100', '78.132.11.15', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
