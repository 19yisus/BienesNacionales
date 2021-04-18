-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-04-2021 a las 18:15:40
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienes_nacionales`
--
CREATE DATABASE IF NOT EXISTS `bienes_nacionales` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `bienes_nacionales`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bien`
--

CREATE TABLE `bien` (
  `bien_cod` char(7) COLLATE utf8_spanish_ci NOT NULL,
  `bien_des` varchar(90) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_catalogo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_fecha_ingreso` date DEFAULT NULL,
  `bien_precio` decimal(12,2) DEFAULT NULL,
  `bien_depreciacion` decimal(12,2) DEFAULT NULL,
  `bien_estado` tinyint(1) DEFAULT NULL,
  `bien_fecha_desactivacion` date DEFAULT NULL,
  `bien_color_cod` int(11) DEFAULT NULL,
  `bien_serial` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_clasificacion_cod` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `bien_link_bien` char(7) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_mod_cod` int(11) DEFAULT NULL,
  `bien_sexo` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_peso` decimal(5,2) DEFAULT NULL,
  `bien_anio` decimal(4,0) DEFAULT NULL,
  `bien_placa` varchar(6) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bien_terreno` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ifcomponente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bien`
--

INSERT INTO `bien` (`bien_cod`, `bien_des`, `bien_catalogo`, `bien_fecha_ingreso`, `bien_precio`, `bien_depreciacion`, `bien_estado`, `bien_fecha_desactivacion`, `bien_color_cod`, `bien_serial`, `bien_clasificacion_cod`, `bien_link_bien`, `bien_mod_cod`, `bien_sexo`, `bien_peso`, `bien_anio`, `bien_placa`, `bien_terreno`, `ifcomponente`) VALUES
('0100000', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100001', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100002', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100003', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100004', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100005', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100006', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100007', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100008', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0100009', 'COMPUTADOR', '456465465465', '2020-10-10', '1000.00', '10000.00', 1, NULL, 5, '6546546545', '01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
('0300000', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300001', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300002', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300003', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300004', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300005', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300006', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300007', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300008', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1),
('0300009', 'DISCO DURO', '465456465465', '2020-10-10', '10000.00', '10024555.00', 1, NULL, 4, '465465456', '03', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `car_cod` int(11) NOT NULL,
  `car_des` varchar(90) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`car_cod`, `car_des`) VALUES
(1, 'Encargado(a)'),
(2, 'Empleado(a)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_cod` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cat_des` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_cod`, `cat_des`) VALUES
('BS', 'BIEN SEMOVIENTE'),
('EL', 'BIEN ELECTRONICO'),
('IN', 'BIEN INMUEBLE'),
('MA', 'BIEN MATERIAL'),
('OF', 'MATERIAL DE OFICINA'),
('TP', 'TRANSPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `cla_cod` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cla_des` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cla_cat_cod` char(2) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`cla_cod`, `cla_des`, `cla_cat_cod`) VALUES
('01', 'COMPUTADOR', 'EL'),
('02', 'MATERIAL', 'MA'),
('03', 'DISCO DURO', 'EL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `color_cod` int(11) NOT NULL,
  `color_des` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`color_cod`, `color_des`) VALUES
(1, 'ROJO'),
(2, 'AZUL'),
(3, 'AMARILLO'),
(4, 'MARRON'),
(5, 'MORADO'),
(6, 'VERDE'),
(7, 'ROSADO'),
(8, 'GRIS'),
(9, 'NEGRO'),
(10, 'BLANCO'),
(11, 'ANARANJADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `com_cod` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `com_tipo` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_estado` tinyint(1) DEFAULT NULL,
  `com_dep_user` int(11) NOT NULL,
  `com_dep_ant` int(11) DEFAULT NULL,
  `com_fecha_comprobante` date NOT NULL,
  `com_num_factura` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_justificacion` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_observacion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_origen` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_info_encargado` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `com_info_usuario` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`com_cod`, `com_tipo`, `com_estado`, `com_dep_user`, `com_dep_ant`, `com_fecha_comprobante`, `com_num_factura`, `com_justificacion`, `com_observacion`, `com_origen`, `com_info_encargado`, `com_info_usuario`) VALUES
('0000000001', 'I', 1, 1, NULL, '2021-04-18', '4545645645', '5454544545', 'INCORPORACION DE PRUEBA', 'COMPRA', 'V14887566 JESUS ALFNOS', '27132642-Programador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `dep_cod` int(11) NOT NULL,
  `dep_des` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `dep_nucleo_cod` int(11) NOT NULL,
  `dep_estado` tinyint(1) NOT NULL,
  `dep_ifprincipal` tinyint(1) NOT NULL,
  `dep_fecha_desactivacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`dep_cod`, `dep_des`, `dep_nucleo_cod`, `dep_estado`, `dep_ifprincipal`, `dep_fecha_desactivacion`) VALUES
(1, 'BIENES NACIONALES', 1, 1, 1, NULL),
(2, 'INFORMATICA', 1, 1, 0, NULL),
(3, 'BIENES NACIONALES', 2, 1, 0, NULL),
(4, 'ALMACEN', 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `mar_cod` int(11) NOT NULL,
  `mar_des` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mar_categoria_cod` char(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mar_estado` tinyint(1) DEFAULT NULL,
  `mar_fecha_desactivacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`mar_cod`, `mar_des`, `mar_categoria_cod`, `mar_estado`, `mar_fecha_desactivacion`) VALUES
(1, 'HP', 'EL', 1, NULL),
(2, 'VACA', 'BS', 1, NULL),
(3, 'CABALLO', 'BS', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `mod_cod` int(11) NOT NULL,
  `mod_des` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mod_marca_cod` int(11) DEFAULT NULL,
  `mod_estado` tinyint(1) DEFAULT NULL,
  `mod_fecha_desactivacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`mod_cod`, `mod_des`, `mod_marca_cod`, `mod_estado`, `mod_fecha_desactivacion`) VALUES
(1, 'LAPTOP LA QUE SEA', 1, 1, NULL),
(2, 'LO QUE SEA', 2, 1, NULL),
(3, 'DISCO DURO', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `mov_com_cod` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mov_com_desincorporacion` char(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mov_bien_cod` char(7) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`mov_com_cod`, `mov_com_desincorporacion`, `mov_bien_cod`) VALUES
('0000000001', NULL, '0100000'),
('0000000001', NULL, '0100001'),
('0000000001', NULL, '0100002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nucleo`
--

CREATE TABLE `nucleo` (
  `nuc_cod` int(11) NOT NULL,
  `nuc_des` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nuc_direccion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nuc_codigo_postal` char(4) COLLATE utf8_spanish_ci NOT NULL,
  `nuc_estado` tinyint(1) NOT NULL,
  `nuc_tipo_nucleo` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `nuc_nucleo_principal` int(11) DEFAULT NULL,
  `nuc_fecha_desactivacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nucleo`
--

INSERT INTO `nucleo` (`nuc_cod`, `nuc_des`, `nuc_direccion`, `nuc_codigo_postal`, `nuc_estado`, `nuc_tipo_nucleo`, `nuc_nucleo_principal`, `nuc_fecha_desactivacion`) VALUES
(1, 'ACARIGUA', 'NUEVA DIRECCI', '3301', 1, 'SP', 1, NULL),
(2, 'TUREN', 'FASDFASDFASDFASD', '3555', 1, 'NU', 1, NULL),
(3, 'GUANARE', 'ASDFASDFASDFASDF', '4564', 1, 'NU', 1, NULL),
(4, 'SANTA ROSALIA', 'FASFASDFASDFASD', '4564', 1, 'PR', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `per_cedula` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `per_nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `per_apellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `per_estado` tinyint(1) NOT NULL,
  `per_car_cod` int(11) NOT NULL,
  `per_dep_cod` int(11) NOT NULL,
  `per_telefono` char(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `per_correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `per_direccion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `per_desde` date NOT NULL,
  `per_hasta` date DEFAULT NULL,
  `per_user_id` int(11) DEFAULT NULL,
  `per_fecha_desactivacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`per_cedula`, `per_nombre`, `per_apellido`, `per_estado`, `per_car_cod`, `per_dep_cod`, `per_telefono`, `per_correo`, `per_direccion`, `per_desde`, `per_hasta`, `per_user_id`, `per_fecha_desactivacion`) VALUES
('14887566', 'JESUS', 'ALFNOS', 1, 1, 1, '04245198398', 'FASDFADS@GMAIL.COM', 'FASDFASDFASDFA', '2021-03-10', NULL, NULL, NULL),
('14887567', 'JOSE', 'FASDFASD', 1, 1, 2, '04144564655', 'FASDFASDF@GMAIL.COM', 'FASDFASDFASD', '2020-10-10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `roles_name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `crear` tinyint(1) NOT NULL,
  `modificar` tinyint(1) NOT NULL,
  `consultar` tinyint(1) NOT NULL,
  `reporte` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL,
  `admi_usuarios` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`, `crear`, `modificar`, `consultar`, `reporte`, `eliminar`, `admi_usuarios`) VALUES
(1, 'Invitado', 0, 0, 1, 1, 0, 0),
(2, 'Asistente', 1, 0, 1, 1, 0, 0),
(3, 'Admin', 1, 1, 1, 1, 1, 0),
(4, 'Super Admin', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_cedula` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `user_clave` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `user_nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `user_estado` tinyint(1) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_pregunta1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_respuesta1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_pregunta2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_respuesta2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_photo` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_cedula`, `user_clave`, `user_nombre`, `user_estado`, `user_role_id`, `user_pregunta1`, `user_respuesta1`, `user_pregunta2`, `user_respuesta2`, `user_photo`) VALUES
(1, '27132642', '$2y$12$1GkWh.I4M1jyh79KbnyuzOdLeVryQlQqry5pyUPVez2nrX.wzmdUC', 'Programador', 1, 4, 'pregunta 1', 'nada', 'pregunta 2', 'nada', 'Img/Default/User.png'),
(2, '3943546', '$2y$12$1GkWh.I4M1jyh79KbnyuzOdLeVryQlQqry5pyUPVez2nrX.wzmdUC', 'programador_2', 1, 1, 'pregunta 1', 'nada', 'pregunta 2', 'nada', 'Img/Default/User.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`bien_cod`),
  ADD KEY `bien_clasificacion_cod` (`bien_clasificacion_cod`),
  ADD KEY `bien_mod_cod` (`bien_mod_cod`),
  ADD KEY `bien_color_cod` (`bien_color_cod`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`car_cod`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_cod`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`cla_cod`),
  ADD KEY `cla_cat_cod` (`cla_cat_cod`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`color_cod`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`com_cod`),
  ADD KEY `com_dep_user` (`com_dep_user`),
  ADD KEY `com_dep_ant` (`com_dep_ant`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`dep_cod`),
  ADD KEY `dep_nucleo_cod` (`dep_nucleo_cod`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`mar_cod`),
  ADD KEY `mar_categoria_cod` (`mar_categoria_cod`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`mod_cod`),
  ADD KEY `mod_marca_cod` (`mod_marca_cod`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD KEY `mov_com_incorporacion` (`mov_com_cod`),
  ADD KEY `mov_com_desincorporacion` (`mov_com_desincorporacion`),
  ADD KEY `mov_bien_cod` (`mov_bien_cod`);

--
-- Indices de la tabla `nucleo`
--
ALTER TABLE `nucleo`
  ADD PRIMARY KEY (`nuc_cod`),
  ADD KEY `nuc_nucleo_principal` (`nuc_nucleo_principal`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`per_cedula`),
  ADD UNIQUE KEY `per_user_id` (`per_user_id`),
  ADD KEY `per_car_cod` (`per_car_cod`),
  ADD KEY `per_dep_cod` (`per_dep_cod`),
  ADD KEY `per_user_role` (`per_user_id`),
  ADD KEY `per_user_id_2` (`per_user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `car_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `color_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `dep_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `mar_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `mod_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nucleo`
--
ALTER TABLE `nucleo`
  MODIFY `nuc_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `Bien_Cor` FOREIGN KEY (`bien_color_cod`) REFERENCES `colores` (`color_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Bien_Mod` FOREIGN KEY (`bien_mod_cod`) REFERENCES `modelos` (`mod_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bien_cla` FOREIGN KEY (`bien_clasificacion_cod`) REFERENCES `clasificacion` (`cla_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD CONSTRAINT `Cla_Cat` FOREIGN KEY (`cla_cat_cod`) REFERENCES `categoria` (`cat_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD CONSTRAINT `Com_Dep_Ant` FOREIGN KEY (`com_dep_ant`) REFERENCES `dependencia` (`dep_cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Com_dep_user` FOREIGN KEY (`com_dep_user`) REFERENCES `dependencia` (`dep_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD CONSTRAINT `Dep_Nuc` FOREIGN KEY (`dep_nucleo_cod`) REFERENCES `nucleo` (`nuc_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `Mar_Cat` FOREIGN KEY (`mar_categoria_cod`) REFERENCES `categoria` (`cat_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `Mod_Mar` FOREIGN KEY (`mod_marca_cod`) REFERENCES `marcas` (`mar_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`mov_com_cod`) REFERENCES `comprobantes` (`com_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`mov_com_desincorporacion`) REFERENCES `comprobantes` (`com_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_4` FOREIGN KEY (`mov_bien_cod`) REFERENCES `bien` (`bien_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `nucleo`
--
ALTER TABLE `nucleo`
  ADD CONSTRAINT `Nuc_principal` FOREIGN KEY (`nuc_nucleo_principal`) REFERENCES `nucleo` (`nuc_cod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `Per_Car` FOREIGN KEY (`per_car_cod`) REFERENCES `cargos` (`car_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Per_Dep` FOREIGN KEY (`per_dep_cod`) REFERENCES `dependencia` (`dep_cod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Per_User` FOREIGN KEY (`per_user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`user_role_id`) REFERENCES `roles` (`roles_id`) ON UPDATE CASCADE;
--
-- Base de datos: `login_express`
--
CREATE DATABASE IF NOT EXISTS `login_express` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `login_express`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Volcado de datos para la tabla `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Volcado de datos para la tabla `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'BienesNacionales', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"bien\",\"cargos\",\"categoria\",\"clasificacion\",\"colores\",\"comprobantes\",\"dependencia\",\"marcas\",\"modelos\",\"movimmientos\",\"nucleo\",\"personas\",\"usuarios\"],\"table_structure[]\":[\"bien\",\"cargos\",\"categoria\",\"clasificacion\",\"colores\",\"comprobantes\",\"dependencia\",\"marcas\",\"modelos\",\"movimmientos\",\"nucleo\",\"personas\",\"usuarios\"],\"table_data[]\":[\"bien\",\"cargos\",\"categoria\",\"clasificacion\",\"colores\",\"comprobantes\",\"dependencia\",\"marcas\",\"modelos\",\"movimmientos\",\"nucleo\",\"personas\",\"usuarios\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Estructura de la tabla @TABLE@\",\"latex_structure_continued_caption\":\"Estructura de la tabla @TABLE@ (continúa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Contenido de la tabla @TABLE@\",\"latex_data_continued_caption\":\"Contenido de la tabla @TABLE@ (continúa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"bienes_nacionales\",\"table\":\"movimientos\"},{\"db\":\"bienes_nacionales\",\"table\":\"bien\"},{\"db\":\"bienes_nacionales\",\"table\":\"comprobantes\"},{\"db\":\"bienes_nacionales\",\"table\":\"dependencia\"},{\"db\":\"bienes_nacionales\",\"table\":\"usuarios\"},{\"db\":\"bienes_nacionales\",\"table\":\"personas\"},{\"db\":\"bienes_nacionales\",\"table\":\"roles\"},{\"db\":\"login_express\",\"table\":\"users\"},{\"db\":\"bienes_nacionales\",\"table\":\"clasificacion\"},{\"db\":\"bienes_nacionales\",\"table\":\"nucleo\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2021-04-18 16:15:02', '{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":174}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
