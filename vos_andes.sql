-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2018 a las 14:45:34
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

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
(1, '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', 'a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', '1000000.0000', 'a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1a\'a\'sd\'w\'ásasdáwNNNdasññad1', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivos_pruebas`
--

CREATE TABLE `cultivos_pruebas` (
  `id` int(11) NOT NULL,
  `leucocitos` varchar(20) NOT NULL,
  `bacterias` text NOT NULL,
  `esputo_as` varchar(35) NOT NULL,
  `esputo_microorganismo_identificado` varchar(35) NOT NULL,
  `ampicilina_sulbactam` varchar(20) NOT NULL,
  `eritromicina` varchar(20) NOT NULL,
  `clindamicina` varchar(20) NOT NULL,
  `tetraciclina` varchar(20) NOT NULL,
  `vancomicina` varchar(20) NOT NULL,
  `recuento_colonias` varchar(35) NOT NULL,
  `agar_mac_conkey` varchar(50) NOT NULL,
  `tincion_gram` varchar(35) NOT NULL,
  `pruebas_bioquimicas` varchar(50) NOT NULL,
  `urocultivo_microorganismo_identificado` varchar(35) NOT NULL,
  `amoxicilina_ac_clavulanico` varchar(20) NOT NULL,
  `gentamicina` varchar(20) NOT NULL,
  `ciprofloxacino` varchar(20) NOT NULL,
  `cefixima` varchar(20) NOT NULL,
  `cotrimoxazol` varchar(20) NOT NULL,
  `nitrofurantoina` varchar(20) NOT NULL,
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
(1, '', '', '', '', '', '', '', '', 'dwada', '', '', '', '', '', '3aedf', '3faf3', '', '3r3r', 'avzv', 'qqqwf', 86, '2018-05-04 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espermograma_pruebas`
--

CREATE TABLE `espermograma_pruebas` (
  `id` int(11) NOT NULL,
  `hora_recoleccion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hora_recepcion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duracion_abstinencia` varchar(20) NOT NULL,
  `aspecto` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `volumen` varchar(20) NOT NULL,
  `viscosidad` varchar(20) NOT NULL,
  `ph` varchar(20) NOT NULL,
  `concentracion_espermatica` varchar(20) NOT NULL,
  `caracteristicas_morfologicas` varchar(20) NOT NULL,
  `espermatozoides_normales` varchar(20) NOT NULL,
  `cabeza` varchar(20) NOT NULL,
  `pieza_intermedia` varchar(20) NOT NULL,
  `cola` varchar(20) NOT NULL,
  `otras_celulas` text NOT NULL,
  `aglutinacion` varchar(20) NOT NULL,
  `progresion_lineal_rapida` varchar(20) NOT NULL,
  `progresion_lineal_lenta` varchar(20) NOT NULL,
  `motilidad_no_progresiva` varchar(20) NOT NULL,
  `inmoviles` varchar(20) NOT NULL,
  `primera_hora` varchar(20) NOT NULL,
  `segunda_hora` varchar(20) NOT NULL,
  `tercera_hora` varchar(20) NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `espermograma_pruebas`
--

INSERT INTO `espermograma_pruebas` (`id`, `hora_recoleccion`, `hora_recepcion`, `duracion_abstinencia`, `aspecto`, `color`, `volumen`, `viscosidad`, `ph`, `concentracion_espermatica`, `caracteristicas_morfologicas`, `espermatozoides_normales`, `cabeza`, `pieza_intermedia`, `cola`, `otras_celulas`, `aglutinacion`, `progresion_lineal_rapida`, `progresion_lineal_lenta`, `motilidad_no_progresiva`, `inmoviles`, `primera_hora`, `segunda_hora`, `tercera_hora`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, '2018-05-04 19:03:13', '2018-05-04 19:03:13', '50 años', 'wdawdawda', 'swadasdaw', 'wdadas', 'á{æ{æ;éé\'ñ', 'á{æ{æ;éé\'ñ', 'á{æ{æ;éé\'ñ', 'á{æ{æ;éé\'ñ', 'á{æ{æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', '', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 'á2æ3æ;éé\'ñ', 86, '2018-05-04 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_general_pruebas`
--

CREATE TABLE `examen_general_pruebas` (
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
  `tsh` varchar(20) NOT NULL,
  `t4_libre` varchar(20) NOT NULL,
  `t4_total` varchar(20) NOT NULL,
  `t3` varchar(20) NOT NULL,
  `cisticercosis_resultado` varchar(20) NOT NULL,
  `cisticercosis_cut_off` varchar(20) NOT NULL,
  `comentario_cisticercosis` text NOT NULL,
  `antigeno_carcino` varchar(20) NOT NULL,
  `psa_total` varchar(20) NOT NULL,
  `psa_libre` varchar(20) NOT NULL,
  `relacion_psa_libre_total` varchar(20) NOT NULL,
  `estradiol` varchar(20) NOT NULL,
  `progesterona` varchar(20) NOT NULL,
  `fsh` varchar(20) NOT NULL,
  `lh` varchar(20) NOT NULL,
  `prolactina` varchar(20) NOT NULL,
  `testosterona` varchar(20) NOT NULL,
  `ana` varchar(20) NOT NULL,
  `testosterona_control_positivo` varchar(20) NOT NULL,
  `testosterona_control_negativo` varchar(20) NOT NULL,
  `celulas_le` varchar(20) NOT NULL,
  `celulas_le_control_positivo` varchar(20) NOT NULL,
  `celulas_le_control_negativo` varchar(20) NOT NULL,
  `anticuerpos_resultado` varchar(20) NOT NULL,
  `anticuerpos_cut_off` varchar(20) NOT NULL,
  `comentario_anticuerpos` text NOT NULL,
  `toxoplasmosis_lgm` varchar(20) NOT NULL,
  `toxoplasmosis_lgg` varchar(20) NOT NULL,
  `b_hcg_cuantitativo` varchar(20) NOT NULL,
  `anti_nucleares` varchar(20) NOT NULL,
  `anticuerpos_control_positivo` varchar(20) NOT NULL,
  `anticuerpos_control_negativo` varchar(20) NOT NULL,
  `celulas_hep` varchar(20) NOT NULL,
  `control_positivo` varchar(20) NOT NULL,
  `control_negativo` varchar(20) NOT NULL,
  `conclusion` varchar(20) NOT NULL,
  `comentario_general` text NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hormonas_pruebas`
--

INSERT INTO `hormonas_pruebas` (`id`, `tsh`, `t4_libre`, `t4_total`, `t3`, `cisticercosis_resultado`, `cisticercosis_cut_off`, `comentario_cisticercosis`, `antigeno_carcino`, `psa_total`, `psa_libre`, `relacion_psa_libre_total`, `estradiol`, `progesterona`, `fsh`, `lh`, `prolactina`, `testosterona`, `ana`, `testosterona_control_positivo`, `testosterona_control_negativo`, `celulas_le`, `celulas_le_control_positivo`, `celulas_le_control_negativo`, `anticuerpos_resultado`, `anticuerpos_cut_off`, `comentario_anticuerpos`, `toxoplasmosis_lgm`, `toxoplasmosis_lgg`, `b_hcg_cuantitativo`, `anti_nucleares`, `anticuerpos_control_positivo`, `anticuerpos_control_negativo`, `celulas_hep`, `control_positivo`, `control_negativo`, `conclusion`, `comentario_general`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$', 'ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$ééaá;;ñ$', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_pruebas`
--

CREATE TABLE `informe_pruebas` (
  `id` int(11) NOT NULL,
  `grupo_sanguineo` varchar(20) NOT NULL,
  `factor_rh` varchar(20) NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_pruebas`
--

INSERT INTO `informe_pruebas` (`id`, `grupo_sanguineo`, `factor_rh`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'awdadw', 'sefsdfsef', 86, '2018-05-04 00:00:00', '2018-05-04 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquido_sinovial_pruebas`
--

CREATE TABLE `liquido_sinovial_pruebas` (
  `id` int(11) NOT NULL,
  `volumen` varchar(20) NOT NULL,
  `proteinas_totales` varchar(20) NOT NULL,
  `glucosa` varchar(20) NOT NULL,
  `celulas` varchar(20) NOT NULL,
  `coagulo_fibrina` varchar(20) NOT NULL,
  `glicemia` varchar(20) NOT NULL,
  `urea` varchar(20) NOT NULL,
  `creatinina` varchar(20) NOT NULL,
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
(1, 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíiááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 'ááée´uúíi', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `apellidos`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(18, 'Son', 'Gokú', '0000-00-00 00:00:00', NULL, 0, 0),
(19, 'dr thor', 'el del martillo', '2018-05-03 15:21:08', '2018-05-03 15:21:08', 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `microbiologia_pruebas`
--

CREATE TABLE `microbiologia_pruebas` (
  `id` int(11) NOT NULL,
  `celulas_epitelio_vaginal` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `leucocitos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `piocitos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celulas_clave` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `tricomona_vaginalis` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `flora_bacteriana` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `hifas_micoticas` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `prueba_koh` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `coco_bacilos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cocos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bacilos_gram_positivos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bacilos_gram_negativos` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `hifas_esporas_micoticas` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
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
  `consistencia` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `restos_alimenticios` varchar(20) NOT NULL,
  `leucocitos` varchar(20) NOT NULL,
  `comentario` text NOT NULL,
  `sangre_oculta` varchar(20) NOT NULL,
  `muestras` text NOT NULL,
  `prueba_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parasitologia_pruebas`
--

INSERT INTO `parasitologia_pruebas` (`id`, `consistencia`, `color`, `restos_alimenticios`, `leucocitos`, `comentario`, `sangre_oculta`, `muestras`, `prueba_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(2, 'awdasd', 'áa´aaá´eeé', 'áa´aaá´eeé', 'áa´aaá´eeé', 'áa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeéáa´aaá´eeé', 'áa´aaá´eeé', 'áa´aaá´eeé', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` int(11) NOT NULL,
  `fecha` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
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

INSERT INTO `pruebas` (`id`, `fecha`, `medico_id`, `paciente_id`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(86, '2018-01-15 01:18:25.601406', 18, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quimica_sanguinea_pruebas`
--

CREATE TABLE `quimica_sanguinea_pruebas` (
  `id` int(11) NOT NULL,
  `glucemia` varchar(20) NOT NULL,
  `urea` varchar(20) NOT NULL,
  `creatinina` varchar(20) NOT NULL,
  `acido_urico` varchar(20) NOT NULL,
  `colesterol_total` varchar(20) NOT NULL,
  `hdl_colesterol` varchar(20) NOT NULL,
  `ldl_colesterol` varchar(20) NOT NULL,
  `trigliceridos` varchar(20) NOT NULL,
  `f_alcalina` varchar(20) NOT NULL,
  `transaminasa_got` varchar(20) NOT NULL,
  `transaminasa_gpt` varchar(20) NOT NULL,
  `bilirrubina_total` varchar(20) NOT NULL,
  `bilirrubina_directa` varchar(20) NOT NULL,
  `bilirrubina_indirecta` varchar(20) NOT NULL,
  `amilasa` varchar(20) NOT NULL,
  `proteinas_totales` varchar(20) NOT NULL,
  `albumina` varchar(20) NOT NULL,
  `calcio` varchar(20) NOT NULL,
  `cpk` varchar(20) NOT NULL,
  `cpk_mb` varchar(20) NOT NULL,
  `gamaglutamil_transpeptidasa` varchar(20) NOT NULL,
  `prueba_inmunologica_embarazo` varchar(150) NOT NULL,
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
(1, 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', '', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññú', 'awááééññúawááééññú', 86, '0000-00-00 00:00:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion_w_pruebas`
--

CREATE TABLE `reaccion_w_pruebas` (
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
  `somaticoO4` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `somaticoO6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH3` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH4` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH5` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `flagelarH6` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL,
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
  `factor_reumatoide` varchar(20) NOT NULL,
  `pcr` varchar(20) NOT NULL,
  `asto` varchar(20) NOT NULL,
  `aso` varchar(20) NOT NULL,
  `k_plus` varchar(20) NOT NULL,
  `na_plus` varchar(20) NOT NULL,
  `cl_minus` varchar(20) NOT NULL,
  `ca` varchar(20) NOT NULL,
  `p` varchar(20) NOT NULL,
  `chagas` varchar(20) NOT NULL,
  `toxoplasmosis` varchar(20) NOT NULL,
  `chagas_resultado` varchar(20) NOT NULL,
  `chagas_elisa_cut_off` varchar(20) NOT NULL,
  `chagas_comentario` text NOT NULL,
  `tiempo_sangria` varchar(20) NOT NULL,
  `tiempo_coagulacion` varchar(20) NOT NULL,
  `tiempo_protrombina` varchar(20) NOT NULL,
  `actividad_protrombina` varchar(20) NOT NULL,
  `grupo_sanguineo` varchar(20) NOT NULL,
  `factor_rh` varchar(20) NOT NULL,
  `recuento_plaquetas` varchar(50) NOT NULL,
  `agr_dis_plaquetaria` varchar(50) NOT NULL,
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
(1, 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñ', '', 'áááéée;;ñ', 'áááéée;;ñ', 'áááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñáááéée;;ñ', 86, '2018-05-05 00:00:00', NULL, 0, NULL);

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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
