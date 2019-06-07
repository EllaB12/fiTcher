<?php
     require_once('Includes/init.php');

     if (!$session->get_signed_in()){
         header('Location: newLogin.php');
         exit;
     }
 
     $user_id=$session->get_user_id();
     $user=new Student();
     $user->find_student_by_id($user_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Fitcher-PayPal Payment</title>
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>
  <meta content="width=device-width, initial-scale=1.0 , shrink-to-fit=no" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="Images/favicon.png" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="CSS/modern-business.css" rel="stylesheet">
  <link href="CSS/homePage.css" rel="stylesheet">
  <link href="CSS/indexStudent.css" rel="stylesheet">
  
  <!--JS grid-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
#container {
   min-height:100%;
   position:relative;
}
#header {
   background:#ff0;
   padding:10px;
}
#body {
   padding:10px;
   padding-bottom:60px;   /* Height of the footer */
}
#footer {
   position:absolute;
   bottom:0;
   width:100%;
}
</style>

</head>
<div id="header">
<header dir="ltr">
     <!--========================== Header ============================-->
    <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container" id="navia">
      <a class="navbar-brand" href="homePageNew.php"><img src="Images/logo.png" height=70 width=120></a>
      <button class="navbar-toggler navbar-toggler-right" id="hamburger" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
               <?php
                require_once('Includes/init.php');
            
                if (!$session->get_signed_in()){
                     header('Location: newLogin.php');
                     exit;
                  }
 
                $user_id=$session->get_user_id();
                $user_with_password=new Password();
                $user_with_password->find_user_by_id($user_id);
                $permission=$user_with_password->get_permission();
                $url="";
                
                if($permission == 1){
                    $url="indexStudent.php";
                }else{
                    $url="indexTeacher.php";
                }
                     
             ?>
            <li class="nav-item dropdown" dir="rtl">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              שלום <?php echo $user_with_password->get_userName();?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href=" <?php echo $url;?>"><i class='fas fa-user-circle'></i> אזור אישי</a>
              <a class="dropdown-item" href="logout.php" onclick='log_out()'><i class='fas fa-sign-out-alt'></i> התנתקות</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">צור קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#lesson">קבע פגישה</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#payment">?כמה אני חייב</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="NewFindMeTeacher.php">מצא לי מורה</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#myTeachers">המורים שלי</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="homePageLoginNew.php">עמוד הבית</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
</div>
<div id="body">
<body dir="rtl" >
  <div class="container">  
    <section class="container"  id="payment" align="center"><br><Br>
       <h1><B>  התשלום בוצע בהצלחה, </B><?php//  echo $user->get_fullName() ?> </h1>
       <p id="studentH1" class="container">הכסף בדרכו אל המורה,<br>אנו מודים לך על השימוש במערכת! </p>
       <img src="Images/smiley_PNG149.png" height="120px" width="150px">
    </section>
    <?php  header("refresh:7;url=indexStudent.php" );?>
    </body>
</div>

<!--==========================   Footer   ============================-->
  <!-- Footer -->
  <footer class="py-5 bg-dark" id="footer">
    <div class="container">
      <p class="m-0 text-center text-white">© fiTcher 2019 </p>
      <p class="m-0 text-center text-white">אלה ברזלב            |              נעם צינס              |              נוי רז</p>
      <p class="m-0 text-center text-white">fitcher@gmail.com </p>
    </div>
  </footer>
 </div>
 
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>
