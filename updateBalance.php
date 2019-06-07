<?php
    require_once("Includes/init.php");
    $conn= new Database();
    $conn= $conn->get_connection();

    if(isset($_POST['submit'])) {
         $studentID = $_POST['idstudent'];
         $cash = $_POST['cash'];
    }
    $user_id=$session->get_user_id();
    $user = Teacher::find_teacher_by_id($user_id);
    $price=$user->get_price();
    $sql = "UPDATE studentTeacher 
    SET balance= '$price' + balance - '$cash' 
    WHERE idStudent='$studentID' and idTeacher='$user_id' ";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    echo('<script>location.href = "indexTeacher.php#payment";</script>');
    
?>