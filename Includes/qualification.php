<?php
  
require_once('init.php');

class Qualification{
     // Attributes
    private $teacherID;
    private $subjectID;
    private $educationGroup;
    
    // Methods
    public static function add_qualification($teacherID,$subjectID,$educationGroup){
        global $database;
        $error=null;
        $sql="INSERT INTO qualifications(teacherID,subjectID,educationGroup) VALUES ('$teacherID','$subjectID','$educationGroup')";
        $result=$database->query($sql);
    
        if (!$result)
            $error='Can not add qualification.  Error is:'.$database->get_connection()->error;
        return $error;
    }
}

?>
    
   