<?php
/**
 * Description of Layout
 *
 * @author aramosr
 */
class Tonyprr_Layout_Controller_Plugin_Layout extends Zend_Layout_Controller_Plugin_Layout
{

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->_moduleChange($request->getModuleName());
    }

    protected function _moduleChange($moduleName) {
        $this->getLayout()->setLayoutPath(
            dirname(dirname(
                $this->getLayout()->getLayoutPath()
            ))
            . DIRECTORY_SEPARATOR . 'layouts/scripts/' . $moduleName
        );
        $this->getLayout()->setLayout($moduleName);
    }

}

?>
