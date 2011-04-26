<?php

class Application_Form_Confirmation extends Zend_Form {

    public function  init() {
       $this->setName("memberDelete")
            ->setMethod("post");


       $yes = new Zend_Form_Element_Submit("oui");
       $yes->setLabel("Oui")
           ->setValue("oui");

       $no = new Zend_Form_Element_Submit("non");
       $no->setLabel("Non")
           ->setValue("non");

       $this->addElement($yes)
            ->addElement($no);

    }


}