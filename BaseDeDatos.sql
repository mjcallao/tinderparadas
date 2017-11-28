SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `Cachengue`;
DROP TABLE IF EXISTS `administrador`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `Cachengue` (
    `idCachengue` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(60) NOT NULL,
    `posX` FLOAT NOT NULL,
    `posY` FLOAT NOT NULL,
    `radio` INTEGER NOT NULL,
    `activa` BOOLEAN NOT NULL,
    `tipo` VARCHAR(60) NOT NULL,
    `comentario` VARCHAR(256) NOT NULL,
    `diasActivo` VARCHAR(10) NOT NULL,
    `horaIncio` TIME NOT NULL,
    `horaFin` TIME NOT NULL,
    `usuariosMinimos` INTEGER NOT NULL,
    `usuariosActivos` INTEGER NOT NULL,
    PRIMARY KEY (`idCachengue`)
);

CREATE TABLE `administrador` (
    `idAdministrador` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(128) NOT NULL,
    `password` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`idAdministrador`)
);
