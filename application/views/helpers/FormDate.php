<?php

class Zend_View_Helper_FormDate extends Zend_View_Helper_FormElement{

    public function formDate($name,$value=null,$attrib=null){
        $day=substr($value, 8,2);
        $month=substr($value, 5,2);
        $year=substr($value, 0,4);
          //  echo var_dump($value);
          //  echo $day;
        $dayMulti=array(''=>'');
        for ($i=1;$i<=31;$i++){
            $key=str_pad($i,2,'0',STR_PAD_LEFT);
            $dayMulti[$key]=$key;
        }
        $monthMulti=array(''=>'');
        for ($i=1;$i<=12;$i++){
            $key=str_pad($i,2,'0',STR_PAD_LEFT);
            $monthMulti[$key]=$key;
        }
        $yearMulti=array(''=>'');
        for ($i=1920;$i<=date("Y");$i++){
            $key=str_pad($i,2,'0',STR_PAD_LEFT);
            $yearMulti[$key]=$key;
        }

        return $this->view->formSelect($name.'[day]',$day,null,$dayMulti).'&nbsp;'.
               $this->view->formSelect($name.'[month]',$month,null,$monthMulti).'&nbsp;'.
               $this->view->formSelect($name.'[year]',$year,null,$yearMulti);

    }


}