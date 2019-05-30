<?php

require_once('database.php');

class City{
     // Attributes
    private $name;

    public static function fetch_cities(){
        
        global $database;
        $result_set=$database->query("select * from cities");
        $cities=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $cities[]=$row["name"];
                }
            }
        }
        header('Content-Type: application/json');
        
        echo json_encode($cities);
}

  
    
    

    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
     private function  instantation($student_array){
        foreach ($student_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
}

/*$city=new City();
$city->fetch_cities();*/
?>