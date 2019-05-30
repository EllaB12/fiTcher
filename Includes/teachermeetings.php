<?php
  
require_once('init.php');

class TeacherMeeting{
    // Attributes
    public $id;
    public $date;
    public $stime;
    public $etime;
    public $sid;
    public $tid;
    
    // Methods
    public static function fetch_meetings(){
        
        global $database;
        $result_set=$database->query("select * from teachermeetings");
        $teachers=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teacher=new TeacherMeeting();
                    $teacher->instantation($row);
                    $teachers[$i]=$teacher;
                    $i+=1;
                }
            }
        }
        return $teachers;
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

     public static function set_sid($mid, $sid){
        global $database;
        $database->query('update `teachermeetings` set `sid` = "'.$sid.'" where `id`="'.$mid.'"');
    }
	
    public static function add_meeting($date,$stime,$etime,$tid){
        global $database;
        $sql="INSERT INTO teachermeetings(date,stime,etime,tid) values ('$date','$stime','$etime','$tid')";
        $result=$database->query($sql);
        $error = "";
        if (!$result)
            $error='Error adding meeting:'.$database->get_connection()->error;
        return $error;
    }  
    public static function delete($mid){
        global $database;
        $sql="DELETE FROm teachermeetings WHERE id='".$mid."'";
        $result=$database->query($sql);
        $error = "";
        if (!$result)
            $error='Error deleting meeting:'.$database->get_connection()->error;
        return $error;
    }  
    public static function add_meeting_to_payment($sid,$tid,$date,$stime){
        global $database;
        $sql="INSERT INTO payments(student_id,teacher_id,date,status,hour) values ('$sid','$tid','$date','לא שולם','$stime')";
        $result=$database->query($sql);
        $error = "";
        if (!$result)
            $error='Error adding meeting:'.$database->get_connection()->error;
        return $error;
    }  
}

?>
