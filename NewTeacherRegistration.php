<!--php-->
<?php

require_once('Includes/init.php');

$fullName = $_POST["fullName"];
$phone = $_POST["phone"];
$city = $_POST["city"];
$street = $_POST["street"];
$experience = $_POST["experience"];
$description = $_POST["description"];
$price = $_POST["price"];
$cutPrice = $_POST["cutPrice"];
$gender = $_POST["gender"];
$password = $_POST["password"];
$permission="2";

$id ="";
$email = "";

$idErr="";
$emailErr="";

if(isset($_POST['submit'])){
    
    $teacher=new Teacher();
    $teacher_with_password=new Password();
    	
    $register_teacher =null;
    $register_Password =null;
    
	  
    $emailValidation=$teacher->check_email_validation($_POST['email']);
    if($emailValidation){
        $emailErr = 'כתובת הדוא"ל שהזנת כבר קיימת';
    }
    else
        $email=$_POST['email'];
          
          
    $idValidation=$teacher->check_id_validation($_POST['id']);
    if($idValidation){
        $idErr = 'מספר תעודת הזהות כבר קיים';
    }
    else
        $id=$_POST['id'];
   
    
    if($idErr){
        echo '<script> alert("מספר תעודת הזהות שהזנת כבר קיים במערכת. אולי נרשמת בעבר?!")</script>';
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
             $target_file = "Images/teaching.png";
        }
        
		if (!move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) 
            {
            echo "Sorry, there was an error uploading your file.";
            echo "<br>".$_FILES['filename']['error'];
            }
            
        $register_teacher = $teacher->add_teacher($id,$fullName,$email,$phone,$city,$street,$target_file,$experience,$description,$price,$cutPrice,$gender);
        $register_Password=$teacher_with_password->add_password($id,$fullName,md5($password),$permission);
        
        $number = count($_POST["name"]);  
          
          if($number > 0)  
             {  
                  for($i=0; $i<$number; $i++)  
                  {  
                       if(trim($_POST["name"][$i] != ''))  
                       {  
                            $name = $_POST["name"][$i];
                            
                            $subject = new Subject();
                            $subject->find_subject_by_name($name);  
                            
                            $subjectId = $subject->get_id();
                            $educationGroup = $_POST["grade"][$i];
                            
                            $qualification = new Qualification();
                            $qualification->add_qualification($id,$subjectId,$educationGroup);
                       }  
                  }  
                //   echo "Data Inserted";  
            }  
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>הרשמה למורה</title>

    <!--CSS-->
    <link rel="stylesheet" href="CSS/registerTeacher.css">

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
     <!--Java Script-->
    <script src="JS/registerTeacher.js"></script>
    <script src="JS/subjectautocomplete.js"></script>
    <script src="JS/cityautocomplete.js"></script>
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

</head>
<body dir="rtl">
        <div class="wrapper fadeInDown">
                <div id="formContent">
                  <a href="NewTeacherRegistration.php" class="login-link inactive underlineHover" id="login-link">הרשמה למורה</a>
                
                  <!-- Login Form -->
                    <div class="content">
                      <!-- Icon -->
                      <div class="fadeIn first">
                          <img src="Images/teaching.png" id="icon" alt="User Icon"/>
                      </div>

                      <form  method="post" id="login-form" name="RegForm" enctype="multipart/form-data">
                         <!-- progressbar -->
                         <ul dir="rtl" id="progressbar">
                                <li class="active">יצירת חשבון</li>  
                                <li>אישי</li> 
                                <li>מקצועי </li> 
                                <li>סיום!</li>
                        </ul>

                        <!-- fieldsets 1-->
                        <fieldset>
                                <input required type="text" id="ID" name="id" maxlength="9" placeholder="תעודת זהות" />
                                <h6 id="empty-id-alert" style="color:red; display:none; font-size:14px;">הזן תעודת זהות</h6>
                                <h6 id="invalid-id-alert" style="color:red; display:none; font-size:14px;">תעודת זהות תקינה מכילה 9 ספרות</h6>

                                <input required type="text" name="email" placeholder="דואר אלקטרוני" />
                                <h6 id="empty-email-alert" style="color:red; display:none; font-size:14px;padding:none;">הזן כתובת דואר אלקטרוני</h6>
                                <h6 id="invalid-email-alert" style="color:red; display:none; font-size:14px;padding:none;">כתובת הדוא"ל שהזנת אינה חוקית</h6>

                                <input required id="userPass" type="password" name="password" placeholder="סיסמה" minlength="6" maxlength="12">
                                <input required id="confirm_pass" type="password" name="cpass" placeholder="אימות סיסמה" minlength="6" maxlength="12">
                                <h6 id="pw-msg" style="color:red; display:none; font-size:14px;">הסיסמה חייבת להכיל 12-6 ספרות ותווים</h6>
                                <h6 id="pw-equal" style="color:red; display:none; font-size:14px;">הסיסמאות אינן זהות</h6>
                                
                                <input type="button" name="next" class="next action-button" value="המשך לשלב הבא" /></br>
                                <a href="homePageNew.php" class="home-link inactive underlineHover" style="margin:0; margin-bottom:10px;color:black;"> <i class="fa fa-home"></i> חזרה לעמוד הבית</a>  
                        </fieldset>
                      

                        
                         <!-- fieldsets 2-->
                         <fieldset>
                                <div id="gender">
                                    <h5>מגדר:</h5>
                						<label class="gender" >
                						    <i class="fa fa-male" style="font-size:36px;color:#00A5C6"></i>
                							<input checked type="radio" name='gender' value='זכר'> זכר 
                						</label>
                						<label class="gender">
                							<i class="fa fa-female" style="font-size:34px;color:#00A5C6"></i>
                							<input type="radio" name='gender' value='נקבה'> נקבה 
                						</label>
                                </div>
                        
                                             
                                <div id="img">
                                    <h5>בחר תמונת פרופיל:</h5>
                                        <div class="custom-file mb-3">
                                          <input type="file" class="custom-file-input" id="customFile" name="filename" accept=".jpg, .png, image/jpeg, image/png">
                                          <label lang="he" class="custom-file-label" for="customFile" width=100>בחר תמונה</label>
                                        </div>
                                </div>
                      
                                <script>
                                // Add the following code so the file will appear on select
                                $(".custom-file-input").on("change", function() {
                                  var fileName = $(this).val().split("\\").pop();
                                  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                });
                                </script>
                				
                				<input required type="text" id="fullName" name="fullName" placeholder="שם מלא" /> 
                                <h6 id="empty-fullName-alert" style="color:red; display:none; font-size:14px;">הזן שם מלא</h6>
                                <h6 id="invalid-fullName-alert" style="color:red; display:none; font-size:14px;">הזן שם מלא בצורה תקינה</h6>
                                
                                <input required type="text" id="street" name="street" placeholder="רחוב ומספר בית" /> 
                                <h6 id="empty-street-alert" style="color:red; display:none; font-size:14px;">הזן רחוב ומספר בית</h6>
                                <h6 id="invalid-street-alert" style="color:red; display:none; font-size:14px;">הזן את שם הרחוב ומספר הבית</h6>
                                <h6 id="invalid-numStreet-alert" style="color:red; display:none; font-size:14px;">הזן את מספר הבית</h6>

                                <input required type="text" id="cityText" name="city" placeholder="עיר מגורים" /> 
                                <h6 id="empty-city-alert" style="color:red; display:none; font-size:14px;">הזן עיר מגורים</h6>

                                <input required type="text" id="phone" name="phone" maxlength="10" placeholder="מספר טלפון" />
                                <h6 id="empty-phone-alert" style="color:red; display:none; font-size:14px;">הזן מספר טלפון כדי שהתלמידים יוכלו ליצור עמכם קשר</h6>
                                <h6 id="invalid-phone-alert"  style="color:red; display:none; font-size:14px;">הזן מספר טלפון תקני ללא מקף</h6>
                                
                                <input type="button" name="next2" class="next2" value="המשך לשלב הבא" /></br>
                                 <a href="homePageNew.php" class="home-link inactive underlineHover" style="margin:0; margin-bottom:10px;color:black;"> <i class="fa fa-home"></i> חזרה לעמוד הבית</a>  
                         </fieldset>
                         
                         
                          <!-- fieldsets 3-->
                         <fieldset>
                              <label for="experience" class="experience">ניסיון:</label>
                              <textarea name="experience" rows="5" cols="5" placeholder="מה אני יודע?"></textarea>
                                
                                <label for="description" class="description">תאור:</label>
                                <textarea name="description" rows="5" cols="5" placeholder="מה יש לי להציע?"></textarea>
                                
                                <label for="subject">מקצועות לימוד:</label>
                                <div class="appending_div">
                                      <table class="table" id="dynamic_field">  
                                          <tr>  
                                            <td><input type="text" name="name[]" placeholder="מקצוע לימוד" class= "subjectText" required /></td>
                                            <td> 
                                                <select name="grade[]" >
                                                     <option value="" disabled selected >רמה</option>
                                                     <option value="יסודי">יסודי</option>
                                                     <option value="חטיבה">חטיבה</option>
                                                     <option value="תיכון 2 יחידות">תיכון 2 יח"ל</option>
                                                     <option value="תיכון 3 יחידות">תיכון 3 יח"ל</option>
                                                     <option value="תיכון 4 יחידות">תיכון 4 יח"ל</option>
                                                     <option value="תיכון 5 יחידות">תיכון 5 יח"ל</option>
                                                 </select>
                                            </td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success">הוסף</button></td>  
                                          </tr>  
                                      </table>
                                <h6 id="empty-subject-alert" style="color:red; display:none; font-size:14px;">הזן מקצוע לימוד</h6>
                                </div>
                                
                                <input type="text" id="price" name="price" placeholder="מחיר עבור שיעור יחיד" />
                                
                                 <input type="text" id="cutPrice" name="cutPrice" placeholder="מחיר עבור שיעור כפול" />
                                 
                                 <input type="submit" id="submit" name="submit" class="next3 action-button" value="שלח!" /></br>
                                 <a href="homePageNew.php" id="homelink" class="home-link inactive underlineHover fadeIn fourth" style="margin:0; margin-bottom:10px;"> <i class="fa fa-home" style="color:#0d0d0d;"></i> חזרה לעמוד הבית</a>
                         </fieldest>
                    
                      </form>
                    </div>
                </div>        
        </div>
</body>
</html>