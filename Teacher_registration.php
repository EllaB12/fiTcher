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
    $experience="";
    $experienceErr="";
    $email="";
    $emailErr="";
    $price="";
    $priceErr="";
    $cutPrice="";
    $cutPriceErr="";
    $pre_telephone="";
    $pre_telephoneErr="";
    $telephone="";
    $telephone_full="";
    $telephoneErr="";
    $permission=2;
    
    if(isset($_POST['submit'])){

    	$Teacher=new Teacher();
    	$teacher_with_password=new Password();
    	
    	$register_Teachers =null;
    	$register_Password =null;
    
	
	//id validation
//	if($_POST['id'])
//	{
//		$check1=$teacher->find_teacher_by_id($_POST['id']);
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
		if((strlen($_POST['password'] ))==6){
		    $password=$_POST['password'];
		    echo $password;
		}    
		else
			$passwordErr="הסיסמה שהזנת קצרה מדי, טיפ:סיסמה תקינה מכילה 6 תוים";
		
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
    if(empty($_POST['street']))
	{
		$streetErr="הזן רחוב ומספר בית";  
	}
	else{
	    $street=$_POST['street'];
	}
	
	//city validation
    if($_POST['city'])
	{
		$city=$_POST['city'];
	}
	else{
		$cityErr="בחר עיר מגורים";  
	}
	
	//experience validation
    if($_POST['experience'])
	{
		$experience=$_POST['experience'];
	}
	else{
		$experienceErr="הזן את הניסון המקצועי שלך";  
	}

    if(empty($_POST['email'])){
        $emailErr="יש להזין כתובת אימייל";
    }
    else{
        $email=$_POST['email'];
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

	
	

	
	
    
	if(!($idErr || $fullNameErr || $passwordErr || $Repeat_passwordErr || $filesErr || $streetErr ||  $cityErr || $experienceErr || $emailErr|| $telephoneErr)){
	  
        $register_Teachers = $teacher->add_teacher($id,$fullName,$email,$telephone_full,$city,$street,$files,$experience,$video,$price,$cutPrice);
        $register_Password=$user_with_password->add_password($id,$fullName,md5($password),$permission);
        
       echo '<script> alert("ההרשמה בוצעה בהצלחה!")</script>';} 
   else{
        echo $id." ".$fullName." ".$email." ".$telephone_full." ".$city." ".$street." ".$files." ".$experience." ".$Repeat_passwordErr;
   }
  //  echo $idErr." ".$fullNameErr." ".$emailErr." ".$telephone_fullErr." ".$cityErr." ".$streetErr." ".$filesErr." ".$experienceErr;
    
		
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

            
            
             </script>
             
             <script>
                function checkTeacherId(str) {
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

			<title>הרשמה למורה</title>
	</head>
	
	<body>
			<header>
				
			</header>
		
			<main>
                        <form dir="rtl" autocomplete="off" method ="post" action="Teacher_registration.php" name="form">
                        <h2>הרשמה למורה</h2>  
                        <fieldset>
                            <legend><span class="section">1</span>הפרטיים האישיים שלך</legend> 
                            <div>
                                <label for="id">מספר זהות</label>
                                <input maxlenghth="9" type="text" name='id' onkeyup="checkTeacherId(this.value)" requierd ><span class="error"><?Php echo $idErr; ?></span>
                            </div>

                            <div> 
                                <label for="fullName">שם מלא </label>
                                <input type="text" name='fullName' requierd ><span class="error"><?Php echo $fullnameErr; ?></span>
                            </div>
                            
                            <div>
                                <label for="password">סיסמה</label>
                                </br><span id="custom-text" > סיסמה תקינה מכילה בין 6-9 תווים </span>
                                <input type="password" name='password' requierd ><span class="error"><?Php echo $passwordErr; ?></span>
                            
                            </div>
                            <div>
                                <label for="password">חזור על הסיסמה</label>
                                <input maxlenghth="6" type="password" name='Repeat_password' requierd ><span class="error"><?Php echo $Repeat_passwordErr; ?></span>
                                
                            </div>
                            <div>
                                    <p>הוסף תמונת פרופיל</p>
                                    <label for="file-upload" class="custom-file-upload">
    
                                    <input id="file-upload" type="file" name='files' accept=".jpg, .png, image/jpeg, image/png" multiple> <i><img src="Images/attachment.png" height="20" width="20"></i>
                                    <span id="custom-text" > ניתן להעלות תמונה מסוג קובץ jpg, png, jpeg </span>
                                    <span class="error"> <?Php echo $filesErr; ?> </span>
                                  <!---<button type="button" name='UploadImage' id="Upload" for="file-upload" class="custom-file-upload"> Upload</button>
                                    
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
                                    
                                    </script> --->
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
                            
                        <fieldset>
                             <legend><span class="section">2</span>רקע מקצועי</legend>
                               <textarea rows="4" cols="50" name='experience' placeholder="ספר קצת על עצמך.." ></textarea><span class="error"> <?Php echo $experienceErr; ?> </span>
                        </fieldset>
 

                        <fieldset>
                            <legend><span class="section">3</span>פרטי יצירת קשר</legend> 
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

                        </fieldset>
                        
                        <fieldset>
                            <legend><span class="section">4</span>מחיר השיעור</legend> 
                            <div>
                                <label for="price">מחיר לשיעור יחיד</label>
                                <input type="text" name='price' requierd ><span class="error"><?Php echo $priceErr ?> </span>
                            </div>
                                
                            <div>
                            <div class="cutPrice">
                                <label for="cutPrice">מחיר מוזל</label></br>
                                <input type="text" name='cutPrice' requierd ><span class="error"><?Php echo $cutPriceErr ?> </span>
                            </div>

                        </fieldset>

                         <p><input type="submit" value="הרשם" name='submit' onclick="stringlength(document.form.password)"></p>
                        </form>
	</body>
</html>
