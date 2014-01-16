<?php
use cart\Services\Producto;
use cart\Services\ProductoCategoria;

class Cart_ProductosController extends Zend_Controller_Action
{

    private $_flashMessenger = null;

    public function init()
    {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_flashMessenger->clearCurrentMessages();
        $this->initView();
    }

    public function indexAction()
    {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $this->_helper->layout->setLayout('cart-productos-int');
        //$this -> view -> idioma = $authSesion->idioma;
        $this -> view -> htmlCategorias = null;
        $this -> view -> idprod = null;
        $this -> view -> aProductoCategorias = NULL;
        $this -> view -> oProductoCategoriaLang = null;
        try {
                $data = $this->getRequest()->getParams();
                $idpadre = isset($data['padre'])?$data['padre']:1;
                $daoProCategoria = new ProductoCategoria();
                if (isset($data['id'])) {
                    $idCate = $data['id'];
                    $aProductoCategorias = $daoProCategoria->aList($idCate, $authSesion->oLanguage, 1);
                    list($oProductoCategoria, $oProductoCategoriaLang) = $daoProCategoria->getById($idCate, $authSesion->oLanguage, false, true);
                    $this -> view -> aProductoCategorias = $aProductoCategorias;
                    $this -> view -> oProductoCategoriaLang = $oProductoCategoriaLang;
                    if ($oProductoCategoria -> getNivelCate() == 1 and count($aProductoCategorias) == 0)
                        $this -> view -> idLista = $idCate;
                }
                
                if (isset($data['idprod'])) {
                    $this -> view -> idprod = $data['idprod'];
                }
                
                $aTree = $daoProCategoria ->getTreeHtml($idpadre, $authSesion->oLanguage);
                $this -> view -> htmlCategorias = $aTree['strHtml'];
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento. ' . $e->getMessage());
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function categoriaAction()
    {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $this->_helper->layout->disableLayout();
        $this -> view -> aProductoCategorias = NULL;
//        $this -> view -> oProductoCategoriaLang = null;
        try {
                $data = $this->getRequest()->getParams();
                $daoProCategoria = new ProductoCategoria();
                if (isset($data['id'])) {
                    $idCate = $data['id'];
                    $aProductoCategorias = $daoProCategoria->aList($idCate, $authSesion->oLanguage, 1);
                    list($oProductoCategoria, $oProductoCategoriaLang) = $daoProCategoria->getById($idCate, $authSesion->oLanguage, false, true);
                    $this -> view -> aProductoCategorias = $aProductoCategorias;
//                    $this -> view -> oProductoCategoriaLang = $oProductoCategoriaLang;
                }
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento. ' . $e->getMessage());
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function categoriasAction()
    {
        $this->_helper->layout->setLayout('cart-productos');
        $authSesion = new Zend_Session_Namespace(SES_USER);
        try {
            $formData = $this->getRequest()->getParams();
            $pageStart = isset($formData['start'])?$formData['start']:NULL;
            $pageLimit = isset($formData['limit'])?$formData['limit']:NULL;
            $cate = isset($formData['cate'])?$formData['cate']:1;
            $authSesion = new Zend_Session_Namespace(SES_USER);
            $daoProductoCategoria = new ProductoCategoria();
            $aProductoCategorias = $daoProductoCategoria->aList($cate, $authSesion->oLanguage, 1, $pageStart, $pageLimit);
            
            $this -> view -> aProductoCategorias = $aProductoCategorias;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento. ');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function listaAction()
    {
        $this->_helper->layout->disableLayout();
        $authSesion = new Zend_Session_Namespace(SES_USER);
        try {
            $formData = $this->getRequest()->getParams();
            $pageStart = isset($formData['start'])?$formData['start']:NULL;
            $pageLimit = isset($formData['limit'])?$formData['limit']:NULL;
            $cate = isset($formData['cate'])?$formData['cate']:NULL;
            $daoProducto = new Producto();
            list($aProductos, $count, $oProductoCategoria) = $daoProducto->aList($cate, $authSesion->oLanguage, 1, $pageStart, $pageLimit);

//            $idsToFilter = array($authSesion->oLanguage);
//            $oProdCateLang = $oProductoCategoria->getLanguages()->filter(
//                    function($oProdCateLang) use ($idsToFilter) {
//                        return in_array($oProdCateLang->getLanguage(), $idsToFilter);
//                    })->first();
            
            $this -> view -> aProductos = $aProductos;
//            $this -> view -> oProdCateLang = $oProdCateLang;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function detalleAction()
    {
        $this->_helper->layout->disableLayout();
        $this -> view -> oProducto = null;
        $authSesion = new Zend_Session_Namespace(SES_USER);
        try {
            $formData = $this->getRequest()->getParams();
            $idProd = isset($formData['id'])?$formData['id']:NULL;
            $daoProducto = new Producto();
            list($oProducto, $oProductoLang) = $daoProducto->getById($idProd, $authSesion->oLanguage, false, true);

            $this -> view -> oProducto = $oProducto;
            $this -> view -> oProductoLang = $oProductoLang;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function rutaAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $authSesion = new Zend_Session_Namespace(SES_USER);
        try {
                $data = $this->getRequest()->getParams();
                $idprod = isset($data['idprod'])?$data['idprod']:null;
                $idcate = isset($data['idcate'])?$data['idcate']:null;
                $daoProCategoria = new ProductoCategoria();
                $strRutaHtml = $daoProCategoria->getTreeRouteHtml($idcate, $idprod, $authSesion->oLanguage, true);
                echo $strRutaHtml;
        } catch(Exception $e) {
            echo "";
        }        
    }

    public function busquedaAction()
    {
        $this->_helper->layout->disableLayout();
        $authSesion = new Zend_Session_Namespace(SES_USER);
        try {
            $formData = $this->getRequest()->getParams();
            $pageStart = isset($formData['start'])?$formData['start']:NULL;
            $pageLimit = isset($formData['limit'])?$formData['limit']:NULL;
            $cate = isset($formData['cate'])?$formData['cate']:NULL;
            $text = isset($formData['text'])?$formData['text']:NULL;
            $daoProducto = new Producto();
            list($aProductos, $count, $oProductoCategoria) = $daoProducto->aList(null, $authSesion->oLanguage, 1, $pageStart, $pageLimit, $text);
            
            $this -> view -> aProductos = $aProductos;
//            $this -> view -> oProdCateLang = $oProdCateLang;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function getImagenAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $formData = $this->getRequest()->getParams();
        $nombreImgProd = $formData['nombre'];
        $original = imagecreatefromjpeg(PTH_FILES_CART . DS . "producto" . DS . $nombreImgProd);
        $datos = getimagesize(PTH_FILES_CART . DS . "producto" . DS . $nombreImgProd);
        $org_alto = $datos[1];//751x400
        $org_ancho = $datos[0];//751x400

        $nue_ancho =751;
        $nue_alto = 250;
        $ratio = $nue_ancho / $org_ancho;
        $altoRatio = $ratio*$org_alto;
        $posYIni = round(($altoRatio - 250)/2);
        $posYIni = round($posYIni/$ratio);
        
        $nueva = imagecreatetruecolor($nue_ancho, $nue_alto);
        imagecopyresampled($nueva, $original, 0, 0, 0, $posYIni, $nue_ancho, $altoRatio, $org_ancho, $org_alto);
        //imagecopy($img1Recortada, $img1, 0, 0, $xini, $yini, $xfin-$xini, $yfin-$yini);
        imageinterlace($nueva, 1); //hacemos que la imagen sea progresiva
        //echo $nombreImgProd;
        header('Content-type: image/jpeg'); //especificamos que va a ser una imagen jpg
        imagejpeg($nueva); //sacamos a pantalla la imagen  

    }


}















