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
class Application_Model_DbTable_Member extends Zend_Db_Table_Abstract
{

    protected $_name = 'adhezif_member';
    protected $_sequence=true;
    protected $_primary='id';
    protected $_referenceMap=array(
        "association_id"=>
            array("columns"=>array("association_id"),
            "refTableClass"=>array("Application_Model_DbTable_Association"),
            "refColumns"=>array("id")),
        "Status" =>
            array("columns"=>array("status_id"),
            "refTableClass"=>array("Application_Model_DbTable_Status"),
            "refColumns"=>array("id"))
        );
    protected $errorMessage;

    protected function setErrorMessage($message){
        $this->errorMessage=$message;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getMember($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    
    public function addMember(array $data)
    {
        try {
            $data=array_merge($data,array(
                                "created_at"=>date("Y-m-d"),
                                "updated_at"=>date("Y-m-d"),
                                "association_id"=>(int)1,
                                "state"=>(int) 1));
            
            $data=$this->clearColumns($data);
            $data=$this->formatDate($data);

            $this->insert($data);
            return 1;
        }catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            return 0;
        }
    }
    
    public function updateMember($id, $data)
    {

        try{
            $data['updated_at']=date("Y-m-d");
            $data=$this->clearColumns($data);
            $data=$this->formatDate($data);
            $this->update($data, 'id = '. (int)$id);
            return 1;
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            return 0;
        }
    }
    
    public function deleteMember($id)
    {
        try {
            $this->delete('id =' . (int)$id);
            return 1;
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->updateMember($id, array("state"=>0));
            return 0;
        }
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
                    if (is_array($datatoformat['birthday'])){
            $datatoformat['birthday']=$datatoformat['birthday']['year']."-".$datatoformat['birthday']['month']."-".
                                $datatoformat['birthday']['day'];
            }
                        if (is_array($datatoformat['subscription_date'])){
            $datatoformat['subscription_date']=$datatoformat['subscription_date']['year']."-".$datatoformat['subscription_date']['month']."-".
                                $datatoformat['subscription_date']['day'];
            }
                        if (is_array($datatoformat['degree_date'])){
            $datatoformat['degree_date']=$datatoformat['degree_date']['year']."-".$datatoformat['degree_date']['month']."-".
                                $datatoformat['degree_date']['day'];
            }
            return $datatoformat;
    }

    public function toListOption(){
        foreach ($this->fetchAll()->toArray() as $key => $value) {
            foreach ($value as $key2=>$value2){
                if ($key2=="id"){
                    $numstatus=$value2;
                }
                if ($key2=="firstname" || $key2=="lastname"){
                    isset ($st2[$numstatus]) ? $st2[$numstatus]=$st2[$numstatus]." ".$value2 : $st2[$numstatus]=$value2;
                }
            }
        }
        return($st2);
    }
    
    public function getAll() {
        $select = $db->select()
             ->from(array('m' => 'adhezif_membres'))
             ->join(array('s' => 'adhezif_status'),
                'm.status_id = s.id',
                    array('label') );
        $stmt = $select->query();
        $result = $stmt->fetchAll();
        return $result;
    }
}

