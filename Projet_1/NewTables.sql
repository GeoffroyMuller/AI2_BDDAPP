DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `mail` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `born` datetime DEFAULT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(256) NOT NULL,
  `written_date` datetime NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_mail` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`game_id`) REFERENCES `game`(`id`),
  FOREIGN KEY (`user_mail`) REFERENCES `user`(`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
