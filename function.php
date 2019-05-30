<?php 
include_once("Includes/init.php");
    $conn= new Database();
    $conn= $conn->get_connection();
    $user_id=$session->get_user_id();
    $userObj  = mysqli_query($conn , "SELECT *  FROM payments WHERE payments.student_id='".$user_id."'");
    if(isset($_POST['data'])){
	$dataArr = $_POST['data'] ; 

	foreach($dataArr as $id){
		mysqli_query($conn , "DELETE FROM payments where student.id='$id'");
	}
	echo 'שיעור נמחק בהצלחה';
}

?>