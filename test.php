<?php
include_once('Includes/init.php');
$teacher = new Teacher();

session_start();
$city = $_SESSION['city'];
$subject_id =  $_SESSION['subject_id'];
$grade = $_SESSION['grade'];
$gender = $_SESSION['gender'];

if($gender=="none"){
$teacher->matching($city,$subject_id,$grade);
}
else
    $teacher->matching_with_gender($city,$subject_id,$grade,$gender);

?>