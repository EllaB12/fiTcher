<?php
include_once("Includes/database.php");
$conn= new Database();
$conn= $conn->get_connection();//connection 
// $id= $_POST['id'];
$paymentId=$_POST['paymentId'];
// echo $paymentId;
// print $id;
// $sql = "DELETE FROM payments WHERE id='$id'";// query to delete lessons from table payments
$sql = "UPDATE payments SET status='שולם' WHERE paymentID='$paymentId'";// query to update lessons from table payments to paid
// header("Location:paypal/first.php");
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
?>