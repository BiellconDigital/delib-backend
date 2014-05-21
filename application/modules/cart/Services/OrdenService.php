<?php

namespace cart\Services;

/**
 * Description of Orden
 *
 * @author aramosr
 */
class OrdenService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartOrden";
    private $_pathOrden;

    private $accionesVisa = array(
        "000" => array("mensajeCliente" => "Transaccion Autorizada", 
                      "mensajeComercio" => "Transaccion Autorizada")
        
        ,"101" => array("mensajeCliente" => "Operación Denegada. Tarjeta Vencida. Verifique los datos en su tarjeta e ingréselos correctamente.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta Vencida.")

        ,"102" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.",
                      "mensajeComercio" => "Operación Denegada. Contactar con la entidad emisora.")

        ,"104" => array("mensajeCliente" => "Operación Denegada. Operación no permitida para esta tarjeta. Contactar con la entidad", 
                       "mensajeComercio" => "Operación Denegada. Operación no permitida para esta tarjeta. ")

        ,"106" => array("mensajeCliente" => "Operación Denegada. Intentos de clave secreta excedidos. Contactar con la entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Exceso de intentos de ingreso de clave secreta.")

        ,"107" => array("mensajeCliente" => "Operación Denegada. Contactar con la entidad emisora de su tarjeta.", 
                      "mensajeComercio" => "Operación Denegada. Contactar con la entidad emisora.")

        ,"108" => array("mensajeCliente" => "Operación Denegada. Contactar con la entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Exceso de actividad.")

        ,"109" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. Identificación inválida de establecimiento.")

        ,"110" => array("mensajeCliente" => "Operación Denegada. Operación no permitida para esta tarjeta. Contactar con la entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Operación no permitida para esta tarjeta.")

        ,"111" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. El monto de la transacción supera el valor máximo permitido para operaciones virtuales.")

        ,"112" => array("mensajeCliente" => "Operación Denegada. Se requiere clave secreta.", 
                       "mensajeComercio" => "Operación Denegada. Se requiere clave secreta.")

        ,"116" => array("mensajeCliente" => "Operación Denegada. Fondos insuficientes. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Fondos insuficientes.")

        ,"117" => array("mensajeCliente" => "Operación Denegada. Clave secreta incorrecta.", 
                       "mensajeComercio" => "Operación Denegada. Clave secreta incorrecta.")

        ,"118" => array("mensajeCliente" => "Operación Denegada. Tarjeta Inválida. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta inválida.")

        ,"119" => array("mensajeCliente" => "Operación Denegada. Intentos de clave secreta excedidos. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Exceso de intentos de ingreso de clave secreta.")

        ,"121" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"126" => array("mensajeCliente" => "Operación Denegada. Clave secreta inválida.", 
                       "mensajeComercio" => "Operación Denegada. Clave secreta inválida.")

        ,"129" => array("mensajeCliente" => "Operación Denegada. Código de seguridad invalido. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta no operativa.")

        ,"180" => array("mensajeCliente" => "Operación Denegada. Tarjeta Inválida. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta inválida.")

        ,"181" => array("mensajeCliente" => "Operación Denegada. Tarjeta con restricciones de débito. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta con restricciones de Débito.")

        ,"182" => array("mensajeCliente" => "Operación Denegada. Tarjeta con restricciones de crédito. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta con restricciones de Crédito.")

        ,"183" => array("mensajeCliente" => "Operación Denegada. Problemas de comunicación. Intente más tarde.", 
                       "mensajeComercio" => "Operación Denegada. Error de sistema.")

        ,"190" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"191" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"192" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"199" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"201" => array("mensajeCliente" => "Operación Denegada. Tarjeta vencida. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta vencida.")

        ,"202" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"204" => array("mensajeCliente" => "Operación Denegada. Operación no permitida para esta tarjeta. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Operación no permitida para esta tarjeta.")

        ,"206" => array("mensajeCliente" => "Operación Denegada. Intentos de clave secreta excedidos. Contactar con la entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Exceso de intentos de ingreso de clave secreta.")

        ,"207" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"208" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta perdida.")

        ,"209" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta robada.")

        ,"263" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. Error en el envío de parámetros.")

        ,"264" => array("mensajeCliente" => "Operación Denegada. Entidad emisora de la tarjeta no está disponible para realizar la autenticación.", 
                       "mensajeComercio" => "Operación Denegada. Entidad emisora no está disponible para realizar la autenticación.")

        ,"265" => array("mensajeCliente" => "Operación Denegada. Clave secreta del tarjetahabiente incorrecta. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Clave secreta del tarjetahabiente incorrecta.")

        ,"266" => array("mensajeCliente" => "Operación Denegada. Tarjeta Vencida. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta vencida.")

        ,"280" => array("mensajeCliente" => "Operación Denegada. Clave secreta errónea. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Clave errónea.")

        ,"290" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"300" => array("mensajeCliente" => "Operación Denegada. Número de pedido del comercio duplicado. Favor no atender.", 
                       "mensajeComercio" => "Operación Denegada. Número de pedido del comercio duplicado. Favor no atender.")

        ,"306" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"401" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. Tienda inhabilitada.")

        ,"402" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"403" => array("mensajeCliente" => "Operación Denegada. Tarjeta no autenticada.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta no autenticada.")

        ,"404" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. El monto de la transacción supera el valor máximo permitido.")

        ,"405" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. La tarjeta ha superado la cantidad máxima de transacciones en el día.")

        ,"406" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. La tienda ha superado la cantidad máxima de transacciones en el día.")

        ,"407" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. El monto de la transacción no llega al mínimo permitido.")

        ,"408" => array("mensajeCliente" => "Operación Denegada. Código de seguridad no coincide. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. CVV2 no coincide.")

        ,"409" => array("mensajeCliente" => "Operación Denegada. Código de seguridad no procesado por la entidad emisora de la tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. CVV2 no procesado por entidad emisora.")

        ,"410" => array("mensajeCliente" => "Operación Denegada. Código de seguridad no ingresado.", 
                       "mensajeComercio" => "Operación Denegada. CVV2 no procesado por no ingresado.")

        ,"411" => array("mensajeCliente" => "Operación Denegada. Código de seguridad no procesado por la entidad emisora de la tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. CVV2 no procesado por entidad emisora.")

        ,"412" => array("mensajeCliente" => "Operación Denegada. Código de seguridad no reconocido por la entidad emisora de la tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. CVV2 no reconocido por entidad emisora.")


        ,"413" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"414" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"415" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")


        ,"416" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"417" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"418" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")


        ,"419" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")

        ,"420" => array("mensajeCliente" => "Operación Denegada. Tarjeta no es VISA.", 
                       "mensajeComercio" => "Operación Denegada. Tarjeta no es VISA.")

        ,"421" => array("mensajeCliente" => "Operación Denegada. Contactar con entidad emisora de su tarjeta.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")


        ,"422" => array("mensajeCliente" => "Operación Denegada. El comercio no está configurado para usar este medio de pago. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. El comercio no está configurado para usar este medio de pago.")

        ,"423" => array("mensajeCliente" => "Operación Denegada. Se canceló el proceso de pago.", 
                       "mensajeComercio" => "Operación Denegada. Se canceló el proceso de pago.")

        ,"424" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")


        ,"666" => array("mensajeCliente" => "Operación Denegada. Problemas de comunicación. Intente más tarde.", 
                       "mensajeComercio" => "Operación Denegada. Problemas de comunicación. Intente más tarde.")

        ,"667" => array("mensajeCliente" => "Operación Denegada. Transacción sin respuesta de Verified by Visa.", 
                       "mensajeComercio" => "Operación Denegada. Transacción sin autenticación. Inicio del Proceso de Pago")

        ,"668" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada.")


        ,"669" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. Módulo antifraude.")

        ,"670" => array("mensajeCliente" => "Operación Denegada. Contactar con el comercio.", 
                       "mensajeComercio" => "Operación Denegada. Módulo antifraude.")

        ,"904" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Formato de mensaje erróneo.")


        ,"909" => array("mensajeCliente" => "Operación Denegada. Problemas de comunicación. Intente más tarde.", 
                       "mensajeComercio" => "Operación Denegada. Error de sistema.")

        ,"910" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Error de sistema.")

        ,"912" => array("mensajeCliente" => "Operación Denegada. Entidad emisora de la tarjeta no disponible", 
                       "mensajeComercio" => "Operación Denegada. Entidad emisora no disponible.")


        ,"913" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Transmisión duplicada.")

        ,"916" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"928" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")


        ,"940" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Transacción anulada previamente.")

        ,"941" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Transacción ya anulada previamente.")

        ,"942" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada.")


        ,"943" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Datos originales distintos.")

        ,"945" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Referencia repetida.")

        ,"946" => array("mensajeCliente" => "Operación Denegada. Operación de anulación en proceso.", 
                       "mensajeComercio" => "Operación Denegada. Operación de anulación en proceso.")


        ,"947" => array("mensajeCliente" => "Operación Denegada. Problemas de comunicación. Intente más tarde.", 
                       "mensajeComercio" => "Operación Denegada. Comunicación duplicada.")

        ,"948" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")

        ,"949" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")


        ,"965" => array("mensajeCliente" => "Operación Denegada.", 
                       "mensajeComercio" => "Operación Denegada. Contactar con entidad emisora.")



    );
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrden, $total) = $this->_em->getRepository($this->_entity)->listRecords($ordenEstado, $oLanguage, $pageStart, $pageLimit);
        $resultados = $qyOrden->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    public function aListRecordsXCliente($oCliente, $ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrden, $total) = $this->_em->getRepository($this->_entity)->listRecordsXCliente($oCliente, $ordenEstado, $oLanguage, $pageStart, $pageLimit);
        $resultados = $qyOrden->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    public function listRecordsXClienteThumb($oCliente, $ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        return $this->_em->getRepository($this->_entity)->
                listRecordsXClienteThumb($oCliente, $ordenEstado, $oLanguage, $pageStart, $pageLimit);
    }

    
    /**
     * 
     * @param array $formData
     * @return \cart\Entity\CartOrden
     */
    public function save($formData) {
        $aOrden = $this->_em->getRepository($this->_entity)->save($formData);
        return $aOrden;
    }
    
    public function registrarPago($formData) {
        $aOrden = $this->_em->getRepository($this->_entity)->registrarPago($formData);
        return $aOrden;
    }
    
    public function registrarCodigoTransaccion($idOrden, $codigoTransaccion) {
        $aOrden = $this->_em->getRepository($this->_entity)->registrarCodigoTransaccion($idOrden, $codigoTransaccion);
        return $aOrden;
    }
    
    public function terminarTransaccionVisa($codigoTransaccion) {
        $aOrden = $this->_em->getRepository($this->_entity)->terminarTransaccionVisa($codigoTransaccion);
//        $idOrden = $aOrden->getIdOrden();
//        $montoTotal = $aOrden->getCostoEnvio() + $aOrden->getTotalFinal();
//        $this->actualizarOrdenVisa($idOrden, $montoTotal, $codigoTransaccion);
        return $aOrden;
    }
    
    /**
     * 
     * @param int $id
     * @param boolean $asArray
     * @param \web\Entity\CmsCliente $oCliente
     * @return \cart\Entity\CartOrden $oOrden
     */
    public function getById($id, $asArray=true, $oCliente=NULL) {
        $oOrden = $this->_em->getRepository($this->_entity)->getById($id, $asArray, $oCliente);
        return $oOrden;
    }
    
    public function getUltimaOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
        $oOrden = $this->_em->getRepository($this->_entity)->getUltimaOrden($oCliente, $oOrdenEstado, $asArray);
        return $oOrden;
    }
    
    /**
     *
     * @param \web\Entity\CmsCliente $oCliente
     * @param \cart\Entity\CartOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return \cart\Entity\CartOrden
     */
    public function getPrimeraOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
        $oOrden = $this->_em->getRepository($this->_entity)->getPrimeraOrden($oCliente, $oOrdenEstado, $asArray);
        return $oOrden;
    }
    
    /**
     *
     * @param array $formData
     * @return \cart\Entity\CartOrden 
     */
    public function cambiarEstado($formData) {
        $oOrden = $this->_em->getRepository($this->_entity)->cambiarEstado($formData);
        return $oOrden;
    }
    
    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarRegistroOrden(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarRegistroOrden($oOrden);
    }
    
    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarRegistroPagoOrden(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarRegistroPagoOrden($oOrden);
    }

    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarPagoConfirmado(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarPagoConfirmado($oOrden);
    }
    

    
    public function generarTicketVisa($idOrden, $totalMonto, $cliente) {
        //Se asigna la url del servicio
        $servicio= URL_WSGENERAETICKET_VISA;
        $clientVisa = new \Zend_Soap_Client($servicio);
        
        $datoComercio= "DELIBOUQUET";

        //Se arma el XML de requerimiento
        $xmlIn = "";
        $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
        $xmlIn = $xmlIn . "<nuevo_eticket>";
        $xmlIn = $xmlIn . "	<parametros>";
        $xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . CODIGO_TIENDA . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $idOrden . "</parametro>";
	$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" . number_format($totalMonto, 2, '.', '') . "</parametro>";
        //$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">120.00</parametro>";

        $xmlIn = $xmlIn . "		<parametro id=\"NOMBRE\">" . $cliente['nombres'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"APELLIDO\">" . $cliente['apellidoPaterno'] . " " . $cliente['apellidoMaterno'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"CIUDAD\">" . $cliente['ciudad'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"DIRECCION\">" . $cliente['direccion'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"CORREO\">" . $cliente['email'] . "</parametro>";

        $xmlIn = $xmlIn . "		<parametro id=\"DATO_COMERCIO\">" . $datoComercio . "</parametro>";
        $xmlIn = $xmlIn . "	</parametros>";
        $xmlIn = $xmlIn . "</nuevo_eticket>";


        //parametros de la llamada
        $parametros=array(); 
        $parametros['xmlIn']= $xmlIn;
        $mensaje = "";

        //Aqui captura la cadena de resultado
        $resultVisa = $clientVisa->GeneraEticket($parametros);

        //Muestra la cadena recibida
        //echo 'Cadena de respuesta: ' . $result->GeneraEticketResult . '<br>' . '<br>';

        //Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
        $xmlDocument = new \DOMDocument();

        $result['success'] = 0;
        if ($xmlDocument->loadXML($resultVisa->GeneraEticketResult)) {
                /////////////////////////[MENSAJES]////////////////////////
                //Ejemplo para determinar la cantidad de mensajes en el XML
                $iCantMensajes= $this->CantidadMensajes($xmlDocument);
                //echo 'Cantidad de Mensajes: ' . $iCantMensajes . '<br>';

                if ($iCantMensajes == 0) {
                        $Eticket= $this->RecuperaEticket($xmlDocument);
                        //echo 'Eticket: ' . $Eticket;
                        //$html= $this->htmlRedirecFormEticket($Eticket);
                        //echo $html;
                        //exit;

                        $ordenService = new OrdenService();
                        $ordenService->registrarCodigoTransaccion($idOrden, $Eticket);
                        $result['msg'] = "obtencion de nro ticket exitosa";
                        $result['Eticket'] = $Eticket;
                        $result['urlVisa'] = URL_FORMULARIO_VISA;
                        $result['success'] = 1;

                } else {
                        //Ejemplo para mostrar los mensajes del XML 
                        for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++){
                                $mensaje.='Mensaje #' . ($iNumMensaje +1) . ': ';
                                $mensaje.=$this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
                                $mensaje.='<BR>';
                                $mensaje.="Numero de pedido: " . $idOrden;
                        }
                        /////////////////////////[MENSAJES]////////////////////////
                        $result['msg'] = $mensaje;// . "<br/><br/><br/>" . $xmlIn; 

                }

        } else {
                $result['msg'] = "Error en la obtencion de la data desde VISA";
        }	
                
        return $result;
    }
    
    
    public function actualizarOrdenVisa($idOrden, $idOrdenEstado, $montoTotal, $codigoTransaccion) {
            //Se asigna la url del servicio
            $servicio= URL_WSCONSULTAETICKET_VISA;
            $clientVisa = new \Zend_Soap_Client($servicio);

            //Se arma el XML de requerimiento
            $xmlIn = "";
            $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
            $xmlIn = $xmlIn . "<consulta_eticket>";
            $xmlIn = $xmlIn . "	<parametros>";
            $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">";
            $xmlIn = $xmlIn . CODIGO_TIENDA;//Aqui se asigna el Código de tienda
            $xmlIn = $xmlIn . "</parametro>";
            $xmlIn = $xmlIn . "		<parametro id=\"ETICKET\">";
            $xmlIn = $xmlIn . $codigoTransaccion;//Aqui se asigna el eTicket
            $xmlIn = $xmlIn . "</parametro>";
            $xmlIn = $xmlIn . "	</parametros>";
            $xmlIn = $xmlIn . "</consulta_eticket>";
            
            //parametros de la llamada
            $parametros=array(); 
            $parametros['xmlIn']= $xmlIn;
            $mensaje = "";
            $result['success'] = 1;
            $result['update'] = 0;
            $result['data'] = null;

            //Aqui captura la cadena de resultado
            $resultVisa = $clientVisa->ConsultaEticket($parametros);
            
            //Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
            $xmlDocument = new \DOMDocument();
            if ($xmlDocument->loadXML($resultVisa->ConsultaEticketResult)) {

                    //Ejemplo para determinar la cantidad de operaciones 
                    //asociadas al Nro. de pedido
                    $iCantOpe = $this->CantidadOperaciones($xmlDocument, $codigoTransaccion);
//                    $HTML= $HTML . "<span class='texto'>Cantidad de Operaciones: " . $iCantOpe . "</span><br><br>";
                    if ($iCantOpe > 0) {
                        //Ejemplo para mostrar los parà¬¥tros de las operaciones
                        //asociadas al Nro. de pedido
//                        for($iNumOperacion=0;$iNumOperacion < $iCantOpe; $iNumOperacion++) {
//                            $HTML= $HTML . $this->obtenerResultado($xmlDocument, $iNumOperacion+1);
//                        }
                        $resultadoVisa = $this->obtenerResultado($xmlDocument, 1);
                        $result['data'] = $resultadoVisa;
                        if ( intval($idOrdenEstado) !=  \cart\Repositories\CartOrdenEstadoRepository::$CANCELADO 
                                and intval($resultadoVisa['respuesta']) == 1
                                //and floatval($montoTotal) == floatval($resultadoVisa['Imp_autorizado']) 
                                ) {
                            
                            $fechaDeposito = new \DateTime($resultadoVisa['Fechayhora_tx']);
                            $formData['idOrden'] = $idOrden;
                            $formData['idOrdenEstado'] = 3;
                            $formData['fechaDeposito'] = $fechaDeposito->format("Y-m-d");
                            $formData['horaDeposito'] = $fechaDeposito->format("h:i");
                            $this->cambiarEstado($formData);
                            $result['update'] = 1;
                            $result['fechaDeposito'] = $formData['fechaDeposito'];
                            $result['horaDeposito'] = $formData['horaDeposito'];
                            $result['idOrdenEstado'] = 3;
                        }
                    }
                    
                    //Ejemplo para determinar la cantidad de mensajes 
                    //asociadas al Nro. de pedido
                    $iCantMensajes= $this->CantidadMensajes($xmlDocument);
//                    $HTML= $HTML . '<br><br>Cantidad de Mensajes: ' . $iCantMensajes . '<br>';

                    //Ejemplo para mostrar los mensajes de las operaciones
                    //asociadas al Nro. de pedido
                    for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++) {
//                            $HTML= $HTML . 'Mensaje #' . ($iNumMensaje +1) . ': ';
//                            $HTML= $HTML . $this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
//                            $HTML= $HTML . '<BR>';
                        $mensaje.='Mensaje #' . ($iNumMensaje +1) . ': ';
                        $mensaje.=$this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
                        $mensaje.='<BR>';
                        $mensaje.="Numero de pedido: " . $idOrden;
                    }
                    /////////////////////////[MENSAJES]////////////////////////
                    $result['msg'] = $mensaje; 
                    
//                    echo $HTML;
            } else {
                $result['msg'] = "Error al obtener informacion de VISA";
            $result['success'] = 0;
            }
            
            return $result;
    }

    
    private function CantidadMensajes($xmlDoc){
            $cantMensajes= 0;
            $xpath = new \DOMXPath($xmlDoc);
            $nodeList = $xpath->query('//mensajes', $xmlDoc);

            $XmlNode= $nodeList->item(0);

            if($XmlNode==null){
                    $cantMensajes= 0;
            }else{
                    $cantMensajes= $XmlNode->childNodes->length;
            }
            return $cantMensajes; 
    }
    
    //Funcion que recupera el valor de uno de los mensajes XML de respuesta
    private function RecuperaMensaje($xmlDoc,$iNumMensaje){
            $strReturn = "";

                    $xpath = new \DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//mensajes/mensaje[@id='" . $iNumMensaje . "']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }
    
    //Funcion que recupera el valor del Eticket
    private function RecuperaEticket($xmlDoc){
            $strReturn = "";

                    $xpath = new \DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//registro/campo[@id='ETICKET']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }

    //Funcion de ejemplo que obtiene la cantidad de operaciones
    private function CantidadOperaciones($xmlDoc, $eTicket){
            $cantidaOpe= 0;
            $xpath = new \DOMXPath($xmlDoc);
            $nodeList = $xpath->query('//pedido[@eticket="' . $eTicket . '"]', $xmlDoc);

            $XmlNode= $nodeList->item(0);

            if($XmlNode==null){
                    $cantidaOpe= 0;
            }else{
                    $cantidaOpe= $XmlNode->childNodes->length;
            }
            return $cantidaOpe; 
    }

    //Funcion que recupera el valor de uno de los campos del XML de respuesta
    private function RecuperaCampos($xmlDoc,$sNumOperacion,$nomCampo){
                    $strReturn = "";

                    $xpath = new \DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//operacion[@id='" . $sNumOperacion . "']/campo[@id='" . $nomCampo . "']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }

    private function obtenerResultado($xmlDoc, $iNumOperacion) {
        $sNumOperacion = $iNumOperacion;
        $resultado = array();
        $resultado['respuesta'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "respuesta");
        $resultado['estado'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "estado");
        $resultado['cod_tienda'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_tienda");
        $resultado['nordent'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nordent");
        $resultado['cod_accion'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_accion");
        $resultado['msj_accion_comercio'] = $this->obtenerMsjComercioAccionVisa($resultado['cod_accion']);
        $resultado['msj_accion_cliente'] = $this->obtenerMsjClienteAccionVisa($resultado['cod_accion']);

        $resultado['pan'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "pan");
        $resultado['nombre_th'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nombre_th");
        $resultado['ori_tarjeta'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "ori_tarjeta");
        $resultado['nom_emisor'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nom_emisor");
        $resultado['eci'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "eci");
        $resultado['dsc_eci'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "dsc_eci");
        $resultado['cod_autoriza'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_autoriza");
        $resultado['cod_rescvv2'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_rescvv2");
        $resultado['id_unico'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "id_unico");
        $resultado['imp_autorizado'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "imp_autorizado");
        $resultado['fechayhora_tx'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_tx");
        $resultado['fechayhora_deposito'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_deposito");
        $resultado['fechayhora_devolucion'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_devolucion");
        $resultado['dato_comercio'] = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "dato_comercio");
        return $resultado;
    }
    
    //Funcion que muestra en pantalla los parà¬¥tros de cada operacion
    //asociada al Nro. de pedido consultado
    private function PresentaResultado($xmlDoc, $iNumOperacion){
            //ESTA FUNCION ES SOLAMENTE UN EJEMPLO DE COMO ANALIZAR LA RESPUESTA
            $sNumOperacion = "";
            $sNumOperacion = $iNumOperacion;
            $strValor = "";
            $strValor = $strValor . "<UL>";
            $strValor = $strValor . "<span class='texto'><LI> Respuesta: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "respuesta") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Estado: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "estado") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Cod_tienda: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "cod_tienda") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Nordent: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "nordent") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Cod_accion: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "cod_accion") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Pan: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "pan") . "<BR>";
            $strValor = $strValor . "<span class='texto'><LI> Nombre_th: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "nombre_th") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Ori_tarjeta: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "ori_tarjeta") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Nom_emisor: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "nom_emisor") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> ECI: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "eci") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Dsc_ECI: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "dsc_eci") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Cod_autoriza: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "cod_autoriza") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Cod_rescvv2: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "cod_rescvv2") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> ID_UNICO: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "id_unico") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Imp_autorizado: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "imp_autorizado") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Fechayhora_tx: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_tx") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Fechayhora_deposito: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_deposito") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Fechayhora_devolucion: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_devolucion") . "</span><BR>";
            $strValor = $strValor . "<span class='texto'><LI> Dato_comercio: " . $this-> RecuperaCampos($xmlDoc, $sNumOperacion, "dato_comercio") . "</span><BR>";
            $strValor = $strValor . "</UL>";

            return $strValor;
    }

    private function obtenerMsjComercioAccionVisa($cod_accion) {
        return $this->accionesVisa[$cod_accion]['mensajeComercio'];
    }

    private function obtenerMsjClienteAccionVisa($cod_accion) {
        return $this->accionesVisa[$cod_accion]['mensajeCliente'];
    }

//    //Funcion de ejemplo que obtiene la cantidad de mensajes
//    private function CantidadMensajes($xmlDoc){
//            $cantMensajes= 0;
//            $xpath = new DOMXPath($xmlDoc);
//            $nodeList = $xpath->query('//mensajes', $xmlDoc);
//
//            $XmlNode= $nodeList->item(0);
//
//            if($XmlNode==null){
//                    $cantMensajes= 0;
//            }else{
//                    $cantMensajes= $XmlNode->childNodes->length;
//            }
//            return $cantMensajes; 
//    }
//
//    //Funcion que recupera el valor de uno de los mensajes XML de respuesta
//    private function RecuperaMensaje($xmlDoc,$iNumMensaje){
//            $strReturn = "";
//
//                    $xpath = new DOMXPath($xmlDoc);
//                    $nodeList = $xpath->query("//mensajes/mensaje[@id='" . $iNumMensaje . "']");
//
//                    $XmlNode= $nodeList->item(0);
//
//                    if($XmlNode==null){
//                            $strReturn = "";
//                    }else{
//                            $strReturn = $XmlNode->nodeValue;
//                    }
//                    return $strReturn;
//    }

    
}

