<?php
/*
 * AuthorizationPlugin.php
 * Extenci�n de la clase Zend_Controller_Plugin_Abstract
*/
class Tonyprr_Plugin_Authorization extends Zend_Controller_Plugin_Abstract
{
    /**
     * Contiene el objeto Zend_Auth
     * 
     * @var Zend_Auth
     */
    private $_auth;
 
    /**
     * Contiene el objeto Zend_Acl
     * 
     * @var Zend_Acl
     */
    private $_acl;
 
    /**
     * El objeto de la clase singleton
     * 
     * @var Plugin_CheckAccess
     */
    static private $instance = NULL;
 
    public function __construct(Zend_Auth $auth, Zend_Acl $acl)
    {
            $this->_auth = $auth;
            $this->_acl = $acl;
    }
 
    /**
     * Devuelve el objeto de la clase singleton
     * 
     * @return Plugin_CheckAccess
     */
    static public function getInstance() {
       if (self::$instance == NULL) {
          self::$instance = new Plugin_CheckAccess ();
       }
       return self::$instance;
    }
 
    /**
     * Retorna el Rol del usuario actual
     * 
     * @return string
     */
    private function getRol()
    {
        return ($this->_auth->hasIdentity()) 
               ? $this->_auth->getIdentity()->role 
               : 'invitado';
    }
 
  /**
     * preDispatch
     *
     * Funcion que se ejecuta antes de que lo haga el FrontController
     * 
     * @param Zend_Controller_Request_Abstract $request Peticion HTTP realizada
     * @return
     * @uses Zend_Auth
     */
//    public function preDispatch(Zend_Controller_Request_Abstract $request)
//    {
//        $controllerName = $request->getControllerName();
//        $actionName     = $this->getRequest()->getActionName();
// 
//        // Si el usuario esta autentificado
//        $role = $this->_auth->hasIdentity() ? $this->_auth->getInstance()->getIdentity()->role : 'invitado';
//        if( $this->_acl->has( $actionName ) )
//                $resource = $actionName;
//        elseif( $this->_acl->has( $controllerName ) )
//                $resource = $controllerName;
//        elseif( $this->_acl->has( $this->getRequest()->getModuleName() ) )
//                $resource = $this->getRequest()->getModuleName();
//        
//        // Si tiene autorización para el controlador
//        if (!$this->isAllowed( $controllerName, $actionName) ) {
//            // Mostramos el error de que no tiene permisos
//            $request->setModuleName('auth');
//            $request->setControllerName("login");
//            $request->setActionName("index");
//        }
//    }
    
	public function preDispatch ( Zend_Controller_Request_Abstract $request )
	{
                
		// revisa que exista una identidad
		// obtengo la identidad y el "role" del usuario, sino tiene le pone 'guest'
                $storageUser = $this->_auth->getStorage()->read();
//		$role = $this->_auth->hasIdentity() ? $this->_auth->getInstance()->getIdentity()->role : 'invitado';
		$role = $this->_auth->hasIdentity() ? $storageUser['role'] : 'invitado';
//		$role = 'user';
                //echo $role . '<br/>';
//                var_dump($this->_auth->getInstance()->getIdentity());//Zend_Auth_Storage_Session
//                var_dump($this->_auth->getStorage()->read());
//                $authSesion = new Zend_Auth_Storage_Session(SES_USER);
//                echo var_dump($authSesion);
                
//                $this->_auth->getStorage()->write(array('visita' => 2));
                $moduleName = $request->getModuleName();
                $controllerName = $moduleName . '_' . $request->getControllerName();
                $actionName     = $moduleName . '_' . $request->getControllerName()  . '_' .$this->getRequest()->getActionName();
//                echo $actionName;
 
		// toma el nombre del recurso actual
//		if( $this->_acl->has( $actionName ) )
//			$resource = $actionName;
		if( $this->_acl->has( $actionName ) )
			$resource = $actionName;
		else if( $this->_acl->has( $controllerName ) )
			$resource = $controllerName;
		else if( $this->_acl->has( $moduleName ) )
			$resource = $moduleName;
 
                if($moduleName == 'admin' 
                        and $this->getRequest()->getControllerName() != 'login'
                        and $actionName != 'access'
                   ) {
                    $session_apli = new Zend_Session_Namespace ( SES_ADMIN );
                    if(empty($session_apli->userId)) {
                        $this->_response->setRedirect('admin/login');
                    }
                }
//                if ($moduleName == 'admin'  && $role == 'invitado') {
//			$request->setModuleName('admin');
//			$request->setControllerName('login');
//                }
		// Si, la persona no pasa la prueba de autorizaci�n y su "role" es 'guest'
		// entonces no ha echo "login" y lo dirigo al controlador "login" del modulo "auth"
		else if ( !$this->_acl->isAllowed($role, $resource) && $role == 'invitado' )
		{
                    $request->setModuleName('api');
                    $request->setControllerName('login');
                    $request->setActionName('no-auth');
		}
		// Ahora si la persona tiene un "role" distinto de 'guest' y aun as� no pasa
		// la prueba de identificaci�n lo mando a una p�gina de error.
		else if (!$this->_acl->isAllowed($role, $resource) )
		{
//                    $this->_redirect('/consejos');
//                    echo '  xzz';
                    $request->setModuleName('web');
                    $request->setControllerName('index');
                    $request->setActionName('index');
                    
		}
 	}
        
/**
     * isAllowed
     * 
     * Retorna si tiene los permisos necesarios para el recurso y el permiso
     * solicitado
     * 
     * @param  string  $resource
     * @param  string  $permission optional
     * @return bool
     */
    public function isAllowed ($resource, $permission = null)
    {
        // Por defecto, no tiene permisos
        $allow = false;
 
        // Si solo pregunta por el recurso
        if (is_null($permission)) {
            $allow = $this->_acl->isAllowed($this->getRol(), $resource);
        }
        // Si pregunta por el recurso y el permiso
        else {
            $allow = $this->_acl->isAllowed($this->getRol(), $resource, $permission);
        }
 
        return $allow;
    }        
}