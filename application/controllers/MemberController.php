<?php

class MemberController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $member = new Application_Model_MemberMapper();
        $this->view->entries = $member->fetchAll();
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Member();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $fields = new Application_Model_Member($form->getValues());
                 $logger = null;
                $logger = Zend_Registry::get('Zend_Log', $logger);
                foreach ($form->getValues() as $v)
                    $logger->debug('MemberController::addAction():'.$v);

                $mapper  = new Application_Model_MemberMapper();
                $mapper->save($fields);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



