-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-01-2018 a las 23:58:27
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarBiometria` (IN `_hematies` VARCHAR(15), IN `_hematocrito` VARCHAR(15), IN `_hemoglobina` VARCHAR(15), IN `_leucocitos` VARCHAR(15), IN `_vsg` VARCHAR(15), IN `_vcm` VARCHAR(15), IN `_hbcm` VARCHAR(15), IN `_chbcm` VARCHAR(15), IN `_comentario_hema` TEXT, IN `_cayados` VARCHAR(15), IN `_neutrofilos` VARCHAR(15), IN `_basofilo` VARCHAR(15), IN `_eosinofilo` VARCHAR(15), IN `_linfocito` VARCHAR(15), IN `_monocito` VARCHAR(15), IN `_prolinfocito` VARCHAR(15), IN `_cel_inmaduras` VARCHAR(15), IN `_comentario_leuco` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM biometria WHERE id_examen = _id_examen))THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta;
ELSE
	INSERT INTO biometria(hematies, hematocrito, hemoglobina, leucocitos, vsg, vcm, hbcm, chbcm, comentario_hema, cayados, neutrofilos, basofilo, eosinofilo, linfocito, monocito, prolinfocito, cel_inmaduras, comentario_leuco, id_examen) 
	VALUES(_hematies, _hematocrito, _hemoglobina, _leucocitos, _vsg, _vcm, _hbcm, _chbcm, _comentario_hema, _cayados, _neutrofilos, _basofilo, _eosinofilo, _linfocito, _monocito, _prolinfocito, _cel_inmaduras, _comentario_leuco, _id_examen);
	SELECT false as error, id FROM biometria WHERE id_examen=_id_examen;
END IF;		
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarDoctor` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75))  BEGIN
	INSERT INTO medico(nombre, apellidos) VALUES(_nombre, _apellidos);
    SELECT false as error, 'Médico insertado correctamente' as respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamen` (IN `_id_medico` INT, IN `_id_paciente` INT)  BEGIN
DECLARE _current_date TIMESTAMP(6);
	IF (SELECT EXISTS (SELECT * FROM medico WHERE id = _id_medico))THEN 
		IF ( SELECT EXISTS (SELECT * FROM paciente WHERE id = _id_paciente))THEN 
			SET _current_date = (SELECT sysdate(6));
            INSERT INTO examen(fecha, id_medico, id_paciente) VALUES(_current_date, _id_medico, _id_paciente);
			SELECT id from examen WHERE id_medico = _id_medico AND id_paciente = _id_paciente AND fecha = _current_date;
		ELSE
			SELECT true AS error, 'El paciente no existe' AS respuesta;
		END IF;    
	ELSE
		SELECT true AS error, 'El medico no existe' AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarExamenGeneral` (IN `_color` VARCHAR(10), IN `_cantidad` VARCHAR(10), IN `_olor` VARCHAR(10), IN `_aspecto` VARCHAR(10), IN `_espuma` VARCHAR(10), IN `_sedimento` VARCHAR(10), IN `_densidad` VARCHAR(10), IN `_reaccion` VARCHAR(10), IN `_proteinas` VARCHAR(10), IN `_glucosa` VARCHAR(10), IN `_cetona` VARCHAR(10), IN `_bilirrubina` VARCHAR(10), IN `_sangre` VARCHAR(10), IN `_nitritos` VARCHAR(10), IN `_urubilinogeno` VARCHAR(10), IN `_eritrocitos` VARCHAR(10), IN `_piocitos` VARCHAR(10), IN `_leucocitos` VARCHAR(10), IN `_cilindros` VARCHAR(10), IN `_celulas` VARCHAR(10), IN `_cristales` VARCHAR(10), IN `_otros` VARCHAR(200), IN `_exa_bac_sed` VARCHAR(200), IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM examen_general WHERE id_examen = _id_examen)) THEN
	SELECT true as error, 'El examen ya fué insertado' AS respuesta;
ELSE
	INSERT INTO examen_general(color, cantidad, olor, aspecto, espuma, sedimento, densidad, reaccion, proteinas, glucosa, cetona, bilirrubina, sangre, nitritos, urubilinogeno, eritrocitos, piocitos, leucocitos, cilindros, celulas, cristales, otros, exa_bac_sed, id_examen) VALUES(_color, _cantidad, _olor, _aspecto, _espuma, _sedimento, _densidad, _reaccion, _proteinas, _glucosa, _cetona, _bilirrubina, _sangre, _nitritos, _urubilinogeno, _eritrocitos, _piocitos, _leucocitos, _cilindros, _celulas, _cristales, _otros, _exa_bac_sed, _id_examen);
	SELECT false as error, id FROM examen_general WHERE id_examen = _id_examen;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarInformeG` (IN `_nombre` VARCHAR(100), IN `_contenido` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM informes_g WHERE id_examen = _id_examen)) THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta; 
ELSE
	INSERT INTO informes_g(nombre, contenido, id_examen)VALUES(_nombre, _contenido, _id_examen);
    SELECT false as error, id FROM informes_g WHERE id_examen = _id_examen;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPaciente` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75), IN `_edad` VARCHAR(15), IN `_sexo` CHAR(1))  BEGIN
	INSERT INTO paciente(nombre, apellidos, edad, sexo) VALUES(_nombre, _apellidos, _edad, _sexo);
    SELECT false as error, 'Paciente insertado correctamente' as respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarReaccionW` (IN `_paraA1` VARCHAR(15), IN `_paraA2` VARCHAR(15), IN `_paraA3` VARCHAR(15), IN `_paraA4` VARCHAR(15), IN `_paraA5` VARCHAR(15), IN `_paraA6` VARCHAR(15), IN `_paraB1` VARCHAR(15), IN `_paraB2` VARCHAR(15), IN `_paraB3` VARCHAR(15), IN `_paraB4` VARCHAR(15), IN `_paraB5` VARCHAR(15), IN `_paraB6` VARCHAR(15), IN `_somaticoO1` VARCHAR(15), IN `_somaticoO2` VARCHAR(15), IN `_somaticoO3` VARCHAR(15), IN `_somaticoO4` VARCHAR(15), IN `_somaticoO5` VARCHAR(15), IN `_somaticoO6` VARCHAR(15), IN `_flagelarH1` VARCHAR(15), IN `_flagelarH2` VARCHAR(15), IN `_flagelarH3` VARCHAR(15), IN `_flagelarH4` VARCHAR(15), IN `_flagelarH5` VARCHAR(15), IN `_flagelarH6` VARCHAR(15), IN `_comentario` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM reaccion_w WHERE id_examen = _id_examen))THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta;
ELSE
	INSERT INTO reaccion_w(paraA1, paraA2, paraA3, paraA4, paraA5, paraA6, paraB1, paraB2, paraB3, paraB4, paraB5, paraB6, somaticoO1, somaticoO2, somaticoO3, somaticoO4, somaticoO5, somaticoO6, flagelarH1, flagelarH2, flagelarH3, flagelarH4, flagelarH5, flagelarH6,comentario,id_examen) 
	VALUES (_paraA1, _paraA2, _paraA3, _paraA4, _paraA5, _paraA6, _paraB1, _paraB2, _paraB3, _paraB4, _paraB5, _paraB6, _somaticoO1, _somaticoO2, _somaticoO3, _somaticoO4, _somaticoO5, _somaticoO6, _flagelarH1, _flagelarH2, _flagelarH3, _flagelarH4, _flagelarH5, _flagelarH6,_comentario,_id_examen);
	SELECT false as error, id FROM reaccion_w WHERE id_examen = _id_examen;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarUser` (IN `_nombre` VARCHAR(50), IN `_user` VARCHAR(50), IN `_password` VARCHAR(50))  BEGIN
	IF(SELECT EXISTS(SELECT * FROM usuario WHERE user = _user))THEN
		SELECT true as error, 'El nombre de usuario ya existe' AS respuesta;
    ELSE
        INSERT INTO usuario(nombre, user, password, fecha) VALUES(_nombre, _user, _password, NOW());
        SELECT 'Usuario creado' AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDcotor` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75))  BEGIN
	INSERT INTO medico(nombre, apellidos) VALUES(_nombre, _apellidos);
    SELECT false as error, 'Médico insertado correctamente' as respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `_nombre` VARCHAR(50), IN `_user` VARCHAR(50), IN `_password` VARCHAR(50))  BEGIN
	IF(SELECT EXISTS(SELECT * FROM usuario WHERE user = _user))THEN
		SELECT true as error, 'El nombre de usuario ya existe' AS respuesta;
    ELSE
        INSERT INTO usuario(nombre, user, password, fecha) VALUES(_nombre, _user, _password, NOW());
        SELECT 'Usuario creado' AS respuesta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenes` (`_id_paciente` INT)  BEGIN
IF (SELECT EXISTS (SELECT * FROM examen WHERE id_paciente = _id_paciente))THEN
	SELECT e.id, p.nombre AS NombrePac, p.apellidos AS ApellidosPac, m.nombre AS NombreMed, m.apellidos AS ApellidosMed, e.fecha FROM examen e
    INNER JOIN medico m ON m.id=e.id_medico INNER JOIN paciente p ON p.id=e.id_paciente WHERE id_paciente = _id_paciente ORDER BY e.fecha DESC;
ELSE
	SELECT true AS error, 'El paciente no tiene exámenes' AS respuesta;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `_user` VARCHAR(50), IN `_password` VARCHAR(50))  BEGIN
	IF(SELECT EXISTS(SELECT * FROM usuario WHERE user = _user AND password = _password))THEN
        SELECT * FROM usuario WHERE user = _user AND password = _password;
    ELSE
		SELECT true as error, 'Credenciales incorrectas' AS respuesta;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biometria`
--

CREATE TABLE `biometria` (
  `id` int(11) NOT NULL,
  `hematies` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `hematocrito` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `hemoglobina` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `leucocitos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `vsg` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `vcm` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `hbcm` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `chbcm` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario_hema` text COLLATE utf8_spanish2_ci NOT NULL,
  `cayados` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `neutrofilos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `basofilo` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `eosinofilo` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `linfocito` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `monocito` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `prolinfocito` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cel_inmaduras` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario_leuco` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `fecha` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `id_medico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_general`
--

CREATE TABLE `examen_general` (
  `id` int(11) NOT NULL,
  `color` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `olor` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `aspecto` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `espuma` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `sedimento` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `densidad` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `reaccion` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `proteinas` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `glucosa` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cetona` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `bilirrubina` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `sangre` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nitritos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `urubilinogeno` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `eritrocitos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `piocitos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `leucocitos` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cilindros` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `celulas` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cristales` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `otros` text COLLATE utf8_spanish2_ci NOT NULL,
  `exa_bac_sed` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_g`
--

CREATE TABLE `informes_g` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish2_ci NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion_w`
--

CREATE TABLE `reaccion_w` (
  `id` int(11) NOT NULL,
  `paraA1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA3` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA4` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraA6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB3` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB4` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `paraB6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO3` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO4` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH3` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH4` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `user`, `password`, `fecha`) VALUES
(15, 'admin', 'admin', '1234', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biometria`
--
ALTER TABLE `biometria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_examen` (`id_examen`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_general`
--
ALTER TABLE `examen_general`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `id_examen_2` (`id_examen`);

--
-- Indices de la tabla `informes_g`
--
ALTER TABLE `informes_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_examen` (`id_examen`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `id_examen_2` (`id_examen`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `examen_general`
--
ALTER TABLE `examen_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `informes_g`
--
ALTER TABLE `informes_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `reaccion_w`
--
ALTER TABLE `reaccion_w`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
