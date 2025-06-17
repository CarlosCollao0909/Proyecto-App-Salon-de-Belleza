-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: appsalon_refactor
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `estado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `horarioID` int DEFAULT NULL,
  `usuarioID` int DEFAULT NULL,
  `servicioID` int DEFAULT NULL,
  `formaPagoID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_usuarios_FK` (`usuarioID`),
  KEY `citas_horarios_FK` (`horarioID`),
  KEY `citas_servicios_FK` (`servicioID`),
  KEY `citas_formapagos_FK` (`formaPagoID`),
  CONSTRAINT `citas_formapagos_FK` FOREIGN KEY (`formaPagoID`) REFERENCES `formaspagos` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_horarios_FK` FOREIGN KEY (`horarioID`) REFERENCES `horarios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_servicios_FK` FOREIGN KEY (`servicioID`) REFERENCES `servicios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_usuarios_FK` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'2025-04-01','finalizada',1,2,2,1),(2,'2025-04-02','finalizada',9,2,7,2),(3,'2025-04-03','finalizada',5,3,11,1),(4,'2025-04-22','finalizada',4,3,1,1),(5,'2025-03-05','finalizada',4,2,2,1),(6,'2025-03-05','finalizada',2,3,1,1),(7,'2025-03-08','finalizada',1,2,1,1),(8,'2025-03-08','finalizada',7,2,1,2),(9,'2025-02-08','finalizada',4,2,1,2),(10,'2025-02-08','finalizada',6,2,1,2),(11,'2025-02-08','finalizada',4,2,1,1),(12,'2025-02-08','finalizada',5,2,2,1),(13,'2025-02-08','finalizada',6,2,2,1),(14,'2025-02-08','finalizada',7,2,3,1),(15,'2025-02-08','finalizada',2,2,10,1),(16,'2025-02-08','finalizada',8,2,1,1),(17,'2025-05-09','finalizada',3,2,3,1),(18,'2025-05-09','finalizada',9,2,3,1),(19,'2025-05-09','finalizada',1,2,2,1),(20,'2025-06-30','confirmada',8,2,12,1),(21,'2025-07-15','confirmada',3,2,4,1),(22,'2025-07-17','confirmada',1,2,3,1),(23,'2025-07-20','confirmada',4,2,6,2),(24,'2025-07-20','confirmada',4,2,6,2),(25,'2025-05-08','finalizada',5,2,1,1),(26,'2025-05-08','finalizada',6,2,1,2),(27,'2025-05-08','finalizada',3,2,12,2),(28,'2025-05-08','finalizada',3,2,12,2),(29,'2025-05-08','finalizada',9,2,3,2),(30,'2025-05-08','finalizada',2,3,7,2),(31,'2025-05-10','finalizada',6,2,9,2),(32,'2025-05-15','finalizada',6,2,6,1),(33,'2025-05-22','finalizada',3,2,1,1),(34,'2025-05-22','finalizada',3,2,1,1),(35,'2025-05-19','finalizada',8,2,2,2),(36,'2025-05-19','finalizada',6,3,7,2),(37,'2025-05-30','finalizada',6,2,10,1),(38,'2025-05-26','finalizada',7,2,1,1),(39,'2025-05-26','finalizada',7,2,1,1),(40,'2025-05-29','confirmada',3,2,10,1),(41,'2025-05-28','finalizada',3,2,2,1),(42,'2025-05-30','finalizada',2,3,2,1),(43,'2025-06-05','finalizada',4,3,3,1),(44,'2025-06-13','finalizada',1,3,2,1),(45,'2025-06-13','finalizada',2,2,1,2),(46,'2025-06-13','finalizada',2,2,1,2),(47,'2025-06-13','finalizada',3,3,2,1),(48,'2025-06-13','finalizada',9,10,2,1),(49,'2025-06-13','finalizada',8,2,1,1),(50,'2025-06-19','confirmada',1,3,2,1),(51,'2025-06-18','confirmada',2,11,3,1),(52,'2025-06-21','confirmada',2,12,1,1),(53,'2025-06-23','confirmada',2,10,2,1),(54,'2025-06-30','confirmada',1,10,11,1),(55,'2025-06-26','confirmada',4,13,14,1),(56,'2025-07-02','confirmada',2,3,2,1),(57,'2025-06-30','confirmada',2,10,7,1),(58,'2025-06-25','confirmada',2,13,9,1),(59,'2025-07-03','confirmada',2,13,8,1);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobantespagos`
--

DROP TABLE IF EXISTS `comprobantespagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprobantespagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagenComprobante` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaSubida` timestamp NULL DEFAULT NULL,
  `citaID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comprobantepagos_citas_FK` (`citaID`),
  CONSTRAINT `comprobantepagos_citas_FK` FOREIGN KEY (`citaID`) REFERENCES `citas` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobantespagos`
--

LOCK TABLES `comprobantespagos` WRITE;
/*!40000 ALTER TABLE `comprobantespagos` DISABLE KEYS */;
INSERT INTO `comprobantespagos` VALUES (1,'prueba.jpg','2025-05-07 04:00:00',24),(2,'c8d76a5421cec88f4d9be646d15c5f43.jpg','2025-05-07 23:58:25',26),(3,'dfb00cbc05c231f253119273315c8621.jpg','2025-05-08 00:10:21',28),(4,'f9336cf261d07bb3fdd981581bd2f4ca.jpg','2025-05-08 00:13:02',29),(5,'0bd742c0ace823c92d8b4d88a1c14470.jpg','2025-05-08 00:16:21',30),(6,'2d37fd5fb17a3dff775405420144e3c1.jpg','2025-05-08 15:31:23',31),(7,'e38ccc18c215ed897d1bb6401abab370.jpg','2025-05-17 17:16:06',35),(8,'03dd95c940b374025905d8902459b7a4.jpg','2025-05-17 20:28:05',36),(9,'1d5a088d2a370e316de7134e80d86721.jpg','2025-06-11 13:31:26',45),(10,'d36fb199ecfc707be1801cfc3b167831.jpg','2025-06-11 13:31:26',46);
/*!40000 ALTER TABLE `comprobantespagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formaspagos`
--

DROP TABLE IF EXISTS `formaspagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formaspagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagenQR` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formaspagos`
--

LOCK TABLES `formaspagos` WRITE;
/*!40000 ALTER TABLE `formaspagos` DISABLE KEYS */;
INSERT INTO `formaspagos` VALUES (1,'EFECTIVO','NO CORRESPONDE'),(2,'QR','7849bdc1787f3009227fa75495bedbec.png');
/*!40000 ALTER TABLE `formaspagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'09:00:00','10:00:00',1),(2,'10:00:00','11:00:00',1),(3,'11:00:00','12:00:00',1),(4,'15:00:00','16:00:00',1),(5,'16:00:00','17:00:00',1),(6,'17:00:00','18:00:00',1),(7,'18:00:00','19:00:00',1),(8,'19:00:00','20:00:00',1),(9,'20:00:00','21:00:00',1);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'CORTE DE CABELLO MUJER',70.00,1),(2,'CORTE DE CABELLO HOMBRE',40.00,1),(3,'CORTE DE CABELLO NIÑO',30.00,1),(4,'PEINADO MUJER',100.00,1),(5,'PEINADO HOMBRE',40.00,1),(6,'PEINADO NIÑO',25.00,1),(7,'CORTE DE BARBA',30.00,1),(8,'TINTE MUJER',200.00,1),(9,'UÑAS',50.00,1),(10,'LAVADO DE CABELLO',20.00,1),(11,'TRATAMIENTO CAPILAR',150.00,1),(12,'TINTE HOMBRE',80.00,1),(13,'ALIZADO DE CABELLO',250.00,1),(14,'MAQUILLAJE',180.00,1),(15,'PERMANENTE MUJER',220.00,1),(16,'PEINADO NOVIA',500.00,1),(20,'PERMANENTE HOMBRE',140.00,1),(22,'servicio prueba update',40.00,0),(23,'new service test',90.00,0),(24,'peinado',60.00,0),(25,'TEST VALIDATION',50.50,0),(26,'SALUDO',0.50,0);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` tinyint DEFAULT NULL,
  `confirmado` tinyint DEFAULT NULL,
  `token` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'JUAN CARLOS','COLLAO MAMANI','carloscollao3@gmail.com','$2y$10$Z/0pRfmeb3eBAoDxxhP7w.ReiHqL21nGbZqiuQGdu9CRd2Y3LrDce','69575687',1,1,''),(2,'PAMELA','SANCHEZ','pamela@test.com','$2y$10$i47DLu2fBWaT..ZAS7VoFesBYhr4DLY0zkWfH5cUGRgwART7N2z9.','12345678',0,1,''),(3,'JUAN','PEREZ','juan@test.com','$2y$10$fOfVnepLngS7aWn61SowSeTfmxFWOo8Z7ujHisPSo3qs4wi2..vMW','69575687',0,1,''),(10,'PEDRO','COLLAO','pedro@test.com','$2y$10$P2KXJ7OQXi7WjDXSCNMi.Oju4BPdFbJFPk9cM3QNmWaCX25JqosU2','72326588',0,1,''),(11,'LUIS','CHAVEZ','luis@mail.com','$2y$10$aO8AbAmnFxIzbVMqkiPNfuhkrr0uy00Ysv6pWfhTOzxYYSmlcSoe2','63524178',0,1,''),(12,'ROCIO','MARTINEZ','rocio@mail.com','$2y$10$U5XYFWuq8/u5zxTgHCFATOVnKrXu0Bx/ld5GcogwV19lyLIOyoSyq','63587412',0,1,''),(13,'SUSAN','VARGAS','susan@mail.com','$2y$10$2q6wZ8xzut2gtDzTPrN97eh.N6EIZp32DOAU2dIw.hW7FwtNLahP2','78965412',0,1,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'appsalon_refactor'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-17 10:36:08
