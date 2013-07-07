-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: openserver:3306
-- Время создания: Июл 08 2013 г., 00:33
-- Версия сервера: 5.5.24-log
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `twitts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tag2user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=976 ;

-- --------------------------------------------------------

--
-- Структура таблицы `twit`
--

CREATE TABLE IF NOT EXISTS `twit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT 'создан когда',
  `text` text NOT NULL COMMENT 'текст твита',
  `user` int(11) NOT NULL COMMENT 'ссылка на юзера',
  `out_id` bigint(20) NOT NULL COMMENT 'ссылка на юзера',
  `retweet_count` int(11) NOT NULL COMMENT 'количество ретвитов',
  `favorite_count` int(11) NOT NULL COMMENT 'избранные твиты?',
  PRIMARY KEY (`id`),
  KEY `FK_twit2user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='структура твиттов' AUTO_INCREMENT=2085 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `out_id` bigint(20) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `profile_image_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='структура юзера' AUTO_INCREMENT=20 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FK_tag2user` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `twit`
--
ALTER TABLE `twit`
  ADD CONSTRAINT `FK_twit2user` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_twit_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
