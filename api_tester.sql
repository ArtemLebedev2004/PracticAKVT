-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 22 2022 г., 06:51
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api_tester`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`) VALUES
(62, 'nkl', 'gfgfj'),
(63, 'nkl', 'gfgfj'),
(64, 'qwgweg', 'wegweg'),
(65, 'wgwg', 'wgwegwgew'),
(66, 'ewfwwrgwreg', 'wegwg'),
(67, 'ewgeg', 'wegerg'),
(68, 'ewgegwwt4', 'wegergwtw43t'),
(69, 'wegweg', 'wegw'),
(70, 'fwewe', 'wegweg'),
(71, 'weewg', 'wegwe'),
(72, 'fwge', 'wegwgw11111'),
(73, 'fwge', 'wegwgw111112222'),
(74, 'feww', '1112324'),
(75, 'feww2q33', '11123243253'),
(76, 'цуцпур', 'уруру5р'),
(77, 'ererh', 'erheh'),
(78, 'ewfwe', 'wegwegewgeer35345'),
(79, 'ewfwe', 'wegwegewgeer353erherh45'),
(80, 'wetwtwy', 'wegwegewgeer353erherh45'),
(81, 'wer', 'erer'),
(82, 'serset', 'retery');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
