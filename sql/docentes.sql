-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2016 a las 17:45:33
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
  `Nombre` varchar(75) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Lugar` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`ID_Actividad`, `Tipo`, `Nombre`, `Fecha_Inicio`, `Fecha_Fin`, `Lugar`) VALUES
(6, 'Festival', 'Install Fest', '2016-04-21', '2016-04-21', 'FEI'),
(8, 'Congreso', 'CONISOFT', '2016-02-01', '2016-03-01', 'Museo de Antropología'),
(9, 'Taller', 'Java', '2015-09-02', '2015-09-09', 'FEI'),
(10, 'Conferencia', 'Arduino', '2016-04-01', '2016-04-01', 'Museo de Antropología'),
(11, 'Festival', 'FLISoL 2016', '2016-04-23', '2017-01-01', 'FEI'),
(12, 'Conferencia', 'Redes', '2016-04-14', '2016-04-30', 'Museo de Antropología'),
(13, 'Proyecto', 'CEPII', '2016-01-01', '2016-05-02', 'FEI'),
(14, 'Conferencia', 'Parallel programming model', '2015-12-05', '2015-12-05', 'Auditorio FEI'),
(15, 'Conferencia', 'prueba', '2016-01-01', '2016-12-31', 'FEI'),
(16, 'Proyecto', 'SAC', '2016-02-02', '2016-05-25', 'FEI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE IF NOT EXISTS `asignaciones` (
  `ID_Asignacion` int(11) NOT NULL,
  `Fecha_Incorporacion` date NOT NULL,
  `Avance` varchar(30) NOT NULL,
  `ID_Actividad` int(10) NOT NULL,
  `ID_Trabajador` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`ID_Asignacion`, `Fecha_Incorporacion`, `Avance`, `ID_Actividad`, `ID_Trabajador`) VALUES
(2, '2016-03-22', 'En curso', 6, 11),
(4, '2016-04-03', 'Terminada', 9, 16),
(5, '2016-04-11', 'Terminada', 10, 8),
(6, '2016-12-31', 'Terminada', 8, 4),
(7, '2017-02-02', 'Terminada', 10, 15),
(8, '2014-06-29', 'Terminada', 9, 5),
(9, '2016-04-02', 'En curso', 13, 10),
(10, '2016-04-12', 'Por comenzar', 11, 2),
(11, '2015-12-01', 'Terminada', 14, 14),
(16, '2016-04-21', 'En curso', 16, 7),
(17, '2016-04-21', 'En curso', 16, 1),
(21, '2016-04-21', 'En curso', 12, 9);

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
  `Leido` tinyint(1) NOT NULL,
  `Fecha_Envio` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`ID_Correo`, `ID_Remitente`, `Destinatario`, `Asunto`, `Leido`, `Fecha_Envio`) VALUES
(3, 19, 'Admin', 'No estoy asignado al congreso CONISOFT', 1, '2016-04-13'),
(4, 4, 'Admin', 'No estoy asignado al taller Java', 0, '2016-04-12'),
(5, 16, 'Admin', 'No estoy asignado al proyecto CEPII', 1, '2016-04-03'),
(6, 5, 'Admin', 'No estoy asignado la conferencia Arduino', 0, '2016-01-08'),
(7, 15, 'Admin', 'No estoy asignado a la conferencia Redes', 1, '2016-04-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `ID_Cuenta` int(10) NOT NULL,
  `Usuario` varchar(10) NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `TipoUsuario` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`ID_Cuenta`, `Usuario`, `Contrasena`, `TipoUsuario`) VALUES
(1, 'Admin', '1234', '1'),
(3, 'Director', '1234', '2'),
(4, 'Docente2', '1234', '3'),
(5, 'Docente3', '1234', '3'),
(7, 'Docente5', '1234', '3'),
(8, 'Docente6', '1234', '3'),
(9, 'Docente7', '1234', '3'),
(10, 'Docente8', '1234', '3'),
(11, 'Docente9', '1234', '3'),
(12, 'Docente12', '1234', '3'),
(13, 'Docente13', '1234', '3'),
(14, 'Docente14', '1234', '3'),
(15, 'DocenteX', '1234', '3'),
(16, 'Docente16', '1234', '3'),
(19, 'hola', '1234', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
  `ID_Solicitud` int(11) NOT NULL,
  `Etapa` varchar(30) NOT NULL,
  `ID_Trabajador` int(11) NOT NULL,
  `ID_Actividad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`ID_Solicitud`, `Etapa`, `ID_Trabajador`, `ID_Actividad`) VALUES
(1, 'En proceso', 5, 8),
(2, 'En proceso', 9, 15),
(3, 'En proceso', 9, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE IF NOT EXISTS `trabajadores` (
  `ID_Trabajador` int(10) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `ApPaterno` varchar(30) NOT NULL,
  `ApMaterno` varchar(30) NOT NULL,
  `TipoTrabajo` varchar(10) NOT NULL,
  `ID_Cuenta` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`ID_Trabajador`, `Nombres`, `ApPaterno`, `ApMaterno`, `TipoTrabajo`, `ID_Cuenta`) VALUES
(1, 'Guillermo Felipe Francisco', 'Araceli', 'Nadia', 'PTC', 1),
(2, 'Gerardo', 'Contreras', 'Vega', 'PTC', 3),
(4, 'María Lina', 'López', 'Martínez', 'TP', 4),
(5, 'Lizbeth Alejandra', 'Hernández', 'González', 'TP', 5),
(7, 'Jorge Gibran', 'Hernández', 'Calderón', 'PTC', 7),
(8, 'Edgard Iván', 'Benítez', 'Guerrero', 'PA', 8),
(9, 'Óscar José Luis', 'Cruz', 'Reyes', 'PA', 9),
(10, 'Blanca Rosa', 'Landa', 'Pensado', 'PTC', 10),
(11, 'Juan Luis', 'López', 'Herrera', 'PA', 11),
(12, 'Carlos Alberto', 'Ochoa', 'Rivera', 'PTC', 12),
(13, 'María de los Angeles', 'Navarro', 'Guerrero', 'PTC', 13),
(14, 'Juan Carlos', 'Pérez', 'Arriaga', 'PTC', 14),
(15, 'Alfonso', 'Sánchez', 'Orea', 'PTC', 15),
(16, 'Jesús Roberto', 'Méndez', 'Ortíz', 'PTC', 16),
(19, 'Memowii', 'hola', 'hola', 'hola', 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`ID_Actividad`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`ID_Asignacion`), ADD KEY `asignaciones_ibfk_1` (`ID_Actividad`), ADD KEY `asignaciones_ibfk_2` (`ID_Trabajador`);

--
-- Indices de la tabla `constancias`
--
ALTER TABLE `constancias`
  ADD PRIMARY KEY (`ID_Constancia`), ADD KEY `constancias_ibfk_1` (`ID_Actividad`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`ID_Correo`), ADD KEY `correos_ibfk_1` (`ID_Remitente`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`ID_Cuenta`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`ID_Solicitud`), ADD KEY `solicitudes_ibfk_1` (`ID_Trabajador`), ADD KEY `solicitudes_ibfk_2` (`ID_Actividad`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`ID_Trabajador`), ADD KEY `trabajadores_ibfk_1` (`ID_Cuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `ID_Actividad` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `ID_Asignacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `constancias`
--
ALTER TABLE `constancias`
  MODIFY `ID_Constancia` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `ID_Correo` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `ID_Cuenta` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `ID_Solicitud` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `ID_Trabajador` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividades` (`ID_Actividad`) ON DELETE CASCADE,
ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`ID_Trabajador`) REFERENCES `trabajadores` (`ID_Trabajador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `constancias`
--
ALTER TABLE `constancias`
ADD CONSTRAINT `constancias_ibfk_1` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividades` (`ID_Actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `correos`
--
ALTER TABLE `correos`
ADD CONSTRAINT `correos_ibfk_1` FOREIGN KEY (`ID_Remitente`) REFERENCES `trabajadores` (`ID_Trabajador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`ID_Trabajador`) REFERENCES `trabajadores` (`ID_Trabajador`) ON DELETE CASCADE,
ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividades` (`ID_Actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuentas` (`ID_Cuenta`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
