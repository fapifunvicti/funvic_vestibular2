/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vestibular2
-- ------------------------------------------------------
-- Server version	10.11.16-MariaDB-ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `vestibular2`
--
-- Table structure for table `coligada`
--

DROP TABLE IF EXISTS `coligada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `coligada` (
  `idcoligada` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT 'Sem Nome',
  `ativo` int(11) NOT NULL DEFAULT 1,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `coligada` int(11) DEFAULT 1,
  `ordem` int(11) DEFAULT 0,
  PRIMARY KEY (`idcoligada`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT 'Curso Sem Nome',
  `ativo` int(11) NOT NULL DEFAULT 1,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curso_disponivel`
--

DROP TABLE IF EXISTS `curso_disponivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso_disponivel` (
  `idcursodisponivel` int(11) NOT NULL AUTO_INCREMENT,
  `curso_fk` int(11) NOT NULL,
  `coligada_fk` int(11) NOT NULL,
  `ensino_fk` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `periodo` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `disponivel` int(11) DEFAULT 1,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`idcursodisponivel`),
  KEY `coligada_fk` (`coligada_fk`),
  KEY `curso_fk` (`curso_fk`),
  KEY `ensino_fk` (`ensino_fk`),
  CONSTRAINT `curso_disponivel_ibfk_1` FOREIGN KEY (`coligada_fk`) REFERENCES `coligada` (`idcoligada`),
  CONSTRAINT `curso_disponivel_ibfk_2` FOREIGN KEY (`curso_fk`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `curso_disponivel_ibfk_3` FOREIGN KEY (`ensino_fk`) REFERENCES `tipo_ensino` (`idensino`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_item`
--

DROP TABLE IF EXISTS `menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `pai_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `ordem` int(11) DEFAULT 0,
  `ativo` int(11) DEFAULT 1,
  `inserido_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `dropdown` int(11) DEFAULT 0,
  PRIMARY KEY (`idmenu`),
  KEY `pai_id` (`pai_id`),
  CONSTRAINT `menu_item_ibfk_1` FOREIGN KEY (`pai_id`) REFERENCES `menu_item` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `processo_seletivo`
--

DROP TABLE IF EXISTS `processo_seletivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `processo_seletivo` (
  `idprocesso` int(11) NOT NULL AUTO_INCREMENT,
  `fk_curso` int(11) NOT NULL,
  `fk_coligada` int(11) NOT NULL,
  `fk_ensino` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(255) DEFAULT NULL,
  `data_prova` datetime DEFAULT current_timestamp(),
  `id_totvs` int(11) DEFAULT 0,
  `habilitar_resultado` int(11) DEFAULT 0,
  `data_resultado_inicio` datetime DEFAULT current_timestamp(),
  `data_resultado_fim` datetime DEFAULT NULL,
  `inserido_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `categoria` int(11) DEFAULT 1,
  `tipo_resultado` int(11) DEFAULT 0,
  `ordem` int(11) DEFAULT 0,
  `resultado_local` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`idprocesso`),
  KEY `processo_seletivo_coligada_FK` (`fk_coligada`),
  KEY `processo_seletivo_curso_FK` (`fk_curso`),
  KEY `fk_ensino` (`fk_ensino`),
  CONSTRAINT `processo_seletivo_coligada_FK` FOREIGN KEY (`fk_coligada`) REFERENCES `coligada` (`idcoligada`),
  CONSTRAINT `processo_seletivo_curso_FK` FOREIGN KEY (`fk_curso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `processo_seletivo_ibfk_1` FOREIGN KEY (`fk_ensino`) REFERENCES `tipo_ensino` (`idensino`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `processo_vestibular`
--

DROP TABLE IF EXISTS `processo_vestibular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `processo_vestibular` (
  `idvestibular_fk` int(11) NOT NULL,
  `idprocesso_fk` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT 1,
  KEY `fk_processo_vestibular_vestibular_idx` (`idvestibular_fk`),
  KEY `fk_processo_vestibular_processo_seletivo1_idx` (`idprocesso_fk`),
  CONSTRAINT `fk_processo_vestibular_processo_seletivo1` FOREIGN KEY (`idprocesso_fk`) REFERENCES `processo_seletivo` (`idprocesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_processo_vestibular_vestibular` FOREIGN KEY (`idvestibular_fk`) REFERENCES `vestibular` (`idvestibular`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipo_ensino`
--

DROP TABLE IF EXISTS `tipo_ensino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_ensino` (
  `idensino` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `inserido_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`idensino`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT 0,
  `ultimo_login` datetime DEFAULT NULL,
  `inserido_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vestibular`
--

DROP TABLE IF EXISTS `vestibular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vestibular` (
  `idvestibular` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT 'Sem Nome',
  `data_prova` datetime DEFAULT NULL,
  `inserido_em` datetime NOT NULL DEFAULT current_timestamp(),
  `alterado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`idvestibular`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

