-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2023 a las 16:45:46
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

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
  `alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_evento`
--

INSERT INTO `alumno_evento` (`id`, `clase`, `start_date`, `end_date`, `created_at`, `updated_at`, `alumno`) VALUES
(1, 'Manejo1', '2023-03-21 00:00:00', '2023-03-21 00:00:00', '2023-03-21 15:16:02', '2023-03-21 15:16:02', 1),
(2, 'Manejo2', '2023-03-23 00:00:00', '2023-03-23 00:00:00', '2023-03-21 15:24:25', '2023-03-21 15:24:25', 1),
(3, 'NENECHA', '2023-03-07 00:00:00', '2023-03-21 00:00:00', '2023-03-22 01:36:56', '2023-03-22 01:36:56', NULL),
(5, 'que pasa por aca', NULL, '2023-03-22 00:00:00', '2023-03-22 17:18:54', '2023-03-22 17:18:54', NULL),
(6, 'NENECHA', NULL, '2023-03-13 00:00:00', '2023-03-22 17:51:04', '2023-03-22 17:51:04', NULL),
(7, 'Manejo2', NULL, '2023-03-22 00:00:00', '2023-03-22 17:55:49', '2023-03-22 17:55:49', NULL),
(8, 'POLITICA', '2023-03-05 00:00:00', '2023-03-05 00:00:00', '2023-03-22 18:06:02', '2023-03-22 18:06:02', NULL),
(9, 'PITUFO GRUÑON', '2023-03-14 00:00:00', '2023-03-14 00:00:00', '2023-03-22 18:44:57', '2023-03-22 18:44:57', NULL);

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
