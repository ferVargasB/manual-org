CREATE DATABASE  IF NOT EXISTS `manual_org` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `manual_org`;
-- MySQL dump 10.13  Distrib 5.6.34, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: manual_org
-- ------------------------------------------------------
-- Server version	5.6.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actores`
--

DROP TABLE IF EXISTS `actores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actores` (
  `id_actor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `es_director` int(11) DEFAULT NULL,
  `ruta_atribucion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actores`
--

LOCK TABLES `actores` WRITE;
/*!40000 ALTER TABLE `actores` DISABLE KEYS */;
INSERT INTO `actores` VALUES (9,'Director de Fraccionamientos',1,'atribuciones-pdf/funcionarios/director-DdF.pdf'),(10,'Jefe de Uso de Suelo',0,'Sin atribución'),(11,'Jefe de Alineamientos',0,'Sin atribución'),(12,'Inspector',0,'Sin atribución'),(13,'Personal del Departamento',0,'Sin atribución'),(14,'Ventanilla',0,'Sin atribución'),(15,'Solicitante',0,'Sin atribución');
/*!40000 ALTER TABLE `actores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `dependencia_perteneciente` int(11) NOT NULL,
  `ruta_perfil_puesto` varchar(200) DEFAULT 'Sin Ruta',
  `ruta_atribucion` varchar(200) DEFAULT 'Sin Ruta',
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Dirección de Atención Ciudadana',101,'Sin Ruta','Sin Ruta'),(2,'Dirección de Atención Ciudadana',101,'Sin Ruta','Sin Ruta'),(3,'Dirección de Relaciones Públicas Instituciona',101,'Sin Ruta','Sin Ruta'),(4,'Subsecretaría Operativa',102,'Sin Ruta','Sin Ruta'),(5,'Dirección Técnica Administrativa',102,'Sin Ruta','Sin Ruta'),(6,'Comisaría de la Policía Preventiva',102,'Sin Ruta','Sin Ruta'),(7,'Dirección de Protección Civil',102,'Sin Ruta','Sin Ruta'),(8,'Dirección de Fiscalización y Control',102,'Sin Ruta','Sin Ruta'),(9,'Dirección de la Función Edilicia',103,'Sin Ruta','Sin Ruta'),(10,'Dirección de Archivo Municipal',103,'Sin Ruta','Sin Ruta'),(11,'Unidad de Acceso a la Información Pública',103,'Sin Ruta','Sin Ruta'),(12,'Dirección de Gobierno',103,'Sin Ruta','Sin Ruta'),(13,'Coordinación General de Administración',104,'Sin Ruta','Sin Ruta'),(14,'Coordinación General de Finanzas',104,'Sin Ruta','Sin Ruta'),(15,'Dirección de Ingresos',104,'Sin Ruta','Sin Ruta'),(16,'Dirección de Catastro e Impuesto Predial',104,'Sin Ruta','Sin Ruta'),(17,'Dirección de Auditoría Contable y Financiera',105,'Sin Ruta','Sin Ruta'),(18,'Dirección de Auditoría de Obra Pública',105,'Sin Ruta','Sin Ruta'),(19,'Dirección de Contraloría Social e Investigaci',105,'Sin Ruta','Sin Ruta'),(20,'Dirección de Asuntos Jurídicos y Responsabili',105,'Sin Ruta','Sin Ruta'),(21,'Coordinación de Planeación y Difusión								',106,'Sin Ruta','Sin Ruta'),(22,'Dirección Técnica Admistrativa								',100,'Sin Ruta','Sin Ruta'),(23,'Dirección de Administración Urbana								',100,'Sin Ruta','Sin Ruta'),(24,'Dirección de Imagen Urbana y Gestión del Cent',100,'Sin Ruta','Sin Ruta'),(25,'Dirección de Ecología y Medio Ambiente							',100,'Sin Ruta','Sin Ruta'),(26,'Dirección de Vivienda								',100,'Sin Ruta','Sin Ruta'),(27,'Subdirección General de Obra Pública								',107,'Sin Ruta','Sin Ruta'),(28,'Dirección Técnica Administrativa								',107,'Sin Ruta','Sin Ruta'),(29,'Dirección de Programación de Obra, Estudios y Proyectos								',107,'Sin Ruta','Sin Ruta'),(30,'Dirección de Construcción								',107,'Sin Ruta','Sin Ruta'),(31,'Dirección de Mantenimiento								',107,'Sin Ruta','Sin Ruta'),(32,'Dirección de Promoción Turística								',108,'Sin Ruta','Sin Ruta'),(33,'Dirección de Desarrollo Turístico								',108,'Sin Ruta','Sin Ruta'),(34,'Dirección de Atención a MiPyMES y Sectores Productivos								',108,'Sin Ruta','Sin Ruta'),(35,'Dirección de Promoción Económica y Atracción de Inversiones								',108,'Sin Ruta','Sin Ruta'),(36,'Centro de Convivencia El Encino								',109,'Sin Ruta','Sin Ruta'),(37,'Dirección de Participación Social',109,'Sin Ruta','Sin Ruta'),(38,'Dirección de Desarrollo Rural',109,'Sin Ruta','Sin Ruta'),(39,'Dirección de Proyectos Productivos',109,'Sin Ruta','Sin Ruta'),(40,'Dirección de Programas Sociales',109,'Sin Ruta','Sin Ruta'),(41,'Dirección de Salud',109,'Sin Ruta','Sin Ruta'),(42,'Dirección de Museo de las Momias',110,'Sin Ruta','Sin Ruta'),(43,'Dirección de Servicios Básicos',113,'Sin Ruta','Sin Ruta'),(44,'Dirección de Servicios Complementarios',113,'Sin Ruta','Sin Ruta'),(45,'Dirección de Alumbrado Público',113,'Sin Ruta','Sin Ruta'),(46,'Subdirección General de Normatividad',111,'Sin Ruta','Sin Ruta'),(47,'Subdirección General de lo Contencioso Administrativo',111,'Sin Ruta','Sin Ruta'),(48,'Dirección de Innovación Gubernamental								',112,'Sin Ruta','Sin Ruta'),(49,'Dirección de Proyectos Estratégicos',100,'Sin Ruta','Sin Ruta'),(50,'Dirección de Seguimiento y Desarrollo Gubernamental',112,'Sin Ruta','Sin Ruta');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dependencias`
--

DROP TABLE IF EXISTS `dependencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependencias` (
  `id_dependencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ruta_objetivo_general` varchar(200) DEFAULT NULL,
  `ruta_perfil_puesto` varchar(200) DEFAULT NULL,
  `ruta_atribuciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_dependencia`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependencias`
--

LOCK TABLES `dependencias` WRITE;
/*!40000 ALTER TABLE `dependencias` DISABLE KEYS */;
INSERT INTO `dependencias` VALUES (100,'Dirección General de Medio Ambiente y Ordenamiento Territorial ','objetivos-pdf/generales/obj-gral-dir-maot.pdf','perfiles-pdf/dependencias/perfil-puesto-maot.pdf','atribuciones-pdf/dependencias/atribu-maot.pdf'),(101,'Secretaría Particular',NULL,NULL,NULL),(102,'Secretaría de Seguridad Ciudadana',NULL,NULL,NULL),(103,'Secretaría de Ayuntamiento',NULL,NULL,NULL),(104,'Tesorería Municipal',NULL,NULL,NULL),(105,'Contraloría Municipal',NULL,NULL,NULL),(106,'Dirección General de Atención a las Mujeres',NULL,NULL,NULL),(107,'Direccion General de Obra Pública',NULL,NULL,NULL),(108,'Dirección General de Desarrollo Turístico y Económico',NULL,NULL,NULL),(109,'Dirección General de Desarrollo Social y Humano',NULL,NULL,NULL),(110,'Direccion General de Cultura y Educación',NULL,NULL,NULL),(111,'Dirección General de Servicios Jurídicos',NULL,NULL,NULL),(112,'Unidad de Innovación y Políticas Públicas',NULL,NULL,NULL),(113,'Dirección de Servicios Básicos',NULL,NULL,NULL),(114,'fernando vargas bravo','objetivos-pdf\\generales\\dependencia-fvb.pdf','perfiles-pdf\\dependencias\\dependencia-fvb.pdf','atribuciones-pdf\\dependencias\\dependencia-fvb.pdf');
/*!40000 ALTER TABLE `dependencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesos`
--

DROP TABLE IF EXISTS `procesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesos` (
  `id_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `ruta_diagrama` varchar(200) NOT NULL,
  `ruta_ficha` varchar(200) NOT NULL,
  `numero_actores` int(11) NOT NULL,
  `area_perteneciente` int(11) NOT NULL,
  PRIMARY KEY (`id_proceso`),
  KEY `proceso_area_fk_idx` (`area_perteneciente`),
  CONSTRAINT `proceso_area_fk` FOREIGN KEY (`area_perteneciente`) REFERENCES `areas` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesos`
--

LOCK TABLES `procesos` WRITE;
/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
INSERT INTO `procesos` VALUES (8,'Dictamen de Alineamiento y Número Oficial','procesos-pdf/diagrama-proceso-DDAYNO.png','fichas-pdf/procesos/diagrama-proceso-DDAYNO.pdf',7,23);
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesos_actores`
--

DROP TABLE IF EXISTS `procesos_actores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesos_actores` (
  `id_proceso` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL,
  PRIMARY KEY (`id_proceso`,`id_actor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesos_actores`
--

LOCK TABLES `procesos_actores` WRITE;
/*!40000 ALTER TABLE `procesos_actores` DISABLE KEYS */;
INSERT INTO `procesos_actores` VALUES (8,9),(8,10),(8,11),(8,12),(8,13),(8,14),(8,15);
/*!40000 ALTER TABLE `procesos_actores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_areas`
--

DROP TABLE IF EXISTS `sub_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_areas` (
  `id_subarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT 'Sin nombre',
  `ruta_perfil_puesto` varchar(200) DEFAULT 'Sin Ruta',
  `atribucion` varchar(200) DEFAULT 'Sin Ruta',
  `area_perteneciente` int(11) NOT NULL,
  PRIMARY KEY (`id_subarea`),
  KEY `fk_subarea_area_idx` (`area_perteneciente`),
  CONSTRAINT `fk_areas_subareas` FOREIGN KEY (`area_perteneciente`) REFERENCES `areas` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_areas`
--

LOCK TABLES `sub_areas` WRITE;
/*!40000 ALTER TABLE `sub_areas` DISABLE KEYS */;
INSERT INTO `sub_areas` VALUES (1,'Departamento de Uso de Suelo','Sin Ruta','Sin Ruta',23),(2,'Departamento de Fraccionamientos y División de Predios','Sin Ruta','Sin Ruta',23),(3,'Departamento de Alineamientos y Número Oficial','Sin Ruta','Sin Ruta',23);
/*!40000 ALTER TABLE `sub_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `rol` varchar(30) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'fernando','fsnake_arg@hotmail.com','admin123','director','webmaster');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-08 15:06:31
