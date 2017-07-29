-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-07-2017 a las 16:28:45
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vos_andes`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarBiometria` (IN `_hematies` VARCHAR(10), IN `_hematocrito` VARCHAR(10), IN `_hemoglobina` VARCHAR(10), IN `_leucocitos` VARCHAR(10), IN `_vsg` VARCHAR(10), IN `_vcm` VARCHAR(10), IN `_hbcm` VARCHAR(10), IN `_chbcm` VARCHAR(10), IN `_comentario_hema` VARCHAR(400), IN `_cayados` VARCHAR(10), IN `_neutrofilos` VARCHAR(10), IN `_basofilo` VARCHAR(10), IN `_eosinofilo` VARCHAR(10), IN `_linfocito` VARCHAR(10), IN `_monocito` VARCHAR(10), IN `_prolinfocito` VARCHAR(10), IN `_cel_inmaduras` VARCHAR(10), IN `_comentario_leuco` VARCHAR(400))  BEGIN
		INSERT INTO biometria(hematies, hematocrito, hemoglobina, leucocitos, vsg, vcm, hbcm, chbcm, comentario_hema, cayados, neutrofilos, basofilo, eosinofilo, linfocito, monocito, prolinfocito, cel_inmaduras, comentario_leuco) 
		VALUES(_hematies, _hematocrito, _hemoglobina, _leucocitos, _vsg, _vcm, _hbcm, _chbcm, _comentario_hema, _cayados, _neutrofilos, _basofilo, _eosinofilo, _linfocito, _monocito, _prolinfocito, _cel_inmaduras, _comentario_leuco);
		SELECT @@identity AS respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamenGeneral` (IN `_color` VARCHAR(10), IN `_cantidad` VARCHAR(10), IN `_olor` VARCHAR(10), IN `_aspecto` VARCHAR(10), IN `_espuma` VARCHAR(10), IN `_sedimento` VARCHAR(10), IN `_densidad` VARCHAR(10), IN `_reaccion` VARCHAR(10), IN `_proteinas` VARCHAR(10), IN `_glucosa` VARCHAR(10), IN `_cetona` VARCHAR(10), IN `_bilirrubina` VARCHAR(10), IN `_sangre` VARCHAR(10), IN `_nitritos` VARCHAR(10), IN `_urubilinogeno` VARCHAR(10), IN `_eritrocitos` VARCHAR(10), IN `_piocitos` VARCHAR(10), IN `_leucocitos` VARCHAR(10), IN `_cilindros` VARCHAR(10), IN `_celulas` VARCHAR(10), IN `_cristales` VARCHAR(10), IN `_otros` VARCHAR(200), IN `_exa_bac_sed` VARCHAR(200))  BEGIN
		INSERT INTO examen_general(color, cantidad, olor, aspecto, espuma, sedimento, densidad, reaccion, proteinas, glucosa, cetona, bilirrubina, sangre, nitritos, urubilinogeno, eritrocitos, piocitos, leucocitos, cilindros, celulas, cristales, otros, exa_bac_sed) VALUES(_color, _cantidad, _olor, _aspecto, _espuma, _sedimento, _densidad, _reaccion, _proteinas, _glucosa, _cetona, _bilirrubina, _sangre, _nitritos, _urubilinogeno, _eritrocitos, _piocitos, _leucocitos, _cilindros, _celulas, _cristales, _otros, _exa_bac_sed);
		SELECT @@identity AS respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarInformeG` (IN `_nombre` VARCHAR(100), IN `_contenido` VARCHAR(400))  BEGIN
	INSERT INTO informes_g(nombre, contenido)VALUES(_nombre, _contenido);
    SELECT @@identity AS respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPaciente` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75), IN `_edad` VARCHAR(3), IN `_sexo` CHAR(1))  BEGIN
	INSERT INTO paciente(nombre, apellidos, edad, sexo) VALUES(_nombre, _apellidos, _edad, _sexo);
    SELECT 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarTipo` (IN `_tipo` VARCHAR(50), IN `_id_examen` INT, IN `_id_tipo` INT)  BEGIN
	IF(SELECT EXISTS(SELECT * FROM examen WHERE id = _id_examen))THEN
		INSERT INTO examen_tipo(tipo, id_examen, id_tipo) VALUES(_tipo, _id_examen, _id_tipo);
        SELECT 1 AS respuesta;
    ELSE
		SELECT 0 AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `_nombre` VARCHAR(50), IN `_user` VARCHAR(50), IN `_password` VARCHAR(50))  BEGIN
	IF(SELECT EXISTS(SELECT * FROM usuario WHERE user = _user))THEN
		SELECT 0 AS respuesta;
    ELSE
        INSERT INTO usuario(nombre, user,password, fecha) VALUES(_nombre, _user, _password,NOW());
        SELECT 1 AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamen` (IN `_id_medico` INT, IN `_id_paciente` INT)  BEGIN
DECLARE _id_examen INT;
	    IF (SELECT EXISTS (SELECT * FROM medico WHERE id = _id_medico))THEN 
        	IF ( SELECT EXISTS (SELECT * FROM examen WHERE id_medico = _id_medico AND id_paciente = _id_paciente AND date(fecha) = curdate() ))THEN 
				SET _id_examen = (SELECT id FROM examen WHERE id_medico = _id_medico AND id_paciente = _id_paciente AND  date(fecha) = curdate()  );
                SELECT _id_examen as respuesta;
			ELSE
				INSERT INTO examen(id_medico, id_paciente) VALUES(_id_medico, _id_paciente);
				SET _id_examen = (SELECT @@identity AS id);
				SELECT _id_examen as respuesta;
            END IF;    
   			ELSE
                SELECT 0 as respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarReaccionW` (IN `_paraA1` VARCHAR(5), IN `_paraA2` VARCHAR(5), IN `_paraA3` VARCHAR(5), IN `_paraA4` VARCHAR(5), IN `_paraA5` VARCHAR(5), IN `_paraA6` VARCHAR(5), IN `_paraB1` VARCHAR(5), IN `_paraB2` VARCHAR(5), IN `_paraB3` VARCHAR(5), IN `_paraB4` VARCHAR(5), IN `_paraB5` VARCHAR(5), IN `_paraB6` VARCHAR(5), IN `_somaticoO1` VARCHAR(5), IN `_somaticoO2` VARCHAR(5), IN `_somaticoO3` VARCHAR(5), IN `_somaticoO4` VARCHAR(5), IN `_somaticoO5` VARCHAR(5), IN `_somaticoO6` VARCHAR(5), IN `_flagelarH1` VARCHAR(5), IN `_flagelarH2` VARCHAR(5), IN `_flagelarH3` VARCHAR(5), IN `_flagelarH4` VARCHAR(5), IN `_flagelarH5` VARCHAR(5), IN `_flagelarH6` VARCHAR(5), IN `_comentario` VARCHAR(300))  BEGIN
		INSERT INTO reaccion_w(paraA1, paraA2, paraA3, paraA4, paraA5, paraA6, paraB1, paraB2, paraB3, paraB4, paraB5, paraB6, somaticoO1, somaticoO2, somaticoO3, somaticoO4, somaticoO5, somaticoO6, flagelarH1, flagelarH2, flagelarH3, flagelarH4, flagelarH5, flagelarH6,comentario) 
		VALUES (_paraA1, _paraA2, _paraA3, _paraA4, _paraA5, _paraA6, _paraB1, _paraB2, _paraB3, _paraB4, _paraB5, _paraB6, _somaticoO1, _somaticoO2, _somaticoO3, _somaticoO4, _somaticoO5, _somaticoO6, _flagelarH1, _flagelarH2, _flagelarH3, _flagelarH4, _flagelarH5, _flagelarH6,_comentario);
		SELECT @@identity AS respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenes` ()  BEGIN
	SELECT e.id, e.tipo_examen, p.nombre AS NombrePac, p.apellidos AS ApellidosPac, m.nombre AS NombreMed, m.apellidos AS ApellidosMed, e.fecha FROM examen e
    INNER JOIN medico m ON m.id=e.id_medico INNER JOIN paciente p ON p.id=e.id_paciente ORDER BY e.fecha DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenesPac` (IN `_id_examen` INT)  BEGIN
	IF(SELECT EXISTS(SELECT * FROM examen_tipo WHERE id_examen = _id_examen))THEN
		SELECT * FROM examen_tipo WHERE id_examen = _id_examen;
    ELSE
		SELECT 0 AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenPaciente` (IN `idin` INT)  BEGIN
	IF(SELECT EXISTS(	SELECT et.tipo as tipo, m.nombre as nombreMed, m.apellidos as apellidosMed, et.id_tipo as id_tipo, e.fecha as fecha   FROM examen_tipo et inner join examen e on et.id_examen = e.id 
						      inner join medico m on m.id = e.id_medico
 WHERE e.id_paciente  = idin))THEN
	SELECT et.tipo as tipo, m.nombre as nombreMed, m.apellidos as apellidosMed, et.id_tipo as id_tipo, date_format(e.fecha, '%d/%m/%y') as fecha   FROM examen_tipo et inner join examen e on et.id_examen = e.id 
						      inner join medico m on m.id = e.id_medico
 WHERE e.id_paciente  = idin ORDER BY e.fecha DESC;
    ELSE
		SELECT 0 AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listExa` ()  BEGIN
	IF(SELECT EXISTS(SELECT * FROM examen_tipo))THEN
    SELECT et.tipo as tipo, m.nombre as nombreMed, m.apellidos as apellidosMed, et.id_tipo as id_tipo, date_format(e.fecha, '%d/%m/%y') as fecha, p.nombre as nombrePaciente, p.apellidos as apellidosPaciente, p.id as id_paciente   FROM examen_tipo et inner join examen e on et.id_examen = e.id 
						      inner join medico m on m.id = e.id_medico 
                              inner join paciente p on e.id_paciente = p.id; 
	ELSE
		SELECT 0 AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `_user` VARCHAR(50), IN `_password` VARCHAR(50))  BEGIN
	IF(SELECT EXISTS(SELECT * FROM usuario WHERE user = _user AND password = _password))THEN
        SELECT * FROM usuario WHERE user = _user AND password = _password;
    ELSE
		SELECT 0 AS respuesta;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biometria`
--

CREATE TABLE `biometria` (
  `id` int(11) NOT NULL,
  `hematies` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `hematocrito` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `hemoglobina` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `leucocitos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `vsg` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `vcm` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `hbcm` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `chbcm` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario_hema` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `cayados` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `neutrofilos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `basofilo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `eosinofilo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `linfocito` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `monocito` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `prolinfocito` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cel_inmaduras` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario_leuco` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `biometria`
--

INSERT INTO `biometria` (`id`, `hematies`, `hematocrito`, `hemoglobina`, `leucocitos`, `vsg`, `vcm`, `hbcm`, `chbcm`, `comentario_hema`, `cayados`, `neutrofilos`, `basofilo`, `eosinofilo`, `linfocito`, `monocito`, `prolinfocito`, `cel_inmaduras`, `comentario_leuco`) VALUES
(16, '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6'),
(17, '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_medico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `fecha`, `id_medico`, `id_paciente`) VALUES
(46, '2017-07-29 06:14:11', 11, 29),
(47, '2017-07-29 06:33:11', 10, 28),
(48, '2017-07-29 06:36:42', 10, 29),
(49, '2017-07-29 06:43:33', 11, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_general`
--

CREATE TABLE `examen_general` (
  `id` int(11) NOT NULL,
  `color` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `olor` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `aspecto` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `espuma` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `sedimento` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `densidad` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `reaccion` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `proteinas` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `glucosa` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cetona` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `bilirrubina` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `sangre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `nitritos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `urubilinogeno` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `eritrocitos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `piocitos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `leucocitos` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cilindros` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `celulas` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `cristales` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `otros` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `exa_bac_sed` varchar(350) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen_general`
--

INSERT INTO `examen_general` (`id`, `color`, `cantidad`, `olor`, `aspecto`, `espuma`, `sedimento`, `densidad`, `reaccion`, `proteinas`, `glucosa`, `cetona`, `bilirrubina`, `sangre`, `nitritos`, `urubilinogeno`, `eritrocitos`, `piocitos`, `leucocitos`, `cilindros`, `celulas`, `cristales`, `otros`, `exa_bac_sed`) VALUES
(18, '1', '2', '3', '4', '5', '6', '7', '8', '9', '6', '7', '5', '4', '2', '4', '8', '5', '6', '5', '6', '5', 'Este es un comentario genial', 'Este es otro comentario genial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_tipo`
--

CREATE TABLE `examen_tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen_tipo`
--

INSERT INTO `examen_tipo` (`id`, `tipo`, `id_examen`, `id_tipo`) VALUES
(98, 'Reaccion de Widal', 46, 8),
(99, 'Informe de Parasitologia', 47, 144),
(100, 'Analisis General', 48, 18),
(101, 'Biometria Hematica', 48, 16),
(102, 'Informe de Parasitologia', 47, 145),
(103, 'Biometria Hematica', 49, 17),
(104, 'Informe de Quimica Sanguinea', 48, 146),
(105, 'Informe General', 46, 147),
(106, 'informe de Microbiologia', 46, 148);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_g`
--

CREATE TABLE `informes_g` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` varchar(400) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `informes_g`
--

INSERT INTO `informes_g` (`id`, `nombre`, `contenido`) VALUES
(143, 'Informe de Quimica Sanguinea', 'Quimica Sanguinea'),
(144, 'Informe de Parasitologia', 'Parasitologia'),
(145, 'Informe de Parasitologia', 'asdfasdfasdfasdfasdf'),
(146, 'Informe de Quimica Sanguinea', 'quimica sanguinea'),
(147, 'Informe General', 'informe\notra linea'),
(148, 'informe de Microbiologia', 'asfasdfa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id`, `nombre`, `apellidos`) VALUES
(10, 'Erwin', 'Mendez'),
(11, 'Harold', 'Castillo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `apellidos`, `edad`, `sexo`, `estado`) VALUES
(28, 'Benjamin', 'Castillo Eguez', '2 meses', 'M', '1'),
(29, 'Diego', 'Escalante Antezana', '23 años', 'M', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion_w`
--

CREATE TABLE `reaccion_w` (
  `id` int(11) NOT NULL,
  `paraA1` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA2` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA3` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA4` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA5` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA6` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB1` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB2` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB3` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB4` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB5` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB6` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO1` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO2` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO3` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO4` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO5` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO6` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH1` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH2` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH3` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH4` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH5` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH6` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reaccion_w`
--

INSERT INTO `reaccion_w` (`id`, `paraA1`, `paraA2`, `paraA3`, `paraA4`, `paraA5`, `paraA6`, `paraB1`, `paraB2`, `paraB3`, `paraB4`, `paraB5`, `paraB6`, `somaticoO1`, `somaticoO2`, `somaticoO3`, `somaticoO4`, `somaticoO5`, `somaticoO6`, `flagelarH1`, `flagelarH2`, `flagelarH3`, `flagelarH4`, `flagelarH5`, `flagelarH6`, `comentario`) VALUES
(8, '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', 'asdfasdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `user`, `password`, `fecha`) VALUES
(4, 'Benjamin Castillo Eguez', 'benji', '1234', '2017-07-05 00:00:00'),
(5, 'Diego Escalante Antezana', 'Diego', '12345', '2017-07-27 23:41:08'),
(6, 'Benjamin Castillo', 'benji2', '1234', '2017-07-27 23:50:34'),
(7, 'Harold Castillo Eguez', 'harold', '1234', '2017-07-27 23:54:54'),
(8, 'Harold Castillo Eguez', 'harold2', '1234', '2017-07-28 00:14:14'),
(9, 'Erwin Mendez Mejia', 'pollo', '1234', '2017-07-28 11:37:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biometria`
--
ALTER TABLE `biometria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_general`
--
ALTER TABLE `examen_general`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_tipo`
--
ALTER TABLE `examen_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informes_g`
--
ALTER TABLE `informes_g`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reaccion_w`
--
ALTER TABLE `reaccion_w`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biometria`
--
ALTER TABLE `biometria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `examen_general`
--
ALTER TABLE `examen_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `examen_tipo`
--
ALTER TABLE `examen_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT de la tabla `informes_g`
--
ALTER TABLE `informes_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `reaccion_w`
--
ALTER TABLE `reaccion_w`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
