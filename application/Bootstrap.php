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
    protected function _initNavigation(){
        $this->bootstrap('layout');
        $layout=$this->getResource('layout');
        $view=$layout->getView();

        $navMenu=new Zend_Navigation(new Zend_Config_Xml(APPLICATION_PATH."/configs/navigation.xml","nav"));
        $view->navigation($navMenu);
    }

    protected function _initTranslation(){
        $transalation= new Zend_Translate_Adapter_Array(APPLICATION_PATH . '/languages/fr.php',"fr");
        $transalation->setLocale("fr");
        Zend_Registry::set('Zend_Translate', $transalation);

    }


}

