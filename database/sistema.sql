-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sistema
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `comunidades`
--

DROP TABLE IF EXISTS `comunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comunidad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comunidades`
--

LOCK TABLES `comunidades` WRITE;
/*!40000 ALTER TABLE `comunidades` DISABLE KEYS */;
INSERT INTO `comunidades` VALUES (1,'PALMICHAL'),(2,'LA ENSENADA'),(3,'CUJISAL'),(4,'EL CARDON'),(5,'AGUA AZUL'),(6,'ESPARRAMADERO'),(7,'CAJA DE AGUA'),(8,'PRODUCTORES DE CAMPO ALEGRE'),(9,'VILLAS DE YARA'),(10,'RENACER DE UN PUEBLO'),(11,'EL PARAISO'),(12,'DON ANTONIO'),(13,'MOTOCROSS'),(14,'ANA SUAREZ CENTRO'),(15,'LA MAPORITA'),(16,'EL JAGUEY'),(17,'SABANA DE TIQUIRE'),(18,'CERRO GRANDE'),(19,'TACARIGUITA'),(20,'REVOLUCION 106'),(21,'SIEMPRE ADELANTE 107 SAN JOSE'),(22,'MAIZANTA'),(23,'CREANDO CONCIENCIA'),(24,'UNIDAD Y ACCION'),(25,'MONTAÑITA I'),(26,'DANIEL CARIAS Y BANCO OBREROS'),(27,'MONTAÑITA III'),(28,'BARRIO BOLIVAR'),(29,'LA REALIDAD'),(30,'TEREPAIMA'),(31,'COLINAS DE TEREPAIMA (VOLUNTAD Y ACCION)'),(32,'BRISAS DE TEREPAIMA'),(33,'CASERIO DE CAÑAVERAL'),(34,'SOL BOLIVARIANO'),(35,'EL SALTO'),(36,'SABANA DE GUREMAL'),(37,'QUEBRADA GRANDE'),(38,'EL PLAYON'),(39,'BRISAS DEL PEGON'),(40,'ARENALES VIA EL SALTO'),(41,'CAMBURITO SECTOR LA CRISPINERA'),(42,'LA FLORIDA'),(43,'MONTANITA II BICENTENARIO'),(44,'II DE SEPTIEMBRE'),(45,'MONTAÑITA INDIO COY ( LIRIOS DEL VALLE)'),(46,'LA VICTORIA'),(47,'YACURAL'),(48,'TORBELLAN'),(49,'ANIMAS'),(50,'UVEDAL'),(51,'DON NICOLA'),(52,'EL SARURO'),(53,'PUEBLO UNIDO'),(54,'OVIDIO MARCHAN'),(55,'AGUA VIVA'),(56,'SAN ANTONIO LA TAPA'),(57,'BRISAS DE LA TAPA'),(58,'TAPA LA LUCHA'),(59,'EL POR VENIR'),(60,'FRANCISCA HERNANDEZ'),(61,'FABRICIO SEQUERA/ LA MORA'),(62,'RIVERA SANTA LUCIA'),(63,'ALDEA LA PAZ'),(64,'LA FUENTE'),(65,'CANAAN CELESTIAL TIERRA DE DIOS'),(66,'TOTUMILLO'),(67,'SAN ROQUE'),(68,'AMINTA ABREU'),(69,'LA VAQUERA BARRIO AJURO'),(70,'PIEDRA ARRIBA'),(71,'PIEDRA CENTRO'),(72,'SAN ANTONIO - LA PIEDRA'),(73,'PUEBLO NUEVO'),(74,'DON TEODORO'),(75,'TEOLINDA PAEZ'),(76,'SANTA EDUVIGE LOS RANCHOS'),(77,'PAZ BOLIVARIANA'),(78,'SOMOS TODOS'),(79,'URBANIZACION ARAGUANEY'),(80,'NUEVA ESPERANZA-CRISTO REY'),(81,'LOS REVOLUCIONARIOS'),(82,'VILLA OLIMPICA'),(83,'RAFAEL RANGEL'),(84,'SUEÑOS BOLIVARIANOS SABANITA 1'),(85,'SECTOR LA VIRGEN'),(86,'LA ROCA DE LA SALVACIÓN'),(87,'URIBEQUE'),(88,'URBANIZACION SIMON RODRIGUEZ III'),(89,'URBANIZACION SIMON RODRIGUEZ I'),(90,'SANTA INES'),(91,'ALI PRIMERA PLATANALES'),(92,'JUAN BERNARDO NAHACA'),(93,'LA ORQUIDEA'),(94,'SABANITA 4/ ALI PRIMERA'),(95,'VILLA JARDIN'),(96,'UNION BOLIVARIANA /BOLIVARIANA 1'),(97,'TRICENTENARIA POPULAR'),(98,'EL PINAL'),(99,'EL POZON'),(100,'LIMONCITO'),(101,'EL CARMELERO'),(102,'AGUA NEGRA'),(103,'AGUA LINDA'),(104,'ALBARICAL'),(105,'LA PERDOMERA'),(106,'LA HILERA'),(107,'PEGON PASTOR GARCIA'),(108,'TRICENTENARIA 1'),(109,'TERMO YARACUY'),(110,'ENCRUCIJADA'),(111,'VALLES DE PEÑA'),(112,'HATO VIEJO'),(113,'CAMINO NUEVO'),(114,'SAN RAFAEL'),(115,'LOS TUBOS'),(116,'LOS PATIECITOS'),(117,'POTRERITO'),(118,'CAÑADA TEMA'),(119,'EL MILAGRO DE BARRIO AJURO I'),(120,'BARRIO AJURO LAS 4R'),(121,'SAN ANTONIO (LA REVOLUCION DE SAN ANTONIO )'),(122,'EL VAPOR'),(123,'ARENALES( VIA LAS VELAS)'),(124,'AMIGO TRES CALLEJONES'),(125,'GRANVEL'),(126,'LAS VELAS CENTRO'),(127,'5 Y 7 CASAS'),(128,'EL PALMAR'),(129,'YUMARITO'),(130,'SANTA BARBARA'),(131,'SANTA LUCIA'),(132,'LA CONCEPCION'),(133,'PILCO MAYO'),(134,'VILLAS SANTA LUCIA'),(135,'TIAMA'),(136,'LA BANDERA'),(137,'JOSE GREGORIO AMAYA'),(138,'LA TRILLA'),(139,'TIERRA AMARILLA'),(140,'EL CHIMBORAZO'),(141,'LA RURAL SECTOR 102'),(142,'EL JOBITO');
/*!40000 ALTER TABLE `comunidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constancias`
--

DROP TABLE IF EXISTS `constancias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constancias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_manual` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constancias`
--

LOCK TABLES `constancias` WRITE;
/*!40000 ALTER TABLE `constancias` DISABLE KEYS */;
/*!40000 ALTER TABLE `constancias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho`
--

DROP TABLE IF EXISTS `despacho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho` (
  `id_despacho` int(11) NOT NULL AUTO_INCREMENT,
  `id_manual` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `invalido` int(11) NOT NULL,
  PRIMARY KEY (`id_despacho`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho`
--

LOCK TABLES `despacho` WRITE;
/*!40000 ALTER TABLE `despacho` DISABLE KEYS */;
INSERT INTO `despacho` VALUES (50,6666,31666666,'En Revisión 1/2',1),(51,7788,31777777,'En Revisión 1/2',0),(52,7789,31777777,'Aprobado 2/2',0),(53,4566,31777777,'En Revisión 1/2',0),(54,4500,31777777,'Solicitud Finalizada (Ayuda Entregada)',0),(55,4533,31777777,'Aprobado 2/2',0),(56,12124354,1212,'Aprobado 2/2',0),(57,4555,31777777,'Aprobado 2/2',0);
/*!40000 ALTER TABLE `despacho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho_categoria`
--

DROP TABLE IF EXISTS `despacho_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_despacho` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `tipo_ayuda` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_despacho` (`id_despacho`),
  CONSTRAINT `despacho_categoria_ibfk_1` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_categoria`
--

LOCK TABLES `despacho_categoria` WRITE;
/*!40000 ALTER TABLE `despacho_categoria` DISABLE KEYS */;
INSERT INTO `despacho_categoria` VALUES (40,50,'Enseres','Quiero un despacho'),(41,51,'Medicamentos','Pastillas para dejar de querer comer helado'),(42,52,'Enseres','Necesito cocina y nevera última generación '),(43,53,'Económica','Necesito un Playstation 5 o 6'),(44,54,'Enseres','Necesito una mesa para la Playstation '),(45,55,'Medicamentos','Acetaminoeee'),(46,56,'Medicamentos','Quenecesitaba'),(47,57,'Medicamentos','I need Ice cream');
/*!40000 ALTER TABLE `despacho_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho_correo`
--

DROP TABLE IF EXISTS `despacho_correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho_correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_despacho` int(11) NOT NULL,
  `correo_enviado` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_despacho` (`id_despacho`),
  CONSTRAINT `despacho_correo_ibfk_1` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_correo`
--

LOCK TABLES `despacho_correo` WRITE;
/*!40000 ALTER TABLE `despacho_correo` DISABLE KEYS */;
INSERT INTO `despacho_correo` VALUES (32,50,0),(33,51,0),(34,52,0),(35,53,0),(36,54,0),(37,55,0),(38,56,0),(39,57,0);
/*!40000 ALTER TABLE `despacho_correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho_fecha`
--

DROP TABLE IF EXISTS `despacho_fecha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho_fecha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_despacho` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fecha_despacho` (`id_despacho`),
  CONSTRAINT `fk_fecha_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_fecha`
--

LOCK TABLES `despacho_fecha` WRITE;
/*!40000 ALTER TABLE `despacho_fecha` DISABLE KEYS */;
INSERT INTO `despacho_fecha` VALUES (47,50,'2025-11-19 13:47:30','2025-11-19 16:40:49','2025-11-19 13:47:30',0),(48,51,'2025-11-19 16:33:35','2025-11-19 16:33:35','2025-11-19 16:33:35',0),(49,52,'2025-11-19 16:40:32','2025-11-19 19:27:20','2025-11-19 16:40:32',0),(50,53,'2025-11-19 16:59:56','2025-11-19 16:59:56','2025-11-19 16:59:56',0),(51,54,'2025-11-19 17:02:13','2025-11-19 17:05:21','2025-11-19 17:02:13',0),(52,55,'2025-11-19 17:04:57','2025-11-19 19:16:49','2025-11-19 17:04:57',0),(53,56,'2025-11-19 19:17:12','2025-11-19 19:26:08','2025-11-19 19:17:12',0),(54,57,'2025-11-19 19:47:46','2025-11-19 19:58:10','2025-11-19 19:47:46',0);
/*!40000 ALTER TABLE `despacho_fecha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho_info`
--

DROP TABLE IF EXISTS `despacho_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_despacho` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creador` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_descripcion_despacho` (`id_despacho`),
  CONSTRAINT `fk_descripcion_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_info`
--

LOCK TABLES `despacho_info` WRITE;
/*!40000 ALTER TABLE `despacho_info` DISABLE KEYS */;
INSERT INTO `despacho_info` VALUES (49,50,'Quiero un despacho ','Admin Supremo'),(50,51,'4 cajas de pastillas ','Admin Supremo'),(51,52,'2 cocinas y 2 neveras','Admin Supremo'),(52,53,'2 Playstation 5 y 2 Playstation 6','Admin Supremo'),(53,54,'2 mesas','Admin Supremo'),(54,55,'Auriculares y sillas gamer','Admin Supremo'),(55,56,'Qweqwe','Admin Supremo'),(56,57,'Ice cream, Ice cream','Admin Supremo');
/*!40000 ALTER TABLE `despacho_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despacho_invalido`
--

DROP TABLE IF EXISTS `despacho_invalido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despacho_invalido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_despacho` int(11) NOT NULL,
  `razon` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invalido_despacho` (`id_despacho`),
  CONSTRAINT `fk_invalido_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_invalido`
--

LOCK TABLES `despacho_invalido` WRITE;
/*!40000 ALTER TABLE `despacho_invalido` DISABLE KEYS */;
INSERT INTO `despacho_invalido` VALUES (14,50,0);
/*!40000 ALTER TABLE `despacho_invalido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes_acciones`
--

DROP TABLE IF EXISTS `reportes_acciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportes_acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(255) NOT NULL,
  `ci` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_doc` (`id_doc`),
  KEY `ci` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes_acciones`
--

LOCK TABLES `reportes_acciones` WRITE;
/*!40000 ALTER TABLE `reportes_acciones` DISABLE KEYS */;
INSERT INTO `reportes_acciones` VALUES (1,56,'2025-11-19 19:25:09','Envió la solicitud a Administración. (Despacho)',3434),(2,56,'2025-11-19 19:25:10','Confirmó que se entregó la ayuda. (Despacho)',3434),(3,56,'2025-11-19 19:25:11','Reinició la solicitud. (Despacho)',3434),(4,8,'2025-11-19 19:25:33','Editó la solicitud (Desarrollo Social)',3434),(5,8,'2025-11-19 19:26:02','Aprobó la solicitud para su procedimiento. (Desarrollo Social)',3434),(6,56,'2025-11-19 19:26:08','Envió la solicitud a Administración. (Despacho)',3434),(7,52,'2025-11-19 19:27:20','Envió la solicitud a Administración. (Despacho)',3434),(8,12,'2025-11-19 19:37:07','Creó una nueva solicitud de ayuda (General).',3434),(9,9,'2025-11-19 19:45:03','Registró solicitud (Desarrollo Social)',3434),(10,9,'2025-11-19 19:45:59','Editó la solicitud (Desarrollo Social)',3434),(11,9,'2025-11-19 19:46:07','Aprobó la solicitud para su procedimiento. (Desarrollo Social)',3434),(12,57,'2025-11-19 19:47:46','Registró solicitud. (Despacho)',3434),(13,57,'2025-11-19 19:48:24','Envió la solicitud a Administración. (Despacho)',3434),(14,57,'2025-11-19 19:57:17','Editó la solicitud de Despacho',31),(15,57,'2025-11-19 19:58:10','Editó la solicitud (Despacho)',31);
/*!40000 ALTER TABLE `reportes_acciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes_entradas`
--

DROP TABLE IF EXISTS `reportes_entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportes_entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` int(11) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes_entradas`
--

LOCK TABLES `reportes_entradas` WRITE;
/*!40000 ALTER TABLE `reportes_entradas` DISABLE KEYS */;
INSERT INTO `reportes_entradas` VALUES (1,3434,'2025-09-04 12:26:12','2025-09-05 12:55:59'),(2,3434,'2025-09-05 12:56:05','2025-09-12 08:24:41'),(3,3434,'2025-09-12 08:25:59','2025-09-13 17:37:11'),(4,3434,'2025-09-13 17:37:17','2025-09-14 08:45:06'),(5,3434,'2025-09-14 08:45:13','2025-09-15 14:02:45'),(6,3434,'2025-09-15 14:02:54','2025-09-16 14:48:19'),(7,3434,'2025-09-16 14:48:25','2025-09-16 15:19:41'),(8,34,'2025-09-16 15:20:03','2025-09-16 15:29:29'),(9,123,'2025-09-16 15:29:40','2025-09-16 15:31:59'),(10,321,'2025-09-16 15:32:12','2025-09-16 15:36:54'),(11,3434,'2025-09-16 15:39:29','2025-09-16 15:40:27'),(12,123,'2025-09-16 15:40:38','2025-09-16 15:43:06'),(13,3434,'2025-09-16 15:43:37','2025-09-16 15:44:33'),(14,123,'2025-09-16 15:44:48','2025-09-16 15:47:03'),(15,3434,'2025-09-17 14:46:06','2025-09-17 14:57:31'),(16,3434,'2025-09-17 14:58:17','2025-09-17 14:58:23'),(17,3434,'2025-09-17 14:58:50','2025-09-17 14:59:06'),(18,3434,'2025-09-17 15:05:28','2025-09-17 15:05:32'),(19,3434,'2025-09-17 15:06:17','2025-09-17 15:06:22'),(20,3434,'2025-09-17 15:07:03','2025-09-17 15:07:08'),(21,3434,'2025-09-17 15:07:37','2025-09-17 15:10:03'),(22,3434,'2025-09-17 15:10:27','2025-09-17 15:10:32'),(23,3434,'2025-09-17 15:12:15','2025-09-17 15:12:30'),(24,3434,'2025-09-17 15:13:25','2025-09-17 15:13:29'),(25,3434,'2025-09-17 15:20:39','2025-09-18 15:44:49'),(26,3434,'2025-09-18 15:44:59','2025-09-20 14:20:35'),(27,3434,'2025-09-20 14:20:43','2025-09-20 14:24:00'),(28,34,'2025-09-20 14:24:19','2025-09-20 14:25:07'),(29,3434,'2025-09-20 14:25:19','2025-09-20 14:26:08'),(30,34,'2025-09-20 14:26:29','2025-09-20 14:27:37'),(31,123,'2025-09-20 14:27:55','2025-09-20 14:28:45'),(32,321,'2025-09-20 14:28:55','2025-09-20 14:30:10'),(33,3434,'2025-09-20 14:30:25','2025-09-20 16:07:06'),(34,123,'2025-09-20 16:09:04','2025-09-22 11:23:30'),(35,3434,'2025-09-22 11:22:27','2025-09-22 11:23:04'),(36,123,'2025-09-22 11:23:37','2025-09-22 11:42:34'),(37,3434,'2025-09-22 11:42:46','2025-09-22 11:43:42'),(38,123,'2025-09-22 11:43:54','2025-09-22 12:01:05'),(39,3434,'2025-09-23 10:02:58','2025-09-24 14:41:32'),(40,3434,'2025-09-24 14:41:39','2025-09-24 17:22:43'),(41,3434,'2025-09-25 12:04:13','2025-09-25 12:26:45'),(42,3434,'2025-09-25 12:40:21','2025-10-03 08:09:01'),(43,3434,'2025-10-03 08:09:08','2025-10-03 12:03:16'),(44,3434,'2025-10-03 12:03:22','2025-10-03 15:50:09'),(45,3434,'2025-10-03 15:50:16','2025-10-04 09:20:06'),(46,3434,'2025-10-04 09:20:14','2025-10-05 10:53:54'),(47,3434,'2025-10-05 10:54:01','2025-10-05 15:38:56'),(48,123,'2025-10-05 15:39:29','2025-10-06 10:38:56'),(49,3434,'2025-10-06 07:51:39','2025-10-06 10:38:11'),(50,123,'2025-10-06 10:39:04','2025-10-06 10:57:21'),(51,123,'2025-10-06 11:03:07','2025-10-06 11:03:13'),(52,123,'2025-10-06 11:03:25','2025-10-06 11:03:32'),(53,3434,'2025-10-07 07:30:03','2025-10-07 07:30:12'),(54,3434,'2025-10-07 07:30:19','2025-10-07 07:30:50'),(55,3434,'2025-10-08 11:29:02','2025-10-08 11:50:51'),(56,123,'2025-10-08 11:42:04','2025-10-08 11:56:37'),(57,123,'2025-10-08 11:54:59','2025-10-08 11:55:08'),(58,123,'2025-10-08 11:55:19','2025-10-08 11:55:28'),(59,3434,'2025-10-08 11:56:18','2025-10-08 11:59:47'),(60,3434,'2025-10-08 12:06:51','2025-10-08 12:31:01'),(61,3434,'2025-10-08 12:31:09','2025-10-08 12:31:19'),(62,3434,'2025-10-08 12:41:09','2025-10-08 14:06:08'),(63,3434,'2025-10-08 14:06:16','2025-10-08 14:06:23'),(64,3434,'2025-10-08 14:07:25','2025-10-08 14:07:33'),(65,3434,'2025-10-09 15:25:54','2025-10-09 15:26:01'),(66,3434,'2025-10-09 15:31:41','2025-10-09 15:31:51'),(67,3434,'2025-10-09 15:35:50','2025-10-09 15:38:49'),(68,123,'2025-10-09 15:39:01','2025-10-09 15:39:08'),(69,3434,'2025-10-09 15:39:19','2025-10-10 15:33:19'),(70,3434,'2025-10-10 15:33:27','2025-10-12 08:35:27'),(71,3434,'2025-10-12 08:35:36','2025-10-12 12:09:25'),(72,3434,'2025-10-12 12:09:37','2025-10-13 09:54:00'),(73,3434,'2025-10-13 09:54:06','2025-10-14 18:14:03'),(74,3434,'2025-10-14 18:21:47','2025-10-14 21:23:53'),(75,3434,'2025-10-15 08:18:45','2025-10-15 20:06:42'),(76,3434,'2025-10-15 20:14:26','2025-10-15 20:14:38'),(77,3434,'2025-10-16 08:44:31','2025-10-17 10:00:24'),(78,3434,'2025-10-17 10:00:35','2025-10-17 10:42:08'),(79,123,'2025-10-17 10:42:19','2025-10-17 10:48:43'),(80,3434,'2025-10-19 10:40:54','2025-10-20 09:58:05'),(81,3434,'2025-10-20 09:58:15','2025-10-21 09:45:03'),(82,3434,'2025-10-21 09:45:10','2025-10-22 08:22:55'),(83,3434,'2025-10-22 08:23:16','2025-10-22 15:50:48'),(84,3434,'2025-10-22 15:50:56','2025-10-23 08:53:54'),(85,3434,'2025-10-23 08:54:06','2025-10-25 09:05:35'),(86,3434,'2025-10-25 09:05:45','2025-10-25 09:59:30'),(87,3434,'2025-10-25 16:32:15','2025-10-26 11:07:20'),(88,3434,'2025-10-26 11:07:26','2025-10-26 20:08:54'),(89,3434,'2025-10-28 08:39:26','2025-10-29 09:35:31'),(90,3434,'2025-10-29 09:35:39','2025-10-29 14:14:13'),(91,3434,'2025-10-30 22:06:23','2025-10-30 22:06:45'),(92,3434,'2025-10-30 22:19:06','2025-10-30 22:20:41'),(93,34,'2025-10-30 22:20:54','2025-10-30 22:23:53'),(94,34,'2025-10-31 09:29:13','2025-10-31 09:52:53'),(95,321,'2025-10-31 09:54:09','2025-10-31 09:54:17'),(96,123,'2025-10-31 09:54:29','2025-10-31 09:55:09'),(97,123,'2025-10-31 11:31:06','2025-10-31 11:31:15'),(98,123,'2025-10-31 11:51:33','2025-10-31 11:51:37'),(99,123,'2025-10-31 11:51:42','2025-10-31 11:51:46'),(100,123,'2025-10-31 11:51:50','2025-10-31 11:51:54'),(101,123,'2025-10-31 11:51:58','2025-10-31 11:52:02'),(102,123,'2025-10-31 11:52:06','2025-10-31 11:52:11'),(103,123,'2025-10-31 11:52:15','2025-10-31 11:52:19'),(104,123,'2025-10-31 11:52:23','2025-10-31 11:52:27'),(105,123,'2025-10-31 11:52:31','2025-10-31 11:52:35'),(106,123,'2025-10-31 11:52:40','2025-10-31 11:53:57'),(107,123,'2025-10-31 11:54:11','2025-10-31 11:54:15'),(108,123,'2025-10-31 11:54:20','2025-10-31 11:54:24'),(109,123,'2025-10-31 11:54:28','2025-10-31 11:54:32'),(110,123,'2025-10-31 11:54:36','2025-10-31 11:54:40'),(111,123,'2025-10-31 11:54:45','2025-10-31 11:54:49'),(112,123,'2025-10-31 11:54:53','2025-10-31 11:54:57'),(113,123,'2025-10-31 11:58:02','2025-10-31 11:58:06'),(114,123,'2025-10-31 11:58:15','2025-10-31 12:16:07'),(115,34,'2025-10-31 11:59:59','2025-11-01 10:02:07'),(116,321,'2025-10-31 12:02:35','2025-10-31 12:45:36'),(117,123,'2025-10-31 12:16:23','2025-11-01 10:01:43'),(118,3434,'2025-10-31 12:37:55','2025-10-31 12:40:09'),(119,321,'2025-10-31 12:40:30','2025-10-31 12:45:25'),(120,3434,'2025-10-31 12:45:37','2025-11-01 09:59:40'),(121,321,'2025-10-31 12:46:04','2025-10-31 12:57:44'),(122,321,'2025-10-31 12:58:19','2025-11-01 10:42:43'),(123,3434,'2025-11-01 10:00:00','2025-11-01 10:01:17'),(124,123,'2025-11-01 10:01:53','2025-11-01 11:07:55'),(125,34,'2025-11-01 10:02:21','2025-11-01 10:42:28'),(126,321,'2025-11-01 10:42:53','2025-11-01 11:30:56'),(127,3434,'2025-11-01 11:26:43','2025-11-01 11:28:47'),(128,34,'2025-11-01 11:28:53','2025-11-01 11:30:47'),(129,3434,'2025-11-01 11:32:04','2025-11-01 11:34:39'),(130,34,'2025-11-01 11:38:51','2025-11-01 11:39:48'),(131,321,'2025-11-01 11:44:07','2025-11-01 11:45:12'),(132,34,'2025-11-01 21:05:55','2025-11-01 22:34:09'),(133,123,'2025-11-01 22:34:11','2025-11-01 22:47:24'),(134,321,'2025-11-01 22:47:30','2025-11-01 22:48:47'),(135,3434,'2025-11-01 22:48:50','2025-11-01 22:51:12'),(136,123,'2025-11-02 09:53:37','2025-11-02 09:55:08'),(137,3434,'2025-11-02 09:55:11','2025-11-02 09:55:17'),(138,3434,'2025-11-02 10:11:41','2025-11-02 11:07:59'),(139,123,'2025-11-02 11:08:34','2025-11-02 11:26:22'),(140,34,'2025-11-02 11:08:39','2025-11-02 11:09:24'),(141,321,'2025-11-02 11:09:25','2025-11-02 11:26:24'),(142,34,'2025-11-02 11:26:26','2025-11-02 12:01:54'),(143,123,'2025-11-02 11:26:28','2025-11-02 12:41:30'),(144,321,'2025-11-02 12:01:56','2025-11-02 12:42:28'),(145,3434,'2025-11-02 12:41:32','2025-11-02 21:47:24'),(146,34,'2025-11-02 12:42:31','2025-11-02 14:50:12'),(147,123,'2025-11-02 14:50:14','2025-11-02 14:50:43'),(148,321,'2025-11-02 14:50:45','2025-11-02 14:58:55'),(149,123,'2025-11-02 14:58:57','2025-11-02 15:04:18'),(150,321,'2025-11-02 15:04:20','2025-11-02 15:09:47'),(151,123,'2025-11-02 15:09:54','2025-11-02 15:09:56'),(152,34,'2025-11-02 15:17:19','2025-11-02 15:29:09'),(153,34,'2025-11-02 15:29:11','2025-11-02 21:47:39'),(154,34,'2025-11-02 21:47:46','2025-11-02 21:54:55'),(155,123,'2025-11-02 21:47:48','2025-11-02 21:59:01'),(156,321,'2025-11-02 21:54:57','2025-11-02 21:55:10'),(157,34,'2025-11-02 21:55:12','2025-11-02 21:55:43'),(158,321,'2025-11-02 21:55:49','2025-11-02 21:59:03'),(159,34,'2025-11-02 21:59:08','2025-11-02 21:59:40'),(160,3434,'2025-11-02 21:59:11','2025-11-02 21:59:32'),(161,3434,'2025-11-02 21:59:43','2025-11-02 22:15:05'),(162,3434,'2025-11-03 08:55:31','2025-11-03 15:53:05'),(163,34,'2025-11-03 15:53:24','2025-11-03 15:55:51'),(164,123,'2025-11-03 15:53:44','2025-11-03 15:56:25'),(165,321,'2025-11-03 15:55:53','2025-11-03 15:56:07'),(166,34,'2025-11-03 15:56:09','2025-11-03 15:56:17'),(167,123,'2025-11-03 15:56:22','2025-11-03 15:56:32'),(168,321,'2025-11-03 15:56:27','2025-11-03 16:06:51'),(169,123,'2025-11-03 15:56:40','2025-11-03 16:25:06'),(170,34,'2025-11-03 16:06:55','2025-11-03 16:07:50'),(171,321,'2025-11-03 16:08:00','2025-11-03 16:08:58'),(172,34,'2025-11-03 16:09:01','2025-11-03 16:12:09'),(173,321,'2025-11-03 16:12:11','2025-11-03 16:25:12'),(174,3434,'2025-11-03 16:25:09','2025-11-04 08:52:24'),(175,3434,'2025-11-04 08:52:27','2025-11-04 16:53:13'),(176,3434,'2025-11-04 16:53:15','2025-11-04 17:07:40'),(177,3434,'2025-11-04 17:07:46','2025-11-04 17:12:24'),(178,3434,'2025-11-04 20:24:43','2025-11-04 20:40:00'),(179,3434,'2025-11-04 20:40:03','2025-11-04 21:22:04'),(180,3434,'2025-11-04 21:22:24','2025-11-04 21:22:51'),(181,123,'2025-11-04 21:22:53','2025-11-04 21:23:01'),(182,123,'2025-11-04 21:23:18','2025-11-04 21:23:37'),(183,3434,'2025-11-05 09:30:29','2025-11-05 09:30:34'),(184,3434,'2025-11-05 09:30:36','2025-11-05 09:49:40'),(185,123,'2025-11-05 09:49:43','2025-11-05 09:50:10'),(186,3434,'2025-11-05 09:50:12','2025-11-05 12:05:54'),(187,123,'2025-11-06 14:55:01','2025-11-06 15:31:32'),(188,3434,'2025-11-06 15:31:41','2025-11-06 15:31:51'),(189,3434,'2025-11-06 15:31:55','2025-11-06 15:41:13'),(190,3434,'2025-11-06 15:41:29','2025-11-06 15:54:55'),(191,3434,'2025-11-06 15:54:58','2025-11-06 16:24:22'),(192,3434,'2025-11-06 16:28:41','2025-11-06 21:40:24'),(193,3434,'2025-11-06 21:40:26','2025-11-07 09:09:59'),(194,3434,'2025-11-07 09:10:02','2025-11-07 10:58:37'),(195,123,'2025-11-07 09:34:23','2025-11-07 10:58:27'),(196,3434,'2025-11-07 10:58:52','2025-11-07 12:45:32'),(197,3434,'2025-11-07 12:45:37','2025-11-07 16:21:27'),(198,3434,'2025-11-07 16:21:32','2025-11-07 21:32:47'),(199,3434,'2025-11-07 21:32:53','2025-11-07 21:32:58'),(200,3434,'2025-11-07 21:41:36','2025-11-07 21:41:41'),(201,3434,'2025-11-07 21:48:34','2025-11-07 21:49:12'),(202,3434,'2025-11-07 21:49:28','2025-11-07 21:54:19'),(203,3434,'2025-11-08 09:06:07','2025-11-08 11:22:44'),(204,3434,'2025-11-08 17:35:39','2025-11-08 21:47:15'),(205,3434,'2025-11-08 21:53:40','2025-11-08 22:07:17'),(206,3434,'2025-11-09 10:54:05','2025-11-09 18:52:36'),(207,3434,'2025-11-09 18:52:39','2025-11-09 18:52:42'),(208,3434,'2025-11-09 18:52:48','2025-11-09 18:52:58'),(209,3434,'2025-11-09 19:13:37','2025-11-09 20:01:33'),(210,3434,'2025-11-09 20:01:37','2025-11-09 20:03:26'),(211,3434,'2025-11-09 20:03:34','2025-11-09 20:04:02'),(212,3434,'2025-11-10 08:48:31','2025-11-11 09:55:24'),(213,3434,'2025-11-11 09:55:26','2025-11-11 10:27:56'),(214,3434,'2025-11-11 10:28:04','2025-11-11 11:04:08'),(215,3434,'2025-11-11 11:04:20','2025-11-11 11:05:14'),(216,3434,'2025-11-11 15:20:37','2025-11-11 15:22:00'),(217,3434,'2025-11-13 15:05:58','2025-11-13 15:07:29'),(218,34,'2025-11-13 15:07:32','2025-11-13 16:56:06'),(219,3434,'2025-11-13 16:56:08','2025-11-13 22:08:16'),(220,3434,'2025-11-14 08:07:12','2025-11-14 09:41:02'),(221,123,'2025-11-15 21:47:37','2025-11-15 21:47:40'),(222,3434,'2025-11-15 21:47:44','2025-11-15 22:41:55'),(223,3434,'2025-11-15 23:12:35','2025-11-15 23:51:21'),(224,3434,'2025-11-16 10:24:58','2025-11-16 11:14:33'),(225,23,'2025-11-16 11:14:52','2025-11-16 11:18:37'),(226,3434,'2025-11-16 11:18:39','2025-11-16 11:19:00'),(227,3434,'2025-11-16 11:19:02','2025-11-16 11:35:40'),(228,3434,'2025-11-16 18:36:05','2025-11-16 19:05:52'),(229,3434,'2025-11-16 19:05:58','2025-11-16 19:08:11'),(230,3434,'2025-11-16 19:09:05','2025-11-16 21:15:58'),(231,321,'2025-11-16 22:34:24','2025-11-16 22:34:39'),(232,123,'2025-11-16 22:34:44','2025-11-16 22:47:00'),(233,3434,'2025-11-16 22:47:03','2025-11-16 22:47:06'),(234,3434,'2025-11-17 18:04:06','2025-11-17 18:22:46'),(235,3434,'2025-11-17 18:48:04','2025-11-17 20:09:36'),(236,3434,'2025-11-18 12:18:46','2025-11-18 18:15:47'),(237,3434,'2025-11-18 20:36:06','2025-11-18 20:37:51'),(238,3434,'2025-11-18 20:38:21','2025-11-18 20:38:23'),(239,3434,'2025-11-18 21:33:00','2025-11-19 09:21:37'),(240,3434,'2025-11-19 09:21:39','2025-11-19 09:27:25'),(241,3434,'2025-11-19 09:27:27','2025-11-19 09:29:13'),(242,3434,'2025-11-19 10:55:27','2025-11-19 13:07:53'),(243,3434,'2025-11-19 13:08:04','2025-11-19 16:28:03'),(244,34,'2025-11-19 13:40:02','2025-11-19 13:40:26'),(245,123,'2025-11-19 13:40:30','2025-11-19 13:40:36'),(246,3434,'2025-11-19 16:28:10','2025-11-19 18:36:25'),(247,123,'2025-11-19 17:24:44','2025-11-19 17:24:47'),(248,34,'2025-11-19 17:24:50','2025-11-19 18:36:23'),(249,3434,'2025-11-19 18:36:27','2025-11-19 19:30:03'),(250,3434,'2025-11-19 19:24:16','2025-11-19 19:29:59'),(251,3434,'2025-11-19 19:30:05','0000-00-00 00:00:00'),(252,31,'2025-11-19 19:49:28','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `reportes_entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  `limite` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Promotor Social',1),(2,'Despacho',1),(3,'Administración',1),(4,'Administrador Principal',2);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes`
--

DROP TABLE IF EXISTS `solicitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes` (
  `id_solicitante` int(11) NOT NULL AUTO_INCREMENT,
  `ci` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id_solicitante`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes`
--

LOCK TABLES `solicitantes` WRITE;
/*!40000 ALTER TABLE `solicitantes` DISABLE KEYS */;
INSERT INTO `solicitantes` VALUES (7,3215,'Yorsh','Gonzalez','forell.music@gmail.com','2025-10-14 18:44:43'),(29,31628264,'Danielys','Rojas','danielysrojas@gmail.com','2025-11-02 21:52:05'),(34,31666666,'Abel','Tefolla','abeltesfayjfhhbafr@gmail.com','2025-11-13 18:09:46'),(35,30420669,'carlos','soteldo','carlossoteldo11@gmail.com','2025-11-17 19:22:35'),(36,31777777,'Abel','Tefolla','abeltefolla@gmail.com','0000-00-00 00:00:00'),(37,2222222,'Qwe','Erty','qweqwe@gmail.com','2025-11-19 19:15:18'),(38,2222,'Ssss','Saaaa','qweqwej@gmail.com','2025-11-19 19:16:13'),(39,1212,'Qwe','Qweeee','qweqwe@gmail.com','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `solicitantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_comunidad`
--

DROP TABLE IF EXISTS `solicitantes_comunidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_comunidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `comunidad` varchar(255) DEFAULT NULL,
  `direc_habita` varchar(255) DEFAULT NULL,
  `estruc_base` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_comunidad_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_comunidad`
--

LOCK TABLES `solicitantes_comunidad` WRITE;
/*!40000 ALTER TABLE `solicitantes_comunidad` DISABLE KEYS */;
INSERT INTO `solicitantes_comunidad` VALUES (6,7,'PALMICHAL','Carrera centro','Jefe de Comunidad'),(28,29,'JOSE GREGORIO AMAYA','Carrera 15 entre 14 y 16','Escuela'),(33,34,'EL PARAISO','14','Ninguno'),(34,35,'JOSE GREGORIO AMAYA','Casa mía','Ninguno'),(35,36,'ALDEA LA PAZ','Casa 1602','Ninguno'),(36,37,'ARENALES VIA EL SALTO','Qweqwe','Jefe de Calle'),(37,38,'BRISAS DE LA TAPA','Qweqweqwe',NULL),(38,39,'LA VICTORIA','Qweqweqwe',NULL);
/*!40000 ALTER TABLE `solicitantes_comunidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_conocimiento`
--

DROP TABLE IF EXISTS `solicitantes_conocimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_conocimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL,
  `nivel_instruc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_conocimiento_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_conocimiento`
--

LOCK TABLES `solicitantes_conocimiento` WRITE;
/*!40000 ALTER TABLE `solicitantes_conocimiento` DISABLE KEYS */;
INSERT INTO `solicitantes_conocimiento` VALUES (6,7,'Ingeniero','Primaria'),(25,29,'Ama de casa','Secundaria'),(30,34,'Musica','Universidad'),(31,35,'TSU Informática','Universidad'),(32,36,'Cantante ','Secundaria'),(33,37,'Qweqweqwe','Secundaria'),(34,38,NULL,NULL),(35,39,NULL,NULL);
/*!40000 ALTER TABLE `solicitantes_conocimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_extra`
--

DROP TABLE IF EXISTS `solicitantes_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `codigo_patria` varchar(255) DEFAULT NULL,
  `serial_patria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_extra_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_extra`
--

LOCK TABLES `solicitantes_extra` WRITE;
/*!40000 ALTER TABLE `solicitantes_extra` DISABLE KEYS */;
INSERT INTO `solicitantes_extra` VALUES (6,7,'321423','3213123'),(25,29,'3123123213','109238912389123'),(30,34,'787878','78655346175896906'),(31,35,'232323','232323'),(32,36,'12345678910','163789504826527384047262'),(33,37,'2323','2121212'),(34,38,NULL,NULL),(35,39,NULL,NULL);
/*!40000 ALTER TABLE `solicitantes_extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_info`
--

DROP TABLE IF EXISTS `solicitantes_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(255) DEFAULT NULL,
  `estado_civil` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_info_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_info`
--

LOCK TABLES `solicitantes_info` WRITE;
/*!40000 ALTER TABLE `solicitantes_info` DISABLE KEYS */;
INSERT INTO `solicitantes_info` VALUES (7,7,'2025-10-01','Hospital rafael rangel','Soltero/a','042323'),(16,29,'2004-11-05','Aroa','Casado/a','0414338556'),(21,34,'1985-02-14','Canada','Casado/a','04135667890'),(22,36,'1990-02-16','Canadá ','Casado/a','04145778899'),(23,37,'2025-11-12','Qweqwe','Casado/a','232323'),(24,38,NULL,NULL,NULL,'203203'),(25,39,NULL,NULL,NULL,'2323213');
/*!40000 ALTER TABLE `solicitantes_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_ingresos`
--

DROP TABLE IF EXISTS `solicitantes_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `nivel_ingreso` int(30) DEFAULT NULL,
  `pension` varchar(255) DEFAULT NULL,
  `bono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_ingresos_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_ingresos`
--

LOCK TABLES `solicitantes_ingresos` WRITE;
/*!40000 ALTER TABLE `solicitantes_ingresos` DISABLE KEYS */;
INSERT INTO `solicitantes_ingresos` VALUES (6,7,30000,'No','No'),(12,29,2000,'No','No'),(17,34,10000,'No','No'),(18,36,30000,'No','No'),(19,37,22,'Si','No'),(20,38,NULL,NULL,NULL),(21,39,NULL,NULL,NULL);
/*!40000 ALTER TABLE `solicitantes_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_patologia`
--

DROP TABLE IF EXISTS `solicitantes_patologia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_patologia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `tip_patologia` varchar(255) DEFAULT NULL,
  `nom_patologia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_patologia_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_patologia`
--

LOCK TABLES `solicitantes_patologia` WRITE;
/*!40000 ALTER TABLE `solicitantes_patologia` DISABLE KEYS */;
INSERT INTO `solicitantes_patologia` VALUES (38,29,'Hereditarias','Diabetes'),(39,29,'Hereditarias','Diabetes'),(40,29,'Hereditarias','Diabetes'),(41,29,'Hereditarias','Diabetes'),(42,29,'Hereditarias','Diabetes'),(56,7,'Hereditarias','Sisa'),(57,7,'Congénitas','Visual'),(58,37,'Congénitas','Miopia'),(59,37,'Atención primaria','Verga');
/*!40000 ALTER TABLE `solicitantes_patologia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_propiedad`
--

DROP TABLE IF EXISTS `solicitantes_propiedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_propiedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `propiedad` varchar(255) DEFAULT NULL,
  `propiedad_est` varchar(255) DEFAULT NULL,
  `observaciones_propiedad` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_propiedad_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_propiedad`
--

LOCK TABLES `solicitantes_propiedad` WRITE;
/*!40000 ALTER TABLE `solicitantes_propiedad` DISABLE KEYS */;
INSERT INTO `solicitantes_propiedad` VALUES (6,7,'Casa','Propia','Era observacion'),(12,29,'Casa','Propia','No escucha'),(17,34,'Casa','Propia','Kkkkk'),(18,36,'Otro','Propia','Canta bonito'),(19,37,'Apartamento','Prestada','Qweqwe'),(20,38,NULL,NULL,NULL),(21,39,NULL,NULL,NULL);
/*!40000 ALTER TABLE `solicitantes_propiedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantes_trabajo`
--

DROP TABLE IF EXISTS `solicitantes_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitantes_trabajo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitante` int(11) DEFAULT NULL,
  `trabajo` varchar(255) DEFAULT NULL,
  `direccion_trabajo` varchar(255) DEFAULT NULL,
  `trabaja_public` varchar(100) DEFAULT NULL,
  `nombre_insti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `solicitantes_trabajo_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_trabajo`
--

LOCK TABLES `solicitantes_trabajo` WRITE;
/*!40000 ALTER TABLE `solicitantes_trabajo` DISABLE KEYS */;
INSERT INTO `solicitantes_trabajo` VALUES (6,7,'No tiene','No','No','No'),(12,29,'Ama de casa','Sabanita','No','No'),(17,34,'Cantante','EEUU','No','No'),(18,36,'Cantante ','Hollywood ','No','No'),(19,37,'Qwqwe','Eee','Si','Qweqwe'),(20,38,NULL,NULL,NULL,NULL),(21,39,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `solicitantes_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_ayuda`
--

DROP TABLE IF EXISTS `solicitud_ayuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_ayuda` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_manual` varchar(50) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `invalido` int(11) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda`
--

LOCK TABLES `solicitud_ayuda` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda` DISABLE KEYS */;
INSERT INTO `solicitud_ayuda` VALUES (4,'000004578','31666666','En Proceso 3/3 (Sin entregar)',0),(5,'00004578','31666666','En espera del documento físico para ser procesado 0/3',0),(6,'00004579','31666666','En Proceso 3/3 (Sin entregar)',0),(7,'00004576','31666666','Solicitud Finalizada (Ayuda Entregada)',0),(8,'00004570','31666666','En Proceso 2/3',0),(9,'00004575','31666666','En espera del documento físico para ser procesado 0/3',0),(10,'00004574','31666666','Solicitud Finalizada (Ayuda Entregada)',0),(11,'121222333','2222222','En espera del documento físico para ser procesado 0/3',0),(12,'00004522','31777777','En espera del documento físico para ser procesado 0/3',0);
/*!40000 ALTER TABLE `solicitud_ayuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_ayuda_correo`
--

DROP TABLE IF EXISTS `solicitud_ayuda_correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_ayuda_correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `correo_enviado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_correo_doc` (`id_doc`),
  CONSTRAINT `fk_correo_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda_correo`
--

LOCK TABLES `solicitud_ayuda_correo` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda_correo` DISABLE KEYS */;
INSERT INTO `solicitud_ayuda_correo` VALUES (61,4,0),(62,5,0),(63,6,0),(64,7,0),(65,8,0),(66,9,0),(67,10,0),(68,11,0),(69,12,0);
/*!40000 ALTER TABLE `solicitud_ayuda_correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_ayuda_fecha`
--

DROP TABLE IF EXISTS `solicitud_ayuda_fecha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_ayuda_fecha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fecha_doc` (`id_doc`),
  CONSTRAINT `fk_fecha_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda_fecha`
--

LOCK TABLES `solicitud_ayuda_fecha` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda_fecha` DISABLE KEYS */;
INSERT INTO `solicitud_ayuda_fecha` VALUES (57,4,'2025-11-19 13:13:50','2025-11-19 13:38:16','2025-11-19 13:13:50',0),(58,5,'2025-11-19 13:15:48','2025-11-19 18:37:49','2025-11-19 13:15:48',0),(59,6,'2025-11-19 13:18:54','2025-11-19 16:52:20','2025-11-19 13:18:54',0),(60,7,'2025-11-19 13:25:41','2025-11-19 13:45:14','2025-11-19 13:25:41',0),(61,8,'2025-11-19 13:27:37','2025-11-19 13:45:30','2025-11-19 13:27:37',0),(62,9,'2025-11-19 13:28:51','2025-11-19 18:42:12','2025-11-19 13:28:51',0),(63,10,'2025-11-19 13:30:11','2025-11-19 13:37:18','2025-11-19 13:30:11',0),(64,11,'2025-11-19 19:15:18','2025-11-19 19:15:32','2025-11-19 19:15:18',0),(65,12,'2025-11-19 19:37:07','2025-11-19 19:37:07','2025-11-19 19:37:07',0);
/*!40000 ALTER TABLE `solicitud_ayuda_fecha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_ayuda_invalido`
--

DROP TABLE IF EXISTS `solicitud_ayuda_invalido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_ayuda_invalido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `razon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invalido_doc` (`id_doc`),
  CONSTRAINT `fk_invalido_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda_invalido`
--

LOCK TABLES `solicitud_ayuda_invalido` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda_invalido` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_ayuda_invalido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_categoria`
--

DROP TABLE IF EXISTS `solicitud_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `tipo_ayuda` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_doc` (`id_doc`),
  CONSTRAINT `fk_categoria_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_categoria`
--

LOCK TABLES `solicitud_categoria` WRITE;
/*!40000 ALTER TABLE `solicitud_categoria` DISABLE KEYS */;
INSERT INTO `solicitud_categoria` VALUES (61,4,'10mil$','Económica'),(62,5,'antrax','Medicamentos'),(63,6,'Rodillanew','Medicamentos'),(64,7,'Andadera','Ayudas Técnicas'),(65,8,'Sangre de pendejo','Laboratorio'),(66,9,'Sass','Enseres'),(67,10,'Excitación ','Medicamentos'),(68,11,'Holaaa','Enseres'),(69,12,'Quiero una PC','Económica');
/*!40000 ALTER TABLE `solicitud_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo`
--

DROP TABLE IF EXISTS `solicitud_desarrollo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo` (
  `id_des` int(11) NOT NULL AUTO_INCREMENT,
  `id_manual` varchar(50) DEFAULT NULL,
  `ci` int(50) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `invalido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_des`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo`
--

LOCK TABLES `solicitud_desarrollo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo` VALUES (3,'00004573',31666666,'En espera del documento físico para ser procesado 0/2',0),(4,'00007786',31777777,'En espera del documento físico para ser procesado 0/2',1),(5,'00007785',31777777,'Solicitud Finalizada (Ayuda Entregada)',0),(6,'00004511',31777777,'En Proceso 2/2 (Sin entregar)',0),(7,'00004533',31777777,'En Proceso 1/2',0),(8,'221121212',2222,'En Proceso 1/2',0),(9,'00004500',31777777,'En Proceso 1/2',0);
/*!40000 ALTER TABLE `solicitud_desarrollo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_correo`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) NOT NULL,
  `correo_enviado` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_correo_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_correo`
--

LOCK TABLES `solicitud_desarrollo_correo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_correo` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_correo` VALUES (37,3,0),(38,4,0),(39,5,0),(40,6,0),(41,7,0),(42,8,0),(43,9,0);
/*!40000 ALTER TABLE `solicitud_desarrollo_correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_fecha`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_fecha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_fecha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_fecha_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_fecha`
--

LOCK TABLES `solicitud_desarrollo_fecha` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_fecha` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_fecha` VALUES (43,3,'2025-11-19 13:31:10','2025-11-19 18:01:10','2025-11-19 13:31:10',0),(44,4,'2025-11-19 16:43:32','2025-11-19 16:43:32','2025-11-19 16:43:32',0),(45,5,'2025-11-19 16:44:28','2025-11-19 18:35:55','2025-11-19 16:44:28',0),(46,6,'2025-11-19 17:15:36','2025-11-19 17:17:07','2025-11-19 17:15:36',0),(47,7,'2025-11-19 17:16:48','2025-11-19 17:16:59','2025-11-19 17:16:48',0),(48,8,'2025-11-19 19:16:13','2025-11-19 19:26:02','2025-11-19 19:16:13',0),(49,9,'2025-11-19 19:45:03','2025-11-19 19:46:07','2025-11-19 19:45:03',0);
/*!40000 ALTER TABLE `solicitud_desarrollo_fecha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_info`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `creador` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_info_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_info`
--

LOCK TABLES `solicitud_desarrollo_info` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_info` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_info` VALUES (45,3,'Necesito ver porque me da tanta hambre , tengo mucha hambre ','Admin Supremo'),(46,4,'Gato Esfinge ','Admin Supremo'),(47,5,'Gato Esfinge ','Admin Supremo'),(48,6,'Es que comí mucho helado y me hizo daño ','Admin Supremo'),(49,7,'Estamos joya','Admin Supremo'),(50,8,'Qweqwe','Admin Supremo'),(51,9,'No sé que tengo. Ah ya me acordé, no, no sé ','Admin Supremo');
/*!40000 ALTER TABLE `solicitud_desarrollo_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_invalido`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_invalido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_invalido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) DEFAULT NULL,
  `razon` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_invalido_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_invalido`
--

LOCK TABLES `solicitud_desarrollo_invalido` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_invalido` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_invalido` VALUES (5,4,'Cállese señora ');
/*!40000 ALTER TABLE `solicitud_desarrollo_invalido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_laboratorio`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) DEFAULT NULL,
  `examen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_laboratorio_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_laboratorio`
--

LOCK TABLES `solicitud_desarrollo_laboratorio` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_laboratorio` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_laboratorio` VALUES (64,4,'Quiero un gato Esfinge'),(66,6,'Heces'),(67,7,'Hematología Completa'),(68,7,'Glicemia'),(69,7,'Orina'),(70,7,'Heces'),(71,3,'Ecosonograma'),(79,5,'Acetaminofén'),(82,8,'Seeee'),(84,9,'Eco-Doppler');
/*!40000 ALTER TABLE `solicitud_desarrollo_laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_desarrollo_tipo`
--

DROP TABLE IF EXISTS `solicitud_desarrollo_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_desarrollo_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_des` int(11) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_des` (`id_des`),
  CONSTRAINT `solicitud_desarrollo_tipo_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_tipo`
--

LOCK TABLES `solicitud_desarrollo_tipo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_tipo` DISABLE KEYS */;
INSERT INTO `solicitud_desarrollo_tipo` VALUES (45,3,'Laboratorio'),(46,4,'Medicamentos'),(47,5,'Medicamentos'),(48,6,'Laboratorio'),(49,7,'Laboratorio'),(50,8,'Medicamentos'),(51,9,'Laboratorio');
/*!40000 ALTER TABLE `solicitud_desarrollo_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_descripcion`
--

DROP TABLE IF EXISTS `solicitud_descripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_descripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `promotor` varchar(255) NOT NULL,
  `observaciones` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_descripcion_doc` (`id_doc`),
  CONSTRAINT `fk_descripcion_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_descripcion`
--

LOCK TABLES `solicitud_descripcion` WRITE;
/*!40000 ALTER TABLE `solicitud_descripcion` DISABLE KEYS */;
INSERT INTO `solicitud_descripcion` VALUES (60,4,'Necesito 10mil$ para comprar helado','Admin Supremo','Quiero helados '),(61,5,'Quiero un unicornio verde con puntos rosas que cague helado ','Admin Supremo','Quiero helados '),(62,6,'Necesito una rodilla nueva','Admin Supremo','Mi rodilla ya no funciona, ayuda porfavor '),(63,7,'Necesito una espalda nueva','Admin Supremo','Mi espalda no funciona '),(64,8,'Exámen de Sangre para ver mi nivel de pendejo','Admin Supremo','Urgente '),(65,9,'Quiero un mueble ','Admin Supremo','Retirando'),(66,10,'Mis pastillas para la excitación ','Admin Supremo','Pastillas, urgente '),(67,11,'Qweqwe','Admin Supremo','Aaaa'),(68,12,'Ayuda para comprar PC gamer','Admin Supremo','El cliente quiere PC');
/*!40000 ALTER TABLE `solicitud_descripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `ci` int(11) NOT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `sesion` varchar(20) NOT NULL,
  `especial` int(11) NOT NULL,
  PRIMARY KEY (`ci`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (31,'$2y$10$U51jryZXzaRt0I/Wa4zNbuCyJQaJnb.cJCpEORB5UpdvWxnfVIvli',4,'True',0),(34,'$2y$10$B3B3.eLTtqT.iJcPnh/m4.uSJ7M7j3tKvcLZii.D3B9BI5lgp2CwW',1,'False',0),(123,'$2y$10$EUbg2UC5PG3DD2IUBrCf7OrQE.8AYST9kKAPP5MqmTU.9feSrr6Cm',2,'False',0),(321,'$2y$10$jWQ6k/MYWbbePwLlAFVYDOcRgOY89kvbDogG4Cb0/ociZ1UfrvKby',3,'False',0),(3434,'$2y$10$ju0SJ2NyR9WMKR9.DDr2I.z0nBZ.4CfyXUBLbLUBiUQf3phYwmFne',4,'True',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_info`
--

DROP TABLE IF EXISTS `usuarios_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci` (`ci`),
  CONSTRAINT `usuarios_info_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `usuarios` (`ci`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_info`
--

LOCK TABLES `usuarios_info` WRITE;
/*!40000 ALTER TABLE `usuarios_info` DISABLE KEYS */;
INSERT INTO `usuarios_info` VALUES (5,123,'pepe','gonzalez',''),(6,34,'promotor','socio',''),(9,3434,'Admin','Supremo','forell.music@gmail.com'),(17,321,'administracion','administracion2','administracion@gmail.com'),(18,31,'Abel','Tefolla ','abeltefolla@gmail.com');
/*!40000 ALTER TABLE `usuarios_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_recuperacion`
--

DROP TABLE IF EXISTS `usuarios_recuperacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_recuperacion` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ci` int(30) NOT NULL,
  `codigo` int(40) NOT NULL,
  `intentos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_recuperacion`
--

LOCK TABLES `usuarios_recuperacion` WRITE;
/*!40000 ALTER TABLE `usuarios_recuperacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_recuperacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-19 20:00:24
