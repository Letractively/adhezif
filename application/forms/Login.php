<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName('Login')
                ->addAttribs(array("class"=>"sansgroupe"));

        $username=new Zend_Form_Element_Text("username");
        $username->setRequired(true)
                 ->setLabel("Nom d'utilisateur : ");

        $password= new Zend_Form_Element_Password("password");
        $password->setRequired(true)
                 ->setlabel("Mot de passe : ");

        $submit= new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Login");

        $this->addElement($username)
             ->addElement($password)
             ->addElement($submit)
             ->setMethod("post")
             ->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login')   ;
        
    }


}

