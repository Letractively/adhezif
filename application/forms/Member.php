<?php

class Application_Form_Member extends Zend_Form
{

    public function init()
    {
        $validtextmax=new Zend_Validate_StringLength(array('max'=>255));

        $this->setName("member")
             ->setEnctype("multipart/form-data");

        $firstname=new Zend_Form_Element_Text("firstname");
        $firstname->setLabel("Prénom* : ")
                  ->addValidator($validtextmax)
                  ->setRequired(true)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        
        $lastname=new Zend_Form_Element_Text("lastname");
        $lastname->setLabel("Nom* : ")
                  ->addValidator($validtextmax)
                  ->setRequired(true)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());;

        $maidenname=new Zend_Form_Element_Text('maiden_name');
        $maidenname->setLabel("nom de jeune fille : ");


        $statuslist=new Application_Model_DbTable_Status();
        $status=new Zend_Form_Element_Select("status_id");
        $status->setRequired()
               ->setLabel("Statut* : ")
               ->setMultiOptions($statuslist->toListOption());

        $username=new Zend_Form_Element_Text("username");
        $username->setLabel("Nom d'utilisateur* : ")
                  ->addValidator($validtextmax)
                  ->setRequired(true)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        $password=new Zend_Form_Element_Password("password");
        $password->setRequired()
                 ->setLabel("Mot de passe* : ")
                 ->addValidator(new Zend_Validate_StringLength(7))
                ->setAttrib('renderPassword', true);

        $passwordCheck=new Zend_Form_Element_Password("passwordCheck");
        $passwordCheck->setRequired()
                 ->setLabel("Repetez le mot de passe* : ")
                 ->setAttrib('renderPassword', true);

        $street=new Zend_Form_Element_Text("street");
        $street->setLabel("Adresse : ")
                  ->addValidator($validtextmax)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        $zipcode=new Zend_Form_Element_Text("zipcode");
        $zipcode->setLabel("Code postal : ")
                  ->addValidator(new Zend_Validate_StringLength(array('max'=>10)))
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        $city=new Zend_Form_Element_Text("city");
        $city->setLabel("Ville : ")
                  ->addValidator($validtextmax)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        $country=new Zend_Form_Element_Text("country");
        $country->setLabel("Pays : ")
                  ->addValidator($validtextmax)
                  ->addFilter(new Zend_Filter_HtmlEntities())
                  ->addFilter(new Zend_Filter_StringTrim())
                  ->addFilter(new Zend_Filter_StripTags());

        $phone_home=new Zend_Form_Element_Text("phone_home");
        $phone_home->setLabel("Tel. Fixe : ")
                   ->addValidator(new Zend_Validate_Regex("#[0-9]+[-. ]?#"));

        $phone_mobile=new Zend_Form_Element_Text("phone_mobile");
        $phone_mobile->setLabel("Portable : ")
                     ->addValidator(new Zend_Validate_Regex("#[0-9]+[-. ]?#"));

        $email=new Zend_Form_Element_Text("email");
        $email->setLabel("E-mail : ")
              ->addValidator(new Zend_Validate_EmailAddress());

        $website=new Zend_Form_Element_Text("website");
        $website->setLabel("Site Internet : ")
                ->addValidator(new Zend_Validate_Regex("#http[0-9A-Za-z.-_]+#"));

        $picture=new Zend_Form_Element_File("picture");
        $picture->setLabel("Photo : ")
                ->addValidator(new Zend_Validate_File_Extension(array('jpg','png','gif','jpeg')))
                ->addValidator(new Zend_Validate_File_Size(1024000))
                ->setDestination(realpath(APPLICATION_PATH.'/../public/pictures')) ;
        if (is_array($picture->getFileName())){
            $picturename="";
        }else{
            $picturename=$picture->getFileName();
        }
        
        $picture->addFilter(new Zend_Filter_File_Rename(array("target"=>date("YmdHis").strrchr($picturename, "."),"overwrite"=>true)));

        $due_exempt=new Zend_Form_Element_Checkbox("due_exempt");
        $due_exempt->setLabel("Exempté de cotisation ? ");

        $subscription_date=new Application_Form_Element_Date('subscription_date');
        $subscription_date->setLabel("Date d'adhésion : ");
        
        $birthday=new Application_Form_Element_Date('birthday');
        $birthday->setLabel("Date de naissance : ")
                  ;

        $degreedate=new Application_Form_Element_Date('degree_date');
        $degreedate->setLabel("Date d'obtention du diplome : ");
                
        $sex=new Zend_Form_Element_Radio('sex');
        $sex->setLabel("Sexe : ")
            ->setMultiOptions(array("M"=>"Homme","F"=>"Femme"));

        $submit=new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Valider");

           $this->addElement($firstname)
                ->addElement($lastname)
                ->addElement($maidenname)
                ->addElement($sex)
                ->addElement($birthday)
                ->addElement($status)
                ->addElement($street)
                ->addElement($zipcode)
                ->addElement($city)
                ->addElement($country)
                ->addElement($phone_home)
                ->addElement($phone_mobile)
                ->addElement($email)
                ->addElement($website)
                ->addElement($subscription_date)
                ->addElement($picture)
                ->addElement($due_exempt)
                ->addElement($degreedate)
                ->addElement($username)
                ->addElement($password)
                ->addElement($passwordCheck)
                ->setMethod("post");

           $this->addDisplayGroup(array("firstname","lastname","maiden_name","sex","birthday","street","zipcode","city","country"), "etatcivil");
           $this->addDisplayGroup(array("phone_home", "phone_mobile","email","website"),"contact");
           $this->addDisplayGroup(array("status_id","subscription_date", "degree_date","due_exempt","picture"),"complements");
           $this->addDisplayGroup(array("username", "password","passwordCheck"),"identifiants");
           $this->getDisplayGroup("etatcivil")->setLegend("Etat Civil");
           $this->getDisplayGroup("contact")->setLegend("Contact");
           $this->getDisplayGroup("complements")->setLegend("Données complémentaires");
           $this->getDisplayGroup("identifiants")->setLegend("Identification");
           $this->addElement($submit);

    }

    Public function  isValid($data) {
        if (parent::isValid($data)){
            $member=new Application_Model_DbTable_Member();
            $member=$member->select();
            if (isset ($data['oldusername'])){
                $member->where("username='".$data['username']."' and username<>'".$data['oldusername']."'");
            }else{
                $member->where("username='".$data['username']."'");
            }

            if($member->query()->rowCount()){
                $this->_elements['username']->adderror("Le nom d'utilisateur est déjà utilisé.");
                return false;
            }else{
                if ($data['password']!=$data['passwordCheck']){
                    $this->_elements['passwordCheck']->adderror("Le mot de passe doit être identique");
                    return false;
                }else{
                    return true;
                }
            }
        }
    }

    public function  populate(array $values) {
        
        $this->_elements['passwordCheck']->setValue($values['password']);
        foreach ($values as $key => $value) {
            if ($value=='0000-00-00'){
                $values[$key]="";
            }
        }
        if (is_array($values['birthday'])){
            $values['birthday']=$values['birthday']['year']."-".$values['birthday']['month']."-".
                                $values['birthday']['day'];          
            }
        parent::populate($values);
    }

}

