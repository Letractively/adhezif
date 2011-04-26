<?php
class Application_Form_Cotisation extends Zend_Form
{

    public function init()
    {
        $this->setName("cotisation");
        $this->addAttribs(array("class"=>"sansgroupe"));

        $label=new Zend_Form_Element_Text("label");
        $label->setRequired(TRUE)
              ->setLabel("Libellé* : ")
                  ;

        $amount=new Zend_Form_Element_Text("amount");
        $amount->setRequired()
               ->addValidator(new Zend_Validate_Regex("#^[0-9]+(\.{0,1}[0-9]{0,2}$|[0-9]$)#"))
               ->setLabel("Montant* : ");
        
        $date=new Application_Form_Element_Date('date');
        $date->setLabel("Date* : ")
             ->setRequired();

        $memberlist=new Application_Model_DbTable_Member();
        $member=new Zend_Form_Element_Select("member_id");
        $member->setRequired()
               ->addValidator("NotEmpty")
               ->setLabel("Adhérent* : ")
               ->setMultiOptions($memberlist->toListOption());

        $paylist=new Application_Model_DbTable_PaymentMethod();
        $pay=new Zend_Form_Element_Select("payment_id");
        $pay->setRequired()
               ->addValidator("NotEmpty")
               ->setLabel("Méthode de paiement* : ")
               ->setMultiOptions($paylist->toListOption());

        $accountlist=new Application_Model_DbTable_Account();
        $account=new Zend_Form_Element_Select("account_id");
        $account->setRequired()
               ->addValidator("NotEmpty")
               ->setLabel("Comptes bancaire* : ")
               ->setMultiOptions($accountlist->toListOption());

        $submit=new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Valider");

           $this->addElement($label)
                ->addElement($amount)
                ->addElement($date)
                ->addElement($member)
                ->addElement($pay)
                ->addElement($account)
                ->addElement($submit)
                ->setMethod("post");
    }


}
