-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-04-2021 a las 20:39:36
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.7

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
('2400000', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400001', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400002', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400003', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400004', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400005', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400006', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400007', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400008', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2400009', 'COMPUTADOR DE MESA', '465465465465', '2020-10-10', '100000000.00', '100000.00', 1, NULL, 3, '65465DSDS', '24', NULL, 3, NULL, NULL, NULL, NULL, NULL, 0),
('2600003', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600004', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600005', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600006', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600007', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600008', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1),
('2600009', 'DISCO DURO', '465465465465', '2020-10-10', '100000000.00', '100000000.00', 1, NULL, 5, '654ASD564564', '26', NULL, 2, NULL, NULL, NULL, NULL, NULL, 1);

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
('12', 'PALA', 'MA'),
('20', 'SILLA', 'OF'),
('24', 'COMPUTADOR', 'EL'),
('26', 'DISCO DURO', 'EL'),
('55', 'TRANSPORTE', 'TP'),
('60', 'TERRENO', 'IN'),
('80', 'SEMOVIENTE', 'BS');

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
  `com_fecha_comprobante` datetime NOT NULL,
  `com_num_factura` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_justificacion` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_observacion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_origen` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `com_info_encargado` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `com_info_usuario` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(2, 'AlMACEN', 1, 1, 0, NULL),
(3, 'DEPARTAMENTO DE INFORMATICA', 1, 1, 0, NULL);

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
(2, 'FORD', 'TP', 1, NULL),
(3, 'SAMSUNG', 'EL', 1, NULL),
(4, 'CATERPILAR', 'MA', 1, NULL),
(5, 'VACA', 'BS', 1, NULL),
(6, 'CERDO', 'BS', 1, NULL),
(7, 'STEELCASE', 'OF', 1, NULL);

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
(1, 'AUTOBUS 320', 2, 1, NULL),
(2, 'DISCO DURO 1TB', 3, 1, NULL),
(3, 'COMPUTADOR 245', 1, 1, NULL),
(4, 'PALA DE MADERA 222', 4, 1, NULL),
(5, 'HOLSTEIN', 5, 1, NULL),
(6, 'ANGUS', 5, 1, NULL),
(7, 'DUROC', 6, 1, NULL),
(8, 'LARGE WHITE', 6, 1, NULL),
(9, 'SILLA PLEASE V2', 7, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `mov_com_cod` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mov_com_desincorporacion` char(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mov_bien_cod` char(7) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, '\"UPTP JJ MONTILLA\" ACARIGUA', 'DIRECCION DE LA SEDE PRINCIPAL', '3301', 1, 'SP', NULL, NULL),
(2, '\"UPTP JJ MONTILLA\" TUREN', 'DIRECCION DE TUREN', '3304', 1, 'NU', 1, NULL);

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
('14887885', 'JOSE ', 'TORRES', 1, 1, 1, '04145522562', 'JJOSE@GMAIL.COM', 'DIRECCION DE LA PERSONA JOSE', '2020-10-10', NULL, NULL, NULL),
('20254465', 'RONALDO', 'REYES', 1, 1, 3, '04245225446', 'FASDFASDFA@GMAIL.COM', 'FASDFASDFASDFAS', '2020-10-10', NULL, NULL, NULL),
('22520004', 'ALBERTO', 'TORRES', 1, 1, 2, '04145225220', 'ALBERTO@GMAIL.COM', 'DIRECCION DE ALBERTO', '2020-10-10', NULL, NULL, NULL);

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
(1, '27132642', '$2y$12$w86sqF5fFOXFl0uMPCvg/uwQVCI2giNiqonlUKoxKGjtb19SEGh/e', 'PROGRAMADOR', 1, 4, 'pregunta 1', 'NADA', 'pregunta 2', 'NADA', 'Img/Default/User.png'),
(2, '3943546', '$2y$12$1GkWh.I4M1jyh79KbnyuzOdLeVryQlQqry5pyUPVez2nrX.wzmdUC', 'PROGRAMADOR2', 1, 1, 'pregunta 1', 'nada', 'pregunta 2', 'nada', 'Img/Default/User.png');

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
  MODIFY `dep_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `mar_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `mod_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nucleo`
--
ALTER TABLE `nucleo`
  MODIFY `nuc_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
