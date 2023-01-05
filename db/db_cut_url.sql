-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 05 2023 г., 16:59
-- Версия сервера: 5.7.33
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_cut_url`
--
CREATE DATABASE IF NOT EXISTS `db_cut_url` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_cut_url`;

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `long_link` varchar(250) DEFAULT NULL,
  `short_link` varchar(20) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `user_id`, `long_link`, `short_link`, `views`) VALUES
(1, 5, 'https://yandex.ru', 'ya', 17),
(2, 5, 'https://google.com', 'goo', 8),
(3, 9, 'https://heroku.com', 'he', 0),
(4, 9, 'https://miro.com', 'mi', 0),
(5, 5, 'https://fb.com', 'bla', 0),
(8, 5, 'gjkhjjj', 'tyt', 0),
(10, 5, 'gjkhjjj', 'gjmn', 0),
(14, 7, 'editlink', '0ge3y5', 1),
(15, 7, 'http://vk.com', 'splmj7', 1),
(16, 7, 'aaa', '9h2apz', 0),
(17, 10, 'http://blabla.com', 'pmylj4', 1),
(18, 10, 'http://blabla-1.com', 'chzvmx', 0),
(19, 10, 'http://blabla-very-much.com', '6ncrbe', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(5, 'asd', '$2y$10$5V5ZAfdFv3khoOLWWWjhZOqpa3fHz974MtrUVu0VYWQGljT4SlWnm'),
(6, 'rar', '$2y$10$wp/YzP7x6TwomSWywaASOOT9oQDPDWqk7xtTmspSO08J9L2tr//US'),
(7, 'admin', '$2y$10$.zY4ddr2f5Esl80pJARc0./sdVuK8iOYHsIItrjY7Ejl23SROeBIO'),
(8, 'sas', '$2y$10$fuuEDB5c7Prlrr.SOIY6zeVcGgbNxf4vIkDX/4mHGogtjoZHhWxAS'),
(9, 'aa', '$2y$10$1sELZmkevjNRkWXvQUA9MeDZPfmT7NEDqokZkcLw8KwbCUuH11ktu'),
(10, 'qwerty', '$2y$10$kMhNFARHQ2anITS0fgZ8bu8hcW7q2TkMYlpKC0HIzNx5pr8NfXsDu');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_link` (`short_link`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
