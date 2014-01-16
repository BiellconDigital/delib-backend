<?php
// bootstrap.php
//defined('APPLICATION_PATH')
//    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
//define('DS', DIRECTORY_SEPARATOR);

//require_once "entities/User.php";
//require_once "entities/Product.php";
//require_once "../application/Models/CmsCarrito.php";
//require_once "../application/Models/CmsCarritoProducto.php";
//require_once "../application/Models/CmsCliente.php";
//require_once "../application/Models/CmsClienteDireccion.php";
//set_include_path(implode(PATH_SEPARATOR, array(
//    realpath(APPLICATION_PATH . '/../library'),
//    realpath(APPLICATION_PATH . DS . 'modules'),
//    get_include_path(),
//)));
//
//use Models\CmsCarrito;
//use Models\CmsCarritoProducto;

//require_once "./data/entities/CmsCarrito.php";
//require_once "./data/entities/CmsCarritoProducto.php";
//require_once "./data/entities/CmsCliente.php";
//require_once "./data/entities/CmsClienteDireccion.php";
//require_once "./data/entities/CmsIdioma.php";
//require_once "./data/entities/CmsKeys.php";
//require_once "./data/entities/CmsMarca.php";
//require_once "./data/entities/CmsMoneda.php";
//require_once "./data/entities/CmsMovimientoStock.php";
//require_once "./data/entities/CmsMovimientoStockTipo.php";
//require_once "./data/entities/CmsOrden.php";
//require_once "./data/entities/CmsOrdenDetalle.php";
//require_once "./data/entities/CmsOrdenEstado.php";
//require_once "./data/entities/CmsPais.php";
//require_once "./data/entities/CmsPreguntas.php";
//require_once "./data/entities/CmsProducto.php";
//require_once "./data/entities/CmsProductoCategoria.php";
//require_once "./data/entities/CmsProductoComentario.php";
//require_once "./data/entities/CmsProductoGaleria.php";
//require_once "./data/entities/CmsTipoDireccion.php";
//require_once "./data/entities/CmsTipoDocumento.php";
//require_once "./data/entities/CmsTips.php";
//
//require_once "./data/entities/CmsPais.php";
//require_once "./data/entities/CmsTipoDocumento.php";
//require_once "./data/entities/CmsUsers.php";
//require_once "./data/entities/CmsUbigeo.php";


if (!class_exists("Doctrine\Common\Version", false)) {
    require_once "bootstrap_doctrine.php";
}