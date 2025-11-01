-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2025 a las 16:09:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL,
  `comunidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id`, `comunidad`) VALUES
(1, 'PALMICHAL'),
(2, 'LA ENSENADA'),
(3, 'CUJISAL'),
(4, 'EL CARDON'),
(5, 'AGUA AZUL'),
(6, 'ESPARRAMADERO'),
(7, 'CAJA DE AGUA'),
(8, 'PRODUCTORES DE CAMPO ALEGRE'),
(9, 'VILLAS DE YARA'),
(10, 'RENACER DE UN PUEBLO'),
(11, 'EL PARAISO'),
(12, 'DON ANTONIO'),
(13, 'MOTOCROSS'),
(14, 'ANA SUAREZ CENTRO'),
(15, 'LA MAPORITA'),
(16, 'EL JAGUEY'),
(17, 'SABANA DE TIQUIRE'),
(18, 'CERRO GRANDE'),
(19, 'TACARIGUITA'),
(20, 'REVOLUCION 106'),
(21, 'SIEMPRE ADELANTE 107 SAN JOSE'),
(22, 'MAIZANTA'),
(23, 'CREANDO CONCIENCIA'),
(24, 'UNIDAD Y ACCION'),
(25, 'MONTAÑITA I'),
(26, 'DANIEL CARIAS Y BANCO OBREROS'),
(27, 'MONTAÑITA III'),
(28, 'BARRIO BOLIVAR'),
(29, 'LA REALIDAD'),
(30, 'TEREPAIMA'),
(31, 'COLINAS DE TEREPAIMA (VOLUNTAD Y ACCION)'),
(32, 'BRISAS DE TEREPAIMA'),
(33, 'CASERIO DE CAÑAVERAL'),
(34, 'SOL BOLIVARIANO'),
(35, 'EL SALTO'),
(36, 'SABANA DE GUREMAL'),
(37, 'QUEBRADA GRANDE'),
(38, 'EL PLAYON'),
(39, 'BRISAS DEL PEGON'),
(40, 'ARENALES VIA EL SALTO'),
(41, 'CAMBURITO SECTOR LA CRISPINERA'),
(42, 'LA FLORIDA'),
(43, 'MONTANITA II BICENTENARIO'),
(44, 'II DE SEPTIEMBRE'),
(45, 'MONTAÑITA INDIO COY ( LIRIOS DEL VALLE)'),
(46, 'LA VICTORIA'),
(47, 'YACURAL'),
(48, 'TORBELLAN'),
(49, 'ANIMAS'),
(50, 'UVEDAL'),
(51, 'DON NICOLA'),
(52, 'EL SARURO'),
(53, 'PUEBLO UNIDO'),
(54, 'OVIDIO MARCHAN'),
(55, 'AGUA VIVA'),
(56, 'SAN ANTONIO LA TAPA'),
(57, 'BRISAS DE LA TAPA'),
(58, 'TAPA LA LUCHA'),
(59, 'EL POR VENIR'),
(60, 'FRANCISCA HERNANDEZ'),
(61, 'FABRICIO SEQUERA/ LA MORA'),
(62, 'RIVERA SANTA LUCIA'),
(63, 'ALDEA LA PAZ'),
(64, 'LA FUENTE'),
(65, 'CANAAN CELESTIAL TIERRA DE DIOS'),
(66, 'TOTUMILLO'),
(67, 'SAN ROQUE'),
(68, 'AMINTA ABREU'),
(69, 'LA VAQUERA BARRIO AJURO'),
(70, 'PIEDRA ARRIBA'),
(71, 'PIEDRA CENTRO'),
(72, 'SAN ANTONIO - LA PIEDRA'),
(73, 'PUEBLO NUEVO'),
(74, 'DON TEODORO'),
(75, 'TEOLINDA PAEZ'),
(76, 'SANTA EDUVIGE LOS RANCHOS'),
(77, 'PAZ BOLIVARIANA'),
(78, 'SOMOS TODOS'),
(79, 'URBANIZACION ARAGUANEY'),
(80, 'NUEVA ESPERANZA-CRISTO REY'),
(81, 'LOS REVOLUCIONARIOS'),
(82, 'VILLA OLIMPICA'),
(83, 'RAFAEL RANGEL'),
(84, 'SUEÑOS BOLIVARIANOS SABANITA 1'),
(85, 'SECTOR LA VIRGEN'),
(86, 'LA ROCA DE LA SALVACIÓN'),
(87, 'URIBEQUE'),
(88, 'URBANIZACION SIMON RODRIGUEZ III'),
(89, 'URBANIZACION SIMON RODRIGUEZ I'),
(90, 'SANTA INES'),
(91, 'ALI PRIMERA PLATANALES'),
(92, 'JUAN BERNARDO NAHACA'),
(93, 'LA ORQUIDEA'),
(94, 'SABANITA 4/ ALI PRIMERA'),
(95, 'VILLA JARDIN'),
(96, 'UNION BOLIVARIANA /BOLIVARIANA 1'),
(97, 'TRICENTENARIA POPULAR'),
(98, 'EL PINAL'),
(99, 'EL POZON'),
(100, 'LIMONCITO'),
(101, 'EL CARMELERO'),
(102, 'AGUA NEGRA'),
(103, 'AGUA LINDA'),
(104, 'ALBARICAL'),
(105, 'LA PERDOMERA'),
(106, 'LA HILERA'),
(107, 'PEGON PASTOR GARCIA'),
(108, 'TRICENTENARIA 1'),
(109, 'TERMO YARACUY'),
(110, 'ENCRUCIJADA'),
(111, 'VALLES DE PEÑA'),
(112, 'HATO VIEJO'),
(113, 'CAMINO NUEVO'),
(114, 'SAN RAFAEL'),
(115, 'LOS TUBOS'),
(116, 'LOS PATIECITOS'),
(117, 'POTRERITO'),
(118, 'CAÑADA TEMA'),
(119, 'EL MILAGRO DE BARRIO AJURO I'),
(120, 'BARRIO AJURO LAS 4R'),
(121, 'SAN ANTONIO (LA REVOLUCION DE SAN ANTONIO )'),
(122, 'EL VAPOR'),
(123, 'ARENALES( VIA LAS VELAS)'),
(124, 'AMIGO TRES CALLEJONES'),
(125, 'GRANVEL'),
(126, 'LAS VELAS CENTRO'),
(127, '5 Y 7 CASAS'),
(128, 'EL PALMAR'),
(129, 'YUMARITO'),
(130, 'SANTA BARBARA'),
(131, 'SANTA LUCIA'),
(132, 'LA CONCEPCION'),
(133, 'PILCO MAYO'),
(134, 'VILLAS SANTA LUCIA'),
(135, 'TIAMA'),
(136, 'LA BANDERA'),
(137, 'JOSE GREGORIO AMAYA'),
(138, 'LA TRILLA'),
(139, 'TIERRA AMARILLA'),
(140, 'EL CHIMBORAZO'),
(141, 'LA RURAL SECTOR 102'),
(142, 'EL JOBITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancias`
--

CREATE TABLE `constancias` (
  `id` int(11) NOT NULL,
  `id_manual` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE `despacho` (
  `id_despacho` int(11) NOT NULL,
  `id_manual` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `invalido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho`
--

INSERT INTO `despacho` (`id_despacho`, `id_manual`, `ci`, `estado`, `invalido`) VALUES
(19, 166, 3215, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(20, 167, 16654, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(21, 168, 4567, 'Solicitud Finalizada (Ayuda Entregada)', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_categoria`
--

CREATE TABLE `despacho_categoria` (
  `id` int(11) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `tipo_ayuda` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho_categoria`
--

INSERT INTO `despacho_categoria` (`id`, `id_despacho`, `categoria`, `tipo_ayuda`) VALUES
(9, 19, 'Materiales de Construcción', 'Bloques'),
(10, 20, 'Salud', 'Exámenes'),
(11, 21, 'Materiales de Construcción', 'Sacos de cemento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_correo`
--

CREATE TABLE `despacho_correo` (
  `id` int(11) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `correo_enviado` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho_correo`
--

INSERT INTO `despacho_correo` (`id`, `id_despacho`, `correo_enviado`) VALUES
(1, 19, 0),
(2, 20, 0),
(3, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_fecha`
--

CREATE TABLE `despacho_fecha` (
  `id` int(11) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho_fecha`
--

INSERT INTO `despacho_fecha` (`id`, `id_despacho`, `fecha`, `fecha_modificacion`, `fecha_renovacion`, `visto`) VALUES
(16, 19, '2025-10-31 12:28:40', '2025-10-31 12:44:35', '2025-10-31 12:28:40', 1),
(17, 20, '2025-10-31 12:51:44', '2025-10-31 12:53:54', '2025-10-31 12:51:44', 1),
(18, 21, '2025-10-31 12:58:19', '2025-10-31 12:59:00', '2025-10-31 12:58:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_info`
--

CREATE TABLE `despacho_info` (
  `id` int(11) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creador` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho_info`
--

INSERT INTO `despacho_info` (`id`, `id_despacho`, `descripcion`, `creador`) VALUES
(18, 19, 'No se', 'pepe gonzalez'),
(19, 20, 'Ni se', 'pepe gonzalez'),
(20, 21, 'No lo se', 'pepe gonzalez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_invalido`
--

CREATE TABLE `despacho_invalido` (
  `id` int(11) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `razon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_acciones`
--

CREATE TABLE `reportes_acciones` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(255) NOT NULL,
  `ci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_acciones`
--

INSERT INTO `reportes_acciones` (`id`, `id_doc`, `fecha`, `accion`, `ci`) VALUES
(1, 2, '2025-08-05 09:03:52', 'Envió la solicitud a administración por lo tanto, finalizó los 3 procesos, entregado!', 3434),
(2, 2, '2025-08-05 09:04:56', 'Reinició el proceso de la solicitud', 3434),
(3, 2, '2025-08-05 09:05:08', 'Recibió documento físico, y aprobó para su procedimiento', 3434),
(4, 2, '2025-08-05 09:34:19', 'Envió la solicitud a despacho.', 3434),
(5, 2, '2025-08-05 09:36:40', 'Envió la solicitud a administración.', 3434),
(6, 2, '2025-08-05 09:38:14', 'Confirmó que se aceptó la ayuda.', 3434),
(7, 2, '2025-08-05 09:38:26', 'Reinició el proceso de la solicitud.', 3434),
(8, 1, '2025-08-05 20:27:04', 'Envió la solicitud a Administración. (Despacho)', 123),
(9, 1, '2025-08-05 20:28:26', 'Confirmó que se entregó la ayuda. (Despacho)', 123),
(10, 1, '2025-08-05 20:28:36', 'Reinició la solicitud. (Despacho)', 123),
(11, 1, '2025-08-11 10:45:08', 'Inhabilitó la solicitud razón: porque siii', 3434),
(12, 1, '2025-08-11 10:48:01', 'Inhabilitó la solicitud razón: pqsi', 3434),
(13, 1, '2025-08-11 10:50:42', 'Inhabilitó la solicitud razón: pq si', 123),
(14, 1, '2025-08-11 10:51:04', 'Habilitó la solicitud', 123),
(15, 1, '2025-08-11 10:52:04', 'Habilitó la solicitud', 123),
(16, 2, '2025-08-11 21:08:20', 'Recibió documento físico, y aprobó para su procedimiento.', 34),
(17, 2, '2025-08-11 21:08:31', 'Envió la solicitud a despacho.', 34),
(18, 2, '2025-09-12 08:35:18', 'Envió la solicitud a administración.', 3434),
(19, 2, '2025-09-12 08:35:36', 'Confirmó que se aceptó la ayuda.', 3434),
(20, 2, '2025-09-12 08:35:47', 'Reinició el proceso de la solicitud.', 3434),
(21, 2, '2025-09-16 15:29:05', 'Recibió documento físico, y aprobó para su procedimiento.', 34),
(22, 2, '2025-09-16 15:29:16', 'Envió la solicitud a despacho.', 34),
(23, 2, '2025-09-16 15:31:32', 'Envió la solicitud a administración.', 123),
(24, 2, '2025-09-16 15:33:19', 'Confirmó que se aceptó la ayuda.', 321),
(25, 1, '2025-09-16 15:45:11', 'Envió la solicitud a Administración. (Despacho)', 123),
(26, 1, '2025-09-16 15:46:02', 'Confirmó que se entregó la ayuda. (Despacho)', 123),
(27, 1, '2025-09-16 15:46:12', 'Reinició la solicitud. (Despacho)', 123),
(28, 2, '2025-09-17 20:54:52', 'Reinició el proceso de la solicitud.', 3434),
(29, 2, '2025-09-17 20:55:11', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(30, 2, '2025-09-17 21:07:00', 'Envió la solicitud a despacho.', 3434),
(31, 2, '2025-09-17 21:07:11', 'Envió la solicitud a administración.', 3434),
(32, 2, '2025-09-17 21:07:22', 'Confirmó que se entregó la ayuda.', 3434),
(33, 2, '2025-09-20 14:25:40', 'Reinició el proceso de la solicitud.', 3434),
(34, 2, '2025-09-20 14:27:06', 'Recibió documento físico, y aprobó para su procedimiento.', 34),
(35, 2, '2025-09-20 14:27:25', 'Envió la solicitud a despacho.', 34),
(36, 2, '2025-09-20 14:28:34', 'Envió la solicitud a administración.', 123),
(37, 2, '2025-09-20 14:29:55', 'Confirmó que se entregó la ayuda.', 321),
(38, 2, '2025-09-20 16:03:23', 'Reinició el proceso de la solicitud.', 3434),
(39, 2, '2025-09-22 11:43:20', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(40, 2, '2025-09-22 11:43:28', 'Envió la solicitud a despacho.', 3434),
(41, 1, '2025-09-22 11:45:11', 'Envió la solicitud a Administración. (Despacho)', 123),
(42, 2, '2025-09-23 15:54:55', 'Envió la solicitud a administración.', 3434),
(43, 2, '2025-09-23 15:56:16', 'Confirmó que se entregó la ayuda.', 3434),
(44, 2, '2025-09-23 15:56:53', 'Reinició el proceso de la solicitud.', 3434),
(45, 2, '2025-09-25 12:43:35', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(46, 4, '2025-10-03 18:12:16', 'Creó una nueva constancia.', 3434),
(47, 13, '2025-10-06 09:35:21', 'Creó una nueva solicitud de ayuda.', 3434),
(48, 3, '2025-10-06 10:18:42', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(49, 3, '2025-10-06 10:18:55', 'Envió la solicitud a despacho.', 3434),
(50, 3, '2025-10-06 10:19:07', 'Envió la solicitud a administración.', 3434),
(51, 3, '2025-10-06 10:19:19', 'Confirmó que se entregó la ayuda.', 3434),
(52, 3, '2025-10-06 10:19:32', 'Reinició el proceso de la solicitud.', 3434),
(53, 13, '2025-10-12 16:32:03', 'Registró solicitud en Desarrollo Social', 3434),
(54, 13, '2025-10-12 16:39:18', 'Aprobó la solicitud para su procedimiento (Desarrollo Social)', 3434),
(55, 13, '2025-10-12 16:40:23', 'Envió la solicitud a Administración. (Desarrollo Social)', 3434),
(56, 13, '2025-10-12 16:40:35', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 3434),
(57, 13, '2025-10-12 16:40:47', 'Reinició la solicitud. (Desarrollo Social)', 3434),
(58, 14, '2025-10-12 17:02:00', 'Registró solicitud en Desarrollo Social', 3434),
(59, 13, '2025-10-12 18:46:47', 'Inhabilitó la solicitud razón: siempre estoy brishando', 3434),
(60, 13, '2025-10-12 18:51:35', 'Habilitó la solicitud', 3434),
(61, 13, '2025-10-12 18:53:29', 'Inhabilitó la solicitud razón: para probar algo', 3434),
(62, 13, '2025-10-12 19:23:03', 'Editó la solicitud de Desarrollo Social', 3434),
(63, 6, '2025-10-14 18:44:45', 'Creó una nueva solicitud de ayuda.', 3434),
(64, 4, '2025-10-14 20:31:19', 'Inhabilitó la solicitud razón: porque quiero inhabilitarla y soy arrecho', 3434),
(65, 4, '2025-10-14 20:34:37', 'Inhabilitó la solicitud razón: porque quiero ', 3434),
(66, 4, '2025-10-14 20:38:49', 'Habilitó la solicitud', 3434),
(67, 4, '2025-10-14 20:39:06', 'Inhabilitó la solicitud razón: de prueba 1', 3434),
(68, 4, '2025-10-14 20:39:17', 'Habilitó la solicitud', 3434),
(69, 7, '2025-10-14 21:01:54', 'Creó una nueva solicitud de ayuda.', 3434),
(70, 15, '2025-10-14 21:22:29', 'Creó una nueva solicitud de ayuda.', 3434),
(71, 6, '2025-10-15 09:17:28', 'Editó la solicitud', 3434),
(72, 6, '2025-10-15 09:20:57', 'Inhabilitó la solicitud razón: razoncita', 3434),
(73, 6, '2025-10-15 09:23:47', 'Editó la solicitud', 3434),
(74, 6, '2025-10-15 09:24:08', 'Habilitó la solicitud', 3434),
(75, 6, '2025-10-15 09:24:26', 'Inhabilitó la solicitud razón: pq si', 3434),
(76, 6, '2025-10-15 09:24:38', 'Habilitó la solicitud', 3434),
(77, 17, '2025-10-15 11:57:50', 'Creó una nueva solicitud de ayuda.', 3434),
(78, 19, '2025-10-15 11:59:02', 'Creó una nueva solicitud de ayuda.', 3434),
(79, 15, '2025-10-15 16:50:41', 'Registró solicitud en Desarrollo Social', 3434),
(80, 17, '2025-10-20 10:34:49', 'Registró solicitud en Desarrollo Social', 3434),
(81, 8, '2025-10-20 18:31:23', 'Inhabilitó la solicitud razón: para probar', 3434),
(82, 7, '2025-10-20 19:00:09', 'Envió la solicitud a despacho.', 3434),
(83, 5, '2025-10-21 09:45:43', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(84, 5, '2025-10-21 09:45:59', 'Envió la solicitud a despacho.', 3434),
(85, 5, '2025-10-21 09:46:11', 'Envió la solicitud a administración.', 3434),
(86, 5, '2025-10-21 09:46:24', 'Confirmó que se entregó la ayuda.', 3434),
(87, 5, '2025-10-21 09:46:36', 'Reinició el proceso de la solicitud.', 3434),
(88, 5, '2025-10-21 09:46:40', 'Reinició el proceso de la solicitud.', 3434),
(89, 12, '2025-10-21 09:58:36', 'Creó una nueva solicitud de ayuda.', 3434),
(90, 13, '2025-10-21 10:01:17', 'Creó una nueva solicitud de ayuda.', 3434),
(91, 14, '2025-10-21 10:03:49', 'Creó una nueva solicitud de ayuda.', 3434),
(92, 1, '2025-10-21 10:18:50', 'Creó una nueva solicitud de ayuda.', 3434),
(93, 18, '2025-10-21 10:57:30', 'Registró solicitud en Desarrollo Social', 3434),
(94, 2, '2025-10-23 09:23:14', 'Creó una nueva solicitud de ayuda.', 3434),
(95, 2, '2025-10-23 09:23:42', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(96, 2, '2025-10-23 09:23:55', 'Envió la solicitud a despacho.', 3434),
(97, 19, '2025-10-23 09:30:39', 'Registró solicitud en Desarrollo Social', 3434),
(98, 3, '2025-10-23 10:36:56', 'Creó una nueva solicitud de ayuda.', 3434),
(99, 4, '2025-10-23 10:37:36', 'Creó una nueva solicitud de ayuda.', 3434),
(100, 4, '2025-10-23 10:48:56', 'Recibió documento físico, y aprobó para su procedimiento.', 3434),
(101, 20, '2025-10-25 20:55:13', 'Registró solicitud en Desarrollo Social', 3434),
(102, 13, '2025-10-28 10:06:46', 'Envió la solicitud a Administración. (Despacho)', 3434),
(103, 4, '2025-10-29 10:56:44', 'Envió la solicitud a despacho. (General)', 3434),
(104, 3, '2025-10-29 10:57:03', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 3434),
(105, 20, '2025-10-29 10:57:09', 'Aprobó la solicitud para su procedimiento. (Desarrollo Social)', 3434),
(106, 14, '2025-10-29 10:57:14', 'Envió la solicitud a Administración. (Despacho)', 3434),
(107, 14, '2025-10-29 11:08:43', 'Confirmó que se entregó la ayuda. (Despacho)', 3434),
(108, 17, '2025-10-29 11:30:44', 'Registró solicitud. (Despacho)', 3434),
(109, 5, '2025-10-29 11:37:41', 'Creó una nueva solicitud de ayuda (General).', 3434),
(110, 6, '2025-10-29 11:41:51', 'Creó una nueva solicitud de ayuda (General).', 3434),
(111, 18, '2025-10-29 11:43:11', 'Registró solicitud. (Despacho)', 3434),
(112, 21, '2025-10-29 11:52:34', 'Registró solicitud (Desarrollo Social)', 3434),
(113, 18, '2025-10-29 12:25:39', 'Envió la solicitud a Administración. (Despacho)', 3434),
(114, 18, '2025-10-29 12:41:57', 'Reinició la solicitud. (Despacho)', 3434),
(115, 18, '2025-10-29 12:47:19', 'Envió la solicitud a Administración. (Despacho)', 3434),
(116, 20, '2025-10-29 13:17:23', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 3434),
(117, 20, '2025-10-29 13:17:41', 'Reinició la solicitud. (Desarrollo Social)', 3434),
(118, 20, '2025-10-29 13:18:21', 'Envió la solicitud a Administración. (Desarrollo Social)', 3434),
(119, 20, '2025-10-29 13:19:26', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 3434),
(120, 20, '2025-10-29 13:20:16', 'Reinició la solicitud. (Desarrollo Social)', 3434),
(121, 21, '2025-10-29 13:44:16', 'Aprobó la solicitud para su procedimiento. (Desarrollo Social)', 3434),
(122, 6, '2025-10-29 13:45:09', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 3434),
(123, 22, '2025-10-30 22:22:05', 'Registró solicitud (Desarrollo Social)', 34),
(124, 21, '2025-10-30 22:22:57', 'Envió la solicitud a Administración. (Desarrollo Social)', 34),
(125, 21, '2025-10-30 22:23:12', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 34),
(126, 6, '2025-10-31 09:30:49', 'Envió la solicitud a despacho. (General)', 34),
(127, 3, '2025-10-31 09:31:01', 'Envió la solicitud a despacho. (General)', 34),
(128, 22, '2025-10-31 09:32:41', 'Aprobó la solicitud para su procedimiento. (Desarrollo Social)', 34),
(129, 21, '2025-10-31 09:32:56', 'Reinició la solicitud. (Desarrollo Social)', 34),
(130, 22, '2025-10-31 09:34:04', 'Envió la solicitud a Administración. (Desarrollo Social)', 34),
(131, 5, '2025-10-31 09:39:16', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(132, 5, '2025-10-31 09:39:29', 'Envió la solicitud a despacho. (General)', 34),
(133, 22, '2025-10-31 09:40:23', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 34),
(134, 7, '2025-10-31 12:04:51', 'Creó una nueva solicitud de ayuda (General).', 34),
(135, 7, '2025-10-31 12:06:03', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(136, 7, '2025-10-31 12:06:20', 'Envió la solicitud a despacho. (General)', 34),
(137, 7, '2025-10-31 12:06:47', 'Envió la solicitud a administración. (General)', 123),
(138, 7, '2025-10-31 12:07:08', 'Confirmó que se entregó la ayuda. (General)', 321),
(139, 7, '2025-10-31 12:07:35', 'Reinició el proceso de la solicitud. (General)', 321),
(140, 7, '2025-10-31 12:25:23', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(141, 7, '2025-10-31 12:25:38', 'Envió la solicitud a despacho. (General)', 34),
(142, 7, '2025-10-31 12:26:20', 'Envió la solicitud a administración. (General)', 123),
(143, 7, '2025-10-31 12:26:58', 'Confirmó que se entregó la ayuda. (General)', 321),
(144, 23, '2025-10-31 12:28:33', 'Registró solicitud (Desarrollo Social)', 34),
(145, 19, '2025-10-31 12:28:42', 'Registró solicitud. (Despacho)', 123),
(146, 23, '2025-10-31 12:29:02', 'Aprobó la solicitud para su procedimiento. (Desarrollo Social)', 34),
(147, 19, '2025-10-31 12:29:09', 'Envió la solicitud a Administración. (Despacho)', 123),
(148, 23, '2025-10-31 12:29:21', 'Envió la solicitud a Administración. (Desarrollo Social)', 34),
(149, 23, '2025-10-31 12:29:42', 'Confirmó que se entregó la ayuda. (Desarrollo Social)', 34),
(150, 19, '2025-10-31 12:44:35', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(151, 20, '2025-10-31 12:51:46', 'Registró solicitud. (Despacho)', 123),
(152, 20, '2025-10-31 12:53:28', 'Envió la solicitud a Administración. (Despacho)', 123),
(153, 20, '2025-10-31 12:53:54', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(154, 21, '2025-10-31 12:58:21', 'Registró solicitud. (Despacho)', 123),
(155, 21, '2025-10-31 12:58:42', 'Envió la solicitud a Administración. (Despacho)', 123),
(156, 21, '2025-10-31 12:59:00', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(157, 21, '2025-11-01 10:35:12', 'Creó una nueva solicitud de ayuda (General).', 34),
(158, 21, '2025-11-01 10:35:59', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(159, 21, '2025-11-01 10:36:59', 'Envió la solicitud a despacho. (General)', 34),
(160, 21, '2025-11-01 10:43:48', 'Envió la solicitud a administración. (General)', 123),
(161, 21, '2025-11-01 10:45:53', 'Confirmó que se entregó la ayuda. (General)', 321);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_entradas`
--

CREATE TABLE `reportes_entradas` (
  `id` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_entradas`
--

INSERT INTO `reportes_entradas` (`id`, `ci`, `fecha_entrada`, `fecha_salida`) VALUES
(1, 3434, '2025-09-04 12:26:12', '2025-09-05 12:55:59'),
(2, 3434, '2025-09-05 12:56:05', '2025-09-12 08:24:41'),
(3, 3434, '2025-09-12 08:25:59', '2025-09-13 17:37:11'),
(4, 3434, '2025-09-13 17:37:17', '2025-09-14 08:45:06'),
(5, 3434, '2025-09-14 08:45:13', '2025-09-15 14:02:45'),
(6, 3434, '2025-09-15 14:02:54', '2025-09-16 14:48:19'),
(7, 3434, '2025-09-16 14:48:25', '2025-09-16 15:19:41'),
(8, 34, '2025-09-16 15:20:03', '2025-09-16 15:29:29'),
(9, 123, '2025-09-16 15:29:40', '2025-09-16 15:31:59'),
(10, 321, '2025-09-16 15:32:12', '2025-09-16 15:36:54'),
(11, 3434, '2025-09-16 15:39:29', '2025-09-16 15:40:27'),
(12, 123, '2025-09-16 15:40:38', '2025-09-16 15:43:06'),
(13, 3434, '2025-09-16 15:43:37', '2025-09-16 15:44:33'),
(14, 123, '2025-09-16 15:44:48', '2025-09-16 15:47:03'),
(15, 3434, '2025-09-17 14:46:06', '2025-09-17 14:57:31'),
(16, 3434, '2025-09-17 14:58:17', '2025-09-17 14:58:23'),
(17, 3434, '2025-09-17 14:58:50', '2025-09-17 14:59:06'),
(18, 3434, '2025-09-17 15:05:28', '2025-09-17 15:05:32'),
(19, 3434, '2025-09-17 15:06:17', '2025-09-17 15:06:22'),
(20, 3434, '2025-09-17 15:07:03', '2025-09-17 15:07:08'),
(21, 3434, '2025-09-17 15:07:37', '2025-09-17 15:10:03'),
(22, 3434, '2025-09-17 15:10:27', '2025-09-17 15:10:32'),
(23, 3434, '2025-09-17 15:12:15', '2025-09-17 15:12:30'),
(24, 3434, '2025-09-17 15:13:25', '2025-09-17 15:13:29'),
(25, 3434, '2025-09-17 15:20:39', '2025-09-18 15:44:49'),
(26, 3434, '2025-09-18 15:44:59', '2025-09-20 14:20:35'),
(27, 3434, '2025-09-20 14:20:43', '2025-09-20 14:24:00'),
(28, 34, '2025-09-20 14:24:19', '2025-09-20 14:25:07'),
(29, 3434, '2025-09-20 14:25:19', '2025-09-20 14:26:08'),
(30, 34, '2025-09-20 14:26:29', '2025-09-20 14:27:37'),
(31, 123, '2025-09-20 14:27:55', '2025-09-20 14:28:45'),
(32, 321, '2025-09-20 14:28:55', '2025-09-20 14:30:10'),
(33, 3434, '2025-09-20 14:30:25', '2025-09-20 16:07:06'),
(34, 123, '2025-09-20 16:09:04', '2025-09-22 11:23:30'),
(35, 3434, '2025-09-22 11:22:27', '2025-09-22 11:23:04'),
(36, 123, '2025-09-22 11:23:37', '2025-09-22 11:42:34'),
(37, 3434, '2025-09-22 11:42:46', '2025-09-22 11:43:42'),
(38, 123, '2025-09-22 11:43:54', '2025-09-22 12:01:05'),
(39, 3434, '2025-09-23 10:02:58', '2025-09-24 14:41:32'),
(40, 3434, '2025-09-24 14:41:39', '2025-09-24 17:22:43'),
(41, 3434, '2025-09-25 12:04:13', '2025-09-25 12:26:45'),
(42, 3434, '2025-09-25 12:40:21', '2025-10-03 08:09:01'),
(43, 3434, '2025-10-03 08:09:08', '2025-10-03 12:03:16'),
(44, 3434, '2025-10-03 12:03:22', '2025-10-03 15:50:09'),
(45, 3434, '2025-10-03 15:50:16', '2025-10-04 09:20:06'),
(46, 3434, '2025-10-04 09:20:14', '2025-10-05 10:53:54'),
(47, 3434, '2025-10-05 10:54:01', '2025-10-05 15:38:56'),
(48, 123, '2025-10-05 15:39:29', '2025-10-06 10:38:56'),
(49, 3434, '2025-10-06 07:51:39', '2025-10-06 10:38:11'),
(50, 123, '2025-10-06 10:39:04', '2025-10-06 10:57:21'),
(51, 123, '2025-10-06 11:03:07', '2025-10-06 11:03:13'),
(52, 123, '2025-10-06 11:03:25', '2025-10-06 11:03:32'),
(53, 3434, '2025-10-07 07:30:03', '2025-10-07 07:30:12'),
(54, 3434, '2025-10-07 07:30:19', '2025-10-07 07:30:50'),
(55, 3434, '2025-10-08 11:29:02', '2025-10-08 11:50:51'),
(56, 123, '2025-10-08 11:42:04', '2025-10-08 11:56:37'),
(57, 123, '2025-10-08 11:54:59', '2025-10-08 11:55:08'),
(58, 123, '2025-10-08 11:55:19', '2025-10-08 11:55:28'),
(59, 3434, '2025-10-08 11:56:18', '2025-10-08 11:59:47'),
(60, 3434, '2025-10-08 12:06:51', '2025-10-08 12:31:01'),
(61, 3434, '2025-10-08 12:31:09', '2025-10-08 12:31:19'),
(62, 3434, '2025-10-08 12:41:09', '2025-10-08 14:06:08'),
(63, 3434, '2025-10-08 14:06:16', '2025-10-08 14:06:23'),
(64, 3434, '2025-10-08 14:07:25', '2025-10-08 14:07:33'),
(65, 3434, '2025-10-09 15:25:54', '2025-10-09 15:26:01'),
(66, 3434, '2025-10-09 15:31:41', '2025-10-09 15:31:51'),
(67, 3434, '2025-10-09 15:35:50', '2025-10-09 15:38:49'),
(68, 123, '2025-10-09 15:39:01', '2025-10-09 15:39:08'),
(69, 3434, '2025-10-09 15:39:19', '2025-10-10 15:33:19'),
(70, 3434, '2025-10-10 15:33:27', '2025-10-12 08:35:27'),
(71, 3434, '2025-10-12 08:35:36', '2025-10-12 12:09:25'),
(72, 3434, '2025-10-12 12:09:37', '2025-10-13 09:54:00'),
(73, 3434, '2025-10-13 09:54:06', '2025-10-14 18:14:03'),
(74, 3434, '2025-10-14 18:21:47', '2025-10-14 21:23:53'),
(75, 3434, '2025-10-15 08:18:45', '2025-10-15 20:06:42'),
(76, 3434, '2025-10-15 20:14:26', '2025-10-15 20:14:38'),
(77, 3434, '2025-10-16 08:44:31', '2025-10-17 10:00:24'),
(78, 3434, '2025-10-17 10:00:35', '2025-10-17 10:42:08'),
(79, 123, '2025-10-17 10:42:19', '2025-10-17 10:48:43'),
(80, 3434, '2025-10-19 10:40:54', '2025-10-20 09:58:05'),
(81, 3434, '2025-10-20 09:58:15', '2025-10-21 09:45:03'),
(82, 3434, '2025-10-21 09:45:10', '2025-10-22 08:22:55'),
(83, 3434, '2025-10-22 08:23:16', '2025-10-22 15:50:48'),
(84, 3434, '2025-10-22 15:50:56', '2025-10-23 08:53:54'),
(85, 3434, '2025-10-23 08:54:06', '2025-10-25 09:05:35'),
(86, 3434, '2025-10-25 09:05:45', '2025-10-25 09:59:30'),
(87, 3434, '2025-10-25 16:32:15', '2025-10-26 11:07:20'),
(88, 3434, '2025-10-26 11:07:26', '2025-10-26 20:08:54'),
(89, 3434, '2025-10-28 08:39:26', '2025-10-29 09:35:31'),
(90, 3434, '2025-10-29 09:35:39', '2025-10-29 14:14:13'),
(91, 3434, '2025-10-30 22:06:23', '2025-10-30 22:06:45'),
(92, 3434, '2025-10-30 22:19:06', '2025-10-30 22:20:41'),
(93, 34, '2025-10-30 22:20:54', '2025-10-30 22:23:53'),
(94, 34, '2025-10-31 09:29:13', '2025-10-31 09:52:53'),
(95, 321, '2025-10-31 09:54:09', '2025-10-31 09:54:17'),
(96, 123, '2025-10-31 09:54:29', '2025-10-31 09:55:09'),
(97, 123, '2025-10-31 11:31:06', '2025-10-31 11:31:15'),
(98, 123, '2025-10-31 11:51:33', '2025-10-31 11:51:37'),
(99, 123, '2025-10-31 11:51:42', '2025-10-31 11:51:46'),
(100, 123, '2025-10-31 11:51:50', '2025-10-31 11:51:54'),
(101, 123, '2025-10-31 11:51:58', '2025-10-31 11:52:02'),
(102, 123, '2025-10-31 11:52:06', '2025-10-31 11:52:11'),
(103, 123, '2025-10-31 11:52:15', '2025-10-31 11:52:19'),
(104, 123, '2025-10-31 11:52:23', '2025-10-31 11:52:27'),
(105, 123, '2025-10-31 11:52:31', '2025-10-31 11:52:35'),
(106, 123, '2025-10-31 11:52:40', '2025-10-31 11:53:57'),
(107, 123, '2025-10-31 11:54:11', '2025-10-31 11:54:15'),
(108, 123, '2025-10-31 11:54:20', '2025-10-31 11:54:24'),
(109, 123, '2025-10-31 11:54:28', '2025-10-31 11:54:32'),
(110, 123, '2025-10-31 11:54:36', '2025-10-31 11:54:40'),
(111, 123, '2025-10-31 11:54:45', '2025-10-31 11:54:49'),
(112, 123, '2025-10-31 11:54:53', '2025-10-31 11:54:57'),
(113, 123, '2025-10-31 11:58:02', '2025-10-31 11:58:06'),
(114, 123, '2025-10-31 11:58:15', '2025-10-31 12:16:07'),
(115, 34, '2025-10-31 11:59:59', '2025-11-01 10:02:07'),
(116, 321, '2025-10-31 12:02:35', '2025-10-31 12:45:36'),
(117, 123, '2025-10-31 12:16:23', '2025-11-01 10:01:43'),
(118, 3434, '2025-10-31 12:37:55', '2025-10-31 12:40:09'),
(119, 321, '2025-10-31 12:40:30', '2025-10-31 12:45:25'),
(120, 3434, '2025-10-31 12:45:37', '2025-11-01 09:59:40'),
(121, 321, '2025-10-31 12:46:04', '2025-10-31 12:57:44'),
(122, 321, '2025-10-31 12:58:19', '2025-11-01 10:42:43'),
(123, 3434, '2025-11-01 10:00:00', '2025-11-01 10:01:17'),
(124, 123, '2025-11-01 10:01:53', '2025-11-01 11:07:55'),
(125, 34, '2025-11-01 10:02:21', '2025-11-01 10:42:28'),
(126, 321, '2025-11-01 10:42:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `limite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `limite`) VALUES
(1, 'Promotor Social', 1),
(2, 'Despacho', 1),
(3, 'Administración', 1),
(4, 'Administrador Principal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `id_solicitante` int(11) NOT NULL,
  `ci` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`id_solicitante`, `ci`, `nombre`, `apellido`, `correo`, `fecha_creacion`) VALUES
(7, 3215, 'Jose', 'Gonzalez', 'forell.music@gmail.com', '2025-10-14 18:44:43'),
(8, 30420669, 'Calucho', 'Gonzalez', 'carlossoteldo11@gmail.com', '2025-10-14 21:01:52'),
(9, 16654, 'Elvis', 'Cocho', '', '0000-00-00 00:00:00'),
(10, 4567, 'Tutis', 'Fruti', '', '0000-00-00 00:00:00'),
(24, 302030, 'Asdas', 'Dasdasd', 'qweqwe@gmail.com', '2025-11-01 10:35:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_comunidad`
--

CREATE TABLE `solicitantes_comunidad` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `comunidad` varchar(255) DEFAULT NULL,
  `direc_habita` varchar(255) DEFAULT NULL,
  `estruc_base` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_comunidad`
--

INSERT INTO `solicitantes_comunidad` (`id`, `id_solicitante`, `comunidad`, `direc_habita`, `estruc_base`) VALUES
(6, 7, 'PALMICHAL', 'Carrera centro', 'Dominio'),
(7, 8, 'JOSE GREGORIO AMAYA', '32-15', 'Pues por ahi'),
(8, 9, NULL, 'No sabo', NULL),
(9, 10, NULL, 'Ni sabe el', NULL),
(23, 24, 'LA MAPORITA', 'Qweqwe', 'Asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_conocimiento`
--

CREATE TABLE `solicitantes_conocimiento` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL,
  `nivel_instruc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_conocimiento`
--

INSERT INTO `solicitantes_conocimiento` (`id`, `id_solicitante`, `profesion`, `nivel_instruc`) VALUES
(6, 7, 'Ingeniero', 'Primaria'),
(7, 8, 'Ingeniero en informática', 'Universidad'),
(21, 24, 'Qweqwe', 'Primaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_extra`
--

CREATE TABLE `solicitantes_extra` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `codigo_patria` varchar(255) DEFAULT NULL,
  `serial_patria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_extra`
--

INSERT INTO `solicitantes_extra` (`id`, `id_solicitante`, `codigo_patria`, `serial_patria`) VALUES
(6, 7, '321423', '3213123'),
(7, 8, '32131231', '232342235'),
(21, 24, '2323', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_info`
--

CREATE TABLE `solicitantes_info` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(255) DEFAULT NULL,
  `estado_civil` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_info`
--

INSERT INTO `solicitantes_info` (`id`, `id_solicitante`, `fecha_nacimiento`, `lugar_nacimiento`, `estado_civil`, `telefono`) VALUES
(7, 7, '2025-10-01', 'Hospital rafael rangel', 'Soltero/a', '042323'),
(8, 8, '2003-04-11', 'San juan de los morros', 'Soltero/a', '04245587628'),
(9, 9, NULL, NULL, NULL, '045634'),
(10, 10, NULL, NULL, NULL, '56789'),
(11, 24, '2025-11-10', 'Wqeqwe', 'Soltero/a', '2323123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_ingresos`
--

CREATE TABLE `solicitantes_ingresos` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `nivel_ingreso` int(30) DEFAULT NULL,
  `pension` varchar(255) DEFAULT NULL,
  `bono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_ingresos`
--

INSERT INTO `solicitantes_ingresos` (`id`, `id_solicitante`, `nivel_ingreso`, `pension`, `bono`) VALUES
(6, 7, 300, 'Si', 'Si'),
(7, 8, 344, 'No', 'No'),
(8, 24, 233, 'No', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_patologia`
--

CREATE TABLE `solicitantes_patologia` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `tip_patologia` varchar(255) DEFAULT NULL,
  `nom_patologia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_patologia`
--

INSERT INTO `solicitantes_patologia` (`id`, `id_solicitante`, `tip_patologia`, `nom_patologia`) VALUES
(20, 24, 'Hereditarias', 'Wqeqwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_propiedad`
--

CREATE TABLE `solicitantes_propiedad` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `propiedad` varchar(255) DEFAULT NULL,
  `propiedad_est` varchar(255) DEFAULT NULL,
  `observaciones_propiedad` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_propiedad`
--

INSERT INTO `solicitantes_propiedad` (`id`, `id_solicitante`, `propiedad`, `propiedad_est`, `observaciones_propiedad`) VALUES
(6, 7, 'Casa', 'Propia', 'Sin observaciones'),
(7, 8, 'Apartamento', 'Prestada', 'Sin observaciones'),
(8, 24, 'Casa', 'Prestada', 'Sin observaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_trabajo`
--

CREATE TABLE `solicitantes_trabajo` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `trabajo` varchar(255) DEFAULT NULL,
  `direccion_trabajo` varchar(255) DEFAULT NULL,
  `trabaja_public` varchar(100) DEFAULT NULL,
  `nombre_insti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_trabajo`
--

INSERT INTO `solicitantes_trabajo` (`id`, `id_solicitante`, `trabajo`, `direccion_trabajo`, `trabaja_public`, `nombre_insti`) VALUES
(6, 7, 'No tiene', 'No', 'No', 'No'),
(7, 8, 'No tiene', 'No', 'No', 'No'),
(8, 24, 'No tiene', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda`
--

CREATE TABLE `solicitud_ayuda` (
  `id_doc` int(11) NOT NULL,
  `id_manual` varchar(50) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `invalido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_ayuda`
--

INSERT INTO `solicitud_ayuda` (`id_doc`, `id_manual`, `ci`, `estado`, `invalido`) VALUES
(7, '1155522', '3215', 'Solicitud Finalizada (Ayuda Entregada)', 0),
(21, '2323', '302030', 'Solicitud Finalizada (Ayuda Entregada)', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda_correo`
--

CREATE TABLE `solicitud_ayuda_correo` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `correo_enviado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_ayuda_correo`
--

INSERT INTO `solicitud_ayuda_correo` (`id`, `id_doc`, `correo_enviado`) VALUES
(21, 7, 0),
(35, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda_fecha`
--

CREATE TABLE `solicitud_ayuda_fecha` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_ayuda_fecha`
--

INSERT INTO `solicitud_ayuda_fecha` (`id`, `id_doc`, `fecha`, `fecha_modificacion`, `fecha_renovacion`, `visto`) VALUES
(17, 7, '2025-10-31 12:04:49', '2025-10-31 12:26:58', '2025-10-31 12:04:49', 0),
(31, 21, '2025-11-01 10:35:10', '2025-11-01 10:45:53', '2025-11-01 10:35:10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda_invalido`
--

CREATE TABLE `solicitud_ayuda_invalido` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `razon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_categoria`
--

CREATE TABLE `solicitud_categoria` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `tipo_ayuda` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_categoria`
--

INSERT INTO `solicitud_categoria` (`id`, `id_doc`, `tipo_ayuda`, `categoria`) VALUES
(21, 7, 'Economica', 'Economica'),
(35, 21, 'Collarín', 'Ayudas Tecnicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo`
--

CREATE TABLE `solicitud_desarrollo` (
  `id_des` int(11) NOT NULL,
  `id_manual` varchar(50) DEFAULT NULL,
  `ci` int(50) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `invalido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_desarrollo`
--

INSERT INTO `solicitud_desarrollo` (`id_des`, `id_manual`, `ci`, `estado`, `invalido`) VALUES
(23, '336577', 3215, 'Solicitud Finalizada (Ayuda Entregada)', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_correo`
--

CREATE TABLE `solicitud_desarrollo_correo` (
  `id` int(11) NOT NULL,
  `id_des` int(11) NOT NULL,
  `correo_enviado` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_desarrollo_correo`
--

INSERT INTO `solicitud_desarrollo_correo` (`id`, `id_des`, `correo_enviado`) VALUES
(14, 23, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_fecha`
--

CREATE TABLE `solicitud_desarrollo_fecha` (
  `id` int(11) NOT NULL,
  `id_des` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_renovacion` datetime NOT NULL,
  `visto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_desarrollo_fecha`
--

INSERT INTO `solicitud_desarrollo_fecha` (`id`, `id_des`, `fecha`, `fecha_modificacion`, `fecha_renovacion`, `visto`) VALUES
(20, 23, '2025-10-31 12:28:33', '2025-10-31 12:29:42', '2025-10-31 12:28:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_info`
--

CREATE TABLE `solicitud_desarrollo_info` (
  `id` int(11) NOT NULL,
  `id_des` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `creador` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_desarrollo_info`
--

INSERT INTO `solicitud_desarrollo_info` (`id`, `id_des`, `descripcion`, `creador`) VALUES
(22, 23, 'Ayuda de Losartan', 'promotor socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_invalido`
--

CREATE TABLE `solicitud_desarrollo_invalido` (
  `id` int(11) NOT NULL,
  `id_des` int(11) DEFAULT NULL,
  `razon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_laboratorio`
--

CREATE TABLE `solicitud_desarrollo_laboratorio` (
  `id` int(11) NOT NULL,
  `id_des` int(11) DEFAULT NULL,
  `examen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_desarrollo_tipo`
--

CREATE TABLE `solicitud_desarrollo_tipo` (
  `id` int(11) NOT NULL,
  `id_des` int(11) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_desarrollo_tipo`
--

INSERT INTO `solicitud_desarrollo_tipo` (`id`, `id_des`, `categoria`) VALUES
(22, 23, 'Medicamentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_descripcion`
--

CREATE TABLE `solicitud_descripcion` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `promotor` varchar(255) NOT NULL,
  `observaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_descripcion`
--

INSERT INTO `solicitud_descripcion` (`id`, `id_doc`, `descripcion`, `promotor`, `observaciones`) VALUES
(20, 7, 'Ayuda Para una casa', 'promotor socio', 'Sin observaciones'),
(34, 21, 'Wqeqwe', 'promotor socio', 'Sin observaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ci` int(11) NOT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `sesion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ci`, `clave`, `id_rol`, `sesion`) VALUES
(34, '$2y$10$B3B3.eLTtqT.iJcPnh/m4.uSJ7M7j3tKvcLZii.D3B9BI5lgp2CwW', 1, 'False'),
(123, '$2y$10$EUbg2UC5PG3DD2IUBrCf7OrQE.8AYST9kKAPP5MqmTU.9feSrr6Cm', 2, 'False'),
(321, '$2y$10$b7GW4RMYoXkT7w35iXmYWuL3faGW5px.ZEi7bk4sMZZPzEwQcnjKK', 3, 'True'),
(3434, '$2y$10$aaqOa8LN3ZdV7hviTWx7eufhAGPgvqZDWxgXmuUElh6iWfbKqTRXm', 4, 'False');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_info`
--

CREATE TABLE `usuarios_info` (
  `id` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_info`
--

INSERT INTO `usuarios_info` (`id`, `ci`, `nombre`, `apellido`, `correo`) VALUES
(2, 3434, 'Admin', 'Supremo', 'forell.music@gmail.com'),
(5, 123, 'pepe', 'gonzalez', ''),
(6, 34, 'promotor', 'socio', ''),
(7, 321, 'administracion', 'gonzalez', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_recuperacion`
--

CREATE TABLE `usuarios_recuperacion` (
  `id` int(20) NOT NULL,
  `ci` int(30) NOT NULL,
  `codigo` int(40) NOT NULL,
  `intentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `constancias`
--
ALTER TABLE `constancias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`id_despacho`);

--
-- Indices de la tabla `despacho_categoria`
--
ALTER TABLE `despacho_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_despacho` (`id_despacho`);

--
-- Indices de la tabla `despacho_correo`
--
ALTER TABLE `despacho_correo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_despacho` (`id_despacho`);

--
-- Indices de la tabla `despacho_fecha`
--
ALTER TABLE `despacho_fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fecha_despacho` (`id_despacho`);

--
-- Indices de la tabla `despacho_info`
--
ALTER TABLE `despacho_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_descripcion_despacho` (`id_despacho`);

--
-- Indices de la tabla `despacho_invalido`
--
ALTER TABLE `despacho_invalido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invalido_despacho` (`id_despacho`);

--
-- Indices de la tabla `reportes_acciones`
--
ALTER TABLE `reportes_acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doc` (`id_doc`),
  ADD KEY `ci` (`ci`);

--
-- Indices de la tabla `reportes_entradas`
--
ALTER TABLE `reportes_entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_comunidad`
--
ALTER TABLE `solicitantes_comunidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_conocimiento`
--
ALTER TABLE `solicitantes_conocimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_extra`
--
ALTER TABLE `solicitantes_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_info`
--
ALTER TABLE `solicitantes_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_ingresos`
--
ALTER TABLE `solicitantes_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_patologia`
--
ALTER TABLE `solicitantes_patologia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_propiedad`
--
ALTER TABLE `solicitantes_propiedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitantes_trabajo`
--
ALTER TABLE `solicitantes_trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `solicitud_ayuda`
--
ALTER TABLE `solicitud_ayuda`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indices de la tabla `solicitud_ayuda_correo`
--
ALTER TABLE `solicitud_ayuda_correo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_correo_doc` (`id_doc`);

--
-- Indices de la tabla `solicitud_ayuda_fecha`
--
ALTER TABLE `solicitud_ayuda_fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fecha_doc` (`id_doc`);

--
-- Indices de la tabla `solicitud_ayuda_invalido`
--
ALTER TABLE `solicitud_ayuda_invalido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invalido_doc` (`id_doc`);

--
-- Indices de la tabla `solicitud_categoria`
--
ALTER TABLE `solicitud_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_doc` (`id_doc`);

--
-- Indices de la tabla `solicitud_desarrollo`
--
ALTER TABLE `solicitud_desarrollo`
  ADD PRIMARY KEY (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_correo`
--
ALTER TABLE `solicitud_desarrollo_correo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_fecha`
--
ALTER TABLE `solicitud_desarrollo_fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_info`
--
ALTER TABLE `solicitud_desarrollo_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_invalido`
--
ALTER TABLE `solicitud_desarrollo_invalido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_laboratorio`
--
ALTER TABLE `solicitud_desarrollo_laboratorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_desarrollo_tipo`
--
ALTER TABLE `solicitud_desarrollo_tipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_des` (`id_des`);

--
-- Indices de la tabla `solicitud_descripcion`
--
ALTER TABLE `solicitud_descripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_descripcion_doc` (`id_doc`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuarios_info`
--
ALTER TABLE `usuarios_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci` (`ci`);

--
-- Indices de la tabla `usuarios_recuperacion`
--
ALTER TABLE `usuarios_recuperacion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `constancias`
--
ALTER TABLE `constancias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `despacho`
--
ALTER TABLE `despacho`
  MODIFY `id_despacho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `despacho_categoria`
--
ALTER TABLE `despacho_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `despacho_correo`
--
ALTER TABLE `despacho_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `despacho_fecha`
--
ALTER TABLE `despacho_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `despacho_info`
--
ALTER TABLE `despacho_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `despacho_invalido`
--
ALTER TABLE `despacho_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes_acciones`
--
ALTER TABLE `reportes_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT de la tabla `reportes_entradas`
--
ALTER TABLE `reportes_entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `solicitantes_comunidad`
--
ALTER TABLE `solicitantes_comunidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `solicitantes_conocimiento`
--
ALTER TABLE `solicitantes_conocimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitantes_extra`
--
ALTER TABLE `solicitantes_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitantes_info`
--
ALTER TABLE `solicitantes_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitantes_ingresos`
--
ALTER TABLE `solicitantes_ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitantes_patologia`
--
ALTER TABLE `solicitantes_patologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `solicitantes_propiedad`
--
ALTER TABLE `solicitantes_propiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitantes_trabajo`
--
ALTER TABLE `solicitantes_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda`
--
ALTER TABLE `solicitud_ayuda`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_correo`
--
ALTER TABLE `solicitud_ayuda_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_fecha`
--
ALTER TABLE `solicitud_ayuda_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_invalido`
--
ALTER TABLE `solicitud_ayuda_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitud_categoria`
--
ALTER TABLE `solicitud_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo`
--
ALTER TABLE `solicitud_desarrollo`
  MODIFY `id_des` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_correo`
--
ALTER TABLE `solicitud_desarrollo_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_fecha`
--
ALTER TABLE `solicitud_desarrollo_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_info`
--
ALTER TABLE `solicitud_desarrollo_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_invalido`
--
ALTER TABLE `solicitud_desarrollo_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_laboratorio`
--
ALTER TABLE `solicitud_desarrollo_laboratorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_tipo`
--
ALTER TABLE `solicitud_desarrollo_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `solicitud_descripcion`
--
ALTER TABLE `solicitud_descripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios_info`
--
ALTER TABLE `usuarios_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios_recuperacion`
--
ALTER TABLE `usuarios_recuperacion`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `despacho_categoria`
--
ALTER TABLE `despacho_categoria`
  ADD CONSTRAINT `despacho_categoria_ibfk_1` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `despacho_correo`
--
ALTER TABLE `despacho_correo`
  ADD CONSTRAINT `despacho_correo_ibfk_1` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `despacho_fecha`
--
ALTER TABLE `despacho_fecha`
  ADD CONSTRAINT `fk_fecha_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `despacho_info`
--
ALTER TABLE `despacho_info`
  ADD CONSTRAINT `fk_descripcion_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `despacho_invalido`
--
ALTER TABLE `despacho_invalido`
  ADD CONSTRAINT `fk_invalido_despacho` FOREIGN KEY (`id_despacho`) REFERENCES `despacho` (`id_despacho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_comunidad`
--
ALTER TABLE `solicitantes_comunidad`
  ADD CONSTRAINT `solicitantes_comunidad_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_conocimiento`
--
ALTER TABLE `solicitantes_conocimiento`
  ADD CONSTRAINT `solicitantes_conocimiento_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_extra`
--
ALTER TABLE `solicitantes_extra`
  ADD CONSTRAINT `solicitantes_extra_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_info`
--
ALTER TABLE `solicitantes_info`
  ADD CONSTRAINT `solicitantes_info_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_ingresos`
--
ALTER TABLE `solicitantes_ingresos`
  ADD CONSTRAINT `solicitantes_ingresos_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_patologia`
--
ALTER TABLE `solicitantes_patologia`
  ADD CONSTRAINT `solicitantes_patologia_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_propiedad`
--
ALTER TABLE `solicitantes_propiedad`
  ADD CONSTRAINT `solicitantes_propiedad_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitantes_trabajo`
--
ALTER TABLE `solicitantes_trabajo`
  ADD CONSTRAINT `solicitantes_trabajo_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id_solicitante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_ayuda_correo`
--
ALTER TABLE `solicitud_ayuda_correo`
  ADD CONSTRAINT `fk_correo_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_ayuda_fecha`
--
ALTER TABLE `solicitud_ayuda_fecha`
  ADD CONSTRAINT `fk_fecha_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_ayuda_invalido`
--
ALTER TABLE `solicitud_ayuda_invalido`
  ADD CONSTRAINT `fk_invalido_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_categoria`
--
ALTER TABLE `solicitud_categoria`
  ADD CONSTRAINT `fk_categoria_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_correo`
--
ALTER TABLE `solicitud_desarrollo_correo`
  ADD CONSTRAINT `solicitud_desarrollo_correo_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_fecha`
--
ALTER TABLE `solicitud_desarrollo_fecha`
  ADD CONSTRAINT `solicitud_desarrollo_fecha_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_info`
--
ALTER TABLE `solicitud_desarrollo_info`
  ADD CONSTRAINT `solicitud_desarrollo_info_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_invalido`
--
ALTER TABLE `solicitud_desarrollo_invalido`
  ADD CONSTRAINT `solicitud_desarrollo_invalido_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_laboratorio`
--
ALTER TABLE `solicitud_desarrollo_laboratorio`
  ADD CONSTRAINT `solicitud_desarrollo_laboratorio_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_desarrollo_tipo`
--
ALTER TABLE `solicitud_desarrollo_tipo`
  ADD CONSTRAINT `solicitud_desarrollo_tipo_ibfk_1` FOREIGN KEY (`id_des`) REFERENCES `solicitud_desarrollo` (`id_des`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_descripcion`
--
ALTER TABLE `solicitud_descripcion`
  ADD CONSTRAINT `fk_descripcion_doc` FOREIGN KEY (`id_doc`) REFERENCES `solicitud_ayuda` (`id_doc`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `usuarios_info`
--
ALTER TABLE `usuarios_info`
  ADD CONSTRAINT `usuarios_info_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `usuarios` (`ci`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
