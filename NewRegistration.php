<!--php-->
<?php

require_once('Includes/init.php');

$password = $_POST["password"];
$fullName = $_POST["fullName"];
$street = $_POST["street"];
$city = $_POST["city"];
$phone = $_POST["phone"];
$parent_phone = $_POST["parent_phone"];
$grade = $_POST["grade"];
$parent_phone = $_POST["parent_phone"];
$permission="1";

$id ="";
// $email = $_POST["email"];

$idErr="";
$emailErr="";

if(isset($_POST['submit'])){
    
    $student=new Student();
    $student_with_password=new Password();
    	
    $register_Students =null;
    $register_Password =null;
    
	  
    $emailValidation=$student->check_email_validation($_POST['email']);
    if($emailValidation){
        $emailErr = 'כתובת הדוא"ל שהזנת כבר קיימת';
    }
    else
        $email=$_POST['email'];
          
          
    $idValidation=$student->check_id_validation($_POST['id']);
    if($idValidation){
        $idErr = 'מספר תעודת הזהות כבר קיים';
    }
    else
        $id=$_POST['id'];
   
    
    if($idErr){
        echo '<script> alert("מספר תעודת הזהות כבר קיים במערכת!")</script>';
    }
    else if($emailErr)
    {
          echo '<script> alert("הדואר האלקטרוני שהזנת כבר קיים במערכת!")</script>';
    }
    else{  
        //file uploading
        if($_FILES["filename"]["name"]){
		    $target_file = "Images/users_images/".$id."-".basename($_FILES["filename"]["name"]);
        }
        else{
             $target_file = "Images/reading.png";
        }
        
		if (!move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) 
            {
            echo "Sorry, there was an error uploading your file.";
            echo "<br>".$_FILES['filename']['error'];
            }
         
        $register_Students = $student->add_student($id,$fullName,$email,$phone,$parent_phone,$city,$street,$target_file,$grade);
        $register_Password=$student_with_password->add_password($id,$fullName,md5($password),$permission);
        
        echo '<script> alert("ההרשמה בוצעה בהצלחה!")</script>';
        header("Location: newLogin.php");
   	}
}

?>


<!--HTML-->
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <title>הרשמה לתלמיד</title>

    <!--CSS-->
    <link rel="stylesheet" href="CSS/register.css">

  <!--jQuery-->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"><!-- jQuery library -->
    
    <!--Bootstrap file custom-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
     <!--Autocomplete jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
    
     <!--Java Script-->
    <script src="JS/register.js"></script>
    <script src="JS/cityautocomplete.js"></script>
    
     <!--w3 icons-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
    integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    
    
</head>
<body>
        <div class="wrapper fadeInDown">
                <div id="formContent">
                  <a href="NewRegistration.php" class="login-link inactive underlineHover" id="login-link">הרשמה לתלמיד</a>
                  
                  <!-- Login Form -->
                    <div class="content">
                      <!-- Icon -->
                      <div class="fadeIn first">
                          <img src="Images/reading.png" id="icon" alt="User Icon"/>
                      </div>

                      <form  method="post" id="login-form" name="RegForm" enctype="multipart/form-data">
                         <!-- progressbar -->
                         <ul dir="rtl" id="progressbar">
                                <li class="active">יצירת חשבון</li>  
                                <li>פרטים אישיים</li> 
                                <li>סיום!</li>
                        </ul>
                        
                        <!-- fieldsets 1-->
                        <fieldset>
                                 <a class="info" href="#">הורים לתלמידים? <span> אנא הכניסו את פרטי ילדכם והוסיפו את מספר הטלפון הנייד שלכם  </span></a></br>
                                 
                                <input required type="text" maxlength="9" id="ID" name="id" placeholder="תעודת זהות" />
                                <h6 id="empty-id-alert" style="color:red; display:none; font-size:14px;">הזן תעודת זהות</h6>
                                <h6 id="invalid-id-alert" style="color:red; display:none; font-size:14px;">תעודת זהות תקינה מכילה 9 ספרות</h6>

                                <input required type="text" name="email" placeholder="דואר אלקטרוני" />
                                <h6 id="empty-email-alert" style="color:red; display:none; font-size:14px;padding:none;">הזן כתובת דואר אלקטרוני</h6>
                                <h6 id="invalid-email-alert" style="color:red; display:none; font-size:14px;padding:none;">כתובת הדוא"ל שהזנת אינה חוקית</h6>

                                <input required id="userPass" type="password" name="password" placeholder="סיסמה" minlength="6" maxlength="12">
                                <input required id="confirm_pass" type="password" name="cpass" placeholder="אימות סיסמה" minlength="6" maxlength="12">
                                <h6 id="pw-msg" style="color:red; display:none; font-size:14px;">הסיסמה חייבת להכיל 12-6 ספרות ותווים</h6>
                                <h6 id="pw-equal" style="color:red; display:none; font-size:14px;">הסיסמאות אינן זהות</h6>

                                <input type="button" name="next" class="next action-button" value="המשך לשלב הבא" />
                                
                        </fieldset>
                                
                         <!-- fieldsets 2-->
                         <fieldset>
                                <input required type="text" id="fullName" name="fullName" placeholder="שם מלא" /> 
                                <h6 id="empty-fullName-alert" style="color:red; display:none; font-size:14px;">הזן שם מלא</h6>
                                <h6 id="invalid-fullName-alert" style="color:red; display:none; font-size:14px;">הזן שם מלא בצורה תקינה</h6>

                                <input required type="text" id="street" name="street" placeholder="רחוב ומספר בית" /> 
                                <h6 id="empty-street-alert" style="color:red; display:none; font-size:14px;">הזן רחוב ומספר בית</h6>
                                <h6 id="invalid-street-alert" style="color:red; display:none; font-size:14px;">הזן את שם הרחוב ומספר הבית</h6>
                                <h6 id="invalid-numStreet-alert" style="color:red; display:none; font-size:14px;">הזן את מספר הבית</h6>

                                <input required type="text" id="cityText" name="city" dir="rtl" placeholder="עיר מגורים" /> 
                                <h6 id="empty-city-alert" style="color:red; display:none; font-size:14px;">הזן עיר מגורים</h6>
                                
                                <script>
                                    $( "#cityText" ).position({
                                      my: "right"
                                    });
                                </script>
                                
                                <input required type="text" id="phone" name="phone" maxlength="10" placeholder="מספר טלפון" />
                                <h6 id="empty-phone-alert" style="color:red; display:none; font-size:14px;">הזן מספר טלפון כדי שהמורים יוכלו ליצור עמכם קשר</h6>
                                <h6 id="invalid-phone-alert"  style="color:red; display:none; font-size:14px;">הזן מספר טלפון תקני ללא מקף</h6>

                                <input type="text" id="parent_phone" name="parent_phone" maxlength="10" placeholder="מספר טלפון של הורה" />
                                <h6 id="parentPhone-alert" style="color:red; display:none; font-size:14px;">על תלמידי כיתות א' - ו' חובה להזין מספר טלפון של הורה</h6>
                                <h6 id="empty-parent-alert"  style="color:red; display:none; font-size:14px;">הזן מספר טלפון תקני ללא מקף</h6>

                                <select required id="grade" name="grade">
                                <option value="" disabled selected >כיתה</option>
                                    <optgroup label="יסודי" selected>
                                        <option value="א">כיתה א</option>
                                        <option value="ב">כיתה ב</option>
                                        <option value="ג">כיתה ג</option>
                                        <option value="ד">כיתה ד</option>
                                        <option value="ה">כיתה ה</option>
                                        <option value="ו">כיתה ו</option>
                                    </optgroup>
                                    <optgroup label="חטיבת ביניים">
                                        <option value="ז">כיתה ז</option>
                                        <option value="ח">כיתה ח</option>
                                        <option value="ט">כיתה ט</option>
                                    </optgroup>
                                    <optgroup label="תיכון">      
                                        <option value="י">כיתה י</option>
                                        <option value="יא">כיתה יא</option>
                                        <option value="יב">כיתה יב</option>
                                    </optgroup>
                                </select>
                                <h6 id="empty-grade-alert" style="color:red; display:none; font-size:14px;">בחר כיתה</h6>
                                
                                <div id="img">
                                    <h5>בחר תמונת פרופיל:</h5>
                                        <div class="custom-file mb-3">
                                          <input type="file" class="custom-file-input" id="customFile" name="filename" accept=".jpg, .png, image/jpeg, image/png" />
                                          <label lang="he" class="custom-file-label" for="customFile" width=100>בחר תמונה</label>
                                        </div>
                                </div>
                      
                                <script>
                                // Add the following code so the name of the file appear on select
                                $(".custom-file-input").on("change", function() {
                                  var fileName = $(this).val().split("\\").pop();
                                  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                });
                                </script>
                                
                                <input type="submit" name="submit" class="next2 action-button" value="שלח!" />
                         </fieldset>
                     
                      <a href="homePageNew.php" id="homelink" class="home-link inactive underlineHover fadeIn fourth" style="margin:0; margin-bottom:10px;"> <i class="fa fa-home" style="color:#0d0d0d;"></i> חזרה לעמוד הבית</a>        
                      </form>
                    </div>
                </div>        
        </div>
</body>
</html>