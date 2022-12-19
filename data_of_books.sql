-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 19 2022 г., 08:45
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
-- База данных: `data_of_books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id_author` int NOT NULL,
  `name_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_author`, `name_author`) VALUES
(1, 'Джоан Роулинг'),
(2, 'Артур Конан Дойл'),
(16, 'Эрих Мария Ремарк'),
(17, 'reg'),
(18, 'erher'),
(19, 'erher'),
(20, 'ryeery'),
(21, 'rdhrt'),
(22, 'hrr'),
(23, 'hrr'),
(24, 'htyj'),
(25, 'sdgsdg'),
(26, 'уцукпукр'),
(27, 'ewrew'),
(28, 'кенекн'),
(29, 'sdfdsfsdfsd'),
(30, 'ergreg'),
(31, 'ergher'),
(32, 'ertertert'),
(33, 'керкео'),
(34, 'керкео'),
(35, 'аывааа'),
(36, 'asdas'),
(37, 'fghfg'),
(38, 'fsdf'),
(39, 'wefw'),
(40, 'sdgsdg'),
(41, 'sdgsdg'),
(42, 'kl;kl;'),
(43, 'wefwef'),
(44, '23423'),
(45, '23423'),
(46, 'Джоан Роулинг'),
(47, 'Эрих Мария Ремарк');

-- --------------------------------------------------------

--
-- Структура таблицы `authors_and_books`
--

CREATE TABLE `authors_and_books` (
  `id` int NOT NULL,
  `id_author` int NOT NULL,
  `id_book` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors_and_books`
--

INSERT INTO `authors_and_books` (`id`, `id_author`, `id_book`) VALUES
(16, 1, 30),
(18, 1, 32),
(20, 1, 34),
(36, 1, 33),
(38, 16, 43),
(39, 2, 42),
(71, 2, 66),
(72, 46, 66),
(73, 47, 66);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id_book` int NOT NULL,
  `name_book` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_of_release` int NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `name_book`, `description`, `year_of_release`, `genre`, `cover`) VALUES
(30, 'Гарри Поттер и Тайная комната', 'Алохомора! Открывайте дверь в мир волшебства вместе с Джоан Роулинг! Гарри Поттер – сирота с необычным шрамом на лбу. 11 лет он жил в доме дяди и тёти, пока не узнал, что он – волшебник! Теперь Гарри вместе с новыми друзьями предстоит освоить магию и полёты на метле, найти таинственные крестражи и вступить в борьбу с самим Волан-де-Мортом.', 2014, 'Фэнтези', '637d827bf3173.jpg'),
(32, 'Гарри Поттер и Кубок Огня', 'Алохомора! Открывайте дверь в мир волшебства вместе с Джоан Роулинг! Гарри Поттер – сирота с необычным шрамом на лбу. 11 лет он жил в доме дяди и тёти, пока не узнал, что он – волшебник! Теперь Гарри вместе с новыми друзьями предстоит освоить магию и полёты на метле, найти таинственные крестражи и вступить в борьбу с самим Волан-де-Мортом.', 2014, 'Фэнтези', '637d82cfa15d3.jpg'),
(33, 'Гарри Поттер и Орден Феникса', 'Алохомора! Открывайте дверь в мир волшебства вместе с Джоан Роулинг! Гарри Поттер – сирота с необычным шрамом на лбу. 11 лет он жил в доме дяди и тёти, пока не узнал, что он – волшебник! Теперь Гарри вместе с новыми друзьями предстоит освоить магию и полёты на метле, найти таинственные крестражи и вступить в борьбу с самим Волан-де-Мортом.', 2014, 'Фэнтези', '637ef02f425ca.jpeg'),
(34, 'Гарри Поттер и Принц-полукровка', 'Алохомора! Открывайте дверь в мир волшебства вместе с Джоан Роулинг! Гарри Поттер – сирота с необычным шрамом на лбу. 11 лет он жил в доме дяди и тёти, пока не узнал, что он – волшебник! Теперь Гарри вместе с новыми друзьями предстоит освоить магию и полёты на метле, найти таинственные крестражи и вступить в борьбу с самим Волан-де-Мортом.', 2014, 'Фэнтези', '637d8353747ca.jpg'),
(42, 'Приключения Шерлока Холмса', 'Неутомимый Шерлок Холмс и его легко увлекающийся друг доктор Ватсон дороги сердцу читателей всего мира. В первый том коллекции вошел роман \"Этюд в багровых тонах\" и цикл рассказов \"Приключения Шерлока Холмса\"', 2016, 'Детектив', '637efe44080d6.png'),
(43, 'Триумфальная арка', 'Роман немецкого писателя Эриха Марии Ремарка, впервые опубликованный в США в 1945 году; немецкое издание вышло в 1946. Вошёл в список бестселлеров по версии Publishers Weekly за 1946 год в США. ', 2016, 'Роман', '637efeb2c6755.jpg'),
(66, 'asfsdfsdgfdsgdsgds', 'sdgsd', 343, 'segrdg', '639fa0345d585.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `login`, `email`, `avatar`, `password`) VALUES
(65, 'wfwef', 'ewfef', 'wefwef', '6385207406630.jpg', '12'),
(66, 'wefwef', 'wefwe', 'wefewf', '63852085027de.jpg', '12'),
(67, 'wfwef3', 'erger', 'erhrh', '638522e65404c.jpg', '123'),
(68, 'wfwefwfwef', 'ergers', 'wef', '63853013bbac7.jpg', '12'),
(69, 'we', 'wew', 'wew', '6388cc523d6d8.jpg', 'we'),
(70, 'fsdgdfs', 'dsfhdshr', 'rsheshr', '6388ee6dad2e6.jpg', '123'),
(71, 'fsdgdfsr', 'dsfhdshrr', 'rsheshrr', '6388ee9f6d74b.jpg', '123r'),
(72, 'ffrgwferg egergerg  ergergerge', 'login', 'mweklfmew', '638b5b90c219d.png', '123'),
(73, 'Лебедев Артём Владимирович', 'Artem_Cat', 'artem-lebedev-2004@inbox.ru', '638b5cfa51189.png', 'books_prot'),
(74, 'Илья', 'Ilya', 'aesfsegs', '638ba6ef9971f.jpg', '12'),
(75, 'efe', 'fs', 'efeef', '638ba708b1b43.jpg', '12'),
(76, 'wefrew', 'ewtwe', 'twet', '638ba73086165.jpg', '123'),
(77, 'wqdww', 'fdwefewf', 'ewfewg', '638ba7788cb8f.jpg', '12'),
(78, 'sdf', 'sdfsd', 'g', '639967d27deb5.jpg', '123'),
(79, 'кнке', 'екн', 'нен', '639abfc37548a.jpg', '123'),
(80, 'аив', 'пвап', 'вап', '639e251e84686.jpg', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Индексы таблицы `authors_and_books`
--
ALTER TABLE `authors_and_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_book` (`id_book`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `authors_and_books`
--
ALTER TABLE `authors_and_books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authors_and_books`
--
ALTER TABLE `authors_and_books`
  ADD CONSTRAINT `authors_and_books_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authors_and_books_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
