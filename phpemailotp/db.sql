-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isEmailConfirmed` tinyint(4) NOT NULL,
  `token` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `isEmailConfirmed`, `token`) VALUES
(2,	'Senaid Bacinovic',	'senaidbacinovic@gmail.com',	'$2y$10$0qzNwkoOhAeTFtzQPUgoCuzt79QF1sS4w1kbxhzqm65gumdM8MBHe',	1,	'');

-- 2017-10-07 10:15:24
