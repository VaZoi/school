-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema PDOopdr3
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PDOopdr3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PDOopdr3` DEFAULT CHARACTER SET utf8 ;
USE `PDOopdr3` ;

-- -----------------------------------------------------
-- Table `PDOopdr3`.`producten`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PDOopdr3`.`producten` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `omschrijving` VARCHAR(255) NULL,
  `prijs_per_stuk` DECIMAL(6,2) NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PDOopdr3`.`klanten`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PDOopdr3`.`klanten` (
  `klant_id` INT NOT NULL AUTO_INCREMENT,
  `klantnaam` VARCHAR(255) NULL,
  `telefoonnummer` INT NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`klant_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PDOopdr3`.`reservering`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PDOopdr3`.`reservering` (
  `reservering_id` INT NOT NULL AUTO_INCREMENT,
  `klant_id` INT,
  `datum_tijd` DATETIME NULL,
  PRIMARY KEY (`reservering_id`),
    FOREIGN KEY (`klant_id`)
    REFERENCES `PDOopdr3`.`klanten` (`klant_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PDOopdr3`.`Plaats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PDOopdr3`.`Plaats` (
  `Tafel_id` INT NOT NULL AUTO_INCREMENT,
  `afdeling` VARCHAR(255) NULL,
  PRIMARY KEY (`Tafel_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PDOopdr3`.`rekening`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PDOopdr3`.`rekening` (
  `bonnummer` INT NOT NULL AUTO_INCREMENT,
  `datum_tijd` DATETIME NOT NULL,
  `product_id` INT NULL,
  `tafel_id` INT NULL,
  `totaal_prijs_product` DECIMAL(6,2) NULL,
  `totaal_korting` DECIMAL(6,2) NULL,
  `totaal_rekening` DECIMAL(6,2) NULL,
  `btw` DECIMAL(6,2) NULL,
  `inclubtw` DECIMAL(6,2) NULL,
  `exclubtw` DECIMAL(6,2) NULL,
  `totaal_btw` DECIMAL(6,2) NULL,
  `aantal_producten_van_product` INT NULL,
  PRIMARY KEY (`bonnummer`),
  CONSTRAINT `tafel_id`
    FOREIGN KEY (`tafel_id`)
    REFERENCES `PDOopdr3`.`Plaats` (`Tafel_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`product_id`)
    REFERENCES `PDOopdr3`.`producten` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
