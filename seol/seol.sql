-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: mydb
-- Source Schemata: mydb, camx
-- Created: Fri Jun 03 16:35:19 2016
-- Workbench Version: 6.3.6
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema mydb
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;

-- ----------------------------------------------------------------------------
-- Schema seol
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `seol` ;
CREATE SCHEMA IF NOT EXISTS `seol` DEFAULT CHARACTER SET latin1 ;

-- ----------------------------------------------------------------------------
-- Table seol.admin
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`admin` (
  `id_admin` INT(30) NOT NULL,
  `miembros_grup` TEXT NOT NULL,
  `nombre_exam` TEXT NOT NULL,
  `grupo_usuarios_id_grupus` INT(10) NOT NULL,
  PRIMARY KEY (`id_admin`, `grupo_usuarios_id_grupus`),
  INDEX `fk_admin_grupo_usuarios_idx` (`grupo_usuarios_id_grupus` ASC),
  CONSTRAINT `fk_admin_grupo_usuarios`
    FOREIGN KEY (`grupo_usuarios_id_grupus`)
    REFERENCES `seol`.`grupo_usuarios` (`id_grupus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.datos_examen
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`datos_examen` (
  `id_datex` INT(30) NOT NULL,
  `duracion` TEXT NULL,
  `grupo_estudiantes_id_grupest` INT(30) NOT NULL,
  PRIMARY KEY (`id_datex`, `grupo_estudiantes_id_grupest`),
  INDEX `fk_datos_examen_grupo_estudiantes1_idx` (`grupo_estudiantes_id_grupest` ASC),
  CONSTRAINT `fk_datos_examen_grupo_estudiantes1`
    FOREIGN KEY (`grupo_estudiantes_id_grupest`)
    REFERENCES `seol`.`grupo_estudiantes` (`id_grupest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1672
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.registro_examen
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`registro_examen` (
  `id_exam` INT(30) NOT NULL,
  `fecha_exam` TEXT NOT NULL,
  `intentos_preg` TEXT NOT NULL,
  `descartados_preg` TEXT NOT NULL,
  `puntaje_obtenido` TEXT NOT NULL,
  `estado_exam` TEXT NOT NULL,
  `puntaje_total` TEXT NOT NULL,
  `timer` TEXT NOT NULL,
  `detalles_usuario_id_us` INT(100) NOT NULL,
  PRIMARY KEY (`id_exam`, `detalles_usuario_id_us`),
  INDEX `fk_registro_examen_detalles_usuario1_idx` (`detalles_usuario_id_us` ASC),
  CONSTRAINT `fk_registro_examen_detalles_usuario1`
    FOREIGN KEY (`detalles_usuario_id_us`)
    REFERENCES `seol`.`detalles_usuario` (`id_us`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.grupo_usuarios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`grupo_usuarios` (
  `id_grupus` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre_grupus` TEXT NOT NULL,
  `miembros_grupo` TEXT NOT NULL,
  PRIMARY KEY (`id_grupus`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.grupo_estudiantes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`grupo_estudiantes` (
  `id_grupest` INT(30) NOT NULL,
  `nombre_grupest` TEXT NOT NULL,
  PRIMARY KEY (`id_grupest`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.examen_resuelto
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`examen_resuelto` (
  `id_er` INT(200) NOT NULL,
  `enunciado` TEXT NOT NULL,
  `respuesta` TEXT NOT NULL,
  `seleccionado` TEXT NOT NULL,
  `num_intentos` TEXT NOT NULL,
  PRIMARY KEY (`id_er`))
ENGINE = InnoDB
AUTO_INCREMENT = 128
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.detalles_usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`detalles_usuario` (
  `id_us` INT(100) NOT NULL AUTO_INCREMENT,
  `nombre` TEXT NOT NULL,
  `ap_pat` TEXT NOT NULL,
  `ap_mat` TEXT NOT NULL,
  `alias_us` TEXT NOT NULL,
  `genero` TEXT NOT NULL,
  `contrasena` TEXT NOT NULL,
  `fecha_nac` TEXT NOT NULL,
  `tipo_us` TEXT NOT NULL,
  `verif_band` TEXT NOT NULL,
  `direccion` TEXT NOT NULL,
  `feedback` TEXT NOT NULL,
  PRIMARY KEY (`id_us`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table seol.tipo_pregunta
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`tipo_pregunta` (
  `id_tipop` INT(10) NOT NULL,
  `nombre_tipop` TEXT NULL,
  `pregunta_id_preg` INT NOT NULL,
  `datos_examen_id_datex` INT(30) NOT NULL,
  `datos_examen_grupo_estudiantes_id_grupest` INT(30) NOT NULL,
  PRIMARY KEY (`id_tipop`, `pregunta_id_preg`, `datos_examen_id_datex`, `datos_examen_grupo_estudiantes_id_grupest`),
  INDEX `fk_tipo_pregunta_pregunta1_idx` (`pregunta_id_preg` ASC),
  INDEX `fk_tipo_pregunta_datos_examen1_idx` (`datos_examen_id_datex` ASC, `datos_examen_grupo_estudiantes_id_grupest` ASC),
  CONSTRAINT `fk_tipo_pregunta_pregunta1`
    FOREIGN KEY (`pregunta_id_preg`)
    REFERENCES `seol`.`pregunta` (`id_preg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_pregunta_datos_examen1`
    FOREIGN KEY (`datos_examen_id_datex` , `datos_examen_grupo_estudiantes_id_grupest`)
    REFERENCES `seol`.`datos_examen` (`id_datex` , `grupo_estudiantes_id_grupest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table seol.pregunta
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `seol`.`pregunta` (
  `id_preg` INT NOT NULL,
  `enunciado` TEXT NULL,
  `respuesta` TEXT NULL,
  `selecc_band` TEXT NULL,
  `descartado` TEXT NULL,
  PRIMARY KEY (`id_preg`))
ENGINE = InnoDB;
SET FOREIGN_KEY_CHECKS = 1;
