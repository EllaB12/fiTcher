<?php 
include_once("Includes/init.php");
    $conn= new Database();
    $conn= $conn->get_connection();
    $user_id=$session->get_user_id();
    $userObj  = mysqli_query($conn , "SELECT payments.*, students.*,studentTeacher.balance  FROM payments,students,studentTeacher  WHERE payments.teacher_id='".$user_id."' and students.id=payments.student_id and studentTeacher.idStudent=payments.student_id ");
    if(isset($_POST['data'])){
	$dataArr = $_POST['data'] ; 

	foreach($dataArr as $id){
		mysqli_query($conn , "DELETE FROM payments where student.id='$id'");
	}
	echo 'שיעור נמחק בהצלחה';
}

?>