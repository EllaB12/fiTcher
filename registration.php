<?php
    require_once('Includes/init.php');
    
    $idErr="";
    $id="";
    $fullName="";
    $fullNameErr="";
    $password="";
    $passwordErr="";
    $Repeat_password="";
    $Repeat_passwordErr="";
    $files="";
    $filesErr="";
    $street="";
    $streetErr="";
    $city="";
    $cityErr="";
    $grade="";
    $gradeErr="";
    $email="";
    $emailValidation="";
    $emailErr="";
    $pre_telephone="";
    $pre_telephoneErr="";
    $telephone="";
    $telephone_full="";
    $telephoneErr="";
    $pre_telephone_parent="";
    $pre_telephone_parentErr="";
    $telephone_parent="";
    $telephone_parent_full="";
    $telephone_parentErr="";
    $permission=1;
    
    if(isset($_POST['submit'])){

    	$student=new Student();
    	$student_with_password=new Password();
    	
    	$register_Students =null;
    	$register_Password =null;
    
	
	//id validation
//	if($_POST['id'])
//	{
//		$check1=$student->find_student_by_id($_POST['id']);
//		if((strlen($_POST['id']))!=9 )
//		{
//			$idErr="מספר תעודת זהות חייב להיות 9 ספרות, נסה שוב";
//			
//		}if($id == $check1){
//				$idErr="מספר תעודות זהות מופיע כבר במערכת, יכול להיות שנרשמת כבר ?";
//				
//		}
//		else{
//		    $id=$_POST['id'];
//		}
//	}
//	else {
//		$idErr="הזן מספר תעודת זהות";
//	}

    if($_POST['id'])
	{
	    $id=$_POST['id'];
	}
    
    //fullname validation
    
    if($_POST['fullName'])
	{
		$fullName=$_POST['fullName'];
	}
	else
	{
		$fullNameErr="הזן שם מלא";
	}
	
	//Password validation
	
	if($_POST['password'])
	{
		if(((strlen($_POST['password'] ))>5) && ((strlen($_POST['password'] ))<10)){
		    $password=$_POST['password'];
		}    
		else
			$passwordErr="הסיסמה שהזנת קצרה מדי, טיפ: סיסמה תקינה מכילה 6- 9 תוים";
		
	}
	if($_POST['Repeat_password'])
	{
		$Repeat_password=$_POST['Repeat_password'];
		if($password!=$Repeat_password)
		{
			$Repeat_passwordErr="אין התאמה בין 2 הסיסמאות שהזנת... הזן שוב..";
		}
	}
	else{
		$passwordErr="שכחת להזין סיסמה";
    }

    // image file validation
    if(isset($_POST["UploadImag"])) {
        $file=$_FILES['files'];
        
        $fileName=$_FILES['files']['name'];
        $fileTmpName=$_FILES['files']['tmp_name'];
        $fileSize=$_FILES['files']['size'];
        $fileError=$_FILES['files']['erroe'];
        $fileType=$_FILES['files']['type'];
        
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allow = array('jpg','jpeg','png');
        
        if (in_array($fileActualExt, $allow)){
            if($fileError===0){
                if($fileSize < 1000000){
                  // insert the image file after all the validation were Ok
                  $files=$_FILES['files'];
                }
                else 
                    $filesErr= " אופס! ההעלת קובץ גדול מדי ,נסה שוב";   
            }
            else 
                $filesErr= " אופס! היתה שגיאה בעת העלאת הקובץ ,נסה שוב";
        }
        else{
            $filesErr= " לא ניתן להעלות תמונות מסוג זה ,נסה שוב";
        }
    }  
        
    //street validation
    if($_POST['street'])
	{
		$street=$_POST['street'];
	}
	else{
		$streetErr="הזן רחוב ומספר בית";  
	}
	
	//city validation
    if($_POST['city'])
	{
		$city=$_POST['city'];
	}
	else{
		$cityErr="בחר עיר מגורים";  
	}
	
	//grade validation
    if($_POST['grade'])
	{
		$grade=$_POST['grade'];
	}
	else{
		$gradeErr="'הזן כיתת לימוד , ניתן להזין בטווח כיתות א'-יב";  
	}

    //email validation
    
    
  	  echo "<script> alert('Sorry... email  - ".$email." - already taken');window.location = 'signup.php'; 
	  </script>"; 
	  
    if($_POST['email']){
        $emailValidation=$student->check_email_validation($_POST['email']);
        if($emailValidation)
            $email=$_POST['email'];
        else
         $emailErr ="כתובת האיימיל שהזנת כבר קיימת אצלנו במערכת, נסה שוב" ;
    }else{
         $emailErr ="ש להזין אימייל" ;
    }
    
	//phone number validation pre+telephone
	if($_POST['pre_telephone'])
	{
	    if(strlen($_POST['pre_telephone'])==3)
	    {
	        $pre_telephone=$_POST['pre_telephone'];
	    }
	    else 
	    {
	        $pre_telephoneErr= "הזן קידומת למספר הטלפון";
	    }
	}
	
	if($_POST['telephone'])
	{
	    if(strlen($_POST['telephone'])==7)
	    {
	        $telephone=$_POST['telephone'];
	    }
	    else 
	    {
	        $telephoneErr= "מספר הטלפון שהזנת לא תקין, נסה שוב";
	    }
	}
 	
	if(($telephoneErr && $pre_telephoneErr)==null )
	{
	   $telephone_full=$pre_telephone.$telephone;
	}
	else{
	    $telephoneErr= "מספר הטלפון שהזנת לא תקין, נסה שוב";
	}

	//parent phone number validation pre+telephone
	if($_POST['pre_telephone_parent'])
	{
	    if(strlen($_POST['pre_telephone_parent'])==3)
	    {
	        $pre_telephone_parent=$_POST['pre_telephone_parent'];
	    }
	    else 
	    {
	        $pre_telephone_parentErr= "הזן קידומת למספר הטלפון";
	    }
	}
	
	if($_POST['telephone_parent'])
	{
	    if(strlen($_POST['telephone_parent'])==7)
	    {
	        $telephone_parent=$_POST['telephone_parent'];
	        
	    }
	    else 
	    {
	        $telephone_parentErr= "מספר הטלפון שהזנת לא תקין, נסה שוב";
	    }
	}
	if(($telephone_parentErr && $pre_telephone_parentErr)==null )
	{
	   $telephone_parentfull=$pre_telephone_parent.$telephone_parent;
	}
	else{
	        $telephone_parentErr= "מספר הטלפון שהזנת לא תקין, נסה שוב";
    }
	
	
    
	if(!($idErr || $fullNameErr || $passwordErr || $Repeat_passwordErr || $filesErr || $streetErr ||  $cityErr || $gradeErr || $emailErr|| $telephoneErr||$telephone_parentErr)){
	  
        $register_Students = $student->add_student($id,$fullName,$email,$telephone_full,$telephone_parentfull,$city,$street,$files,$grade);
        $register_Password=$user_with_password->add_password($id,$fullName,$password,$permission);
        
       echo '<script> alert("ההרשמה בוצעה בהצלחה!")</script>';} 
   else{
        echo $id." ".$fullName." ".$email." ".$telephone_full." ".$telephone_parentfull." ".$city." ".$street." ".$files." ".$grade." ".$Repeat_passwordErr;
   }
  //  echo $idErr." ".$fullNameErr." ".$emailErr." ".$telephone_fullErr." ".$telephone_parentfullErr." ".$cityErr." ".$streetErr." ".$filesErr." ".$gradeErr;
    
		
}
	
?>

<!DOCTYPE html>
<html>
	<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!--- Jquery --->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
           
             <!--- Google fonts --->
            <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew" rel="stylesheet">
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <script>
                    $('#dbType').on('change',function(){
                    var selection = $(this).val();
                    switch(selection){
                    case "other":
                    $("#otherType").show()
                    break;
                    default:
                    $("#otherType").hide()
                    }
                 });
            
            </script>
            
            <!--- CSS --->
            <link rel="stylesheet" type="text/css" href="CSS/registration.css">

             <!--- JavaScript --->
             <script src="JS/cityautocomplete.js"></script>
             <script type="text/javascript">
                $(function(){
                    $('#field_pre_telephone,#field_telephone').keyup(function(e){
                        if($(this).val().length==$(this).attr('maxlength'))
                            $(this).next(':input').focus()
                    })
                })
             </script>
            
             <script type="text/javascript">
                $(document).ready(function () {
                toggleFields(); 
                $("#type").change(function () {
                    toggleFields();
                });
            
            });

            function toggleFields() {
                if ($("#type").val() === "7st grade" || $("#type").val() === "8st grade" ||  $("#type").val() === "Freshman/9th grade")
                    $("#other").show();
                else
                    $("#other").hide();
            }
             </script>
             
             <script>
                function checkStudentId(str) {
                    if (str == "") {
                        document.getElementById("id").innerHTML = "";
                        return;
                    } else { 
                        if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                              
                                document.getElementById("id").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET","valid.php?q="+str,true);
                        xmlhttp.send();
                    }
                }
                
                function stringlength(inputtxt)
                { 
                    var field = inputtxt.value; 
                    var mnlen = 6;
                    var mxlen = 9;
                    
                    if(field.length<mnlen)
                    { 
                        alert("יכול להיות שהתבלבלת? סיסמה תקינה היא באורך של 6 - 9 תווים");
                        return false;
                    }
                    else
                    { 
                        alert('הסיסמה שהכנסת אושרה!');
                        return true;
                    }
                }

                </script>
             
             <!--- Google fonts --->
             <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

			<title>הרשמה לתלמיד</title>
	</head>
	
	<body>
			<header>
				
			</header>
		
			<main>
                        <form dir="rtl" autocomplete="off" method ="post" action="registration.php" name="form">
                        <h2>הרשמה לתלמיד</h2>  
                        <fieldset>
                            <legend><span class="section">1</span>הפרטיים האישיים שלך</legend> 
                            <div>
                                <label for="id">מספר זהות</label>
                                <input maxlenghth="9" type="text" name='id' onkeyup="checkStudentId(this.value)" requierd ><span class="error"><?Php echo $idErr; ?></span>
                            </div>

                            <div> 
                                <label for="fullName">שם מלא </label>
                                <input type="text" name='fullName' requierd ><span class="error"><?Php echo $fullnameErr; ?></span>
                            </div>
                            
                            <div>
                                <label for="password">סיסמה</label><p> סיסמה תקינה מכילה בין 6-9 תווים</p>
                                <input type="password" name='password' requierd ><span class="error"><?Php echo $passwordErr; ?></span>
                            
                            </div>
                            <div>
                                <label for="Repeat_password">חזור על הסיסמה</label>
                                <input maxlenghth="6" type="password" name='Repeat_password' requierd ><span class="error"><?Php echo $Repeat_passwordErr; ?></span>
                                
                            </div>

                            <div>
                                    <p>הוסף תמונת פרופיל</p>
                                    <label for="file-upload" class="custom-file-upload">
    
                                    <input id="file-upload" type="file" name='files' accept=".jpg, .png, image/jpeg, image/png" multiple> <i><img src="Images/attachment.png" height="20" width="20"></i>
                                    <span id="custom-text" >jpg, png, jpeg ניתן להעלות תמונה מסוג קובץ </span>
                                    <span class="error"> <?Php echo $filesErr; ?> </span>
                                    <button type="button" name='UploadImage' id="Upload" for="file-upload" class="custom-file-upload"> Upload</button>
                                    
                                    <script type="text/javascript">
                                    
                                        const RealFileButton = document.getElementById("file-upload");
                                        const Uploadbutton = document.getElementById("Upload");
                                        const ButtonTxt = document.getElementById("custom-text");
                                        
                                        RealFileButton.addEventListener("click", function()){
                                            Uploadbutton.click();
                                        });
                                        
                                        
                                        Uploadbutton.addEventListener("change", function()){
                                            if(RealFileButton.value){
                                                ButtonTxt.innerHTML = RealFileButton.value;
                                            }else{
                                                ButtonTxt.innerHTML = "נא להעלות תמונה ";
                                            }
                                        });
                                    
                                    </script>
                                    </label>
                            </div>

                            <div class="street">
                                <label for="street">רחוב ומספר בית</label>
                                <input type="text" name='street' requierd ><span class="error"> <?Php echo $streetErr; ?> </span>
                            </div>

                            <div>
                                <label for="city">עיר מגורים</label>
                                <input type='text' name='city' id='cityText' requierd><span class="error"> <?Php echo $streetErr; ?> </span>
                                <div id='autoComplete'></div>
                            </div>

                            <div>
                                    <label for="grade">כיתה</label>
                                    <select name='grade' id="type" requierd><span class="error"> <?Php echo $gradeErr; ?> </span>
                                       
                                        <optgroup label="יסודי" selected>
                                            <option value="1st grade">כיתה א</option>
                                            <option value="2st grade">כיתה ב</option>
                                            <option value="3st grade">כיתה ג</option>
                                            <option value="4st grade">כיתה ד</option>
                                            <option value="5st grade">כיתה ה</option>
                                            <option value="6st grade">כיתה ו</option>
                                        </optgroup>
                                        <optgroup label="חטיבת ביניים">
                                            <option value="7st grade">כיתה ז</option>
                                            <option value="8st grade">כיתה ח</option>
                                            <option value="Freshman/9th grade">כיתה ט</option>
                                        </optgroup>
                                        <optgroup label="תיכון">      
                                            <option value="Sophomore/10th grade">כיתה י</option>
                                            <option value="Junior/11th grade">כיתה יא</option>
                                            <option value="Senior/12th grade">כיתה יב</option>
                                        </optgroup>
                                   
                                    </select>
                                </div>
    
                                <div id="other">
                                        <label for="city">הקבצת לימוד</label>
                                        <select name='study_group' requierd>
                                            <option value="group1">הקבצה א</option>
                                            <option value="group2">הקבצה ב</option>
                                            <option value="group3">הקבצה ג</option>
                                        </select>
                                </div>
                        </fieldset>
 

                        <fieldset>
                            <legend><span class="section">2</span>פרטי יצירת קשר</legend> 
                            <div>
                                <label for="email">דואר אלקטרוני</label>
                                <input type="email" name='email' requierd ><span class="error"><?Php echo $emailErr ?> </span>
                            </div>
                                
                            <div>
                            <div class="phoneNumber">
                                <label for="field_telephone">מספר טלפון נייד</label></br>
                                <input type="text" maxlength="3" name="pre_telephone" id="field_pre_telephone" requierd ><span class="error"><?Php echo $pre_telephoneErr ?></span>
                                <input type="text" maxlength="7" name="telephone" id="field_telephone" requierd ><span class="error"><?Php echo $pre_telephoneErr ?></span>
                            </div>
    
                            <div>
                                <label for="field_telephone">מספר טלפון נייד של הורה</label></br>
                                <input type="text" maxlength="3" name="pre_telephone_parent" id="field_pre_telephone" requierd ><span class="error"><?Php echo $pre_telephone_parentErr ?></span>
                                <input type="text" maxlength="7" name="telephone_parent" id="field_telephone" requierd ><span class="error"><?Php echo $telephone_parentErr ?></span>
                            </div>

                        </fieldset>

                         <p><input type="submit" value="הרשם" name='submit' onclick="stringlength(document.form.password)"></p>
                        </form>
	</body>
</html>
