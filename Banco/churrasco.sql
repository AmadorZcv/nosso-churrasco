-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema nosso_churrasco
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema nosso_churrasco
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `nosso_churrasco`;
CREATE SCHEMA IF NOT EXISTS `nosso_churrasco` DEFAULT CHARACTER SET utf8 ;
USE `nosso_churrasco` ;

-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_login` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  `user_cpf` VARCHAR(14) NOT NULL,
  `is_inative` BIT NOT NULL,
  `is_bloqueado` BIT NOT NULL,
  `creditos` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = ujis;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`churrasco`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`churrasco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `churras_name` VARCHAR(50) NOT NULL,
  `churras_datetime` DATETIME NOT NULL,
  `churras_ds_adress` VARCHAR(255) NOT NULL,
  `churras_image` BLOB NOT NULL,
  `user_founder_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_churrasco_user1_idx` (`user_founder_id` ASC),
  CONSTRAINT `fk_churrasco_user1`
    FOREIGN KEY (`user_founder_id`)
    REFERENCES `nosso_churrasco`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`classificacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`classificacao`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`classificacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `classificacao_ds` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`tipo_pagamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`tipo_pagamento`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`tipo_pagamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`compra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`compra`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`compra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `is_finalizada` BIT NULL DEFAULT NULL,
  `end_entrega` VARCHAR(45) NULL DEFAULT NULL,
  `data_finalizada` DATETIME NULL DEFAULT NULL,
  `churrasco_id` INT NOT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  `tipo_pagamento_id` INT NOT NULL,
  PRIMARY KEY (`id`, `churrasco_id`, `tipo_pagamento_id`),
  INDEX `fk_compra_churrasco1_idx` (`churrasco_id` ASC),
  INDEX `fk_compra_tipo_pagamento1_idx` (`tipo_pagamento_id` ASC),
  CONSTRAINT `fk_compra_churrasco1`
    FOREIGN KEY (`churrasco_id`)
    REFERENCES `nosso_churrasco`.`churrasco` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_compra_tipo_pagamento1`
    FOREIGN KEY (`tipo_pagamento_id`)
    REFERENCES `nosso_churrasco`.`tipo_pagamento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`parceiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`compra`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`parceiros` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
DROP TABLE IF EXISTS `nosso_churrasco`.`compra`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`produtos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `parceiros_id` INT NOT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_produtos_parceiros1_idx` (`parceiros_id` ASC),
  CONSTRAINT `fk_produtos_parceiros1`
    FOREIGN KEY (`parceiros_id`)
    REFERENCES `nosso_churrasco`.`parceiros` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`compra_has_produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`compra_has_produtos`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`compra_has_produtos` (
  `compras_id` INT NOT NULL,
  `produtos_id` INT NOT NULL,
  `qtd` INT NULL DEFAULT NULL,
  `preco` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`compras_id`, `produtos_id`),
  INDEX `fk_compras_has_produtos_produtos1_idx` (`produtos_id` ASC),
  INDEX `fk_compras_has_produtos_compras1_idx` (`compras_id` ASC),
  CONSTRAINT `fk_compras_has_produtos_compras1`
    FOREIGN KEY (`compras_id`)
    REFERENCES `nosso_churrasco`.`compra` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_compras_has_produtos_produtos1`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `nosso_churrasco`.`produtos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`dia_semana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`dia_semana`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`dia_semana` (
  `id` INT NOT NULL,
  `dia_ds` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`dia_semana_has_parceiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`dia_semana_has_parceiros` ;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`dia_semana_has_parceiros` (
  `parceiros_id` INT NOT NULL,
  `dia_semana_inicio_id` INT NOT NULL,
  `dia_semana_final_id` INT NOT NULL,
  `abertura` TIME NOT NULL,
  `fechamento` TIME NOT NULL,
  INDEX `fk_dia_semana_has_parceiros_parceiros1_idx` (`parceiros_id` ASC),
  INDEX `fk_dia_semana_has_parceiros_dia_semana1_idx` (`dia_semana_inicio_id` ASC),
  INDEX `fk_dia_semana_has_parceiros_dia_semana2_idx` (`dia_semana_final_id` ASC),
  CONSTRAINT `fk_dia_semana_has_parceiros_dia_semana1`
    FOREIGN KEY (`dia_semana_inicio_id`)
    REFERENCES `mydb`.`dia_semana` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_dia_semana_has_parceiros_dia_semana2`
    FOREIGN KEY (`dia_semana_final_id`)
    REFERENCES `mydb`.`dia_semana` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_dia_semana_has_parceiros_parceiros1`
    FOREIGN KEY (`parceiros_id`)
    REFERENCES `nosso_churrasco`.`parceiros` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`user_has_churrasco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`user_has_churrasco`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`user_has_churrasco` (
  `user_id` INT NOT NULL,
  `churrasco_id` INT NOT NULL,
  `is_admin` BIT NOT NULL,
  PRIMARY KEY (`user_id`, `churrasco_id`),
  INDEX `fk_user_has_churrasco_churrasco1_idx` (`churrasco_id` ASC),
  INDEX `fk_user_has_churrasco_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_churrasco_churrasco1`
    FOREIGN KEY (`churrasco_id`)
    REFERENCES `nosso_churrasco`.`churrasco` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_churrasco_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `nosso_churrasco`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = ujis;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`notas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`notas`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`notas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_has_churrasco_user_id` INT NOT NULL,
  `user_has_churrasco_churrasco_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_notas_user_has_churrasco1_idx` (`user_has_churrasco_user_id` ASC, `user_has_churrasco_churrasco_id` ASC),
  CONSTRAINT `fk_notas_user_has_churrasco1`
    FOREIGN KEY (`user_has_churrasco_user_id` , `user_has_churrasco_churrasco_id`)
    REFERENCES `nosso_churrasco`.`user_has_churrasco` (`user_id` , `churrasco_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nosso_churrasco`.`parceiros_has_classificacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nosso_churrasco`.`parceiros_has_classificacao`;
CREATE TABLE IF NOT EXISTS `nosso_churrasco`.`parceiros_has_classificacao` (
  `parceiros_id` INT NOT NULL,
  `classificacao_id` INT NOT NULL,
  PRIMARY KEY (`parceiros_id`, `classificacao_id`),
  INDEX `fk_parceiros_has_classificacao_classificacao1_idx` (`classificacao_id` ASC),
  INDEX `fk_parceiros_has_classificacao_parceiros1_idx` (`parceiros_id` ASC),
  CONSTRAINT `fk_parceiros_has_classificacao_classificacao1`
    FOREIGN KEY (`classificacao_id`)
    REFERENCES `mydb`.`classificacao` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_parceiros_has_classificacao_parceiros1`
    FOREIGN KEY (`parceiros_id`)
    REFERENCES `nosso_churrasco`.`parceiros` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
