<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $form= new Application_Form_Login();
        
        if (Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('index/index');
        }

        $request=$this->getRequest();

        if ($request->ispost()){
            $formdata=$this->_request->getpost();
            if ($form->isValid( $formdata)){
                $authAdapter=$this->getAuthAdapter();
                $authAdapter->setIdentity($formdata['username'])
                            ->setCredential($formdata['password']);
                $auth= Zend_Auth::getInstance();
                $result=$auth->authenticate($authAdapter);
                if ($result->isValid()){
                    $identity=$authAdapter->getResultRowObject();
                    $authStorage=$auth->getStorage();
                    $authStorage->write($identity);
                    $this->_redirect('index/index');
                }else{
                    $this->view->errorMessage="Le nom d'utilisateur ou le password ne sont pas correct";
                }
            }
         }
         $this->view->form=$form;

    }

    public function logoutAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()){
            Zend_Auth::getInstance()->clearIdentity();
            $this->_redirect("index/index");
        }
    }

    private function getAuthAdapter()
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(null, "adhezif_member", "username", "password");
        return $authAdapter;
    }

}





