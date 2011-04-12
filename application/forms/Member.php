<?php

class Application_Form_Member extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Civilité
        $this->addElement('select', 'sex', array(
            'label'      => 'Civilité:',
            'required'   => true,
            'multiOptions' => array(
                'M' => 'M.',
                'Fme' => 'Mme.', // TODO: Afficher le champ maiden_name sur sélection de cette option
                'Fle' => 'Mle.'
            )
        ));

        // Nom
        $this->addElement('text', 'lastName', array(
            'label'      => 'Votre nom:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators'  => array(
                                array('stringLength', false, 1, 255)
                            ),
        ));

        // Prénom
        $this->addElement('text', 'firstName', array(
            'label'      => 'Prénom:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators'  => array(
                                array('stringLength', false, 1, 255)
                            ),
        ));

         // Username
        $this->addElement('text', 'userName', array(
            'label'      => 'Nom d\'utilisateur:',
            'required'   => true,
            'validators'  => array(
                                array('stringLength', false, 1, 255)
                            ),
        ));

        // Mail
        $this->addElement('text', 'email', array(
            'label'      => 'E-mail:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',array('stringLength', false, 1, 255)
            )
        ));    
        
         // Password
        $this->addElement('password', 'password', array(
            'label'      => 'Mot de passe:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('stringLength', false, 1, 255)
            )
        ));

         // Password Confirmation
        $this->addElement('password', 'passwordConfirmation', array(
            'label'      => 'Confirmez votre mot de passe:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('identical', true, array('password'))
            )
        ));

         // Rue
        $this->addElement('text', 'street', array(
            'label'      => 'Rue:',
            'required'   => true,
            'validators'  => array(
                                array('stringLength', false, 1, 255)
                            ),
        ));

         // Zip Code
        $this->addElement('text', 'zipCode', array(
            'label'      => 'Code Postal:',
            'required'   => true,
            'style' => 'width: 45px',
            'validators'  => array(
                                array('stringLength',false, 1, 8)
                            ),
        ));

         // City
        $this->addElement('text', 'city', array(
            'label'      => 'Ville:',
            'required'   => true,
            'validators'  => array(
                                array('stringLength',false, 1, 255)
                            ),
        ));

        // Pays
        $this->addElement('select', 'country', array(
            'label'      => 'Pays:',
            'required'   => true,
            'multioptions'   => array(
                            'FR' => 'FRANCE',
                            'US' => 'USA',
                            'GB' => 'GREAT BRITAIN',
                            'CN' => 'CHIENESE',
                            'JPN' => 'JAPAN',
                            'KZN' => 'KWAZULU NATAAL',
                            ),
        ));

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Please enter the 5 letters displayed below:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Enregistrer',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
   
}

