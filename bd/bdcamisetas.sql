-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2016 a las 12:54:33
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcamisetas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camiseta`
--

CREATE TABLE IF NOT EXISTS `camiseta` (
  `idCamiseta` int(11) NOT NULL,
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
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `camiseta`
--

INSERT INTO `camiseta` (`idCamiseta`, `idCategoria`, `cod_camiseta`, `nombre_cam`, `precio`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `seleccionada`, `mostrar`, `fecha_inicio`, `fecha_fin`, `stock`) VALUES
(1, 1, 'CAM_RM', 'Camiseta Real Madrid CF', '23.00', '0.00', 'cat_1/1.jpg', '21.00', 'Camiseta Real Madrid Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 5),
(2, 1, 'CAM_FCB', 'Camiseta FC Barcelona', '23.00', '0.00', 'cat_1/2.jpg', '21.00', 'Camiseta FC Barcelona Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 20),
(3, 1, 'CAM_ATL', 'Camiseta Atlético de Madrid', '23.00', '10.00', 'cat_1/3.jpg', '21.00', 'Camiseta Atlético de Madrid Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 30),
(4, 2, 'CAM_OPO', 'Camiseta Oporto', '18.00', '0.00', 'cat_2/4.jpg', '21.00', 'Camiseta Oporto Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 20),
(5, 2, 'CAM_BEN', 'Camiseta Benfica', '18.00', '50.00', 'cat_2/5.jpg', '21.00', 'Camiseta Benfica Home 2015/2016', '', 1, 1, '2016-01-10', '2016-12-31', 27),
(6, 2, 'CAM_SPO', 'Camiseta Sporting Portugal', '18.00', '20.00', 'cat_2/6.jpg', '21.00', 'Camiseta Sporting Portugal Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 23),
(7, 3, 'CAM_PSG', 'Camiseta Paris Saint Germain', '19.00', '0.00', 'cat_3/7.jpg', '21.00', 'Camiseta Paris Saint Germain Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 16),
(8, 3, 'CAM_LYO', 'Camiseta Olympique de Lyon', '19.00', '0.00', 'cat_3/8.jpg', '21.00', 'Camiseta Olympique de Lyon Home 2015/2016', '', 1, 1, '2016-01-16', '2016-01-16', 15),
(9, 3, 'CAM_MAR', 'Camiseta Olympique de Marsella', '19.00', '25.00', 'cat_3/9.jpg', '21.00', 'Camiseta Olympique de Marsella Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 34),
(10, 4, 'CAM_BMU', 'Camiseta Bayern de Múnich', '20.00', '0.00', 'cat_4/10.jpg', '21.00', 'Camiseta Bayern de Múnich Home 2015/2016', '', 1, 0, '2016-01-01', '2016-12-31', 33),
(11, 4, 'CAM_BVB', 'Camiseta Borussia Dortmund', '20.00', '0.00', 'cat_4/11.jpg', '21.00', 'Camiseta Borussia Dortmund Home 2015/2016', '', 1, 0, '2016-01-01', '2016-12-31', 33),
(12, 4, 'CAM_SHA', 'Camiseta FC Schalke 04', '20.00', '15.00', 'cat_4/12.jpg', '21.00', 'Camiseta FC Schalke 04 Home 2015/2016', '', 1, 0, '2016-01-01', '2016-12-31', 38),
(13, 5, 'CAM_MUN', 'Camiseta Manchester United', '24.00', '0.00', 'cat_5/13.jpg', '21.00', 'Camiseta Manchester United Home 2015/2016', '', 1, 1, '2016-01-17', '2016-01-27', 17),
(14, 5, 'CAM_CHE', 'Camiseta Chelsea', '24.00', '0.00', 'cat_5/14.jpg', '21.00', 'Camiseta Chelsea Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 3),
(15, 5, 'CAM_LiV', 'Camiseta Liverpool', '24.00', '10.00', 'cat_5/15.jpg', '21.00', 'Camiseta Liverpool Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 9),
(16, 6, 'CAM_JUV', 'Camiseta Juventus de Turín', '23.00', '0.00', 'cat_6/16.jpg', '21.00', 'Camiseta Juventus de Turín Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 23),
(17, 6, 'CAM_MIL', 'Camiseta AC Milán', '23.00', '0.00', 'cat_6/17.jpg', '21.00', 'Camiseta AC Milán Home 2015/2016', '', 1, 0, '2016-01-01', '2016-12-31', 43),
(18, 6, 'CAM_INT', 'Camiseta Inter de Milán', '23.00', '5.00', 'cat_6/18.jpg', '21.00', 'Camiseta Inter de Milán Home 2015/2016', '', 0, 1, '2016-01-01', '2016-12-31', 39),
(19, 1, 'CAM_ATB', 'Camiseta Athletic Club', '23.00', '3.00', 'cat_1/19.jpg', '21.00', 'Camiseta Athletic Club Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 5),
(20, 1, 'CAM_SEV', 'Camiseta Sevilla FC', '23.00', '0.00', 'cat_1/20.jpg', '21.00', 'Camiseta Sevilla FC Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 7),
(21, 1, 'CAM_ESP', 'Camiseta Real Club Deportivo Español', '23.00', '2.00', 'cat_1/21.jpg', '21.00', 'Camiseta RCD Espanyol Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 7),
(22, 1, 'CAM_VAL', 'Camiseta Valencia Club de Fútbol', '23.00', '0.00', 'cat_1/22.jpg', '21.00', 'Camiseta Valencia CF Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 20),
(23, 1, 'CAM_RSO', 'Camiseta Real Sociedad de Fútbol', '23.00', '0.00', 'cat_1/23.jpg', '21.00', 'Camiseta Real Sociedad de Fútbol Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 24),
(24, 1, 'CAM_GET', 'Camiseta Getafe Club de Fútbol', '23.00', '45.00', 'cat_1/24.jpg', '21.00', 'Camiseta Getafe CF Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 22),
(25, 1, 'CAM_VIL', 'Camiseta Villarreal Club de Fútbol', '23.00', '12.00', 'cat_1/25.jpg', '21.00', 'Camiseta Villarreal CF Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 15),
(26, 1, 'CAM_CEL', 'Camiseta Real Club Celta de Vigo', '23.00', '10.00', 'cat_1/26.jpg', '21.00', 'Camiseta RC Celta de Vigo Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 15),
(27, 1, 'CAM_LEV', 'Camiseta Levante Unión Deportiva', '23.00', '10.00', 'cat_1/27.jpg', '21.00', 'Camiseta Levante UD Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 14),
(28, 1, 'CAM_DEP', 'Camiseta Real Club Deportivo de La Coruña', '23.00', '10.00', 'cat_1/28.jpg', '21.00', 'Camiseta RC Deportivo de La Coruña Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 17),
(29, 1, 'CAM_BET', 'Camiseta Real Betis', '23.00', '0.00', 'cat_1/29.jpg', '21.00', 'Camiseta Real Betis Balompié Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 19),
(30, 1, 'CAM_SPG', 'Camiseta Sporting de Gijón', '23.00', '8.00', 'cat_1/30.jpg', '21.00', 'Camiseta Real Sporting de Gijón Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 19),
(31, 7, 'CAM_SEL_ESP', 'Camiseta Selección Española', '26.00', '0.00', 'cat_7/31.jpg', '21.00', 'Camiseta Selección de España Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 6),
(32, 7, 'CAM_SEL_HOL', 'Camiseta Selección Holandesa', '26.00', '3.00', 'cat_7/32.jpg', '21.00', 'Camiseta Selección de Holanda Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 16),
(33, 7, 'CAM_SEL_ALE', 'Camiseta Selección Alemana', '26.00', '0.00', 'cat_7/33.jpg', '21.00', 'Camiseta Selección de Alemania Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 16),
(34, 7, 'CAM_SEL_ING', 'Camiseta Selección Inglesa', '26.00', '3.00', 'cat_7/34.jpg', '21.00', 'Camiseta Selección de Inglaterra Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 16),
(35, 7, 'CAM_SEL_FRA', 'Camiseta Selección Francesa', '26.00', '2.00', 'cat_7/35.jpg', '21.00', 'Camiseta Selección de Francia Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 14),
(36, 7, 'CAM_SEL_POR', 'Camiseta Selección Portuguesa', '26.00', '2.00', 'cat_7/36.jpg', '21.00', 'Camiseta Selección de Portugal Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 13),
(37, 7, 'CAM_SEL_BEL', 'Camiseta Selección Belga', '26.00', '7.00', 'cat_7/37.jpg', '21.00', 'Camiseta Selección de Bélgica Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 13),
(38, 7, 'CAM_SEL_RUS', 'Camiseta Selección Rusa', '26.00', '17.00', 'cat_7/38.jpg', '21.00', 'Camiseta Selección de Rusia Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 33),
(39, 7, 'CAM_SEL_ARG', 'Camiseta Selección Argentina', '26.00', '0.00', 'cat_7/39.jpg', '21.00', 'Camiseta Selección de Argentina Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 13),
(40, 7, 'CAM_SEL_BRA', 'Camiseta Selección Brasileña', '26.00', '0.00', 'cat_7/40.jpg', '21.00', 'Camiseta Selección de Brasil Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 13),
(41, 7, 'CAM_SEL_MEX', 'Camiseta Selección Méxicana', '26.00', '15.00', 'cat_7/41.jpg', '21.00', 'Camiseta Selección de México Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 15),
(42, 7, 'CAM_SEL_COL', 'Camiseta Selección Colombiana', '26.00', '17.00', 'cat_7/42.jpg', '21.00', 'Camiseta Selección de Colombia Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 33),
(43, 7, 'CAM_SEL_CRO', 'Camiseta Selección Croata', '26.00', '25.00', 'cat_7/43.jpg', '21.00', 'Camiseta Selección de Crocia Home 2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 37),
(44, 7, 'CAM_SEL_POL', 'Camiseta Selección Polaca', '26.00', '77.00', 'cat_7/44.jpg', '21.00', 'Camiseta Selección de Polonia Home 2016', NULL, 0, 1, '2016-01-01', '2016-12-31', 33),
(45, 7, 'CAM_SEL_IRL', 'Camiseta Selección Irlandesa', '26.00', '37.00', 'cat_7/45.jpg', '21.00', 'Camiseta Selección de la Rep. de Irlanda Home 2016', NULL, 0, 0, '2016-01-01', '2016-12-31', 33),
(46, 7, 'CAM_SEL_UCR', 'Camiseta Selección Ucraniana', '26.00', '47.00', 'cat_7/46.jpg', '21.00', 'Camiseta Selección de Ucrania Home 2016', NULL, 0, 0, '2016-01-01', '2016-12-31', 53),
(47, 5, 'CAM_ARS', 'Camiseta Arsenal Football Club', '24.00', '10.00', 'cat_5/47.jpg', '21.00', 'Camiseta Arsenal FC Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 15),
(48, 5, 'CAM_MAC', 'Camiseta Manchester City Football Club', '24.00', '10.00', 'cat_5/48.jpg', '21.00', 'Camiseta Manchester City FC Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 15),
(49, 6, 'CAM_ROM', 'Camiseta AS Roma', '23.00', '5.00', 'cat_6/49.jpg', '21.00', 'Camiseta AS Roma Home 2015/2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 17),
(50, 6, 'CAM_NAP', 'Camiseta SSC Napoli', '23.00', '5.00', 'cat_6/50.jpg', '21.00', 'Camiseta SSC Napoli Home 2015/2016', NULL, 1, 1, '2016-01-01', '2016-12-31', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL,
  `cod_categoria` varchar(20) DEFAULT NULL,
  `nombre_cat` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `anuncio` text,
  `mostrar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `cod_categoria`, `nombre_cat`, `descripcion`, `anuncio`, `mostrar`) VALUES
(1, 'CAT_LIGABBVA', 'Liga BBVA', 'Liga de primera división de España', NULL, 1),
(2, 'CAT_LIGAPORTUGAL', 'Liga Portuguesa', 'Liga de primera división de Portugal', NULL, 0),
(3, 'CAT_LIGUE1', 'Ligue 1', 'Liga de primera división de Francia', NULL, 1),
(4, 'CAT_BUNDELISGA', 'Bundesliga', 'Liga de primera división de Alemania', NULL, 1),
(5, 'CAT_PREMIER', 'Premier League', 'Liga de primera división de Inglaterra', NULL, 1),
(6, 'CAT_SERIEA', 'Seria A', 'Liga de primera división de Italia', NULL, 1),
(7, 'CAT_SELECCIONES', 'Selecciones Nacionales', 'Selecciones Nacionales de Fútbol', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `id_LineaPedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idCamiseta` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `importe` decimal(20,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea_pedido`
--

INSERT INTO `linea_pedido` (`id_LineaPedido`, `idPedido`, `idCamiseta`, `cantidad`, `precio`, `importe`, `iva`) VALUES
(1, 1, 1, 3, '23.00', '69.00', '21.00'),
(2, 1, 25, 1, '20.24', '20.24', '21.00'),
(3, 1, 31, 2, '26.00', '52.00', '21.00'),
(4, 2, 1, 3, '23.00', '69.00', '21.00'),
(5, 2, 25, 1, '20.24', '20.24', '21.00'),
(6, 2, 31, 3, '26.00', '78.00', '21.00'),
(7, 2, 26, 1, '20.70', '20.70', '21.00'),
(8, 2, 19, 1, '22.31', '22.31', '21.00'),
(9, 2, 15, 1, '21.60', '21.60', '21.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `importe` decimal(10,2) DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT 'Pendiente',
  `fecha_pedido` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `cod_provincia` varchar(45) DEFAULT NULL,
  `correo` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `idUsuario`, `importe`, `cantidad_total`, `estado`, `fecha_pedido`, `direccion`, `cp`, `cod_provincia`, `correo`) VALUES
(1, 0, '141.24', 6, 'Pendiente', '2016-02-04', 'Calle Huelva, 36', 21453, '51', 'isacm94@gmail.com'),
(2, 0, '231.85', 10, 'Pendiente', '2016-02-04', 'Calle Huelva, 36', 21453, '51', 'isacm94@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `cod` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) DEFAULT NULL COMMENT 'Código de la comunidad a la que pertenece'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod`, `nombre`, `comunidad_id`) VALUES
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almería', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cod_provincia` char(2) NOT NULL,
  `nombre_usu` varchar(30) DEFAULT NULL,
  `clave` varchar(260) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `correo` varchar(180) DEFAULT NULL,
  `nombre_persona` varchar(40) DEFAULT NULL,
  `apellidos_persona` varchar(60) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cod_provincia`, `nombre_usu`, `clave`, `dni`, `correo`, `nombre_persona`, `apellidos_persona`, `direccion`, `cp`, `estado`) VALUES
(0, '51', 'admin', '$2y$10$7lH0K8cSg8IEbPiTsabOaODC9oVJHaQ5KJd9WmTTb5fQ6JgIxuKby', '44248212f', 'isacm94@gmail.com', 'Admin', 'Admin Admin', 'Calle Huelva, 36', 21453, 'A'),
(1, '21', 'isacm94', '$2y$10$9isiSYMKQrfYA.p7jZqbaej9Hs/VqQuLH/FdwNyPHGKYg2821PTEm', '44248212f', 'isacm94@gmail.com', 'Isabel María', 'Calvo Mateos', 'Calle Cabreros, 36', 21720, 'A'),
(2, '06', 'adanwaky', '$2y$10$h//bUAInarvyiXuY/Ub0G.GOoSrRCbMi1TDsJnVzXRJ81cpTNzFe2', '44246522l', 'adanwaky@gmail.com', 'Adán', 'Candeas Mozo', 'Calle Huelva, 36', 21720, 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camiseta`
--
ALTER TABLE `camiseta`
  ADD PRIMARY KEY (`idCamiseta`),
  ADD UNIQUE KEY `codigo_cam_UNIQUE` (`cod_camiseta`),
  ADD KEY `fk_Camiseta_Categoria_idx` (`idCategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `cod_categoria_UNIQUE` (`cod_categoria`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD PRIMARY KEY (`id_LineaPedido`),
  ADD KEY `fk_Venta_has_Camiseta_Camiseta1_idx` (`idCamiseta`),
  ADD KEY `fk_Linea_Pedido_Pedido1_idx` (`idPedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_Pedido_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `FK_ComunidadAutonomaProv` (`comunidad_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombre_usu_UNIQUE` (`nombre_usu`),
  ADD KEY `fk_Usuario_tbl_provincias1_idx` (`cod_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camiseta`
--
ALTER TABLE `camiseta`
  MODIFY `idCamiseta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  MODIFY `id_LineaPedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camiseta`
--
ALTER TABLE `camiseta`
  ADD CONSTRAINT `fk_Camiseta_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD CONSTRAINT `fk_Linea_Pedido_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Venta_has_Camiseta_Camiseta1` FOREIGN KEY (`idCamiseta`) REFERENCES `camiseta` (`idCamiseta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_tbl_provincias1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincias` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
