-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-01-2014 a las 12:20:13
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `delibouquet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_carrito`
--

CREATE TABLE IF NOT EXISTS `cart_carrito` (
  `__id_carrito` bigint(20) NOT NULL AUTO_INCREMENT,
  `__id_moneda` int(11) DEFAULT NULL,
  `__id_cliente` bigint(20) DEFAULT NULL,
  `__procesado` tinyint(1) DEFAULT NULL,
  `__secure_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__reciclar` tinyint(1) DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__fecha_modificacion` datetime DEFAULT NULL,
  `__direccion_envio` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__direccion_pago` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`__id_carrito`),
  KEY `IDX_8C3C76D2B8EBCFA5` (`__id_moneda`),
  KEY `IDX_8C3C76D2177770D3` (`__id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_carrito__producto`
--

CREATE TABLE IF NOT EXISTS `cart_carrito__producto` (
  `__id_carrito_producto` int(11) NOT NULL AUTO_INCREMENT,
  `__id_carrito` bigint(20) DEFAULT NULL,
  `__cantidad` double NOT NULL,
  `__precio` double NOT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__fecha_modificacion` datetime DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_carrito_producto`),
  KEY `IDX_816EC1F7948D5523` (`__id_carrito`),
  KEY `IDX_816EC1F7C9EE6EC8` (`__idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_marca`
--

CREATE TABLE IF NOT EXISTS `cart_marca` (
  `__idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `__logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__orden` int(11) DEFAULT NULL,
  `__fecha_actualizacion` datetime DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`__idMarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cart_marca`
--

INSERT INTO `cart_marca` (`__idMarca`, `__nombre`, `__logo`, `__estado`, `__orden`, `__fecha_actualizacion`, `__fecha_registro`) VALUES
(1, 'Wilton''s', 'marca_1388299397_1.jpg', 1, 1, '2013-12-29 01:46:02', '2012-11-04 08:05:11'),
(3, 'nueva marca', 'marca_1388620480_.jpg', 1, 2, '2014-01-01 18:54:40', NULL),
(4, 'mdsdsss', 'marca_1388631762_.jpg', 1, 3, '2014-01-01 22:02:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_marca_language`
--

CREATE TABLE IF NOT EXISTS `cart_marca_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_Marca_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__adjunto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__idMarca` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_Marca_Language`),
  KEY `IDX_B0B7710080E64D77` (`__id_language`),
  KEY `IDX_B0B771004A46E613` (`__idMarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cart_marca_language`
--

INSERT INTO `cart_marca_language` (`__id_language`, `__id_Marca_Language`, `__detalle`, `__adjunto`, `__idMarca`) VALUES
(1, 1, 'Marca Wilton''s...', NULL, 1),
(2, 2, '<b>Trademark</b>&nbsp;Wilton''s ...', NULL, 1),
(1, 4, 'ingresar detalle...', NULL, 3),
(1, 5, 'ingresar detalle... xccc', NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_moneda`
--

CREATE TABLE IF NOT EXISTS `cart_moneda` (
  `__id_moneda` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `__iso_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `__signo` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `__activo` tinyint(1) NOT NULL,
  `__principal` tinyint(1) NOT NULL,
  `__conversion` double NOT NULL,
  `__fecha_actualizacion` datetime DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`__id_moneda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_movimiento__stock`
--

CREATE TABLE IF NOT EXISTS `cart_movimiento__stock` (
  `__id_movimiento_stock` bigint(20) NOT NULL AUTO_INCREMENT,
  `__id_orden` int(11) DEFAULT NULL,
  `__id_movimiento_stock_tipo` int(11) DEFAULT NULL,
  `__cantidad` int(11) DEFAULT NULL,
  `__idUser` int(11) DEFAULT NULL,
  `__fecha_caducidad` datetime DEFAULT NULL,
  `__fecha_ingreso` datetime DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__fecha_actualizacion` datetime DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_movimiento_stock`),
  KEY `IDX_1A096F3A6CF16A9A` (`__id_orden`),
  KEY `IDX_1A096F3AC9EE6EC8` (`__idProducto`),
  KEY `IDX_1A096F3AEECA34F6` (`__id_movimiento_stock_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cart_movimiento__stock`
--

INSERT INTO `cart_movimiento__stock` (`__id_movimiento_stock`, `__id_orden`, `__id_movimiento_stock_tipo`, `__cantidad`, `__idUser`, `__fecha_caducidad`, `__fecha_ingreso`, `__fecha_registro`, `__fecha_actualizacion`, `__idProducto`) VALUES
(1, NULL, 2, 5, 1, '2013-12-31 00:00:00', '2013-12-16 00:00:00', '2013-12-17 22:01:20', '2013-12-17 22:01:20', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_movimiento__stock_tipo`
--

CREATE TABLE IF NOT EXISTS `cart_movimiento__stock_tipo` (
  `__id_movimiento_stock_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signo` int(11) DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`__id_movimiento_stock_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_movimiento__stock_tipo`
--

INSERT INTO `cart_movimiento__stock_tipo` (`__id_movimiento_stock_tipo`, `__nombre`, `signo`, `__fecha_registro`, `__fecha_actualizacion`) VALUES
(1, 'Venta', -1, '2012-06-24 07:15:10', '2012-06-24 07:14:22'),
(2, 'Ingreso', 1, '2012-06-24 07:15:10', '2012-06-24 07:14:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_orden`
--

CREATE TABLE IF NOT EXISTS `cart_orden` (
  `__id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `__id_carrito` bigint(20) DEFAULT NULL,
  `__id_cliente` bigint(20) DEFAULT NULL,
  `__id_moneda` int(11) DEFAULT NULL,
  `__id_orden_estado` int(11) DEFAULT NULL,
  `__tipo_documento` int(11) NOT NULL,
  `__direccion_envio` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `__direccion_pago` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `_sub__total` double DEFAULT NULL,
  `__total_impuesto` double DEFAULT NULL,
  `__impuesto_ratio` double DEFAULT NULL,
  `__total` double DEFAULT NULL,
  `__total_descuento` double DEFAULT NULL,
  `__total_final` double DEFAULT NULL,
  `__costo_envio` double DEFAULT NULL,
  `__cuenta_banco` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fecha_procesado` datetime DEFAULT NULL,
  `__fecha_envio` date DEFAULT NULL,
  `__hora_envio` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fecha_modificado` datetime DEFAULT NULL,
  `__codigo_voucher` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__nro_factura` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__ruc_cliente` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__razon_social` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_persona__recepcion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fecha_deposito` date DEFAULT NULL,
  `__hora_deposito` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__id_ubigeo` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`__id_orden`),
  KEY `IDX_BEC2A2DF948D5523` (`__id_carrito`),
  KEY `IDX_BEC2A2DF177770D3` (`__id_cliente`),
  KEY `IDX_BEC2A2DFB8EBCFA5` (`__id_moneda`),
  KEY `IDX_BEC2A2DF391D3278` (`__id_orden_estado`),
  KEY `IDX_BEC2A2DFCF0E7B73` (`__id_ubigeo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_orden__detalle`
--

CREATE TABLE IF NOT EXISTS `cart_orden__detalle` (
  `__id_orden_detalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `__id_orden` int(11) DEFAULT NULL,
  `__producto_nombre` varchar(170) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__cantidad` double DEFAULT NULL,
  `__precio_unitario` double DEFAULT NULL,
  `__precio_total` double DEFAULT NULL,
  `__impuesto_total` double DEFAULT NULL,
  `__impuesto_ratio` double DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__fecha_modificacion` datetime DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_orden_detalle`),
  KEY `IDX_82254A936CF16A9A` (`__id_orden`),
  KEY `IDX_82254A93C9EE6EC8` (`__idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_orden__estado`
--

CREATE TABLE IF NOT EXISTS `cart_orden__estado` (
  `__id_orden_estado` int(11) NOT NULL AUTO_INCREMENT,
  `__activo` tinyint(1) DEFAULT NULL,
  `__color` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__envio_email` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`__id_orden_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cart_orden__estado`
--

INSERT INTO `cart_orden__estado` (`__id_orden_estado`, `__activo`, `__color`, `__envio_email`) VALUES
(1, 1, NULL, 0),
(2, 1, NULL, 0),
(3, 1, NULL, 0),
(4, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_orden__estado_language`
--

CREATE TABLE IF NOT EXISTS `cart_orden__estado_language` (
  `__id_orden_estado` int(11) DEFAULT NULL,
  `__id_language` int(11) DEFAULT NULL,
  `__id_OrdenEstado_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`__id_OrdenEstado_Language`),
  KEY `IDX_C48823DF391D3278` (`__id_orden_estado`),
  KEY `IDX_C48823DF80E64D77` (`__id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `cart_orden__estado_language`
--

INSERT INTO `cart_orden__estado_language` (`__id_orden_estado`, `__id_language`, `__id_OrdenEstado_Language`, `__nombre`, `__detalle`) VALUES
(1, 1, 1, 'Pendiente de Cancelar', NULL),
(1, 2, 2, 'Pending Cancel', NULL),
(2, 1, 3, 'Pendiente de Verificar Voucher', NULL),
(2, 2, 4, 'Pending Check Voucher', NULL),
(3, 1, 5, 'Cancelado', NULL),
(3, 2, 6, 'Canceled', NULL),
(4, 1, 7, 'Anulado', NULL),
(4, 2, 8, 'annulled', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto`
--

CREATE TABLE IF NOT EXISTS `cart_producto` (
  `__idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `__codigo_producto` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `__precio` double DEFAULT NULL,
  `__cantidad` double DEFAULT NULL,
  `__cantidad_vendidos` double DEFAULT NULL,
  `__peso` double DEFAULT NULL,
  `__orden` int(11) DEFAULT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__fechaIniPub` date DEFAULT NULL,
  `__fechaFinPub` date DEFAULT NULL,
  `__fechamodif` datetime DEFAULT NULL,
  `__fechareg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `__idMarca` int(11) DEFAULT NULL,
  `__idContCate` int(11) DEFAULT NULL,
  `__imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adjunto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__idTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`__idProducto`),
  KEY `IDX_3924497E4A46E613` (`__idMarca`),
  KEY `IDX_3924497EA07E7B24` (`__idContCate`),
  KEY `IDX_3924497E8EAB4527` (`__idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_producto`
--

INSERT INTO `cart_producto` (`__idProducto`, `__codigo_producto`, `__precio`, `__cantidad`, `__cantidad_vendidos`, `__peso`, `__orden`, `__estado`, `__fechaIniPub`, `__fechaFinPub`, `__fechamodif`, `__fechareg`, `__idMarca`, `__idContCate`, `__imagen`, `__adjunto`, `__idTipo`) VALUES
(2, 'PR00001', NULL, 5, 0, NULL, 1, 1, NULL, NULL, '2013-08-25 17:31:07', NULL, 1, 2, 'producto_1377469867_2.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto_comentario`
--

CREATE TABLE IF NOT EXISTS `cart_producto_comentario` (
  `__id_producto_comentario` bigint(20) NOT NULL AUTO_INCREMENT,
  `__id_cliente` bigint(20) DEFAULT NULL,
  `__titulo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__comentario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `__estado` tinyint(1) DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_producto_comentario`),
  KEY `IDX_A3BED91CC9EE6EC8` (`__idProducto`),
  KEY `IDX_A3BED91C177770D3` (`__id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto_language`
--

CREATE TABLE IF NOT EXISTS `cart_producto_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_Producto_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__intro` longtext COLLATE utf8_unicode_ci,
  `__ficha` longtext COLLATE utf8_unicode_ci,
  `__adjunto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_Producto_Language`),
  KEY `IDX_EC2FBEBEC9EE6EC8` (`__idProducto`),
  KEY `IDX_EC2FBEBE80E64D77` (`__id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_producto_language`
--

INSERT INTO `cart_producto_language` (`__id_language`, `__id_Producto_Language`, `__nombre`, `__intro`, `__ficha`, `__adjunto`, `__idProducto`) VALUES
(1, 2, 'producto 1xx', '', '<p>jhd jsh js djs dsdsds vefkhsjf hdjk fjd fhjd fj hdfj djf jd fhd</p>', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__categoria`
--

CREATE TABLE IF NOT EXISTS `cart_producto__categoria` (
  `__idContCate` int(11) NOT NULL AUTO_INCREMENT,
  `__nivel_cate` int(11) DEFAULT NULL,
  `__imagen_cate` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__orden_cate` int(11) NOT NULL,
  `__state_cate` tinyint(1) NOT NULL,
  `__fechamodf_cate` datetime DEFAULT NULL,
  `__fechareg_cate` datetime DEFAULT NULL,
  `__idContCate_Padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`__idContCate`),
  KEY `IDX_EBA38D2ED83BB542` (`__idContCate_Padre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_producto__categoria`
--

INSERT INTO `cart_producto__categoria` (`__idContCate`, `__nivel_cate`, `__imagen_cate`, `__orden_cate`, `__state_cate`, `__fechamodf_cate`, `__fechareg_cate`, `__idContCate_Padre`) VALUES
(1, 0, NULL, 1, 1, '2012-11-03 19:11:06', '2012-11-03 19:11:10', 1),
(2, 1, NULL, 1, 1, '2012-11-03 19:17:28', '2012-11-03 19:17:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__categoria_language`
--

CREATE TABLE IF NOT EXISTS `cart_producto__categoria_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ProductoCate_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__idContCate` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ProductoCate_Language`),
  KEY `IDX_72D6DF5DA07E7B24` (`__idContCate`),
  KEY `IDX_72D6DF5D80E64D77` (`__id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cart_producto__categoria_language`
--

INSERT INTO `cart_producto__categoria_language` (`__id_language`, `__id_ProductoCate_Language`, `__descripcion`, `__detalle`, `__idContCate`) VALUES
(1, 1, 'categoria raiz', NULL, 1),
(2, 2, 'root category', NULL, 1),
(1, 3, 'Categoría 1', '<font face="tahoma, arial, verdana, sans-serif"><span style="font-size: 12px;">​detalle de la&nbsp;</span></font><b><font color="#ff0000"><font face="tahoma, arial, verdana, sans-serif"><span style="font-size: 12px;">categoría&nbsp;1.</span></font></font></b>', 2),
(2, 4, 'Línea de Productos 1', NULL, 2),
(2, 8, 'descripcion', NULL, 1),
(2, 10, 'descripcion', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__categoria_tipo`
--

CREATE TABLE IF NOT EXISTS `cart_producto__categoria_tipo` (
  `__id_ProductoCate_Tipo` int(11) NOT NULL AUTO_INCREMENT,
  `__cantidad` decimal(10,0) DEFAULT NULL,
  `__estado` tinyint(1) DEFAULT NULL,
  `__idContCate` int(11) DEFAULT NULL,
  `__idTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ProductoCate_Tipo`),
  KEY `IDX_2A7E5BC1A07E7B24` (`__idContCate`),
  KEY `IDX_2A7E5BC18EAB4527` (`__idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__galeria`
--

CREATE TABLE IF NOT EXISTS `cart_producto__galeria` (
  `__idContGale` int(11) NOT NULL AUTO_INCREMENT,
  `__orden_gale` int(11) NOT NULL,
  `__imagen_gale` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fechareg_gale` datetime DEFAULT NULL,
  `__idProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`__idContGale`),
  KEY `IDX_D5ACFFFFC9EE6EC8` (`__idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__galeria_language`
--

CREATE TABLE IF NOT EXISTS `cart_producto__galeria_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ProductoGale_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__descripcion` longtext COLLATE utf8_unicode_ci,
  `__idContGale` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ProductoGale_Language`),
  KEY `IDX_57E70AFEAD07742A` (`__idContGale`),
  KEY `IDX_57E70AFE80E64D77` (`__id_language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__tipo`
--

CREATE TABLE IF NOT EXISTS `cart_producto__tipo` (
  `__idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `__imagen` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__orden` int(11) NOT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__fechamodf` datetime DEFAULT NULL,
  `__fechareg` datetime DEFAULT NULL,
  PRIMARY KEY (`__idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cart_producto__tipo`
--

INSERT INTO `cart_producto__tipo` (`__idTipo`, `__imagen`, `__orden`, `__estado`, `__fechamodf`, `__fechareg`) VALUES
(1, NULL, 1, 1, '2012-11-04 08:04:01', '2012-11-04 08:04:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_producto__tipo_language`
--

CREATE TABLE IF NOT EXISTS `cart_producto__tipo_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ProductoTipo_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__idTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ProductoTipo_Language`),
  KEY `IDX_8FB0D1438EAB4527` (`__idTipo`),
  KEY `IDX_8FB0D14380E64D77` (`__id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_producto__tipo_language`
--

INSERT INTO `cart_producto__tipo_language` (`__id_language`, `__id_ProductoTipo_Language`, `__descripcion`, `__detalle`, `__idTipo`) VALUES
(1, 1, 'General', NULL, 1),
(2, 2, 'General', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_cliente`
--

CREATE TABLE IF NOT EXISTS `cms_cliente` (
  `__id_cliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `__idtipo_documento` smallint(6) DEFAULT NULL,
  `__role` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `__nombres` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `__apellido_paterno` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `__apellido_materno` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `__nro_documento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__genero` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fecha_nacimiento` date DEFAULT NULL,
  `__telefono_casa` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__telefono_oficina` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__movil` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__clave` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__recibir_ofertas_mail` tinyint(1) DEFAULT NULL,
  `__recibir_ofertas_movil` tinyint(1) DEFAULT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__foto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fecha_modificacion` datetime DEFAULT NULL,
  `__fecha_Registro` datetime DEFAULT NULL,
  `__id_Pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_cliente`),
  KEY `IDX_AAF09434FC739DE` (`__id_Pais`),
  KEY `IDX_AAF0943420C3C396` (`__idtipo_documento`),
  KEY `cliente_role_idx` (`__role`),
  KEY `cliente_nombres_idx` (`__nombres`),
  KEY `cliente_apepat_idx` (`__apellido_paterno`),
  KEY `cliente_apemat_idx` (`__apellido_materno`),
  KEY `cliente_mail_idx` (`__email`),
  KEY `cliente_clave_idx` (`__clave`),
  KEY `cliente_estado_idx` (`__estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_cliente`
--

INSERT INTO `cms_cliente` (`__id_cliente`, `__idtipo_documento`, `__role`, `__nombres`, `__apellido_paterno`, `__apellido_materno`, `__email`, `__nro_documento`, `__genero`, `__fecha_nacimiento`, `__telefono_casa`, `__telefono_oficina`, `__movil`, `__clave`, `__recibir_ofertas_mail`, `__recibir_ofertas_movil`, `__estado`, `__foto`, `__fecha_modificacion`, `__fecha_Registro`, `__id_Pais`) VALUES
(1, 1, 'user', 'antonio', 'djskdj sk', 'k jk djsdk', 'tonyprr@gmail.com', '978787545', 'M', '2013-12-03', '', '', '', NULL, 0, 0, 1, NULL, '2013-12-13 22:32:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_cliente__direccion`
--

CREATE TABLE IF NOT EXISTS `cms_cliente__direccion` (
  `__id_cliente_direccion` bigint(20) NOT NULL AUTO_INCREMENT,
  `_id__cliente` bigint(20) DEFAULT NULL,
  `__id_tipo_direccion` int(11) DEFAULT NULL,
  `__cod_postal` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__dirprin_despacho` tinyint(1) DEFAULT NULL,
  `__dir_despacho` tinyint(1) NOT NULL,
  `__dir_factura` tinyint(1) NOT NULL,
  `__direccion` varchar(130) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__estado` tinyint(1) DEFAULT NULL,
  `__fecha_Registro` datetime DEFAULT NULL,
  `__fecha_Modificacion` datetime DEFAULT NULL,
  `__user_modificacion` bigint(20) DEFAULT NULL,
  `__id_Pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_cliente_direccion`),
  KEY `IDX_20DBC7238E322433` (`_id__cliente`),
  KEY `IDX_20DBC72340EF4DF3` (`__id_tipo_direccion`),
  KEY `IDX_20DBC723FC739DE` (`__id_Pais`),
  KEY `IDX_20DBC723E49AB9DF` (`__cod_postal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content`
--

CREATE TABLE IF NOT EXISTS `cms_content` (
  `__idContent` int(11) NOT NULL AUTO_INCREMENT,
  `__imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adjunto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__orden` int(11) DEFAULT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__fecha_IniPub` date DEFAULT NULL,
  `__fecha_FinPub` date DEFAULT NULL,
  `__fecha_modf` datetime DEFAULT NULL,
  `__fecha_reg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `__idContCate` int(11) DEFAULT NULL,
  `__idTipo` int(11) DEFAULT NULL,
  `__url` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adicional1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adicional2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adicional3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__imagen2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`__idContent`),
  KEY `IDX_A0293FB8A07E7B24` (`__idContCate`),
  KEY `IDX_A0293FB88EAB4527` (`__idTipo`),
  KEY `content_estado_idx` (`__estado`),
  KEY `content_fechainipub_idx` (`__fecha_FinPub`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cms_content`
--

INSERT INTO `cms_content` (`__idContent`, `__imagen`, `__adjunto`, `__orden`, `__estado`, `__fecha_IniPub`, `__fecha_FinPub`, `__fecha_modf`, `__fecha_reg`, `__idContCate`, `__idTipo`, `__url`, `__adicional1`, `__adicional2`, `__adicional3`, `__imagen2`) VALUES
(1, 'content_1389322649_1.jpg', NULL, NULL, 1, '2014-01-08', NULL, '2014-01-09 22:31:53', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'content_1389324745_2.jpg', NULL, NULL, 1, '2014-01-10', NULL, '2014-01-09 22:32:25', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content_comentario`
--

CREATE TABLE IF NOT EXISTS `cms_content_comentario` (
  `__id_content_comentario` bigint(20) NOT NULL AUTO_INCREMENT,
  `__id_cliente` bigint(20) DEFAULT NULL,
  `__titulo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__comentario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `__estado` tinyint(1) DEFAULT NULL,
  `__fecha_registro` datetime DEFAULT NULL,
  `__idContent` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_content_comentario`),
  KEY `IDX_D075827DC0AB0A3E` (`__idContent`),
  KEY `IDX_D075827D177770D3` (`__id_cliente`),
  KEY `contentComen_estado_idx` (`__estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content_language`
--

CREATE TABLE IF NOT EXISTS `cms_content_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_Content_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__descripcion` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__intro` longtext COLLATE utf8_unicode_ci,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adjunto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__idContent` int(11) DEFAULT NULL,
  `__url` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adicional1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__adicional2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`__id_Content_Language`),
  KEY `IDX_16737A20C0AB0A3E` (`__idContent`),
  KEY `IDX_16737A2080E64D77` (`__id_language`),
  KEY `contentLang_descripcion_idx` (`__descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cms_content_language`
--

INSERT INTO `cms_content_language` (`__id_language`, `__id_Content_Language`, `__descripcion`, `__intro`, `__detalle`, `__imagen`, `__adjunto`, `__idContent`, `__url`, `__adicional1`, `__adicional2`) VALUES
(1, 1, 'descripcion xcx', 'xxdsds', '<p>abcd</p>', NULL, NULL, 1, NULL, NULL, NULL),
(1, 2, 'descripcion', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__categoria`
--

CREATE TABLE IF NOT EXISTS `cms_content__categoria` (
  `__idContCate` int(11) NOT NULL AUTO_INCREMENT,
  `__nivel_cate` int(11) DEFAULT NULL,
  `__imagen_cate` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__orden_cate` int(11) NOT NULL,
  `__estado_cate` tinyint(1) NOT NULL,
  `_fechamodf__cate` datetime DEFAULT NULL,
  `__fechareg_cate` datetime DEFAULT NULL,
  `__idContCate_Padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`__idContCate`),
  KEY `IDX_9868D64FD83BB542` (`__idContCate_Padre`),
  KEY `contentCate_nivel_idx` (`__nivel_cate`),
  KEY `contentCate_estado_idx` (`__estado_cate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cms_content__categoria`
--

INSERT INTO `cms_content__categoria` (`__idContCate`, `__nivel_cate`, `__imagen_cate`, `__orden_cate`, `__estado_cate`, `_fechamodf__cate`, `__fechareg_cate`, `__idContCate_Padre`) VALUES
(5, 0, NULL, 1, 1, NULL, '2012-11-13 22:54:54', 5),
(6, 1, NULL, 1, 1, NULL, '2012-11-13 22:55:59', 5),
(9, 0, NULL, 1, 1, NULL, '2012-12-28 00:00:00', 9),
(10, 1, NULL, 1, 1, NULL, '2012-12-28 00:00:00', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__categoria_language`
--

CREATE TABLE IF NOT EXISTS `cms_content__categoria_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ContentCate_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__descripcion` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__idContCate` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ContentCate_Language`),
  KEY `IDX_722E1134A07E7B24` (`__idContCate`),
  KEY `IDX_722E113480E64D77` (`__id_language`),
  KEY `contentCateLang_descripcion_idx` (`__descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `cms_content__categoria_language`
--

INSERT INTO `cms_content__categoria_language` (`__id_language`, `__id_ContentCate_Language`, `__descripcion`, `__detalle`, `__idContCate`) VALUES
(1, 9, 'Categoria Noticias', NULL, 5),
(2, 10, 'Category Noticias', NULL, 5),
(1, 11, 'Noticias', NULL, 6),
(2, 12, 'Noticias', NULL, 6),
(1, 17, 'Categoria Banner', NULL, 9),
(2, 18, 'Category Banner', NULL, 9),
(1, 19, 'Banners', NULL, 10),
(2, 20, 'Banners', NULL, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__galeria`
--

CREATE TABLE IF NOT EXISTS `cms_content__galeria` (
  `__idContGale` int(11) NOT NULL AUTO_INCREMENT,
  `__orden_gale` int(11) NOT NULL,
  `__imagen_gale` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__fechareg_gale` datetime DEFAULT NULL,
  `__idContent` int(11) DEFAULT NULL,
  PRIMARY KEY (`__idContGale`),
  KEY `IDX_2FF03B61C0AB0A3E` (`__idContent`),
  KEY `contentGale_estado_idx` (`__orden_gale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__galeria_language`
--

CREATE TABLE IF NOT EXISTS `cms_content__galeria_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ContentGale_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__descripcion` longtext COLLATE utf8_unicode_ci,
  `__idContGale` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ContentGale_Language`),
  KEY `IDX_FB206323AD07742A` (`__idContGale`),
  KEY `IDX_FB20632380E64D77` (`__id_language`),
  KEY `contentGaleLang_titulo_idx` (`__titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__tipo`
--

CREATE TABLE IF NOT EXISTS `cms_content__tipo` (
  `__idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `__imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__orden_cate` int(11) NOT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__fechamodf` datetime DEFAULT NULL,
  `__fechareg` datetime DEFAULT NULL,
  PRIMARY KEY (`__idTipo`),
  KEY `contentTipo_estado_idx` (`__estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_content__tipo`
--

INSERT INTO `cms_content__tipo` (`__idTipo`, `__imagen`, `__orden_cate`, `__estado`, `__fechamodf`, `__fechareg`) VALUES
(1, NULL, 1, 1, NULL, '2012-11-04 18:07:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_content__tipo_language`
--

CREATE TABLE IF NOT EXISTS `cms_content__tipo_language` (
  `__id_language` int(11) DEFAULT NULL,
  `__id_ContentTipo_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle` longtext COLLATE utf8_unicode_ci,
  `__idTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`__id_ContentTipo_Language`),
  KEY `IDX_8DC1AE778EAB4527` (`__idTipo`),
  KEY `IDX_8DC1AE7780E64D77` (`__id_language`),
  KEY `contentTipoLang_descripcion_idx` (`__descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cms_content__tipo_language`
--

INSERT INTO `cms_content__tipo_language` (`__id_language`, `__id_ContentTipo_Language`, `__descripcion`, `__detalle`, `__idTipo`) VALUES
(1, 1, 'General', NULL, 1),
(2, 2, 'General', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_keys`
--

CREATE TABLE IF NOT EXISTS `cms_keys` (
  `__id_keys` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `__consumido` tinyint(1) NOT NULL,
  `__fecha_inicio` datetime NOT NULL,
  `__fecha_fin` datetime DEFAULT NULL,
  `__usuario_creacion` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`__id_keys`),
  KEY `keys_consumido_idx` (`__consumido`),
  KEY `keys_fechaInicio_idx` (`__fecha_inicio`),
  KEY `keys_fechaFin_idx` (`__fecha_fin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_language`
--

CREATE TABLE IF NOT EXISTS `cms_language` (
  `__id_language` int(11) NOT NULL AUTO_INCREMENT,
  `__idioma` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `__nombre_corto` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__estado` tinyint(1) NOT NULL,
  `__principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`__id_language`),
  KEY `keys_estado_idx` (`__estado`),
  KEY `keys_principal_idx` (`__principal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cms_language`
--

INSERT INTO `cms_language` (`__id_language`, `__idioma`, `__nombre_corto`, `__estado`, `__principal`) VALUES
(1, 'Español', 'es', 1, 1),
(2, 'English', 'en', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_pais`
--

CREATE TABLE IF NOT EXISTS `cms_pais` (
  `__id_Pais` int(11) NOT NULL AUTO_INCREMENT,
  `__num_pais` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__nombre` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `__estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`__id_Pais`),
  KEY `pais_estado_idx` (`__estado`),
  KEY `pais_nombre_idx` (`__nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_pais`
--

INSERT INTO `cms_pais` (`__id_Pais`, `__num_pais`, `__nombre`, `__estado`) VALUES
(1, 'PE', 'Perú', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_tipo__direccion`
--

CREATE TABLE IF NOT EXISTS `cms_tipo__direccion` (
  `__id_tipo_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `__estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`__id_tipo_direccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_tipo__direccion_language`
--

CREATE TABLE IF NOT EXISTS `cms_tipo__direccion_language` (
  `__id_tipo_direccion` int(11) DEFAULT NULL,
  `__id_language` int(11) DEFAULT NULL,
  `__id_TipoDireccion_Language` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`__id_TipoDireccion_Language`),
  KEY `IDX_BCD9FE440EF4DF3` (`__id_tipo_direccion`),
  KEY `IDX_BCD9FE480E64D77` (`__id_language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_tipo__documento`
--

CREATE TABLE IF NOT EXISTS `cms_tipo__documento` (
  `__idtipo_documento` smallint(6) NOT NULL AUTO_INCREMENT,
  `__longitud_tdoc` int(11) DEFAULT NULL,
  `__estado_tipodoc` tinyint(1) NOT NULL,
  `__tiempo_modif` datetime DEFAULT NULL,
  PRIMARY KEY (`__idtipo_documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_tipo__documento`
--

INSERT INTO `cms_tipo__documento` (`__idtipo_documento`, `__longitud_tdoc`, `__estado_tipodoc`, `__tiempo_modif`) VALUES
(1, 8, 1, '2012-11-02 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_tipo__documento_language`
--

CREATE TABLE IF NOT EXISTS `cms_tipo__documento_language` (
  `idtipo_documento` smallint(6) DEFAULT NULL,
  `__id_language` int(11) DEFAULT NULL,
  `__id_tipoDocu_language` int(11) NOT NULL AUTO_INCREMENT,
  `__nombre_tdoc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `__descripcion_tdoc` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `__detalle_tdoc` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`__id_tipoDocu_language`),
  KEY `IDX_DD2753CF45A700C2` (`idtipo_documento`),
  KEY `IDX_DD2753CF80E64D77` (`__id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_tipo__documento_language`
--

INSERT INTO `cms_tipo__documento_language` (`idtipo_documento`, `__id_language`, `__id_tipoDocu_language`, `__nombre_tdoc`, `__descripcion_tdoc`, `__detalle_tdoc`) VALUES
(1, 1, 1, 'DNI', 'Documento Nacional de Identidad', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_ubigeo`
--

CREATE TABLE IF NOT EXISTS `cms_ubigeo` (
  `__cod_postal` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `__dpto` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `__prov` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__dist` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__cregion` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__csubregion` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__cod_dpto` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__cod_prov` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__id_Pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`__cod_postal`),
  KEY `IDX_F5188083FC739DE` (`__id_Pais`),
  KEY `ubig_dpto_idx` (`__dpto`),
  KEY `ubig_prov_idx` (`__prov`),
  KEY `ubig_dist_idx` (`__dist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms_user`
--

CREATE TABLE IF NOT EXISTS `cms_user` (
  `__type_docu_user` smallint(6) DEFAULT NULL,
  `__idUser` int(11) NOT NULL AUTO_INCREMENT,
  `__role` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `__name_user` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `__address_user` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `__document_user` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__ocupation_user` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__phone_user` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__mobile_user` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `__email_user` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `__nick_user` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `__pass_user` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `__type_user` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `__state_user` tinyint(1) NOT NULL,
  `__registration_user` datetime DEFAULT NULL,
  `__modification_date_user` datetime DEFAULT NULL,
  PRIMARY KEY (`__idUser`),
  KEY `IDX_3AF03EC5C0C1627` (`__type_docu_user`),
  KEY `user_role_idx` (`__role`),
  KEY `user_email_idx` (`__email_user`),
  KEY `user_pass_idx` (`__pass_user`),
  KEY `user_state_idx` (`__state_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cms_user`
--

INSERT INTO `cms_user` (`__type_docu_user`, `__idUser`, `__role`, `__name_user`, `__address_user`, `__document_user`, `__ocupation_user`, `__phone_user`, `__mobile_user`, `__email_user`, `__nick_user`, `__pass_user`, `__type_user`, `__state_user`, `__registration_user`, `__modification_date_user`) VALUES
(1, 1, 'admin', 'Antonio', 'Salamanca', NULL, NULL, NULL, NULL, 'tonyprr@gmail.com', 'admin', '54ce18434ee5054ec75591b61624fe08', 'admin', 1, '2012-11-02 00:00:00', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart_carrito`
--
ALTER TABLE `cart_carrito`
  ADD CONSTRAINT `cart_carrito_ibfk_1` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_carrito_ibfk_2` FOREIGN KEY (`__id_moneda`) REFERENCES `cart_moneda` (`__id_moneda`),
  ADD CONSTRAINT `FK_8C3C76D2177770D3` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8C3C76D2B8EBCFA5` FOREIGN KEY (`__id_moneda`) REFERENCES `cart_moneda` (`__id_moneda`);

--
-- Filtros para la tabla `cart_carrito__producto`
--
ALTER TABLE `cart_carrito__producto`
  ADD CONSTRAINT `cart_carrito__producto_ibfk_1` FOREIGN KEY (`__id_carrito`) REFERENCES `cart_carrito` (`__id_carrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_carrito__producto_ibfk_2` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_816EC1F7948D5523` FOREIGN KEY (`__id_carrito`) REFERENCES `cart_carrito` (`__id_carrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_816EC1F7C9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_marca_language`
--
ALTER TABLE `cart_marca_language`
  ADD CONSTRAINT `cart_marca_language_ibfk_1` FOREIGN KEY (`__idMarca`) REFERENCES `cart_marca` (`__idMarca`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_marca_language_ibfk_2` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B0B771004A46E613` FOREIGN KEY (`__idMarca`) REFERENCES `cart_marca` (`__idMarca`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B0B7710080E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_movimiento__stock`
--
ALTER TABLE `cart_movimiento__stock`
  ADD CONSTRAINT `cart_movimiento__stock_ibfk_1` FOREIGN KEY (`__id_orden`) REFERENCES `cart_orden` (`__id_orden`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_movimiento__stock_ibfk_2` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_movimiento__stock_ibfk_3` FOREIGN KEY (`__id_movimiento_stock_tipo`) REFERENCES `cart_movimiento__stock_tipo` (`__id_movimiento_stock_tipo`),
  ADD CONSTRAINT `FK_1A096F3A6CF16A9A` FOREIGN KEY (`__id_orden`) REFERENCES `cart_orden` (`__id_orden`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1A096F3AC9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1A096F3AEECA34F6` FOREIGN KEY (`__id_movimiento_stock_tipo`) REFERENCES `cart_movimiento__stock_tipo` (`__id_movimiento_stock_tipo`);

--
-- Filtros para la tabla `cart_orden`
--
ALTER TABLE `cart_orden`
  ADD CONSTRAINT `cart_orden_ibfk_1` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`),
  ADD CONSTRAINT `cart_orden_ibfk_2` FOREIGN KEY (`__id_orden_estado`) REFERENCES `cart_orden__estado` (`__id_orden_estado`),
  ADD CONSTRAINT `cart_orden_ibfk_3` FOREIGN KEY (`__id_carrito`) REFERENCES `cart_carrito` (`__id_carrito`),
  ADD CONSTRAINT `cart_orden_ibfk_4` FOREIGN KEY (`__id_moneda`) REFERENCES `cart_moneda` (`__id_moneda`),
  ADD CONSTRAINT `FK_BEC2A2DF177770D3` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`),
  ADD CONSTRAINT `FK_BEC2A2DF391D3278` FOREIGN KEY (`__id_orden_estado`) REFERENCES `cart_orden__estado` (`__id_orden_estado`),
  ADD CONSTRAINT `FK_BEC2A2DF948D5523` FOREIGN KEY (`__id_carrito`) REFERENCES `cart_carrito` (`__id_carrito`),
  ADD CONSTRAINT `FK_BEC2A2DFB8EBCFA5` FOREIGN KEY (`__id_moneda`) REFERENCES `cart_moneda` (`__id_moneda`),
  ADD CONSTRAINT `FK_BEC2A2DFCF0E7B73` FOREIGN KEY (`__id_ubigeo`) REFERENCES `cms_ubigeo` (`__cod_postal`);

--
-- Filtros para la tabla `cart_orden__detalle`
--
ALTER TABLE `cart_orden__detalle`
  ADD CONSTRAINT `cart_orden__detalle_ibfk_1` FOREIGN KEY (`__id_orden`) REFERENCES `cart_orden` (`__id_orden`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_orden__detalle_ibfk_2` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_82254A936CF16A9A` FOREIGN KEY (`__id_orden`) REFERENCES `cart_orden` (`__id_orden`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_82254A93C9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_orden__estado_language`
--
ALTER TABLE `cart_orden__estado_language`
  ADD CONSTRAINT `cart_orden__estado_language_ibfk_1` FOREIGN KEY (`__id_orden_estado`) REFERENCES `cart_orden__estado` (`__id_orden_estado`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_orden__estado_language_ibfk_2` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C48823DF391D3278` FOREIGN KEY (`__id_orden_estado`) REFERENCES `cart_orden__estado` (`__id_orden_estado`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C48823DF80E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto`
--
ALTER TABLE `cart_producto`
  ADD CONSTRAINT `cart_producto_ibfk_1` FOREIGN KEY (`__idMarca`) REFERENCES `cart_marca` (`__idMarca`),
  ADD CONSTRAINT `cart_producto_ibfk_2` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`),
  ADD CONSTRAINT `cart_producto_ibfk_3` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3924497E4A46E613` FOREIGN KEY (`__idMarca`) REFERENCES `cart_marca` (`__idMarca`),
  ADD CONSTRAINT `FK_3924497E8EAB4527` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`),
  ADD CONSTRAINT `FK_3924497EA07E7B24` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto_comentario`
--
ALTER TABLE `cart_producto_comentario`
  ADD CONSTRAINT `cart_producto_comentario_ibfk_1` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto_comentario_ibfk_2` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A3BED91C177770D3` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A3BED91CC9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto_language`
--
ALTER TABLE `cart_producto_language`
  ADD CONSTRAINT `cart_producto_language_ibfk_1` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto_language_ibfk_2` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EC2FBEBE80E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EC2FBEBEC9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__categoria`
--
ALTER TABLE `cart_producto__categoria`
  ADD CONSTRAINT `cart_producto__categoria_ibfk_1` FOREIGN KEY (`__idContCate_Padre`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EBA38D2ED83BB542` FOREIGN KEY (`__idContCate_Padre`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__categoria_language`
--
ALTER TABLE `cart_producto__categoria_language`
  ADD CONSTRAINT `cart_producto__categoria_language_ibfk_1` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto__categoria_language_ibfk_2` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_72D6DF5D80E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_72D6DF5DA07E7B24` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__categoria_tipo`
--
ALTER TABLE `cart_producto__categoria_tipo`
  ADD CONSTRAINT `cart_producto__categoria_tipo_ibfk_1` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto__categoria_tipo_ibfk_2` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2A7E5BC18EAB4527` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2A7E5BC1A07E7B24` FOREIGN KEY (`__idContCate`) REFERENCES `cart_producto__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__galeria`
--
ALTER TABLE `cart_producto__galeria`
  ADD CONSTRAINT `cart_producto__galeria_ibfk_1` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D5ACFFFFC9EE6EC8` FOREIGN KEY (`__idProducto`) REFERENCES `cart_producto` (`__idProducto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__galeria_language`
--
ALTER TABLE `cart_producto__galeria_language`
  ADD CONSTRAINT `cart_producto__galeria_language_ibfk_1` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto__galeria_language_ibfk_2` FOREIGN KEY (`__idContGale`) REFERENCES `cart_producto__galeria` (`__idContGale`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_57E70AFE80E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_57E70AFEAD07742A` FOREIGN KEY (`__idContGale`) REFERENCES `cart_producto__galeria` (`__idContGale`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_producto__tipo_language`
--
ALTER TABLE `cart_producto__tipo_language`
  ADD CONSTRAINT `cart_producto__tipo_language_ibfk_1` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_producto__tipo_language_ibfk_2` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8FB0D14380E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8FB0D1438EAB4527` FOREIGN KEY (`__idTipo`) REFERENCES `cart_producto__tipo` (`__idTipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_cliente`
--
ALTER TABLE `cms_cliente`
  ADD CONSTRAINT `cms_cliente_ibfk_1` FOREIGN KEY (`__idtipo_documento`) REFERENCES `cms_tipo__documento` (`__idtipo_documento`),
  ADD CONSTRAINT `cms_cliente_ibfk_2` FOREIGN KEY (`__id_Pais`) REFERENCES `cms_pais` (`__id_Pais`),
  ADD CONSTRAINT `FK_AAF0943420C3C396` FOREIGN KEY (`__idtipo_documento`) REFERENCES `cms_tipo__documento` (`__idtipo_documento`),
  ADD CONSTRAINT `FK_AAF09434FC739DE` FOREIGN KEY (`__id_Pais`) REFERENCES `cms_pais` (`__id_Pais`);

--
-- Filtros para la tabla `cms_cliente__direccion`
--
ALTER TABLE `cms_cliente__direccion`
  ADD CONSTRAINT `cms_cliente__direccion_ibfk_1` FOREIGN KEY (`__id_tipo_direccion`) REFERENCES `cms_tipo__direccion` (`__id_tipo_direccion`),
  ADD CONSTRAINT `cms_cliente__direccion_ibfk_2` FOREIGN KEY (`_id__cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_cliente__direccion_ibfk_3` FOREIGN KEY (`__cod_postal`) REFERENCES `cms_ubigeo` (`__cod_postal`),
  ADD CONSTRAINT `cms_cliente__direccion_ibfk_4` FOREIGN KEY (`__id_Pais`) REFERENCES `cms_pais` (`__id_Pais`),
  ADD CONSTRAINT `FK_20DBC72340EF4DF3` FOREIGN KEY (`__id_tipo_direccion`) REFERENCES `cms_tipo__direccion` (`__id_tipo_direccion`),
  ADD CONSTRAINT `FK_20DBC7238E322433` FOREIGN KEY (`_id__cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_20DBC723E49AB9DF` FOREIGN KEY (`__cod_postal`) REFERENCES `cms_ubigeo` (`__cod_postal`),
  ADD CONSTRAINT `FK_20DBC723FC739DE` FOREIGN KEY (`__id_Pais`) REFERENCES `cms_pais` (`__id_Pais`);

--
-- Filtros para la tabla `cms_content`
--
ALTER TABLE `cms_content`
  ADD CONSTRAINT `cms_content_ibfk_1` FOREIGN KEY (`__idTipo`) REFERENCES `cms_content__tipo` (`__idTipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_content_ibfk_2` FOREIGN KEY (`__idContCate`) REFERENCES `cms_content__categoria` (`__idContCate`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A0293FB88EAB4527` FOREIGN KEY (`__idTipo`) REFERENCES `cms_content__tipo` (`__idTipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A0293FB8A07E7B24` FOREIGN KEY (`__idContCate`) REFERENCES `cms_content__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content_comentario`
--
ALTER TABLE `cms_content_comentario`
  ADD CONSTRAINT `FK_D075827D177770D3` FOREIGN KEY (`__id_cliente`) REFERENCES `cms_cliente` (`__id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D075827DC0AB0A3E` FOREIGN KEY (`__idContent`) REFERENCES `cms_content` (`__idContent`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content_language`
--
ALTER TABLE `cms_content_language`
  ADD CONSTRAINT `FK_16737A2080E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_16737A20C0AB0A3E` FOREIGN KEY (`__idContent`) REFERENCES `cms_content` (`__idContent`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content__categoria`
--
ALTER TABLE `cms_content__categoria`
  ADD CONSTRAINT `FK_9868D64FD83BB542` FOREIGN KEY (`__idContCate_Padre`) REFERENCES `cms_content__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content__categoria_language`
--
ALTER TABLE `cms_content__categoria_language`
  ADD CONSTRAINT `FK_722E113480E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_722E1134A07E7B24` FOREIGN KEY (`__idContCate`) REFERENCES `cms_content__categoria` (`__idContCate`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content__galeria`
--
ALTER TABLE `cms_content__galeria`
  ADD CONSTRAINT `FK_2FF03B61C0AB0A3E` FOREIGN KEY (`__idContent`) REFERENCES `cms_content` (`__idContent`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content__galeria_language`
--
ALTER TABLE `cms_content__galeria_language`
  ADD CONSTRAINT `FK_FB20632380E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FB206323AD07742A` FOREIGN KEY (`__idContGale`) REFERENCES `cms_content__galeria` (`__idContGale`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_content__tipo_language`
--
ALTER TABLE `cms_content__tipo_language`
  ADD CONSTRAINT `FK_8DC1AE7780E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8DC1AE778EAB4527` FOREIGN KEY (`__idTipo`) REFERENCES `cms_content__tipo` (`__idTipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_tipo__direccion_language`
--
ALTER TABLE `cms_tipo__direccion_language`
  ADD CONSTRAINT `FK_BCD9FE440EF4DF3` FOREIGN KEY (`__id_tipo_direccion`) REFERENCES `cms_tipo__direccion` (`__id_tipo_direccion`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BCD9FE480E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_tipo__documento_language`
--
ALTER TABLE `cms_tipo__documento_language`
  ADD CONSTRAINT `FK_DD2753CF45A700C2` FOREIGN KEY (`idtipo_documento`) REFERENCES `cms_tipo__documento` (`__idtipo_documento`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DD2753CF80E64D77` FOREIGN KEY (`__id_language`) REFERENCES `cms_language` (`__id_language`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_ubigeo`
--
ALTER TABLE `cms_ubigeo`
  ADD CONSTRAINT `FK_F5188083FC739DE` FOREIGN KEY (`__id_Pais`) REFERENCES `cms_pais` (`__id_Pais`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cms_user`
--
ALTER TABLE `cms_user`
  ADD CONSTRAINT `FK_3AF03EC5C0C1627` FOREIGN KEY (`__type_docu_user`) REFERENCES `cms_tipo__documento` (`__idtipo_documento`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
