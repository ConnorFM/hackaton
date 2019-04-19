/* NE PAS COPIER CETTE LIGNE SI C'EST LA PREMIERE FOIS QUE VOUS INITIALISER VOTRE BDD */
DROP DATABASE `hackaton`;

CREATE DATABASE `hackaton` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE hackaton;

CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `character_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score_user_idx` (`user_id`),
  KEY `fk_score_character_idx` (`character_id`),
  CONSTRAINT `fk_score_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gold` INT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `user` (username, password)
VALUES  ("Julien", "Julien"),
        ("Nathalie", "Nathalie"),
        ("Fouc", "Fouc"),
        ("Quentin", "Quentin");

INSERT INTO `character`(API_id)
VALUES ("5cac51240d488f0da6151c5e"),
       ("5cac51240d488f0da6151c4c"),
       ("5cac51240d488f0da6151c3d"),
       ("5cac51240d488f0da6151c34");

INSERT INTO `userCharacter` (user_id, character_id)
VALUES (1, 1),
       (1, 3),
       (2, 2),
       (2, 4),
       (3, 3),
       (4, 4);

INSERT INTO score (score, user_id, character_id)
VALUES (2580, 1, 1 ),
       (3129, 2, 2 ),
       (2360, 3, 3 ),
       (1555, 4, 4 );

INSERT INTO `inventory` (egg_Api, user_id)
VALUES ("5cac51240d488f0da6151bd6" , 1),
       ("5cac51240d488f0da6151bd1" , 1),
       ("5cac51240d488f0da6151bce" , 1),
       ("5cac51240d488f0da6151c06" , 2),
       ("5cac51240d488f0da6151bef" , 2),
       ("5cac51240d488f0da6151c12" , 3),
       ("5cac51240d488f0da6151bf8" , 4),
       ("5cac51240d488f0da6151c22" , 4),
       ("5cac51240d488f0da6151bf7" , 3),
       ("5cac51240d488f0da6151c1d" , 4);