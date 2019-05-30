<!--php-->
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

<?php

    include_once('Includes/init.php');
    global $session;
    $error='';
    if(isset($_POST['submit'])){
        if (!$_POST['user']){
            $error='שכחת להזין מספר תעודת זהות';
          
        }
        else if(!$_POST['password']){
            $error='שכחת להזין סיסמה';
            
        }
        else{
            $id=$_POST['user'];
            $password=$_POST['password'];
            $user_with_password=new Password();
            $error=$user_with_password->find_user($id,$password);
            if (!$error){
                $session->login($user_with_password);
                header('Location:homePageLoginNew.php');
            }
        }
    }

?>

<!--HTML-->
<!DOCTYPE html>
<html lang="he">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    
     <title>כניסה</title>
     
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
   
    <!--CSS-->
    <link rel="stylesheet" href="CSS/login.css">
    
     <!--w3 icons-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--Java Script-->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".register-link").click(function(){
          $(".register").show();
          $(".content").hide();
          $(".register-link").addClass('active');
          $(".register-link").removeClass('inactive');
          $(".register-link").removeClass('underlineHover');
          $(".login-link").removeClass('active');
          $(".login-link").addClass('inactive');
          $(".login-link").addClass('underlineHover');
        });
        $(".login-link").click(function(){
          $(".content").show();
          $(".register").hide();
          $(".login-link").addClass('active');
          $(".login-link").removeClass('inactive');
          $(".login-link").removeClass('underlineHover');
          $(".register-link").removeClass('active');
          $(".register-link").addClass('inactive');
          $(".register-link").addClass('underlineHover');
        });
      });
    </script>

</head>
<body>

        <div class="wrapper fadeInDown">
                <div id="formContent">
                  <!-- Tabs Titles -->
                  <a href="#login-form" class="login-link active" id="login-link">כניסה</a>
                  <a href="#register" class="register-link inactive underlineHover" id="register-link">הרשמה</a>
                  
              
                  <!-- Login Form -->
                  <div class="content">
                      <!-- Icon -->
                      <div class="fadeIn first">
                          <img src="Images/user.png" id="icon" alt="User Icon"/>
                      </div>
                      
                        <p class="fadeIn first welcome">ברוכים הבאים ל-fiTcher</p>

                      <form method="post" id="login-form">
                        <input type="text" id="email" class="fadeIn second" name="user" placeholder="הזן מספר תעודת זהות">
                        <input type="password" id="password" class="fadeIn third" name="password" placeholder="הזן סיסמה">
                        <input type="submit" class="fadeIn fourth pointer" name="submit" value="תכניס אותי">
                       
                      </form>
                      
                        <p id="error" style="color:red; font-weight:bold;"><?php echo $error?></p>
                        <a href="homePageNew.php" class="home-link inactive underlineHover fadeIn fourth" style="margin:0; margin-bottom:10px;"> <i class="fa fa-home"></i> חזרה לעמוד הבית</a>   
                 </div>

                  <!--Register-->
                  <div class="register" id="register" style="display: none;">
                      
                  
                  <a href="NewRegistration.php" class="fadeIn first padd"><img class="iconi" src="Images/reading.png"></br>תלמיד</a>
                  <a href="NewTeacherRegistration.php" class="fadeIn second padd"><img class="iconi" src="Images/teaching.png"></br>מורה</a>  
                  </div>
              
                </div>
        </div>
   
              
</html>