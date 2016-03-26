-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2016 a las 13:23:31
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `docentes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `ID_Actividad` int(10) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Lugar` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_trabajador`
--

CREATE TABLE IF NOT EXISTS `actividad_trabajador` (
  `ID_Actividad` int(10) NOT NULL,
  `ID_Trabajador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancias`
--

CREATE TABLE IF NOT EXISTS `constancias` (
  `ID_Constancia` int(10) NOT NULL,
  `Formato` varchar(50) NOT NULL,
  `ID_Actividad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE IF NOT EXISTS `correos` (
  `ID_Correo` int(10) NOT NULL,
  `ID_Remitente` int(10) NOT NULL,
  `Destinatario` varchar(20) NOT NULL,
  `Asunto` varchar(50) NOT NULL,
  `Leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `ID_Cuenta` int(10) NOT NULL,
  `Usuario` varchar(10) NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `TipoUsuario` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`ID_Cuenta`, `Usuario`, `Contrasena`, `TipoUsuario`) VALUES
(1, 'Admin', '1234', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
  `ID_Solicitud` int(10) NOT NULL,
  `Etapa` varchar(20) NOT NULL,
  `ID_Cuenta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE IF NOT EXISTS `trabajadores` (
  `ID_Trabajador` int(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `ApPaterno` varchar(30) NOT NULL,
  `ApMaterno` varchar(30) NOT NULL,
  `TipoTrabajo` varchar(10) NOT NULL,
  `ID_Cuenta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`ID_Actividad`);

--
-- Indices de la tabla `actividad_trabajador`
--
ALTER TABLE `actividad_trabajador`
  ADD KEY `ID_Actividad` (`ID_Actividad`), ADD KEY `ID_Trabajador` (`ID_Trabajador`);

--
-- Indices de la tabla `constancias`
--
ALTER TABLE `constancias`
  ADD PRIMARY KEY (`ID_Constancia`), ADD KEY `ID_Actividad` (`ID_Actividad`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`ID_Correo`), ADD KEY `ID_Remitente` (`ID_Remitente`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`ID_Cuenta`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`ID_Solicitud`), ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`ID_Trabajador`), ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `ID_Actividad` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `constancias`
--
ALTER TABLE `constancias`
  MODIFY `ID_Constancia` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `ID_Correo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `ID_Cuenta` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `ID_Solicitud` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `ID_Trabajador` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_trabajador`
--
ALTER TABLE `actividad_trabajador`
ADD CONSTRAINT `actividad_trabajador_ibfk_1` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividades` (`ID_Actividad`),
ADD CONSTRAINT `actividad_trabajador_ibfk_2` FOREIGN KEY (`ID_Trabajador`) REFERENCES `trabajadores` (`ID_Trabajador`);

--
-- Filtros para la tabla `constancias`
--
ALTER TABLE `constancias`
ADD CONSTRAINT `constancias_ibfk_1` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividades` (`ID_Actividad`);

--
-- Filtros para la tabla `correos`
--
ALTER TABLE `correos`
ADD CONSTRAINT `correos_ibfk_1` FOREIGN KEY (`ID_Remitente`) REFERENCES `trabajadores` (`ID_Trabajador`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuentas` (`ID_Cuenta`);

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuentas` (`ID_Cuenta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
