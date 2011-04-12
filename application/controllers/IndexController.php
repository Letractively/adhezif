<?php

/**
 * IndexController.php: default controller for Adhezif
 *
 * Inclus toutes les actions de la gestion des adherents
 *
 * LICENSE: Software under Open Sources license CC BY-NC-SA 2.0
 *
 * @category   Zend
 * @package    Zend_IndexController
 * @copyright  Copyright (c) 2011 E. Boniface
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    $Id:$
 * @link      
 * http://code.google.com/p/adhezif/source/browse/application/controllers/IndexController.php
 * @since      File available since Release 0.1
 *
 */


/**
 * IndexController : default controller class
 *
 * Inclus toutes les actions de la gestion des adherents
 *
 * LICENSE: Software under Open Sources license CC BY-NC-SA 2.0
 *
 * @category   Zend
 * @package    Zend_IndexController
 * @copyright  Copyright (c) 2011 E. Boniface
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    Release: @package_version@
 * @link      
 * http://code.google.com/p/adhezif/source/browse/application/controllers/IndexController.php
 * @since      File available since Release 0.1
 *
 */
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     *  indexAction
     * Récupère la liste de tous les membres et l'affiche
     */
    public function indexAction()
    {
        $logger = null;
        $logger = Zend_Registry::get('Zend_Log', $logger);

        $logger->debug('IndexController::indexAction logger cree.');
    }

}


