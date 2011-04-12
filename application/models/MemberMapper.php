<?php

class Application_Model_MemberMapper
{
 protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Member');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Member $member)
    {
        // Récupérer la Date de création du membre
        $result = $this->getDbTable()->find($member->getId());
        if (0 == count($result)) {
            $dateCrea =  date('Y-m-d H:i:s');
        } else
            $dateCrea = $member->getCreatedAt();

        $data = array(
            'lastname'   => $member->getLastName(),
            'firstname'  => $member->getFirstName(),
            'username'   => $member->getUserName(),
            'password'   => $member->getPassword(),
            'status_id'   => $member->getStatusId(),
            'subscription_date'   => $member->getSubscriptionDate(),           
            'due_exempt'   => $member->getDueExempt(),
            'street'   => $member->getStreet(),
            'zipcode'   => $member->getZipCode(),
            'city'   => $member->getCity(),
            'country' => $member->getCountry(),
            'picture'   => $member->getPicture(),
            'email'   => $member->getEmail(),
            'website'   => $member->getWebsite(),
            'phone_home'   => $member->getPhoneHome(),
            'phone_mobile'   => $member->getPhoneMobile(),
            'state'   => $member->getState(),
            'association_id'   => $member->getAssociationId(),
            'created_by'   => $member->getCreatedBy(),
            'updated_by'   => $member->getUpdatedBy(),
            'created_at' => $dateCrea,
            'updated_at' => date('Y-m-d H:i:s'),
            'sex'   => $member->getSex(),
            'maiden_name'   => $member->getMaidenName(),
            'birthday'   => $member->getBirthday(),
            'degree_date'   => $member->getDegreeDate()
        );

      
        if (null === ($id = $member->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id' => $id));
        }
    }

    public function find($id, Application_Model_Member $member)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $member->setId($row->id)
               ->setLastName($row->lastname)
               ->setFirstName($row->firstname)
               ->setUserName($row->username)
               ->setPassword($row->password)
               ->setStatusId($row->status_id)
               ->setSubscriptionDate($row->subscription_date)
               ->setDueExempt($row->due_exempt)
               ->setStreet($row->street)
               ->setZipCode($row->zipcode)
               ->setCity($row->city)
               ->setCountry($row->country)
               ->setPicture($row->picture)
               ->setEmail($row->email)
               ->setWebsite($row->website)
               ->setPhoneHome($row->phone_home)
               ->setPhoneMobile($row->phone_mobile)
               ->setState($row->state)
               ->setAssociationId($row->association_id)
               ->setCreatedBy($row->created_by)
               ->setUpdatedBy($row->updated_by)
               ->setCreatedAt($row->created_at)
               ->setUpdatedAt($row->updated_at)
               ->setSex($row->sex)
               ->setMaidenName($row->maiden_name)
               ->setBirthday($row->birthday)
               ->setDegreeDate($row->degree_date);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Member();           
            $entry->setId($row->id)
                  ->setLastName($row->lastname)
                  ->setFirstName($row->firstname)
                  ->setUserName($row->username)
                  ->setPassword($row->password)
                  ->setStatusId($row->status_id)
                  ->setSubscriptionDate($row->subscription_date)
                  ->setDueExempt($row->due_exempt)
                  ->setStreet($row->street)
                  ->setZipCode($row->zipcode)
                  ->setCity($row->city)
                  ->setCountry($row->country)
                  ->setPicture($row->picture)
                  ->setEmail($row->email)
                  ->setWebsite($row->website)
                  ->setPhoneHome($row->phone_home)
                  ->setPhoneMobile($row->phone_mobile)
                  ->setState($row->state)
                  ->setAssociationId($row->association_id)
                  ->setCreatedBy($row->created_by)
                  ->setUpdatedBy($row->updated_by)
                  ->setCreatedAt($row->created_at)
                  ->setUpdatedAt($row->updated_at)
                  ->setSex($row->sex)
                  ->setMaidenName($row->maiden_name)
                  ->setBirthday($row->birthday)
                  ->setDegreeDate($row->degree_date)
               ;
            $entries[] = $entry;
            
        }
        return $entries;
    }

}

