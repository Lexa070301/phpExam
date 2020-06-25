-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 25 2020 г., 15:53
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `exam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `session_id` int NOT NULL,
  `question_type` int NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `session_id`, `question_type`, `question`, `answer`) VALUES
(1, 1, 1, 'Ваше любимое число', NULL),
(2, 1, 2, 'Ваш год рождения', NULL),
(3, 1, 3, 'Ваше Имя', NULL),
(4, 1, 4, 'Напишите немного о себе', NULL),
(5, 1, 5, 'Выберите ваш любимый цвет', 'Зелёный-20,Желтый-10,Красный-55,Синий-70'),
(6, 1, 6, 'Отметьте свои любимые жанры книг', 'Детективы-21,Романы-44,Научная литература-37');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `status`) VALUES
(1, 'enabled'),
(2, 'enabled');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `status`) VALUES
(1, 'admin', '$2y$10$5yvbtMp2cnfvJK8QddtyuOB401dS7fa4Z64sGXvawq6oOK7TC1dSq', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int NOT NULL,
  `ip` varchar(15) NOT NULL,
  `datetime` datetime NOT NULL,
  `session_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer` varchar(255) NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_answers`
--

INSERT INTO `user_answers` (`id`, `ip`, `datetime`, `session_id`, `question_id`, `answer`, `points`) VALUES
(9, '127.0.0.1', '2020-06-25 14:45:06', 1, 1, '1337', 0),
(10, '127.0.0.1', '2020-06-25 14:45:06', 1, 2, '2001', 0),
(11, '127.0.0.1', '2020-06-25 14:45:06', 1, 3, 'Алексей', 0),
(12, '127.0.0.1', '2020-06-25 14:45:06', 1, 4, 'Я учусь в Московском Политехе', 0),
(13, '127.0.0.1', '2020-06-25 14:45:06', 1, 5, 'Красный', 55),
(14, '127.0.0.1', '2020-06-25 14:45:06', 1, 6, 'Детективы, Научная литература', 58),
(15, '192.168.1.1', '2020-06-25 15:28:02', 1, 1, '228', 0),
(16, '192.168.1.1', '2020-06-25 15:28:02', 1, 2, '1992', 0),
(17, '192.168.1.1', '2020-06-25 15:28:02', 1, 3, 'Георгий', 0),
(18, '192.168.1.1', '2020-06-25 15:28:02', 1, 4, 'Моя жизнь прошла в уныние и скуке', 0),
(19, '192.168.1.1', '2020-06-25 15:28:02', 1, 5, 'Зелёный', 20),
(20, '192.168.1.1', '2020-06-25 15:28:02', 1, 6, 'Романы', 44);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
