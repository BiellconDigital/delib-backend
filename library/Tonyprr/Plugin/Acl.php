<?php
/*
 * Extiende Zend_Acl para nuestro sitio web
*/
class Tonyprr_Plugin_Acl extends Zend_Acl
{
	public function __construct()
	{
		// Roles
		$this->addRole(new Zend_Acl_Role('invitado') );
		$this->addRole( new Zend_Acl_Role('user') );
//		$this->addRole(new Zend_Acl_Role('user'), 'invitado' );
		$this->addRole(new Zend_Acl_Role('admin'));
 
		// Recursos de lo general a lo particular
		$this->add( new Zend_Acl_Resource('web') );
//		$this->add(new Zend_Acl_Resource('index'), 'web');
//		$this->add(new Zend_Acl_Resource('web_mi-cuenta'), 'web');
//		$this->add(new Zend_Acl_Resource('web_cliente'), 'web');
                
//		$this->add(new Zend_Acl_Resource('web_compra'), 'web');
//		$this->add(new Zend_Acl_Resource('web_compra_pago'), 'web_compra');
//		$this->add(new Zend_Acl_Resource('web_compra_despacho'), 'web_compra');
//		$this->add(new Zend_Acl_Resource('web_producto'), 'web');
//		$this->add(new Zend_Acl_Resource('web_producto_agregar-comentario'), 'web_producto');
                
		$this->add(new Zend_Acl_Resource('cart'));
                
                
//		$this->add(new Zend_Acl_Resource('auth'));
//		$this->add(new Zend_Acl_Resource('auth_index'), 'auth');
		$this->add(new Zend_Acl_Resource('admin'));
//		$this->add($this->get('index'), 'admin');
 
		$this->add(new Zend_Acl_Resource('api'));
		// Asignar permisos
		// guest
//		$this->allow('invitado', array('auth') );//'index', 
		$this->allow('invitado', array('web') );
		$this->allow('invitado', array('cart') );
		$this->allow('invitado', array('admin') );
//		$this->deny('invitado', array('web_mi-cuenta') );
//		$this->deny('invitado', array('web_compra_pago') );
//		$this->deny('invitado', array('web_compra_despacho') );
//		$this->deny('invitado', array('web_producto_agregar-comentario') );
		$this->allow('invitado', array('api') );
		// user
		$this->allow('user', array('web') );
		$this->allow('user', array('cart') );
		$this->allow('user', array('admin') );
		$this->deny('user', array('api') );
//		$this->deny('user', array('web_cliente') );
		// admin
		$this->allow('admin');
//		$this->deny('admin', array('web_mi-cuenta', 'web') );
//		$this->deny('admin', array('web_compra_pago') );
//		$this->deny('admin', array('web_compra_despacho') );
    }
}

?>
