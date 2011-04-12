<?php

class Application_Model_Member
{
    protected $_degree_date;
    protected $_birthday;
    protected $_maiden_name;
    protected $_sex;
    protected $_updatedAt;
    protected $_createdAt;
    protected $_updatedBy;
    protected $_createdBy;
    protected $_associationId;
    protected $_state;
    protected $_phoneMobile;
    protected $_phoneHome;
    protected $_website;
    protected $_email;
    protected $_picture;
    protected $_country;
    protected $_city;
    protected $_zipcode;
    protected $_street;
    protected $_dueExempt;
    protected $_subscriptionDate;
    protected $_statusId;
    protected $_password;
    protected $_username;
    protected $_firstname;
    protected $_lastname;
    protected $_id;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid member property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid member property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setDegreeDate($date)
    {
        $this->_degree_date = $date;
        return $this;
    }

    public function getDegreeDate()
    {
        return $this->_degree_date;
    }

    public function setBirthday($date)
    {
        $this->_birthday = $date;
        return $this;
    }

    public function getBirthday()
    {
        return $this->_birthday;
    }

    public function setMaidenName($maidenName)
    {
        $this->_maiden_name = $maidenName;
        return $this;
    }

    public function getMaidenName()
    {
        return $this->_maiden_name;
    }

    public function setSex($sex)
    {
        $this->_sex = $sex;
        return $this;
    }

    public function getSex()
    {
        return $this->_sex;
    }
    
    public function setUpdatedAt($date)
    {
        $this->_updatedAt = $date;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }


    public function setCreatedAt($date)
    {
        $this->_createdAt = $date;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    public function setUpdatedBy($id)
    {
        $this->_updatedBy = $id;
        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->_updatedBy;
    }

    public function setCreatedBy($id)
    {
        $this->_createdBy = $id;
        return $this;
    }

    public function getCreatedBy()
    {
        return $this->_createdBy;
    }

    public function setAssociationId($id)
    {
        $this->_associationId = $id;
        return $this;
    }

    public function getAssociationId()
    {
        if ( $this->_associationId == null  )
                $this->_associationId = 1;
        
        return $this->_associationId;
    }

    public function setState($state)
    {
        $this->_state = $state;
        return $this;
    }

    public function getState()
    {
        if ( $this->_state == null )
                $this->_state = 1;
        
        return $this->_state;
    }

    public function setPhoneMobile($phoneMobile)
    {
        $this->_phoneMobile = $phoneMobile;
        return $this;
    }

    public function getPhoneMobile()
    {
        return $this->_phoneMobile;
    }

    public function setPhoneHome($phoneHome)
    {
        $this->_phoneHome = $phoneHome;
        return $this;
    }

    public function getPhoneHome()
    {
        return $this->_phoneHome;
    }

    public function setWebsite($website)
    {
        $this->_website = $website;
        return $this;
    }

    public function getWebsite()
    {
        return $this->_website;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getEmail()
    {        
        return $this->_email;
    }

    public function setPicture($picture)
    {
        $this->_picture = $picture;
        return $this;
    }

    public function getPicture()
    {
        return $this->_picture;
    }

    public function setCountry($country)
    {
        $this->_country = $country;
        return $this;
    }

    public function getCountry()
    {
        return $this->_country;
    }

    public function setCity($city)
    {
        $this->_city = $city;
        return $this;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function setZipCode($zipcode)
    {
        $this->_zipcode = $zipcode;
        return $this;
    }

    public function getZipCode()
    {
        return $this->_zipcode;
    }

    public function setStreet($street)
    {
        $this->_street = $street;
        return $this;
    }

    public function getStreet()
    {
        return $this->_street;
    }

    public function setDueExempt($dueExempt)
    {
        $this->_dueExempt = $dueExempt;
        return $this;
    }

    public function getDueExempt()
    {
        if ( $this->_dueExempt == null )
                $this->_dueExempt = 0;
        
        return $this->_dueExempt;
    }

    public function setSubscriptionDate($subscriptionDate)
    {
        $this->_subscriptionDate = $subscriptionDate;
        return $this;
    }

    public function getSubscriptionDate()
    {
        if ($this->_subscriptionDate == null )
                $this->_subscriptionDate = date('Y-m-d H:i:s');
       
        return $this->_subscriptionDate;
    }

    public function setStatusId($statusId)
    {       
        $this->_statusId = $statusId;
        return $this;
    }

    public function getStatusId()
    {
        // TODO: mapper la table status et récupérer le status "Client" pour l'enregistrement d'un nouveau membre par défaut
        $this->_statusId = 1;
        return $this->_statusId;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setUserName($username)
    {
        $this->_username = $username;
        return $this;
    }

    public function getUserName()
    {
        return $this->_username;
    }

    public function setFirstName($firstname)
    {
        $this->_firstname = $firstname;
        return $this;
    }

    public function getFirstName()
    {
        return $this->_firstname;
    }

    public function setLastName($lastname)
    {
        $this->_lastname = $lastname;
        return $this;
    }

    public function getLastName()
    {
        return $this->_lastname;
    }
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}

