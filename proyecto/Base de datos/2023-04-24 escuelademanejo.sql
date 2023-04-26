-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2023 a las 23:25:20
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
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `direccion`, `mail`, `telefono`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Alba Maidana', 'barrio Las Rosas Ctes Capital', 'alba@gmail.com.ar', NULL, '2023-01-31 23:06:00', '2023-04-05 16:24:54', 'alumnos\\April2023\\MyTAeDhZUV0IkXPdJEqB.png'),
(2, 'Juan Perez', 'Av 25 de MAYO 1799', 'jperez@gmail.com.ar', '3624611111', '2023-03-31 16:58:00', '2023-04-05 16:24:01', 'alumnos\\April2023\\Hi3RYw3nm3oYvhsflmcv.png'),
(3, 'Rosina Sandoval', 'Av 25 de MAYO 1799', 'rosinasandoval@gmail.com.ar', '3624611111', '2023-04-14 01:48:51', '2023-04-14 01:48:51', 'alumnos\\April2023\\3qElqn5panU3rk41GpDU.png'),
(4, 'Marta', 'ruta 11', 'marta@gmail.com', '12121212', '2023-04-19 02:50:22', '2023-04-19 02:50:22', NULL),
(5, 'Elisa', 'Los Sauces 800', 'elisa@gmail.com', '34343433', '2023-04-19 02:55:09', '2023-04-19 02:55:09', NULL),
(6, 'Juana', 'Los Arroyos 600', 'juana@gmail.com', '999494994', '2023-04-19 02:57:14', '2023-04-19 02:57:14', NULL),
(7, 'Lorena', 'Pasaje Arroyos 300', 'lorena@gmail.com', '242422424', '2023-04-19 03:12:31', '2023-04-19 03:12:31', NULL),
(8, 'Monica', 'Pasaje Condor 333', 'monica@gmail.com', '99399393', '2023-04-19 03:15:16', '2023-04-19 03:15:16', NULL),
(9, 'Luciana', 'casa de Luciana', 'luciana@gmail.com.ar', NULL, '2023-04-19 15:38:22', '2023-04-19 15:38:22', NULL),
(10, 'Pancracio', 'los arroyos 3323', 'pancracio@hotmail.com', '2093r420', '2023-04-22 03:01:51', '2023-04-22 03:01:51', NULL),
(11, 'Patricio', 'los alerces 42424', 'patricio@hotmail.com', '343434', '2023-04-22 03:04:43', '2023-04-22 03:04:43', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_cursos`
--

CREATE TABLE `alumnos_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_curso` bigint(20) DEFAULT NULL,
  `id_alumno` bigint(20) DEFAULT NULL,
  `id_sucursal` bigint(20) DEFAULT NULL,
  `id_instructor` bigint(20) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `id_vendedor` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `activo` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_franja_horaria` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos_cursos`
--

INSERT INTO `alumnos_cursos` (`id`, `id_curso`, `id_alumno`, `id_sucursal`, `id_instructor`, `fecha_inscripcion`, `id_vendedor`, `created_at`, `updated_at`, `id_vehiculo`, `precio`, `activo`, `id_franja_horaria`) VALUES
(1, 1, 1, 1, 1, '2023-02-16', 1, '2023-01-31 23:09:00', '2023-04-14 02:01:42', 1, '10000', 'NO', NULL),
(2, 1, 3, 1, 1, '2023-03-23', 1, '2023-03-24 02:40:00', '2023-04-19 02:00:30', 1, '100', 'SI', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_evento`
--

CREATE TABLE `alumno_evento` (
  `id` int(10) UNSIGNED NOT NULL,
  `clase` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_alumno_curso` bigint(20) DEFAULT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `id_instructor` bigint(20) DEFAULT NULL,
  `asistencia` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_franja_horaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_evento`
--

INSERT INTO `alumno_evento` (`id`, `clase`, `start_date`, `end_date`, `created_at`, `updated_at`, `id_alumno_curso`, `id_vehiculo`, `id_instructor`, `asistencia`, `descripcion`, `id_franja_horaria`) VALUES
(1, 'Clase1', '2023-03-21 03:00:00', '2023-03-21 03:00:00', '2023-03-21 15:16:02', '2023-03-21 15:16:02', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Clase2', '2023-03-23 03:00:00', '2023-03-23 03:00:00', '2023-03-21 15:24:25', '2023-03-21 15:24:25', 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Clase2', '2023-03-22 03:00:00', '2023-03-22 03:00:00', '2023-03-22 17:18:54', '2023-03-22 17:18:54', 2, NULL, NULL, NULL, NULL, NULL),
(6, 'Clase3', '2023-03-14 02:24:29', '2023-03-13 03:00:00', '2023-03-22 17:51:04', '2023-03-22 17:51:04', 2, NULL, NULL, NULL, NULL, NULL),
(7, 'Clase3', '2023-03-23 02:24:50', '2023-03-22 03:00:00', '2023-03-22 17:55:49', '2023-03-22 17:55:49', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Clase4', '2023-03-05 03:00:00', '2023-03-05 03:00:00', '2023-03-22 18:06:02', '2023-03-22 18:06:02', 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Clase4', '2023-03-14 03:00:00', '2023-03-14 03:00:00', '2023-03-22 18:44:57', '2023-03-22 18:44:57', 2, NULL, NULL, NULL, NULL, NULL),
(12, 'Clase5', '2023-03-15 03:00:00', '2023-03-15 03:00:00', '2023-03-24 05:30:41', '2023-03-24 05:30:41', 2, 1, 1, NULL, NULL, NULL),
(13, 'Clase6', '2023-03-16 03:00:00', '2023-03-16 03:00:00', '2023-03-24 05:32:08', '2023-03-24 05:32:08', 2, 1, 1, NULL, NULL, NULL),
(14, 'Clase6 xxx', '2023-04-16 03:00:00', '2023-04-18 03:00:00', '2023-03-24 05:32:15', '2023-04-13 00:19:39', 2, 1, 1, NULL, NULL, NULL),
(16, 'Clase10', '2023-03-14 03:00:00', '2023-03-14 03:00:00', '2023-03-24 05:35:11', '2023-03-24 05:35:11', 2, 1, 1, NULL, NULL, NULL),
(17, 'clase 29', '2023-03-29 03:00:00', '2023-03-29 03:00:00', '2023-03-29 16:32:10', '2023-03-29 16:32:10', 2, 1, 1, NULL, 'clase 29', NULL),
(18, 'clase 30', '2023-03-30 03:00:00', '2023-03-30 03:00:00', '2023-03-29 16:44:08', '2023-03-29 16:44:08', 2, 1, 1, NULL, 'clase 30', NULL),
(19, 'clase 30', '2023-03-30 03:00:00', '2023-03-30 03:00:00', '2023-03-29 16:44:09', '2023-03-29 16:44:09', 2, 1, 1, NULL, 'clase 30', NULL),
(20, 'clase 31', '2023-03-31 03:00:00', '2023-03-31 03:00:00', '2023-03-29 16:47:18', '2023-03-29 16:47:18', 2, 1, 1, NULL, 'clase 31', NULL),
(21, 'clase 28', '2023-03-28 03:00:00', '2023-03-28 03:00:00', '2023-03-30 01:43:20', '2023-03-30 01:43:20', 2, 1, 1, NULL, 'clase 28', NULL),
(22, 'clase 27', '2023-03-27 03:00:00', '2023-03-27 03:00:00', '2023-03-30 01:45:59', '2023-03-30 01:45:59', 2, 1, 1, NULL, 'clase 27', NULL),
(23, 'clase 26', '2023-03-26 03:00:00', '2023-03-26 03:00:00', '2023-03-30 01:47:00', '2023-03-30 01:47:00', 2, 1, 1, NULL, 'clase 26', NULL),
(24, 'clase 26', '2023-03-26 03:00:00', '2023-03-26 03:00:00', '2023-03-30 01:47:02', '2023-03-30 01:47:02', 2, 1, 1, NULL, 'clase 26', NULL),
(25, 'clase 27 bis', '2023-03-27 03:00:00', '2023-03-27 03:00:00', '2023-03-30 01:47:45', '2023-03-30 01:47:45', 2, 1, 1, NULL, 'claase 27 bis', NULL),
(29, 'clase 1 zzz aaa', '2023-03-01 03:00:00', '2023-03-01 03:00:00', '2023-03-31 15:28:04', '2023-03-31 15:28:04', 2, 1, 1, NULL, 'clase 1', NULL),
(30, 'clase 3', '2023-03-03 03:00:00', '2023-03-03 03:00:00', '2023-03-31 16:19:06', '2023-03-31 16:19:06', 2, 1, 1, NULL, 'clase 3', NULL),
(31, 'Clase5', '2023-04-05 03:00:00', '2023-04-05 03:00:00', '2023-04-13 01:15:46', '2023-04-13 01:15:46', 2, 1, 1, NULL, NULL, NULL),
(32, 'Clase6', '2023-04-05 03:00:00', '2023-04-05 03:00:00', '2023-04-13 01:16:19', '2023-04-13 01:16:19', 2, 1, 1, NULL, NULL, NULL),
(33, 'clase7', '2023-04-05 03:00:00', '2023-04-05 03:00:00', '2023-04-13 01:16:33', '2023-04-13 01:16:33', 2, 1, 1, NULL, NULL, NULL),
(34, 'clase 8', '2023-04-05 03:00:00', '2023-04-05 03:00:00', '2023-04-13 01:16:42', '2023-04-13 01:16:42', 2, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Category 1', 'category-1', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(2, NULL, 1, 'Category 2', 'category-2', '2023-01-26 00:06:02', '2023-01-26 00:06:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_curso` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caracteristicas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monto_comision` decimal(10,0) DEFAULT NULL,
  `precio_curso` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre_curso`, `caracteristicas`, `created_at`, `updated_at`, `monto_comision`, `precio_curso`) VALUES
(1, 'CURSO PREMIUN', '15 clases practicas + una clase teórica - Acompañamiento a sacar la licencia - Circuito especial a Corrientes', '2023-01-31 19:02:10', '2023-01-31 19:02:10', NULL, NULL),
(2, 'CURSO COMPLETO', '12 clases practicas + una clase teórica - Acompañamiento a sacar la licencia', '2023-01-31 19:02:49', '2023-01-31 19:02:49', NULL, NULL),
(3, 'CURSO BASICO', '10 clases practicas + una clase teórica', '2023-01-31 19:03:00', '2023-02-16 02:36:29', NULL, NULL),
(4, 'CIRCUITO ESPECIAL A CORRIENTES', NULL, '2023-02-16 02:37:43', '2023-02-16 02:37:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 9),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 12),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 15),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 10),
(22, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(23, 4, 'parent_id', 'select_dropdown', 'Parent', 0, 0, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(24, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(25, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 4),
(26, 4, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, NULL, 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, NULL, 2),
(31, 5, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, NULL, 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, NULL, 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, NULL, 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(48, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(56, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(57, 9, 'nombre_curso', 'text', 'Nombre Curso', 0, 1, 1, 1, 1, 1, '{}', 2),
(58, 9, 'duracion', 'text', 'Duracion', 0, 1, 1, 1, 1, 1, '{}', 3),
(59, 9, 'caracteristicas', 'text', 'Caracteristicas', 0, 1, 1, 1, 1, 1, '{}', 4),
(60, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(61, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(62, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(63, 10, 'nombre', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(64, 10, 'direccion', 'text', 'Direccion', 0, 1, 1, 1, 1, 1, '{}', 3),
(65, 10, 'mail', 'text', 'Mail', 0, 1, 1, 1, 1, 1, '{}', 4),
(66, 10, 'telefono', 'text', 'Telefono', 0, 1, 1, 1, 1, 1, '{}', 5),
(67, 10, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(68, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(69, 10, 'foto', 'image', 'Foto', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 8),
(70, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(71, 12, 'nombre', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(72, 12, 'direccion', 'text', 'Direccion', 0, 1, 1, 1, 1, 1, '{}', 3),
(73, 12, 'telefono', 'text', 'Telefono', 0, 1, 1, 1, 1, 1, '{}', 4),
(74, 12, 'mail', 'text', 'Mail', 0, 1, 1, 1, 1, 1, '{}', 5),
(75, 12, 'foto', 'image', 'Foto', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 6),
(76, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(77, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(78, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(79, 13, 'sucursal', 'text', 'Sucursal', 0, 1, 1, 1, 1, 1, '{}', 2),
(80, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(81, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(82, 17, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(83, 17, 'nombre', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(84, 17, 'foto', 'image', 'Foto', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 3),
(85, 17, 'telefono', 'text', 'Telefono', 0, 1, 1, 1, 1, 1, '{}', 4),
(86, 17, 'mail', 'text', 'Mail', 0, 1, 1, 1, 1, 1, '{}', 5),
(87, 17, 'cuil', 'text', 'Cuil', 0, 1, 1, 1, 1, 1, '{}', 6),
(88, 17, 'fecha_ingreso', 'date', 'Fecha Ingreso', 0, 1, 1, 1, 1, 1, '{}', 7),
(89, 17, 'categoria', 'select_dropdown', 'Categoria', 0, 1, 1, 1, 1, 1, '{\"default\":\"Instructor\",\"options\":{\"Instructor\":\"Instructor\",\"Admiistrativo\":\"Admiistrativo\",\"Otros\":\"Otros\"}}', 8),
(90, 17, 'estado', 'select_dropdown', 'Estado', 0, 1, 1, 1, 1, 1, '{\"default\":\"Alta\",\"options\":{\"Alta\":\"Alta\",\"Baja\":\"Baja\"}}', 9),
(91, 17, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 10),
(92, 17, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 11),
(111, 29, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(112, 29, 'id_curso', 'text', 'Id Curso', 0, 0, 0, 1, 1, 1, '{}', 2),
(113, 29, 'id_alumno', 'text', 'Id Alumno', 0, 0, 0, 1, 1, 1, '{}', 4),
(114, 29, 'id_sucursal', 'text', 'Id Sucursal', 0, 0, 0, 1, 1, 1, '{}', 6),
(115, 29, 'id_instructor', 'text', 'Id Instructor', 0, 0, 0, 1, 1, 1, '{}', 8),
(118, 29, 'id_vendedor', 'text', 'Id Vendedor', 0, 1, 1, 1, 1, 1, '{}', 14),
(119, 29, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 16),
(120, 29, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 17),
(121, 30, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(122, 30, 'fecha', 'date', 'Fecha', 0, 1, 1, 1, 1, 1, '{}', 2),
(123, 30, 'id_tipo_gasto', 'text', 'Id Tipo Gasto', 0, 0, 0, 1, 1, 1, '{}', 3),
(124, 30, 'importe', 'text', 'Importe', 0, 1, 1, 1, 1, 1, '{}', 5),
(125, 30, 'modalidad_pago', 'select_dropdown', 'Modalidad Pago', 0, 1, 1, 1, 1, 1, '{\"default\":\"Efectivo\",\"options\":{\"Efectivo\":\"Efectivo\",\"Transferencia\":\"Transferencia\",\"Tarjeta D\\u00e9bito\":\"Tarjeta D\\u00e9bito\",\"Tarjeta Cr\\u00e9dito\":\"Tarjeta Cr\\u00e9dito\"}}', 6),
(126, 30, 'id_vehiculo', 'text', 'Id Vehiculo', 0, 1, 1, 1, 1, 1, '{}', 7),
(127, 30, 'id_sucursal', 'text', 'Id Sucursal', 0, 0, 0, 1, 1, 1, '{}', 8),
(128, 30, 'id_alumno_curso', 'text', 'Id Alumno Curso', 0, 1, 1, 1, 1, 1, '{}', 10),
(129, 30, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 16),
(130, 30, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 15),
(131, 30, 'id_instructor', 'text', 'Id Instructor', 0, 0, 0, 1, 1, 1, '{}', 11),
(132, 30, 'descripcion', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 13),
(133, 31, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(134, 31, 'fecha', 'date', 'Fecha', 0, 1, 1, 1, 1, 1, '{}', 2),
(135, 31, 'importe', 'text', 'Importe', 0, 1, 1, 1, 1, 1, '{}', 3),
(136, 31, 'id_alumno_curso', 'text', 'Id Alumno Curso', 0, 1, 1, 1, 1, 1, '{}', 4),
(137, 31, 'modalidad_pago', 'text', 'Modalidad Pago', 0, 1, 1, 1, 1, 1, '{\"default\":\"Efectivo\",\"options\":{\"Efectivo\":\"Efectivo\",\"Transferencia\":\"Transferencia\",\"Tarjeta D\\u00e9bito\":\"Tarjeta D\\u00e9bito\",\"Tarjeta Cr\\u00e9dito\":\"Tarjeta Cr\\u00e9dito\"}}', 6),
(138, 31, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(139, 31, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(140, 32, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(141, 32, 'tipo1', 'text', 'Tipo1', 0, 1, 1, 1, 1, 1, '{}', 2),
(142, 32, 'tipo2', 'text', 'Tipo2', 0, 1, 1, 1, 1, 1, '{}', 3),
(143, 32, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(144, 32, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(145, 33, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(146, 33, 'dominio', 'text', 'Dominio', 0, 1, 1, 1, 1, 1, '{}', 2),
(147, 33, 'marca_modelo_anio', 'text', 'Marca Modelo Anio', 0, 1, 1, 1, 1, 1, '{}', 3),
(148, 33, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(149, 33, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(150, 29, 'alumnos_curso_belongsto_alumno_relationship', 'relationship', 'alumnos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Alumno\",\"table\":\"alumnos\",\"type\":\"belongsTo\",\"column\":\"id_alumno\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(151, 29, 'alumnos_curso_belongsto_instructore_relationship', 'relationship', 'instructores', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Instructore\",\"table\":\"instructores\",\"type\":\"belongsTo\",\"column\":\"id_instructor\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(152, 29, 'alumnos_curso_belongsto_empleado_relationship', 'relationship', 'empleados', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Empleado\",\"table\":\"empleados\",\"type\":\"belongsTo\",\"column\":\"id_vendedor\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 15),
(153, 29, 'alumnos_curso_belongsto_curso_relationship', 'relationship', 'cursos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Curso\",\"table\":\"cursos\",\"type\":\"belongsTo\",\"column\":\"id_curso\",\"key\":\"id\",\"label\":\"nombre_curso\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(154, 29, 'alumnos_curso_belongsto_sucursale_relationship', 'relationship', 'sucursales', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Sucursale\",\"table\":\"sucursales\",\"type\":\"belongsTo\",\"column\":\"id_sucursal\",\"key\":\"id\",\"label\":\"sucursal\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(155, 31, 'ingresos_curso_belongsto_alumnos_curso_relationship', 'relationship', 'alumnos_cursos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\AlumnosCurso\",\"table\":\"alumnos_cursos\",\"type\":\"belongsTo\",\"column\":\"id_alumno_curso\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"actividades_alumnos\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(156, 30, 'egresos_gasto_belongsto_tipos_gasto_relationship', 'relationship', 'tipos_gastos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\TiposGasto\",\"table\":\"tipos_gastos\",\"type\":\"belongsTo\",\"column\":\"id_tipo_gasto\",\"key\":\"id\",\"label\":\"tipo2\",\"pivot_table\":\"actividades_alumnos\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4),
(157, 30, 'egresos_gasto_belongsto_instructore_relationship', 'relationship', 'instructores', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Instructore\",\"table\":\"instructores\",\"type\":\"belongsTo\",\"column\":\"id_instructor\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"actividades_alumnos\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(158, 30, 'egresos_gasto_belongsto_vehiculo_relationship', 'relationship', 'vehiculos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Vehiculo\",\"table\":\"vehiculos\",\"type\":\"belongsTo\",\"column\":\"id_vehiculo\",\"key\":\"id\",\"label\":\"dominio\",\"pivot_table\":\"actividades_alumnos\",\"pivot\":\"0\",\"taggable\":\"0\"}', 14),
(159, 30, 'egresos_gasto_belongsto_sucursale_relationship', 'relationship', 'sucursales', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Sucursale\",\"table\":\"sucursales\",\"type\":\"belongsTo\",\"column\":\"id_sucursal\",\"key\":\"id\",\"label\":\"sucursal\",\"pivot_table\":\"actividades_alumnos\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(160, 29, 'id_vehiculo', 'text', 'Id Vehiculo', 0, 1, 1, 1, 1, 1, '{}', 10),
(161, 29, 'precio', 'text', 'Precio', 0, 1, 1, 1, 1, 1, '{}', 13),
(162, 29, 'alumnos_curso_belongsto_vehiculo_relationship', 'relationship', 'vehiculos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Vehiculo\",\"table\":\"vehiculos\",\"type\":\"belongsTo\",\"column\":\"id_vehiculo\",\"key\":\"id\",\"label\":\"marca_modelo_anio\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(163, 34, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(164, 34, 'clase', 'text', 'Clase', 0, 1, 1, 1, 1, 1, '{}', 3),
(165, 34, 'start_date', 'text', 'Start Date', 0, 1, 1, 1, 1, 1, '{}', 4),
(166, 34, 'end_date', 'text', 'End Date', 0, 1, 1, 1, 1, 1, '{}', 5),
(167, 34, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 1, '{}', 12),
(168, 34, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(169, 34, 'id_alumno_curso', 'text', 'Id Alumno Curso', 0, 1, 1, 1, 1, 1, '{}', 2),
(170, 34, 'id_vehiculo', 'text', 'Id Vehiculo', 0, 0, 0, 1, 1, 1, '{}', 6),
(171, 34, 'id_instructor', 'text', 'Id Instructor', 0, 0, 0, 1, 1, 1, '{}', 8),
(172, 34, 'asistencia', 'text', 'Asistencia', 0, 1, 1, 1, 1, 1, '{}', 10),
(173, 34, 'descripcion', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 11),
(174, 34, 'alumno_evento_belongsto_instructore_relationship', 'relationship', 'instructores', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Instructore\",\"table\":\"instructores\",\"type\":\"belongsTo\",\"column\":\"id_instructor\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(175, 34, 'alumno_evento_belongsto_vehiculo_relationship', 'relationship', 'vehiculos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Vehiculo\",\"table\":\"vehiculos\",\"type\":\"belongsTo\",\"column\":\"id_vehiculo\",\"key\":\"id\",\"label\":\"marca_modelo_anio\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(176, 35, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(177, 35, 'descripcion', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 2),
(178, 35, 'start_time', 'time', 'Start Time', 0, 1, 1, 1, 1, 1, '{}', 3),
(179, 35, 'end_time', 'time', 'End Time', 0, 1, 1, 1, 1, 1, '{}', 4),
(180, 35, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(181, 35, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(182, 12, 'monto_clase', 'text', 'Monto Clase', 0, 1, 1, 1, 1, 1, '{}', 9),
(183, 1, 'user_belongsto_sucursale_relationship', 'relationship', 'sucursales', 0, 1, 1, 1, 1, 0, '{\"model\":\"App\\\\Sucursale\",\"table\":\"sucursales\",\"type\":\"belongsTo\",\"column\":\"id_sucursal\",\"key\":\"id\",\"label\":\"sucursal\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 14),
(184, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 7),
(185, 1, 'id_sucursal', 'text', 'Id Sucursal', 0, 0, 0, 1, 1, 1, '{}', 13),
(186, 29, 'fecha_inscripcion', 'date', 'Fecha Inscripcion', 0, 1, 1, 1, 1, 1, '{}', 6),
(187, 29, 'activo', 'text', 'Activo', 0, 1, 1, 1, 1, 1, '{}', 12),
(188, 29, 'alumnos_curso_belongsto_franjas_horaria_relationship', 'relationship', 'franjas_horarias', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\FranjasHoraria\",\"table\":\"franjas_horarias\",\"type\":\"belongsTo\",\"column\":\"id_franja_horaria\",\"key\":\"id\",\"label\":\"descripcion\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 18),
(189, 29, 'id_franja_horaria', 'text', 'Id Franja Horaria', 0, 1, 1, 1, 1, 1, '{}', 13),
(190, 36, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(191, 36, 'id_vehiculo', 'text', 'Id Vehiculo', 0, 1, 1, 1, 1, 1, '{}', 2),
(192, 36, 'id_instructor', 'text', 'Id Instructor', 0, 1, 1, 1, 1, 1, '{}', 3),
(193, 36, 'id_franja_horaria', 'text', 'Id Franja Horaria', 0, 1, 1, 1, 1, 1, '{}', 4),
(194, 36, 'horario_belongsto_franjas_horaria_relationship', 'relationship', 'franjas_horarias', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\FranjasHoraria\",\"table\":\"franjas_horarias\",\"type\":\"belongsTo\",\"column\":\"id_franja_horaria\",\"key\":\"id\",\"label\":\"descripcion\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(195, 36, 'horario_belongsto_instructore_relationship', 'relationship', 'instructores', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Instructore\",\"table\":\"instructores\",\"type\":\"belongsTo\",\"column\":\"id_instructor\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(196, 36, 'horario_belongsto_vehiculo_relationship', 'relationship', 'vehiculos', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Vehiculo\",\"table\":\"vehiculos\",\"type\":\"belongsTo\",\"column\":\"id_vehiculo\",\"key\":\"id\",\"label\":\"marca_modelo_anio\",\"pivot_table\":\"alumno_evento\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(197, 36, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(198, 36, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'App\\Http\\Controllers\\voyager\\users_Controller', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-01-26 00:05:39', '2023-04-06 02:14:12'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, '', '', 1, 0, NULL, '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', 1, 0, NULL, '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, NULL, '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(9, 'cursos', 'cursos', 'Curso', 'Cursos', NULL, 'App\\Curso', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 16:25:52', '2023-01-31 16:25:52'),
(10, 'alumnos', 'alumnos', 'Alumno', 'Alumnos', NULL, 'App\\Alumno', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 16:27:13', '2023-04-05 16:23:17'),
(12, 'instructores', 'instructores', 'Instructore', 'Instructores', NULL, 'App\\Instructore', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 16:28:59', '2023-04-05 16:20:31'),
(13, 'sucursales', 'sucursales', 'Sucursale', 'Sucursales', NULL, 'App\\Sucursale', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(15, 'tipo_gasto', 'tipo-gasto', 'Tipo Gasto', 'Tipo Gastos', NULL, 'App\\TipoGasto', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(16, 'vehiculo', 'vehiculo', 'Vehiculo', 'Vehiculos', NULL, 'App\\Vehiculo', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(17, 'empleados', 'empleados', 'Empleado', 'Empleados', NULL, 'App\\Empleado', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 16:33:46', '2023-04-05 16:15:27'),
(22, 'alumnocurso', 'alumnocurso', 'Alumnocurso', 'Alumnocursos', NULL, 'App\\Alumnocurso', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(29, 'alumnos_cursos', 'alumnos-cursos', 'Alumnos Curso', 'Alumnos Cursos', NULL, 'App\\AlumnosCurso', NULL, 'App\\Http\\Controllers\\voyager\\Alumnos_CursosController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 17:48:38', '2023-04-12 02:38:26'),
(30, 'egresos_gastos', 'egresos-gastos', 'Egresos Gasto', 'Egresos Gastos', NULL, 'App\\EgresosGasto', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 17:53:01', '2023-01-31 22:56:25'),
(31, 'ingresos_cursos', 'ingresos-cursos', 'Ingresos Curso', 'Ingresos Cursos', NULL, 'App\\IngresosCurso', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-01-31 17:53:31', '2023-01-31 22:48:54'),
(32, 'tipos_gastos', 'tipos-gastos', 'Tipos Gasto', 'Tipos Gastos', NULL, 'App\\TiposGasto', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(33, 'vehiculos', 'vehiculos', 'Vehiculo', 'Vehiculos', NULL, 'App\\Vehiculo', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(34, 'alumno_evento', 'alumno-evento', 'Alumno Evento', 'Alumno Eventos', NULL, 'App\\AlumnoEvento', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-03-31 15:40:56', '2023-03-31 15:54:17'),
(35, 'franjas_horarias', 'franjas-horarias', 'Franjas Horaria', 'Franjas Horarias', NULL, 'App\\FranjasHoraria', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-03-31 18:11:03', '2023-03-31 18:23:01'),
(36, 'horarios', 'horarios', 'Horario', 'Horarios', NULL, 'App\\Horario', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-04-13 01:37:59', '2023-04-13 01:41:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos_gastos`
--

CREATE TABLE `egresos_gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_tipo_gasto` bigint(20) DEFAULT NULL,
  `importe` decimal(10,0) DEFAULT NULL,
  `modalidad_pago` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `id_sucursal` bigint(20) DEFAULT NULL,
  `id_vendedor` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_instructor` bigint(20) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `egresos_gastos`
--

INSERT INTO `egresos_gastos` (`id`, `fecha`, `id_tipo_gasto`, `importe`, `modalidad_pago`, `id_vehiculo`, `id_sucursal`, `id_vendedor`, `created_at`, `updated_at`, `id_instructor`, `descripcion`) VALUES
(1, '2023-01-31', 1, '800', 'Transferencia', NULL, 1, NULL, '2023-01-31 23:07:38', '2023-01-31 23:07:38', NULL, 'pago local Ctes enero 2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuil` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `categoria` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `foto`, `telefono`, `mail`, `cuil`, `fecha_ingreso`, `categoria`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Juan Perez', 'empleados\\April2023\\hK9slruD3qxf7yFNdnfa.png', '3624611111', 'jperez@gmail.com.ar', NULL, '2023-01-31', 'Admiistrativo', 'Alta', '2023-01-31 19:20:00', '2023-04-05 16:18:18'),
(2, 'Rosina Sandoval', 'empleados\\April2023\\IDMW0P8Ls2HSz9M14cRL.png', '3624622222', 'rosinasandoval@gmail.com.ar', NULL, '2023-01-31', 'Admiistrativo', 'Alta', '2023-01-31 22:59:00', '2023-04-05 16:17:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franjas_horarias`
--

CREATE TABLE `franjas_horarias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time DEFAULT '07:00:00',
  `end_time` time DEFAULT '21:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `franjas_horarias`
--

INSERT INTO `franjas_horarias` (`id`, `descripcion`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '7:00 a 8:30', '07:00:00', '08:30:00', '2023-03-31 18:12:00', '2023-03-31 18:29:09'),
(2, '8:30 a 10', '08:30:00', '10:00:00', '2023-03-31 18:29:00', '2023-03-31 18:30:03'),
(3, '10:00 a 11:30', '10:00:00', '11:30:00', '2023-03-31 18:30:38', '2023-03-31 18:30:38'),
(4, '11:30 a 13', '11:30:00', '13:00:00', '2023-03-31 18:31:20', '2023-03-31 18:31:20'),
(5, '13:00 a 14:30', '13:00:00', '14:30:00', '2023-03-31 18:32:00', '2023-03-31 18:33:01'),
(6, '14:30 a 16', '14:30:00', '16:00:00', '2023-03-31 18:33:46', '2023-03-31 18:33:46'),
(7, '16:00 a 17:30', '16:00:00', '17:30:00', '2023-03-31 18:34:15', '2023-03-31 18:34:15'),
(8, '17:30 a 19:00 (L-V)', '17:30:00', '19:00:00', '2023-03-31 18:34:00', '2023-03-31 18:43:14'),
(9, '19:00 a 20 (L-V)', '19:00:00', '20:00:00', '2023-03-31 18:42:00', '2023-03-31 18:43:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `id_instructor` bigint(20) DEFAULT NULL,
  `id_franja_horaria` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `id_vehiculo`, `id_instructor`, `id_franja_horaria`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-04-13 01:41:27', '2023-04-13 01:41:27'),
(2, 1, 1, 2, '2023-04-13 01:41:41', '2023-04-13 01:41:41'),
(3, 1, 1, 3, '2023-04-13 01:42:13', '2023-04-13 01:42:13'),
(4, 1, 1, 4, '2023-04-13 01:42:29', '2023-04-13 01:42:29'),
(5, 1, 2, 5, '2023-04-13 01:44:18', '2023-04-13 01:44:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_cursos`
--

CREATE TABLE `ingresos_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `importe` decimal(10,0) DEFAULT NULL,
  `id_alumno_curso` int(20) DEFAULT NULL,
  `modalidad_pago` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos_cursos`
--

INSERT INTO `ingresos_cursos` (`id`, `fecha`, `importe`, `id_alumno_curso`, `modalidad_pago`, `created_at`, `updated_at`) VALUES
(1, '2023-02-07', '10000', 1, 'Efectivo', '2023-02-14 21:26:33', '2023-02-14 21:26:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

CREATE TABLE `instructores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monto_clase` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `instructores`
--

INSERT INTO `instructores` (`id`, `nombre`, `direccion`, `telefono`, `mail`, `foto`, `created_at`, `updated_at`, `monto_clase`) VALUES
(1, 'Roberto', 'Av 25 de MAYO 1799', NULL, 'roberto@gmail.com.ar', 'instructores\\April2023\\R0CxdspRaehGS8Cljaep.png', '2023-01-31 22:57:00', '2023-04-05 16:21:24', NULL),
(2, 'Luis', 'Ruta NAcional 11 Km 1025', NULL, 'luis@gmail.com.ar', 'instructores\\April2023\\r43vA3QfBQyv2vt1eeQb.png', '2023-01-31 22:58:00', '2023-04-05 16:20:59', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-01-26 00:05:39', '2023-01-26 00:05:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2023-01-26 00:05:39', '2023-01-26 00:05:39', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 4, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 3, '2023-01-26 00:05:39', '2023-01-26 00:05:39', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2023-01-26 00:05:39', '2023-01-26 00:05:39', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 8, '2023-01-26 00:05:39', '2023-01-31 16:56:43', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 9, '2023-01-26 00:05:39', '2023-01-31 16:56:43', 'voyager.settings.index', NULL),
(11, 1, 'Categories', '', '_self', 'voyager-categories', NULL, NULL, 7, '2023-01-26 00:06:02', '2023-01-31 16:56:43', 'voyager.categories.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 5, '2023-01-26 00:06:02', '2023-01-31 16:56:43', 'voyager.posts.index', NULL),
(13, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 6, '2023-01-26 00:06:02', '2023-01-31 16:56:43', 'voyager.pages.index', NULL),
(16, 1, 'Cursos', '', '_self', NULL, NULL, 27, 2, '2023-01-31 16:25:53', '2023-01-31 16:58:10', 'voyager.cursos.index', NULL),
(17, 1, 'Alumnos', '', '_self', NULL, NULL, 27, 7, '2023-01-31 16:27:13', '2023-03-31 15:35:47', 'voyager.alumnos.index', NULL),
(19, 1, 'Instructores', '', '_self', NULL, NULL, 27, 4, '2023-01-31 16:28:59', '2023-03-31 15:35:47', 'voyager.instructores.index', NULL),
(20, 1, 'Sucursales', '', '_self', NULL, NULL, 27, 1, '2023-01-31 16:29:11', '2023-01-31 16:58:10', 'voyager.sucursales.index', NULL),
(23, 1, 'Empleados', '', '_self', NULL, NULL, 27, 5, '2023-01-31 16:33:47', '2023-03-31 15:35:47', 'voyager.empleados.index', NULL),
(27, 1, 'Tablas Básicas', '', '_self', NULL, '#000000', NULL, 10, '2023-01-31 16:57:39', '2023-01-31 16:58:08', NULL, ''),
(34, 1, 'Alumnos Cursos', '', '_self', NULL, NULL, NULL, 12, '2023-01-31 17:48:38', '2023-04-13 01:32:21', 'voyager.alumnos-cursos.index', NULL),
(35, 1, 'Egresos Gastos', '', '_self', NULL, NULL, 37, 1, '2023-01-31 17:53:01', '2023-01-31 17:54:13', 'voyager.egresos-gastos.index', NULL),
(36, 1, 'Ingresos Cursos', '', '_self', NULL, NULL, 37, 2, '2023-01-31 17:53:31', '2023-04-13 01:32:17', 'voyager.ingresos-cursos.index', NULL),
(37, 1, 'Tesoreria', '', '_self', NULL, '#000000', NULL, 11, '2023-01-31 17:54:00', '2023-04-13 01:32:21', NULL, ''),
(39, 1, 'Tipos Gastos', '', '_self', NULL, NULL, 27, 3, '2023-01-31 19:07:15', '2023-03-31 15:35:47', 'voyager.tipos-gastos.index', NULL),
(40, 1, 'Vehiculos', '', '_self', NULL, '#000000', 27, 6, '2023-01-31 19:13:16', '2023-03-31 15:35:47', 'voyager.vehiculos.index', 'null'),
(42, 1, 'Clases', '', '_self', NULL, '#000000', NULL, 13, '2023-03-31 15:40:56', '2023-04-13 01:32:21', 'voyager.alumno-evento.index', 'null'),
(43, 1, 'Informes', '', '_self', NULL, '#000000', NULL, 14, '2023-03-31 16:21:25', '2023-04-13 01:32:21', NULL, ''),
(44, 1, 'Informes ingresos', '/Informeingresos', '_self', NULL, '#000000', 43, 1, '2023-03-31 16:21:44', '2023-03-31 16:37:59', NULL, ''),
(45, 1, 'Informe Egresos', '/Informeegresos', '_self', NULL, '#000000', 43, 2, '2023-03-31 16:22:00', '2023-03-31 16:38:32', NULL, ''),
(46, 1, 'Comisiones', '/Informecomisiones', '_self', NULL, '#000000', 43, 3, '2023-03-31 16:22:57', '2023-03-31 16:40:41', NULL, ''),
(47, 1, 'Flujo financiero', '/informeflujofinanciero', '_self', NULL, '#000000', 43, 4, '2023-03-31 16:24:05', '2023-03-31 16:41:36', NULL, ''),
(48, 1, 'Franjas Horarias', '', '_self', NULL, NULL, 27, 8, '2023-03-31 18:11:03', '2023-04-13 01:32:21', 'voyager.franjas-horarias.index', NULL),
(49, 1, 'Horarios', '', '_self', NULL, NULL, NULL, 15, '2023-04-13 01:37:59', '2023-04-13 01:37:59', 'voyager.horarios.index', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2016_01_01_000000_create_pages_table', 2),
(26, '2016_01_01_000000_create_posts_table', 2),
(27, '2016_02_15_204651_create_categories_table', 2),
(28, '2017_04_11_000000_alter_post_nullable_fields_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2023-01-26 00:06:02', '2023-01-26 00:06:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(2, 'browse_bread', NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(3, 'browse_database', NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(4, 'browse_media', NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(5, 'browse_compass', NULL, '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(6, 'browse_menus', 'menus', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(7, 'read_menus', 'menus', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(8, 'edit_menus', 'menus', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(9, 'add_menus', 'menus', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(10, 'delete_menus', 'menus', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(11, 'browse_roles', 'roles', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(12, 'read_roles', 'roles', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(13, 'edit_roles', 'roles', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(14, 'add_roles', 'roles', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(15, 'delete_roles', 'roles', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(16, 'browse_users', 'users', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(17, 'read_users', 'users', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(18, 'edit_users', 'users', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(19, 'add_users', 'users', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(20, 'delete_users', 'users', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(21, 'browse_settings', 'settings', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(22, 'read_settings', 'settings', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(23, 'edit_settings', 'settings', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(24, 'add_settings', 'settings', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(25, 'delete_settings', 'settings', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(26, 'browse_categories', 'categories', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(27, 'read_categories', 'categories', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(28, 'edit_categories', 'categories', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(29, 'add_categories', 'categories', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(30, 'delete_categories', 'categories', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(31, 'browse_posts', 'posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(32, 'read_posts', 'posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(33, 'edit_posts', 'posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(34, 'add_posts', 'posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(35, 'delete_posts', 'posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(36, 'browse_pages', 'pages', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(37, 'read_pages', 'pages', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(38, 'edit_pages', 'pages', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(39, 'add_pages', 'pages', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(40, 'delete_pages', 'pages', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(51, 'browse_cursos', 'cursos', '2023-01-31 16:25:53', '2023-01-31 16:25:53'),
(52, 'read_cursos', 'cursos', '2023-01-31 16:25:53', '2023-01-31 16:25:53'),
(53, 'edit_cursos', 'cursos', '2023-01-31 16:25:53', '2023-01-31 16:25:53'),
(54, 'add_cursos', 'cursos', '2023-01-31 16:25:53', '2023-01-31 16:25:53'),
(55, 'delete_cursos', 'cursos', '2023-01-31 16:25:53', '2023-01-31 16:25:53'),
(56, 'browse_alumnos', 'alumnos', '2023-01-31 16:27:13', '2023-01-31 16:27:13'),
(57, 'read_alumnos', 'alumnos', '2023-01-31 16:27:13', '2023-01-31 16:27:13'),
(58, 'edit_alumnos', 'alumnos', '2023-01-31 16:27:13', '2023-01-31 16:27:13'),
(59, 'add_alumnos', 'alumnos', '2023-01-31 16:27:13', '2023-01-31 16:27:13'),
(60, 'delete_alumnos', 'alumnos', '2023-01-31 16:27:13', '2023-01-31 16:27:13'),
(66, 'browse_instructores', 'instructores', '2023-01-31 16:28:59', '2023-01-31 16:28:59'),
(67, 'read_instructores', 'instructores', '2023-01-31 16:28:59', '2023-01-31 16:28:59'),
(68, 'edit_instructores', 'instructores', '2023-01-31 16:28:59', '2023-01-31 16:28:59'),
(69, 'add_instructores', 'instructores', '2023-01-31 16:28:59', '2023-01-31 16:28:59'),
(70, 'delete_instructores', 'instructores', '2023-01-31 16:28:59', '2023-01-31 16:28:59'),
(71, 'browse_sucursales', 'sucursales', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(72, 'read_sucursales', 'sucursales', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(73, 'edit_sucursales', 'sucursales', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(74, 'add_sucursales', 'sucursales', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(75, 'delete_sucursales', 'sucursales', '2023-01-31 16:29:11', '2023-01-31 16:29:11'),
(76, 'browse_tipo_gasto', 'tipo_gasto', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(77, 'read_tipo_gasto', 'tipo_gasto', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(78, 'edit_tipo_gasto', 'tipo_gasto', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(79, 'add_tipo_gasto', 'tipo_gasto', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(80, 'delete_tipo_gasto', 'tipo_gasto', '2023-01-31 16:30:52', '2023-01-31 16:30:52'),
(81, 'browse_vehiculo', 'vehiculo', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(82, 'read_vehiculo', 'vehiculo', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(83, 'edit_vehiculo', 'vehiculo', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(84, 'add_vehiculo', 'vehiculo', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(85, 'delete_vehiculo', 'vehiculo', '2023-01-31 16:31:15', '2023-01-31 16:31:15'),
(86, 'browse_empleados', 'empleados', '2023-01-31 16:33:47', '2023-01-31 16:33:47'),
(87, 'read_empleados', 'empleados', '2023-01-31 16:33:47', '2023-01-31 16:33:47'),
(88, 'edit_empleados', 'empleados', '2023-01-31 16:33:47', '2023-01-31 16:33:47'),
(89, 'add_empleados', 'empleados', '2023-01-31 16:33:47', '2023-01-31 16:33:47'),
(90, 'delete_empleados', 'empleados', '2023-01-31 16:33:47', '2023-01-31 16:33:47'),
(111, 'browse_alumnocurso', 'alumnocurso', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(112, 'read_alumnocurso', 'alumnocurso', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(113, 'edit_alumnocurso', 'alumnocurso', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(114, 'add_alumnocurso', 'alumnocurso', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(115, 'delete_alumnocurso', 'alumnocurso', '2023-01-31 17:13:36', '2023-01-31 17:13:36'),
(136, 'browse_alumnos_cursos', 'alumnos_cursos', '2023-01-31 17:48:38', '2023-01-31 17:48:38'),
(137, 'read_alumnos_cursos', 'alumnos_cursos', '2023-01-31 17:48:38', '2023-01-31 17:48:38'),
(138, 'edit_alumnos_cursos', 'alumnos_cursos', '2023-01-31 17:48:38', '2023-01-31 17:48:38'),
(139, 'add_alumnos_cursos', 'alumnos_cursos', '2023-01-31 17:48:38', '2023-01-31 17:48:38'),
(140, 'delete_alumnos_cursos', 'alumnos_cursos', '2023-01-31 17:48:38', '2023-01-31 17:48:38'),
(141, 'browse_egresos_gastos', 'egresos_gastos', '2023-01-31 17:53:01', '2023-01-31 17:53:01'),
(142, 'read_egresos_gastos', 'egresos_gastos', '2023-01-31 17:53:01', '2023-01-31 17:53:01'),
(143, 'edit_egresos_gastos', 'egresos_gastos', '2023-01-31 17:53:01', '2023-01-31 17:53:01'),
(144, 'add_egresos_gastos', 'egresos_gastos', '2023-01-31 17:53:01', '2023-01-31 17:53:01'),
(145, 'delete_egresos_gastos', 'egresos_gastos', '2023-01-31 17:53:01', '2023-01-31 17:53:01'),
(146, 'browse_ingresos_cursos', 'ingresos_cursos', '2023-01-31 17:53:31', '2023-01-31 17:53:31'),
(147, 'read_ingresos_cursos', 'ingresos_cursos', '2023-01-31 17:53:31', '2023-01-31 17:53:31'),
(148, 'edit_ingresos_cursos', 'ingresos_cursos', '2023-01-31 17:53:31', '2023-01-31 17:53:31'),
(149, 'add_ingresos_cursos', 'ingresos_cursos', '2023-01-31 17:53:31', '2023-01-31 17:53:31'),
(150, 'delete_ingresos_cursos', 'ingresos_cursos', '2023-01-31 17:53:31', '2023-01-31 17:53:31'),
(151, 'browse_tipos_gastos', 'tipos_gastos', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(152, 'read_tipos_gastos', 'tipos_gastos', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(153, 'edit_tipos_gastos', 'tipos_gastos', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(154, 'add_tipos_gastos', 'tipos_gastos', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(155, 'delete_tipos_gastos', 'tipos_gastos', '2023-01-31 19:07:15', '2023-01-31 19:07:15'),
(156, 'browse_vehiculos', 'vehiculos', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(157, 'read_vehiculos', 'vehiculos', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(158, 'edit_vehiculos', 'vehiculos', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(159, 'add_vehiculos', 'vehiculos', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(160, 'delete_vehiculos', 'vehiculos', '2023-01-31 19:13:16', '2023-01-31 19:13:16'),
(161, 'browse_alumno_evento', 'alumno_evento', '2023-03-31 15:40:56', '2023-03-31 15:40:56'),
(162, 'read_alumno_evento', 'alumno_evento', '2023-03-31 15:40:56', '2023-03-31 15:40:56'),
(163, 'edit_alumno_evento', 'alumno_evento', '2023-03-31 15:40:56', '2023-03-31 15:40:56'),
(164, 'add_alumno_evento', 'alumno_evento', '2023-03-31 15:40:56', '2023-03-31 15:40:56'),
(165, 'delete_alumno_evento', 'alumno_evento', '2023-03-31 15:40:56', '2023-03-31 15:40:56'),
(166, 'browse_franjas_horarias', 'franjas_horarias', '2023-03-31 18:11:03', '2023-03-31 18:11:03'),
(167, 'read_franjas_horarias', 'franjas_horarias', '2023-03-31 18:11:03', '2023-03-31 18:11:03'),
(168, 'edit_franjas_horarias', 'franjas_horarias', '2023-03-31 18:11:03', '2023-03-31 18:11:03'),
(169, 'add_franjas_horarias', 'franjas_horarias', '2023-03-31 18:11:03', '2023-03-31 18:11:03'),
(170, 'delete_franjas_horarias', 'franjas_horarias', '2023-03-31 18:11:03', '2023-03-31 18:11:03'),
(171, 'browse_horarios', 'horarios', '2023-04-13 01:37:59', '2023-04-13 01:37:59'),
(172, 'read_horarios', 'horarios', '2023-04-13 01:37:59', '2023-04-13 01:37:59'),
(173, 'edit_horarios', 'horarios', '2023-04-13 01:37:59', '2023-04-13 01:37:59'),
(174, 'add_horarios', 'horarios', '2023-04-13 01:37:59', '2023-04-13 01:37:59'),
(175, 'delete_horarios', 'horarios', '2023-04-13 01:37:59', '2023-04-13 01:37:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts\\April2023\\nqs180lHBxu2cDAdHMxI.png', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-01-26 00:06:02', '2023-04-05 16:11:51'),
(2, 0, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(3, 0, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-01-26 00:06:02', '2023-01-26 00:06:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-01-26 00:05:39', '2023-01-26 00:05:39'),
(2, 'user', 'Normal User', '2023-01-26 00:05:39', '2023-01-26 00:05:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucursal`, `created_at`, `updated_at`) VALUES
(1, 'CORRIENTES', '2023-01-31 19:04:01', '2023-01-31 19:04:01'),
(2, 'RESISTENCIA', '2023-01-31 19:04:08', '2023-01-31 19:04:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_gastos`
--

CREATE TABLE `tipos_gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_gastos`
--

INSERT INTO `tipos_gastos` (`id`, `tipo1`, `tipo2`, `created_at`, `updated_at`) VALUES
(1, 'Gastos Fijos', 'Alquileres', '2023-01-31 19:08:00', '2023-01-31 19:09:17'),
(2, 'Gastos Fijos', 'Impuestos y Tasas', '2023-01-31 19:09:27', '2023-01-31 19:09:27'),
(3, 'Gastos Variables', 'Combustible', '2023-01-31 19:09:00', '2023-01-31 19:10:48'),
(4, 'Gastos Fijos', 'Sueldos', '2023-01-31 19:10:03', '2023-01-31 19:10:03'),
(5, 'Gastos Variables', 'Comisiones', '2023-01-31 19:10:20', '2023-01-31 19:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2023-01-26 00:06:02', '2023-01-26 00:06:02'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2023-01-26 00:06:02', '2023-01-26 00:06:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_sucursal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`, `id_sucursal`) VALUES
(1, 1, 'Admin', 'admin@admin.com', 'users\\April2023\\A41Zk3PrtElQ8xFXTbUQ.png', NULL, '$2y$10$iHyWHelu2ADcGiGiYDBMc.Hz5cZlrWe4xxwWjxg5yZ1y/yTL70lRq', 'MFOvDboZGIvvF2FN3yw3rBzEqgigbepndPJqru7YJIsx6Y74r1qA6mz5SD1z', '{\"locale\":\"es\"}', '2023-01-26 00:06:02', '2023-04-05 16:46:03', 1),
(2, 1, 'Marcos Roig', 'marcos@gmail.com', 'users\\April2023\\oUsw67Znj0fOZvw6jqkm.png', NULL, '$2y$10$50e0v0dxjAsux6Z1it7v8OCxaKgVjuwYWHeqBzMwuSS9HncJrJwLa', NULL, '{\"locale\":\"es\"}', '2023-04-05 16:47:53', '2023-04-06 03:58:59', 2),
(3, 1, 'Pato', 'pato@pato.com', 'users/default.png', NULL, '$2y$10$1kwi0Mvcwx7srthtkUtIzej3MNdBzmsQZYOw9QAnh8p37mwQyPJUm', NULL, '{\"locale\":\"es\"}', '2023-04-06 03:27:56', '2023-04-06 04:02:35', 2),
(4, 1, 'Papa Pitufo', 'papapitufo@loco.com', 'users/default.png', NULL, '$2y$10$YxrSBs3hOFhMqEarYDoTs.cxpa5PdAyGKmuY5TCVswHay31ov9vHC', NULL, '{\"locale\":\"es\"}', '2023-04-06 04:00:08', '2023-04-06 04:00:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dominio` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca_modelo_anio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `dominio`, `marca_modelo_anio`, `created_at`, `updated_at`) VALUES
(1, 'AF-352-5462', 'Toyota - Yaris -2022', '2023-01-31 19:14:59', '2023-01-31 19:14:59'),
(2, 'AF-300-6060', 'Toyota - Etios -2022', '2023-01-31 19:15:48', '2023-01-31 19:15:48'),
(3, 'Ac-400-5000', 'Toyota - Corola -2020', '2023-01-31 19:16:17', '2023-01-31 19:16:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos_cursos`
--
ALTER TABLE `alumnos_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumno_evento`
--
ALTER TABLE `alumno_evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indices de la tabla `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indices de la tabla `egresos_gastos`
--
ALTER TABLE `egresos_gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `franjas_horarias`
--
ALTER TABLE `franjas_horarias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos_cursos`
--
ALTER TABLE `ingresos_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instructores`
--
ALTER TABLE `instructores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_gastos`
--
ALTER TABLE `tipos_gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `alumnos_cursos`
--
ALTER TABLE `alumnos_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `alumno_evento`
--
ALTER TABLE `alumno_evento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `egresos_gastos`
--
ALTER TABLE `egresos_gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `franjas_horarias`
--
ALTER TABLE `franjas_horarias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ingresos_cursos`
--
ALTER TABLE `ingresos_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instructores`
--
ALTER TABLE `instructores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_gastos`
--
ALTER TABLE `tipos_gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
