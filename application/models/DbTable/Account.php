<?php


class Application_Model_DbTable_Account extends Zend_Db_Table_Abstract
{

    protected $_name = 'adhezif_account';

    public function toListOption(){
        foreach ($this->fetchAll()->toArray() as $key => $value) {
            foreach ($value as $key2=>$value2){
                if ($key2=="id"){
                    $numstatus=$value2;
                }
                if ($key2=="label"){
                    $st2[$numstatus]=$value2;
                }
            }
        }
        return($st2);
    }

}