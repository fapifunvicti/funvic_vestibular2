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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `vestibular2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `vestibular2`;

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
(2,'Campus Mococa',1,'2026-05-11 20:06:48','2026-06-22 20:11:27',NULL,2,2),
(3,'Unifunvic Campus Pinda',1,'2026-05-11 20:05:17','2026-06-16 13:45:02',NULL,1,0),
(4,'Medicina',1,'2026-06-16 13:46:23','2026-06-22 20:11:27',NULL,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item`
--

LOCK TABLES `menu_item` WRITE;
/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` VALUES
(1,NULL,'Início','/',0,1,'2026-05-12 13:24:28','2026-06-12 11:27:59',NULL,0),
(2,3,'Inscreva-se','/inscreva-se',1,1,'2026-05-12 13:25:05','2026-05-20 16:57:49',NULL,0),
(3,NULL,'Informações','javascript:void(0);',1,1,'2026-05-12 13:25:45','2026-05-21 09:39:36',NULL,1),
(4,NULL,'Manual do Candidato','javascript:void(0);',1,1,'2026-05-12 13:26:30','2026-05-21 09:39:50',NULL,0),
(5,NULL,'Cursos','/cursos',4,1,'2026-05-12 13:27:16','2026-05-20 15:56:51',NULL,0),
(6,NULL,'Resultados','/resultado',8,1,'2026-05-12 13:27:51','2026-05-25 12:28:23',NULL,0),
(7,3,'Data da Prova1','/data-prova1',6,1,'2026-05-12 13:28:56','2026-06-12 11:21:35',NULL,0),
(8,NULL,'Informacoes','/',7,0,'2026-05-12 17:02:58','2026-05-25 11:12:20',NULL,1),
(9,NULL,'TESTE',NULL,5,0,'2026-05-21 09:24:35','2026-05-21 10:04:43',NULL,1);
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
  PRIMARY KEY (`idprocesso`),
  KEY `processo_seletivo_coligada_FK` (`fk_coligada`),
  KEY `processo_seletivo_curso_FK` (`fk_curso`),
  KEY `fk_ensino` (`fk_ensino`),
  CONSTRAINT `processo_seletivo_coligada_FK` FOREIGN KEY (`fk_coligada`) REFERENCES `coligada` (`idcoligada`),
  CONSTRAINT `processo_seletivo_curso_FK` FOREIGN KEY (`fk_curso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `processo_seletivo_ibfk_1` FOREIGN KEY (`fk_ensino`) REFERENCES `tipo_ensino` (`idensino`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processo_seletivo`
--

LOCK TABLES `processo_seletivo` WRITE;
/*!40000 ALTER TABLE `processo_seletivo` DISABLE KEYS */;
INSERT INTO `processo_seletivo` VALUES
(1,1,3,1,'Presencial','2026-06-20 00:00:00',207,0,'2026-06-12 15:12:00','2026-06-30 00:00:00','2026-06-12 15:13:00','2026-06-16 10:42:06',NULL,1,0,0),
(2,1,2,1,'Processo Seletivo','2026-06-20 00:00:00',206,0,'2026-06-12 15:14:00','2026-06-20 00:00:00','2026-06-12 15:14:52','2026-06-16 10:47:46',NULL,1,0,0),
(3,1,4,1,'Medicina','2026-06-16 10:46:00',187,0,'2026-06-16 10:47:00','2026-06-16 10:47:00','2026-06-16 10:47:22','2026-06-16 10:47:22',NULL,1,0,0),
(4,1,3,2,'Semipresencial','2026-06-20 00:00:00',208,0,'2026-06-20 00:00:00','2026-07-29 00:00:00','2026-06-22 15:53:19','2026-06-22 15:53:19',NULL,1,0,0);
/*!40000 ALTER TABLE `processo_seletivo` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'nicholasluis@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$YXI0a0JSZ3dHQy5TdThLbw$ubGeGyKFx/pPqz2GlkNjy9J1cenqX4DaAb4xaF5TKow',999,'2026-05-13 12:14:52','2026-05-13 12:14:52','2026-06-16 15:14:49',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_arvore_menu`
--

DROP TABLE IF EXISTS `view_arvore_menu`;
/*!50001 DROP VIEW IF EXISTS `view_arvore_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_arvore_menu` AS SELECT
 1 AS `idmenu`,
  1 AS `pai_id`,
  1 AS `nome`,
  1 AS `nome_identado`,
  1 AS `url`,
  1 AS `ordem`,
  1 AS `ativo`,
  1 AS `inserido_em`,
  1 AS `alterado_em`,
  1 AS `deletado_em`,
  1 AS `dropdown`,
  1 AS `nivel` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_processo_seletivo`
--

DROP TABLE IF EXISTS `view_processo_seletivo`;
/*!50001 DROP VIEW IF EXISTS `view_processo_seletivo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_processo_seletivo` AS SELECT
 1 AS `idprocesso`,
  1 AS `fk_curso`,
  1 AS `fk_coligada`,
  1 AS `fk_ensino`,
  1 AS `nome`,
  1 AS `data_prova`,
  1 AS `id_totvs`,
  1 AS `habilitar_resultado`,
  1 AS `data_resultado_inicio`,
  1 AS `data_resultado_fim`,
  1 AS `inserido_em`,
  1 AS `alterado_em`,
  1 AS `deletado_em`,
  1 AS `categoria`,
  1 AS `tipo_resultado`,
  1 AS `curso_nome`,
  1 AS `coligada_nome`,
  1 AS `ensino_nome`,
  1 AS `coligada_totvs`,
  1 AS `data_prova_fmt`,
  1 AS `data_resultado_inicio_fmt`,
  1 AS `data_resultado_fim_fmt`,
  1 AS `total_coligadas` */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'vestibular2'
--

--
-- Dumping routines for database 'vestibular2'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP FUNCTION IF EXISTS `total_processos_coligadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `total_processos_coligadas`(coligada_id INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE total INT;
SELECT
COUNT(*) INTO total
FROM coligada
LEFT JOIN processo_seletivo ON processo_seletivo.fk_coligada = coligada.idcoligada
WHERE processo_seletivo.fk_coligada = coligada_id;
RETURN total;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Current Database: `vestibular2`
--

USE `vestibular2`;

--
-- Final view structure for view `view_arvore_menu`
--

/*!50001 DROP VIEW IF EXISTS `view_arvore_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_arvore_menu` AS with recursive menu_tree as (select `menu_item`.`idmenu` AS `idmenu`,`menu_item`.`pai_id` AS `pai_id`,`menu_item`.`nome` AS `nome`,`menu_item`.`url` AS `url`,`menu_item`.`ordem` AS `ordem`,`menu_item`.`ativo` AS `ativo`,`menu_item`.`inserido_em` AS `inserido_em`,`menu_item`.`alterado_em` AS `alterado_em`,`menu_item`.`deletado_em` AS `deletado_em`,`menu_item`.`dropdown` AS `dropdown`,0 AS `nivel` from `menu_item` where `menu_item`.`pai_id` is null union all select `m`.`idmenu` AS `idmenu`,`m`.`pai_id` AS `pai_id`,`m`.`nome` AS `nome`,`m`.`url` AS `url`,`m`.`ordem` AS `ordem`,`m`.`ativo` AS `ativo`,`m`.`inserido_em` AS `inserido_em`,`m`.`alterado_em` AS `alterado_em`,`m`.`deletado_em` AS `deletado_em`,`m`.`dropdown` AS `dropdown`,`mt`.`nivel` + 1 AS `mt.nivel + 1` from (`menu_item` `m` join `menu_tree` `mt` on(`m`.`pai_id` = `mt`.`idmenu`)))select `menu_tree`.`idmenu` AS `idmenu`,`menu_tree`.`pai_id` AS `pai_id`,`menu_tree`.`nome` AS `nome`,concat(repeat(' ',`menu_tree`.`nivel` * 2),`menu_tree`.`nome`) AS `nome_identado`,`menu_tree`.`url` AS `url`,`menu_tree`.`ordem` AS `ordem`,`menu_tree`.`ativo` AS `ativo`,`menu_tree`.`inserido_em` AS `inserido_em`,`menu_tree`.`alterado_em` AS `alterado_em`,`menu_tree`.`deletado_em` AS `deletado_em`,`menu_tree`.`dropdown` AS `dropdown`,`menu_tree`.`nivel` AS `nivel` from `menu_tree` order by `menu_tree`.`nivel`,`menu_tree`.`ordem` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_processo_seletivo`
--

/*!50001 DROP VIEW IF EXISTS `view_processo_seletivo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_processo_seletivo` AS select `processo_seletivo`.`idprocesso` AS `idprocesso`,`processo_seletivo`.`fk_curso` AS `fk_curso`,`processo_seletivo`.`fk_coligada` AS `fk_coligada`,`processo_seletivo`.`fk_ensino` AS `fk_ensino`,`processo_seletivo`.`nome` AS `nome`,`processo_seletivo`.`data_prova` AS `data_prova`,`processo_seletivo`.`id_totvs` AS `id_totvs`,`processo_seletivo`.`habilitar_resultado` AS `habilitar_resultado`,`processo_seletivo`.`data_resultado_inicio` AS `data_resultado_inicio`,`processo_seletivo`.`data_resultado_fim` AS `data_resultado_fim`,`processo_seletivo`.`inserido_em` AS `inserido_em`,`processo_seletivo`.`alterado_em` AS `alterado_em`,`processo_seletivo`.`deletado_em` AS `deletado_em`,`processo_seletivo`.`categoria` AS `categoria`,`processo_seletivo`.`tipo_resultado` AS `tipo_resultado`,`curso`.`nome` AS `curso_nome`,`coligada`.`nome` AS `coligada_nome`,`tipo_ensino`.`nome` AS `ensino_nome`,`coligada`.`coligada` AS `coligada_totvs`,date_format(`processo_seletivo`.`data_prova`,'%d/%m/%Y') AS `data_prova_fmt`,date_format(`processo_seletivo`.`data_resultado_inicio`,'%d/%m/%Y') AS `data_resultado_inicio_fmt`,date_format(`processo_seletivo`.`data_resultado_fim`,'%d/%m/%Y') AS `data_resultado_fim_fmt`,`vestibular2`.`total_processos_coligadas`(`processo_seletivo`.`fk_coligada`) AS `total_coligadas` from (((`processo_seletivo` left join `curso` on(`curso`.`idcurso` = `processo_seletivo`.`fk_curso`)) left join `coligada` on(`coligada`.`idcoligada` = `processo_seletivo`.`fk_coligada`)) left join `tipo_ensino` on(`tipo_ensino`.`idensino` = `processo_seletivo`.`fk_ensino`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-23 13:11:21
