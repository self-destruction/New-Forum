-- creating db
DROP USER `admin`@`localhost`;
DROP USER `forum_user`@`localhost`;

DROP DATABASE IF EXISTS `forum`;
CREATE DATABASE IF NOT EXISTS `forum`;
USE `forum`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(60) UNIQUE NOT NULL,
  `email` VARCHAR(256) UNIQUE NOT NULL,
  `hash` CHAR(64) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  `isBlocked` BOOLEAN NOT NULL DEFAULT FALSE,
  `description` TEXT DEFAULT NULL,
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `email`, `login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE UNIQUE INDEX `idx_user_login`
  ON `forum`.`user`(`login`);

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` INT(11) UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `tags` TEXT DEFAULT NULL,
  `status` ENUM('opened', 'closed', 'blocked') NOT NULL DEFAULT 'opened',
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `forum`.`user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` INT(11) UNSIGNED NOT NULL,
  `themeId` INT(11) UNSIGNED NOT NULL,
  `text` TEXT DEFAULT NULL,
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `forum`.`user`(`id`),
  FOREIGN KEY (`themeId`) REFERENCES `forum`.`theme`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `messageId` INT(11) UNSIGNED NOT NULL,
  `path` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`messageId`) REFERENCES `forum`.`message`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE USER `admin`@`localhost` IDENTIFIED BY 'admin';
GRANT SELECT,INSERT,UPDATE,DELETE ON `forum`.* to `admin`@`localhost`;

CREATE USER `forum_user`@`localhost` IDENTIFIED BY 'forum_user';
GRANT SELECT, INSERT ON `forum`.* to `forum_user`@`localhost`;
GRANT UPDATE ON `forum`.`user` to `forum_user`@`localhost`;

# SELECT User,Host FROM mysql.user;
# SHOW GRANTS FOR `forum_user`@`localhost`;