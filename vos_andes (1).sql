-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2017 a las 17:52:45
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarBiometria` (IN `_hematies` VARCHAR(10), IN `_hematocrito` VARCHAR(10), IN `_hemoglobina` VARCHAR(10), IN `_leucocitos` VARCHAR(10), IN `_vsg` VARCHAR(10), IN `_vcm` VARCHAR(10), IN `_hbcm` VARCHAR(10), IN `_chbcm` VARCHAR(10), IN `_comentario_hema` VARCHAR(10), IN `_cayados` VARCHAR(10), IN `_neutrofilos` VARCHAR(10), IN `_basofilo` VARCHAR(10), IN `_eosinofilo` VARCHAR(10), IN `_linfocito` VARCHAR(10), IN `_monocito` VARCHAR(10), IN `_prolinfocito` VARCHAR(10), IN `_cel_inmaduras` VARCHAR(10), IN `_comentario_leuco` VARCHAR(10), IN `_id_examen` INT)  BEGIN
	IF ( SELECT EXISTS (SELECT * FROM examen WHERE id = _id_examen))THEN 
		INSERT INTO biometria(hematies, hematocrito, hemoglobina, leucocitos, vsg, vcm, hbcm, chbcm, comentario_hema, cayados, neutrofilos, basofilo, eosinofilo, linfocito, monocito, prolinfocito, cel_inmaduras, comentario_leuco, id_examen) 
		VALUES(_hematies, _hematocrito, _hemoglobina, _leucocitos, _vsg, _vcm, _hbcm, _chbcm, _comentario_hema, _cayados, _neutrofilos, _basofilo, _eosinofilo, _linfocito, _monocito, _prolinfocito, _cel_inmaduras, _comentario_leuco, _id_examen);
		SELECT 1 AS respuesta;
    ELSE
		SELECT 0 AS respuesta;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamen` (IN `_tipo_examen` VARCHAR(25), IN `_id_medico` INT, IN `_id_paciente` INT)  BEGIN
DECLARE _id_examen INT;
	    IF ( SELECT EXISTS (SELECT * FROM medico WHERE id = _id_medico))THEN 
        	IF ( SELECT EXISTS (SELECT * FROM paciente WHERE id = _id_paciente))THEN 
				INSERT INTO examen(tipo_examen, id_medico, id_paciente) VALUES(_tipo_examen, _id_medico, _id_paciente);
                SET _id_examen = (SELECT @@identity AS id);
                SELECT _id_examen as respuesta;
   			ELSE
                SELECT 0 as respuesta;
            END IF;
		ELSE
			SELECT 2;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamenGeneral` (IN `_color` VARCHAR(10), IN `_cantidad` VARCHAR(10), IN `_olor` VARCHAR(10), IN `_aspecto` VARCHAR(10), IN `_espuma` VARCHAR(10), IN `_sedimento` VARCHAR(10), IN `_densidad` VARCHAR(10), IN `_reaccion` VARCHAR(10), IN `_proteinas` VARCHAR(10), IN `_glucosa` VARCHAR(10), IN `_cetona` VARCHAR(10), IN `_bilirrubina` VARCHAR(10), IN `_sangre` VARCHAR(10), IN `_nitritos` VARCHAR(10), IN `_urubilinogeno` VARCHAR(10), IN `_eritrocitos` VARCHAR(10), IN `_piocitos` VARCHAR(10), IN `_leucocitos` VARCHAR(10), IN `_cilindros` VARCHAR(10), IN `_celulas` VARCHAR(10), IN `_cristales` VARCHAR(10), IN `_otros` VARCHAR(10), IN `_exa_bac_sed` VARCHAR(10), IN `_id_examen` INT)  BEGIN
	IF ( SELECT EXISTS (SELECT * FROM examen WHERE id = _id_examen))THEN 
		INSERT INTO examen_general(color, cantidad, olor, aspecto, espuma, sedimento, densidad, reaccion, proteinas, glucosa, cetona, bilirrubina, sangre, nitritos, urubilinogeno, eritrocitos, piocitos, leucocitos, cilindros, celulas, cristales, otros, exa_bac_sed, id_examen) VALUES(_color, _cantidad, _olor, _aspecto, _espuma, _sedimento, _densidad, _reaccion, _proteinas, _glucosa, _cetona, _bilirrubina, _sangre, _nitritos, _urubilinogeno, _eritrocitos, _piocitos, _leucocitos, _cilindros, _celulas, _cristales, _otros, _exa_bac_sed, _id_examen);
		SELECT 1 as respuesta;
	ELSE
		SELECT 0 AS respuesta;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPaciente` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75), IN `_edad` VARCHAR(3), IN `_sexo` CHAR(1))  BEGIN
	INSERT INTO paciente(nombre, apellidos, edad, sexo) VALUES(_nombre, _apellidos, _edad, _sexo);
    SELECT 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenes` ()  BEGIN
	SELECT e.id, e.tipo_examen, p.nombre AS NombrePac, p.apellidos AS ApellidosPac, m.nombre AS NombreMed, m.apellidos AS ApellidosMed, e.fecha FROM examen e
    INNER JOIN medico m ON m.id=e.id_medico INNER JOIN paciente p ON p.id=e.id_paciente ORDER BY e.fecha DESC;
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
  `comentario_leuco` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `biometria`
--

INSERT INTO `biometria` (`id`, `hematies`, `hematocrito`, `hemoglobina`, `leucocitos`, `vsg`, `vcm`, `hbcm`, `chbcm`, `comentario_hema`, `cayados`, `neutrofilos`, `basofilo`, `eosinofilo`, `linfocito`, `monocito`, `prolinfocito`, `cel_inmaduras`, `comentario_leuco`, `id_examen`) VALUES
(1, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5),
(2, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 5),
(3, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5),
(4, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5),
(5, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5),
(6, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5),
(7, 'poi', 'qwe', 'qwe', 'qwe', 'sdf', 'sdg', 'xc', 'df', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'dfg', 'asd', 'zxc', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `tipo_examen` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_medico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `tipo_examen`, `fecha`, `id_medico`, `id_paciente`) VALUES
(1, 'Examen general', '2017-06-13 06:05:14', 2, 2),
(2, 'Biometrica', '2017-06-13 06:58:56', 2, 17),
(3, 'Biometrica', '2017-06-13 06:59:00', 2, 17),
(4, 'Biometrica', '2017-06-13 06:59:01', 2, 17),
(5, 'Biometría', '2017-06-13 15:14:27', 2, 2);

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
  `exa_bac_sed` varchar(350) COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen_general`
--

INSERT INTO `examen_general` (`id`, `color`, `cantidad`, `olor`, `aspecto`, `espuma`, `sedimento`, `densidad`, `reaccion`, `proteinas`, `glucosa`, `cetona`, `bilirrubina`, `sangre`, `nitritos`, `urubilinogeno`, `eritrocitos`, `piocitos`, `leucocitos`, `cilindros`, `celulas`, `cristales`, `otros`, `exa_bac_sed`, `id_examen`) VALUES
(1, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 1),
(2, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'as', 'dasd', 'as', 'da', 'sdas', 'das', 'd', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes-g`
--

CREATE TABLE `informes-g` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(2, 'Laura', 'Risueno'),
(4, 'Kaya', 'Negron');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` varchar(3) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `apellidos`, `edad`, `sexo`, `estado`) VALUES
(2, 'Soledad Nina', 'Huanca', '50', 'F', '1'),
(12, 'Diego', 'Escalante Antezana', '22', 'M', '1'),
(13, 'Andrian', 'Catalan', '41', 'M', '1'),
(17, 'Harold', 'Castillo Eguez', '33', 'M', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion-w`
--

CREATE TABLE `reaccion-w` (
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
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
-- Indices de la tabla `informes-g`
--
ALTER TABLE `informes-g`
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
-- Indices de la tabla `reaccion-w`
--
ALTER TABLE `reaccion-w`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biometria`
--
ALTER TABLE `biometria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `examen_general`
--
ALTER TABLE `examen_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `informes-g`
--
ALTER TABLE `informes-g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `reaccion-w`
--
ALTER TABLE `reaccion-w`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
