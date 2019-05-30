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
<header dir="ltr">
      <!--========================== Header ============================-->
<!-- Navigation -->
  <!--<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top" dir="ltr">-->
  <!--  <div class="container" id="navia">-->
  <!--    <a class="navbar-brand" href="index.html"><img src="Images/logo.png" height=70 width=120></a>-->
  <!--    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">-->
  <!--      <span class="navbar-toggler-icon"></span>-->
  <!--    </button>-->
  <!--    <div class="collapse navbar-collapse" id="navbarResponsive">-->
  <!--      <ul class="navbar-nav ml-auto">-->
  <!--             <?php/*
  <!--              require_once('Includes/init.php');-->
            
  <!--              if (!$session->get_signed_in()){-->
  <!--                   header('Location: newLogin.php');-->
  <!--                   exit;-->
  <!--                }-->
 
  <!--              $user_id=$session->get_user_id();-->
  <!--              $user_with_password=new Password();-->
  <!--              $user_with_password->find_user_by_id($user_id);-->
  <!--              $permission=$user_with_password->get_permission();-->
  <!--              $url="";-->
                
  <!--              if($permission == 1){-->
  <!--                  $url="indexStudent.php";-->
  <!--              }else{-->
  <!--                  $url="indexTeacher.php";-->
  <!--              }-->
                     
  <!--        */   ?>-->
  <!--          <li class="nav-item dropdown" dir="rtl">-->
  <!--          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
  <!--            שלום <?php// echo $user_with_password->get_userName();?>-->
  <!--          </a>-->
  <!--          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">-->
  <!--            <a class="dropdown-item" href=" <?php echo $url;?>"><i class='fas fa-user-circle'></i> אזור אישי</a>-->
  <!--            <a class="dropdown-item" href="#" onclick='log_out();'><i class='fas fa-sign-out-alt'></i> התנתקות</a>-->
  <!--          </div>-->
  <!--        </li>-->
  <!--        <li class="nav-item">-->
  <!--          <a class="nav-link" href="#footer">צור קשר</a>-->
  <!--        </li>-->
  <!--        <li class="nav-item">-->
  <!--          <a class="nav-link" href="#payment">?כמה אני חייב</a>-->
  <!--        </li>-->
  <!--        <li class="nav-item">-->
  <!--          <a class="nav-link" href="NewFindMeTeacher.php">מצא לי מורה</a>-->
  <!--        </li>-->
  <!--        <li class="nav-item">-->
  <!--          <a class="nav-link" href="#myTeachers">המורים שלי</a>-->
  <!--        </li>-->
  <!--        <li class="nav-item">-->
  <!--          <a class="nav-link" href="homePageLoginNew.php">עמוד הבית</a>-->
  <!--        </li>-->
  <!--      </ul>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</nav>-->
</header>

<body dir="rtl">

  <!--========================== Header ============================-->
  <!--<header id="header" class="fixed-top">-->
  <!--    <div class="fitcher-logo float-left">-->
  <!--      <a href="#intro" class="scrollto">-->
  <!--          <img src="Images/Picture1.png" alt="" class="img-fluid">-->
  <!--      </a>-->
  <!--    </div>-->
  <!--    <nav class="main-nav float-right d-lg-block">-->
  <!--      <ul>-->
  <!--        <li><a href="#contact">צור קשר</a></li>-->
  <!--        <li><a href="#services">מצא לי מורה</a></li>-->
  <!--        <li><a href="#portfolio">מורים מומלצים</a></li>-->
  <!--        <li><a href="#about">קצת עלינו</a></li>-->
  <!--        <li class="active"><a href="#intro">דף הבית</a></li>-->
  <!--      </ul>-->
  <!--    </nav>-->
  <!--</header>-->
  
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
  
<!--==========================   Footer   ============================-->
 <!-- Footer -->
 <!-- <footer class="py-5 bg-dark">-->
 <!--   <div class="container-fluid">-->
 <!--     <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>-->
 <!--   </div>-->
    <!-- /.container -->
 <!-- </footer>-->
 
</body>
</html>