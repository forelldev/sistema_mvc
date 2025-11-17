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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho`
--

LOCK TABLES `despacho` WRITE;
/*!40000 ALTER TABLE `despacho` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_categoria`
--

LOCK TABLES `despacho_categoria` WRITE;
/*!40000 ALTER TABLE `despacho_categoria` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_correo`
--

LOCK TABLES `despacho_correo` WRITE;
/*!40000 ALTER TABLE `despacho_correo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_fecha`
--

LOCK TABLES `despacho_fecha` WRITE;
/*!40000 ALTER TABLE `despacho_fecha` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_info`
--

LOCK TABLES `despacho_info` WRITE;
/*!40000 ALTER TABLE `despacho_info` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despacho_invalido`
--

LOCK TABLES `despacho_invalido` WRITE;
/*!40000 ALTER TABLE `despacho_invalido` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes_acciones`
--

LOCK TABLES `reportes_acciones` WRITE;
/*!40000 ALTER TABLE `reportes_acciones` DISABLE KEYS */;
INSERT INTO `reportes_acciones` VALUES (215,31,'2025-11-02 14:49:10','Creó una nueva solicitud de ayuda (General).',34),(216,31,'2025-11-02 14:49:28','Hizo click sobre la notificación. (Marcó visto, solicitud general)',34),(217,31,'2025-11-02 14:49:48','Recibió documento físico, y aprobó para su procedimiento. (General)',34),(218,31,'2025-11-02 14:49:54','Envió la solicitud a despacho. (General)',34),(219,31,'2025-11-02 14:50:16','Hizo click sobre la notificación. (Marcó visto, solicitud general)',123),(220,31,'2025-11-02 14:50:35','Envió la solicitud a administración. (General)',123),(221,31,'2025-11-02 14:50:47','Hizo click sobre la notificación. (Marcó visto, solicitud general)',321),(222,31,'2025-11-02 14:50:58','Confirmó que se entregó la ayuda. (General)',321),(223,28,'2025-11-02 14:59:09','Registró solicitud. (Despacho)',123),(224,28,'2025-11-02 14:59:25','Hizo click sobre la notificación. (Marcó visto, solicitud de despacho)',123),(225,29,'2025-11-02 15:03:40','Registró solicitud. (Despacho)',123),(226,29,'2025-11-02 15:03:50','Hizo click sobre la notificación, marcó visto (Despacho)',123),(227,29,'2025-11-02 15:03:57','Envió la solicitud a Administración. (Despacho)',123),(228,29,'2025-11-02 15:04:22','Hizo click sobre la notificación, marcó visto (Despacho)',321),(229,29,'2025-11-02 15:04:26','Confirmó que se entregó la ayuda. (Despacho)',321),(231,29,'2025-11-02 15:29:29','Registró solicitud (Desarrollo)',34),(232,29,'2025-11-02 15:30:36','Aprobó la solicitud para su procedimiento. (Desarrollo)',34),(233,29,'2025-11-02 15:30:40','Envió la solicitud a Administración. (Desarrollo)',34),(234,29,'2025-11-02 15:30:44','Confirmó que se entregó la ayuda. (Desarrollo)',34),(236,29,'2025-11-02 15:31:38','Envió la solicitud a Administración. (Desarrollo)',34),(237,29,'2025-11-02 15:31:39','Confirmó que se entregó la ayuda. (Desarrollo)',34),(238,29,'2025-11-02 15:31:41','Reinició la solicitud. (Desarrollo)',34),(239,30,'2025-11-02 17:59:31','Registró solicitud. (Despacho)',3434),(240,31,'2025-11-02 18:20:52','Registró solicitud. (Despacho)',3434),(241,32,'2025-11-02 18:24:51','Registró solicitud. (Despacho)',3434),(242,33,'2025-11-02 18:34:29','Registró solicitud. (Despacho)',3434),(243,34,'2025-11-02 18:39:14','Registró solicitud. (Despacho)',3434),(244,38,'2025-11-02 18:52:00','Registró solicitud. (Despacho)',3434),(245,39,'2025-11-02 18:52:32','Registró solicitud. (Despacho)',3434),(246,40,'2025-11-02 19:14:46','Registró solicitud. (Despacho)',3434),(247,30,'2025-11-02 21:38:39','Registró solicitud (Desarrollo)',3434),(248,32,'2025-11-02 21:52:06','Creó una nueva solicitud de ayuda (General).',34),(249,32,'2025-11-02 21:52:31','Hizo click sobre la notificación, marcó visto (General)',34),(250,32,'2025-11-02 21:54:18','Recibió documento físico, y aprobó para su procedimiento. (General)',34),(251,32,'2025-11-02 21:54:26','Hizo click sobre la notificación, marcó visto (General)',34),(252,32,'2025-11-02 21:54:28','Envió la solicitud a despacho. (General)',34),(253,32,'2025-11-02 21:54:36','Hizo click sobre la notificación, marcó visto (General)',123),(254,32,'2025-11-02 21:54:47','Envió la solicitud a administración. (General)',123),(255,32,'2025-11-02 21:54:59','Hizo click sobre la notificación, marcó visto (General)',321),(256,32,'2025-11-02 21:55:01','Confirmó que se entregó la ayuda. (General)',321),(257,41,'2025-11-02 21:56:29','Registró solicitud. (Despacho)',123),(258,41,'2025-11-02 21:56:48','Hizo click sobre la notificación, marcó visto (Despacho)',123),(259,41,'2025-11-02 21:56:52','Envió la solicitud a Administración. (Despacho)',123),(260,41,'2025-11-02 21:56:55','Hizo click sobre la notificación, marcó visto (Despacho)',321),(261,41,'2025-11-02 21:56:57','Confirmó que se entregó la ayuda. (Despacho)',321),(262,41,'2025-11-02 21:57:03','Hizo click sobre la notificación, marcó visto (Despacho)',123),(263,32,'2025-11-02 21:59:21','Hizo click sobre la notificación, marcó visto (General)',34),(264,32,'2025-11-03 08:55:40','Reinició el proceso de la solicitud. (General)',3434),(265,33,'2025-11-03 10:29:17','Creó una nueva solicitud de ayuda (General).',3434),(266,33,'2025-11-03 10:45:06','Editó la solicitud (General)',3434),(267,33,'2025-11-03 10:45:45','Editó la solicitud (General)',3434),(268,33,'2025-11-03 10:48:24','Editó la solicitud (General)',3434),(269,33,'2025-11-03 10:49:56','Inhabilitó la solicitud razón: porque la quiero inhabilitada, simplemente eso (General)',3434),(270,33,'2025-11-03 10:50:08','Editó la solicitud (General)',3434),(271,33,'2025-11-03 10:50:13','Habilitó la solicitud (General)',3434),(272,33,'2025-11-03 10:50:19','Inhabilitó la solicitud razón: porq si (General)',3434),(273,33,'2025-11-03 10:50:26','Habilitó la solicitud (General)',3434),(274,31,'2025-11-03 10:53:50','Registró solicitud (Desarrollo)',3434),(275,32,'2025-11-03 10:54:28','Registró solicitud (Desarrollo)',3434),(276,33,'2025-11-03 10:54:49','Registró solicitud (Desarrollo)',3434),(277,33,'2025-11-03 11:27:39','Editó la solicitud (Desarrollo)',3434),(278,33,'2025-11-03 11:27:45','Editó la solicitud (Desarrollo)',3434),(279,33,'2025-11-03 11:27:49','Editó la solicitud (Desarrollo)',3434),(280,33,'2025-11-03 11:31:15','Editó la solicitud (Desarrollo)',3434),(281,33,'2025-11-03 11:31:21','Editó la solicitud (Desarrollo)',3434),(282,33,'2025-11-03 11:34:35','Editó la solicitud (Desarrollo)',3434),(283,33,'2025-11-03 11:35:02','Editó la solicitud (Desarrollo)',3434),(284,33,'2025-11-03 11:35:08','Editó la solicitud (Desarrollo)',3434),(285,33,'2025-11-03 11:35:15','Editó la solicitud (Desarrollo)',3434),(286,40,'2025-11-03 12:09:22','Editó la solicitud de Despacho',3434),(287,41,'2025-11-03 12:09:35','Editó la solicitud de Despacho',3434),(288,41,'2025-11-03 12:10:33','Editó la solicitud de Despacho',3434),(289,41,'2025-11-03 12:13:29','Editó la solicitud de Despacho',3434),(290,33,'2025-11-03 14:24:55','Inhabilitó la solicitud razón: sss (General)',3434),(291,33,'2025-11-03 14:25:06','Inhabilitó la solicitud razón: pq si (Desarrollo)',3434),(292,33,'2025-11-03 14:25:15','Habilitó la solicitud. (Desarrollo)',3434),(293,41,'2025-11-03 15:06:06','Inhabilitó la solicitud razón: qweq (Despacho)',3434),(294,41,'2025-11-03 15:42:01','Habilitó la solicitud (Despacho)',3434),(295,40,'2025-11-03 15:42:18','Inhabilitó la solicitud razón: sd (Despacho)',3434),(296,40,'2025-11-03 15:42:37','Habilitó la solicitud (Despacho)',3434),(297,41,'2025-11-03 15:42:45','Inhabilitó la solicitud razón: como (Despacho)',3434),(298,41,'2025-11-03 15:43:07','Habilitó la solicitud (Despacho)',3434),(299,34,'2025-11-03 15:55:10','Creó una nueva solicitud de ayuda (General).',34),(300,34,'2025-11-03 15:55:29','Recibió documento físico, y aprobó para su procedimiento. (General)',34),(301,34,'2025-11-03 15:55:34','Envió la solicitud a despacho. (General)',34),(302,34,'2025-11-03 15:55:38','Hizo click sobre la notificación, marcó visto (General)',123),(303,34,'2025-11-03 15:55:46','Envió la solicitud a administración. (General)',123),(304,34,'2025-11-03 15:55:55','Hizo click sobre la notificación, marcó visto (General)',321),(305,34,'2025-11-03 15:56:01','Confirmó que se entregó la ayuda. (General)',321),(306,42,'2025-11-03 15:59:42','Registró solicitud. (Despacho)',123),(307,42,'2025-11-03 15:59:59','Hizo click sobre la notificación, marcó visto (Despacho)',123),(308,42,'2025-11-03 16:00:01','Envió la solicitud a Administración. (Despacho)',123),(309,42,'2025-11-03 16:00:07','Hizo click sobre la notificación, marcó visto (Despacho)',321),(310,42,'2025-11-03 16:00:15','Confirmó que se entregó la ayuda. (Despacho)',321),(311,42,'2025-11-03 16:00:26','Hizo click sobre la notificación, marcó visto (Despacho)',123),(312,35,'2025-11-03 16:07:16','Creó una nueva solicitud de ayuda (General).',34),(313,43,'2025-11-03 16:08:49','Registró solicitud. (Despacho)',123),(314,36,'2025-11-03 16:11:14','Creó una nueva solicitud de ayuda (General).',34),(315,44,'2025-11-03 16:12:47','Registró solicitud. (Despacho)',123),(316,44,'2025-11-03 16:13:07','Editó la solicitud de Despacho',123),(317,44,'2025-11-03 16:13:17','Editó la solicitud de Despacho',123),(318,44,'2025-11-03 16:13:19','Envió la solicitud a Administración. (Despacho)',123),(319,44,'2025-11-03 16:13:42','Hizo click sobre la notificación, marcó visto (Despacho)',321),(320,44,'2025-11-03 16:13:46','Confirmó que se entregó la ayuda. (Despacho)',321),(321,43,'2025-11-03 16:13:56','Hizo click sobre la notificación, marcó visto (Despacho)',123),(322,43,'2025-11-03 16:13:57','Envió la solicitud a Administración. (Despacho)',123),(323,43,'2025-11-03 16:14:02','Confirmó que se entregó la ayuda. (Despacho)',321),(324,41,'2025-11-03 16:14:22','Envió la solicitud a Administración. (Despacho)',123),(325,41,'2025-11-03 16:14:29','Confirmó que se entregó la ayuda. (Despacho)',321),(326,31,'2025-11-03 16:15:00','Envió la solicitud a Administración. (Despacho)',123),(327,31,'2025-11-03 16:15:06','Hizo click sobre la notificación, marcó visto (Despacho)',321),(328,31,'2025-11-03 16:15:07','Confirmó que se entregó la ayuda. (Despacho)',321),(329,44,'2025-11-03 16:17:03','Hizo click sobre la notificación, marcó visto (Despacho)',123),(330,43,'2025-11-03 16:17:07','Hizo click sobre la notificación, marcó visto (Despacho)',123),(331,41,'2025-11-03 16:17:09','Hizo click sobre la notificación, marcó visto (Despacho)',123),(332,31,'2025-11-07 14:59:10','Reinició el proceso de la solicitud. (General)',3434),(333,31,'2025-11-07 14:59:23','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(334,31,'2025-11-07 14:59:27','Envió la solicitud a despacho. (General)',3434),(335,31,'2025-11-07 14:59:29','Envió la solicitud a administración. (General)',3434),(336,31,'2025-11-07 14:59:32','Confirmó que se entregó la ayuda. (General)',3434),(337,31,'2025-11-07 16:02:38','Reinició el proceso de la solicitud. (General)',3434),(338,31,'2025-11-07 16:02:40','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(339,31,'2025-11-07 16:02:41','Envió la solicitud a despacho. (General)',3434),(340,31,'2025-11-07 16:02:43','Envió la solicitud a administración. (General)',3434),(341,31,'2025-11-07 16:02:45','Confirmó que se entregó la ayuda. (General)',3434),(342,34,'2025-11-07 16:03:15','Reinició el proceso de la solicitud. (General)',3434),(343,35,'2025-11-07 16:04:34','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(344,35,'2025-11-07 16:04:37','Envió la solicitud a despacho. (General)',3434),(345,35,'2025-11-07 16:04:39','Envió la solicitud a administración. (General)',3434),(346,35,'2025-11-07 16:04:41','Confirmó que se entregó la ayuda. (General)',3434),(347,35,'2025-11-07 16:04:43','Reinició el proceso de la solicitud. (General)',3434),(348,32,'2025-11-07 16:25:07','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(349,32,'2025-11-07 16:25:18','Envió la solicitud a despacho. (General)',3434),(350,32,'2025-11-07 16:25:34','Envió la solicitud a administración. (General)',3434),(351,37,'2025-11-08 10:46:01','Creó una nueva solicitud de ayuda (General).',3434),(352,31,'2025-11-08 20:44:47','Reinició el proceso de la solicitud. (General)',3434),(353,37,'2025-11-09 10:57:00','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(354,37,'2025-11-09 10:57:02','Envió la solicitud a despacho. (General)',3434),(355,37,'2025-11-09 10:57:04','Envió la solicitud a administración. (General)',3434),(356,37,'2025-11-09 10:57:07','Confirmó que se entregó la ayuda. (General)',3434),(357,37,'2025-11-09 10:57:09','Reinició el proceso de la solicitud. (General)',3434),(358,36,'2025-11-09 14:54:50','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(359,37,'2025-11-10 09:00:02','Inhabilitó la solicitud razón: porq si (General)',3434),(360,37,'2025-11-10 09:01:24','Habilitó la solicitud (General)',3434),(361,37,'2025-11-10 09:02:09','Inhabilitó la solicitud razón: soic (General)',3434),(362,37,'2025-11-10 09:02:33','Habilitó la solicitud (General)',3434),(363,36,'2025-11-10 09:02:38','Inhabilitó la solicitud razón: se (General)',3434),(364,36,'2025-11-10 09:02:45','Habilitó la solicitud (General)',3434),(365,36,'2025-11-10 09:03:24','Inhabilitó la solicitud razón: e (General)',3434),(366,36,'2025-11-10 09:03:25','Habilitó la solicitud (General)',3434),(367,31,'2025-11-10 09:03:50','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(368,33,'2025-11-10 09:52:18','Aprobó la solicitud para su procedimiento. (Desarrollo)',3434),(369,33,'2025-11-10 09:52:21','Envió la solicitud a Administración. (Desarrollo)',3434),(370,33,'2025-11-10 09:52:22','Confirmó que se entregó la ayuda. (Desarrollo)',3434),(371,33,'2025-11-10 09:52:24','Reinició la solicitud. (Desarrollo)',3434),(372,34,'2025-11-10 10:38:22','Registró solicitud (Desarrollo)',3434),(373,28,'2025-11-10 10:50:34','Aprobó la solicitud para su procedimiento. (Desarrollo)',3434),(374,30,'2025-11-10 11:09:25','Inhabilitó la solicitud razón: pqsi (Desarrollo)',3434),(375,30,'2025-11-10 11:09:29','Habilitó la solicitud. (Desarrollo)',3434),(376,45,'2025-11-10 12:07:14','Registró solicitud. (Despacho)',3434),(377,45,'2025-11-10 12:57:09','Inhabilitó la solicitud razón: porq si (Despacho)',3434),(378,45,'2025-11-10 12:57:16','Habilitó la solicitud (Despacho)',3434),(379,37,'2025-11-11 09:57:47','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(380,38,'2025-11-11 10:29:21','Creó una nueva solicitud de ayuda (General).',3434),(381,39,'2025-11-11 10:30:14','Creó una nueva solicitud de ayuda (General).',3434),(382,35,'2025-11-13 15:07:12','Registró solicitud (Desarrollo)',3434),(383,35,'2025-11-13 15:34:22','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(384,35,'2025-11-13 15:48:03','Editó la solicitud (Desarrollo)',34),(385,36,'2025-11-13 15:59:01','Registró solicitud (Desarrollo)',34),(386,33,'2025-11-13 16:03:36','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(387,28,'2025-11-13 16:07:32','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(388,31,'2025-11-13 16:08:52','Hizo click sobre la notificación, marcó visto (General)',34),(389,34,'2025-11-13 16:24:01','Hizo click sobre la notificación, marcó visto (General)',34),(390,37,'2025-11-13 16:24:40','Hizo click sobre la notificación, marcó visto (General)',34),(391,37,'2025-11-13 16:26:03','Registró solicitud (Desarrollo)',34),(392,36,'2025-11-13 16:31:00','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(393,34,'2025-11-13 16:31:06','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(394,34,'2025-11-13 16:36:21','Aprobó la solicitud para su procedimiento. (Desarrollo)',34),(395,34,'2025-11-13 16:36:30','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(396,34,'2025-11-13 16:36:34','Envió la solicitud a Administración. (Desarrollo)',34),(397,34,'2025-11-13 16:36:36','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(398,34,'2025-11-13 16:36:40','Confirmó que se entregó la ayuda. (Desarrollo)',34),(399,34,'2025-11-13 16:36:41','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(400,36,'2025-11-13 16:45:28','Aprobó la solicitud para su procedimiento. (Desarrollo)',34),(401,36,'2025-11-13 16:45:31','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(402,36,'2025-11-13 16:45:33','Envió la solicitud a Administración. (Desarrollo)',34),(403,36,'2025-11-13 16:45:34','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(404,36,'2025-11-13 16:45:36','Confirmó que se entregó la ayuda. (Desarrollo)',34),(405,39,'2025-11-13 16:45:46','Hizo click sobre la notificación, marcó visto (General)',34),(406,38,'2025-11-13 16:55:27','Hizo click sobre la notificación, marcó visto (General)',34),(407,37,'2025-11-13 16:55:38','Hizo click sobre la notificación, marcó visto (Desarrollo)',34),(408,36,'2025-11-13 16:55:59','Hizo click sobre la notificación, marcó visto (General)',34),(409,36,'2025-11-13 16:56:16','Hizo click sobre la notificación, marcó visto (Desarrollo)',3434),(410,36,'2025-11-13 16:56:22','Reinició la solicitud. (Desarrollo)',3434),(411,37,'2025-11-13 16:56:27','Aprobó la solicitud para su procedimiento. (Desarrollo)',3434),(412,38,'2025-11-13 16:56:53','Registró solicitud (Desarrollo)',3434),(413,38,'2025-11-13 16:57:50','Hizo click sobre la notificación, marcó visto (Desarrollo)',3434),(414,35,'2025-11-13 17:04:34','Hizo click sobre la notificación, marcó visto (General)',3434),(415,45,'2025-11-13 17:07:48','Envió la solicitud a Administración. (Despacho)',3434),(416,45,'2025-11-13 17:07:52','Hizo click sobre la notificación, marcó visto (Despacho)',3434),(417,40,'2025-11-13 18:09:46','Creó una nueva solicitud de ayuda (General).',3434),(418,40,'2025-11-13 18:14:35','Inhabilitó la solicitud razón: no sea tacaño (General)',3434),(419,40,'2025-11-13 18:16:21','Habilitó la solicitud (General)',3434),(420,40,'2025-11-13 18:16:28','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(421,40,'2025-11-13 18:18:49','Envió la solicitud a despacho. (General)',3434),(422,40,'2025-11-13 18:21:49','Envió la solicitud a administración. (General)',3434),(423,40,'2025-11-13 18:23:11','Confirmó que se entregó la ayuda. (General)',3434),(424,41,'2025-11-13 18:25:53','Creó una nueva solicitud de ayuda (General).',3434),(425,39,'2025-11-13 18:28:22','Registró solicitud (Desarrollo)',3434),(426,39,'2025-11-13 18:29:56','Aprobó la solicitud para su procedimiento. (Desarrollo)',3434),(427,39,'2025-11-13 18:30:26','Envió la solicitud a Administración. (Desarrollo)',3434),(428,39,'2025-11-13 18:30:29','Confirmó que se entregó la ayuda. (Desarrollo)',3434),(429,39,'2025-11-13 18:32:33','Reinició la solicitud. (Desarrollo)',3434),(430,46,'2025-11-13 18:36:40','Registró solicitud. (Despacho)',3434),(431,46,'2025-11-13 18:37:47','Envió la solicitud a Administración. (Despacho)',3434),(432,46,'2025-11-13 18:38:21','Confirmó que se entregó la ayuda. (Despacho)',3434),(433,41,'2025-11-13 18:38:54','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(434,41,'2025-11-13 18:38:59','Envió la solicitud a despacho. (General)',3434),(435,41,'2025-11-13 18:39:01','Envió la solicitud a administración. (General)',3434),(436,41,'2025-11-13 18:39:03','Confirmó que se entregó la ayuda. (General)',3434),(437,46,'2025-11-13 18:39:30','Reinició la solicitud. (Despacho)',3434),(438,42,'2025-11-13 18:48:47','Creó una nueva solicitud de ayuda (General).',3434),(439,39,'2025-11-13 18:51:34','Envió la solicitud a Administración. (Desarrollo)',3434),(440,47,'2025-11-13 18:54:38','Registró solicitud. (Despacho)',3434),(441,47,'2025-11-13 18:55:09','Envió la solicitud a Administración. (Despacho)',3434),(442,47,'2025-11-13 18:55:10','Confirmó que se entregó la ayuda. (Despacho)',3434),(443,47,'2025-11-13 18:55:24','Reinició la solicitud. (Despacho)',3434),(444,40,'2025-11-13 20:38:35','Registró solicitud (Desarrollo)',3434),(445,33,'2025-11-14 08:47:17','Habilitó la solicitud (General)',3434),(446,47,'2025-11-14 08:52:07','Envió la solicitud a Administración. (Despacho)',3434),(447,47,'2025-11-14 08:52:08','Confirmó que se entregó la ayuda. (Despacho)',3434),(448,47,'2025-11-14 08:52:08','Reinició la solicitud. (Despacho)',3434),(449,32,'2025-11-14 08:52:53','Confirmó que se entregó la ayuda. (General)',3434),(450,42,'2025-11-14 08:54:26','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(451,42,'2025-11-14 08:54:39','Hizo click sobre la notificación, marcó visto (General)',3434),(452,42,'2025-11-14 08:54:40','Envió la solicitud a despacho. (General)',3434),(453,42,'2025-11-14 09:06:29','Envió la solicitud a administración. (General)',3434),(454,39,'2025-11-14 09:06:41','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(455,42,'2025-11-14 09:06:52','Confirmó que se entregó la ayuda. (General)',3434),(456,42,'2025-11-14 09:06:59','Reinició el proceso de la solicitud. (General)',3434),(457,42,'2025-11-14 09:07:06','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(458,42,'2025-11-14 09:07:13','Envió la solicitud a despacho. (General)',3434),(459,42,'2025-11-14 09:07:20','Envió la solicitud a administración. (General)',3434),(460,47,'2025-11-14 09:14:25','Inhabilitó la solicitud razón: porq si (Despacho)',3434),(461,47,'2025-11-14 09:14:36','Habilitó la solicitud (Despacho)',3434),(462,47,'2025-11-14 09:14:38','Envió la solicitud a Administración. (Despacho)',3434),(463,47,'2025-11-14 09:14:42','Inhabilitó la solicitud razón: qwe3 (Despacho)',3434),(464,47,'2025-11-14 09:14:44','Habilitó la solicitud (Despacho)',3434),(465,47,'2025-11-14 09:14:53','Hizo click sobre la notificación, marcó visto (Despacho)',3434),(466,42,'2025-11-14 09:29:05','Confirmó que se entregó la ayuda. (General)',3434),(467,42,'2025-11-14 09:29:21','Hizo click sobre la notificación, marcó visto (General)',3434),(468,37,'2025-11-14 09:29:57','Envió la solicitud a despacho. (General)',3434),(469,37,'2025-11-14 09:30:33','Hizo click sobre la notificación, marcó visto (General)',3434),(470,39,'2025-11-15 22:25:34','Inhabilitó la solicitud razón: kiere (General)',3434),(471,40,'2025-11-15 22:32:07','Inhabilitó la solicitud razón: qwe (Despacho)',3434),(472,43,'2025-11-16 10:36:22','Creó una nueva solicitud de ayuda (General).',3434),(473,43,'2025-11-16 10:38:52','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(474,43,'2025-11-16 10:39:20','Envió la solicitud a despacho. (General)',3434),(475,43,'2025-11-16 10:39:36','Envió la solicitud a administración. (General)',3434),(476,43,'2025-11-16 10:39:55','Confirmó que se entregó la ayuda. (General)',3434),(477,43,'2025-11-16 10:40:29','Reinició el proceso de la solicitud. (General)',3434),(478,43,'2025-11-16 10:54:28','Inhabilitó la solicitud razón: invalidada (General)',3434),(479,38,'2025-11-16 11:03:04','Editó la solicitud (General)',3434),(480,38,'2025-11-16 19:06:28','Recibió documento físico, y aprobó para su procedimiento. (General)',3434),(481,38,'2025-11-16 19:07:52','Hizo click sobre la notificación, marcó visto (General)',3434),(482,41,'2025-11-16 20:03:08','Registró solicitud (Desarrollo)',3434),(483,42,'2025-11-16 20:07:03','Registró solicitud (Desarrollo)',3434),(484,43,'2025-11-16 20:08:59','Registró solicitud (Desarrollo)',3434),(485,1,'2025-11-16 20:10:46','Registró solicitud (Desarrollo)',3434),(486,1,'2025-11-16 20:19:28','Creó una nueva solicitud de ayuda (General).',3434),(487,2,'2025-11-16 20:19:55','Creó una nueva solicitud de ayuda (General).',3434),(488,1,'2025-11-16 20:26:36','Hizo click sobre la notificación, marcó visto (Desarrollo)',3434),(489,48,'2025-11-16 20:40:52','Registró solicitud. (Despacho)',3434),(490,48,'2025-11-16 21:03:31','Editó la solicitud de Despacho',3434),(491,48,'2025-11-16 21:03:58','Editó la solicitud de Despacho',3434),(492,48,'2025-11-16 21:04:01','Envió la solicitud a Administración. (Despacho)',3434),(493,48,'2025-11-16 21:04:01','Confirmó que se entregó la ayuda. (Despacho)',3434),(494,48,'2025-11-16 21:04:02','Reinició la solicitud. (Despacho)',3434),(495,2,'2025-11-16 21:09:25','Editó la solicitud (General)',3434),(496,49,'2025-11-16 21:13:06','Registró solicitud. (Despacho)',3434),(497,2,'2025-11-16 21:13:22','Registró solicitud (Desarrollo)',3434),(498,3,'2025-11-16 21:13:41','Creó una nueva solicitud de ayuda (General).',3434),(499,3,'2025-11-16 21:13:55','Hizo click sobre la notificación, marcó visto (General)',3434),(500,2,'2025-11-16 21:14:07','Hizo click sobre la notificación, marcó visto (General)',3434),(501,1,'2025-11-16 21:14:10','Hizo click sobre la notificación, marcó visto (General)',3434),(502,49,'2025-11-16 21:14:13','Hizo click sobre la notificación, marcó visto (Despacho)',3434),(503,48,'2025-11-16 21:14:17','Hizo click sobre la notificación, marcó visto (Despacho)',3434),(504,2,'2025-11-16 21:14:20','Hizo click sobre la notificación, marcó visto (Desarrollo)',3434),(505,49,'2025-11-16 22:35:09','Envió la solicitud a Administración. (Despacho)',123);
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
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes_entradas`
--

LOCK TABLES `reportes_entradas` WRITE;
/*!40000 ALTER TABLE `reportes_entradas` DISABLE KEYS */;
INSERT INTO `reportes_entradas` VALUES (1,3434,'2025-09-04 12:26:12','2025-09-05 12:55:59'),(2,3434,'2025-09-05 12:56:05','2025-09-12 08:24:41'),(3,3434,'2025-09-12 08:25:59','2025-09-13 17:37:11'),(4,3434,'2025-09-13 17:37:17','2025-09-14 08:45:06'),(5,3434,'2025-09-14 08:45:13','2025-09-15 14:02:45'),(6,3434,'2025-09-15 14:02:54','2025-09-16 14:48:19'),(7,3434,'2025-09-16 14:48:25','2025-09-16 15:19:41'),(8,34,'2025-09-16 15:20:03','2025-09-16 15:29:29'),(9,123,'2025-09-16 15:29:40','2025-09-16 15:31:59'),(10,321,'2025-09-16 15:32:12','2025-09-16 15:36:54'),(11,3434,'2025-09-16 15:39:29','2025-09-16 15:40:27'),(12,123,'2025-09-16 15:40:38','2025-09-16 15:43:06'),(13,3434,'2025-09-16 15:43:37','2025-09-16 15:44:33'),(14,123,'2025-09-16 15:44:48','2025-09-16 15:47:03'),(15,3434,'2025-09-17 14:46:06','2025-09-17 14:57:31'),(16,3434,'2025-09-17 14:58:17','2025-09-17 14:58:23'),(17,3434,'2025-09-17 14:58:50','2025-09-17 14:59:06'),(18,3434,'2025-09-17 15:05:28','2025-09-17 15:05:32'),(19,3434,'2025-09-17 15:06:17','2025-09-17 15:06:22'),(20,3434,'2025-09-17 15:07:03','2025-09-17 15:07:08'),(21,3434,'2025-09-17 15:07:37','2025-09-17 15:10:03'),(22,3434,'2025-09-17 15:10:27','2025-09-17 15:10:32'),(23,3434,'2025-09-17 15:12:15','2025-09-17 15:12:30'),(24,3434,'2025-09-17 15:13:25','2025-09-17 15:13:29'),(25,3434,'2025-09-17 15:20:39','2025-09-18 15:44:49'),(26,3434,'2025-09-18 15:44:59','2025-09-20 14:20:35'),(27,3434,'2025-09-20 14:20:43','2025-09-20 14:24:00'),(28,34,'2025-09-20 14:24:19','2025-09-20 14:25:07'),(29,3434,'2025-09-20 14:25:19','2025-09-20 14:26:08'),(30,34,'2025-09-20 14:26:29','2025-09-20 14:27:37'),(31,123,'2025-09-20 14:27:55','2025-09-20 14:28:45'),(32,321,'2025-09-20 14:28:55','2025-09-20 14:30:10'),(33,3434,'2025-09-20 14:30:25','2025-09-20 16:07:06'),(34,123,'2025-09-20 16:09:04','2025-09-22 11:23:30'),(35,3434,'2025-09-22 11:22:27','2025-09-22 11:23:04'),(36,123,'2025-09-22 11:23:37','2025-09-22 11:42:34'),(37,3434,'2025-09-22 11:42:46','2025-09-22 11:43:42'),(38,123,'2025-09-22 11:43:54','2025-09-22 12:01:05'),(39,3434,'2025-09-23 10:02:58','2025-09-24 14:41:32'),(40,3434,'2025-09-24 14:41:39','2025-09-24 17:22:43'),(41,3434,'2025-09-25 12:04:13','2025-09-25 12:26:45'),(42,3434,'2025-09-25 12:40:21','2025-10-03 08:09:01'),(43,3434,'2025-10-03 08:09:08','2025-10-03 12:03:16'),(44,3434,'2025-10-03 12:03:22','2025-10-03 15:50:09'),(45,3434,'2025-10-03 15:50:16','2025-10-04 09:20:06'),(46,3434,'2025-10-04 09:20:14','2025-10-05 10:53:54'),(47,3434,'2025-10-05 10:54:01','2025-10-05 15:38:56'),(48,123,'2025-10-05 15:39:29','2025-10-06 10:38:56'),(49,3434,'2025-10-06 07:51:39','2025-10-06 10:38:11'),(50,123,'2025-10-06 10:39:04','2025-10-06 10:57:21'),(51,123,'2025-10-06 11:03:07','2025-10-06 11:03:13'),(52,123,'2025-10-06 11:03:25','2025-10-06 11:03:32'),(53,3434,'2025-10-07 07:30:03','2025-10-07 07:30:12'),(54,3434,'2025-10-07 07:30:19','2025-10-07 07:30:50'),(55,3434,'2025-10-08 11:29:02','2025-10-08 11:50:51'),(56,123,'2025-10-08 11:42:04','2025-10-08 11:56:37'),(57,123,'2025-10-08 11:54:59','2025-10-08 11:55:08'),(58,123,'2025-10-08 11:55:19','2025-10-08 11:55:28'),(59,3434,'2025-10-08 11:56:18','2025-10-08 11:59:47'),(60,3434,'2025-10-08 12:06:51','2025-10-08 12:31:01'),(61,3434,'2025-10-08 12:31:09','2025-10-08 12:31:19'),(62,3434,'2025-10-08 12:41:09','2025-10-08 14:06:08'),(63,3434,'2025-10-08 14:06:16','2025-10-08 14:06:23'),(64,3434,'2025-10-08 14:07:25','2025-10-08 14:07:33'),(65,3434,'2025-10-09 15:25:54','2025-10-09 15:26:01'),(66,3434,'2025-10-09 15:31:41','2025-10-09 15:31:51'),(67,3434,'2025-10-09 15:35:50','2025-10-09 15:38:49'),(68,123,'2025-10-09 15:39:01','2025-10-09 15:39:08'),(69,3434,'2025-10-09 15:39:19','2025-10-10 15:33:19'),(70,3434,'2025-10-10 15:33:27','2025-10-12 08:35:27'),(71,3434,'2025-10-12 08:35:36','2025-10-12 12:09:25'),(72,3434,'2025-10-12 12:09:37','2025-10-13 09:54:00'),(73,3434,'2025-10-13 09:54:06','2025-10-14 18:14:03'),(74,3434,'2025-10-14 18:21:47','2025-10-14 21:23:53'),(75,3434,'2025-10-15 08:18:45','2025-10-15 20:06:42'),(76,3434,'2025-10-15 20:14:26','2025-10-15 20:14:38'),(77,3434,'2025-10-16 08:44:31','2025-10-17 10:00:24'),(78,3434,'2025-10-17 10:00:35','2025-10-17 10:42:08'),(79,123,'2025-10-17 10:42:19','2025-10-17 10:48:43'),(80,3434,'2025-10-19 10:40:54','2025-10-20 09:58:05'),(81,3434,'2025-10-20 09:58:15','2025-10-21 09:45:03'),(82,3434,'2025-10-21 09:45:10','2025-10-22 08:22:55'),(83,3434,'2025-10-22 08:23:16','2025-10-22 15:50:48'),(84,3434,'2025-10-22 15:50:56','2025-10-23 08:53:54'),(85,3434,'2025-10-23 08:54:06','2025-10-25 09:05:35'),(86,3434,'2025-10-25 09:05:45','2025-10-25 09:59:30'),(87,3434,'2025-10-25 16:32:15','2025-10-26 11:07:20'),(88,3434,'2025-10-26 11:07:26','2025-10-26 20:08:54'),(89,3434,'2025-10-28 08:39:26','2025-10-29 09:35:31'),(90,3434,'2025-10-29 09:35:39','2025-10-29 14:14:13'),(91,3434,'2025-10-30 22:06:23','2025-10-30 22:06:45'),(92,3434,'2025-10-30 22:19:06','2025-10-30 22:20:41'),(93,34,'2025-10-30 22:20:54','2025-10-30 22:23:53'),(94,34,'2025-10-31 09:29:13','2025-10-31 09:52:53'),(95,321,'2025-10-31 09:54:09','2025-10-31 09:54:17'),(96,123,'2025-10-31 09:54:29','2025-10-31 09:55:09'),(97,123,'2025-10-31 11:31:06','2025-10-31 11:31:15'),(98,123,'2025-10-31 11:51:33','2025-10-31 11:51:37'),(99,123,'2025-10-31 11:51:42','2025-10-31 11:51:46'),(100,123,'2025-10-31 11:51:50','2025-10-31 11:51:54'),(101,123,'2025-10-31 11:51:58','2025-10-31 11:52:02'),(102,123,'2025-10-31 11:52:06','2025-10-31 11:52:11'),(103,123,'2025-10-31 11:52:15','2025-10-31 11:52:19'),(104,123,'2025-10-31 11:52:23','2025-10-31 11:52:27'),(105,123,'2025-10-31 11:52:31','2025-10-31 11:52:35'),(106,123,'2025-10-31 11:52:40','2025-10-31 11:53:57'),(107,123,'2025-10-31 11:54:11','2025-10-31 11:54:15'),(108,123,'2025-10-31 11:54:20','2025-10-31 11:54:24'),(109,123,'2025-10-31 11:54:28','2025-10-31 11:54:32'),(110,123,'2025-10-31 11:54:36','2025-10-31 11:54:40'),(111,123,'2025-10-31 11:54:45','2025-10-31 11:54:49'),(112,123,'2025-10-31 11:54:53','2025-10-31 11:54:57'),(113,123,'2025-10-31 11:58:02','2025-10-31 11:58:06'),(114,123,'2025-10-31 11:58:15','2025-10-31 12:16:07'),(115,34,'2025-10-31 11:59:59','2025-11-01 10:02:07'),(116,321,'2025-10-31 12:02:35','2025-10-31 12:45:36'),(117,123,'2025-10-31 12:16:23','2025-11-01 10:01:43'),(118,3434,'2025-10-31 12:37:55','2025-10-31 12:40:09'),(119,321,'2025-10-31 12:40:30','2025-10-31 12:45:25'),(120,3434,'2025-10-31 12:45:37','2025-11-01 09:59:40'),(121,321,'2025-10-31 12:46:04','2025-10-31 12:57:44'),(122,321,'2025-10-31 12:58:19','2025-11-01 10:42:43'),(123,3434,'2025-11-01 10:00:00','2025-11-01 10:01:17'),(124,123,'2025-11-01 10:01:53','2025-11-01 11:07:55'),(125,34,'2025-11-01 10:02:21','2025-11-01 10:42:28'),(126,321,'2025-11-01 10:42:53','2025-11-01 11:30:56'),(127,3434,'2025-11-01 11:26:43','2025-11-01 11:28:47'),(128,34,'2025-11-01 11:28:53','2025-11-01 11:30:47'),(129,3434,'2025-11-01 11:32:04','2025-11-01 11:34:39'),(130,34,'2025-11-01 11:38:51','2025-11-01 11:39:48'),(131,321,'2025-11-01 11:44:07','2025-11-01 11:45:12'),(132,34,'2025-11-01 21:05:55','2025-11-01 22:34:09'),(133,123,'2025-11-01 22:34:11','2025-11-01 22:47:24'),(134,321,'2025-11-01 22:47:30','2025-11-01 22:48:47'),(135,3434,'2025-11-01 22:48:50','2025-11-01 22:51:12'),(136,123,'2025-11-02 09:53:37','2025-11-02 09:55:08'),(137,3434,'2025-11-02 09:55:11','2025-11-02 09:55:17'),(138,3434,'2025-11-02 10:11:41','2025-11-02 11:07:59'),(139,123,'2025-11-02 11:08:34','2025-11-02 11:26:22'),(140,34,'2025-11-02 11:08:39','2025-11-02 11:09:24'),(141,321,'2025-11-02 11:09:25','2025-11-02 11:26:24'),(142,34,'2025-11-02 11:26:26','2025-11-02 12:01:54'),(143,123,'2025-11-02 11:26:28','2025-11-02 12:41:30'),(144,321,'2025-11-02 12:01:56','2025-11-02 12:42:28'),(145,3434,'2025-11-02 12:41:32','2025-11-02 21:47:24'),(146,34,'2025-11-02 12:42:31','2025-11-02 14:50:12'),(147,123,'2025-11-02 14:50:14','2025-11-02 14:50:43'),(148,321,'2025-11-02 14:50:45','2025-11-02 14:58:55'),(149,123,'2025-11-02 14:58:57','2025-11-02 15:04:18'),(150,321,'2025-11-02 15:04:20','2025-11-02 15:09:47'),(151,123,'2025-11-02 15:09:54','2025-11-02 15:09:56'),(152,34,'2025-11-02 15:17:19','2025-11-02 15:29:09'),(153,34,'2025-11-02 15:29:11','2025-11-02 21:47:39'),(154,34,'2025-11-02 21:47:46','2025-11-02 21:54:55'),(155,123,'2025-11-02 21:47:48','2025-11-02 21:59:01'),(156,321,'2025-11-02 21:54:57','2025-11-02 21:55:10'),(157,34,'2025-11-02 21:55:12','2025-11-02 21:55:43'),(158,321,'2025-11-02 21:55:49','2025-11-02 21:59:03'),(159,34,'2025-11-02 21:59:08','2025-11-02 21:59:40'),(160,3434,'2025-11-02 21:59:11','2025-11-02 21:59:32'),(161,3434,'2025-11-02 21:59:43','2025-11-02 22:15:05'),(162,3434,'2025-11-03 08:55:31','2025-11-03 15:53:05'),(163,34,'2025-11-03 15:53:24','2025-11-03 15:55:51'),(164,123,'2025-11-03 15:53:44','2025-11-03 15:56:25'),(165,321,'2025-11-03 15:55:53','2025-11-03 15:56:07'),(166,34,'2025-11-03 15:56:09','2025-11-03 15:56:17'),(167,123,'2025-11-03 15:56:22','2025-11-03 15:56:32'),(168,321,'2025-11-03 15:56:27','2025-11-03 16:06:51'),(169,123,'2025-11-03 15:56:40','2025-11-03 16:25:06'),(170,34,'2025-11-03 16:06:55','2025-11-03 16:07:50'),(171,321,'2025-11-03 16:08:00','2025-11-03 16:08:58'),(172,34,'2025-11-03 16:09:01','2025-11-03 16:12:09'),(173,321,'2025-11-03 16:12:11','2025-11-03 16:25:12'),(174,3434,'2025-11-03 16:25:09','2025-11-04 08:52:24'),(175,3434,'2025-11-04 08:52:27','2025-11-04 16:53:13'),(176,3434,'2025-11-04 16:53:15','2025-11-04 17:07:40'),(177,3434,'2025-11-04 17:07:46','2025-11-04 17:12:24'),(178,3434,'2025-11-04 20:24:43','2025-11-04 20:40:00'),(179,3434,'2025-11-04 20:40:03','2025-11-04 21:22:04'),(180,3434,'2025-11-04 21:22:24','2025-11-04 21:22:51'),(181,123,'2025-11-04 21:22:53','2025-11-04 21:23:01'),(182,123,'2025-11-04 21:23:18','2025-11-04 21:23:37'),(183,3434,'2025-11-05 09:30:29','2025-11-05 09:30:34'),(184,3434,'2025-11-05 09:30:36','2025-11-05 09:49:40'),(185,123,'2025-11-05 09:49:43','2025-11-05 09:50:10'),(186,3434,'2025-11-05 09:50:12','2025-11-05 12:05:54'),(187,123,'2025-11-06 14:55:01','2025-11-06 15:31:32'),(188,3434,'2025-11-06 15:31:41','2025-11-06 15:31:51'),(189,3434,'2025-11-06 15:31:55','2025-11-06 15:41:13'),(190,3434,'2025-11-06 15:41:29','2025-11-06 15:54:55'),(191,3434,'2025-11-06 15:54:58','2025-11-06 16:24:22'),(192,3434,'2025-11-06 16:28:41','2025-11-06 21:40:24'),(193,3434,'2025-11-06 21:40:26','2025-11-07 09:09:59'),(194,3434,'2025-11-07 09:10:02','2025-11-07 10:58:37'),(195,123,'2025-11-07 09:34:23','2025-11-07 10:58:27'),(196,3434,'2025-11-07 10:58:52','2025-11-07 12:45:32'),(197,3434,'2025-11-07 12:45:37','2025-11-07 16:21:27'),(198,3434,'2025-11-07 16:21:32','2025-11-07 21:32:47'),(199,3434,'2025-11-07 21:32:53','2025-11-07 21:32:58'),(200,3434,'2025-11-07 21:41:36','2025-11-07 21:41:41'),(201,3434,'2025-11-07 21:48:34','2025-11-07 21:49:12'),(202,3434,'2025-11-07 21:49:28','2025-11-07 21:54:19'),(203,3434,'2025-11-08 09:06:07','2025-11-08 11:22:44'),(204,3434,'2025-11-08 17:35:39','2025-11-08 21:47:15'),(205,3434,'2025-11-08 21:53:40','2025-11-08 22:07:17'),(206,3434,'2025-11-09 10:54:05','2025-11-09 18:52:36'),(207,3434,'2025-11-09 18:52:39','2025-11-09 18:52:42'),(208,3434,'2025-11-09 18:52:48','2025-11-09 18:52:58'),(209,3434,'2025-11-09 19:13:37','2025-11-09 20:01:33'),(210,3434,'2025-11-09 20:01:37','2025-11-09 20:03:26'),(211,3434,'2025-11-09 20:03:34','2025-11-09 20:04:02'),(212,3434,'2025-11-10 08:48:31','2025-11-11 09:55:24'),(213,3434,'2025-11-11 09:55:26','2025-11-11 10:27:56'),(214,3434,'2025-11-11 10:28:04','2025-11-11 11:04:08'),(215,3434,'2025-11-11 11:04:20','2025-11-11 11:05:14'),(216,3434,'2025-11-11 15:20:37','2025-11-11 15:22:00'),(217,3434,'2025-11-13 15:05:58','2025-11-13 15:07:29'),(218,34,'2025-11-13 15:07:32','2025-11-13 16:56:06'),(219,3434,'2025-11-13 16:56:08','2025-11-13 22:08:16'),(220,3434,'2025-11-14 08:07:12','2025-11-14 09:41:02'),(221,123,'2025-11-15 21:47:37','2025-11-15 21:47:40'),(222,3434,'2025-11-15 21:47:44','2025-11-15 22:41:55'),(223,3434,'2025-11-15 23:12:35','2025-11-15 23:51:21'),(224,3434,'2025-11-16 10:24:58','2025-11-16 11:14:33'),(225,23,'2025-11-16 11:14:52','2025-11-16 11:18:37'),(226,3434,'2025-11-16 11:18:39','2025-11-16 11:19:00'),(227,3434,'2025-11-16 11:19:02','2025-11-16 11:35:40'),(228,3434,'2025-11-16 18:36:05','2025-11-16 19:05:52'),(229,3434,'2025-11-16 19:05:58','2025-11-16 19:08:11'),(230,3434,'2025-11-16 19:09:05','2025-11-16 21:15:58'),(231,321,'2025-11-16 22:34:24','2025-11-16 22:34:39'),(232,123,'2025-11-16 22:34:44','2025-11-16 22:47:00'),(233,3434,'2025-11-16 22:47:03','2025-11-16 22:47:06'),(234,3434,'2025-11-17 18:04:06','0000-00-00 00:00:00');
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
INSERT INTO `roles` VALUES (1,'Promotor Social',1),(2,'Despacho',1),(3,'Administración',1),(4,'Administrador Principal',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes`
--

LOCK TABLES `solicitantes` WRITE;
/*!40000 ALTER TABLE `solicitantes` DISABLE KEYS */;
INSERT INTO `solicitantes` VALUES (7,3215,'Yorsh','Gonzalez','forell.music@gmail.com','2025-10-14 18:44:43'),(8,30420669,'Calucho','Gonzalez','carlossoteldo11@gmail.com','2025-10-14 21:01:52'),(29,31628264,'Danielys','Rojas','danielysrojas@gmail.com','2025-11-02 21:52:05'),(34,31666666,'Abel','Tefolla','abeltesfayjfhhbafr@gmail.com','2025-11-13 18:09:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_comunidad`
--

LOCK TABLES `solicitantes_comunidad` WRITE;
/*!40000 ALTER TABLE `solicitantes_comunidad` DISABLE KEYS */;
INSERT INTO `solicitantes_comunidad` VALUES (6,7,'PALMICHAL','Carrera centro','Jefe de Comunidad'),(7,8,'JOSE GREGORIO AMAYA','32-15','Pues por ahi'),(28,29,'JOSE GREGORIO AMAYA','Carrera 15 entre 14 y 16','Escuela'),(33,34,'EL PARAISO','14','Ninguno');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_conocimiento`
--

LOCK TABLES `solicitantes_conocimiento` WRITE;
/*!40000 ALTER TABLE `solicitantes_conocimiento` DISABLE KEYS */;
INSERT INTO `solicitantes_conocimiento` VALUES (6,7,'Ingeniero','Primaria'),(7,8,'Ingeniero en informática','Universidad'),(25,29,'Ama de casa','Secundaria'),(30,34,'Musica','Universidad');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_extra`
--

LOCK TABLES `solicitantes_extra` WRITE;
/*!40000 ALTER TABLE `solicitantes_extra` DISABLE KEYS */;
INSERT INTO `solicitantes_extra` VALUES (6,7,'321423','3213123'),(7,8,'32131231','232342235'),(25,29,'3123123213','109238912389123'),(30,34,'787878','78655346175896906');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_info`
--

LOCK TABLES `solicitantes_info` WRITE;
/*!40000 ALTER TABLE `solicitantes_info` DISABLE KEYS */;
INSERT INTO `solicitantes_info` VALUES (7,7,'2025-10-01','Hospital rafael rangel','Soltero/a','042323'),(8,8,'2003-04-11','San juan de los morros','Soltero/a','04245587628'),(16,29,'2004-11-05','Aroa','Casado/a','0414338556'),(21,34,'1985-02-14','Canada','Casado/a','04135667890');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_ingresos`
--

LOCK TABLES `solicitantes_ingresos` WRITE;
/*!40000 ALTER TABLE `solicitantes_ingresos` DISABLE KEYS */;
INSERT INTO `solicitantes_ingresos` VALUES (6,7,30000,'No','No'),(7,8,344,'No','No'),(12,29,2000,'No','No'),(17,34,10000,'No','No');
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_patologia`
--

LOCK TABLES `solicitantes_patologia` WRITE;
/*!40000 ALTER TABLE `solicitantes_patologia` DISABLE KEYS */;
INSERT INTO `solicitantes_patologia` VALUES (38,29,'Hereditarias','Diabetes'),(39,29,'Hereditarias','Diabetes'),(40,29,'Hereditarias','Diabetes'),(41,29,'Hereditarias','Diabetes'),(42,29,'Hereditarias','Diabetes'),(56,7,'Hereditarias','Sisa'),(57,7,'Congénitas','Visual');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_propiedad`
--

LOCK TABLES `solicitantes_propiedad` WRITE;
/*!40000 ALTER TABLE `solicitantes_propiedad` DISABLE KEYS */;
INSERT INTO `solicitantes_propiedad` VALUES (6,7,'Casa','Propia','Era observacion'),(7,8,'Apartamento','Prestada','Sin observaciones'),(12,29,'Casa','Propia','No escucha'),(17,34,'Casa','Propia','Kkkkk');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantes_trabajo`
--

LOCK TABLES `solicitantes_trabajo` WRITE;
/*!40000 ALTER TABLE `solicitantes_trabajo` DISABLE KEYS */;
INSERT INTO `solicitantes_trabajo` VALUES (6,7,'No tiene','No','No','No'),(7,8,'No tiene','No','No','No'),(12,29,'Ama de casa','Sabanita','No','No'),(17,34,'Cantante','EEUU','No','No');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda`
--

LOCK TABLES `solicitud_ayuda` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda_correo`
--

LOCK TABLES `solicitud_ayuda_correo` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda_correo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_ayuda_fecha`
--

LOCK TABLES `solicitud_ayuda_fecha` WRITE;
/*!40000 ALTER TABLE `solicitud_ayuda_fecha` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_categoria`
--

LOCK TABLES `solicitud_categoria` WRITE;
/*!40000 ALTER TABLE `solicitud_categoria` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo`
--

LOCK TABLES `solicitud_desarrollo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_correo`
--

LOCK TABLES `solicitud_desarrollo_correo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_correo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_fecha`
--

LOCK TABLES `solicitud_desarrollo_fecha` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_fecha` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_info`
--

LOCK TABLES `solicitud_desarrollo_info` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_info` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_invalido`
--

LOCK TABLES `solicitud_desarrollo_invalido` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_invalido` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_laboratorio`
--

LOCK TABLES `solicitud_desarrollo_laboratorio` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_laboratorio` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_desarrollo_tipo`
--

LOCK TABLES `solicitud_desarrollo_tipo` WRITE;
/*!40000 ALTER TABLE `solicitud_desarrollo_tipo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_descripcion`
--

LOCK TABLES `solicitud_descripcion` WRITE;
/*!40000 ALTER TABLE `solicitud_descripcion` DISABLE KEYS */;
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
INSERT INTO `usuarios` VALUES (34,'$2y$10$B3B3.eLTtqT.iJcPnh/m4.uSJ7M7j3tKvcLZii.D3B9BI5lgp2CwW',1,'False'),(123,'$2y$10$EUbg2UC5PG3DD2IUBrCf7OrQE.8AYST9kKAPP5MqmTU.9feSrr6Cm',2,'False'),(321,'$2y$10$b7GW4RMYoXkT7w35iXmYWuL3faGW5px.ZEi7bk4sMZZPzEwQcnjKK',3,'False'),(3434,'$2y$10$ju0SJ2NyR9WMKR9.DDr2I.z0nBZ.4CfyXUBLbLUBiUQf3phYwmFne',4,'True');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_info`
--

LOCK TABLES `usuarios_info` WRITE;
/*!40000 ALTER TABLE `usuarios_info` DISABLE KEYS */;
INSERT INTO `usuarios_info` VALUES (5,123,'pepe','gonzalez',''),(6,34,'promotor','socio',''),(7,321,'administracion','gonzalez',''),(9,3434,'Admin','Supremo','forell.music@gmail.com');
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

-- Dump completed on 2025-11-17 18:19:46
