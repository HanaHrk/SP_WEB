-- MySQL Script generated by MySQL Workbench
-- Tue Dec 29 11:46:07 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `uzivatel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uzivatel` (
  `iduzivatel` BIGINT NOT NULL,
  `jmeno` VARCHAR(45) NOT NULL,
  `prijmeni` VARCHAR(45) NOT NULL,
  `postaveni` INT NOT NULL,
  `prihl_jmeno` VARCHAR(45) NOT NULL,
  `heslo` VARCHAR(45) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`iduzivatel`),
  UNIQUE INDEX `prihl_jmeno_UNIQUE` (`prihl_jmeno` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clanek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clanek` (
  `idclanek` BIGINT NOT NULL,
  `nazev` VARCHAR(45) NOT NULL,
  `cas_pridani` DATETIME NOT NULL,
  `komentar` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idclanek`),
  UNIQUE INDEX `cas_pridani_UNIQUE` (`cas_pridani` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recenze`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recenze` (
  `idrecenze` BIGINT NOT NULL,
  `komentář` VARCHAR(100) NULL,
  `téma` INT NULL,
  `korektnost` INT NULL,
  `obsah` INT NULL,
  `uzivatel_iduzivatel` BIGINT NOT NULL,
  `clanek_idclanek` BIGINT NOT NULL,
  PRIMARY KEY (`idrecenze`, `uzivatel_iduzivatel`, `clanek_idclanek`),
  INDEX `fk_recenze_uzivatel_idx` (`uzivatel_iduzivatel` ASC),
  INDEX `fk_recenze_clanek1_idx` (`clanek_idclanek` ASC),
  CONSTRAINT `fk_recenze_uzivatel`
    FOREIGN KEY (`uzivatel_iduzivatel`)
    REFERENCES `uzivatel` (`iduzivatel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recenze_clanek1`
    FOREIGN KEY (`clanek_idclanek`)
    REFERENCES `clanek` (`idclanek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uzivatel_napsal_clanek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uzivatel_napsal_clanek` (
  `uzivatel_iduzivatel` BIGINT NOT NULL,
  `clanek_idclanek` BIGINT NOT NULL,
  PRIMARY KEY (`uzivatel_iduzivatel`, `clanek_idclanek`),
  INDEX `fk_uzivatel_has_clanek_clanek1_idx` (`clanek_idclanek` ASC),
  INDEX `fk_uzivatel_has_clanek_uzivatel1_idx` (`uzivatel_iduzivatel` ASC),
  CONSTRAINT `fk_uzivatel_has_clanek_uzivatel1`
    FOREIGN KEY (`uzivatel_iduzivatel`)
    REFERENCES `uzivatel` (`iduzivatel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uzivatel_has_clanek_clanek1`
    FOREIGN KEY (`clanek_idclanek`)
    REFERENCES `clanek` (`idclanek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;