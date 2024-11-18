-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 06:02:08
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duenios`
--

CREATE TABLE `duenios` (
  `id_duenio` int(11) NOT NULL,
  `nombre_duenio` varchar(50) NOT NULL,
  `apellido_duenio` varchar(50) NOT NULL,
  `email_duenio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `duenios`
--

INSERT INTO `duenios` (`id_duenio`, `nombre_duenio`, `apellido_duenio`, `email_duenio`) VALUES
(1, 'A', 'AB', 'ab@ab.com'),
(2, 'B', 'BB', 'bb@bb.com'),
(3, 'C', 'CC', 'cc@cc.com'),
(6, 'D', 'DD', 'dd@dd.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id_propiedad` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estado_propiedad` varchar(50) NOT NULL,
  `ambientes` int(2) NOT NULL,
  `duenio` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id_propiedad`, `direccion`, `estado_propiedad`, `ambientes`, `duenio`) VALUES
(3, 'hola 5436', 'venta', 100, 3),
(5, '9 de julio 800', 'alquiler', 5, 2),
(9, 'sdfsdf', 'venta', 2, 1),
(11, 'salta', 'venta', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`username`, `password`, `id_user`) VALUES
('webadmin', '$2y$10$N6zFV96GkkHa1bjd6GNoe.aGSWWXhr.5omuwFmqpFURCb6iJBdLb.', 1),
('webadmin', 'admin', 2),
('webadmin', 'admin', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `duenios`
--
ALTER TABLE `duenios`
  ADD PRIMARY KEY (`id_duenio`),
  ADD UNIQUE KEY `email_duenio` (`email_duenio`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id_propiedad`),
  ADD KEY `Usuario_FK` (`duenio`),
  ADD KEY `ID_Usuario` (`duenio`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `duenios`
--
ALTER TABLE `duenios`
  MODIFY `id_duenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id_propiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`duenio`) REFERENCES `duenios` (`ID_Duenio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
