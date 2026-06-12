CREATE TABLE IF NOT EXISTS `coligada` (
	`idcoligada` INT NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL DEFAULT 'Sem Nome',
	`ativo` INT NOT NULL DEFAULT 1,
	`criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`alterado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	`coligada` INT DEFAULT 1,
	PRIMARY KEY (`idcoligada`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `curso` (
	`idcurso` INT NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL DEFAULT 'Curso Sem Nome',
	`ativo` INT NOT NULL DEFAULT 1,
	`criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`alterado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `tipo_ensino` (
	`idensino` INT AUTO_INCREMENT,
	`nome` VARCHAR(255),
	`inserido_em` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`atualizado_em` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	PRIMARY KEY (`idensino`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `curso_disponivel` (
	`idcursodisponivel` INT AUTO_INCREMENT,
	`curso_fk` INT NOT NULL,
	`coligada_fk` INT NOT NULL,
	`ensino_fk` INT NOT NULL,
	`nome` VARCHAR(255),
	`periodo` VARCHAR(255),
	`area` VARCHAR(255),
	`disponivel` INT DEFAULT 1,
	`ativo` INT DEFAULT 1,
	PRIMARY KEY (`idcursodisponivel`),
	FOREIGN KEY (`coligada_fk`) REFERENCES `coligada`(`idcoligada`),
	FOREIGN KEY (`curso_fk`) REFERENCES `curso`(`idcurso`),
	FOREIGN KEY (`ensino_fk`) REFERENCES `tipo_ensino`(`idensino`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `menu_item` (
	`idmenu` INT NOT NULL AUTO_INCREMENT,
	`pai_id` INT,
	`nome` VARCHAR(255),
	`url` VARCHAR(500),
	`ordem` INT DEFAULT 0,
	`ativo` INT DEFAULT 1,
	`inserido_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`alterado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	`dropdown` INT DEFAULT 0,
	PRIMARY KEY (`idmenu`),
	FOREIGN KEY (`pai_id`) REFERENCES `menu_item`(`idmenu`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `processo_seletivo` (
	`idprocesso` INT NOT NULL AUTO_INCREMENT,
	`fk_curso` INT NOT NULL,
	`fk_coligada` INT NOT NULL,
	`fk_ensino` INT NOT NULL DEFAULT 1,
	`nome` VARCHAR(255),
	`data_prova` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`id_totvs` INT DEFAULT 0,
	`habilitar_resultado` INT DEFAULT 0,
	`data_resultado_inicio` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`data_resultado_fim` DATETIME,
	`inserido_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`alterado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	`categoria` INT DEFAULT 1,
	`tipo_resultado` INT DEFAULT 0,
	PRIMARY KEY (`idprocesso`),
	CONSTRAINT `processo_seletivo_coligada_FK` FOREIGN KEY (`fk_coligada`) REFERENCES `coligada`(`idcoligada`),
	CONSTRAINT `processo_seletivo_curso_FK` FOREIGN KEY (`fk_curso`) REFERENCES `curso`(`idcurso`),
	FOREIGN KEY (`fk_ensino`) REFERENCES `tipo_ensino`(`idensino`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `usuario` (
	`idusuario` INT NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`permissao` INT NOT NULL DEFAULT 0,
	`ultimo_login` DATETIME,
	`inserido_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`alterado_em` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`deletado_em` DATETIME,
	PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB;