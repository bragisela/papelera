-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2019 a las 05:32:12
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

drop database if exists dbpapel;
create database dbpapel;
use dbpapel;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpapel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCajaTotal` int(15) NOT NULL,
  `nroCaja` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `tipoMov` tinytext CHARACTER SET latin1 NOT NULL,
  `tipo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajatemporal`
--

CREATE TABLE `cajatemporal` (
  `idCaja` int(15) NOT NULL,
  `nroCaja` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `tipoMov` tinytext CHARACTER SET latin1 NOT NULL,
  `tipo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuit` varchar(13) NOT NULL,
  `condicionIVA` varchar(100) NOT NULL,
  `domicilioComercio` varchar(150) NOT NULL,
  `domicilioFiscal` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `cuit`, `condicionIVA`, `domicilioComercio`, `domicilioFiscal`) VALUES
(2, 'gisela', '23424324', 'responsable', 'homero', 'cabral'),
(3, 'julio', '23424324', 'responsable', 'suquia', 'cabral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `idComprobante` int(10) NOT NULL,
  `nroComprobante` varchar(30) NOT NULL,
  `IdCliPro` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `justificante` varchar(2) DEFAULT NULL,
  `totalcomprado` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL,
  `tempPago` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `totalComprado` int(10) NOT NULL,
  `totalVendido` int(10) NOT NULL,
  `idComprobante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `idItems` int(20) NOT NULL,
  `idComprobante` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `cant` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `codPermiso` int(10) NOT NULL,
  `codRol` int(10) UNSIGNED NOT NULL,
  `tipoAcceso` varchar(10) NOT NULL,
  `pagina` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--


INSERT INTO `permisos` (`codPermiso`, `codRol`, `tipoAcceso`, `pagina`) VALUES
(1, 1, '', 'clientesPHP'),
(2, 1, '', 'clientesModificarPHP'),
(3, 1, '', 'comprasBuscarPHP'),
(4, 1, '', 'historialPrecioPHP'),
(5, 1, '', 'pedidosBuscarPHP'),
(6, 1, '', 'precioModificarPHP'),
(7, 1, '', 'productosPHP'),
(8, 1, '', 'productosModificarPHP'),
(9, 1, '', 'ProveedoresPHP'),
(14, 1, '', 'reportesPHP'),
(59, 1, '', 'registroPedidosPHP'),
(92, 1, '', 'registroComprasPHP'),
(93, 1, '', 'precioUltimaCompraPHP'),
(94, 1, '', 'proveedoresModificarPHP'),
(100, 1, '', 'precioUltimaCompraModificarPHP'),
(101, 1, '', 'cajaPHP'),
(102, 1, '', 'cajaModificarPHP'),
(106, 1, '', 'reportesCajaPHP'),
(107, 1, '', 'reportesUtilidadPHP'),
(108, 1, '', 'detallePedidosPHP'),
(109, 2, '', 'inicioAdminPHP'),
(119, 1, '', 'detalleComprasPHP'),
(189, 1, '', 'reporteComprasPHP'),
(190, 1, '', 'reporteVentasPHP'),
(210, 1, '', 'modificarPedidoPHP'),
(220, 1, '', 'modificarCompraPHP'),
(221, 1, '', 'inicioSuperAdminPHP'),
(222, 2, '', 'clientesPHP'),
(223, 2, '', 'clientesModificarPHP'),
(224, 2, '', 'comprasBuscarPHP'),
(225, 2, '', 'historialPrecioPHP'),
(226, 2, '', 'pedidosBuscarPHP'),
(227, 2, '', 'precioModificarPHP'),
(228, 2, '', 'productosPHP'),
(229, 2, '', 'productosModificarPHP'),
(300, 2, '', 'ProveedoresPHP'),
(301, 2, '', 'reportesPHP'),
(302, 2, '', 'registroPedidosPHP'),
(303, 2, '', 'registroComprasPHP'),
(304, 2, '', 'precioUltimaCompraPHP'),
(305, 2, '', 'proveedoresModificarPHP'),
(306, 2, '', 'precioUltimaCompraModificarPHP'),
(307, 2, '', 'cajaPHP'),
(308, 2, '', 'cajaModificarPHP'),
(309, 2, '', 'reportesCajaPHP'),
(310, 2, '', 'reportesUtilidadPHP'),
(311, 2, '', 'detallePedidosPHP'),
(312, 2, '', 'detalleComprasPHP'),
(313, 2, '', 'reporteComprasPHP'),
(314, 2, '', 'reporteVentasPHP'),
(315, 2, '', 'modificarPedidoPHP'),
(317, 1, '', 'pagoProveedoresPHP'),
(318, 1, '', 'proveedoresComprobantesPHP'),
(319, 1, '', 'proveedoresPagosPHP'),
(320, 1, '', 'deudaClientesSAPHP'),
(321, 2, '', 'deudaClientesPHP'),
(322, 1, '', 'chequesPHP'),
(316, 2, '', 'modificarCompraPHP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `idPrecio` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `importe` float(10,2) NOT NULL,
  `porcDesc` float(10,2) NOT NULL,
  `porcUtil` float(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`

CREATE TABLE `proveedores` (
  `idProveedor` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuit` varchar(13) NOT NULL,
  `condicionIVA` varchar(150) NOT NULL,
  `domicilio` varchar(30) NOT NULL,
  `rete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `cuit`, `condicionIVA`, `domicilio`,`rete`) VALUES
(3, 'nehuen', '324', '243', 'rivadavia',1),
(4, 'tomito', '324', '243', 'suquia',0);

-- --------------------------------------------------------
--

CREATE TABLE `productos` (
  `idProducto` int(15) NOT NULL,
  `codProducto` varchar(14) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `material` varchar(10) NOT NULL,
  `unidadEmbalaje` int(10) NOT NULL,
  `medidas` varchar(20) NOT NULL,
  `unidadMedida` varchar(10) NOT NULL,
  `costoUni` decimal(10,2) NOT NULL,
  `idProveedor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `codProducto`, `descripcion`, `material`, `unidadEmbalaje`, `medidas`, `unidadMedida`, `costoUni`, `idProveedor`) VALUES
(1, '1231', 'aa', 'plastico', 12, '12', '1', '5.50',3),
(2, '123', 'bb', 'vidrio', 12, '12x34', 'as', '4.50',3),
(3, '105102NR', 'BANDEJA 102 NEGRA REFORZADA', 'PET', 400, '150X115X45', 'Caja', '0.00',3),
(4, '1055102', 'BANDEJA 102 PET (CRISTAL)\r\n', 'PET', 800, '150X115X45', 'Caja', '0.00',3),
(5, '1066102PP', 'BANDEJA 102 PP (MICROONDAS)\r\n', 'PP', 800, '150X115X45', 'Caja', '0.00',3),
(6, '105102NR', 'BANDEJA 102 NEGRA REFORZADA', 'PET', 400, '150X115X45', 'Caja', '0.00',3),
(7, '1055102', 'BANDEJA 102 PET (CRISTAL)', 'PET', 800, '150X115X45', 'Caja', '0.00',4),
(8, '1066102PP', 'BANDEJA 102 PP (MICROONDAS)', 'PP', 800, '150X115X45', 'Caja', '0.00',4),
(9, '106102C', 'BANDEJA 102 PP LIVIANA', 'PP', 800, '150X115X45', 'Caja', '0.00',4),
(10, '105103NR', 'BANDEJA 103 NEGRA REFORZADA', 'PET', 600, '138X178X45', 'Caja', '0.00',4),
(11, '1055103', 'BANDEJA 103 PET (CRISTAL)', 'PET', 800, '178X140X45', 'Caja', '0.00',4),
(12, '2', '222222', '', 0, '', '', '0.00',4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--



--
-- Estructura de tabla para la tabla `roles`
--
CREATE TABLE `roles` (
  `codRol` int(10) UNSIGNED NOT NULL,
  `nombreRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`codRol`, `nombreRol`) VALUES
(1, 'Superadministrador'),
(2, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `codRol` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasenia`, `codRol`) VALUES
(1, 'Superadmin', 'Superadmin', 1),
(2, 'admin', 'admin', 2);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilidad`
--

CREATE TABLE `utilidad` (
  `idUtilidad` int(11) NOT NULL,
  `tipo` varchar(2) NOT NULL,
  `comprobante` int(10) NOT NULL,
  `idProducto` int(15) NOT NULL,
  `impVenta` decimal(10,2) NOT NULL,
  `impCosto` decimal(10,2) NOT NULL,
  `impUtilidad` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pagos` (
  `idPago` int(10) UNSIGNED NOT NULL,
  `modoPago` varchar(50) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `plazo` datetime(6) NOT NULL,
  `idComprobante` int(10) NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cheques` (
  `idCheque` int(10) UNSIGNED NOT NULL,
  `modoPago` varchar(50) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `plazo` datetime(6) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCajaTotal`);

  ALTER TABLE `pagos`
    ADD PRIMARY KEY (`idPago`);

    ALTER TABLE `cheques`
      ADD PRIMARY KEY (`idCheque`);

--
-- Indices de la tabla `cajatemporal`
--
ALTER TABLE `cajatemporal`
  ADD PRIMARY KEY (`idCaja`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`idComprobante`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`idItems`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`codPermiso`),
  ADD KEY `codRol` (`codRol`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`idPrecio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`codRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `codRol` (`codRol`);

--
-- Indices de la tabla `utilidad`
--
ALTER TABLE `utilidad`
  ADD PRIMARY KEY (`idUtilidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCajaTotal` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `cajatemporal`
--
ALTER TABLE `cajatemporal`
  MODIFY `idCaja` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `idComprobante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `inventario`
ALTER TABLE `pagos`
  MODIFY `idPago` int(10) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `cheques`
    MODIFY `idCheque` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `inventario`
  MODIFY `idInventario` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `idItems` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `idPrecio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `codRol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `utilidad`
--
ALTER TABLE `utilidad`
  MODIFY `idUtilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idComprobante`) REFERENCES `comprobantes` (`idComprobante`);

ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idComprobante`) REFERENCES `comprobantes` (`idComprobante`);

ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`codRol`) REFERENCES `roles` (`codRol`);

  ALTER TABLE `productos`
    ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`codRol`) REFERENCES `roles` (`codRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
