-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: appsalon_mvc
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
  `hora` time DEFAULT NULL,
  `usuarioID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_usuarios_FK` (`usuarioID`),
  CONSTRAINT `citas_usuarios_FK` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citasservicios`
--

DROP TABLE IF EXISTS `citasservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citasservicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `citaID` int DEFAULT NULL,
  `servicioID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citasServicios_citas_FK` (`citaID`),
  KEY `citasServicios_servicios_FK` (`servicioID`),
  CONSTRAINT `citasServicios_citas_FK` FOREIGN KEY (`citaID`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `citasServicios_servicios_FK` FOREIGN KEY (`servicioID`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citasservicios`
--

LOCK TABLES `citasservicios` WRITE;
/*!40000 ALTER TABLE `citasservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `citasservicios` ENABLE KEYS */;
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
  `telefono` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` tinyint DEFAULT NULL,
  `confirmado` tinyint DEFAULT NULL,
  `token` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,'Carlos','collao','carloscollao3@gmail.com','69575687',0,1,'','$2y$10$inpLAsFdyfRiyyUort4kBuxdKLQPyU0x17TQFL.OO03kCzazx/wo6');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'appsalon_mvc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-18 21:20:43
