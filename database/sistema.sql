-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2025 a las 03:27:53
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
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE `despacho` (
  `id_doc` int(11) NOT NULL,
  `id_manual` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `asunto` varchar(500) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `razon` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `creador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despacho`
--

INSERT INTO `despacho` (`id_doc`, `id_manual`, `ci`, `asunto`, `estado`, `razon`, `fecha`, `creador`) VALUES
(1, 23, 1104, 'prueba 1 despach', 'En Revisión 1/2', '', '2025-08-05 20:19:33', 'pepe gonzalez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_docs`
--

CREATE TABLE `registros_docs` (
  `id` int(11) NOT NULL,
  `tipo_doc` varchar(100) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL
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
(17, 2, '2025-08-11 21:08:31', 'Envió la solicitud a despacho.', 34);

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
(1, 3434, '2025-08-05 08:22:06', '2025-08-05 08:22:10'),
(2, 3434, '2025-08-05 08:26:21', '2025-08-05 08:26:25'),
(3, 3434, '2025-08-05 08:39:04', '2025-08-05 08:39:08'),
(4, 3434, '2025-08-05 08:39:36', '2025-08-05 08:39:43'),
(5, 3434, '2025-08-05 08:48:01', '2025-08-05 08:48:10'),
(6, 3434, '2025-08-05 08:48:56', '2025-08-05 08:49:00'),
(7, 3434, '2025-08-05 08:56:21', '2025-08-05 08:56:25'),
(8, 3434, '2025-08-05 08:58:09', '2025-08-05 08:58:13'),
(9, 3434, '2025-08-05 08:58:40', '2025-08-05 08:58:44'),
(10, 3434, '2025-08-05 08:59:51', '2025-08-05 08:59:55'),
(11, 3434, '2025-08-05 09:00:10', '2025-08-05 19:02:07'),
(12, 123, '2025-08-05 19:02:41', '0000-00-00 00:00:00'),
(13, 3434, '2025-08-06 19:35:00', '2025-08-06 19:36:09'),
(14, 123, '2025-08-06 19:37:11', '2025-08-06 19:37:16'),
(15, 123, '2025-08-06 19:37:30', '0000-00-00 00:00:00'),
(16, 3434, '2025-08-11 10:13:35', '2025-08-11 10:49:03'),
(17, 123, '2025-08-11 10:49:19', '2025-08-11 10:52:20'),
(18, 3434, '2025-08-11 20:04:49', '2025-08-11 21:07:53'),
(19, 34, '2025-08-11 21:08:03', '2025-08-11 21:24:12'),
(20, 3434, '2025-08-11 21:24:23', '0000-00-00 00:00:00');

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
  `apellido` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`id_solicitante`, `ci`, `nombre`, `apellido`) VALUES
(4, 1104, 'Pedro', 'Gonzalez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_comunidad`
--

CREATE TABLE `solicitantes_comunidad` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `comunidad` varchar(255) DEFAULT NULL,
  `direc_habita` varchar(255) DEFAULT NULL,
  `estruc_base` varchar(255) DEFAULT NULL,
  `creador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_comunidad`
--

INSERT INTO `solicitantes_comunidad` (`id`, `id_solicitante`, `comunidad`, `direc_habita`, `estruc_base`, `creador`) VALUES
(3, 4, 'plus', 'Cuarzo', 'Asamblea de diosdado', '');

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
(3, 4, 'Ingeniero En Medicina', 'Secundaria');

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
(3, 4, '34234234', '129129128912');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_info`
--

CREATE TABLE `solicitantes_info` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `estado_civil` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_info`
--

INSERT INTO `solicitantes_info` (`id`, `id_solicitante`, `fecha_nacimiento`, `lugar_nacimiento`, `edad`, `estado_civil`, `telefono`) VALUES
(4, 4, '2017-02-16', 'Caracas', 8, 'Soltero/a', '04242323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes_ingresos`
--

CREATE TABLE `solicitantes_ingresos` (
  `id` int(11) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `nivel_ingreso` varchar(255) DEFAULT NULL,
  `pension` varchar(255) DEFAULT NULL,
  `bono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes_ingresos`
--

INSERT INTO `solicitantes_ingresos` (`id`, `id_solicitante`, `nivel_ingreso`, `pension`, `bono`) VALUES
(3, 4, '50033', 'Si', 'Si');

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
(3, 4, 'Apartamento', 'Prestada', 'No tiene observaciones');

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
(3, 4, 'Developer', 'Empresa Yaritagua', 'No', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_despacho`
--

CREATE TABLE `solicitudes_despacho` (
  `id` int(11) NOT NULL,
  `id_manual` varchar(50) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ayuda`
--

CREATE TABLE `solicitud_ayuda` (
  `id_doc` int(11) NOT NULL,
  `id_manual` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `tipo_ayuda` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `remitente` varchar(100) DEFAULT NULL,
  `promotor` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `visto` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `razon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_ayuda`
--

INSERT INTO `solicitud_ayuda` (`id_doc`, `id_manual`, `descripcion`, `fecha`, `ci`, `tipo_ayuda`, `categoria`, `remitente`, `promotor`, `observaciones`, `visto`, `estado`, `razon`) VALUES
(2, '2424', 'Tiene sudado el estómago', '2025-08-04 10:26:33', '1104', 'Muletas', 'Laboratorio', 'Jose Gonzalez', 'Admin Supremo', 'la verdad es que no sé', 0, 'En Proceso 2/3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_inhabilitados`
--

CREATE TABLE `solicitud_inhabilitados` (
  `id_doc` int(11) NOT NULL,
  `id_manual` varchar(50) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `tipo_ayuda` varchar(100) DEFAULT NULL,
  `categoría_ayuda` varchar(100) DEFAULT NULL,
  `remitente` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `razón_invalid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3434, '$2y$10$RNNLpe0hPJaIRhYcIHlgk.q.tIz8.YQFuFOrDZbP5YotTJ8IPV22e', 4, 'True');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_info`
--

CREATE TABLE `usuarios_info` (
  `id` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_info`
--

INSERT INTO `usuarios_info` (`id`, `ci`, `nombre`, `apellido`) VALUES
(2, 3434, 'Admin', 'Supremo'),
(5, 123, 'pepe', 'gonzalez'),
(6, 34, 'promotor', 'socio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indices de la tabla `registros_docs`
--
ALTER TABLE `registros_docs`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `solicitudes_despacho`
--
ALTER TABLE `solicitudes_despacho`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_ayuda`
--
ALTER TABLE `solicitud_ayuda`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indices de la tabla `solicitud_inhabilitados`
--
ALTER TABLE `solicitud_inhabilitados`
  ADD PRIMARY KEY (`id_doc`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `despacho`
--
ALTER TABLE `despacho`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registros_docs`
--
ALTER TABLE `registros_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes_acciones`
--
ALTER TABLE `reportes_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `reportes_entradas`
--
ALTER TABLE `reportes_entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitantes_comunidad`
--
ALTER TABLE `solicitantes_comunidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitantes_conocimiento`
--
ALTER TABLE `solicitantes_conocimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitantes_extra`
--
ALTER TABLE `solicitantes_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitantes_info`
--
ALTER TABLE `solicitantes_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitantes_ingresos`
--
ALTER TABLE `solicitantes_ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitantes_patologia`
--
ALTER TABLE `solicitantes_patologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitantes_propiedad`
--
ALTER TABLE `solicitantes_propiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitantes_trabajo`
--
ALTER TABLE `solicitantes_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_despacho`
--
ALTER TABLE `solicitudes_despacho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_ayuda`
--
ALTER TABLE `solicitud_ayuda`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitud_inhabilitados`
--
ALTER TABLE `solicitud_inhabilitados`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_info`
--
ALTER TABLE `usuarios_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

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
