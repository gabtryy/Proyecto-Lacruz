-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2025 a las 11:03:41
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
-- Base de datos: `proyecto_lacruz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `id_municipio`, `nombre`, `codigo_postal`) VALUES
(1, 1, 'Barquisimeto', '3001'),
(2, 2, 'Cabudare', '3023'),
(3, 3, 'Carora', '3050'),
(4, 4, 'Quíbor', '3060'),
(5, 5, 'San Felipe', '3201'),
(6, 6, 'Yaritagua', '3203'),
(7, 7, 'Nirgua', '3209'),
(8, 8, 'Cocorote', '3202'),
(9, 9, 'Valencia', '2001'),
(10, 10, 'Puerto Cabello', '2050'),
(11, 11, 'Guacara', '2015'),
(12, 12, 'Naguanagua', '2005'),
(13, 13, 'San Diego', '2010'),
(14, 14, 'Caracas', '1010'),
(15, 15, 'Coro', '4101'),
(16, 16, 'Punto Fijo', '4102'),
(17, 17, 'La Vela de Coro', '4103'),
(18, 18, 'Judibana', '4104'),
(19, 19, 'Pueblo Nuevo', '4105');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `rif` varchar(20) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`rif`, `cedula_usuario`, `id_direccion`, `nombre`, `apellido`, `telefono`, `correo`, `fecha_registro`) VALUES
('12345667', 30145565, 27, 'gabriel', 'perez', '2091491495', 'gav@gmail.com', '2025-06-14'),
('41241241', 41241241, 43, 'carlos', 'hurtado', '74127471247', 'carlo@gmail.com', '2025-06-18'),
('42531532', 41241241, 41, 'jangely', 'jangely', '45124124124', 'juan@gmail.com', '2025-06-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id_descuento` int(11) NOT NULL,
  `descuento` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_direccion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `calle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_direccion`, `id_estado`, `id_municipio`, `id_ciudad`, `calle`) VALUES
(25, 1, 2, 2, 'ruizpineda'),
(26, 3, 13, 13, 'gabriel'),
(27, 3, 13, 13, 'ruizpineda'),
(28, 1, 3, 3, 'ruiz'),
(36, 1, 4, 4, 'dfsfd'),
(37, 1, 1, 1, 'ruizpineda'),
(38, 1, 1, 1, 'ruizpineda'),
(39, 1, 1, 1, 'jooo'),
(40, 1, 1, 1, 'ppp'),
(41, 1, 1, 1, 'ggg'),
(42, 2, 8, 8, 'ttt'),
(43, 1, 1, 1, 'ttt'),
(46, 2, 8, 4, 'ruiz'),
(47, 2, 8, 1, 'ruiz'),
(48, 1, 4, 4, '4124'),
(49, 1, 4, 4, '12323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre`) VALUES
(1, 'Lara'),
(2, 'Yaracuy'),
(3, 'Carabobo'),
(4, 'Distrito Capital'),
(5, 'Falcón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `numero_orden` varchar(20) NOT NULL,
  `id_forma_pago` int(11) NOT NULL,
  `id_iva` int(11) NOT NULL,
  `total_iva` decimal(20,0) NOT NULL,
  `total_general` decimal(20,0) NOT NULL,
  `id_tasa` int(11) NOT NULL,
  `estado_pago` varchar(30) NOT NULL DEFAULT 'pendiente',
  `estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `rif`, `fecha`, `numero_orden`, `id_forma_pago`, `id_iva`, `total_iva`, `total_general`, `id_tasa`, `estado_pago`, `estatus`) VALUES
(7, '12345667', '2025-06-18', '0', 1, 1, 597, 515, 1, 'pendiente', 'presupuesto'),
(13, '41241241', '2025-06-18', '0', 1, 1, 525, 453, 1, 'pendiente', 'presupuesto'),
(14, '12345667', '2025-06-19', '0', 1, 1, 197, 170, 1, 'pendiente', 'presupuesto'),
(17, '12345667', '2025-06-19', '0', 1, 1, 580, 500, 1, 'pendiente', 'presupuesto'),
(18, '42531532', '2025-06-19', '0', 1, 1, 703, 606, 1, 'pendiente', 'presupuesto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_forma_pago` int(11) NOT NULL,
  `forma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id_forma_pago`, `forma`) VALUES
(1, 'contado'),
(2, 'credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva`
--

CREATE TABLE `iva` (
  `id_iva` int(11) NOT NULL,
  `porcentaje` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `iva`
--

INSERT INTO `iva` (`id_iva`, `porcentaje`) VALUES
(1, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `id_materia` int(11) NOT NULL,
  `id_provedores` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `medida` varchar(12) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `id_estado`, `nombre`) VALUES
(1, 1, 'Iribarren'),
(2, 1, 'Palavecino'),
(3, 1, 'Torres'),
(4, 1, 'Jiménez'),
(5, 2, 'San Felipe'),
(6, 2, 'Yaritagua'),
(7, 2, 'Nirgua'),
(8, 2, 'Cocorote'),
(9, 3, 'Valencia'),
(10, 3, 'Puerto Cabello'),
(11, 3, 'Guacara'),
(12, 3, 'Naguanagua'),
(13, 3, 'San Diego'),
(14, 4, 'Libertador'),
(15, 5, 'Miranda'),
(16, 5, 'Falcón'),
(17, 5, 'Colina'),
(18, 5, 'Los Taques'),
(19, 5, 'Carirubana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `precio_mayor` decimal(14,0) NOT NULL,
  `es_fabricado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `stock`, `precio`, `precio_mayor`, `es_fabricado`) VALUES
(2, 'jabon', 16, 12.00, 11, 0),
(3, 'cloro', 8, 12.00, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_det`
--

CREATE TABLE `producto_det` (
  `id_producto_det` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_materia`
--

CREATE TABLE `producto_materia` (
  `id_promat` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `id_direccion`, `nombre`, `telefono`, `correo`) VALUES
(12412412, 39, 'daniele', '04248786786', 'gav@gmail.com'),
(41242466, 49, 'gabriel', '1241241009', 'gav@gmail.com'),
(45345345, 48, 'preca', '4234234289', 'gab@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `tipo_usuario`) VALUES
(1, 'admin'),
(2, 'oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_consumo`
--

CREATE TABLE `servicio_consumo` (
  `id_consumo` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(15,3) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_det`
--

CREATE TABLE `servicio_det` (
  `id_servicio_det` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad` decimal(15,3) NOT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `servicio_det`
--

INSERT INTO `servicio_det` (`id_servicio_det`, `id_servicio`, `id_factura`, `cantidad`, `subtotal`) VALUES
(2, 6, 7, 5.000, 500.00),
(3, 5, 7, 3.000, 15.00),
(15, 4, 13, 11.000, 253.00),
(16, 6, 13, 2.000, 200.00),
(17, 5, 14, 14.000, 70.00),
(18, 6, 14, 1.000, 100.00),
(20, 6, 17, 5.000, 500.00),
(21, 6, 18, 6.000, 600.00),
(22, 8, 18, 6.000, 6.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasa_cambio`
--

CREATE TABLE `tasa_cambio` (
  `id_tasa` int(11) NOT NULL,
  `tasa_ust` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tasa_cambio`
--

INSERT INTO `tasa_cambio` (`id_tasa`, `tasa_ust`) VALUES
(1, '120');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_unidad_medida` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_base` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id_servicio`, `id_unidad_medida`, `nombre`, `descripcion`, `precio_base`) VALUES
(4, 4, 'pico', 'jar', 23.00),
(5, 4, 'limpieza de baños', 'limpieza', 5.00),
(6, 8, 'acarreo de esconbros', 'acarreo', 100.00),
(8, 2, 'recarga', 'recarga de botellones', 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medida`
--

CREATE TABLE `unidades_medida` (
  `id_unidad_medida` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `unidades_medida`
--

INSERT INTO `unidades_medida` (`id_unidad_medida`, `nombre`) VALUES
(2, 'Litro'),
(3, 'Metro'),
(4, 'Metros Cuadrados'),
(5, 'Metros Cubicos'),
(6, 'Unidad'),
(7, 'Pieza'),
(8, 'Hectarea'),
(9, 'Miligramo'),
(10, 'Microgramo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `clave` varchar(300) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `id_rol`, `username`, `clave`, `telefono`, `correo`) VALUES
(30145565, 1, 'jose', '123456', '04245003076', 'g@gmail.com'),
(30300300, 1, 'gab', '$2y$10$gwpagfW06NEG2.qZiNOAmOfhbyqnk0ay3KOSCsR7THqhuU3RiFxxm', '424124124', 'gabriel@gmail.com'),
(41241241, 2, 'carlos', '$2y$10$vwNGAE2v0hYFVGWfr1uJ/O8/rfziODH2654F1fkvl3DKDwcIdaZJ.', '942714912', 'daniel@gmail.com'),
(2147483647, 2, 'gabriel', '$2y$10$wigwjOA4g3eDc9Put70AxuDCjUpxaQZVfILSHSvvoh.R6KYe6ac2u', '04244324124', 'gav@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`rif`),
  ADD KEY `cedula_usuario` (`cedula_usuario`),
  ADD KEY `id_direccion` (`id_direccion`),
  ADD KEY `idx_cliente_rif` (`rif`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id_descuento`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_parroquia` (`id_ciudad`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_presupuesto` (`rif`),
  ADD KEY `idx_factura_fecha` (`fecha`),
  ADD KEY `factura_ibfk_2` (`id_tasa`),
  ADD KEY `id_forma_pago` (`id_forma_pago`),
  ADD KEY `id_iva` (`id_iva`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`id_iva`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_provedores` (`id_provedores`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_det`
--
ALTER TABLE `producto_det`
  ADD PRIMARY KEY (`id_producto_det`),
  ADD KEY `id_presupuesto` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto_materia`
--
ALTER TABLE `producto_materia`
  ADD PRIMARY KEY (`id_promat`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`),
  ADD KEY `id_direccion` (`id_direccion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicio_consumo`
--
ALTER TABLE `servicio_consumo`
  ADD PRIMARY KEY (`id_consumo`),
  ADD KEY `id_servicio_det` (`id_servicio`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `servicio_det`
--
ALTER TABLE `servicio_det`
  ADD PRIMARY KEY (`id_servicio_det`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `idx_servicio_det_presupuesto` (`id_factura`);

--
-- Indices de la tabla `tasa_cambio`
--
ALTER TABLE `tasa_cambio`
  ADD PRIMARY KEY (`id_tasa`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_unidad_medida` (`id_unidad_medida`);

--
-- Indices de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
  ADD PRIMARY KEY (`id_unidad_medida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `iva`
--
ALTER TABLE `iva`
  MODIFY `id_iva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto_det`
--
ALTER TABLE `producto_det`
  MODIFY `id_producto_det` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_materia`
--
ALTER TABLE `producto_materia`
  MODIFY `id_promat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45345346;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio_consumo`
--
ALTER TABLE `servicio_consumo`
  MODIFY `id_consumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_det`
--
ALTER TABLE `servicio_det`
  MODIFY `id_servicio_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tasa_cambio`
--
ALTER TABLE `tasa_cambio`
  MODIFY `id_tasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
  MODIFY `id_unidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cliente_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id_direccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_ibfk_3` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`rif`) REFERENCES `cliente` (`rif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_tasa`) REFERENCES `tasa_cambio` (`id_tasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`id_iva`) REFERENCES `iva` (`id_iva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD CONSTRAINT `materia_prima_ibfk_1` FOREIGN KEY (`id_provedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_det`
--
ALTER TABLE `producto_det`
  ADD CONSTRAINT `producto_det_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_det_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_materia`
--
ALTER TABLE `producto_materia`
  ADD CONSTRAINT `producto_materia_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia_prima` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_materia_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id_direccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_consumo`
--
ALTER TABLE `servicio_consumo`
  ADD CONSTRAINT `servicio_consumo_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_consumo_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `tipo_servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_det`
--
ALTER TABLE `servicio_det`
  ADD CONSTRAINT `servicio_det_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `tipo_servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_det_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD CONSTRAINT `tipo_servicio_ibfk_1` FOREIGN KEY (`id_unidad_medida`) REFERENCES `unidades_medida` (`id_unidad_medida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
