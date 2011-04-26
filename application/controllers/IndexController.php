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
        $logger = Zend_Registry::get('Zend_Log'); //Suppr de $Logger en 2e parametre

        // $logger->debug('Exemple de message de debug');
        
        $members = new Application_Model_DbTable_Member();
        $membersQuery = $members->select()
          ->setIntegrityCheck(false) // allows joins
          ->from(array('M' => 'adhezif_member'))
          ->join( array('S' => 'adhezif_status'), 'S.id = M.status_id', 'label');
        $joinedRowset = $members->fetchAll($membersQuery);
        
        $this->view->members = $joinedRowset;
        
    }

    public function addAction()
    {
        $form=new Application_Form_Member();
        $this->view->form=$form;
        if ($this->getRequest()->ispost()){
            $formdata=$this->_request->getpost();
                if ($form->picture->receive()){
                    $formdata['picture']= $form->picture->getFileName();
                }
            if ($form->isValid($formdata)){
                $member=new Application_Model_DbTable_Member();
                 if ($member->addMember($formdata)==1){
                    $this->view->message="L'adhérent est ajouté";
                    $this->_redirect("index/index");
                }else {
                    $this->view->message="L'adhérent n'a pas pu être ajouté.\nErreur : ".$member->getErrorMessage();
                    $form->populate($formdata);
                }


            }
        }
    }

      /**
       * Action to edit a member.
       *
       * <p>This method is used to edit a member. So it creates a new
       * member instance, then display the form and checks whether or not
       * the form is validated.</p>
       */

    public function editAction()
    {
        $logger = Zend_Registry::get('Zend_Log'); //Suppr de $Logger en 2e parametre
        
        $id=$this->_request->getParam('id');
        $member=new Application_Model_DbTable_Member();
        $formdata=$member->find($id);
        $form=new Application_Form_Member();
        $this->view->form=$form;
        $formdata=$formdata->toArray();
         if (!$formdata){
            $this->_redirect('index/index');
        }

        /**
         * Used to display the member picture
         */
        $this->view->picture=$formdata[0]['picture'];

        $form->populate($formdata[0]);
        /**
         * Store previous datas
         */
        $oldusername=$formdata[0]['username'];
        $oldpicture = $this->view->picture=$formdata[0]['picture'];
        if ($this->getRequest()->ispost()){
            $formdata=$this->_request->getpost();
            $formdata['oldusername']=$oldusername;
            
            /**
             * This method is used to know if a picture has been uploaded
             * or not. This is useful to avoid picture data removal.
             */
            if ( $form->picture->isUploaded() )
                if ($form->picture->receive()){
                    $formdata['picture']= $form->picture->getFileName();
                    $logger->debug('Picture received '.$formdata['picture']);
                } 
            else {
                    $formdata['picture']= $oldpicture;
            }
            $logger->debug('Picture '.$formdata['picture']);
            
            if ($form->isValid($formdata)){
                if ($member->updateMember($id, $formdata)){
                    $this->view->message="l'adherent ".$id." a été mis a jour.";
                    unset($form);
                    unset($this->view->form);
                }else{
                    $this->view->message="Erreur : ".$member->getErrorMessage();
                }
            }
        }
            
    }

    public function deleteAction()
    {
        $form=new Application_Form_Confirmation();
        $this->view->form=$form;
        $this->view->message="Confirmez-vous la suppression de ".$this->_request->getParam('id')." ?"  ;
        if ($this->getRequest()->ispost()){
            $formdata=$this->_request->getpost();
            if (isset($formdata['oui'])) {
                $member=new Application_Model_DbTable_Member();
                if (1== $member->deleteMember($this->_request->getParam('id'))){
                    $this->view->message="L'adhérent ".$this->_request->getParam('id')." a été supprimé avec succès."  ;
                    unset($form);
                    unset($this->view->form);
                }else{
                    $this->view->message="L'adhérent ".$this->_request->getParam('id')." a été flaggé en inactif."  ;
                    unset($form);
                    unset($this->view->form);
                }
            } else {
                $this->_redirect('index/index');
            }
       }
        
    }

    public function switchstateAction()
    {
        $id=$this->_request->getParam('id');
        $member=new Application_Model_DbTable_Member();
        $memberdata=$member->find($id)->toArray();
        if(!$memberdata[0]){
            $this->_redirect('index/index');
        }
        if (($memberdata[0]['state'])==1){
            if($member->updateMember($id,array("state"=>0))){
                $this->view->message="L'adhérent ".$id." a été desactivé";
            }else{
                $this->view->message="L'adhérent ".$id." n'a pas pu être desactivé\nErreur : ".$member->getErrorMessage();
            }

        }else{
            if($member->updateMember($id,array("state"=>1))){
                $this->view->message="L'adhérent ".$id." a été ré-activé";
            }else{
                $this->view->message="L'adhérent ".$id." n'a pas pu être ré-activé\nErreur : ".$member->getErrorMessage();
            }
        }
    }


}


    

