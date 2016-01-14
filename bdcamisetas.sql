CREATE DATABASE  IF NOT EXISTS `bdcamisetas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bdcamisetas`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: bdcamisetas
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `camiseta`
--

DROP TABLE IF EXISTS `camiseta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `camiseta` (
  `idCamiseta` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `cod_camiseta` varchar(20) DEFAULT NULL,
  `nombre_cam` varchar(100) DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `descripcion` text,
  `anuncio` text,
  `seleccionada` tinyint(1) DEFAULT NULL,
  `mostrar` tinyint(1) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCamiseta`),
  UNIQUE KEY `codigo_cam_UNIQUE` (`cod_camiseta`),
  KEY `fk_Camiseta_Categoria_idx` (`idCategoria`),
  CONSTRAINT `fk_Camiseta_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camiseta`
--

LOCK TABLES `camiseta` WRITE;
/*!40000 ALTER TABLE `camiseta` DISABLE KEYS */;
/*!40000 ALTER TABLE `camiseta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `cod_categoria` varchar(20) DEFAULT NULL,
  `nombre_cat` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `anuncio` text,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `cod_categoria_UNIQUE` (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (5,'CAT_LIGABBVA','Liga BBVA','Liga de primera división de España',NULL),(6,'CAT_LIGAPORTUGAL','Liga Portuguesa','Liga de primera división de Portugal',NULL),(7,'CAT_LIGUE1','Ligue 1','Liga de primera división de Francia',NULL),(8,'CAT_BUNDELISGA','Bundesliga','Liga de primera división de Alemania',NULL),(9,'CAT_PREMIER','Premier League','Liga de primera división de Inglaterra',NULL),(10,'CAT_SERIEA','Seria A','Liga de primera división de Italia',NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea_pedido`
--

DROP TABLE IF EXISTS `linea_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linea_pedido` (
  `id_LineaPedido` int(11) NOT NULL,
  `idCamiseta` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_LineaPedido`),
  KEY `fk_Venta_has_Camiseta_Camiseta1_idx` (`idCamiseta`),
  KEY `fk_Linea_Pedido_Pedido1_idx` (`idPedido`),
  CONSTRAINT `fk_Linea_Pedido_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_has_Camiseta_Camiseta1` FOREIGN KEY (`idCamiseta`) REFERENCES `camiseta` (`idCamiseta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_pedido`
--

LOCK TABLES `linea_pedido` WRITE;
/*!40000 ALTER TABLE `linea_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `linea_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `importe` decimal(10,2) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `cod_provincia` varchar(45) DEFAULT NULL,
  `nombre_persona` varchar(40) DEFAULT NULL,
  `apellidos_persona` varchar(60) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `correo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_Pedido_Usuario1_idx` (`idUsuario`),
  CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `cod` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) DEFAULT NULL COMMENT 'Código de la comunidad a la que pertenece',
  PRIMARY KEY (`cod`),
  KEY `nombre` (`nombre`),
  KEY `FK_ComunidadAutonomaProv` (`comunidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES ('01','Alava',16),('02','Albacete',7),('03','Alicante',10),('04','Almería',1),('05','Avila',8),('06','Badajoz',11),('07','Balears (Illes)',4),('08','Barcelona',9),('09','Burgos',8),('10','Cáceres',11),('11','Cádiz',1),('12','Castellón',10),('13','Ciudad Real',7),('14','Córdoba',1),('15','Coruña (A)',12),('16','Cuenca',7),('17','Girona',9),('18','Granada',1),('19','Guadalajara',7),('20','Guipzcoa',16),('21','Huelva',1),('22','Huesca',2),('23','Jaén',1),('24','León',8),('25','Lleida',9),('26','Rioja (La)',17),('27','Lugo',12),('28','Madrid',13),('29','Málaga',1),('30','Murcia',14),('31','Navarra',15),('32','Ourense',12),('33','Asturias',3),('34','Palencia',8),('35','Palmas (Las)',5),('36','Pontevedra',12),('37','Salamanca',8),('38','Santa Cruz de Tenerife',5),('39','Cantabria',6),('40','Segovia',8),('41','Sevilla',1),('42','Soria',8),('43','Tarragona',9),('44','Teruel',2),('45','Toledo',7),('46','Valencia',10),('47','Valladolid',8),('48','Vizcaya',16),('49','Zamora',8),('50','Zaragoza',2),('51','Ceuta',18),('52','Melilla',19);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `cod_provincia` char(2) NOT NULL,
  `nombre_usu` varchar(30) DEFAULT NULL,
  `clave` varchar(60) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `correo` varchar(180) DEFAULT NULL,
  `nombre_persona` varchar(40) DEFAULT NULL,
  `apellidos_persona` varchar(60) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombre_usu_UNIQUE` (`nombre_usu`),
  KEY `fk_Usuario_tbl_provincias1_idx` (`cod_provincia`),
  CONSTRAINT `fk_Usuario_tbl_provincias1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincias` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-14 16:53:19
