<?php

require_once('database.php');

class studentTeacher{
     // Attributes
    private $idStudent;
    private $idTeacher;

    //Methods
     public static function addMatch($idStudent,$idTeacher){
        global $database;
        $error=null;
        $sql="INSERT INTO studentTeacher(idStudent,idTeacher) VALUES ('$idStudent','$idTeacher')";
        $result=$database->query($sql);
    
        if (!$result)
            $error='Can not add student and teacher.  Error is:'.$database->get_connection()->error;
        return $error;
    }
    
    
    public function check_studentTeacher_validation($idStudent,$idTeacher){
        global $database;
        $valid=null;
        $result=$database->query("select * from studentTeacher where idStudent='".$idStudent."' and idTeacher='".$idTeacher."'");
          if ($result->num_rows>0){
            $valid= true;
          }
          else
            $valid=false;
            
        return $valid;
    }
}

?>