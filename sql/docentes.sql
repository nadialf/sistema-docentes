-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2016 a las 04:55:12
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
  `Lugar` varchar(40) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`ID_Actividad`, `Tipo`, `Nombre`, `Fecha_Inicio`, `Fecha_Fin`, `Lugar`, `Descripcion`) VALUES
(6, 'Festival', 'Install Fest', '2016-04-21', '2016-04-21', 'FEI', 'Festival de Instalación (en inglés installfest) es un acontecimiento, generalmente patrocinado por un Grupo de Usuarios de Linux local, Universidad o LAN party, en el que la gente se reúne para realizar instalaciones masivas de sistemas GNU/Linux.'),
(8, 'Congreso', 'CONISOFT', '2013-11-25', '2013-11-29', 'Museo de Antropología', 'Invitación al Congreso Internacional de Investigación e Innovación en Ingeniería de Software (CONISOFT 2013), este año la sede será en la Facultad de Estadística e Informática, de la Universidad Veracruzana, en Xalapa, Veracruz. La información del llamado a artículos  y la convocatoria del llamado a tutoriales se puede consultar en la página del evento .'),
(9, 'Taller', 'Java', '2014-09-05', '2014-09-05', 'FEI', 'El lenguaje de programación Java fue originalmente desarrollado por James Gosling de Sun Microsystems (la cual fue adquirida por la compañía Oracle) y publicado en 1995 como un componente fundamental de la plataforma Java de Sun Microsystems.'),
(10, 'Conferencia', 'Arduino', '2016-04-01', '2016-04-01', 'Museo de Antropología', 'Arduino es una compañía de hardware libre, la cual desarrolla placas de desarrollo que integran un microcontrolador y un entorno de desarrollo (IDE), diseñado para facilitar el uso de la electrónica en proyectos multidisciplinarios.'),
(11, 'Festival', 'FLISoL 2016', '2016-05-28', '2016-05-28', 'FEI', 'El FLISoL es el evento de difusión de Software Libre más grande en Latinoamérica y está dirigido a todo tipo de público: estudiantes, académicos, empresarios, trabajadores, funcionarios públicos, entusiastas y aun personas que no poseen mucho conocimiento informático.'),
(13, 'Proyecto', 'CEPII', '2016-01-01', '2016-05-02', 'FEI', 'Proyecto CEPII se basará para la realización de un sistema software para el Centro de Desarrollo Humano y Terapias Integrativas Ixtaxochitl'' A.C. (CEPII), que ayude a la agilización y eficiencia en el control de los procesos efectuados en el antes mencionado centro.'),
(14, 'Curso', 'Parallel programming model', '2015-12-05', '2015-12-05', 'Auditorio FEI', 'La programación paralela es el uso de varios procesadores trabajando en conjunto para dar solución a una tarea en común, lo que hacen es que se dividen el trabajo y cada procesador hace una porción del problema al poder intercambiar datos por una red de interconexión o atraves de memoria.'),
(16, 'Proyecto', 'SAC', '2016-02-02', '2016-05-23', 'FEI', 'Proyecto SAC (Sistema de Administración de Actividades), aspira a realizar un sistema para la Facultad de Estadística e Informática de la Universidad Veracruzana campus Xalapa, que ayude a la emisión de constancias para avalar el trabajo de los docentes que efectúan labores de modo semestral o anual, tales como actividades, cursos, proyectos y/o programas cumplidos en dicha facultad.'),
(17, 'Certificación', 'CCNA 4', '2016-01-01', '2016-06-01', 'Lab Red', 'Certificación entregada por la compañía Cisco Systems a las personas que hayan rendido satisfactoriamente el examen correspondiente sobre infraestructuras de red e Internet. Está orientada a los profesionales que operan equipamiento de networking.'),
(18, 'Festival', 'Semana del estudiante', '2016-05-23', '2016-05-25', 'FEI', 'Semana del estudiante GEEI'),
(19, 'Conferencia', 'OpenStack', '2016-04-24', '2016-04-24', 'Auditorio FEI', 'Ponente: Ing. Ramón Morales consultor en TI'),
(20, 'Festival', 'Día del programador', '2012-09-13', '2012-09-13', 'FEI', 'El Día de los Programadores es un día festivo profesional oficial en algunos países del mundo. Se celebra el 256º día de cada año (13 de septiembre durante los años normales y el 12 de septiembre durante los bisiestos).'),
(21, 'Otro', 'Concurso programación', '2016-03-14', '2016-03-14', 'CC FEI', 'Concurso de programación por equipos'),
(22, 'Certificación', 'CCNA 3', '2016-01-02', '2016-01-02', 'Lab Red', 'Certificación entregada por la compañía Cisco Systems a las personas que hayan rendido satisfactoriamente el examen correspondiente sobre infraestructuras de red e Internet. Está orientada a los profesionales que operan equipamiento de networking.'),
(25, 'Proyecto', 'Sistema Biblioteca IAP', '2016-02-02', '2016-06-17', 'Instituto de Artes Plásticas UV', 'Desarrollo e implementación del sistema.'),
(26, 'Certificación', 'Flash Professional CS6', '2016-05-07', '2016-05-08', 'CC FEI', 'Estas opciones forman parte del Programa Adobe Certified Associate (ACA).'),
(27, 'Certificación', 'Dreamweaver CS6', '2016-05-14', '2016-05-15', 'CC FEI', 'Estas opciones forman parte del Programa Adobe Certified Associate (ACA).'),
(28, 'Certificación', 'Photoshop CS6', '2016-05-20', '2016-05-21', 'CC FEI', 'Estas opciones forman parte del Programa Adobe Certified Associate (ACA).'),
(29, 'Certificación', 'Illustrator CS6', '2016-05-27', '2016-05-28', 'CC FEI', 'Estas opciones forman parte del Programa Adobe Certified Associate (ACA).'),
(30, 'Certificación', 'InDesign CS6', '2016-06-03', '2016-06-04', 'CC FEI', 'Estas opciones forman parte del Programa Adobe Certified Associate (ACA).');

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`ID_Asignacion`, `Fecha_Incorporacion`, `Avance`, `ID_Actividad`, `ID_Trabajador`) VALUES
(46, '2016-05-23', 'Terminada', 10, 15),
(47, '2016-05-23', 'Por comenzar', 11, 20),
(48, '2016-05-23', 'Terminada', 6, 20),
(49, '2016-05-23', 'Terminada', 13, 10),
(50, '2016-05-24', 'Terminada', 26, 15),
(51, '2016-05-24', 'Terminada', 19, 15),
(52, '2016-05-24', 'En curso', 17, 12),
(53, '2016-05-24', 'Terminada', 8, 12),
(54, '2016-05-24', 'Por comenzar', 30, 8),
(55, '2016-05-24', 'Terminada', 22, 16),
(56, '2016-05-24', 'Terminada', 27, 16),
(57, '2016-05-24', 'Terminada', 16, 7),
(58, '2016-05-24', 'Terminada', 8, 14),
(59, '2016-05-24', 'Terminada', 20, 14),
(60, '2016-05-24', 'Terminada', 21, 21),
(61, '2016-05-24', 'Terminada', 20, 21),
(62, '2016-05-24', 'Terminada', 9, 14),
(63, '2016-05-24', 'Terminada', 9, 11),
(64, '2016-05-24', 'Terminada', 14, 11),
(65, '2016-05-24', 'Terminada', 8, 5),
(66, '2016-05-24', 'Terminada', 14, 5),
(67, '2016-05-24', 'Por comenzar', 29, 5),
(68, '2016-05-24', 'Terminada', 28, 13),
(69, '2016-05-24', 'Terminada', 16, 13),
(70, '2016-05-24', 'Terminada', 8, 13),
(71, '2016-05-24', 'En curso', 25, 4),
(72, '2016-05-24', 'Terminada', 8, 4),
(73, '2016-05-24', 'Terminada', 6, 16),
(74, '2016-05-24', 'Por comenzar', 11, 16),
(75, '2016-05-24', 'En curso', 18, 16),
(76, '2016-05-24', 'En curso', 18, 4),
(77, '2016-05-24', 'Terminada', 10, 9),
(78, '2016-05-24', 'Terminada', 22, 9),
(79, '2016-05-24', 'Terminada', 14, 9),
(80, '2016-05-24', 'En curso', 18, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancias`
--

CREATE TABLE IF NOT EXISTS `constancias` (
  `ID_Constancias` int(11) NOT NULL,
  `Formato` varchar(100) NOT NULL,
  `ID_Solicitud` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `constancias`
--

INSERT INTO `constancias` (`ID_Constancias`, `Formato`, `ID_Solicitud`) VALUES
(50, 'Si', 20),
(51, 'Si', 35),
(52, 'Si', 31),
(53, 'Si', 33),
(54, 'Si', 27),
(55, 'Si', 36),
(56, 'Si', 28),
(57, 'Si', 22),
(58, 'Si', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE IF NOT EXISTS `correos` (
  `ID_Correo` int(10) NOT NULL,
  `ID_Remitente` int(10) NOT NULL,
  `Destinatario` varchar(20) NOT NULL,
  `Asunto` varchar(500) NOT NULL,
  `Leido` tinyint(1) NOT NULL,
  `Fecha_Envio` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`ID_Correo`, `ID_Remitente`, `Destinatario`, `Asunto`, `Leido`, `Fecha_Envio`) VALUES
(4, 4, 'Admin', 'No estoy asignado al taller Java', 1, '2016-04-12'),
(5, 16, 'Admin', 'No estoy asignado al proyecto CEPII', 1, '2016-04-03'),
(6, 5, 'Admin', 'No estoy asignado la conferencia Arduino', 0, '2016-01-08'),
(7, 15, 'Admin', 'No estoy asignado a la conferencia Redes', 1, '2016-04-13'),
(8, 15, 'Admin', 'No me encuentro asignado a la conferencia de arduino', 0, '2016-05-24'),
(9, 21, 'Admin', 'Asignarme al día del programador', 0, '2016-05-24'),
(10, 12, 'Admin', 'Se me debe asignar a CCNA 4. Saludos', 0, '2016-05-24'),
(11, 14, 'Admin', 'No estoy asignado al día del programador', 0, '2016-05-24'),
(12, 9, 'Admin', 'Asignarme a la semana del estudiante', 0, '2016-05-24'),
(13, 20, 'Admin', 'Asignarme al festival FLISoL', 1, '2016-05-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `ID_Cuenta` int(10) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `TipoUsuario` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`ID_Cuenta`, `Usuario`, `Contrasena`, `TipoUsuario`) VALUES
(1, 'Admin', 'GFFAN3', '1'),
(4, 'MISLina', 'ss0000', '3'),
(5, 'Liz07', '1234', '3'),
(7, 'JGibran', '654321', '3'),
(8, 'EBenitez', '123456', '3'),
(9, 'Oscar-22', '123456', '3'),
(10, 'DocenteBlanca', 'blancaL', '3'),
(11, 'Docente_JLuis', '123456', '3'),
(12, 'DocenteOchoa', 'Ochoa1234', '3'),
(13, 'Angy-Docente', '1234', '3'),
(14, 'D_Revo', '1234', '3'),
(15, 'AlfonsoOrea', 'pssOrea', '3'),
(16, 'Ballo', '1234', '3'),
(20, 'Director', 'ab@34', '2'),
(21, 'AngelSG', '1234@', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
  `ID_Solicitud` int(11) NOT NULL,
  `Etapa` varchar(30) NOT NULL,
  `ID_Trabajador` int(11) NOT NULL,
  `ID_Actividad` int(11) NOT NULL,
  `Aceptada` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`ID_Solicitud`, `Etapa`, `ID_Trabajador`, `ID_Actividad`, `Aceptada`) VALUES
(20, 'Firmada', 9, 14, 1),
(21, 'En proceso', 9, 10, 0),
(22, 'Firmada', 15, 19, 1),
(23, 'Aceptada', 15, 10, 1),
(24, 'En proceso', 21, 21, 0),
(25, 'Aceptada', 10, 13, 1),
(26, 'En proceso', 12, 8, 0),
(27, 'Firmada', 20, 6, 1),
(28, 'Firmada', 16, 6, 1),
(29, 'Aceptada', 16, 22, 1),
(30, 'Aceptada', 7, 16, 1),
(31, 'Firmada', 14, 9, 1),
(32, 'Firmada', 14, 20, 1),
(33, 'Firmada', 5, 14, 1),
(34, 'En proceso', 13, 8, 0),
(35, 'Firmada', 13, 16, 1),
(36, 'Firmada', 13, 28, 1),
(37, 'En proceso', 4, 8, 0);

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
(20, 'Gerardo', 'Contreras', 'Vega', 'PTC', 20),
(21, 'Ángel Juan', 'Sánchez', 'García', 'PTC', 21);

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
  ADD PRIMARY KEY (`ID_Constancias`), ADD KEY `constancias_ibfk_1` (`ID_Solicitud`);

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
  MODIFY `ID_Actividad` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `ID_Asignacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT de la tabla `constancias`
--
ALTER TABLE `constancias`
  MODIFY `ID_Constancias` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `ID_Correo` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `ID_Cuenta` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `ID_Solicitud` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
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
ADD CONSTRAINT `constancias_ibfk_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitudes` (`ID_Solicitud`) ON DELETE CASCADE;

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
