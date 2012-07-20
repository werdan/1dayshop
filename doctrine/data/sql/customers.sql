CREATE TABLE  `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter` int(1) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = MyISAM
  CHARACTER SET utf8 COLLATE utf8_general_ci;
