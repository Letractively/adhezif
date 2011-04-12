<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRegisterLogger() {
        $this->bootstrap('Log');

        if (!$this->hasPluginResource('Log')) {
            throw new Zend_Exception('Log not enabled in config.ini');
        }

        $logger = $this->getResource('Log');
        assert($logger != null);
        Zend_Registry::set('Zend_Log', $logger);
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
}

