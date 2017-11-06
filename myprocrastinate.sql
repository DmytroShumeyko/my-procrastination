-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 21 2017 г., 11:06
-- Версия сервера: 10.0.30-MariaDB-30
-- Версия PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myprocrastinate`
--

-- --------------------------------------------------------

--
-- Структура таблицы `deals`
--

CREATE TABLE `deals` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_dates_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `placed` datetime NOT NULL,
  `complete` enum('0','1') NOT NULL DEFAULT '0',
  `why_not` text,
  `result` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `deals`
--

INSERT INTO `deals` (`id`, `user_dates_id`, `name`, `description`, `user_id`, `deadline`, `placed`, `complete`, `why_not`, `result`) VALUES
(1, 1, 'Wake up', 'Time', 2, '2017-06-21 07:53:16', '2017-06-21 10:46:31', '1', NULL, NULL),
(2, 1, 'Go Sleep', 'Time', 2, NULL, '2017-06-21 10:47:08', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id_task` int(11) UNSIGNED NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` text,
  `user_id` int(11) UNSIGNED NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `placed` datetime DEFAULT NULL,
  `complete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id_task`, `task_name`, `description`, `user_id`, `deadline`, `placed`, `complete`) VALUES
(1, 'Лопатка на перфоратор', 'Купить широкую лопатку на перфоратор', 2, NULL, '2017-06-21 10:48:06', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1','2','') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `role`) VALUES
(1, 'owner', '0592ad9d7c55a3e2997138ab54f75905', '0'),
(2, 'dima', '0eb56ababcc403f0fe3e6f09fc1d7708', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `user_dates`
--

CREATE TABLE `user_dates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_date` date DEFAULT NULL,
  `score` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_dates`
--

INSERT INTO `user_dates` (`id`, `user_id`, `user_date`, `score`) VALUES
(1, 2, '2017-06-21', NULL),
(2, 1, '2017-06-21', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `user_dates`
--
ALTER TABLE `user_dates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user_dates`
--
ALTER TABLE `user_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
