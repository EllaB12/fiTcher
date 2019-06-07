<?php 
include_once("Includes/init.php");
    $conn= new Database();
    $conn= $conn->get_connection();
    $user_id=$session->get_user_id();
    $userObj  = mysqli_query($conn , "SELECT *  FROM teachermeetings WHERE teachermeetings.sid='".$user_id."'");
    
?>