-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema nosso_churrasco
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `nosso_churrasco` ;

-- -----------------------------------------------------
-- Schema nosso_churrasco
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `nosso_churrasco` DEFAULT CHARACTER SET utf8 ;
USE `nosso_churrasco` ;

-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user` (
  `id` INT NOT NULL,
  `user_name` VARCHAR(50) NOT NULL,
  `user_login` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  `user_cpf` VARCHAR(45) NOT NULL,
  `is_inative` BIT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = ujis;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`churrasco` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`churrasco` (
  `id` INT NOT NULL,
  `churras_name` VARCHAR(45) NOT NULL,
  `churras_datetime` DATETIME NOT NULL,
  `churras_ds_adress` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user_has_churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user_has_churrasco` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user_has_churrasco` (
  `user_id` INT NOT NULL,
  `churrasco_id` INT NOT NULL,
  `is_admin` TINYINT(1) NOT NULL,
  PRIMARY KEY (`user_id`, `churrasco_id`),
  INDEX `fk_user_has_churrasco_churrasco1_idx` (`churrasco_id` ASC),
  INDEX `fk_user_has_churrasco_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_churrasco_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `nosso_churrasco`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_churrasco_churrasco1`
    FOREIGN KEY (`churrasco_id`)
    REFERENCES `nosso_churrasco`.`churrasco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = ujis;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`paceiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`paceiros` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`paceiros` (
  `id` INT NOT NULL,
  `cnpj` VARCHAR(14) NOT NULL,
  `parc_login` VARCHAR(45) NOT NULL,
  `parc_password` VARCHAR(45) NOT NULL,
  `parc_fantasy_name` VARCHAR(45) NOT NULL,
  `parc_ds_adress` VARCHAR(45) NOT NULL,
  `parc_email` VARCHAR(45) NOT NULL,
  `parc_cellphone` VARCHAR(45) NULL,
  `parc_country` VARCHAR(3) NULL,
  `parc_city` VARCHAR(20) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
