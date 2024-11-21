-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2024 a las 19:19:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `makicop_mensajeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE `mensajeria` (
  `id` int(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo_solicitud` varchar(900) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `contacto` varchar(200) NOT NULL,
  `telefono` int(10) NOT NULL,
  `diligencia` varchar(500) NOT NULL,
  `observaciones` text NOT NULL,
  `estatus` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajeria`
--

INSERT INTO `mensajeria` (`id`, `fecha`, `tipo_solicitud`, `descripcion`, `contacto`, `telefono`, `diligencia`, `observaciones`, `estatus`) VALUES
(2, '2024-11-14 11:29:24', 'DEPOSITO BANCARIO', '     hola como estas prueb de fuego', 'Juan', 2147483647, 'Anselmo', '    paquete entregado jnijbnjbnijbjibnjbnilubnuij', 1),
(3, '2024-11-14 11:29:24', 'DEPOSITO BANCARIO', '     hola como estas', 'Juan', 2147483647, 'Anselmo', '    paquete entregado', 1),
(4, '2024-11-21 10:42:10', 'RECOLECTAR', '     jnhacskjhcioshciosn', '245234', 2147483647, 'jhdvkjfnvfofvni', '    kjdsfihfsdihfdios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `perfil` varchar(500) NOT NULL,
  `estatus` int(10) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`, `perfil`, `estatus`, `fecha_registro`) VALUES
(1, 'Ulises', 'a@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', '1', 1, '2024-11-14'),
(2, 'oliver', 'o@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', '2', 1, '2024-11-14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
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
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
