-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2019 a las 18:03:20
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

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
  `descripcion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCajaTotal`, `nroCaja`, `fecha`, `tipoMov`, `descripcion`, `importe`) VALUES
(1, 0, '2017-11-01', 'I', 'Movimiento inicial.', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajatemporal`
--

CREATE TABLE `cajatemporal` (
  `idCaja` int(15) NOT NULL,
  `nroCaja` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `tipoMov` tinytext CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cajatemporal`
--

INSERT INTO `cajatemporal` (`idCaja`, `nroCaja`, `fecha`, `tipoMov`, `descripcion`, `importe`) VALUES
(42, 0, '2019-08-29', 'I', '', '20.00'),
(43, 0, '2019-08-29', 'I', '', '20.00'),
(44, 0, '2019-08-29', 'I', '', '20.00'),
(45, 0, '2019-08-29', 'I', '', '20.00'),
(46, 0, '2019-08-29', 'I', '', '20.00'),
(47, 0, '2019-08-29', 'I', '', '20.00'),
(48, 0, '2019-08-30', 'I', '', '10.00'),
(49, 0, '2019-08-30', 'I', '6666', '10.00'),
(50, 0, '2019-08-30', 'I', '5666', '10.00'),
(51, 0, '2019-08-30', 'I', '56565', '10.00'),
(52, 0, '2019-08-30', 'I', '15151', '10.00'),
(53, 0, '2019-08-30', 'I', '222', '50.00'),
(54, 0, '2019-08-30', 'I', '333', '50.00'),
(55, 0, '2019-08-30', 'I', '333', '50.00'),
(56, 0, '2019-08-30', 'I', '444', '50.00'),
(57, 0, '2019-08-30', 'I', '555', '50.00'),
(58, 0, '2019-08-30', 'I', '666', '50.00'),
(59, 0, '2019-08-30', 'I', '777', '75.00'),
(60, 0, '2019-08-30', 'I', '777', '50.00'),
(61, 0, '2019-08-30', 'I', '888', '100.00'),
(62, 0, '2019-08-30', 'I', '888', '230.00'),
(63, 0, '2019-08-30', 'I', '999', '100.00'),
(64, 0, '2019-08-30', 'I', '9999', '125.00'),
(65, 0, '2019-08-30', 'I', '456456', '20.00'),
(66, 0, '2019-08-31', 'I', '45678', '20.00'),
(67, 0, '2019-08-31', 'I', '123456', '30.00');

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
(1, 'Facundo Muller', '20412026803', '21', 'suquia 2984', 'suquia2984');

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
  `totalcomprado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`idComprobante`, `nroComprobante`, `IdCliPro`, `fecha`, `tipo`, `justificante`, `totalcomprado`) VALUES
(1, '12', 2, '2019-03-28', 'C', NULL, '126.72'),
(2, '777', 1, '2019-03-28', 'C', NULL, '12250.00'),
(3, '112', 1, '2019-03-28', 'C', NULL, '12032.00'),
(4, '6', 2, '2019-06-10', 'C', NULL, '24.25'),
(5, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(6, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(7, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(8, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(9, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(10, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(11, '', 1, '2019-08-29', 'C', 'F', '20.00'),
(12, '', 1, '2019-08-29', 'C', 'F', '20.00'),
(13, '66666', 1, '2019-08-29', 'C', 'F', '20.00'),
(14, '', 1, '2019-08-29', 'C', 'F', '20.00'),
(15, '', 1, '2019-08-29', 'C', 'F', '64.35'),
(16, '', 1, '2019-08-29', 'C', 'F', '63.70'),
(17, '', 1, '2019-08-29', 'V', '', '20.00'),
(18, '', 1, '2019-08-29', 'V', '', '20.00'),
(19, '', 1, '2019-08-29', 'V', '', '20.00'),
(20, '', 1, '2019-08-29', 'V', '', '20.00'),
(21, '', 1, '2019-08-29', 'V', '', '20.00'),
(22, '', 1, '2019-08-29', 'V', '', '20.00'),
(23, '', 1, '2019-08-30', 'V', '', '10.00'),
(24, '6666', 1, '2019-08-30', 'V', 'F', '10.00'),
(25, '5666', 1, '2019-08-30', 'V', 'F', '10.00'),
(26, '56565', 1, '2019-08-30', 'V', 'F', '10.00'),
(27, '15151', 1, '2019-08-30', 'V', 'F', '10.00'),
(28, '222', 1, '2019-08-30', 'V', 'F', '50.00'),
(29, '333', 1, '2019-08-30', 'V', 'F', '50.00'),
(30, '333', 1, '2019-08-30', 'V', 'F', '50.00'),
(31, '444', 1, '2019-08-30', 'V', 'F', '50.00'),
(32, '555', 1, '2019-08-30', 'V', 'F', '50.00'),
(33, '666', 1, '2019-08-30', 'V', 'F', '50.00'),
(34, '777', 1, '2019-08-30', 'V', 'F', '75.00'),
(35, '777', 1, '2019-08-30', 'V', 'F', '50.00'),
(36, '888', 1, '2019-08-30', 'V', 'F', '100.00'),
(37, '888', 1, '2019-08-30', 'V', 'F', '230.00'),
(38, '999', 1, '2019-08-30', 'V', 'F', '100.00'),
(39, '9999', 1, '2019-08-30', 'V', 'F', '125.00'),
(40, '456456', 1, '2019-08-30', 'V', 'R', '20.00'),
(41, '45678', 1, '2019-08-31', 'V', 'F', '20.00'),
(42, '123456', 1, '2019-08-31', 'V', 'F', '30.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `totalComprado` int(10) NOT NULL,
  `totalVendido` int(10) NOT NULL
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

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`idItems`, `idComprobante`, `idProducto`, `fecha`, `cant`) VALUES
(1, 1, 68, '2019-03-28 23:15:00', 12),
(2, 2, 56, '2019-03-28 23:16:04', 12),
(3, 2, 65, '2019-03-28 23:16:04', 50),
(4, 2, 54, '2019-03-28 23:16:04', 200),
(5, 3, 102, '2019-03-28 23:17:54', 12),
(6, 3, 72, '2019-03-28 23:17:54', 50),
(7, 3, 66, '2019-03-28 23:17:54', 200),
(8, 4, 101, '2019-06-10 16:44:58', 5),
(9, 5, 3, '2019-08-29 14:11:43', 2),
(10, 6, 3, '2019-08-29 14:12:53', 2),
(11, 7, 3, '2019-08-29 14:13:12', 2),
(12, 8, 3, '2019-08-29 14:29:06', 2),
(13, 9, 3, '2019-08-29 14:29:25', 2),
(14, 10, 3, '2019-08-29 14:31:27', 2),
(15, 11, 3, '2019-08-29 14:31:49', 2),
(16, 12, 3, '2019-08-29 14:47:19', 2),
(17, 13, 3, '2019-08-29 14:48:53', 2),
(18, 14, 3, '2019-08-29 14:51:22', 2),
(19, 15, 3, '2019-08-29 14:52:27', 2),
(20, 15, 4, '2019-08-29 14:52:27', 3),
(21, 16, 3, '2019-08-29 14:54:47', 2),
(22, 16, 4, '2019-08-29 14:54:47', 3),
(23, 17, 3, '2019-08-29 22:21:34', 2),
(24, 18, 3, '2019-08-29 22:23:02', 2),
(25, 19, 3, '2019-08-29 22:25:24', 2),
(26, 20, 3, '2019-08-29 22:27:55', 2),
(27, 21, 3, '2019-08-29 22:37:36', 2),
(28, 22, 3, '2019-08-29 22:37:51', 2),
(29, 23, 3, '2019-08-30 07:07:47', 1),
(30, 24, 3, '2019-08-30 07:12:19', 1),
(31, 25, 3, '2019-08-30 07:14:16', 1),
(32, 26, 3, '2019-08-30 07:16:44', 1),
(33, 27, 3, '2019-08-30 07:38:12', 1),
(34, 28, 3, '2019-08-30 07:43:08', 2),
(35, 29, 3, '2019-08-30 07:47:21', 2),
(36, 29, 4, '2019-08-30 07:47:21', 2),
(37, 30, 3, '2019-08-30 07:54:09', 2),
(38, 31, 3, '2019-08-30 08:01:35', 2),
(39, 31, 4, '2019-08-30 08:01:35', 2),
(40, 32, 3, '2019-08-30 08:04:04', 2),
(41, 33, 3, '2019-08-30 08:06:00', 2),
(42, 33, 4, '2019-08-30 08:06:00', 2),
(43, 34, 3, '2019-08-30 08:08:17', 3),
(44, 34, 4, '2019-08-30 08:08:17', 3),
(45, 35, 3, '2019-08-30 13:32:59', 2),
(46, 35, 4, '2019-08-30 13:32:59', 2),
(47, 36, 3, '2019-08-30 22:37:46', 4),
(48, 37, 3, '2019-08-30 22:39:03', 17),
(49, 38, 3, '2019-08-30 22:41:25', 4),
(50, 38, 4, '2019-08-30 22:41:25', 4),
(51, 39, 3, '2019-08-30 22:44:19', 5),
(52, 39, 4, '2019-08-30 22:44:19', 5),
(53, 40, 3, '2019-08-30 22:51:17', 2),
(54, 41, 3, '2019-08-31 09:15:39', 2),
(55, 42, 4, '2019-08-31 12:17:13', 2);

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
(109, 1, '', 'inicioAdminPHP'),
(119, 1, '', 'detalleComprasPHP'),
(189, 1, '', 'reporteComprasPHP'),
(190, 1, '', 'reporteVentasPHP'),
(210, 1, '', 'modificarPedidoPHP'),
(220, 1, '', 'modificarCompraPHP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `idPrecio` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `importe` decimal(10,0) NOT NULL,
  `porcDesc` decimal(10,0) NOT NULL,
  `porcUtil` decimal(10,0) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`idPrecio`, `idProducto`, `importe`, `porcDesc`, `porcUtil`, `fecha`) VALUES
(1, 68, '12', '12', '0', '2019-03-28 23:15:00'),
(2, 56, '50', '0', '0', '2019-03-28 23:16:04'),
(3, 65, '100', '0', '0', '2019-03-28 23:16:04'),
(4, 54, '35', '5', '0', '2019-03-28 23:16:04'),
(5, 102, '50', '3', '0', '2019-03-28 23:17:54'),
(6, 72, '100', '4', '0', '2019-03-28 23:17:54'),
(7, 66, '35', '5', '0', '2019-03-28 23:17:54'),
(8, 101, '5', '3', '0', '2019-06-10 16:44:58'),
(9, 3, '10', '0', '0', '2019-08-30 01:20:58'),
(19, 4, '15', '1', '0', '2019-08-30 01:21:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(15) NOT NULL,
  `codProducto` varchar(14) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `material` varchar(10) NOT NULL,
  `unidadEmbalaje` int(10) NOT NULL,
  `medidas` varchar(20) NOT NULL,
  `unidadMedida` varchar(10) NOT NULL,
  `costoUni` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `codProducto`, `descripcion`, `material`, `unidadEmbalaje`, `medidas`, `unidadMedida`, `costoUni`) VALUES
(1, '1231', 'aa', 'plastico', 12, '12', '1', NULL),
(2, '123', 'bb', 'vidrio', 12, '12x34', 'as', NULL),
(3, '105102NR', 'BANDEJA 102 NEGRA REFORZADA', 'PET', 400, '150X115X45', 'Caja', '7.00'),
(4, '1055102', 'BANDEJA 102 PET (CRISTAL)\r\n', 'PET', 800, '150X115X45', 'Caja', '14.70'),
(5, '1066102PP', 'BANDEJA 102 PP (MICROONDAS)\r\n', 'PP', 800, '150X115X45', 'Caja', NULL),
(6, '105102NR', 'BANDEJA 102 NEGRA REFORZADA', 'PET', 400, '150X115X45', 'Caja', NULL),
(7, '1055102', 'BANDEJA 102 PET (CRISTAL)', 'PET', 800, '150X115X45', 'Caja', '7.00'),
(8, '1066102PP', 'BANDEJA 102 PP (MICROONDAS)', 'PP', 800, '150X115X45', 'Caja', NULL),
(9, '106102C', 'BANDEJA 102 PP LIVIANA', 'PP', 800, '150X115X45', 'Caja', NULL),
(10, '105103NR', 'BANDEJA 103 NEGRA REFORZADA', 'PET', 600, '138X178X45', 'Caja', NULL),
(11, '1055103', 'BANDEJA 103 PET (CRISTAL)', 'PET', 800, '178X140X45', 'Caja', NULL),
(12, '106103C', 'BANDEJA 103 PP  LIVIANA', 'PP', 800, '178X140X45', 'Caja', NULL),
(13, '1066103PP', 'BANDEJA 103 PP (MICROONDAS)', 'PP', 800, '178X140X45', 'Caja', NULL),
(14, '105105N', 'BANDEJA 105 NEGRA REFORZADA ', 'PET', 400, '240X170X40', 'Caja', NULL),
(15, '105105', 'BANDEJA 105 PET (CRISTAL)', 'PET', 400, '240X170X40', 'Caja', NULL),
(16, '106105PP', 'BANDEJA 105 PP (MICROONDAS)', 'PP', 400, '240X170X40', 'Caja', NULL),
(17, '106105C', 'BANDEJA 105 PP LIVIANA', 'PP', 400, '240X170X40', 'Caja', NULL),
(18, '105143', 'ESTUCHE 143 PET', 'PET', 200, '185X150X55', 'Caja', NULL),
(19, '106143PP', 'ESTUCHE 143 PP', 'PP', 200, '185X150X55', 'Caja', NULL),
(20, '105EP50085', 'ESTUCHE CLAMSHELL 500-85 PERF.', 'PET', 504, '190X115X85', 'Caja', NULL),
(22, '1055107PRO', 'BANDEJA 107 PROF. PET (CRISTAL)', 'PET', 400, '260X190X50', 'Caja', NULL),
(23, '10503', ' ESTUCHES PET (CRISTAL)', '', 0, '', '', NULL),
(24, '105132', 'ESTUCHE 132 PET (CRISTAL)', 'A PET', 400, '120X165X85', 'Caja', NULL),
(25, '105133', 'ESTUCHE 133', 'PET', 200, '185X145X85', 'Caja', NULL),
(26, '105134', 'ESTUCHE 134 PET', 'PET', 200, '170X170X85', 'Caja', NULL),
(27, '105136', 'ESTUCHE 136 PET', 'PET', 200, '230X195X65', 'Caja', NULL),
(28, '105141', 'ESTUCHE 141 PET', 'PET', 1000, '115X90X55', 'Caja', NULL),
(29, '105142', 'ESTUCHE 142 PET', 'PET', 400, '165X120X55', 'Caja', NULL),
(30, '105144', 'ESTUCHE 144 PET', 'PET', 200, '170X170X53', 'Caja', NULL),
(31, '105144B', 'ESTUCHE 144 PET BAJO', 'PET', 200, '170X170X43', 'Caja', NULL),
(32, '105145', 'ESTUCHE 145 PET', 'PET', 200, '255X185X70', 'Caja', NULL),
(33, '105146', 'ESTUCHE 146 PET', 'PET', 200, '225X200X65', 'Caja', NULL),
(34, '105147', 'ESTUCHE 147 PET', 'PET', 200, '270X205X75', 'Caja', NULL),
(35, '105161', 'ESTUCHE 161 PET', 'PET', 1000, '115X90X40', 'Caja', NULL),
(36, '1055TS', 'TRIANGULO P/SANDWICH  PET (CRISTAL)', 'PET', 375, '180X70X78', 'Caja', NULL),
(38, '105107PRONR', 'BANDEJA 107 NEGRA REFORZADA', 'PET', 400, '260X190X50', 'Caja', NULL),
(39, '105154PN', 'BANDEJA 154 PET NEGRO', 'PET', 400, '200X160X43', 'Caja', NULL),
(40, '1052115D', 'BANDEJA 211 4 DIV C/CUB BLANCA', 'PET', 400, '280X200X25', 'Caja', NULL),
(42, '105500BYT', 'CONJUNTO DE 1/2 COSTILLA EN PET', 'PET', 200, '255X180X55', 'Caja', NULL),
(44, '105T25BT6R', 'CONJ TORTERA BASE NEG PET Y TAPA', 'PET', 50, 'DIAM 260X60', 'Caja', NULL),
(45, '105T25BT10R', 'CONJ TORTERA BASE NEGRA PET Y TAPA', 'PET', 50, 'DIAM 260X100', 'Caja', NULL),
(46, '105T25BT13R', 'CONJ TORTERA BASE NEGRA PET Y TAPA', 'PET', 50, 'DIAM 260X130', 'Caja', NULL),
(47, '105T22BTP11', 'CONJ TORTERA BASE NEGRA Y TAPA PET', 'PET', 120, 'DIAM 220X110', 'Caja', NULL),
(48, '105T29BTP13', 'CONJ TORTERA BASE NEGRA Y TAPA PET', 'PET', 75, 'DIAM 290X130', 'Caja', NULL),
(50, '105461P', 'ESTUCHE MULTIPROPOSITO X 1000ML', 'PET', 200, '185X165X65', 'Caja', NULL),
(51, '105460B', 'ESTUCHE MULTIPROPOSITO X 250ML', 'PET', 600, '145X125X35', 'Caja', NULL),
(52, '105460M', 'ESTUCHE MULTIPROPOSITO X 380ML', 'PET', 600, '145X125X50', 'Caja', NULL),
(53, '105460P', 'ESTUCHE MULTIPROPOSITO X 500ML', 'PET', 600, '145X125X65', 'Caja', NULL),
(54, '105461B', 'ESTUCHE MULTIPROPOSITO X 500ML', 'PET', 200, '185X165X35', 'Caja', NULL),
(55, '105461M', 'ESTUCHE MULTIPROPOSITO X 750ML', 'PET', 200, '185X165X50', 'Caja', NULL),
(56, '10510 ENSALA', 'DERAS PET', '', 0, '', '', NULL),
(57, '105445B', 'BASE ENSALADERA 1050 ML', 'PET', 600, '190X190X65', 'Caja', NULL),
(58, '105444B', 'BASE ENSALADERA 750 ML', 'PET', 600, '172X172X50', 'Caja', NULL),
(59, '105445T', 'TAPA ENSALADERA 1050 ML', 'PET', 600, '190X190X25', 'Caja', NULL),
(60, '105444T', 'TAPA ENSALADERA 750 ML', 'PET', 600, '172X172X20', 'Caja', NULL),
(61, '10511 POTES', 'CRISTALOCK', '', 0, '', '', NULL),
(62, '105250CL', 'POTE CRISTALOCK 250 ML', 'PET', 300, '155X140X50', 'Caja', NULL),
(63, '105375CL', 'POTE CRISTALOCK 375 ML', 'PET', 300, '155X140X66', 'Caja', NULL),
(64, '105500CL', 'POTE CRISTALOCK 500 ML', 'PET', 300, '155X140X84', 'Caja', NULL),
(65, '10514 LINEA', 'PET PROMO', '', 0, '', '', NULL),
(66, '105102PROM', 'BANDEJA 102 PET PROMOCION', 'PET', 28800, '112X150X45', 'PAL', NULL),
(67, '105103PROM', 'BANDEJA 103 PET PROMOCION', 'PET', 24000, '178X138X45', 'PAL', NULL),
(68, '105105PROM', 'BANDEJA 105 PET PROMOCION', 'PET', 16000, '170X240X40', 'PAL', NULL),
(69, '105143PROM', 'ESTUCHE 143 PET PROMOCION', 'PET', 5400, '186X150X55', 'PAL', NULL),
(70, 'EP50085PROM', 'ESTUCHE CLAMSHELL 500-85 PERF. PROM', 'PET', 6048, '190X115X85', 'PAL', NULL),
(71, '10515 LINEA', '100 PET COLOR PROMO', '', 0, '', '', NULL),
(72, '105102NPROM', 'BANDEJA 102 PET NEGRA PROMOCION', 'PET', 14400, '112X150X45', 'PAL', NULL),
(73, '105103NPROM', 'BANDEJA 103 PET NEGRA PROMOCION', 'PET', 12000, '178X138X45', 'PAL', NULL),
(74, '105105NPROM', 'BANDEJA 105 PET NEGRA PROMOCION', 'PET', 8000, '170X240X40', 'PAL', NULL),
(75, '10601 LINEA', '100 PP (MICROONDAS)', '', 0, '', '', NULL),
(76, '106104PP', 'BANDEJA 104 PP (MICROONDAS)', 'PP', 600, '162X162X45', 'Caja', NULL),
(77, '106105R', 'BANDEJA 105 PP RECTANGULAR (MICRO)', 'PP', 600, '175X225X45', 'Caja', NULL),
(78, '1066107PRO', 'BANDEJA 107 PROF. PP (MICROONDAS)', 'PP', 400, '260X190X50', 'Caja', NULL),
(79, '10603 ESTUCH', 'ES DE POLIPROPILENO (MICROONDAS)', '', 0, '', '', NULL),
(80, '106133PP', 'ESTUCHE 133 PP', 'PP', 200, '185X145X85', 'Caja', NULL),
(81, '106136PP', 'ESTUCHE 136 PP', 'PP', 200, '230X195X65', 'Caja', NULL),
(82, '106142PP', 'ESTUCHE 142 PP', 'PP', 400, '165X120X55', 'Caja', NULL),
(83, '106144PP', 'ESTUCHE 144 PP', 'PP', 200, '170X170X53', 'Caja', NULL),
(84, '106145PP', 'ESTUCHE 145 PP', 'PP', 200, '255X185X70', 'Caja', NULL),
(85, '1061463D', 'ESTUCHE 146 3 DIV. PP', 'PP', 200, '225X195X45', 'Caja', NULL),
(86, '106146PP', 'ESTUCHE 146 PP', 'PP', 200, '225X200X65', 'Caja', NULL),
(87, '106147PP', 'ESTUCHE 147 PP', 'PP', 200, '270X205X75', 'Caja', NULL),
(88, '10605 BANDEJ', 'AS P/POLLO(MICROONDAS)', '', 0, '', '', NULL),
(89, '106158BYTP', 'CONJ.POLLERA BASE PP/TAPA BOPS PERF', 'PP+BOPS', 100, '190X260X135', 'Caja', NULL),
(90, '10606 LINEA', '100 PP LIVIANA', '', 0, '', '', NULL),
(91, '106105RC', 'BANDEJA 105 PP RECTANGULAR LIVIANA', 'PP', 800, '175X225X45', 'Caja', NULL),
(92, '10607 ENVASE', 'S P/COMIDAS PREPARADAS', '', 0, '', '', NULL),
(93, '106153BYT', 'CONJUNTO BASE Y TAPA 153', 'PP+BOPS', 200, '195X155X35', 'Caja', NULL),
(94, '106500BYT', 'CONJUNTO DE 1/2 COSTILLA', 'PP+BOPS', 200, '255X180X55', 'Caja', NULL),
(95, '106501BYT', 'CONJUNTO DE COSTILLA', 'PP+BOPS', 100, '420X180X55', 'Caja', NULL),
(96, '10608 PLATOS', 'PP', '', 0, '', '', NULL),
(97, '1066PLCCOTO', 'PLATO CUADRADO PP', 'PP', 400, '209X209X16', 'Caja', NULL),
(98, '10610 BOWLS', 'PP', '', 0, '', '', NULL),
(99, '106445B', 'BOWL PP 1050 ML', 'PP', 400, '190X190X65', 'Caja', NULL),
(100, '106444B', 'BOWL PP 750 ML', 'PP', 400, '172X172X50', 'Caja', NULL),
(101, '104445T', 'TAPA BOWL 1050 ML', 'BOPS', 400, '190X190X25', 'Caja', NULL),
(102, '104444T', 'TAPA BOWL 750 ML', 'BOPS', 400, '172X172X20', 'Caja', NULL),
(103, '10611 LINEA', 'PP PROMO', '', 0, '', '', NULL),
(104, '106102CPROM', 'BANDEJA 102 PP LIVIANA PROMOCION', 'PP', 28800, '112X150X45', 'PAL', NULL),
(105, '106102PROM', 'BANDEJA 102 PP PROMOCION', 'PP', 28800, '112X150X45', 'PAL', NULL),
(106, '106103CPROM', 'BANDEJA 103 PP LIVIANA PROMOCION', 'PP', 24000, '178X138X45', 'PAL', NULL),
(107, '106103PROM', 'BANDEJA 103 PP PROMOCION', 'PP', 24000, '178X138X45', 'PAL', NULL),
(108, '106105CPROM', 'BANDEJA 105 PP LIVIANA PROMOCION', 'PP', 16000, '170*240*40', 'PAL', NULL),
(109, '106105PROM', 'BANDEJA 105 PP PROMOCION', 'PP', 16000, '170X240X40', 'PAL', NULL),
(110, '106143PROM', 'ESTUCHE 143 PP PROMOCION', 'PP', 5400, '185*150*55', 'PAL', NULL),
(111, '10701 LINEA', '100 PSAI.', '', 0, '', '', NULL),
(112, '1077101DP', 'BANDEJA 101', 'PSAI', 1400, '90X90X45', 'Caja', NULL),
(113, '10704 BANDEJ', 'AS P/CATERING PSAI.', '', 0, '', '', NULL),
(114, '1072213DCC', 'BANDEJA 221 3 D C/CUBIERTERA', 'PSAI', 800, '200X190X25', 'Caja', NULL),
(115, '11001 BANDEJ', 'AS STD BLANCAS', '', 0, '', '', NULL),
(116, '1104H', 'BAND. HAMBURGUESA CRUDA', 'PSE', 400, '238X130X22', 'Bulto', NULL),
(117, '110615', 'BANDEJA 615', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(118, '110617', 'BANDEJA 617', 'PSE', 600, '140X140X20', 'Bulto', NULL),
(119, '110618', 'BANDEJA 618', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(120, '110618EA', 'BANDEJA 618 ENVASADO AUTOMAT', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(121, '110619', 'BANDEJA 619', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(122, '110620', 'BANDEJA 620', 'PSE', 600, '225X150X10', 'Bulto', NULL),
(123, '110621', 'BANDEJA 621', 'PSE', 600, '190X140X20', 'Bulto', NULL),
(124, '110BP53', 'BANDEJA BP53', 'PSE', 400, '120X190X25', 'Bulto', NULL),
(125, '11002 BANDEJ', 'AS GRANDES', '', 0, '', '', NULL),
(126, '1102115D', 'BANDEJA 211 5 DIVISIONES PSE', 'PSE', 200, '307X227X28', 'Bulto', NULL),
(127, '112623AR/3', 'BANDEJA 623 AMARIL REF X 300', 'PSE', 300, '200X292X15', 'Bulto', NULL),
(128, '112623N', 'BANDEJA 623 NEGRA', 'PSE', 300, '200X292X15', 'Bulto', NULL),
(129, '110623300', 'BANDEJA 623 POR 300', 'PSE', 300, '200X292X15', 'Bulto', NULL),
(130, '110623300R', 'BANDEJA 623 REFORZADA 300', 'PSE', 300, '200X292X15', 'Bulto', NULL),
(131, '110625', 'BANDEJA 625', 'PSE', 300, '215X305X25', 'Bulto', NULL),
(132, '112625N', 'BANDEJA 625 NEGRA', 'PSE', 300, '305X215X25', 'Bulto', NULL),
(133, '112625RJ', 'BANDEJA 625 ROJA', 'PSE', 300, '305X215X25', 'Bulto', NULL),
(134, '110628', 'BANDEJA 628', 'PSE', 200, 'DIAM 322X15', 'Bulto', NULL),
(135, '110630', 'BANDEJA 630', 'PSE', 200, '290X250X20', 'Bulto', NULL),
(136, '110640', 'BANDEJA 640', 'PSE', 200, '310X280X25', 'Bulto', NULL),
(137, '110650', 'BANDEJA 650', 'PSE', 200, '350X250X25', 'Bulto', NULL),
(138, '112650A', 'BANDEJA 650 AMARILLA', 'PSE', 200, '351X249X25', 'Bulto', NULL),
(139, '112650N', 'BANDEJA 650 NEGRA', 'PSE', 200, '350X250X25', 'Bulto', NULL),
(140, '110690', 'BANDEJA 690 P/PARRILLADA', 'PSE', 100, '405X305X35', 'Bulto', NULL),
(141, '112690N', 'BANDEJA 690 P/PARRILLADA NEGRA', 'PSE', 100, '405x305x35', 'Bulto', NULL),
(142, '11003 BANDEJ', 'AS PROFUNDAS', '', 0, '', '', NULL),
(143, '110619P', 'BANDEJA 619 PROFUNDA', 'PSE', 300, '185X235X30', 'Bulto', NULL),
(144, '112700', 'BANDEJA 700', 'PSE', 300, '250X170X50', 'Bulto', NULL),
(145, '112700N', 'BANDEJA 700 NEGRO', 'PSE', 300, '250X170X50', 'Bulto', NULL),
(146, '112732A', 'BANDEJA 732 AMARILLA', 'PSE', 300, '190X160X50', 'Bulto', NULL),
(147, '112732', 'BANDEJA PROFUNDA 732', 'PSE', 300, '194X161X45', 'Bulto', NULL),
(148, '11004 INDUST', 'RIA AVICOLA', '', 0, '', '', NULL),
(149, '110604', 'BANDEJA 604', 'PSE', 400, '235X165X22', 'Bulto', NULL),
(150, '112604A', 'BANDEJA 604 AMARILLA', 'PSE', 400, '235X165X22', 'Bulto', NULL),
(151, '112604AS', 'BANDEJA 604 S AMARILLA', 'PSE', 300, '245X180X25', 'Bulto', NULL),
(152, '110645S', 'BANDEJA 645S P/POLLO', 'PSE', 100, '320X250X35', 'Bulto', NULL),
(153, '11005 PLATOS', 'DE PSE', '', 0, '', '', NULL),
(154, '110629', 'PLATO PROFUNDO 629', 'PSE', 300, 'DIAM 195X30', 'Bulto', NULL),
(155, '11006 BAND.', 'LIVIANAS STD BCAS', '', 0, '', '', NULL),
(156, '110615L', 'BANDEJA 615 LIVIANA', 'PSE', 400, '270X150X21.5', 'Bulto', NULL),
(157, '110617L', 'BANDEJA 617 LIVIANA', 'PSE', 600, '140X140X20', 'Bulto', NULL),
(158, '110618L', 'BANDEJA 618 LIVIANA', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(159, '110619L', 'BANDEJA 619 LIVIANA', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(160, '110621L', 'BANDEJA 621 LIVIANA', 'PSE', 600, '190X140X20', 'Bulto', NULL),
(161, '110623300L', 'BANDEJA 623 POR 300 LIVIANA', 'PSE', 300, '200X292X15', 'Bulto', NULL),
(162, '110625L', 'BANDEJA 625 LIVIANA', 'PSE', 300, '215X305X25', 'Bulto', NULL),
(163, '110628L', 'BANDEJA 628 LIVIANA', 'PSE', 200, 'DIAM 322X15', 'Bulto', NULL),
(164, '11008 SL BAN', 'DEJA', '', 0, '', '', NULL),
(165, '110615SL', 'BANDEJA 615 SL', 'PSE', 400, '270X150X21,5', 'Bulto', NULL),
(166, '110617SL', 'BANDEJA 617 SL', 'PSE', 600, '140X140X20', 'Bulto', NULL),
(167, '110618SL', 'BANDEJA 618 SL', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(168, '110619SL', 'BANDEJA 619 SL', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(169, '110628SL', 'BANDEJA 628 SL', 'PSE', 200, 'DIAM 322X15', 'Bulto', NULL),
(171, '111150', 'OBLEA 150', 'PSE', 400, 'DIAM 150', 'Bulto', NULL),
(172, '111180', 'OBLEA 180', 'PSE', 400, 'DIAM 180', 'Bulto', NULL),
(173, '111270', 'OBLEA 270', 'PSE', 300, '270X270', 'Bulto', NULL),
(174, '111615', 'OBLEA 615', 'PSE', 400, '270X150', 'Bulto', NULL),
(175, '111617', 'OBLEA 617', 'PSE', 600, '140X140', 'Bulto', NULL),
(176, '111618', 'OBLEA 618', 'PSE', 600, '205X150', 'Bulto', NULL),
(177, '111620', 'OBLEA 620', 'PSE', 900, '200X125', 'Bulto', NULL),
(178, '111628', 'OBLEA 628', 'PSE', 400, 'DIAM 280', 'Bulto', NULL),
(179, '111629', 'OBLEA 629', 'PSE', 500, 'DIAM 215', 'Bulto', NULL),
(180, '111639', 'OBLEA 639', 'PSE', 400, 'DIAM 190', 'Bulto', NULL),
(181, '111649', 'OBLEA 649', 'PSE', 400, 'DIAM 230', 'Bulto', NULL),
(182, '111659', 'OBLEA 659', 'PSE', 400, 'DIAM 250', 'Bulto', NULL),
(183, '11102 OBLEAS', 'PSE LIVIANAS', '', 0, '', '', NULL),
(184, '111618L', 'OBLEA 618 LIVIANA', 'PSE', 600, '205X150', 'Bulto', NULL),
(185, '111619L', 'OBLEA 619 LIVIANA', 'PSE', 600, '225X180', 'Bulto', NULL),
(186, '111620L', 'OBLEA 620 LIVIANA', 'PSE', 900, '200X125', 'Bulto', NULL),
(187, '11104 SL OBL', 'EA', '', 0, '', '', NULL),
(188, '111615SL', 'OBLEA 615 SL', 'PSE', 400, '270X150', 'Bulto', NULL),
(189, '111618SL', 'OBLEA 618 SL', 'PSE', 600, '205X150', 'Bulto', NULL),
(190, '111619SL', 'OBLEA 619 SL', 'PSE', 600, '225X180', 'Bulto', NULL),
(191, '111620SL', 'OBLEA 620 SL', 'PSE', 900, '200X125', 'Bulto', NULL),
(192, '11201 BANDEJ', 'AS STD COLOR', '', 0, '', '', NULL),
(193, '112615A', 'BANDEJA 615 AMARILLA', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(194, '112615AZ', 'BANDEJA 615 AZUL', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(195, '112615N', 'BANDEJA 615 NEGRA', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(196, '112615RJ', 'BANDEJA 615 ROJA', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(197, '112615V', 'BANDEJA 615 VERDE', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(198, '112617600N', 'BANDEJA 617 NEGRA X 600', 'PSE', 600, '140X140X20', 'Bulto', NULL),
(199, '112617600V', 'BANDEJA 617 VERDE X 600', 'PSE', 600, '140X140X20', 'Bulto', NULL),
(200, '112618600A', 'BANDEJA 618 AMARILLA X 600', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(201, '112618600AZ', 'BANDEJA 618 AZUL X 600', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(202, '112618600N', 'BANDEJA 618 NEGRA X 600', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(203, '112618600RJ', 'BANDEJA 618 ROJA X 600', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(204, '112618600V', 'BANDEJA 618 VERDE X 600', 'PSE', 600, '205X150X20', 'Bulto', NULL),
(205, '112619600A', 'BANDEJA 619 AMARILLA X 600', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(206, '112619600AZ', 'BANDEJA 619 AZUL X 600', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(207, '112619600N', 'BANDEJA 619 NEGRA X 600', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(208, '112619600RJ', 'BANDEJA 619 ROJA X 600', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(209, '112619600V', 'BANDEJA 619 VERDE X 600', 'PSE', 600, '225X180X20', 'Bulto', NULL),
(210, '112621600A', 'BANDEJA 621 AMARILLA X 600', 'PSE', 600, '190X140X20', 'Bulto', NULL),
(211, '112621600N', 'BANDEJA 621 NEGRA X 600', 'PSE', 600, '140 X 190 X 20', 'Bulto', NULL),
(212, '112621600V', 'BANDEJA 621 VERDE X 600', 'PSE', 600, '140 X 190 X 20', 'Bulto', NULL),
(213, '11301 ESTUCH', 'ES DE PSE', '', 0, '', '', NULL),
(214, '110PTM', 'BASE MARMITA', 'PSE', 300, 'DIAM 189X55', 'Bulto', NULL),
(215, '110PT500BYT', 'CONJUNTO TERMICO BYT 500GR', 'PSE', 165, '172.5MMX72.5MM', 'Bulto', NULL),
(216, '110ECH.', 'ESTUCHE CHICO PSE', 'PSE', 200, '185X160X76', 'Bulto', NULL),
(217, '110EG', 'ESTUCHE GRANDE', '', 200, '270X255X110', 'Bulto', NULL),
(218, '110E1.', 'ESTUCHE MEDIANO', 'PSE', 200, '220X200X82', 'Bulto', NULL),
(219, '110EHM', 'ESTUCHE PARA HAMBURGUESA', 'PSE', 200, '155X160X90', 'Bulto', NULL),
(220, '110EP', 'ESTUCHE PROFUNDO', 'PSE', 200, '232X155X81', 'Bulto', NULL),
(221, '110B250', 'POTE TERMICO DE 250GRS', 'PSE', 600, '130MMX51.8MM', 'Bulto', NULL),
(222, '110TEP', 'TAPA MARMITA', 'PSE', 300, 'DIAM 200X17', 'Bulto', NULL),
(223, '110T250', 'TAPA P/POTE TERMICO DE 250 GRS', 'PSE', 600, '140MMX12.8MM', 'Bulto', NULL),
(224, '11401 ENVASE', 'S P/HUEVOS PSE/PSAI', '', 0, '', '', NULL),
(225, '114EH12RJ', 'ESTUCHE P/HUEVOS 12 UN ROJO', 'PSE', 200, '245X205X70', 'Bulto', NULL),
(226, '114EH12', 'ESTUCHE P/HUEVOS 12 UNID', 'PSE', 200, '245X205X70', 'Bulto', NULL),
(227, '114EH12AM', 'ESTUCHE P/HUEVOS 12 UNID AMARILLA', 'PSE', 200, '245X205X70', 'Bulto', NULL),
(228, '114EH12AZ', 'ESTUCHE P/HUEVOS 12 UNID AZUL', 'PSE', 200, '245X205X70', 'Bulto', NULL),
(229, '114EH12V', 'ESTUCHE P/HUEVOS 12 UNID VERDE', 'PSE', 200, '245X205X70', 'Bulto', NULL),
(230, '114EH06-', 'ESTUCHE P/HUEVOS 6 UNID', 'PSE', 300, '200X155X70', 'Bulto', NULL),
(231, '114EH06AM-', 'ESTUCHE P/HUEVOS 6 UNID AMARILLA', 'PSE', 300, '200X155X70', 'Bulto', NULL),
(232, '114EH06AZ-', 'ESTUCHE P/HUEVOS 6 UNID AZUL', 'PSE', 300, '200X155X70', 'Bulto', NULL),
(233, '11500 BANDEJ', 'AS PSE ABSORBENTES', '', 0, '', '', NULL),
(234, '115715', 'BANDEJA 715 ABSORB.', 'PSE', 400, '270X150X22,5', 'Bulto', NULL),
(235, '115715A', 'BANDEJA 715 ABSORB.AMARILLA', 'PSE', 400, '150X270X22,5', 'Bulto', NULL),
(236, '115715RJ', 'BANDEJA 715 ABSORB.ROJA', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(237, '115715R', 'BANDEJA 715 ABSORBENTE', 'PSE', 400, '270X150X22', 'Bulto', NULL),
(238, '115718', 'BANDEJA 718 ABSORB.', 'PSE', 400, '150X205X20', 'Bulto', NULL),
(239, '115718A', 'BANDEJA 718 ABSORB.AMARILLA', 'PSE', 400, '150X205X20', 'Bulto', NULL),
(240, '115718N', 'BANDEJA 718 ABSORB.NEGRA', 'PSE', 400, '150X205X20', 'Bulto', NULL),
(241, '115718P', 'BANDEJA 718 ABSORB.PROF.', 'PSE', 300, '205X150X30', 'Bulto', NULL),
(242, '115718R', 'BANDEJA 718 ABSORB.REF.', 'PSE', 400, '150X205X20', 'Bulto', NULL),
(243, '115718RJ', 'BANDEJA 718 ABSORB.ROJA', 'PSE', 400, '150X205X20', 'Bulto', NULL),
(244, '115719', 'BANDEJA 719 ABSORB.', 'PSE', 400, '240X185X22.5', 'Bulto', NULL),
(245, '115719A', 'BANDEJA 719 ABSORB.AMARILLA', 'PSE', 400, '185X240X22,5', 'Bulto', NULL),
(246, '115719N', 'BANDEJA 719 ABSORB.NEGRA', 'PSE', 400, '185X240X22,5', 'Bulto', NULL),
(247, '115719R', 'BANDEJA 719 ABSORB.REF.', 'PSE', 400, '225X180X24', 'Bulto', NULL),
(248, '115719RJ', 'BANDEJA 719 ABSORB.ROJA', 'PSE', 400, '225X180X24', 'Bulto', NULL),
(249, '115723200A', 'BANDEJA 723 ABSORB.AMARILLA', 'PSE', 200, '200X290X35', 'Bulto', NULL),
(250, '115723200RJ', 'BANDEJA 723 ABSORB.ROJA', 'PSE', 200, '200X290X35', 'Bulto', NULL),
(251, '11602 TAPAS', 'PARA POTES', '', 0, '', '', NULL),
(252, '315T1000NT', 'TAPA P/POTE 1000 NATURAL', 'PS', 405, 'DIAM 120MM', 'Caja', NULL),
(253, '315T250NT.', 'TAPA P/POTE 150/250/500', 'PSAI', 1000, 'DIAM 88MM', 'Caja', NULL),
(255, '315P150', 'POTE 150 NATURAL', 'PSAI', 2000, '110CC', 'Caja', NULL),
(256, '315P500NT.', 'POTE 500 NATURAL', 'PSAI', 1000, '380CC', 'Caja', NULL),
(257, '315P1000NT', 'POTE DE 1 KG', 'PSAI', 405, '810CC', 'Caja', NULL),
(258, '21000 BAND.', 'PS.EXP. SOBRE PEDIDO', '', 0, '', '', NULL),
(259, '210605', 'BANDEJA 605 MUSLO', 'PSE', 300, '305X135X17', 'Bulto', NULL),
(260, '210606', 'BANDEJA 606 LOMO', 'PSE', 300, '285X105X15', 'Bulto', NULL),
(261, '31201 FILM D', 'E PVC RESINITE 1400 MTS', '', 0, '', '', NULL),
(262, '31212A', 'FILM RESINITE 12\"', 'PVC', 1, '305mmx1400Mts', 'Caja', NULL),
(263, '31215A', 'FILM RESINITE 15\"', 'PVC', 1, '380mmx1400Mts', 'Caja', NULL),
(264, '31215AM', 'FILM RESINITE 15\" MAQ.AUT.', 'PVC', 1, '380mmx1400Mts', 'Caja', NULL),
(265, '31218A', 'FILM RESINITE 18\"', 'PVC', 1, '450mmx1400Mts', 'Caja', NULL),
(266, '31218AMAF', 'FILM RESINITE 18\" MAQ.AUT.', 'PVC', 1, '450mmx1400Mts', 'Caja', NULL),
(267, '31202 FILM D', 'E PVC MAGIC', '', 0, '', '', NULL),
(268, '31212MG', 'FILM 12\" MAGIC', 'PVC', 1, '305mmx800Mts', 'Caja', NULL),
(269, '31212MG600', 'FILM 12\" MAGIC X600M', 'PVC', 1, '300MMX600MTS', 'Caja', NULL),
(270, '31215MG', 'FILM 15\" MAGIC', 'PVC', 1, '380mmx800Mts', 'Caja', NULL),
(271, '31215MG600', 'FILM 15\" MAGIC X600M', 'PVC', 1, '380MMX600MTS', 'Caja', NULL),
(272, '31218MG', 'FILM 18\" MAGIC', 'PVC', 1, '450mmx800Mts', 'Caja', NULL),
(273, '31218MG600', 'FILM 18\" MAGIC X600M', 'PVC', 1, '450MMX600MTS', 'Caja', NULL),
(274, '31203 FILM D', 'E PVC RESINITE 1000 MTS', '', 0, '', '', NULL),
(275, '31212B.', 'FILM RESINITE 12\"x 1000 MTS', 'PVC', 1, '295mmx1000Mts', 'Caja', NULL),
(276, '31215B.', 'FILM RESINITE 15\"x 1000 MTS', 'PVC', 1, '375mmx1000Mts', 'Caja', NULL),
(277, '31218B.', 'FILM RESINITE 18\"x 1000 MTS', 'PVC', 1, '445mmx1000Mts', 'Caja', NULL),
(278, '31204 FILM D', 'E PVC BP 1000 MTS', '', 0, '', '', NULL),
(279, '31212BP', 'FILM PVC 12\" BP', 'PVC', 1, '305mmx1000Mts', 'Caja', NULL),
(280, '31215BP', 'FILM PVC 15\" BP', 'PVC', 1, '380mmx1000Mts', 'Caja', NULL),
(281, '31218BP', 'FILM PVC 18\" BP', 'PVC', 1, '450mmx1000Mts', 'Caja', NULL),
(282, '31205 FILM D', 'E PVC BP 1400 MTS', '', 0, '', '', NULL),
(283, '31212BA', 'FILM P.V.C. 12\" BP', 'PVC', 1, '305mmx1400Mts', 'Caja', NULL),
(284, '31215BA', 'FILM P.V.C. 15\" BP', 'PVC', 1, '380mmx1400Mts', 'Caja', NULL),
(285, '31218BA', 'FILM P.V.C. 18\" BP', 'PVC', 1, '450mmx1400Mts', 'Caja', NULL),
(286, '31210 FILM D', 'E PVC BANDEX 1000 MTS', '', 0, '', '', NULL),
(287, '312BP301000', 'FILM BANDEX 300MM X 1000M', 'PVC', 1, '305mmx1000Mts', 'Caja', NULL),
(288, '312BP381000', 'FILM BANDEX 380MM X 1000M', 'PVC', 1, '380mmx1000Mts', 'Caja', NULL),
(289, '312BP451000', 'FILM BANDEX 450MM X 1000M', 'PVC', 1, '450mmx1000Mts', 'Caja', NULL),
(290, '31211 FILM D', 'E PVC BANDEX 1400 MTS', '', 0, '', '', NULL),
(291, '312BP251400', 'FILM BANDEX 250MM X 1400M', 'PVC', 1, '250mmx1400Mts', 'Caja', NULL),
(292, '312BP301400', 'FILM BANDEX 300MM X 1400M', 'PVC', 1, '305mmx1400Mts', 'Caja', NULL),
(293, '312BP381400', 'FILM BANDEX 380MM X 1400M', 'PVC', 1, '380mmx1400Mts', 'Caja', NULL),
(294, '312BPMA3814', 'FILM BANDEX 380MM X 1400M MAQ. AUT.', 'PVC', 1, '380mmx1400Mts', 'Caja', NULL),
(295, '312BP451400', 'FILM BANDEX 450MM X 1400M', 'PVC', 1, '450mmx1400Mts', 'Caja', NULL),
(296, '312BPMA4514', 'FILM BANDEX 450MM X 1400M MAQ. AUT.', 'PVC', 1, '450mmx1400Mts', 'Caja', NULL),
(297, '31301 MAQUIN', 'AS P/ENVASAMIENTO', '', 0, '', '', NULL),
(298, '3132BCP', 'MAQUINA METALICA INPLAST', 'PVC', 1, '120X60X510', 'Caja', NULL),
(299, '31701 PADS A', 'BSORBENTES', '', 0, '', '', NULL),
(300, '317A40J/3', 'PAD ABSORBENTE A40J (40ML)', '', 3000, '180X95mm', 'Caja', NULL),
(301, '317A50J', 'PAD ABSORBENTE A50J (50ML)', '', 3000, '125X180mm', 'Caja', NULL),
(302, '31801 BOBINA', 'S ROLOHOGAR PROFESIONAL', '', 0, '', '', NULL),
(303, '318RPBX3030', 'REP. FILM PROF. BX 300MM X 300MTS', 'PVC', 9, '300MM X 300MTS', 'Caja', NULL),
(304, '318RPBX3810', 'REP. FILM PROF. BX 380MM X 100MTS', 'PVC', 18, '380MM X 100MTS', 'Caja', NULL),
(305, '318RPBX3826', 'REP. FILM PROF. BX 380MM X 260MTS', 'PVC', 9, '380MM X 260MTS', 'Caja', NULL),
(306, '318RPBX3830', 'REP. FILM PROF. BX 380MM X 300MTS', 'PVC', 9, '380MM X 300MTS', 'Caja', NULL),
(307, '318RPBX3026', 'REP. FILM PROF.BX 300MM X 260 MTS', 'PVC', 9, '300MM X 260 MTS', 'Caja', NULL),
(308, '31802 BOBINA', 'S FAMILIARES', '', 0, '', '', NULL),
(309, '318BRMBX', 'BOBINA ROLUMINIO', 'ALUMINIO', 30, '28cmx5Mts', 'Caja', NULL),
(310, '318RPBX2830', 'REP. FILM PVC BX 28CM X 30MTS', 'PVC', 24, '28CM X 30MTS', 'Caja', NULL),
(311, '318BRF/48', 'ROLOFREEZ 28 CM X 25 MTS', 'PVC', 48, '28cmx25Mts', 'Caja', NULL),
(312, '34000 POTES', 'REDONDOS PET C/BISAGRA', '', 0, '', '', NULL),
(313, '105ERB800', 'ESTUCHE REDONDO BAJO x800 UNIDADES', 'PET', 800, 'DIAM 115x42 mm', 'Caja', NULL),
(314, '105ERM800', 'ESTUCHE REDONDO MEDIO x800 UNIDADES', 'PET', 800, 'DIAM 115x56 mm', 'Caja', NULL),
(315, '105ERP800', 'ESTUCHE REDONDO PROF x800 UNIDADES', 'PET', 800, 'DIAM 115x72 mm', 'Caja', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuit` varchar(13) NOT NULL,
  `condicionIVA` varchar(150) NOT NULL,
  `domicilio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `cuit`, `condicionIVA`, `domicilio`) VALUES
(1, 'Facundo', '20412026803', '21', 'Suquia 2984'),
(2, 'cufa1', '20-41202680-3', '111', 'Suquia 2984');

-- --------------------------------------------------------

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
(1, 'administrador');

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
(1, 'admin', 'admin', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `utilidad`
--

INSERT INTO `utilidad` (`idUtilidad`, `tipo`, `comprobante`, `idProducto`, `impVenta`, `impCosto`, `impUtilidad`, `fecha`, `cliente`) VALUES
(1, '', 27, 3, '10.00', '7.00', '3.00', '0000-00-00', ''),
(2, '', 29, 3, '10.00', '7.00', '3.00', '0000-00-00', ''),
(3, '', 29, 4, '15.00', '14.70', '0.30', '0000-00-00', ''),
(4, '', 31, 3, '20.00', '7.00', '13.00', '0000-00-00', ''),
(5, '', 31, 4, '30.00', '14.70', '15.30', '0000-00-00', ''),
(6, '', 33, 3, '20.00', '7.00', '6.00', '0000-00-00', ''),
(7, '', 33, 4, '30.00', '14.70', '0.60', '0000-00-00', ''),
(8, '', 34, 3, '30.00', '21.00', '9.00', '0000-00-00', ''),
(9, '', 34, 4, '45.00', '44.10', '0.90', '0000-00-00', ''),
(10, '', 777, 3, '20.00', '14.00', '6.00', '0000-00-00', ''),
(11, '', 777, 4, '30.00', '29.40', '0.60', '0000-00-00', ''),
(12, '', 999, 3, '40.00', '28.00', '12.00', '2019-08-30', NULL),
(13, '', 999, 4, '60.00', '58.80', '1.20', '2019-08-30', NULL),
(14, '', 9999, 3, '50.00', '35.00', '15.00', '2019-08-30', '1'),
(15, '', 9999, 4, '75.00', '73.50', '1.50', '2019-08-30', '1'),
(16, '', 456456, 3, '20.00', '14.00', '6.00', '2019-08-30', '1'),
(17, 'F', 45678, 3, '20.00', '14.00', '6.00', '2019-08-31', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCajaTotal`);

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
  MODIFY `idCaja` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `idComprobante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `idItems` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `idPrecio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idUtilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`codRol`) REFERENCES `roles` (`codRol`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`codRol`) REFERENCES `roles` (`codRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
