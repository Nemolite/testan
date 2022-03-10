CREATE DATABASE IF NOT EXISTS `ct` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ct`;

CREATE TABLE `comments` (
  `postId` int NOT NULL,
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `posts` (
  `userId` int NOT NULL,
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

