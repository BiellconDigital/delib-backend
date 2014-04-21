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
        
        $datoComercio= "TEST DELIBOUQUET";

        //Se arma el XML de requerimiento
        $xmlIn = "";
        $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
        $xmlIn = $xmlIn . "<nuevo_eticket>";
        $xmlIn = $xmlIn . "	<parametros>";
        $xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . CODIGO_TIENDA . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $idOrden . "</parametro>";
//				$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" .strval(round(1.0*$totalMonto, 2)) . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">120.00</parametro>";

        $xmlIn = $xmlIn . "		<parametro id=\"NOMBRE\">" . $cliente['nombres'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"APELLIDO\">" . $cliente['apellidoPaterno'] . " " . $cliente['apellidoMaterno'] . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"CIUDAD\">" . "Lima" . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"DIRECCION\">" . "SJM" . "</parametro>";
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
                        if ( $idOrdenEstado !=  \cart\Repositories\CartOrdenEstadoRepository::$CANCELADO 
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

