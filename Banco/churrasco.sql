-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema default_schema
-- -----------------------------------------------------
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
-- Table `nosso_churrasco`.`churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`churrasco` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`churrasco` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `churras_name` VARCHAR(45) NOT NULL,
  `churras_datetime` DATETIME NOT NULL,
  `churras_ds_adress` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`tipo_pagamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`tipo_pagamento` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`tipo_pagamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`compra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`compra` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`compra` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `is_finalizada` VARCHAR(45) NULL DEFAULT NULL,
  `end_entrega` VARCHAR(45) NULL DEFAULT NULL,
  `data_finalizada` DATETIME NULL DEFAULT NULL,
  `churrasco_id` INT(11) NOT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  `tipo_pagamento_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `churrasco_id`, `tipo_pagamento_id`),
  INDEX `fk_compra_churrasco1_idx` (`churrasco_id` ASC),
  INDEX `fk_compra_tipo_pagamento1_idx` (`tipo_pagamento_id` ASC),
  CONSTRAINT `fk_compra_churrasco1`
    FOREIGN KEY (`churrasco_id`)
    REFERENCES `nosso_churrasco`.`churrasco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_tipo_pagamento1`
    FOREIGN KEY (`tipo_pagamento_id`)
    REFERENCES `nosso_churrasco`.`tipo_pagamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`parceiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`parceiros` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`parceiros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cnpj` VARCHAR(14) NOT NULL,
  `parc_login` VARCHAR(45) NOT NULL,
  `parc_password` VARCHAR(255) NOT NULL,
  `parc_fantasy_name` VARCHAR(45) NOT NULL,
  `parc_email` VARCHAR(45) NOT NULL,
  `parc_telefone1` VARCHAR(11) NOT NULL,
  `parc_telefone2` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`produtos` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `parceiros_id` INT(11) NOT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  `produtoscol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_produtos_parceiros1_idx` (`parceiros_id` ASC),
  CONSTRAINT `fk_produtos_parceiros1`
    FOREIGN KEY (`parceiros_id`)
    REFERENCES `nosso_churrasco`.`parceiros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`compra_has_produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`compra_has_produtos` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`compra_has_produtos` (
  `compras_id` INT(11) NOT NULL,
  `produtos_id` INT(11) NOT NULL,
  `qtd` INT(11) NULL DEFAULT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`compras_id`, `produtos_id`),
  INDEX `fk_compras_has_produtos_produtos1_idx` (`produtos_id` ASC),
  INDEX `fk_compras_has_produtos_compras1_idx` (`compras_id` ASC),
  CONSTRAINT `fk_compras_has_produtos_compras1`
    FOREIGN KEY (`compras_id`)
    REFERENCES `nosso_churrasco`.`compra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compras_has_produtos_produtos1`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `nosso_churrasco`.`produtos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_login` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  `user_cpf` VARCHAR(45) NOT NULL,
  `is_inative` BIT(1) NOT NULL,
  `is_bloqueado` BIT(1) NOT NULL,
  `creditos` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = ujis;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user_has_churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user_has_churrasco` ;

CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user_has_churrasco` (
  `user_id` INT(11) NOT NULL,
  `churrasco_id` INT(11) NOT NULL,
  `is_admin` TINYINT(1) NOT NULL,
  PRIMARY KEY (`user_id`, `churrasco_id`),
  INDEX `fk_user_has_churrasco_churrasco1_idx` (`churrasco_id` ASC),
  INDEX `fk_user_has_churrasco_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_churrasco_churrasco1`
    FOREIGN KEY (`churrasco_id`)
    REFERENCES `nosso_churrasco`.`churrasco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_churrasco_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `nosso_churrasco`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = ujis;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
