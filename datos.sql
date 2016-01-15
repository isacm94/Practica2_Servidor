-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2016 a las 13:39:30
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

--
-- Volcado de datos para la tabla `camiseta`
--

INSERT INTO `camiseta` (`idCamiseta`, `idCategoria`, `cod_camiseta`, `nombre_cam`, `precio`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `seleccionada`, `mostrar`, `fecha_inicio`, `fecha_fin`, `stock`) VALUES
(1, 1, 'CAM_RM', 'Camiseta Real Madrid', '23.00', '0.00', '', '21.00', 'Camiseta Real Madrid Temporada Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 5),
(2, 1, 'CAM_FCB', 'Camiseta FC Barcelona', '23.00', '0.00', '', '21.00', 'Camiseta FC Barcelona Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 20),
(3, 1, 'CAM_ATL', 'Camiseta Atlético de Madrid', '23.00', '0.00', '', '21.00', 'Camiseta Atlético de Madrid Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 30),
(4, 2, 'CAM_OPO', 'Camiseta Oporto', '18.00', '0.00', '', '21.00', 'Camiseta Oporto Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 20),
(5, 2, 'CAM_BEN', 'Camiseta Benfica', '18.00', '0.00', '', '21.00', 'Camiseta Benfica Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 27),
(6, 2, 'CAM_SPO', 'Camiseta Sporting Portugal', '18.00', '0.00', '', '21.00', 'Camiseta Sporting Portugal Home 2015/2016', '', 0, 0, '2016-01-01', '2016-12-31', 23),
(7, 3, 'CAM_PSG', 'Camiseta Paris Saint Germain', '19.00', '0.00', '', '21.00', 'Camiseta Paris Saint Germain Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 16),
(8, 3, 'CAM_LYO', 'Camiseta Olympique de Lyon', '19.00', '0.00', '', '21.00', 'Camiseta Olympique de Lyon Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 15),
(9, 3, 'CAM_MAR', 'Camiseta Olympique de Marsella', '19.00', '0.00', '', '21.00', 'Camiseta Olympique de Marsella Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 34),
(10, 4, 'CAM_BMU', 'Camiseta Bayern de Múnich', '20.00', '0.00', '', '21.00', 'Camiseta Bayern de Múnich Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 33),
(11, 4, 'CAM_BVB', 'Camiseta Borussia Dortmund', '20.00', '0.00', '', '21.00', 'Camiseta Borussia Dortmund Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 33),
(12, 4, 'CAM_SHA', 'Camiseta FC Schalke 04', '20.00', '0.00', '', '21.00', 'Camiseta FC Schalke 04 Home 2015/2016', '', 0, 0, '2016-01-01', '2016-12-31', 38),
(13, 5, 'CAM_MUN', 'Camiseta Manchester United', '24.00', '0.00', '', '21.00', 'Camiseta Manchester United Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 17),
(14, 5, 'CAM_CHE', 'Camiseta Chelsea', '24.00', '0.00', '', '21.00', 'Camiseta Chelsea Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 3),
(15, 5, 'CAM_LV', 'Camiseta Liverpool', '24.00', '0.00', '', '21.00', 'Camiseta Liverpool Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 9),
(16, 6, 'CAM_JUV', 'Camiseta Juventus de Turín', '23.00', '0.00', '', '21.00', 'Camiseta Juventus de Turín Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 23),
(17, 6, 'CAM_MIL', 'Camiseta AC Milán', '23.00', '0.00', '', '21.00', 'Camiseta AC Milán Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 43),
(18, 6, 'CAM_INT', 'Camiseta Inter de Milán', '23.00', '0.00', '', '21.00', 'Camiseta Inter de Milán Home 2015/2016', '', 1, 1, '2016-01-01', '2016-12-31', 39);

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `cod_categoria`, `nombre_cat`, `descripcion`, `anuncio`) VALUES
(1, 'CAT_LIGABBVA', 'Liga BBVA', 'Liga de primera división de España', NULL),
(2, 'CAT_LIGAPORTUGAL', 'Liga Portuguesa', 'Liga de primera división de Portugal', NULL),
(3, 'CAT_LIGUE1', 'Ligue 1', 'Liga de primera división de Francia', NULL),
(4, 'CAT_BUNDELISGA', 'Bundesliga', 'Liga de primera división de Alemania', NULL),
(5, 'CAT_PREMIER', 'Premier League', 'Liga de primera división de Inglaterra', NULL),
(6, 'CAT_SERIEA', 'Seria A', 'Liga de primera división de Italia', NULL);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
