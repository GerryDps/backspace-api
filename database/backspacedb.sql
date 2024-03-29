-- MySQL Script generated by MySQL Workbench
-- ven 16 feb 2024, 10:48:15
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema backspacedb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema backspacedb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `backspacedb` DEFAULT CHARACTER SET utf8 ;
USE `backspacedb` ;

-- -----------------------------------------------------
-- Table `backspacedb`.`Exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Exercise` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `video` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`name` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Therapy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Therapy` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`name` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`ExerciseTherapy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`ExerciseTherapy` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dayofweek` VARCHAR(255) NOT NULL,
  `timeofday` VARCHAR(255) NOT NULL,
  `sequence` VARCHAR(255) NOT NULL,
  `Therapy_id` INT(11) NOT NULL,
  `Exercise_idExercise` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`Therapy_id`, `Exercise_idExercise`),
  CONSTRAINT `fk_ExerciseTherapy_Exercise1`
    FOREIGN KEY (`Exercise_idExercise`)
    REFERENCES `backspacedb`.`Exercise` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ExerciseTherapy_Therapy1`
    FOREIGN KEY (`Therapy_id`)
    REFERENCES `backspacedb`.`Therapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Doctor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Doctor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `birthday` DATE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`email`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Patient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Patient` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `birthday` DATE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `type` TINYINT(1) NULL DEFAULT NULL,
  `hasDoctor` TINYINT(1) GENERATED ALWAYS AS (`Doctor_id` is not null) VIRTUAL,
  `hasQuestionary` TINYINT(1) NOT NULL DEFAULT 0,
  `Doctor_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`email`),
  CONSTRAINT `fk_Patient_Doctor`
    FOREIGN KEY (`Doctor_id`)
    REFERENCES `backspacedb`.`Doctor` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`PatientTherapy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`PatientTherapy` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Patient_id` INT NULL DEFAULT NULL,
  `Therapy_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`Patient_id`, `Therapy_id`),
  CONSTRAINT `fk_PatientTherapy_Patient1`
    FOREIGN KEY (`Patient_id`)
    REFERENCES `backspacedb`.`Patient` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_PatientTherapy_Therapy1`
    FOREIGN KEY (`Therapy_id`)
    REFERENCES `backspacedb`.`Therapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Completed`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Completed` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `PatientTherapy_Patient_id` INT NULL DEFAULT NULL,
  `Therapy_Therapy_id` INT NULL DEFAULT NULL,
  `ExerciseTherapy_Exercise_idExercise` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`PatientTherapy_Patient_id`, `Therapy_Therapy_id`, `ExerciseTherapy_Exercise_idExercise`),
  CONSTRAINT `fk_Completed_ExerciseTherapy1`
    FOREIGN KEY (`ExerciseTherapy_Exercise_idExercise`)
    REFERENCES `backspacedb`.`ExerciseTherapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Completed_PatientTherapy1`
    FOREIGN KEY (`PatientTherapy_Patient_id`)
    REFERENCES `backspacedb`.`PatientTherapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Therapy_Therapy_id`
    FOREIGN KEY (`Therapy_Therapy_id`)
    REFERENCES `backspacedb`.`Therapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`DoctorTherapy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`DoctorTherapy` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Doctor_id` INT NULL DEFAULT NULL,
  `Therapy_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE (`Doctor_id`, `Therapy_id`),
  CONSTRAINT `fk_DoctorTherapy_Doctor1`
    FOREIGN KEY (`Doctor_id`)
    REFERENCES `backspacedb`.`Doctor` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_DoctorTherapy_Therapy1`
    FOREIGN KEY (`Therapy_id`)
    REFERENCES `backspacedb`.`Therapy` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Episode`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Episode` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `start` TIMESTAMP NOT NULL,
  `end` TIMESTAMP NOT NULL,
  `intensity` TINYINT(1) NOT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `Patient_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Episode_Patient1`
    FOREIGN KEY (`Patient_id`)
    REFERENCES `backspacedb`.`Patient` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `backspacedb`.`Questionary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `backspacedb`.`Questionary` (
  `id` INT NOT NULL,
  `a` TINYINT NOT NULL,
  `b` TINYINT NOT NULL,
  `c` TINYINT NOT NULL,
  `d` TINYINT NOT NULL,
  `e` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Questionary_Patient1`
    FOREIGN KEY (`id`)
    REFERENCES `backspacedb`.`Patient` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


USE `backspacedb`;

DELIMITER $$
USE `backspacedb`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `backspacedb`.`del_check`
AFTER DELETE ON `backspacedb`.`Questionary`
FOR EACH ROW
BEGIN
        UPDATE `Patient` SET `hasQuestionary` = 0 WHERE `id` = OLD.`id`;
END$$

USE `backspacedb`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `backspacedb`.`ins_check`
AFTER INSERT ON `backspacedb`.`Questionary`
FOR EACH ROW
BEGIN
        UPDATE `Patient` SET `hasQuestionary` = 1 WHERE `id` = NEW.`id`;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
