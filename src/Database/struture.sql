CREATE DATABASE `memory` /*!40100 DEFAULT CHARACTER SET latin1 */;

CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `character_id` int(11) DEFAULT NULL,
  `party_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score_user_idx` (`user_id`),
  KEY `fk_score_party_idx` (`party_id`),
  KEY `fk_score_character_idx` (`character_id`),
  CONSTRAINT `fk_score_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `memory`.`party` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number_cards` INT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `egg_Api` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventory_user_idx` (`user_id`),
  CONSTRAINT `fk_inventory_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `API_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `userCharacter` (
  `user_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`character_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

