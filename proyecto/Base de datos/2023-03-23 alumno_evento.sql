-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2023 a las 03:01:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuelademanejo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_evento`
--

CREATE TABLE `alumno_evento` (
  `id` int(10) UNSIGNED NOT NULL,
  `clase` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_alumno_curso` bigint(20) DEFAULT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `id_instructor` bigint(20) DEFAULT NULL,
  `asistencia` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_evento`
--

INSERT INTO `alumno_evento` (`id`, `clase`, `start_date`, `end_date`, `created_at`, `updated_at`, `id_alumno_curso`, `id_vehiculo`, `id_instructor`, `asistencia`, `descripcion`) VALUES
(1, 'Clase1', '2023-03-21 00:00:00', '2023-03-21 00:00:00', '2023-03-21 15:16:02', '2023-03-21 15:16:02', 1, NULL, NULL, NULL, NULL),
(2, 'Clase2', '2023-03-23 00:00:00', '2023-03-23 00:00:00', '2023-03-21 15:24:25', '2023-03-21 15:24:25', 1, NULL, NULL, NULL, NULL),
(3, 'Clase1', '2023-03-07 00:00:00', '2023-03-21 00:00:00', '2023-03-22 01:36:56', '2023-03-22 01:36:56', 2, NULL, NULL, NULL, NULL),
(5, 'Clase2', NULL, '2023-03-22 00:00:00', '2023-03-22 17:18:54', '2023-03-22 17:18:54', 2, NULL, NULL, NULL, NULL),
(6, 'Clase3', NULL, '2023-03-13 00:00:00', '2023-03-22 17:51:04', '2023-03-22 17:51:04', 2, NULL, NULL, NULL, NULL),
(7, 'Clase3', NULL, '2023-03-22 00:00:00', '2023-03-22 17:55:49', '2023-03-22 17:55:49', 1, NULL, NULL, NULL, NULL),
(8, 'Clase4', '2023-03-05 00:00:00', '2023-03-05 00:00:00', '2023-03-22 18:06:02', '2023-03-22 18:06:02', 1, NULL, NULL, NULL, NULL),
(9, 'Clase4', '2023-03-14 00:00:00', '2023-03-14 00:00:00', '2023-03-22 18:44:57', '2023-03-22 18:44:57', 2, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno_evento`
--
ALTER TABLE `alumno_evento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno_evento`
--
ALTER TABLE `alumno_evento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
