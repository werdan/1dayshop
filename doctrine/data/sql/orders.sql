CREATE TABLE  `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = MyISAM
  CHARACTER SET utf8 COLLATE utf8_general_ci;
