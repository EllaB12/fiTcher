<?php
     require_once('Includes/init.php');

     if (!$session->get_signed_in()){
         header('Location: newLogin.php');
         exit;
     }
 
     $user_id=$session->get_user_id();
     $_SESSION['$user_id'] = $user_id;
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Teachers</title>

  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!--Bootstrap file custom-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

  <!-- Stylesheet File -->
  <link href="CSS/teachersStyle.css" rel="stylesheet">
 
  <script src="https://cdn.rawgit.com/icons8/titanic/master/dist/js/titanic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.5.9/bodymovin.min.js"></script>
  
  <!-- Js -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./JS/teachers.js"></script>
  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
   <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script></script>

</head>
<header dir="ltr"> </header>

<body dir="rtl">
  
  <!--========================== main ============================-->
 <div class="container">
    <div class="col-md-12">
    <p sytle="margin:auto20px;">תוצאות חיפוש</br>
     <div class="row">
  <!--<section class="teacherSection">-->
    <div id="rightSide">
        <a id="rightArrow">
            <img src="./Images/icons/right.png" border="0"  onclick="backward()"/>
        </a>
    </div>
    <div id="teacherContainer"><div style="color:#116677" class="notFount">לא נמצאו מורים מתאימים</div>
        <div style="margin:auto"><img id="search" src="Images/animat-search-color.gif" /></div></div>
   <div id="leftSide">
        <a id="leftArrow"> 
            <img src="./Images/icons/left.png" onclick="forward()"/> 
        </a>
    </div>
    
    </div>
  <!--</section>-->
  </div>
  </div>
</body>

</html>