SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `saude_tec` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `saude_tec` ;

-- -----------------------------------------------------
-- Table `saude_tec`.`login`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `saude_tec`.`login` (
  `idlogin` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(20) NOT NULL ,
  `senha` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`idlogin`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saude_tec`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `saude_tec`.`usuario` (
  `nome` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(100) NULL ,
  `peso` DOUBLE NULL ,
  `caloriasDiarias` INT NULL ,
  `login_idlogin` INT NOT NULL ,
  PRIMARY KEY (`login_idlogin`) ,
  CONSTRAINT `fk_usuario_login`
    FOREIGN KEY (`login_idlogin` )
    REFERENCES `saude_tec`.`login` (`idlogin` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saude_tec`.`alimento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `saude_tec`.`alimento` (
  `idalimento` INT NOT NULL AUTO_INCREMENT ,
  `qrcode` VARCHAR(200) NULL ,
  `nome` VARCHAR(45) NULL ,
  `calorias` INT NULL ,
  `foto` LONGBLOB NULL ,
  PRIMARY KEY (`idalimento`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saude_tec`.`usuario_has_alimento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `saude_tec`.`usuario_has_alimento` (
  `usuario_login_idlogin` INT NOT NULL ,
  `alimento_idalimento` INT NOT NULL ,
  `data` DATETIME NULL ,
  PRIMARY KEY (`usuario_login_idlogin`, `alimento_idalimento`) ,
  INDEX `fk_usuario_has_alimento_alimento1` (`alimento_idalimento` ASC) ,
  INDEX `fk_usuario_has_alimento_usuario1` (`usuario_login_idlogin` ASC) ,
  CONSTRAINT `fk_usuario_has_alimento_usuario1`
    FOREIGN KEY (`usuario_login_idlogin` )
    REFERENCES `saude_tec`.`usuario` (`login_idlogin` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_alimento_alimento1`
    FOREIGN KEY (`alimento_idalimento` )
    REFERENCES `saude_tec`.`alimento` (`idalimento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
