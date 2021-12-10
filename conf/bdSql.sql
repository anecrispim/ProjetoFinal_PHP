-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sistema_emprestimo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistema_emprestimo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistema_emprestimo` DEFAULT CHARACTER SET utf8 ;
USE `sistema_emprestimo` ;

-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`TIPO_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`TIPO_USUARIO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `TIPO` CHAR(2) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`USUARIO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `USUARIO` VARCHAR(45) NOT NULL,
  `SENHA` VARCHAR(45) NOT NULL,
  `ATIVADO` TINYINT NOT NULL,
  `TIP_USU_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
    FOREIGN KEY (`TIP_USU_ID`)
    REFERENCES `sistema_emprestimo`.`TIPO_USUARIO` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`LIVRO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`LIVRO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `TITULO` VARCHAR(45) NOT NULL,
  `AUTOR` VARCHAR(45) NOT NULL,
  `ISBN` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`EXEMPLAR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`EXEMPLAR` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NUMERO` INT NOT NULL,
  `DISPONIVEL` TINYINT NOT NULL,
  `LIV_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
    FOREIGN KEY (`LIV_ID`)
    REFERENCES `sistema_emprestimo`.`LIVRO` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`EMPRESTIMO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`EMPRESTIMO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `DATAINICIO` DATE NOT NULL,
  `DATAFIM` DATE NOT NULL,
  `EXE_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
    FOREIGN KEY (`EXE_ID`)
    REFERENCES `sistema_emprestimo`.`EXEMPLAR` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistema_emprestimo`.`USUARIO_EMPRESTIMO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_emprestimo`.`USUARIO_EMPRESTIMO` (
  `USU_ID` INT NOT NULL,
  `EMP_ID` INT NOT NULL,
  PRIMARY KEY (`USU_ID`, `EMP_ID`),
    FOREIGN KEY (`USU_ID`)
    REFERENCES `sistema_emprestimo`.`USUARIO` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`EMP_ID`)
    REFERENCES `sistema_emprestimo`.`EMPRESTIMO` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
