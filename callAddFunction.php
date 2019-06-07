<?php
//Get student and teacher id and send them to studentTeacher table
include_once('Includes/init.php');

$user_id = $_SESSION['user_id'];
$teacherID = $_POST['variable1'];

if(isset($teacherID)){
     $match = new studentTeacher();
     $valid = $match->check_studentTeacher_validation($user_id,$teacherID);
     if($valid == false){
        $match->addMatch($user_id,$teacherID);
        
        $teacher=new Teacher();
        $teacher->addLike($teacherID);
     }
}
?>