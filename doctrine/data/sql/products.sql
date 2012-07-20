CREATE TABLE `product` (
  `id` INT  NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  NOT NULL,
  `priceOriginal` INT NOT NULL,
  `price` INT NOT NULL,
  `initialPrice` INT NOT NULL,
  `leftInStock` INT NOT NULL,
  `description` text  NOT NULL,
  `dateSalesStart` INT  NOT NULL,
  `dateSalesEnd` INT  NOT NULL,
  `imageFile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;
