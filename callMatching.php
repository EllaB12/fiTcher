<?php
include_once('Includes/init.php');

if(isset($_POST['submit'])){
    $city =  $_POST["city"];
    $gender = $_POST["gender"];
    $subjectName = $_POST["name"];
    $grade =  $_POST["grade"];
    
    $subject = new Subject();
    $subject->find_subject_by_name($subjectName);
    $subject_id = $subject->get_id();


    session_start();
    $_SESSION['city'] = $city;
     $_SESSION['gender'] = $gender;
    $_SESSION['subject_id'] = $subject_id;
    $_SESSION['grade'] = $grade;


header("Location: teachersMatch.php");


}
?>