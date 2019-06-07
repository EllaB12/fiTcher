<?php
     require_once('Includes/init.php');

     if (!$session->get_signed_in()){
         header('Location: newLogin.php');
         exit;
     }
 
     $user_id=$session->get_user_id();
     $user=new Student();
     $user->find_student_by_id($user_id);
     
     session_start();
     $_POST['idTeacher']= $user_id;
?>     

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">


  <title>fiTcher - Student</title>
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>
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
            <a class="nav-link" href="#lesson">קבע שיעור</a>
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
<body dir="rtl">
    <?php
    $Teacher= new Teacher();
    ?>
    <!-- MY PROFILE- show details about students -->
    <section id="myProfile" > 
    		   <div class="card container">
    		       <h1 style="text-align:center" >הפרופיל שלי</h1>
    		        <?php $img=$user->get_picture(); echo '<img alt="userPic" style="width:150px; border-radius: 50%;   margin-left: auto;
                    margin-right: auto; padding-bottom:30px;" <img src="'.$img.'"/>';?>
        		   <div class="content">
                   <p><B> שם משתמש: </B><?php  echo $user->get_fullName() ?> </p>
                   <p><B> דואר אלקטרוני:</B> <?php  echo $user->get_email(); ?> </p> 
                   <p><B> כיתה:</B> <?php  echo $user->get_class(); ?> </p>
                   <p><B> מספר הפלאפון שלי:</B> <?php  echo $user->get_phoneNumber(); ?> </p>
                  
    			   </div>
			   </div>
			   <div id="myTeachers"></div>
    </section> <br>
      
      
    <h2 align="center">המורים שלי:</h2>
    <?php include_once("Includes/database.php");
    $conn= new Database();
    $conn= $conn->get_connection();//connection 
    $sql= "Select teachers.fullName,teachers.fullName, teachers.picture, teachers.description, teachers.experience, teachers.phoneNumber From studentTeacher join teachers on studentTeacher.idTeacher=teachers.id Where studentTeacher.idStudent ='$user_id'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $i=0;
    while( ($record = mysqli_fetch_assoc($resultset)) && $i<3 ) {
    ?>
    <section align="right" dir="rtl">
        <div class="container1 col-md-6 col-md-offset-3 ">
	        <?php $img=$record['picture']; echo '<img alt="userPic" style="width:150px; border-radius: 50%;   margin-left: auto;
            margin-right: auto; " <img src="'.$img.'"/>';?>
            <p><span><B><?php echo $record['fullName']; ?></B></span> <?php echo $record['phoneNumber']; ?></p>
            <p><B><?php echo $record['experience']; ?></B><br>
            <?php echo $record['description']; ?>
            </p>
            </p>
            <?php
            //change to international num
            $from="972";
            $newNumber = preg_replace("/^0/", $from, $record['phoneNumber']);
            ?>
            <div class="col-lg-12" style="font-family: 'Varela Round', sans-serif;">
            <a href="https://wa.me/<?php echo $newNumber; ?>?text=היי,%20אני%20מעוניין%20לקבוע%20שיעור" class="float" target="_blank" style="    font-family: 'Varela Round', sans-serif;">
            <i class="fa fa-whatsapp style="font-size: 3em;" > </i> שלח הודעה </a>
            </div>
        </div>
    </section>
            <?php $i=$i+1;} ?>
         <!-- table: How much should pay -->

    <section class="container"  id="payment" align="center">
       <h2 id="studentH1"class="container"> כמה אני חייב?</h2>
        <table class="table table-striped" >
            <thead>
              <tr align="center">
                <th>תאריך שיעור</th>
                <th>שם מורה פרטי</th>
                <th>עלות השיעור</th>
                <th>לתשלום</th>
                <th>סטטוס תשלום</th>
                <th>
                  <input type="checkbox" id="checkAll">
                </th>
              </tr>
            </thead>
            <tbody>

            <?php

                require_once("function.php");
                  while($row  = mysqli_fetch_array($userObj)){ ?>
                  <tr align="center">
                    <td><?php
                    $teacher=new Teacher();
                    $id=$row['teacher_id'];
                    $teacher->find_teacher_by_id($id);
                    $paymentId= $row['paymentID'];
                    $dob=$row['date'];
                    $result=explode('-',$dob);
                    $date=$result[2];
                    $month=$result[1];
                    $year=$result[0];
                    $new=$date.'/'.$month.'/'.$year;
                    echo $new;
                    ?></td>
                    <td>  <?php echo $teacher->get_teacher_by_id($user_id,$id); ?></td>
                    <td><?php  echo $teacher->get_price_by_id($user_id,$id); ?></td>
                    <td>
                        <button name="<?php echo $row['id'] ?>" class="fa fa-paypal" onclick="openForm()" id="<?php echo $row['paymentID']; ?>"> pay Pal </button>
                    </td>
                    <td><?php 
                    if ($row['status']=='לא שולם'){
                        echo "<p style=\"color:red;font-weight: bold\">".$row['status']."</p>";
                        echo "<td></td>";
                        }
                    else {
                        echo "<p style=\"color:green;font-weight: bold\">".$row['status']."</p>";
                        echo '<td><input class="checkbox" type="checkbox" id="'.$row['paymentID'].'" name="id[]"></td>';
                    }
                    ?></td>
                  </tr>
                  
               <?php } ?>

            </tbody>
            
        </table><br/>      
        <button type="button" class="btn btn-danger" id="delete" style="background-color:#dc3545; width:20%;">מחק שיעורים ששולמו</button>
      <!-- script for Payment table -->
    <script>
    $(document).ready(function(){
        $('#checkAll').click(function(){
          if(this.checked){
              $('.checkbox').each(function(){
                  this.checked = true;
              });   
          }else{
              $('.checkbox').each(function(){
                  this.checked = false;
              });
          } 
        });


    $('#delete').click(function(){
       var dataArr  = new Array();
       if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('id'));
              $(this).closest('tr').remove();
          });
          sendResponse(dataArr)
       }else{
         <!--alert('אין שיעורים שלא שולמו, כנראה קיבלתם את כל הכסף :)');-->
         swal("אל תשכח לסמן את המפגש הרצוי", "ניתן למחוק רק פגישות ששולמו!", "info");
       }

    });  


    function sendResponse(dataArr){
        $.ajax({
            type    : 'post',
            url     : 'function.php',
            data    : {'data' : dataArr},
            success : function(response){
                        alert(response);
                      },
            error   : function(errResponse){
                      alert(errResponse);
                      }                     
        });
    }

  });
</script>
        <script>
        	$('button').click(function(){	
        	var id = $(this).attr("name");
        	var paymentId = $(this).attr("id");
        		$.ajax({
        			url:"delete.php",
        			method:"POST",
        			data: {
                		id: id,
                		paymentId: paymentId
                	},
        			success:function (data){
        				<!--alert(data);-->
        			}
        		});
        	});
        </script>
        
        
        <div class="form-popup" id="myForm">
         <!--- Pop up form to update students balance after the teacher collected cash ---> 
          <form action="paypal/first.php" class="form-container" method="post">
            <h3>תשלום באמצעות payPal</h3>
            <label><p> סכום לתשלום עבור שיעור</p> </label>
            <input value="<?php 
            $Teacher->get_price_by_id2($user_id); ?>" type="text" id="money" placeholder="כמה כסף קיבלת?" name="price" pattern="[0-9]+" title="הכנס בבקשה רק מספרים" required>
            <button type="submit" class="" id="submit" name="submit" style="width:60%;"> לתשלום</button>
            <div id="lessonID"></div>
            <button type="button" style="width:60%;background-color:red;" id="cancel" onclick="closeForm()">סגור חלון</button>
          </form>
        </div>
    </section>
    
    
    <script>
    function log_out(){
            window.location='logout.php';
    }
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    
    <section id="lesson">
    <div class="card container" >
    <h3 align="center">קביעת פגישה עם מורה</h3>
          <script>
            function teacherselected(){
              let tid = document.getElementById('teacher').value;
              $.ajax({
                  url: 'calendarAPI.php',
                  type:'POST',
                  async: false,
                  dataType: 'json',
                  data: "function=get&tid="+tid,
                  success: function(resp){
                    var select = document.getElementById("meeting");
                    var length = select.options.length;
                    for (i = 0; i < length; i++) {
                      select.options[i] = null;
                    }
                    if(resp.length == 0){
                      swal( "לא נמצאו פגישות עבור המורה הנבחר","אפשר לשלוח הודעת ווצאפ לבירור נוסף עם המורה" ,"warning");
                      document.getElementById("teacher").selectedIndex =0 ;
                    }else{
                      for(var i = 0; i<resp.length; i++){
                        let id = resp[i].id;
                        let txt = resp[i].date+" "+resp[i].stime+"-"+resp[i].etime;
                        var opt = document.createElement('option');
                        opt.value = id;
                        opt.innerHTML = txt;
                        select.appendChild(opt);
                      }
                    }
                  },
                  error: function(resp){
                    console.log(resp);
                  }
              });
            }
            function addmeeting(){
              let sid = '<?php echo $user_id; ?>';
              let mid = document.getElementById('meeting').value;
              $.ajax({
                  url: 'calendarAPI.php',
                  type:'POST',
                  async: false,
                  dataType: 'json',
                  data: "function=set&sid="+sid+"&mid="+mid,
                  success: function(resp){
                    if(resp.success){
                    alert ("הפגישה נקבעה בהצלחה");
                      location.reload();
                    }else{
                    alert ("יש תקלה :(", "אנא נסה שוב או שלח הודעת ווצאפ למורה לבירור");
                    }
                  },
                  error: function(resp){
                    console.log(resp);
                  }
              });
            }
          </script>



      <div class="content">
        <form action="" method="POST" onsubmit="addmeeting();return false">
            <div class="form-group">
                 <label> בחר מורה</label>
                 <select id="teacher" class="form-control" onchange="teacherselected()" required >
                      <option disabled selected value></option>
                 <?php
                    
                    $teachers = Teacher::get_of_student($user_id);
                    foreach($teachers as $teacher){
                      echo '<option value="'.$teacher->id.'">'.$teacher->fullName.'</option>';
                    } ?>
                 </select>
            </div>
            <div class="form-group">
                 <label> בחר תאריך ושעה</label>
                 <select id="meeting" class="form-control" required >
                 </select>
                </div>
            <div class="form-group">
                <button type="submit" id="submit" class="btn">קבע</button>
            </div>
        </form>
      </div>

    </section>      <br><br>
        <section class="container"  align="center">
       <h2 id="studentH1"class="container">השיעורים שלי</h2>
        <table class="table table-striped" >
            <thead>
              <tr align="center">
                <th>תאריך שיעור</th>
                <th>שעת התחלה</th>
                <th>שעת סיום</th>
                <th>שם מורה פרטי</th>
                <th>עלות השיעור</th>
              </tr>
            </thead>
            <tbody>

            <?php

                require_once("getLesson.php");
                  while($row  = mysqli_fetch_array($userObj)){ ?>
                  <tr align="center">
                    <td><?php
                    $teacher=new Teacher();
                    $id=$row['tid'];
                    $teacher->find_teacher_by_id($id);
                    echo $row['date'];
                    ?></td>
                    <td><?php echo $row['stime'];  ?></td>
                    <td><?php  echo $row['etime'];  ?></td>
                    <td>  <?php echo $teacher->get_teacher_by_id($user_id,$id); ?></td>
                    <td><?php  echo $teacher->get_price_by_id($user_id,$id); ?></td>

                  </tr>
                  
               <?php } ?>

            </tbody>
            
        </table><br/> 
    </section>
    
    
<!--==========================   Footer   ============================-->
  <!-- Footer -->
  <footer class="py-5 bg-dark" id="footer">
    <div class="container">
      <p class="m-0 text-center text-white">© fiTcher 2019 </p>
      <p class="m-0 text-center text-white">אלה ברזלב            |              נעם צינס              |              נוי רז</p>
      <p class="m-0 text-center text-white">fitcher@gmail.com </p>
    </div>
    <!-- /.container -->
  </footer>

</body>   


</html>
