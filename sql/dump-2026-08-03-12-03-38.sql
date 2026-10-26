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
-- Dumping data for table `coligada`
--

LOCK TABLES `coligada` WRITE;
/*!40000 ALTER TABLE `coligada` DISABLE KEYS */;
INSERT INTO `coligada` VALUES
(2,'Campus Mococa',1,'2026-05-11 20:06:48','2026-08-03 14:08:59',NULL,2,2),
(3,'Campus Pinda',1,'2026-05-11 20:05:17','2026-08-03 14:08:52',NULL,1,0),
(4,'Transferência Medicina',1,'2026-06-16 13:46:23','2026-08-03 14:08:47',NULL,1,1);
/*!40000 ALTER TABLE `coligada` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES
(1,'Geral',1,'2026-05-11 20:19:11','2026-06-12 14:30:30',NULL),
(2,'Medicina',1,'2026-05-11 20:19:59','2026-06-12 14:31:19',NULL);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `curso_disponivel`
--

LOCK TABLES `curso_disponivel` WRITE;
/*!40000 ALTER TABLE `curso_disponivel` DISABLE KEYS */;
INSERT INTO `curso_disponivel` VALUES
(1,1,3,1,'Administração','Matutino','Humanas',1,1);
/*!40000 ALTER TABLE `curso_disponivel` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `menu_item`
--

LOCK TABLES `menu_item` WRITE;
/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` VALUES
(1,NULL,'Início','/',0,1,'2026-05-12 13:24:28','2026-06-12 11:27:59',NULL,0),
(2,3,'Inscreva-se','/#inscricoes',1,1,'2026-05-12 13:25:05','2026-08-03 11:36:10',NULL,0),
(3,NULL,'Informações','#',2,1,'2026-05-12 13:25:45','2026-08-03 08:48:04',NULL,1),
(4,NULL,'Manual do Candidato','javascript:void(0);',4,1,'2026-05-12 13:26:30','2026-08-03 08:49:09',NULL,1),
(5,NULL,'Cursos','/cursos',4,1,'2026-05-12 13:27:16','2026-08-03 08:49:27',NULL,0),
(6,NULL,'Resultados','/resultado',99,1,'2026-05-12 13:27:51','2026-08-03 08:43:04',NULL,0),
(7,3,'Sobre a Prova','/sobre_prova',0,1,'2026-05-12 13:28:56','2026-08-03 08:43:22',NULL,0),
(8,NULL,'Informacoes','/',0,0,'2026-05-12 17:02:58','2026-08-03 08:42:43',NULL,1),
(9,NULL,'TESTE',NULL,5,0,'2026-05-21 09:24:35','2026-05-21 10:04:43',NULL,1),
(11,4,'Manual do Candidato 2026 2 Semestre','/pdf/manual_candidato_2026_2.pdf',0,1,'2026-06-30 11:43:00','2026-08-03 08:43:17',NULL,0),
(12,NULL,'Editais','/',3,1,'2026-06-30 14:47:43','2026-08-03 08:48:53',NULL,1),
(13,12,'Edital de transferência de Medicina 2026','/pdf/edital_transferencia_medicina_2026.pdf',0,1,'2026-06-30 14:48:03','2026-08-03 08:52:24',NULL,0),
(14,NULL,'Inscreva-se','/#inscricoes',0,0,'2026-08-03 08:40:10','2026-08-03 11:35:39',NULL,0);
/*!40000 ALTER TABLE `menu_item` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `processo_seletivo`
--

LOCK TABLES `processo_seletivo` WRITE;
/*!40000 ALTER TABLE `processo_seletivo` DISABLE KEYS */;
INSERT INTO `processo_seletivo` VALUES
(1,1,3,1,'Vestibular 11/07/2026','2026-07-11 00:00:00',204,1,'2026-06-12 15:12:00','2026-06-30 00:00:00','2026-06-12 15:13:00','2026-08-03 10:42:07','2026-08-03 10:42:07',1,0,1,1),
(2,1,3,1,'VESTIBULAR 20/06/2026','2026-06-20 00:00:00',207,1,'2026-06-12 15:14:00','2026-06-20 00:00:00','2026-06-12 15:14:52','2026-08-03 10:41:53','2026-08-03 10:41:53',1,0,2,1),
(3,1,4,1,'Inscrições','2026-06-16 10:46:00',187,0,'2026-06-16 10:47:00','2026-06-16 10:47:00','2026-06-16 10:47:22','2026-08-03 11:16:29',NULL,1,0,99,1),
(4,1,2,1,'VESTIBULAR 11/07/2026','2026-07-11 00:00:00',203,1,'2026-06-20 00:00:00','2026-07-29 00:00:00','2026-06-22 15:53:19','2026-08-03 14:26:11','2026-08-03 11:25:20',1,0,0,1),
(5,1,2,1,'Vestibular 20/06/2026','2026-06-20 00:00:00',203,1,'2026-06-06 00:00:00','2026-12-01 00:00:00','2026-07-20 16:50:51','2026-08-03 11:22:26','2026-08-03 11:22:25',1,1,0,0),
(6,1,3,1,'Presencial','2026-08-30 00:00:00',211,0,'2026-08-03 00:00:00','2026-08-03 00:00:00','2026-08-03 10:55:45','2026-08-03 10:56:54',NULL,1,0,0,0),
(7,1,3,1,'Semipresencial','2026-08-30 00:00:00',212,0,'2026-08-30 00:00:00','2026-08-30 00:00:00','2026-08-03 10:58:43','2026-08-03 10:58:43',NULL,1,0,0,0),
(8,1,2,2,'Semipresencial','2026-08-30 00:00:00',213,0,'2026-08-30 00:00:00','2026-08-30 00:00:00','2026-08-03 10:59:56','2026-08-03 11:03:28',NULL,1,0,3,0);
/*!40000 ALTER TABLE `processo_seletivo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `processo_vestibular`
--

LOCK TABLES `processo_vestibular` WRITE;
/*!40000 ALTER TABLE `processo_vestibular` DISABLE KEYS */;
INSERT INTO `processo_vestibular` VALUES
(1,4,1),
(1,3,1),
(1,1,1),
(1,6,1),
(1,7,1),
(1,8,1);
/*!40000 ALTER TABLE `processo_vestibular` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `tipo_ensino`
--

LOCK TABLES `tipo_ensino` WRITE;
/*!40000 ALTER TABLE `tipo_ensino` DISABLE KEYS */;
INSERT INTO `tipo_ensino` VALUES
(1,'Presencial','2026-05-12 17:35:38','2026-05-12 17:35:38',NULL),
(2,'Semipresencial','2026-05-12 17:35:58','2026-05-12 17:35:58',NULL);
/*!40000 ALTER TABLE `tipo_ensino` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'nicholasluis@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$YXI0a0JSZ3dHQy5TdThLbw$ubGeGyKFx/pPqz2GlkNjy9J1cenqX4DaAb4xaF5TKow',999,'2026-05-13 12:14:52','2026-05-13 12:14:52','2026-06-16 15:14:49',NULL),
(2,'designer.pinda@funvic.org.br','$argon2id$v=19$m=65536,t=4,p=1$M2tFNTdyWkx3TElCcWV2NQ$UoO9+K1ZXkMVQShTlwupPTQPqZlmViI/upjPeYXZzqc',999,NULL,'2026-08-03 13:01:53','2026-08-03 13:02:05',NULL),
(3,'desenvolvimento.pinda@funvic.org.br','$argon2id$v=19$m=65536,t=4,p=1$VmZVMjdTNHJTeVJ2OGEzUg$ma+Xreatn+comkyK5CNdjVvpTNudbTvixlA6GAyZMJo',999,NULL,'2026-08-03 13:03:50','2026-08-03 13:06:02',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `vestibular`
--

LOCK TABLES `vestibular` WRITE;
/*!40000 ALTER TABLE `vestibular` DISABLE KEYS */;
INSERT INTO `vestibular` VALUES
(1,'\nVestibular 2026/2','2026-06-06 00:00:00','2026-06-23 13:34:36','2026-07-24 09:50:17',NULL),
(5,'Vestibular Teste 1232',NULL,'2026-06-30 09:10:53','2026-08-03 10:51:09','2026-08-03 10:51:09');
/*!40000 ALTER TABLE `vestibular` ENABLE KEYS */;
UNLOCK TABLES;

