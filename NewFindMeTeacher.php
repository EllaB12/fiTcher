<!--HTML-->
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

    <title>מצא לי מורה</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>


    <!--CSS-->
    <link rel="stylesheet" href="CSS/FindMyTeacher.css">
    <!-- Custom styles for this template -->
    <link href="CSS/modern-business.css" rel="stylesheet">
    <link href="CSS/homePage.css" rel="stylesheet">

      <!--jQuery-->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
    
    
    <!--Bootstrap file custom-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
     <!--Autocomplete jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
     <!--Java Script-->
    <script src="JS/cityautocomplete.js"></script>
    <script src="JS/subjectAutocomplete.js"></script>
    <script src="JS/findMyTeacher.js"></script>
    <script>  
         $(document).ready(function(){  
              var i=1;  
              $('#add').click(function(){  
                   i++;  
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="מקצוע לימוד" class="subjectText" /></td><td><select name="grade[]"><option value="" disabled selected >רמה</option><option value="יסודי">יסודי</option><option value="חטיבה">חטיבה</option> <option value="תיכון 2 יחידות">תיכון 2 יח"ל</option><option value="תיכון 3 יחידות">תיכון 3 יח"ל</option><option value="תיכון 4 יחידות">תיכון 4 יח"ל</option><option value="תיכון 5 יחידות">תיכון 5 יח"ל</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });  
              $('#submit').click(function(){            
                   $.ajax({  
                        url:"NewTeacherRegistration.php",  
                        method:"POST",  
                        data:$('#add_name').serialize(),  
                        success:function(data)  
                        {  
                            //  alert(data);  
                             $('#add_name')[0].reset();  
                        }  
                   });  
              });  
         });  
    </script>

     <!--w3 icons-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
    integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    
   
</head>




<header dir="ltr">
      <!--========================== Header ============================-->
<!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top" dir="ltr">
    <div class="container" id="navia">
      <a class="navbar-brand" href="homePageNew.php"><img src="Images/logo.png" height=70 width=120></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="dropdown-item" href="#" onclick='log_out();'><i class='fas fa-sign-out-alt'></i> התנתקות</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="indexStudent.php#footer">צור קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="indexStudent.php#payment">?כמה אני חייב</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="NewFindMeTeacher.php">מצא לי מורה</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="indexStudent.php#myTeachers">המורים שלי</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="homePageLoginNew.php">עמוד הבית</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


<body dir="rtl">    
<!-- Find me a teacher -->    
        <div class="wrapper fadeInDown">
                <div id="formContent">
                  <a href="NewFindMeTeacher.php" class="login-link inactive underlineHover" id="match">מצא לי מורה</a>
                    <h5>באמצעות 3 שלבים פשוטים </h5>
                    <h5>נמצא את המורה המתאים בשבילך </h5>
                    
                  <!-- Form -->
                    <div class="content">
                      <!-- Icon -->
                      <div class="fadeIn first">
                          <img src="Images/job.png" id="icon" alt="User Icon"/>
                      <!--    <img src="Images/teaching.png" id="icon" alt="User Icon"/>-->
                      <!--</div>-->

                      <form  action="callMatching.php" method="post" id="login-form" name="RegForm">
                         <!-- progressbar -->
                         <ul dir="rtl" id="progressbar">
                                <li class="active">מגדר המורה</li>  
                                <li>עיר מגורים</li> 
                                <li>מקצוע לימוד</li>
                        </ul>

                        <!-- fieldsets 1-->
                        <fieldset>
                              <div id="gender">
                                <h6 id="empty-gender-alert" style="color:red; display:none; font-size:14px;">בחר את מגדר המורה</h6>
                						<label class="gender" >
                						    <i class="fa fa-male" style="font-size:36px;color:#00A5C6"></i>
                							<input checked type="radio" name='gender' value='זכר'> זכר &nbsp;
                						</label>
                						<label class="gender">
                							<i class="fa fa-female" style="font-size:34px;color:#00A5C6"></i>
                							<input type="radio" name='gender' value='נקבה'> נקבה &nbsp;
                						</label>
                						<label class="gender">
                							<i class="fa fa-ban" style="font-size:34px;color:#00A5C6"></i>
                							<input type="radio" name='gender' value='none'> אין חשיבות למגדר המורה
            
                						</label>
                                </div>
                                <input type="button" name="next" class="next action-button" value="המשך לשלב הבא" />
                        </fieldset>
                                
                         <!-- fieldsets 2-->
                         <fieldset>
                                <input required type="text" id="cityText" name="city" dir="rtl" placeholder="עיר מגורים" /> 
                                <h6 id="empty-city-alert" style="color:red; display:none; font-size:14px;">בחר עיר, לפי בחירה זו תתבצע ההתאמה</h6>

                                <input type="button" name="next2" class="next2" value="המשך לשלב הבא" /></br>
                         </fieldset>
                         
                          <!-- fieldsets 3-->
                         <fieldset>
                                <label for="jubject" class="experience">מקצועות לימוד:</label>
                                <div class="appending_div">
                                      <table class="table" id="dynamic_field">  
                                          <tr>  
                                           <td><input type="text" id="subjectText" name="name" placeholder="מקצוע לימוד" class= "subjectText" required /></td>  
                                            <td> 
                                                <select name="grade" >
                                                     <option value="" disabled selected >רמה</option>
                                                     <option value="יסודי">יסודי</option>
                                                     <option value="חטיבה">חטיבה</option>
                                                     <option value="תיכון 2 יחידות">תיכון 2 יח"ל</option>
                                                     <option value="תיכון 3 יחידות">תיכון 3 יח"ל</option>
                                                     <option value="תיכון 4 יחידות">תיכון 4 יח"ל</option>
                                                     <option value="תיכון 5 יחידות">תיכון 5 יח"ל</option>
                                                 </select>
                                            </td>
                                            <td>
                                                <!--<h6 id="empty-subject-alert" style="color:red; display:none; font-size:14px;">שכחת לבחור מקצוע לימוד<?php //echo $error?></h6>-->
                                            </td>
                                          </tr>  
                                      </table>
                                     <h6 id="empty-subject-alert" style="color:red; display:none; font-size:14px;">שכחת לבחור מקצוע לימוד</h6>
                                </div>
                                <input type="submit" id="submit" name="submit" class="next3 action-button" value="!match" onsubmit="subject_validation()"/></br>
                         </fieldest>
                         
                      <!--<a href="homePageNew.php" class="home-link inactive underlineHover fadeIn fourth" style="margin:0; margin-bottom:10px;"> <i class="fa fa-home"></i> חזרה לעמוד הבית</a>      -->       
                      </form>
                    </div>
                </div>        
        </div>
  </div>
<!--   <script>
    function subject_validation() {
       
        var subject = document.forms["RegForm"]["subject"]; 
        var notValid="יש לבחור לפחות מקצוע לימוד אחד";
         if (subject.value == " ") {
            document.getElementById("empty-subject-alert").style.display="block";
        }
    }
    </script>-->
<!--==========================   Footer   ============================-->
 <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container-fluid">
      <p class="m-0 text-center text-white">© fiTcher 2019 </p>
      <p class="m-0 text-center text-white">אלה ברזלב            |              נעם צינס              |              נוי רז</p> 
      <p class="m-0 text-center text-white">fitcher@gmail.com </p>
    </div>
    <!-- /.container -->
  </footer>
  

</body>
<script>
function log_out(){
        window.location='logout.php';
}
</script>
</html>