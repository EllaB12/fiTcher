<?php

require_once('database.php');

class Subject{
     // Attributes
    private $ID;
    private $name;

    // Methods
    public static function fetch_subjects(){
        global $database;
        $result_set=$database->query("select * from subjects");
        $subjects=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $subjects[]=$row["name"];
                }
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($subjects);
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
    
    
    public function find_subject_by_name($name){
        global $database;
        $error=null;
        $result=$database->query("select ID from subjects where name='".$name."'");
          if (!$result)
            $error='Can not find the subject.  Error is:'.$database->get_connection()->error;
        else if ($result->num_rows>0){
            $found_student=$result->fetch_assoc();
            $this->instantation($found_student);
        }
         else
             $error="Can not find subject by this name";
        return $error;
    }
    
    
    public function get_id(){
        return $this->ID;
    }

}

?>