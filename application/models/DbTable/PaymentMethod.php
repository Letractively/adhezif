<?php


class Application_Model_DbTable_PaymentMethod extends Zend_Db_Table_Abstract
{

    protected $_name = 'adhezif_payment_method';

    public function toListOption(){
        foreach ($this->fetchAll()->toArray() as $key => $value) {
            foreach ($value as $key2=>$value2){
                if ($key2=="id"){
                    $numstatus=$value2;
                }
                if ($key2=="payment_method"){
                    $st2[$numstatus]=$value2;
                }
            }
        }
        return($st2);
    }

}