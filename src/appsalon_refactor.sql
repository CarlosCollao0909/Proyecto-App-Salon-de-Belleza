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
  `estado` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `horarioID` int DEFAULT NULL,
  `usuarioID` int DEFAULT NULL,
  `servicioID` int DEFAULT NULL,
  `formaPagoID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_usuarios_FK` (`usuarioID`),
  KEY `citas_horarios_FK` (`horarioID`),
  KEY `citas_servicios_FK` (`servicioID`),
  KEY `citas_formapagos_FK` (`formaPagoID`),
  CONSTRAINT `citas_formapagos_FK` FOREIGN KEY (`formaPagoID`) REFERENCES `formapagos` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_horarios_FK` FOREIGN KEY (`horarioID`) REFERENCES `horarios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_servicios_FK` FOREIGN KEY (`servicioID`) REFERENCES `servicios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT,
  CONSTRAINT `citas_usuarios_FK` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'2025-05-01','Confirmada',1,2,2,1),(2,'2025-05-02','Confirmada',9,2,7,2),(3,'2025-05-03','Confirmada',5,3,11,1),(4,'2025-05-22','Confirmada',4,3,1,1),(5,'2025-05-05','Confirmada',4,2,2,1);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobantepagos`
--

DROP TABLE IF EXISTS `comprobantepagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprobantepagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagenComprobante` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaSubida` timestamp NULL DEFAULT NULL,
  `citaID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comprobantepagos_citas_FK` (`citaID`),
  CONSTRAINT `comprobantepagos_citas_FK` FOREIGN KEY (`citaID`) REFERENCES `citas` (`id`) ON DELETE SET DEFAULT ON UPDATE SET DEFAULT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobantepagos`
--

LOCK TABLES `comprobantepagos` WRITE;
/*!40000 ALTER TABLE `comprobantepagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantepagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formapagos`
--

DROP TABLE IF EXISTS `formapagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formapagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagenQR` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formapagos`
--

LOCK TABLES `formapagos` WRITE;
/*!40000 ALTER TABLE `formapagos` DISABLE KEYS */;
INSERT INTO `formapagos` VALUES (1,'Efectivo','No corresponde'),(2,'QR',NULL);
/*!40000 ALTER TABLE `formapagos` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'09:00:00','10:00:00'),(2,'10:00:00','11:00:00'),(3,'11:00:00','12:00:00'),(4,'15:00:00','16:00:00'),(5,'16:00:00','17:00:00'),(6,'17:00:00','18:00:00'),(7,'18:00:00','19:00:00'),(8,'19:00:00','20:00:00'),(9,'20:00:00','21:00:00');
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
  `nombre` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Corte de Cabello Mujer',90.00),(2,'Corte de Cabello Hombre',80.00),(3,'Corte de Cabello Niño',60.00),(4,'Peinado Mujer',80.00),(5,'Peinado Hombre',60.00),(6,'Peinado Niño',60.00),(7,'Corte de Barba',60.00),(8,'Tinte Mujer',300.00),(9,'Uñas',400.00),(10,'Lavado de Cabello',50.00),(11,'Tratamiento Capilar',150.00),(12,'Tinte Hombre',250.00);
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
  `nombre` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` tinyint DEFAULT NULL,
  `confirmado` tinyint DEFAULT NULL,
  `token` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Juan Carlos','Collao Mamani','carloscollao3@gmail.com','$2y$10$73ifbBYHLI48BUenrETYUOGCvP2IEEQ0VbXW7uAqT/Jtqn7skEUEi','69575687',1,1,''),(2,'test','test','test@test.com','$2y$10$i47DLu2fBWaT..ZAS7VoFesBYhr4DLY0zkWfH5cUGRgwART7N2z9.','12345678',0,1,''),(3,'Juan','Test2','juan@test.com','$2y$10$E90FH.zrlFi1G7qYpKjPuujjtvVaO7BFTO.a0Dxr0IBqHFFUL0Qyu','69575687',0,1,'');
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

-- Dump completed on 2025-05-02 12:16:31
