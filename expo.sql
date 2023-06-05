-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2023 a las 13:38:30
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `velocidad`
--

CREATE TABLE `velocidad` (
  `id` int(11) NOT NULL,
  `unixtime` int(11) NOT NULL,
  `RPM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `velocidad`
--

INSERT INTO `velocidad` (`id`, `unixtime`, `RPM`) VALUES
(595421, 1685710769, 100),
(595422, 1685710772, 150),
(595423, 1685712064, 200),
(595424, 1685712080, 220),
(595425, 1685712090, 250),
(595426, 1685712108, 280),
(595427, 1685712297, 290),
(595428, 1685712564, 300),
(595429, 1685712572, 310),
(595431, 1685712677, 320),
(595432, 1685712772, 330),
(595433, 1685712872, 340),
(595434, 1685712984, 350),
(595435, 1685713120, 360),
(595436, 1685714113, 380),
(595437, 1685716547, 390),
(595438, 1685716591, 400),
(595439, 1685716722, 410),
(595440, 1685716733, 420),
(595441, 1685719075, 450),
(595442, 1685719631, 480),
(595443, 1685719756, 470);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `velocidad`
--
ALTER TABLE `velocidad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `velocidad`
--
ALTER TABLE `velocidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595446;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
