-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-12-2024 a las 01:36:39
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaescolar`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `ObtenerRendimientoEstudianteEnCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerRendimientoEstudianteEnCurso` (IN `p_IdEstudiante` INT, IN `p_IdCurso` INT)   BEGIN
    SELECT
        e.Id_estudiantes,
        e.nombre_estudiantes,
        e.apellido_estudiantes,
        c.nombre_cursos,
        cal.calificacion,
        cal.fecha_calificaciones
    FROM
        Estudiantes e
    JOIN
        Calificaciones cal ON e.Id_estudiantes = cal.Estudiantes_Id_estudiantes
    JOIN
        Cursos c ON cal.Cursos_Id_cursos = c.Id_cursos
    WHERE
        e.Id_estudiantes = p_IdEstudiante AND c.Id_cursos = p_IdCurso;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `Id_Asistencia` int NOT NULL AUTO_INCREMENT,
  `Fecha_Asistencia` date DEFAULT NULL,
  `Presente` tinyint DEFAULT NULL,
  `Estudiantes_Id_Estudiantes` int DEFAULT NULL,
  `Cursos_Id_Cursos` int DEFAULT NULL,
  PRIMARY KEY (`Id_Asistencia`),
  KEY `Estudiantes_Id_Estudiantes` (`Estudiantes_Id_Estudiantes`),
  KEY `Cursos_Id_Cursos` (`Cursos_Id_Cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`Id_Asistencia`, `Fecha_Asistencia`, `Presente`, `Estudiantes_Id_Estudiantes`, `Cursos_Id_Cursos`) VALUES
(3, '2024-12-08', 1, 1, 1),
(4, '2024-12-08', 1, 1, 1),
(5, '2024-12-02', 0, 2, 2),
(6, '2024-12-09', 1, 1, 1),
(7, '2024-12-08', 1, 1, 9),
(8, '2024-12-08', 1, 2, 9),
(9, '2024-12-08', 1, 1, 9),
(10, '2024-12-08', 1, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `Id_Calificaciones` int NOT NULL AUTO_INCREMENT,
  `Calificacion` decimal(5,2) DEFAULT NULL,
  `Fecha_Calificaciones` date DEFAULT NULL,
  `Estudiantes_Id_Estudiantes` int DEFAULT NULL,
  `Cursos_Id_Cursos` int DEFAULT NULL,
  PRIMARY KEY (`Id_Calificaciones`),
  KEY `Estudiantes_Id_Estudiantes` (`Estudiantes_Id_Estudiantes`),
  KEY `Cursos_Id_Cursos` (`Cursos_Id_Cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`Id_Calificaciones`, `Calificacion`, `Fecha_Calificaciones`, `Estudiantes_Id_Estudiantes`, `Cursos_Id_Cursos`) VALUES
(1, 8.00, '2024-12-09', 1, 1),
(2, 7.00, '2024-06-16', 2, 2),
(5, 2.00, '2024-12-08', 2, 1),
(6, 6.00, '2024-12-09', 1, 2),
(7, 9.00, '2024-12-09', 2, 1),
(9, 10.00, '2024-12-05', 18, 9),
(10, 9.80, '2024-12-05', 18, 8);

--
-- Disparadores `calificaciones`
--
DROP TRIGGER IF EXISTS `ActualizarPromedioCalificaciones`;
DELIMITER $$
CREATE TRIGGER `ActualizarPromedioCalificaciones` AFTER INSERT ON `calificaciones` FOR EACH ROW BEGIN
    DECLARE promedio DECIMAL(5, 2);
    SELECT AVG(calificacion)
    INTO promedio
    FROM Calificaciones
    WHERE Estudiantes_Id_estudiantes = NEW.Estudiantes_Id_estudiantes;

    UPDATE Estudiantes
    SET promedio_calificaciones = promedio
    WHERE Id_estudiantes = NEW.Estudiantes_Id_estudiantes;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cargaacademicaprofesores`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `cargaacademicaprofesores`;
CREATE TABLE IF NOT EXISTS `cargaacademicaprofesores` (
`Id_profesores` int
,`nombre_profesores` varchar(45)
,`apellido_profesores` varchar(45)
,`nombre_cursos` varchar(45)
,`creditos` int
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `Id_Cursos` int NOT NULL AUTO_INCREMENT,
  `Nombre_Cursos` varchar(45) NOT NULL,
  `Descripcion` text,
  `Creditos` int DEFAULT NULL,
  PRIMARY KEY (`Id_Cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Id_Cursos`, `Nombre_Cursos`, `Descripcion`, `Creditos`) VALUES
(1, 'Álgebra I', 'Curso de introducción al álgebra', 3),
(2, 'Física General', 'Curso de física básica', 4),
(8, 'Calculo Integral', 'Sobre matemáticas', 6),
(9, 'Ingles', 'idiomas', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `Id_Estudiantes` int NOT NULL AUTO_INCREMENT,
  `Nombre_Estudiantes` varchar(45) NOT NULL,
  `Apellido_Estudiantes` varchar(45) NOT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Estudiantes` varchar(45) DEFAULT NULL,
  `Telefono_Estudiantes` varchar(45) DEFAULT NULL,
  `Direccion` text,
  `Fecha_Registro` date DEFAULT NULL,
  `Roles_Id_Roles` int DEFAULT NULL,
  `promedio_calificaciones` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Estudiantes`),
  KEY `Roles_Id_Roles` (`Roles_Id_Roles`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`Id_Estudiantes`, `Nombre_Estudiantes`, `Apellido_Estudiantes`, `Fecha_Nacimiento`, `Correo_Estudiantes`, `Telefono_Estudiantes`, `Direccion`, `Fecha_Registro`, `Roles_Id_Roles`, `promedio_calificaciones`) VALUES
(1, 'Carlos', 'Gomez', '2003-05-14', 'carlos.gomez@example.com', '123456789', 'Calle Falsa 123', '2023-09-01', 3, 8.17),
(2, 'Lucia', 'Reyes', '2002-08-21', 'lucia.reyes@example.com', '987654321', 'Avenida Principal 456', '2023-09-05', 3, 6.00),
(18, 'Josue', 'Perez', '2003-05-16', 'josue@gmail.com', '9854725651', 'Cielo nuevo', '2024-12-03', 3, 9.90);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `historialacademico`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `historialacademico`;
CREATE TABLE IF NOT EXISTS `historialacademico` (
`Id_estudiantes` int
,`nombre_estudiantes` varchar(45)
,`apellido_estudiantes` varchar(45)
,`nombre_cursos` varchar(45)
,`calificacion` decimal(5,2)
,`fecha_calificaciones` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE IF NOT EXISTS `profesores` (
  `Id_Profesores` int NOT NULL AUTO_INCREMENT,
  `Nombre_Profesores` varchar(45) NOT NULL,
  `Apellido_Profesores` varchar(45) NOT NULL,
  `Correo_Profesores` varchar(45) DEFAULT NULL,
  `Telefono_Profesores` varchar(45) DEFAULT NULL,
  `Especialidad` varchar(45) DEFAULT NULL,
  `Fecha_Contratacion` date DEFAULT NULL,
  `Roles_Id_Roles` int DEFAULT NULL,
  PRIMARY KEY (`Id_Profesores`),
  KEY `Roles_Id_Roles` (`Roles_Id_Roles`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`Id_Profesores`, `Nombre_Profesores`, `Apellido_Profesores`, `Correo_Profesores`, `Telefono_Profesores`, `Especialidad`, `Fecha_Contratacion`, `Roles_Id_Roles`) VALUES
(1, 'Ana', 'Sanchez', 'ana.sanchez@example.com', '1122334455', 'Matemáticas', '2020-01-15', 2),
(2, 'Pedro', 'Ramirez', 'pedro.ramirez@example.com', '5544332211', 'Física', '2019-03-10', 2),
(4, 'Manuel Alejandro', 'Barrera', 'barrera@gmail.com', '1648251948', 'Programación web', '2022-02-08', 2),
(5, 'Marco', 'Canche', 'marco@gmail.com', '6651487552', 'Ingles', '2024-12-08', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores_cursos`
--

DROP TABLE IF EXISTS `profesores_cursos`;
CREATE TABLE IF NOT EXISTS `profesores_cursos` (
  `Profesores_Id_Profesores` int NOT NULL,
  `Cursos_Id_Cursos` int NOT NULL,
  PRIMARY KEY (`Profesores_Id_Profesores`,`Cursos_Id_Cursos`),
  KEY `Cursos_Id_Cursos` (`Cursos_Id_Cursos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores_cursos`
--

INSERT INTO `profesores_cursos` (`Profesores_Id_Profesores`, `Cursos_Id_Cursos`) VALUES
(5, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

DROP TABLE IF EXISTS `reporte`;
CREATE TABLE IF NOT EXISTS `reporte` (
  `Id_ReportE` int NOT NULL AUTO_INCREMENT,
  `Calificaciones_Id_Calificaciones` int DEFAULT NULL,
  PRIMARY KEY (`Id_ReportE`),
  KEY `Calificaciones_Id_Calificaciones` (`Calificaciones_Id_Calificaciones`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`Id_ReportE`, `Calificaciones_Id_Calificaciones`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportp`
--

DROP TABLE IF EXISTS `reportp`;
CREATE TABLE IF NOT EXISTS `reportp` (
  `Id_ReportP` int NOT NULL AUTO_INCREMENT,
  `Profesores_Id_Profesores` int DEFAULT NULL,
  `Cursos_Id_Cursos` int DEFAULT NULL,
  PRIMARY KEY (`Id_ReportP`),
  KEY `Profesores_Id_Profesores` (`Profesores_Id_Profesores`),
  KEY `Cursos_Id_Cursos` (`Cursos_Id_Cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportp`
--

INSERT INTO `reportp` (`Id_ReportP`, `Profesores_Id_Profesores`, `Cursos_Id_Cursos`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `Id_Roles` int NOT NULL AUTO_INCREMENT,
  `Nombre_Roles` varchar(45) NOT NULL,
  `Permisos_Roles` text,
  PRIMARY KEY (`Id_Roles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Roles`, `Nombre_Roles`, `Permisos_Roles`) VALUES
(1, 'Administrador', 'Acceso total al sistema'),
(2, 'Profesor', 'Acceso a sus cursos y reportes'),
(3, 'Estudiante', 'Acceso a calificaciones y asistencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_Usuarios` int NOT NULL AUTO_INCREMENT,
  `Nombre_Usuarios` varchar(45) NOT NULL,
  `Contrasena_Usuarios` varchar(45) NOT NULL,
  `Roles_Id_Roles` int DEFAULT NULL,
  `Estudiantes_Id` int DEFAULT NULL,
  PRIMARY KEY (`Id_Usuarios`),
  KEY `Roles_Id_Roles` (`Roles_Id_Roles`),
  KEY `fk_estudiantes_usuarios` (`Estudiantes_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuarios`, `Nombre_Usuarios`, `Contrasena_Usuarios`, `Roles_Id_Roles`, `Estudiantes_Id`) VALUES
(1, 'Juan Perez', 'pass1234', 1, NULL),
(2, 'Ana Torres', '1234pass', 2, NULL),
(3, 'Luis Martinez', 'qwerty', 3, NULL),
(4, 'admin', 'admin', 1, NULL),
(5, 'Carlos', 'Carlos', 3, 1),
(6, 'profe', 'profe', 2, NULL),
(7, 'Lucia', 'Lucia', 3, 2),
(8, 'josue', 'josue', 3, 18);

-- --------------------------------------------------------

--
-- Estructura para la vista `cargaacademicaprofesores`
--
DROP TABLE IF EXISTS `cargaacademicaprofesores`;

DROP VIEW IF EXISTS `cargaacademicaprofesores`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cargaacademicaprofesores`  AS SELECT `p`.`Id_Profesores` AS `Id_profesores`, `p`.`Nombre_Profesores` AS `nombre_profesores`, `p`.`Apellido_Profesores` AS `apellido_profesores`, `c`.`Nombre_Cursos` AS `nombre_cursos`, `c`.`Creditos` AS `creditos` FROM ((`profesores` `p` join `profesores_cursos` `pc` on((`p`.`Id_Profesores` = `pc`.`Profesores_Id_Profesores`))) join `cursos` `c` on((`pc`.`Cursos_Id_Cursos` = `c`.`Id_Cursos`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `historialacademico`
--
DROP TABLE IF EXISTS `historialacademico`;

DROP VIEW IF EXISTS `historialacademico`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `historialacademico`  AS SELECT `e`.`Id_Estudiantes` AS `Id_estudiantes`, `e`.`Nombre_Estudiantes` AS `nombre_estudiantes`, `e`.`Apellido_Estudiantes` AS `apellido_estudiantes`, `c`.`Nombre_Cursos` AS `nombre_cursos`, `cal`.`Calificacion` AS `calificacion`, `cal`.`Fecha_Calificaciones` AS `fecha_calificaciones` FROM ((`estudiantes` `e` join `calificaciones` `cal` on((`e`.`Id_Estudiantes` = `cal`.`Estudiantes_Id_Estudiantes`))) join `cursos` `c` on((`cal`.`Cursos_Id_Cursos` = `c`.`Id_Cursos`))) ORDER BY `e`.`Id_Estudiantes` ASC, `c`.`Nombre_Cursos` ASC, `cal`.`Fecha_Calificaciones` ASC ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`Estudiantes_Id_Estudiantes`) REFERENCES `estudiantes` (`Id_Estudiantes`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`Cursos_Id_Cursos`) REFERENCES `cursos` (`Id_Cursos`);

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`Estudiantes_Id_Estudiantes`) REFERENCES `estudiantes` (`Id_Estudiantes`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`Cursos_Id_Cursos`) REFERENCES `cursos` (`Id_Cursos`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`Roles_Id_Roles`) REFERENCES `roles` (`Id_Roles`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`Roles_Id_Roles`) REFERENCES `roles` (`Id_Roles`);

--
-- Filtros para la tabla `profesores_cursos`
--
ALTER TABLE `profesores_cursos`
  ADD CONSTRAINT `profesores_cursos_ibfk_1` FOREIGN KEY (`Profesores_Id_Profesores`) REFERENCES `profesores` (`Id_Profesores`),
  ADD CONSTRAINT `profesores_cursos_ibfk_2` FOREIGN KEY (`Cursos_Id_Cursos`) REFERENCES `cursos` (`Id_Cursos`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`Calificaciones_Id_Calificaciones`) REFERENCES `calificaciones` (`Id_Calificaciones`);

--
-- Filtros para la tabla `reportp`
--
ALTER TABLE `reportp`
  ADD CONSTRAINT `reportp_ibfk_1` FOREIGN KEY (`Profesores_Id_Profesores`) REFERENCES `profesores` (`Id_Profesores`),
  ADD CONSTRAINT `reportp_ibfk_2` FOREIGN KEY (`Cursos_Id_Cursos`) REFERENCES `cursos` (`Id_Cursos`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_estudiantes_usuarios` FOREIGN KEY (`Estudiantes_Id`) REFERENCES `estudiantes` (`Id_Estudiantes`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Roles_Id_Roles`) REFERENCES `roles` (`Id_Roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
