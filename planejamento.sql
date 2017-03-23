SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Aluno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Aluno` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Aluno` (
  `matricula` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`matricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Disciplina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Disciplina` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Disciplina` (
  `codigo` INT NOT NULL,
  `nome` VARCHAR(45) NULL,
  `cargaHoraria` INT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Atividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Atividade` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Atividade` (
  `idAtividade` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `data` DATE NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `valor` DOUBLE NOT NULL,
  `Aluno_matricula` INT NOT NULL,
  `Disciplina_codigo` INT NOT NULL,
  PRIMARY KEY (`idAtividade`, `Aluno_matricula`, `Disciplina_codigo`),
  INDEX `fk_Atividade_Aluno_idx` (`Aluno_matricula` ASC),
  INDEX `fk_Atividade_Disciplina1_idx` (`Disciplina_codigo` ASC),
  CONSTRAINT `fk_Atividade_Aluno`
    FOREIGN KEY (`Aluno_matricula`)
    REFERENCES `mydb`.`Aluno` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atividade_Disciplina1`
    FOREIGN KEY (`Disciplina_codigo`)
    REFERENCES `mydb`.`Disciplina` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Anotacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Anotacao` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Anotacao` (
  `idAnotacao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `texto` VARCHAR(45) NOT NULL,
  `Atividade_idAtividade` INT NOT NULL,
  `Atividade_Aluno_matricula` INT NOT NULL,
  `Atividade_Disciplina_codigo` INT NOT NULL,
  PRIMARY KEY (`idAnotacao`, `Atividade_idAtividade`, `Atividade_Aluno_matricula`, `Atividade_Disciplina_codigo`),
  INDEX `fk_Anotacao_Atividade1_idx` (`Atividade_idAtividade` ASC, `Atividade_Aluno_matricula` ASC, `Atividade_Disciplina_codigo` ASC),
  CONSTRAINT `fk_Anotacao_Atividade1`
    FOREIGN KEY (`Atividade_idAtividade` , `Atividade_Aluno_matricula` , `Atividade_Disciplina_codigo`)
    REFERENCES `mydb`.`Atividade` (`idAtividade` , `Aluno_matricula` , `Disciplina_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Lembrete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Lembrete` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Lembrete` (
  `idLembrete` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME NOT NULL,
  `horario` TIME NOT NULL,
  `marcador` VARCHAR(45) NULL,
  `Atividade_idAtividade` INT NOT NULL,
  `Atividade_Aluno_matricula` INT NOT NULL,
  `Atividade_Disciplina_codigo` INT NOT NULL,
  PRIMARY KEY (`idLembrete`, `Atividade_idAtividade`, `Atividade_Aluno_matricula`, `Atividade_Disciplina_codigo`),
  INDEX `fk_Lembrete_Atividade1_idx` (`Atividade_idAtividade` ASC, `Atividade_Aluno_matricula` ASC, `Atividade_Disciplina_codigo` ASC),
  CONSTRAINT `fk_Lembrete_Atividade1`
    FOREIGN KEY (`Atividade_idAtividade` , `Atividade_Aluno_matricula` , `Atividade_Disciplina_codigo`)
    REFERENCES `mydb`.`Atividade` (`idAtividade` , `Aluno_matricula` , `Disciplina_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
