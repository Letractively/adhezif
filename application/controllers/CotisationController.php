<?php

class CotisationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $cotisation=new Application_Model_DbTable_Cotisation();
        $this->view->cotisations=$cotisation->fetchAll();
    }

    public function addAction()
    {
        $form=new Application_Form_Cotisation();
        $this->view->form=$form;
        if ($this->getRequest()->ispost()){
            $formdata=$this->_request->getpost();
            if ($form->isValid($formdata)){
                $cotisation=new Application_Model_DbTable_Cotisation();

                if ($cotisation->addCotisation($formdata)==1){
                    $this->view->message="La cotisation est enregistrée";
                    $this->_redirect("cotisation/index");
                }else {
                    $this->view->message="La cotisation n'a pas pu être enrengistrée.\nErreur : ".$cotisation->getErrorMessage();
                    $form->populate($formdata);
                }


            }
        }
    }


}



