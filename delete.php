<?php
include_once("Includes/database.php");
$conn= new Database();
$conn= $conn->get_connection();//connection 
$paymentId=$_POST['paymentId'];
$sql = "UPDATE payments SET status='שולם' WHERE paymentID='$paymentId'";// query to update lessons from table payments to paid


$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

?>