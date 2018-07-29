-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-07-2018 a las 18:30:07
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarMicrobiologia` (IN `_nombre` VARCHAR(100), IN `_contenido` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM microbiologia WHERE id_examen = _id_examen)) THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta; 
ELSE
	INSERT INTO microbiologia(nombre, contenido, id_examen)VALUES(_nombre, _contenido, _id_examen);
    SELECT false as error, id FROM microbiologia WHERE id_examen = _id_examen;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPaciente` (IN `_nombre` VARCHAR(55), IN `_apellidos` VARCHAR(75), IN `_edad` VARCHAR(15), IN `_sexo` CHAR(1))  BEGIN
	INSERT INTO paciente(nombre, apellidos, edad, sexo) VALUES(_nombre, _apellidos, _edad, _sexo);
    SELECT false as error, 'Paciente insertado correctamente' as respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarParasitologia` (IN `_nombre` VARCHAR(100), IN `_contenido` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM parasitologia WHERE id_examen = _id_examen)) THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta; 
ELSE
	INSERT INTO parasitologia(nombre, contenido, id_examen)VALUES(_nombre, _contenido, _id_examen);
    SELECT false as error, id FROM parasitologia WHERE id_examen = _id_examen;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarQuimica` (IN `_nombre` VARCHAR(100), IN `_contenido` TEXT, IN `_id_examen` INT)  BEGIN
IF (SELECT EXISTS(SELECT * FROM quimica_sanguinea WHERE id_examen = _id_examen)) THEN
	SELECT true AS error, 'El examen ya fué insertado' AS respuesta; 
ELSE
	INSERT INTO quimica_sanguinea(nombre, contenido, id_examen)VALUES(_nombre, _contenido, _id_examen);
    SELECT false as error, id FROM quimica_sanguinea WHERE id_examen = _id_examen;
END IF;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `listarExamenes` (IN `_id_paciente` INT)  BEGIN
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
-- Estructura de tabla para la tabla `biometria_pruebas`
--

CREATE TABLE `biometria_pruebas` (
  `id` int(11) NOT NULL,
  `hematies` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `hematocrito` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `hemoglobina` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `leucocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vsg` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vcm` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `hbcm` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `chbcm` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `comentario_hema` text COLLATE utf8_spanish2_ci,
  `cayados` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `neutrofilos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `basofilo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `eosinofilo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `linfocito` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `monocito` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `prolinfocito` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cel_inmaduras` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `comentario_leuco` text COLLATE utf8_spanish2_ci,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `biometria_pruebas`
--

INSERT INTO `biometria_pruebas` (`id`, `hematies`, `hematocrito`, `hemoglobina`, `leucocitos`, `vsg`, `vcm`, `hbcm`, `chbcm`, `comentario_hema`, `cayados`, `neutrofilos`, `basofilo`, `eosinofilo`, `linfocito`, `monocito`, `prolinfocito`, `cel_inmaduras`, `comentario_leuco`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'asdawdaw', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', 'a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', 'a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivos_pruebas`
--

CREATE TABLE `cultivos_pruebas` (
  `id` int(11) NOT NULL,
  `leucocitos` varchar(20) DEFAULT NULL,
  `bacterias` text,
  `esputo_as` varchar(35) DEFAULT NULL,
  `esputo_microorganismo_identificado` varchar(35) DEFAULT NULL,
  `ampicilina_sulbactam` varchar(20) DEFAULT NULL,
  `eritromicina` varchar(20) DEFAULT NULL,
  `clindamicina` varchar(20) DEFAULT NULL,
  `tetraciclina` varchar(20) DEFAULT NULL,
  `vancomicina` varchar(20) DEFAULT NULL,
  `recuento_colonias` varchar(35) DEFAULT NULL,
  `agar_mac_conkey` varchar(50) DEFAULT NULL,
  `tincion_gram` varchar(35) DEFAULT NULL,
  `pruebas_bioquimicas` varchar(50) DEFAULT NULL,
  `urocultivo_microorganismo_identificado` varchar(35) DEFAULT NULL,
  `amoxicilina_ac_clavulanico` varchar(20) DEFAULT NULL,
  `gentamicina` varchar(20) DEFAULT NULL,
  `ciprofloxacino` varchar(20) DEFAULT NULL,
  `cefixima` varchar(20) DEFAULT NULL,
  `cotrimoxazol` varchar(20) DEFAULT NULL,
  `nitrofurantoina` varchar(20) DEFAULT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cultivos_pruebas`
--

INSERT INTO `cultivos_pruebas` (`id`, `leucocitos`, `bacterias`, `esputo_as`, `esputo_microorganismo_identificado`, `ampicilina_sulbactam`, `eritromicina`, `clindamicina`, `tetraciclina`, `vancomicina`, `recuento_colonias`, `agar_mac_conkey`, `tincion_gram`, `pruebas_bioquimicas`, `urocultivo_microorganismo_identificado`, `amoxicilina_ac_clavulanico`, `gentamicina`, `ciprofloxacino`, `cefixima`, `cotrimoxazol`, `nitrofurantoina`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'awdawd', 'awaef3awdadawdadawdawdawdasdawfacscawcw', 'awdawd', 'awdawfawf33', 'a3ra3ra3', 'a3ra3', '3ra3r', '3rara', 'dwada', '235235', 'wdadwa', 'afwfwaf', '1212r12', 'afwfwa3f', '3fwafwa4g', 'gw4gwa4', 'w4gwa4g', 'w4gw4g', '3r2323t', '2t23t', 86, '2018-05-04 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espermograma_pruebas`
--

CREATE TABLE `espermograma_pruebas` (
  `id` int(11) NOT NULL,
  `hora_recoleccion` timestamp NULL DEFAULT NULL,
  `hora_recepcion` timestamp NULL DEFAULT NULL,
  `duracion_abstinencia` varchar(20) DEFAULT NULL,
  `aspecto` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `volumen` varchar(20) DEFAULT NULL,
  `viscosidad` varchar(20) DEFAULT NULL,
  `ph` varchar(20) DEFAULT NULL,
  `concentracion_espermatica` varchar(20) DEFAULT NULL,
  `caracteristicas_morfologicas` varchar(20) DEFAULT NULL,
  `espermatozoides_normales` varchar(20) DEFAULT NULL,
  `cabeza` varchar(20) DEFAULT NULL,
  `pieza_intermedia` varchar(20) DEFAULT NULL,
  `cola` varchar(20) DEFAULT NULL,
  `otras_celulas` text,
  `aglutinacion` varchar(20) DEFAULT NULL,
  `progresion_lineal_rapida` varchar(20) DEFAULT NULL,
  `progresion_lineal_lenta` varchar(20) DEFAULT NULL,
  `motilidad_no_progresiva` varchar(20) DEFAULT NULL,
  `inmoviles` varchar(20) DEFAULT NULL,
  `primera_hora_moviles` varchar(20) DEFAULT NULL,
  `primera_hora_inmoviles` varchar(20) DEFAULT NULL,
  `segunda_hora_moviles` varchar(20) DEFAULT NULL,
  `segunda_hora_inmoviles` varchar(20) DEFAULT NULL,
  `tercera_hora_moviles` varchar(20) DEFAULT NULL,
  `tercera_hora_inmoviles` varchar(20) DEFAULT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `espermograma_pruebas`
--

INSERT INTO `espermograma_pruebas` (`id`, `hora_recoleccion`, `hora_recepcion`, `duracion_abstinencia`, `aspecto`, `color`, `volumen`, `viscosidad`, `ph`, `concentracion_espermatica`, `caracteristicas_morfologicas`, `espermatozoides_normales`, `cabeza`, `pieza_intermedia`, `cola`, `otras_celulas`, `aglutinacion`, `progresion_lineal_rapida`, `progresion_lineal_lenta`, `motilidad_no_progresiva`, `inmoviles`, `primera_hora_moviles`, `primera_hora_inmoviles`, `segunda_hora_moviles`, `segunda_hora_inmoviles`, `tercera_hora_moviles`, `tercera_hora_inmoviles`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(2, '2018-05-06 04:00:00', '2018-05-06 04:00:00', '50 años', 'Opaco Homogéneo', 'awfawfq3f', 'afafa3fa', '4gae4gae', 'e4gae4hae', '60`000.000', 'awdawd', 'gagaga', 'gagag', 'wagagaw', 'awdaw', 'awfawfawfafawf\r\nawfawfawf\r\nasaaa', 'eahae5h', 'eahea5ha', '5heahae5', 'e5hae5ha', '', 'wfawfa', 'wfawf', 'wfawfa', 'fwafa', 'dwadaw', 'e5hea5h', 86, '2018-05-06 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_general_pruebas`
--

CREATE TABLE `examen_general_pruebas` (
  `id` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `olor` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `aspecto` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `espuma` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sedimento` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `densidad` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `reaccion` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `proteinas` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `glucosa` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cetona` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `bilirrubina` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sangre` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nitritos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `urubilinogeno` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `eritrocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `piocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `leucocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cilindros` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celulas` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cristales` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `otros` text COLLATE utf8_spanish2_ci,
  `exa_bac_sed` text COLLATE utf8_spanish2_ci,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen_general_pruebas`
--

INSERT INTO `examen_general_pruebas` (`id`, `color`, `cantidad`, `olor`, `aspecto`, `espuma`, `sedimento`, `densidad`, `reaccion`, `proteinas`, `glucosa`, `cetona`, `bilirrubina`, `sangre`, `nitritos`, `urubilinogeno`, `eritrocitos`, `piocitos`, `leucocitos`, `cilindros`, `celulas`, `cristales`, `otros`, `exa_bac_sed`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Amarillo', '500', 'áááéééííí', '\'a\'sẃ´wẃw´ñññ', 'wadasdawdasda', 'wadasdawdasda', 'wadasdawdasda', 'wadasdawdasda', 'wadasdawdasda', '100', '100000000.0000', '100000000.0000', '100000000.0000', '100000000.0000', '100000000.0000', '100', '100000000.0000', '100000000.0000', '100000000.0000', '100000000.0000', '100000000.0000', '100000000.0000awdawdawda\\nasdwadawd \\na asdawdawadawdasdasd100000000.0000awdawdawda\\nasdwadawd \\na asdawdawadawdasdasd', 'aaace lfpfek2!\"·$·%Y$&UY$ ááá ;;;ññññññññaaace lfpfek2!\"·$·%Y$&UY$ ááá ;;;ññññññññaaace lfpfek2!\"·$·%Y$&UY$ ááá ;;;ññññññññ\\n asdawd', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hormonas_pruebas`
--

CREATE TABLE `hormonas_pruebas` (
  `id` int(11) NOT NULL,
  `tsh` varchar(20) DEFAULT NULL,
  `t4_libre` varchar(20) DEFAULT NULL,
  `t4_total` varchar(20) DEFAULT NULL,
  `t3` varchar(20) DEFAULT NULL,
  `cisticercosis_resultado` varchar(20) DEFAULT NULL,
  `cisticercosis_cut_off` varchar(20) DEFAULT NULL,
  `comentario_cisticercosis` text,
  `antigeno_carcino` varchar(20) DEFAULT NULL,
  `psa_total` varchar(20) DEFAULT NULL,
  `psa_libre` varchar(20) DEFAULT NULL,
  `relacion_psa_libre_total` varchar(20) DEFAULT NULL,
  `estradiol` varchar(20) DEFAULT NULL,
  `progesterona` varchar(20) DEFAULT NULL,
  `fsh` varchar(20) DEFAULT NULL,
  `lh` varchar(20) DEFAULT NULL,
  `prolactina` varchar(20) DEFAULT NULL,
  `testosterona` varchar(20) DEFAULT NULL,
  `ana` varchar(20) DEFAULT NULL,
  `ana_control_positivo` varchar(20) DEFAULT NULL,
  `ana_control_negativo` varchar(20) DEFAULT NULL,
  `celulas_le` varchar(20) DEFAULT NULL,
  `celulas_le_control_positivo` varchar(20) DEFAULT NULL,
  `celulas_le_control_negativo` varchar(20) DEFAULT NULL,
  `anticuerpos_resultado` varchar(20) DEFAULT NULL,
  `anticuerpos_cut_off` varchar(20) DEFAULT NULL,
  `comentario_anticuerpos` text,
  `toxoplasmosis_lgm` varchar(20) DEFAULT NULL,
  `toxoplasmosis_lgg` varchar(20) DEFAULT NULL,
  `b_hcg_cuantitativo` varchar(20) DEFAULT NULL,
  `anti_nucleares` varchar(20) DEFAULT NULL,
  `anticuerpos_control_positivo` varchar(20) DEFAULT NULL,
  `anticuerpos_control_negativo` varchar(20) DEFAULT NULL,
  `celulas_hep` varchar(20) DEFAULT NULL,
  `control_positivo` varchar(20) DEFAULT NULL,
  `control_negativo` varchar(20) DEFAULT NULL,
  `conclusion` text,
  `comentario_general` text,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hormonas_pruebas`
--

INSERT INTO `hormonas_pruebas` (`id`, `tsh`, `t4_libre`, `t4_total`, `t3`, `cisticercosis_resultado`, `cisticercosis_cut_off`, `comentario_cisticercosis`, `antigeno_carcino`, `psa_total`, `psa_libre`, `relacion_psa_libre_total`, `estradiol`, `progesterona`, `fsh`, `lh`, `prolactina`, `testosterona`, `ana`, `ana_control_positivo`, `ana_control_negativo`, `celulas_le`, `celulas_le_control_positivo`, `celulas_le_control_negativo`, `anticuerpos_resultado`, `anticuerpos_cut_off`, `comentario_anticuerpos`, `toxoplasmosis_lgm`, `toxoplasmosis_lgg`, `b_hcg_cuantitativo`, `anti_nucleares`, `anticuerpos_control_positivo`, `anticuerpos_control_negativo`, `celulas_hep`, `control_positivo`, `control_negativo`, `conclusion`, `comentario_general`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'awfaw', 'wa4gaw4', 'wagawg', 'aw4gaw4ga', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_pruebas`
--

CREATE TABLE `informe_pruebas` (
  `id` int(11) NOT NULL,
  `grupo_sanguineo` varchar(100) DEFAULT NULL,
  `factor_rh` varchar(100) DEFAULT NULL,
  `prueba_inmunologica_embarazo` varchar(100) NOT NULL,
  `other` varchar(150) NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_pruebas`
--

INSERT INTO `informe_pruebas` (`id`, `grupo_sanguineo`, `factor_rh`, `prueba_inmunologica_embarazo`, `other`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, '', '', '', '', 86, '2018-05-04 00:00:00', '2018-05-07 02:43:56', 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquido_sinovial_pruebas`
--

CREATE TABLE `liquido_sinovial_pruebas` (
  `id` int(11) NOT NULL,
  `volumen` varchar(20) DEFAULT NULL,
  `proteinas_totales` varchar(20) DEFAULT NULL,
  `glucosa` varchar(20) DEFAULT NULL,
  `celulas` varchar(20) DEFAULT NULL,
  `coagulo_fibrina` varchar(20) DEFAULT NULL,
  `glicemia` varchar(20) DEFAULT NULL,
  `urea` varchar(20) DEFAULT NULL,
  `creatinina` varchar(20) DEFAULT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `liquido_sinovial_pruebas`
--

INSERT INTO `liquido_sinovial_pruebas` (`id`, `volumen`, `proteinas_totales`, `glucosa`, `celulas`, `coagulo_fibrina`, `glicemia`, `urea`, `creatinina`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'awdaw', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíiááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(18, 'Son', '0000-00-00 00:00:00', NULL, 0, 0),
(19, 'dr thor', '2018-05-03 15:21:08', '2018-05-03 15:21:08', 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `microbiologia_pruebas`
--

CREATE TABLE `microbiologia_pruebas` (
  `id` int(11) NOT NULL,
  `celulas_epitelio_vaginal` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `leucocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `piocitos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celulas_clave` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tricomona_vaginalis` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flora_bacteriana` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `hifas_micoticas` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `prueba_koh` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `coco_bacilos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cocos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `bacilos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `bacilos_gram_negativos` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `hifas_esporas_micoticas` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `microbiologia_pruebas`
--

INSERT INTO `microbiologia_pruebas` (`id`, `celulas_epitelio_vaginal`, `leucocitos`, `piocitos`, `celulas_clave`, `tricomona_vaginalis`, `flora_bacteriana`, `hifas_micoticas`, `prueba_koh`, `coco_bacilos_gram_positivos`, `cocos_gram_positivos`, `bacilos_gram_positivos`, `bacilos_gram_negativos`, `hifas_esporas_micoticas`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(6, 'rqweq', '1313', '53545', '3434', '343415', '6666', '556', '777', '555', '2626', '345345', '34534', '34534', 86, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellidos`, `edad`, `sexo`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(37, 'Erwin', 'Méndez', '23 m', 'M', '0000-00-00 00:00:00', NULL, 0, 0),
(38, 'asdf', 'asdf', '12', 'F', '0000-00-00 00:00:00', NULL, 0, 0),
(39, 'lolo', 'el gilipollas', '45 m', 'M', '2018-05-03 15:14:24', '2018-05-03 15:14:24', 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parasitologia_pruebas`
--

CREATE TABLE `parasitologia_pruebas` (
  `id` int(11) NOT NULL,
  `consistencia` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `restos_alimenticios` varchar(20) DEFAULT NULL,
  `leucocitos` varchar(20) DEFAULT NULL,
  `comentario` text,
  `sangre_oculta` varchar(20) DEFAULT NULL,
  `muestra1` varchar(100) DEFAULT NULL,
  `muestra2` varchar(100) NOT NULL,
  `muestra3` varchar(100) NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parasitologia_pruebas`
--

INSERT INTO `parasitologia_pruebas` (`id`, `consistencia`, `color`, `restos_alimenticios`, `leucocitos`, `comentario`, `sangre_oculta`, `muestra1`, `muestra2`, `muestra3`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(2, 'rawfaw', 'awf33', '25252', '2342t', 'áa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeé', 'áa´aaá´eeé', 'áa´aaá´eeéwagwa4gwag322g', '21d1dawdawdawd', '12d12123geagergawegw4g', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` int(11) NOT NULL,
  `fecha` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL,
  `medico_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `fecha`, `comentario`, `medico_id`, `paciente_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(86, '2018-01-15 01:18:25.601406', '', 18, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quimica_sanguinea_pruebas`
--

CREATE TABLE `quimica_sanguinea_pruebas` (
  `id` int(11) NOT NULL,
  `glucemia` varchar(20) DEFAULT NULL,
  `urea` varchar(20) DEFAULT NULL,
  `creatinina` varchar(20) DEFAULT NULL,
  `acido_urico` varchar(20) DEFAULT NULL,
  `colesterol_total` varchar(20) DEFAULT NULL,
  `hdl_colesterol` varchar(20) DEFAULT NULL,
  `ldl_colesterol` varchar(20) DEFAULT NULL,
  `trigliceridos` varchar(20) DEFAULT NULL,
  `f_alcalina` varchar(20) DEFAULT NULL,
  `transaminasa_got` varchar(20) DEFAULT NULL,
  `transaminasa_gpt` varchar(20) DEFAULT NULL,
  `bilirrubina_total` varchar(20) DEFAULT NULL,
  `bilirrubina_directa` varchar(20) DEFAULT NULL,
  `bilirrubina_indirecta` varchar(20) DEFAULT NULL,
  `amilasa` varchar(20) DEFAULT NULL,
  `proteinas_totales` varchar(20) DEFAULT NULL,
  `albumina` varchar(20) DEFAULT NULL,
  `calcio` varchar(20) DEFAULT NULL,
  `cpk` varchar(20) DEFAULT NULL,
  `cpk_mb` varchar(20) DEFAULT NULL,
  `gamaglutamil_transpeptidasa` varchar(20) DEFAULT NULL,
  `prueba_inmunologica_embarazo` text,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `quimica_sanguinea_pruebas`
--

INSERT INTO `quimica_sanguinea_pruebas` (`id`, `glucemia`, `urea`, `creatinina`, `acido_urico`, `colesterol_total`, `hdl_colesterol`, `ldl_colesterol`, `trigliceridos`, `f_alcalina`, `transaminasa_got`, `transaminasa_gpt`, `bilirrubina_total`, `bilirrubina_directa`, `bilirrubina_indirecta`, `amilasa`, `proteinas_totales`, `albumina`, `calcio`, `cpk`, `cpk_mb`, `gamaglutamil_transpeptidasa`, `prueba_inmunologica_embarazo`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'adawda', 'a3ta', '3ra3r', '3ra3r', '3ra3ta3t', '3twataw', '3tawta', 't3ataw', '3twatwa', 'hhhhhh', 'aaaaa', 'aaaaa', '33333', '44444', '3333', '1241241', '112412', 'vvv', 'vvvv', 'cccc', 'ccvvvcc', '', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion_w_pruebas`
--

CREATE TABLE `reaccion_w_pruebas` (
  `id` int(11) NOT NULL,
  `paraA1` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraA2` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraA3` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraA4` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraA5` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraA6` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB1` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB2` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB3` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB4` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB5` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paraB6` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO1` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO2` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO3` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO4` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO5` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `somaticoO6` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH1` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH2` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH3` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH4` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH5` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `flagelarH6` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `comentario` text COLLATE utf8_spanish2_ci,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reaccion_w_pruebas`
--

INSERT INTO `reaccion_w_pruebas` (`id`, `paraA1`, `paraA2`, `paraA3`, `paraA4`, `paraA5`, `paraA6`, `paraB1`, `paraB2`, `paraB3`, `paraB4`, `paraB5`, `paraB6`, `somaticoO1`, `somaticoO2`, `somaticoO3`, `somaticoO4`, `somaticoO5`, `somaticoO6`, `flagelarH1`, `flagelarH2`, `flagelarH3`, `flagelarH4`, `flagelarH5`, `flagelarH6`, `comentario`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, '1', '12', '12/1000', '99998800', '9998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', '99998800', 'Oxalato de calc', '99998800.0000', '99998800.0000', '1', 'sadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááásadawdasd!@@$T#$Yñññññññééééé´aáááá', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serologia_pruebas`
--

CREATE TABLE `serologia_pruebas` (
  `id` int(11) NOT NULL,
  `factor_reumatoide` varchar(20) DEFAULT NULL,
  `pcr` varchar(20) DEFAULT NULL,
  `asto` varchar(20) DEFAULT NULL,
  `aso` varchar(20) DEFAULT NULL,
  `k_plus` varchar(20) DEFAULT NULL,
  `na_plus` varchar(20) DEFAULT NULL,
  `cl_minus` varchar(20) DEFAULT NULL,
  `ca` varchar(20) DEFAULT NULL,
  `p` varchar(20) DEFAULT NULL,
  `chagas` varchar(20) DEFAULT NULL,
  `toxoplasmosis` varchar(20) DEFAULT NULL,
  `chagas_resultado` varchar(20) DEFAULT NULL,
  `chagas_elisa_cut_off` varchar(20) DEFAULT NULL,
  `chagas_comentario` text,
  `tiempo_sangria` varchar(20) DEFAULT NULL,
  `tiempo_coagulacion` varchar(20) DEFAULT NULL,
  `tiempo_protrombina` varchar(20) DEFAULT NULL,
  `actividad_protrombina` varchar(20) DEFAULT NULL,
  `grupo_sanguineo` varchar(20) DEFAULT NULL,
  `factor_rh` varchar(20) DEFAULT NULL,
  `recuento_plaquetas` varchar(50) DEFAULT NULL,
  `agr_dis_plaquetaria` varchar(50) DEFAULT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `serologia_pruebas`
--

INSERT INTO `serologia_pruebas` (`id`, `factor_reumatoide`, `pcr`, `asto`, `aso`, `k_plus`, `na_plus`, `cl_minus`, `ca`, `p`, `chagas`, `toxoplasmosis`, `chagas_resultado`, `chagas_elisa_cut_off`, `chagas_comentario`, `tiempo_sangria`, `tiempo_coagulacion`, `tiempo_protrombina`, `actividad_protrombina`, `grupo_sanguineo`, `factor_rh`, `recuento_plaquetas`, `agr_dis_plaquetaria`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'fsefae', '23523t', '23523t', '23523t', 'faw4gw', 'e4gea4hg', 'earghae', '44h', '', 'aergae4wg', 'g4agae', 'awdawd', 'awda2d2', '3rr', 'dawfawgfa', 'dwad', 'dwadaw', 'wdawd', 'awdaw', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñ', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `password`, `token`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(20, 'morty', 'admin', '$2y$10$UnvW.QsauJcNS37ABuNemO3i/yxTwfAX6wd8LBD31jezunln0iBz2', '$2y$10$k369U5NT5VsU9lctQutuBe9rtR.FPp52B.vig5uulSJFJIsOLPGN.', '2018-05-06 23:40:40', '2018-05-06 23:40:53', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biometria_pruebas`
--
ALTER TABLE `biometria_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cultivos_pruebas`
--
ALTER TABLE `cultivos_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `espermograma_pruebas`
--
ALTER TABLE `espermograma_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_general_pruebas`
--
ALTER TABLE `examen_general_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hormonas_pruebas`
--
ALTER TABLE `hormonas_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informe_pruebas`
--
ALTER TABLE `informe_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liquido_sinovial_pruebas`
--
ALTER TABLE `liquido_sinovial_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `microbiologia_pruebas`
--
ALTER TABLE `microbiologia_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parasitologia_pruebas`
--
ALTER TABLE `parasitologia_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `quimica_sanguinea_pruebas`
--
ALTER TABLE `quimica_sanguinea_pruebas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_examen` (`prueba_id`);

--
-- Indices de la tabla `reaccion_w_pruebas`
--
ALTER TABLE `reaccion_w_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `serologia_pruebas`
--
ALTER TABLE `serologia_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biometria_pruebas`
--
ALTER TABLE `biometria_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cultivos_pruebas`
--
ALTER TABLE `cultivos_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `espermograma_pruebas`
--
ALTER TABLE `espermograma_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `examen_general_pruebas`
--
ALTER TABLE `examen_general_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hormonas_pruebas`
--
ALTER TABLE `hormonas_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `informe_pruebas`
--
ALTER TABLE `informe_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `liquido_sinovial_pruebas`
--
ALTER TABLE `liquido_sinovial_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `microbiologia_pruebas`
--
ALTER TABLE `microbiologia_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `parasitologia_pruebas`
--
ALTER TABLE `parasitologia_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `quimica_sanguinea_pruebas`
--
ALTER TABLE `quimica_sanguinea_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reaccion_w_pruebas`
--
ALTER TABLE `reaccion_w_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `serologia_pruebas`
--
ALTER TABLE `serologia_pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
