<?php
use cart\Services\OrdenService;
use cart\Services\OrdenDetalleService;
use Tonyprr\Exception\ValidacionException;

class Api_VisaController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        if ($this->_request->isGet()) {
            $this->_forward('get');
        } else {
            $this->getResponse()->setHttpResponseCode(500);
        }
    }

    public function getAction()
    {
    }

    public function postAction()
    {
    }

    public function putAction()
    {
        try {
            $body = $this->getRequest()->getRawBody();
            $data = Zend_Json::decode($body);
            $dataStorage = Zend_Auth::getInstance()->getStorage()->read();
            
            //Se asigna la url del servicio
            $servicio= URL_WSGENERAETICKET_VISA;
            if ($data['operacion'] == "obtener_eticket") {
                $clientVisa = new Zend_Soap_Client($servicio);
                $orden = $data['orden'];
                $cliente = $data['cliente'];
                $totalMonto = $orden['subTotal'] + $orden['costoEnvio'];
				$datoComercio= "TEST DELIBOUQUET";

				//Se arma el XML de requerimiento
				$xmlIn = "";
				$xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
				$xmlIn = $xmlIn . "<nuevo_eticket>";
				$xmlIn = $xmlIn . "	<parametros>";
				$xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
				$xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
				$xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . CODIGO_TIENDA . "</parametro>";
				$xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $orden['idOrden'] . "</parametro>";
				$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" . $totalMonto . "</parametro>";
				
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
				$result = $clientVisa->GeneraEticket($parametros);

		                //Muestra la cadena recibida
				//echo 'Cadena de respuesta: ' . $result->GeneraEticketResult . '<br>' . '<br>';
				
				//Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
				$xmlDocument = new DOMDocument();
				
				$result['success'] = 0;
				if ($xmlDocument->loadXML($result->GeneraEticketResult)) {
					/////////////////////////[MENSAJES]////////////////////////
					//Ejemplo para determinar la cantidad de mensajes en el XML
					$iCantMensajes= $this->CantidadMensajes($xmlDocument);
					//echo 'Cantidad de Mensajes: ' . $iCantMensajes . '<br>';
					
					if ($iCantMensajes == 0) {
						$Eticket= $this->RecuperaEticket($xmlDocument);
						//echo 'Eticket: ' . $Eticket;
						$html= $this->htmlRedirecFormEticket($Eticket);
						echo $html;
						exit;
						$result['msg'] = "obtencion de nro ticket exitosa";
			            $result['success'] = 1;

					} else {
						//Ejemplo para mostrar los mensajes del XML 
						for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++){
							$mensaje = 'Mensaje #' . ($iNumMensaje +1) . ': ';
							$mensaje.=$this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
							$mensaje.='<BR>';
							$mensaje.="Numero de pedido: " . $orden['idOrden'];
						}
						/////////////////////////[MENSAJES]////////////////////////
						$result['msg'] = $mensaje;
					
					}
							
				} else {
					$result['msg'] = "Error en la obtencion de la data desde VISA";
				}	
                
            }
            
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    
    }

    public function deleteAction()
    {
        // action body
    }


	function CantidadMensajes($xmlDoc){
		$cantMensajes= 0;
		$xpath = new DOMXPath($xmlDoc);
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
	function RecuperaMensaje($xmlDoc,$iNumMensaje){
		$strReturn = "";
			
			$xpath = new DOMXPath($xmlDoc);
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
	function RecuperaEticket($xmlDoc){
		$strReturn = "";
			
			$xpath = new DOMXPath($xmlDoc);
			$nodeList = $xpath->query("//registro/campo[@id='ETICKET']");
			
			$XmlNode= $nodeList->item(0);
			
			if($XmlNode==null){
				$strReturn = "";
			}else{
				$strReturn = $XmlNode->nodeValue;
			}
			return $strReturn;
	}

        function htmlRedirecFormEticket($ETICKET){
                $html='<Html>
                <head>
                <title>Pagina prueba Visa</title>
                </head>
                <Body onload="fm.submit();">

                <form name="fm" method="post" action="'.URL_FORMULARIO_VISA.'">
                    <input type="hidden" name="ETICKET" value="#ETICKET#" /><BR>
                    <!--<input type="submit" name="boton" value="Pagar" /><BR>-->
                </form>
                </Body>
                </Html>';

                $html= str_replace("#ETICKET#", $ETICKET, $html);

                return $html;
        }

}



