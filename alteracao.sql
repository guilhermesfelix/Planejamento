SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `planejamento`.`Atividade` 
DROP FOREIGN KEY `fk_Atividade_Aluno`,
DROP FOREIGN KEY `fk_Atividade_Disciplina1`;

ALTER TABLE `planejamento`.`Anotacao` 
DROP FOREIGN KEY `fk_Anotacao_Atividade1`;

ALTER TABLE `planejamento`.`Lembrete` 
DROP FOREIGN KEY `fk_Lembrete_Atividade1`;

ALTER TABLE `planejamento`.`Aluno` 
ADD COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);

ALTER TABLE `planejamento`.`Disciplina` 
CHANGE COLUMN `codigo` `codigo` VARCHAR(8) NOT NULL ,
CHANGE COLUMN `nome` `nome` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `cargaHoraria` `cargaHoraria` INT(11) NOT NULL ,
ADD COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);

ALTER TABLE `planejamento`.`Atividade` 
DROP COLUMN `Disciplina_codigo`,
DROP COLUMN `Aluno_matricula`,
DROP COLUMN `id`,
ADD COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD COLUMN `Aluno_id` INT(11) NOT NULL AFTER `valor`,
ADD COLUMN `Disciplina_id` INT(11) NOT NULL AFTER `Aluno_id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `Aluno_id`, `Disciplina_id`),
ADD INDEX `fk_Atividade_Aluno_idx` (`Aluno_id` ASC),
ADD INDEX `fk_Atividade_Disciplina1_idx` (`Disciplina_id` ASC),
DROP INDEX `fk_Atividade_Disciplina1_idx` ,
DROP INDEX `fk_Atividade_Aluno_idx` ;

ALTER TABLE `planejamento`.`Anotacao` 
DROP COLUMN `Atividade_Disciplina_codigo`,
DROP COLUMN `Atividade_Aluno_matricula`,
DROP COLUMN `Atividade_idAtividade`,
CHANGE COLUMN `idAnotacao` `id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD COLUMN `Atividade_id` INT(11) NOT NULL AFTER `texto`,
ADD COLUMN `Atividade_Aluno_id` INT(11) NOT NULL AFTER `Atividade_id`,
ADD COLUMN `Atividade_Disciplina_id` INT(11) NOT NULL AFTER `Atividade_Aluno_id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `Atividade_id`, `Atividade_Aluno_id`, `Atividade_Disciplina_id`),
ADD INDEX `fk_Anotacao_Atividade1_idx` (`Atividade_id` ASC, `Atividade_Aluno_id` ASC, `Atividade_Disciplina_id` ASC),
DROP INDEX `fk_Anotacao_Atividade1_idx` ;

ALTER TABLE `planejamento`.`Lembrete` 
DROP COLUMN `Atividade_Disciplina_codigo`,
DROP COLUMN `Atividade_Aluno_matricula`,
DROP COLUMN `Atividade_idAtividade`,
CHANGE COLUMN `idLembrete` `id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD COLUMN `Atividade_id` INT(11) NOT NULL AFTER `marcador`,
ADD COLUMN `Atividade_Aluno_id` INT(11) NOT NULL AFTER `Atividade_id`,
ADD COLUMN `Atividade_Disciplina_id` INT(11) NOT NULL AFTER `Atividade_Aluno_id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `Atividade_id`, `Atividade_Aluno_id`, `Atividade_Disciplina_id`),
ADD INDEX `fk_Lembrete_Atividade1_idx` (`Atividade_id` ASC, `Atividade_Aluno_id` ASC, `Atividade_Disciplina_id` ASC),
DROP INDEX `fk_Lembrete_Atividade1_idx` ;

ALTER TABLE `planejamento`.`Atividade` 
ADD CONSTRAINT `fk_Atividade_Aluno`
  FOREIGN KEY (`Aluno_id`)
  REFERENCES `planejamento`.`Aluno` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Atividade_Disciplina1`
  FOREIGN KEY (`Disciplina_id`)
  REFERENCES `planejamento`.`Disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `planejamento`.`Anotacao` 
ADD CONSTRAINT `fk_Anotacao_Atividade1`
  FOREIGN KEY (`Atividade_id` , `Atividade_Aluno_id` , `Atividade_Disciplina_id`)
  REFERENCES `planejamento`.`Atividade` (`id` , `Aluno_id` , `Disciplina_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `planejamento`.`Lembrete` 
ADD CONSTRAINT `fk_Lembrete_Atividade1`
  FOREIGN KEY (`Atividade_id` , `Atividade_Aluno_id` , `Atividade_Disciplina_id`)
  REFERENCES `planejamento`.`Atividade` (`id` , `Aluno_id` , `Disciplina_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
