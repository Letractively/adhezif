<?php
class Application_Model_Filter_Date implements Zend_Filter_Interface{

    public function filter($value){
        

        if (strlen($value)==10 && substr($value, 2,1)=="/" &&  substr($value, 5,1)=="/"  ) {
            $filteredData=substr($value, 6,4)."-".substr($value, 3,2)."-".substr($value, 0,2) ;
            return $filteredData;
        }else{
          return $value;
        }
    }
}
