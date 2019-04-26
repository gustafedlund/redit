# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: redit
# Generation Time: 2019-03-27 11:32:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT '',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`cat_id`, `category`)
VALUES
	(1,'bygdababbel'),
	(2,'plugg'),
	(3,'politik'),
	(4,'raggarbilar'),
	(5,'jippon'),
	(6,'nyheter'),
	(7,'memes'),
	(8,'dagens bild');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `like_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `like_dislike` int(1) NOT NULL DEFAULT '0',
  `reply_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`like_id`, `username`, `post_id`, `like_dislike`, `reply_id`)
VALUES
	(1,'alice',1,1,NULL),
	(2,'alice',NULL,-1,64),
	(3,'gurkan',1,1,NULL),
	(4,'gurkan',2,1,NULL),
	(5,'gurkan',NULL,1,65),
	(6,'gurkan',3,1,NULL),
	(7,'gurkan',4,1,NULL),
	(8,'alice',5,1,NULL),
	(9,'ludde',5,1,NULL),
	(10,'ludde',6,1,NULL);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(50) NOT NULL,
  `post_content` text,
  `post_img` varchar(256) DEFAULT '',
  `post_category` varchar(20) NOT NULL,
  `post_creator` varchar(50) NOT NULL,
  `post_date` timestamp NULL DEFAULT NULL,
  `post_views` int(11) DEFAULT NULL,
  `post_replies` int(11) DEFAULT NULL,
  `post_likes` int(11) DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`post_id`, `post_title`, `post_content`, `post_img`, `post_category`, `post_creator`, `post_date`, `post_views`, `post_replies`, `post_likes`)
VALUES
	(1,'hej alla glada','jag heter alice och det ser ut som att jag är den första som skriver på denna sidan...','post_alice1754259621.jpg','dagens bild','alice','2019-03-12 11:55:07',15,2,2),
	(5,'jag är administratör','jag är en av administratörerna på denna sidan.<br />\r\n<br />\r\nvill du något, kommentera på detta inlägget så ska jag försöka lösa det!<br />\r\n<br />\r\njag kan ta bort stötande inlägg och kommentarer, elaka medlemmar, eller göra bra medlemmar till admins!<br />\r\n<br />\r\nha det bra, och va REDIG','','nyheter','alice','2019-03-12 12:19:04',1,0,2),
	(6,'EPA','igår köpte jag min första EPA. nu jävlar blir det åka av!','','raggarbilar','ludde','2019-03-27 12:27:18',NULL,0,1);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table replies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `replies`;

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `reply_creator` varchar(50) NOT NULL,
  `reply_content` text,
  `reply_date` timestamp NULL DEFAULT NULL,
  `reply_likes` int(11) DEFAULT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `replies` WRITE;
/*!40000 ALTER TABLE `replies` DISABLE KEYS */;

INSERT INTO `replies` (`reply_id`, `post_id`, `reply_creator`, `reply_content`, `reply_date`, `reply_likes`)
VALUES
	(64,1,'alice','jag &auml;r nog den enda h&auml;r... men det &auml;r en kul bild jag har iallafall!','2019-03-12 12:02:41',-1),
	(65,1,'gurkan','jag &auml;r ocks&aring; h&auml;r!','2019-03-12 12:06:23',1);

/*!40000 ALTER TABLE `replies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `avatar` varchar(256) DEFAULT NULL,
  `bio` varchar(1000) DEFAULT '',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `moderator` tinyint(1) NOT NULL DEFAULT '0',
  `post_permission` tinyint(11) NOT NULL DEFAULT '1',
  `member_since` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `avatar`, `bio`, `admin`, `moderator`, `post_permission`, `member_since`)
VALUES
	(20,'alice','$2y$10$MBrG3L1Ro4egtF66c2qNou55esGgaDIINSZXOD3e2UMxPeJWzvbqu','alice@me.com','avatar_alice.jpg','jag heter alice och jag bor i jönköping',1,0,1,'2019-03-12'),
	(21,'gurkan','$2y$10$x9DXxXWUjOEn66HAEsfnX.B58Jvff/ScjlWMnwubf25yeXC.0dmfO','gurkan@gmail.com','avatar_gurkan.jpg','gurkor är ju typ bara vatten. och en kan inte leva utan vatten... så ingen kan leva utan mig',0,0,1,'2019-03-12'),
	(22,'ludde','$2y$10$7kX7Mn3GwlSUF.QPUxsjR.NQYL4gPmLImUc7gLB0kXKF1lBsbhgv6','voff@dog.com','avatar_ludde.jpg','grrrrrrrrrrrrruff!',0,0,1,'2019-03-12');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
