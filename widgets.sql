-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 27 2017 г., 18:01
-- Версия сервера: 5.6.31-log
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `widgets`
--

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `jdata` text NOT NULL,
  `position` int(11) NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `widgets`
--

INSERT INTO `widgets` (`id`, `title`, `type`, `jdata`, `position`, `visible`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Цифровой блок', 1, '{"widget":{"fields":{"blocks":[{"number":"2000","title":"\\u041a\\u043b\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432","text":"\\u0423 \\u043d\\u0430\\u0441 \\u0431\\u043e\\u043b\\u0435\\u0435 200 \\u043a\\u043b\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432 \\u0432 \\u0433\\u043e\\u0434"},{"number":"15","title":"\\u041d\\u0430 \\u0440\\u044b\\u043d\\u043a\\u0435","text":"\\u0411\\u043e\\u043b\\u0435\\u0435 15 \\u043b\\u0435\\u0442 \\u043d\\u0430 \\u0440\\u044b\\u043d\\u043a\\u0435"},{"number":"150000","title":"\\u041d\\u0430\\u0438\\u043c\\u0435\\u043d\\u043e\\u0432\\u0430\\u043d\\u0438\\u0439","text":"\\u0411\\u043e\\u043b\\u0435\\u0435 150 000 \\u043d\\u0430\\u0438\\u043c\\u0435\\u043d\\u043e\\u0432\\u0430\\u043d\\u0438\\u0439"},{"number":"0","title":"\\u041d\\u0435 \\u0434\\u043e\\u0432\\u043e\\u043b\\u044c\\u043d\\u044b\\u0445","text":"\\u0423 \\u043d\\u0430\\u0441 \\u041d\\u0415\\u0422 \\u043e\\u0442\\u0440\\u0438\\u0446\\u0430\\u0442\\u0435\\u043b\\u044c\\u043d\\u044b\\u0445 \\u043e\\u0442\\u0437\\u044b\\u0432\\u043e\\u0432 \\u043e\\u0442 \\u043a\\u043b\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432"}],"title":"\\u041e \\u043d\\u0430\\u0441 \\u0432 \\u0446\\u0438\\u0444\\u0440\\u0430\\u0445","text":""}}}', 4, 1, 1, '2017-09-21 07:57:35', '2017-09-27 14:12:42', NULL),
(2, 'Преимущества', 2, '{"widget":{"fields":{"blocks":[{"icon":"fa-suitcase","title":"\\u0411\\u043e\\u043b\\u044c\\u0448\\u043e\\u0439 \\u043e\\u043f\\u044b\\u0442","text":""},{"icon":"fa-wifi","title":"\\u041e\\u043f\\u0435\\u0440\\u0430\\u0442\\u0438\\u0432\\u043d\\u043e\\u0441\\u0442\\u044c","text":""},{"icon":"fa-github ","title":"Github ","text":""},{"icon":"","title":"","text":""}],"title":"\\u041d\\u0430\\u0448\\u0438 \\u043f\\u0440\\u0435\\u0438\\u043c\\u0443\\u0449\\u0435\\u0441\\u0442\\u0432\\u0430","text":""}}}', 3, 1, 1, '2017-09-21 08:04:06', '2017-09-27 14:12:42', NULL),
(3, 'Слайдер', 3, '', 1, 1, 1, '2017-09-27 14:08:38', '2017-09-27 14:12:42', NULL),
(4, 'Информационный блок', 4, '', 2, 1, 1, '2017-09-27 14:11:06', '2017-09-27 14:12:42', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
