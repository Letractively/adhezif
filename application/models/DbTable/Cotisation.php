<?php
/**
 * Application_Model_DBTable_Member: class to manage Member table
 *
 * Méthodes pour gérer la table Member
 *
 * LICENSE: Software under Open Sources license CC BY-NC-SA 2.0
 *
 * @category   Zend
 * @package    Zend_Db_Table_Abstract
 * @copyright  Copyright (c) 2011 E. Boniface
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    Release: @package_version@
 * @since      File available since Release 0.1
 *
 */
class Application_Model_DbTable_Cotisation extends Zend_Db_Table_Abstract
{

    protected $_name = 'adhezif_income';
    protected $_sequence=true;
    protected $_primary='id';
    protected $_referenceMap=array("association_id"=>
                                    array("columns"=>array("association_id"),
                                          "refTableClass"=>array("Application_Model_DbTable_Association"),
                                          "refColumns"=>array("id")),
                                    "member_id"=>
                                    array("columns"=>array("member_id"),
                                          "refTableClass"=>array("Application_Model_DbTable_Member"),
                                          "refColumns"=>array("id")));
    protected $errorMessage;

    protected function setErrorMessage($message){
        $this->errorMessage=$message;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function addCotisation(array $data)
    {
        try {
            $data=array_merge($data,array(
                                "created_at"=>date("Y-m-d"),
                                "updated_at"=>date("Y-m-d"),
                                "association_id"=>(int)1 ,
                                "activity_id"=>(int)-1));

            $data=$this->clearColumns($data);
            $data=$this->formatDate($data);
            $this->insert($data);
            return 1;
        }catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            return 0;
        }
    }

    public function  fetchAll($where = null, $order = null, $count = null, $offset = null) {

        $db = $this->getDefaultAdapter();
        $select = $db->select();
        $select->from('adhezif_income',"*") ;
        $select->join('adhezif_member',"adhezif_member.id=adhezif_income.member_id")
               ->join('adhezif_payment_method','adhezif_payment_method.id=adhezif_income.payment_id')
               ->join('adhezif_account','adhezif_account.id=adhezif_income.account_id',array("account_label"=>"label"));

        $db->fetchAll($select);
        return $db->fetchAll($select);
    }

    //Cette fonction permettre de lister les colones de la table member
    //Puis de matcher les colonnes avec les colonnes que l'on tente d'inserer
    //afin d'enlever les colonnes non utiles.
    protected function clearColumns(array $datatoclear)  {
            $columns=$this->info(Zend_Db_Table_Abstract::COLS);
            foreach($datatoclear as $key => $value){
                if (in_array($key,$columns)){
                    $datatoinsert[$key]=$value;
                }
            }
            return $datatoinsert;
    }

        protected function formatDate(array $datatoformat){
                    if (is_array($datatoformat['date'])){
            $datatoformat['date']=$datatoformat['date']['year']."-".$datatoformat['date']['month']."-".
                                $datatoformat['date']['day'];
            }
            return $datatoformat;
    }
}
