-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema demo_cart
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema demo_cart
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `demo_cart` DEFAULT CHARACTER SET utf8 ;
USE `demo_cart` ;

-- -----------------------------------------------------
-- Table `demo_cart`.`order_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `demo_cart`.`order_product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `creation_date` DATETIME NOT NULL,
  `last_update` DATETIME NOT NULL,
  `sum_product` INT(11) NOT NULL DEFAULT '0',
  `sum_price` FLOAT NOT NULL DEFAULT '0',
  `send` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 117
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `demo_cart`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `demo_cart`.`product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL,
  `description` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `price` FLOAT NOT NULL DEFAULT '0',
  `img` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `demo_cart`.`product_has_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `demo_cart`.`product_has_order` (
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `sum_product` INT(11) NULL DEFAULT NULL,
  `sum_price` FLOAT NULL DEFAULT NULL,
  INDEX `fk_product_has_order_order_idx` (`order_id` ASC),
  INDEX `fk_product_has_order_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_product_has_order_order`
    FOREIGN KEY (`order_id`)
    REFERENCES `demo_cart`.`order_product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_order_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `demo_cart`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
