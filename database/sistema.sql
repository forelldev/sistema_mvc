-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2025 a las 23:45:46
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
(29, 2323, 3215, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(30, 233333, 3232, 'En Revisión 1/2', 0),
(31, 22111, 3333, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(32, 123123, 33334, 'En Revisión 1/2', 0),
(33, 232323, 3333, 'En Revisión 1/2', 0),
(34, 2323234, 3333, 'En Revisión 1/2', 0),
(38, 213123, 3333, 'En Revisión 1/2', 0),
(39, 123123123, 3333, 'En Revisión 1/2', 0),
(40, 2147483647, 3333, 'En Revisión 1/2', 0),
(41, 121222, 34444, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(42, 2131234, 232310, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(43, 2324, 122, 'Solicitud Finalizada (Ayuda Entregada)', 0),
(44, 222333, 122, 'Solicitud Finalizada (Ayuda Entregada)', 0);

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
(19, 29, 'Salud', 'Medicamentos'),
(20, 30, 'Salud', 'Medicamentos'),
(21, 31, 'Salud', 'Consultas'),
(22, 32, 'Materiales de Construcción', 'Sacos de cemento'),
(23, 33, 'Ayuda Económica', 'Económica'),
(24, 34, 'Materiales de Construcción', 'Sacos de cemento'),
(28, 38, 'Salud', 'Consultas'),
(29, 39, 'Materiales de Construcción', 'Sacos de cemento'),
(30, 40, 'Ayuda Económica', 'Económica'),
(31, 41, 'Materiales de Construcción', 'Bloques'),
(32, 42, 'Ayuda Económica', 'Económica'),
(33, 43, 'Salud', 'Operaciones'),
(34, 44, 'Salud', 'Medicamentos');

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
(11, 29, 0),
(12, 30, 0),
(13, 31, 0),
(14, 32, 0),
(15, 33, 0),
(16, 34, 0),
(20, 38, 0),
(21, 39, 0),
(22, 40, 0),
(23, 41, 0),
(24, 42, 0),
(25, 43, 0),
(26, 44, 0);

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
(26, 29, '2025-11-02 15:03:40', '2025-11-02 15:04:26', '2025-11-02 15:03:40', 1),
(27, 30, '2025-11-02 17:59:31', '2025-11-02 17:59:31', '2025-11-02 17:59:31', 1),
(28, 31, '2025-11-02 18:20:52', '2025-11-03 16:15:07', '2025-11-02 18:20:52', 1),
(29, 32, '2025-11-02 18:24:51', '2025-11-02 18:24:51', '2025-11-02 18:24:51', 1),
(30, 33, '2025-11-02 18:34:29', '2025-11-02 18:34:29', '2025-11-02 18:34:29', 1),
(31, 34, '2025-11-02 18:39:13', '2025-11-02 18:39:13', '2025-11-02 18:39:13', 1),
(35, 38, '2025-11-02 18:52:00', '2025-11-02 18:52:00', '2025-11-02 18:52:00', 1),
(36, 39, '2025-11-02 18:52:32', '2025-11-02 18:52:32', '2025-11-02 18:52:32', 1),
(37, 40, '2025-11-02 19:14:46', '2025-11-03 12:09:22', '2025-11-02 19:14:46', 1),
(38, 41, '2025-11-02 21:56:29', '2025-11-03 16:14:29', '2025-11-02 21:56:29', 1),
(39, 42, '2025-11-03 15:59:42', '2025-11-03 16:00:15', '2025-11-03 15:59:42', 1),
(40, 43, '2025-11-03 16:08:49', '2025-11-03 16:14:02', '2025-11-03 16:08:49', 1),
(41, 44, '2025-11-03 16:12:47', '2025-11-03 16:13:46', '2025-11-03 16:12:47', 1);

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
(28, 29, 'wqeqwe', 'pepe gonzalez'),
(29, 30, 'qweqweqwe', 'Admin Supremo'),
(30, 31, 'pokemon', 'Admin Supremo'),
(31, 32, 'qweqweqwe', 'Admin Supremo'),
(32, 33, 'wqeqwe', 'Admin Supremo'),
(33, 34, 'qweqweqwe', 'Admin Supremo'),
(37, 38, 'wqeqwe', 'Admin Supremo'),
(38, 39, 'qweqweqwe', 'Admin Supremo'),
(39, 40, 'qweqweqwe', 'Admin Supremo'),
(40, 41, 'ahora quiero blokes', 'pepe gonzalez'),
(41, 42, 'casita', 'pepe gonzalez'),
(42, 43, 'del corazon', 'pepe gonzalez'),
(43, 44, 'quiero', 'pepe gonzalez');

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
(215, 31, '2025-11-02 14:49:10', 'Creó una nueva solicitud de ayuda (General).', 34),
(216, 31, '2025-11-02 14:49:28', 'Hizo click sobre la notificación. (Marcó visto, solicitud general)', 34),
(217, 31, '2025-11-02 14:49:48', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(218, 31, '2025-11-02 14:49:54', 'Envió la solicitud a despacho. (General)', 34),
(219, 31, '2025-11-02 14:50:16', 'Hizo click sobre la notificación. (Marcó visto, solicitud general)', 123),
(220, 31, '2025-11-02 14:50:35', 'Envió la solicitud a administración. (General)', 123),
(221, 31, '2025-11-02 14:50:47', 'Hizo click sobre la notificación. (Marcó visto, solicitud general)', 321),
(222, 31, '2025-11-02 14:50:58', 'Confirmó que se entregó la ayuda. (General)', 321),
(223, 28, '2025-11-02 14:59:09', 'Registró solicitud. (Despacho)', 123),
(224, 28, '2025-11-02 14:59:25', 'Hizo click sobre la notificación. (Marcó visto, solicitud de despacho)', 123),
(225, 29, '2025-11-02 15:03:40', 'Registró solicitud. (Despacho)', 123),
(226, 29, '2025-11-02 15:03:50', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(227, 29, '2025-11-02 15:03:57', 'Envió la solicitud a Administración. (Despacho)', 123),
(228, 29, '2025-11-02 15:04:22', 'Hizo click sobre la notificación, marcó visto (Despacho)', 321),
(229, 29, '2025-11-02 15:04:26', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(231, 29, '2025-11-02 15:29:29', 'Registró solicitud (Desarrollo)', 34),
(232, 29, '2025-11-02 15:30:36', 'Aprobó la solicitud para su procedimiento. (Desarrollo)', 34),
(233, 29, '2025-11-02 15:30:40', 'Envió la solicitud a Administración. (Desarrollo)', 34),
(234, 29, '2025-11-02 15:30:44', 'Confirmó que se entregó la ayuda. (Desarrollo)', 34),
(236, 29, '2025-11-02 15:31:38', 'Envió la solicitud a Administración. (Desarrollo)', 34),
(237, 29, '2025-11-02 15:31:39', 'Confirmó que se entregó la ayuda. (Desarrollo)', 34),
(238, 29, '2025-11-02 15:31:41', 'Reinició la solicitud. (Desarrollo)', 34),
(239, 30, '2025-11-02 17:59:31', 'Registró solicitud. (Despacho)', 3434),
(240, 31, '2025-11-02 18:20:52', 'Registró solicitud. (Despacho)', 3434),
(241, 32, '2025-11-02 18:24:51', 'Registró solicitud. (Despacho)', 3434),
(242, 33, '2025-11-02 18:34:29', 'Registró solicitud. (Despacho)', 3434),
(243, 34, '2025-11-02 18:39:14', 'Registró solicitud. (Despacho)', 3434),
(244, 38, '2025-11-02 18:52:00', 'Registró solicitud. (Despacho)', 3434),
(245, 39, '2025-11-02 18:52:32', 'Registró solicitud. (Despacho)', 3434),
(246, 40, '2025-11-02 19:14:46', 'Registró solicitud. (Despacho)', 3434),
(247, 30, '2025-11-02 21:38:39', 'Registró solicitud (Desarrollo)', 3434),
(248, 32, '2025-11-02 21:52:06', 'Creó una nueva solicitud de ayuda (General).', 34),
(249, 32, '2025-11-02 21:52:31', 'Hizo click sobre la notificación, marcó visto (General)', 34),
(250, 32, '2025-11-02 21:54:18', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(251, 32, '2025-11-02 21:54:26', 'Hizo click sobre la notificación, marcó visto (General)', 34),
(252, 32, '2025-11-02 21:54:28', 'Envió la solicitud a despacho. (General)', 34),
(253, 32, '2025-11-02 21:54:36', 'Hizo click sobre la notificación, marcó visto (General)', 123),
(254, 32, '2025-11-02 21:54:47', 'Envió la solicitud a administración. (General)', 123),
(255, 32, '2025-11-02 21:54:59', 'Hizo click sobre la notificación, marcó visto (General)', 321),
(256, 32, '2025-11-02 21:55:01', 'Confirmó que se entregó la ayuda. (General)', 321),
(257, 41, '2025-11-02 21:56:29', 'Registró solicitud. (Despacho)', 123),
(258, 41, '2025-11-02 21:56:48', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(259, 41, '2025-11-02 21:56:52', 'Envió la solicitud a Administración. (Despacho)', 123),
(260, 41, '2025-11-02 21:56:55', 'Hizo click sobre la notificación, marcó visto (Despacho)', 321),
(261, 41, '2025-11-02 21:56:57', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(262, 41, '2025-11-02 21:57:03', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(263, 32, '2025-11-02 21:59:21', 'Hizo click sobre la notificación, marcó visto (General)', 34),
(264, 32, '2025-11-03 08:55:40', 'Reinició el proceso de la solicitud. (General)', 3434),
(265, 33, '2025-11-03 10:29:17', 'Creó una nueva solicitud de ayuda (General).', 3434),
(266, 33, '2025-11-03 10:45:06', 'Editó la solicitud (General)', 3434),
(267, 33, '2025-11-03 10:45:45', 'Editó la solicitud (General)', 3434),
(268, 33, '2025-11-03 10:48:24', 'Editó la solicitud (General)', 3434),
(269, 33, '2025-11-03 10:49:56', 'Inhabilitó la solicitud razón: porque la quiero inhabilitada, simplemente eso (General)', 3434),
(270, 33, '2025-11-03 10:50:08', 'Editó la solicitud (General)', 3434),
(271, 33, '2025-11-03 10:50:13', 'Habilitó la solicitud (General)', 3434),
(272, 33, '2025-11-03 10:50:19', 'Inhabilitó la solicitud razón: porq si (General)', 3434),
(273, 33, '2025-11-03 10:50:26', 'Habilitó la solicitud (General)', 3434),
(274, 31, '2025-11-03 10:53:50', 'Registró solicitud (Desarrollo)', 3434),
(275, 32, '2025-11-03 10:54:28', 'Registró solicitud (Desarrollo)', 3434),
(276, 33, '2025-11-03 10:54:49', 'Registró solicitud (Desarrollo)', 3434),
(277, 33, '2025-11-03 11:27:39', 'Editó la solicitud (Desarrollo)', 3434),
(278, 33, '2025-11-03 11:27:45', 'Editó la solicitud (Desarrollo)', 3434),
(279, 33, '2025-11-03 11:27:49', 'Editó la solicitud (Desarrollo)', 3434),
(280, 33, '2025-11-03 11:31:15', 'Editó la solicitud (Desarrollo)', 3434),
(281, 33, '2025-11-03 11:31:21', 'Editó la solicitud (Desarrollo)', 3434),
(282, 33, '2025-11-03 11:34:35', 'Editó la solicitud (Desarrollo)', 3434),
(283, 33, '2025-11-03 11:35:02', 'Editó la solicitud (Desarrollo)', 3434),
(284, 33, '2025-11-03 11:35:08', 'Editó la solicitud (Desarrollo)', 3434),
(285, 33, '2025-11-03 11:35:15', 'Editó la solicitud (Desarrollo)', 3434),
(286, 40, '2025-11-03 12:09:22', 'Editó la solicitud de Despacho', 3434),
(287, 41, '2025-11-03 12:09:35', 'Editó la solicitud de Despacho', 3434),
(288, 41, '2025-11-03 12:10:33', 'Editó la solicitud de Despacho', 3434),
(289, 41, '2025-11-03 12:13:29', 'Editó la solicitud de Despacho', 3434),
(290, 33, '2025-11-03 14:24:55', 'Inhabilitó la solicitud razón: sss (General)', 3434),
(291, 33, '2025-11-03 14:25:06', 'Inhabilitó la solicitud razón: pq si (Desarrollo)', 3434),
(292, 33, '2025-11-03 14:25:15', 'Habilitó la solicitud. (Desarrollo)', 3434),
(293, 41, '2025-11-03 15:06:06', 'Inhabilitó la solicitud razón: qweq (Despacho)', 3434),
(294, 41, '2025-11-03 15:42:01', 'Habilitó la solicitud (Despacho)', 3434),
(295, 40, '2025-11-03 15:42:18', 'Inhabilitó la solicitud razón: sd (Despacho)', 3434),
(296, 40, '2025-11-03 15:42:37', 'Habilitó la solicitud (Despacho)', 3434),
(297, 41, '2025-11-03 15:42:45', 'Inhabilitó la solicitud razón: como (Despacho)', 3434),
(298, 41, '2025-11-03 15:43:07', 'Habilitó la solicitud (Despacho)', 3434),
(299, 34, '2025-11-03 15:55:10', 'Creó una nueva solicitud de ayuda (General).', 34),
(300, 34, '2025-11-03 15:55:29', 'Recibió documento físico, y aprobó para su procedimiento. (General)', 34),
(301, 34, '2025-11-03 15:55:34', 'Envió la solicitud a despacho. (General)', 34),
(302, 34, '2025-11-03 15:55:38', 'Hizo click sobre la notificación, marcó visto (General)', 123),
(303, 34, '2025-11-03 15:55:46', 'Envió la solicitud a administración. (General)', 123),
(304, 34, '2025-11-03 15:55:55', 'Hizo click sobre la notificación, marcó visto (General)', 321),
(305, 34, '2025-11-03 15:56:01', 'Confirmó que se entregó la ayuda. (General)', 321),
(306, 42, '2025-11-03 15:59:42', 'Registró solicitud. (Despacho)', 123),
(307, 42, '2025-11-03 15:59:59', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(308, 42, '2025-11-03 16:00:01', 'Envió la solicitud a Administración. (Despacho)', 123),
(309, 42, '2025-11-03 16:00:07', 'Hizo click sobre la notificación, marcó visto (Despacho)', 321),
(310, 42, '2025-11-03 16:00:15', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(311, 42, '2025-11-03 16:00:26', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(312, 35, '2025-11-03 16:07:16', 'Creó una nueva solicitud de ayuda (General).', 34),
(313, 43, '2025-11-03 16:08:49', 'Registró solicitud. (Despacho)', 123),
(314, 36, '2025-11-03 16:11:14', 'Creó una nueva solicitud de ayuda (General).', 34),
(315, 44, '2025-11-03 16:12:47', 'Registró solicitud. (Despacho)', 123),
(316, 44, '2025-11-03 16:13:07', 'Editó la solicitud de Despacho', 123),
(317, 44, '2025-11-03 16:13:17', 'Editó la solicitud de Despacho', 123),
(318, 44, '2025-11-03 16:13:19', 'Envió la solicitud a Administración. (Despacho)', 123),
(319, 44, '2025-11-03 16:13:42', 'Hizo click sobre la notificación, marcó visto (Despacho)', 321),
(320, 44, '2025-11-03 16:13:46', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(321, 43, '2025-11-03 16:13:56', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(322, 43, '2025-11-03 16:13:57', 'Envió la solicitud a Administración. (Despacho)', 123),
(323, 43, '2025-11-03 16:14:02', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(324, 41, '2025-11-03 16:14:22', 'Envió la solicitud a Administración. (Despacho)', 123),
(325, 41, '2025-11-03 16:14:29', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(326, 31, '2025-11-03 16:15:00', 'Envió la solicitud a Administración. (Despacho)', 123),
(327, 31, '2025-11-03 16:15:06', 'Hizo click sobre la notificación, marcó visto (Despacho)', 321),
(328, 31, '2025-11-03 16:15:07', 'Confirmó que se entregó la ayuda. (Despacho)', 321),
(329, 44, '2025-11-03 16:17:03', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(330, 43, '2025-11-03 16:17:07', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123),
(331, 41, '2025-11-03 16:17:09', 'Hizo click sobre la notificación, marcó visto (Despacho)', 123);

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
(126, 321, '2025-11-01 10:42:53', '2025-11-01 11:30:56'),
(127, 3434, '2025-11-01 11:26:43', '2025-11-01 11:28:47'),
(128, 34, '2025-11-01 11:28:53', '2025-11-01 11:30:47'),
(129, 3434, '2025-11-01 11:32:04', '2025-11-01 11:34:39'),
(130, 34, '2025-11-01 11:38:51', '2025-11-01 11:39:48'),
(131, 321, '2025-11-01 11:44:07', '2025-11-01 11:45:12'),
(132, 34, '2025-11-01 21:05:55', '2025-11-01 22:34:09'),
(133, 123, '2025-11-01 22:34:11', '2025-11-01 22:47:24'),
(134, 321, '2025-11-01 22:47:30', '2025-11-01 22:48:47'),
(135, 3434, '2025-11-01 22:48:50', '2025-11-01 22:51:12'),
(136, 123, '2025-11-02 09:53:37', '2025-11-02 09:55:08'),
(137, 3434, '2025-11-02 09:55:11', '2025-11-02 09:55:17'),
(138, 3434, '2025-11-02 10:11:41', '2025-11-02 11:07:59'),
(139, 123, '2025-11-02 11:08:34', '2025-11-02 11:26:22'),
(140, 34, '2025-11-02 11:08:39', '2025-11-02 11:09:24'),
(141, 321, '2025-11-02 11:09:25', '2025-11-02 11:26:24'),
(142, 34, '2025-11-02 11:26:26', '2025-11-02 12:01:54'),
(143, 123, '2025-11-02 11:26:28', '2025-11-02 12:41:30'),
(144, 321, '2025-11-02 12:01:56', '2025-11-02 12:42:28'),
(145, 3434, '2025-11-02 12:41:32', '2025-11-02 21:47:24'),
(146, 34, '2025-11-02 12:42:31', '2025-11-02 14:50:12'),
(147, 123, '2025-11-02 14:50:14', '2025-11-02 14:50:43'),
(148, 321, '2025-11-02 14:50:45', '2025-11-02 14:58:55'),
(149, 123, '2025-11-02 14:58:57', '2025-11-02 15:04:18'),
(150, 321, '2025-11-02 15:04:20', '2025-11-02 15:09:47'),
(151, 123, '2025-11-02 15:09:54', '2025-11-02 15:09:56'),
(152, 34, '2025-11-02 15:17:19', '2025-11-02 15:29:09'),
(153, 34, '2025-11-02 15:29:11', '2025-11-02 21:47:39'),
(154, 34, '2025-11-02 21:47:46', '2025-11-02 21:54:55'),
(155, 123, '2025-11-02 21:47:48', '2025-11-02 21:59:01'),
(156, 321, '2025-11-02 21:54:57', '2025-11-02 21:55:10'),
(157, 34, '2025-11-02 21:55:12', '2025-11-02 21:55:43'),
(158, 321, '2025-11-02 21:55:49', '2025-11-02 21:59:03'),
(159, 34, '2025-11-02 21:59:08', '2025-11-02 21:59:40'),
(160, 3434, '2025-11-02 21:59:11', '2025-11-02 21:59:32'),
(161, 3434, '2025-11-02 21:59:43', '2025-11-02 22:15:05'),
(162, 3434, '2025-11-03 08:55:31', '2025-11-03 15:53:05'),
(163, 34, '2025-11-03 15:53:24', '2025-11-03 15:55:51'),
(164, 123, '2025-11-03 15:53:44', '2025-11-03 15:56:25'),
(165, 321, '2025-11-03 15:55:53', '2025-11-03 15:56:07'),
(166, 34, '2025-11-03 15:56:09', '2025-11-03 15:56:17'),
(167, 123, '2025-11-03 15:56:22', '2025-11-03 15:56:32'),
(168, 321, '2025-11-03 15:56:27', '2025-11-03 16:06:51'),
(169, 123, '2025-11-03 15:56:40', '2025-11-03 16:25:06'),
(170, 34, '2025-11-03 16:06:55', '2025-11-03 16:07:50'),
(171, 321, '2025-11-03 16:08:00', '2025-11-03 16:08:58'),
(172, 34, '2025-11-03 16:09:01', '2025-11-03 16:12:09'),
(173, 321, '2025-11-03 16:12:11', '2025-11-03 16:25:12'),
(174, 3434, '2025-11-03 16:25:09', '2025-11-04 08:52:24'),
(175, 3434, '2025-11-04 08:52:27', '2025-11-04 16:53:13'),
(176, 3434, '2025-11-04 16:53:15', '2025-11-04 17:07:40'),
(177, 3434, '2025-11-04 17:07:46', '2025-11-04 17:12:24');

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
(7, 3215, 'Yorsh', 'Gonzalez', 'forell.music@gmail.com', '2025-10-14 18:44:43'),
(8, 30420669, 'Calucho', 'Gonzalez', 'carlossoteldo11@gmail.com', '2025-10-14 21:01:52'),
(9, 16654, 'Elvis', 'Cocho', '', '0000-00-00 00:00:00'),
(10, 4567, 'Tutis', 'Fruti', '', '0000-00-00 00:00:00'),
(24, 302030, 'Asdas', 'Dasdasd', 'qweqwe@gmail.com', '2025-11-01 10:35:10'),
(25, 3232, 'jaloner', 'jalono', 'qweqweqwe@gmail.com', '0000-00-00 00:00:00'),
(26, 3333, 'vaneltin', 'siudadano', 'qwqeq@gmai', '0000-00-00 00:00:00'),
(27, 33334, 'vaneltin', 'siudadano', 'qwqeq@gmai', '0000-00-00 00:00:00'),
(28, 333, 'pedro', 'pelaez', 'qweqweqwe@gmail.com', '2025-11-02 21:38:39'),
(29, 31628264, 'Danielys', 'Rojas', 'danielysrojas@gmail.com', '2025-11-02 21:52:05'),
(30, 34444, 'omagad', 'omagaddd', 'weqwe@gmail', '0000-00-00 00:00:00'),
(31, 2030230, 'Qweqwe', 'Qweqwe', '23qweq@g', '2025-11-03 15:55:10'),
(32, 232310, 'bien', 'mal', 'qwejqwe@gmail.com', '0000-00-00 00:00:00'),
(33, 122, 'Cartucho', 'Stiven', 'qweqwe@gmail.com', '0000-00-00 00:00:00');

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
(23, 24, 'LA MAPORITA', 'Qweqwe', 'Asdasd'),
(24, 25, 'TACARIGUITA', 'erwer', NULL),
(25, 26, 'LIMONCITO', '2323weqwqe', NULL),
(26, 27, 'LIMONCITO', '2323weqwqe', NULL),
(27, 28, 'ESPARRAMADERO', 'WENO Q TE PASA', NULL),
(28, 29, 'JOSE GREGORIO AMAYA', 'Carrera 15 entre 14 y 16', 'Escuela'),
(29, 30, 'CERRO GRANDE', 'centro', NULL),
(30, 31, 'JOSE GREGORIO AMAYA', 'Qweqweq', 'Qweqweqwe'),
(31, 32, 'LA VICTORIA', 'vivo en la casa', NULL),
(32, 33, 'EL POZON', 'Urba', 'Qweqwe');

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
(21, 24, 'Qweqwe', 'Primaria'),
(22, 26, NULL, NULL),
(23, 27, NULL, NULL),
(24, 28, NULL, NULL),
(25, 29, 'Ama de casa', 'Secundaria'),
(26, 30, NULL, NULL),
(27, 31, 'Qweqwe', 'Primaria'),
(28, 32, NULL, NULL),
(29, 33, 'Qweqwe', 'Primaria');

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
(21, 24, '2323', '123123'),
(22, 26, NULL, NULL),
(23, 27, NULL, NULL),
(24, 28, NULL, NULL),
(25, 29, '3123123213', '109238912389123'),
(26, 30, NULL, NULL),
(27, 31, '232323', '232323'),
(28, 32, NULL, NULL),
(29, 33, '2323', '123123');

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
(11, 24, '2025-11-10', 'Wqeqwe', 'Soltero/a', '2323123'),
(12, 25, NULL, NULL, NULL, '4324234'),
(13, 26, NULL, NULL, NULL, '2323'),
(14, 27, NULL, NULL, NULL, '2323'),
(15, 28, NULL, NULL, NULL, '23123123'),
(16, 29, '2004-11-05', 'Aroa', 'Casado/a', '0414338556'),
(17, 30, NULL, NULL, NULL, '232323'),
(18, 31, '2020-06-03', 'Eqweqwe', 'Casado/a', '23231'),
(19, 32, NULL, NULL, NULL, '23123123'),
(20, 33, '2025-11-14', 'El corazon', 'Soltero/a', '2232323');

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
(6, 7, 30000, 'No', 'No'),
(7, 8, 344, 'No', 'No'),
(8, 24, 233, 'No', 'No'),
(9, 26, NULL, NULL, NULL),
(10, 27, NULL, NULL, NULL),
(11, 28, NULL, NULL, NULL),
(12, 29, 2000, 'No', 'No'),
(13, 30, NULL, NULL, NULL),
(14, 31, 232323, 'No', 'No'),
(15, 32, NULL, NULL, NULL),
(16, 33, 233, 'Si', 'No');

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
(20, 24, 'Hereditarias', 'Wqeqwe'),
(38, 29, 'Hereditarias', 'Diabetes'),
(39, 29, 'Hereditarias', 'Diabetes'),
(40, 29, 'Hereditarias', 'Diabetes'),
(41, 29, 'Hereditarias', 'Diabetes'),
(42, 29, 'Hereditarias', 'Diabetes'),
(43, 31, 'Atención primaria', 'Qweqwe'),
(44, 33, 'Hereditarias', 'Qwe'),
(45, 33, 'Hereditarias', 'Qwe');

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
(6, 7, 'Casa', 'Propia', 'Era observacion'),
(7, 8, 'Apartamento', 'Prestada', 'Sin observaciones'),
(8, 24, 'Casa', 'Prestada', 'Sin observaciones'),
(9, 26, NULL, NULL, NULL),
(10, 27, NULL, NULL, NULL),
(11, 28, NULL, NULL, NULL),
(12, 29, 'Casa', 'Propia', 'No escucha'),
(13, 30, NULL, NULL, NULL),
(14, 31, 'Apartamento', 'Propia', 'Erqwreqwe'),
(15, 32, NULL, NULL, NULL),
(16, 33, 'Apartamento', 'Propia', 'Sin observaciones');

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
(8, 24, 'No tiene', 'No', 'No', 'No'),
(9, 26, NULL, NULL, NULL, NULL),
(10, 27, NULL, NULL, NULL, NULL),
(11, 28, NULL, NULL, NULL, NULL),
(12, 29, 'Ama de casa', 'Sabanita', 'No', 'No'),
(13, 30, NULL, NULL, NULL, NULL),
(14, 31, 'Qweqwe', 'Weqwe', 'No', 'No'),
(15, 32, NULL, NULL, NULL, NULL),
(16, 33, 'No tiene', 'No', 'No', 'No');

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
(31, '23323', '3215', 'Solicitud Finalizada (Ayuda Entregada)', 0),
(32, '8899', '31628264', 'En espera del documento físico para ser procesado 0/3', 0),
(33, '88992', '3215', 'En espera del documento físico para ser procesado 0/3', 1),
(34, '12123232545', '2030230', 'Solicitud Finalizada (Ayuda Entregada)', 0),
(35, '123', '3215', 'En espera del documento físico para ser procesado 0/3', 0),
(36, '232312342', '122', 'En espera del documento físico para ser procesado 0/3', 0);

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
(45, 31, 0),
(46, 32, 0),
(47, 33, 0),
(48, 34, 0),
(49, 35, 0),
(50, 36, 0);

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
(41, 31, '2025-11-02 14:49:10', '2025-11-02 14:50:58', '2025-11-02 14:49:10', 1),
(42, 32, '2025-11-02 21:52:05', '2025-11-03 08:55:40', '2025-11-02 21:52:05', 1),
(43, 33, '2025-11-03 10:29:17', '2025-11-03 10:50:08', '2025-11-03 10:29:17', 1),
(44, 34, '2025-11-03 15:55:10', '2025-11-03 15:56:01', '2025-11-03 15:55:10', 1),
(45, 35, '2025-11-03 16:07:16', '2025-11-03 16:07:16', '2025-11-03 16:07:16', 1),
(46, 36, '2025-11-03 16:11:14', '2025-11-03 16:11:14', '2025-11-03 16:11:14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda_invalido`
--

CREATE TABLE `solicitud_ayuda_invalido` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `razon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_ayuda_invalido`
--

INSERT INTO `solicitud_ayuda_invalido` (`id`, `id_doc`, `razon`) VALUES
(11, 33, 'sss');

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
(45, 31, 'Medicamentos', 'Medicamentos'),
(46, 32, 'Economica', 'Economica'),
(47, 33, 'Colchón Anti-escaras', 'Ayudas Técnicas'),
(48, 34, 'Muletas', 'Ayudas Técnicas'),
(49, 35, 'Muletas (Niño)', 'Ayudas Técnicas'),
(50, 36, 'Medicamentos', 'Medicamentos');

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
(28, '123123', 3215, 'En espera del documento físico para ser procesado 0/2', 0),
(29, '221212', 3215, 'En Proceso 1/2', 0),
(30, '212123123123123', 333, 'En espera del documento físico para ser procesado 0/2', 0),
(31, '232323', 3215, 'En espera del documento físico para ser procesado 0/2', 0),
(32, '23211111', 3215, 'En espera del documento físico para ser procesado 0/2', 0),
(33, '33232', 3215, 'En espera del documento físico para ser procesado 0/2', 0);

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
(19, 28, 0),
(20, 29, 0),
(21, 30, 0),
(22, 31, 0),
(23, 32, 0),
(24, 33, 0);

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
(25, 28, '2025-11-02 15:26:06', '2025-11-02 15:26:06', '2025-11-02 15:26:06', 1),
(26, 29, '2025-11-02 15:29:29', '2025-11-02 15:31:40', '2025-11-02 15:29:29', 1),
(27, 30, '2025-11-02 21:38:39', '2025-11-02 21:38:39', '2025-11-02 21:38:39', 1),
(28, 31, '2025-11-03 10:53:50', '2025-11-03 10:53:50', '2025-11-03 10:53:50', 1),
(29, 32, '2025-11-03 10:54:28', '2025-11-03 10:54:28', '2025-11-03 10:54:28', 1),
(30, 33, '2025-11-03 10:54:49', '2025-11-03 11:35:15', '2025-11-03 10:54:49', 1);

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
(27, 28, 'erwerwer', 'promotor socio'),
(28, 29, 'wqeqweqwe', 'promotor socio'),
(29, 30, 'sdifjsdifjisdf', 'Admin Supremo'),
(30, 31, 'qweqwe', 'Admin Supremo'),
(31, 32, 'weqwe', 'Admin Supremo'),
(32, 33, '1qwe', 'Admin Supremo');

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

--
-- Volcado de datos para la tabla `solicitud_desarrollo_laboratorio`
--

INSERT INTO `solicitud_desarrollo_laboratorio` (`id`, `id_des`, `examen`) VALUES
(26, 28, 'Hematología Completa'),
(27, 28, 'Glicemia'),
(28, 28, 'Orina'),
(29, 29, 'Hematología Completa'),
(30, 29, 'Glicemia'),
(31, 29, 'Orina'),
(32, 29, 'Heces'),
(33, 31, 'Ecosonograma'),
(34, 32, 'Eco-Doppler'),
(51, 33, 'Hematología Completa'),
(52, 33, 'Glicemia'),
(53, 33, 'Orina'),
(54, 33, 'Heces');

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
(27, 28, 'Laboratorio'),
(28, 29, 'Laboratorio'),
(29, 30, 'Laboratorio'),
(30, 31, 'Laboratorio'),
(31, 32, 'Laboratorio'),
(32, 33, 'Laboratorio');

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
(44, 31, 'Ganadores del degrado', 'promotor socio', 'Acetaminofen para mi'),
(45, 32, 'Necesita ayuda economica para suplir sus necesidades', 'promotor socio', 'Necesita anteojos'),
(46, 33, 'Sisaaa', 'Admin Supremo', 'Sin observaciones'),
(47, 34, 'Qweqweqwe', 'promotor socio', 'Sin observaciones'),
(48, 35, 'Qweqwe', 'promotor socio', 'Sin observaciones'),
(49, 36, 'Qweq', 'promotor socio', 'Sin observaciones');

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
(321, '$2y$10$b7GW4RMYoXkT7w35iXmYWuL3faGW5px.ZEi7bk4sMZZPzEwQcnjKK', 3, 'False'),
(3434, '$2y$10$mVxyGhvwSwGiVzy.MqGC2OT/VIdKw3QxLXlwp7bepBOJat44o142m', 4, 'False');

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
  MODIFY `id_despacho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `despacho_categoria`
--
ALTER TABLE `despacho_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `despacho_correo`
--
ALTER TABLE `despacho_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `despacho_fecha`
--
ALTER TABLE `despacho_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `despacho_info`
--
ALTER TABLE `despacho_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `despacho_invalido`
--
ALTER TABLE `despacho_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reportes_acciones`
--
ALTER TABLE `reportes_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT de la tabla `reportes_entradas`
--
ALTER TABLE `reportes_entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `solicitantes_comunidad`
--
ALTER TABLE `solicitantes_comunidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `solicitantes_conocimiento`
--
ALTER TABLE `solicitantes_conocimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `solicitantes_extra`
--
ALTER TABLE `solicitantes_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `solicitantes_info`
--
ALTER TABLE `solicitantes_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `solicitantes_ingresos`
--
ALTER TABLE `solicitantes_ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitantes_patologia`
--
ALTER TABLE `solicitantes_patologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `solicitantes_propiedad`
--
ALTER TABLE `solicitantes_propiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitantes_trabajo`
--
ALTER TABLE `solicitantes_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda`
--
ALTER TABLE `solicitud_ayuda`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_correo`
--
ALTER TABLE `solicitud_ayuda_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_fecha`
--
ALTER TABLE `solicitud_ayuda_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda_invalido`
--
ALTER TABLE `solicitud_ayuda_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitud_categoria`
--
ALTER TABLE `solicitud_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo`
--
ALTER TABLE `solicitud_desarrollo`
  MODIFY `id_des` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_correo`
--
ALTER TABLE `solicitud_desarrollo_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_fecha`
--
ALTER TABLE `solicitud_desarrollo_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_info`
--
ALTER TABLE `solicitud_desarrollo_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_invalido`
--
ALTER TABLE `solicitud_desarrollo_invalido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_laboratorio`
--
ALTER TABLE `solicitud_desarrollo_laboratorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `solicitud_desarrollo_tipo`
--
ALTER TABLE `solicitud_desarrollo_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `solicitud_descripcion`
--
ALTER TABLE `solicitud_descripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
