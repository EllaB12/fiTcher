
 <?php
    require_once('Includes/init.php');

    if (!$session->get_signed_in()){
        header('Location: newLogin.php');
        exit;
    }
 
    $user_id=$session->get_user_id();
    $user = Teacher::find_teacher_by_id($user_id);
   
 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Fitcher-Teacher</title>
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
    <!-- Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Favicons -->
  <link href="Images/favicon.png" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <!-- Libraries CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="CSS/modern-business.css" rel="stylesheet">
  <link href="CSS/homePage.css" rel="stylesheet">
  <link href="CSS/indexTeacher.css" rel="stylesheet">
  <!-- Sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!--JS grid-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <!-- Load icon library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
  <style>
  
  #calendar_iframe{
    width:100%;
    height:100vh;
  }
  .text{
        text-align: center;

    }
    body{
        font-family: 'Varela Round', sans-serif;
        text-align: right;
    }
    #money{
        margin:30px;
    }
    #change{
        font-size:14px;
    }
    .container1 {
      border: 2px solid #ccc;
      background-color: #eee;
      border-radius: 5px;
      padding: 16px;
      margin: 16px 0
    }
    
    
    .container1::after {
      content: "";
      clear: both;
      display: table;
    }
    
    .container1 img {
      float: left;
      margin-right: 20px;
      border-radius: 50%;
    }
    
    .container1 span {
      font-size: 20px;
      margin-right: 15px;
    }
    
    @media (max-width: 500px) {
      .container1 {
          text-align: center;
      }
      .container1 img {
          margin: auto;
          float: none;
          display: block;
      }
    }
    /*popup*/

    * {box-sizing: border-box;}
    
    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
      background-color: #00A5C6;
      border: none;
      color: white;
      padding: 10px;
      text-align: center;
      text-decoration: none;
      display: inline;
      text-transform: uppercase;
      font-family:'Varela Round', sans-serif;
      font-size: 15px;
      -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
      box-shadow: 0 10px 30px 0 rgba(95, 187, 233, 0.26);
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;
      margin: 5px 20px 5px 20px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -ms-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
       cursor: pointer;
    }
    .open-button:hover{
      opacity:0.6;
      text-decoration: none;
    }
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: fixed;
      top: 100px;
      right: 40%;
      border: 3px solid #f1f1f1;
      z-index: 9;
    }
    
    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }
    
    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }
    
    /* Add a red background color to the cancel button */
    .form-container #cancel {
      background-color: red;
    }
    .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width:25%;
      margin: auto;
      margin-top:50px;
      margin-bottom:50px;
    }
    
    @media (max-width: 767px) {
      .card {
        width: 90%;
      }
    
    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .content {
      padding: 2px 16px;
    }
    
</style>-->
</head>

<!--========================== Header ============================-->
<header dir="ltr">
      <!--========================== Header ============================-->
    <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
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
            <a class="nav-link" href="#footer">צור קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#payment">תשלום</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myStudents.php">התלמידים שלי</a>
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
    require_once("Includes/init.php");
    ?>
    <!-- MY PROFILE- show details about teacher -->
    <section id="myProfile" > 
	    <div class="card container">
	       <h1 align:"left" >הפרופיל שלי</h1>
	        <?php echo '<img alt="Avatar" style="width:150px; border-radius: 50%;   margin-left: auto;
            margin-right: auto; padding-bottom:30px;" src="data:image/jpeg;base64,'.base64_encode($user->get_picture() ).'"/>';?>
		   <div class="content">
           <p><B> שם משתמש: </B><?php  echo $user->get_fullName() ?> </p>
           <p><B> דואר אלקטרוני:</B> <?php  echo $user->get_email(); ?> </p> 
           <p><B> ניסיון:</B> <?php  echo $user->get_experience(); ?> </p>
           <p><B> מספר פלאפון:</B> <?php  echo $user->get_phoneNumber(); ?> </p>
		   </div>
	    </div>
    </section>  
     <!-- Show all the lessons thats teacher need to collect money from her students ---> 
    <section class="container"  id="payment" align="center">
        <h2 id="teacherH1" class="container" style="font-size:50px;"> כמה מגיע לי?  </h2>
             <!--<img src="Images/newIndexTeacher.png" alt="" class="img-fluid " width="250" height="300"></a>---> 
       <!-- </br><p align="right">ניתן לעדכן תשלום במזומן עבור שיעור באמצעות לחיצה על כפתור מזומן</p>            
        ---><table class="table table-striped text">
            <thead>
                <tr class="text">
                    <th>תאריך שיעור</th>
                    <th>שם תלמיד</th> 
                    <th>עלות השיעור</th>
                    <th>יתרה כספית</th>
                    <!--<th>סטטוס</th>-->
                    <th>לתשלום</th>
                    <!--<th><input type="checkbox" id="checkAll"></th>-->
                </tr>
            </thead>
            <tbody>
              <?php
              require_once("function2.php");
                while($row  = mysqli_fetch_array($userObj) ){ ?>
                    <tr align="center">
                      <td><?php 
                	  session_start();
                      $_SESSION['paymentID'] = $row['paymentID'];
                      $id = $row['id'];
                      $dob=$row['date'];
                      $result=explode('-',$dob);
                      $date=$result[2];
                      $month=$result[1];
                      $year=$result[0];
                      $new=$date.'/'.$month.'/'.$year;
                      echo $new
                      ?></td>
                      <td><?php  echo $row['fullName'] ?></td>
                      <td><?php  echo $user->get_price() ?></td>
                      <td><?php  echo $row['balance'] ?></td>
                      <!--<td>  <?php //echo $row['status'] ?></td>-->
                      <td><button data-id="<?php echo $row['id'] ?>" name="<?php echo $row['id'] ?>" id="<?php echo $row['id'] ?>" class="open-button clickme" onclick="openForm()">מזומן </button></td>
                      
                    </tr>
                <?php } ?>
                
                
        <script>
              $('.clickme').click(function (e) {
                 id = $(this).attr('data-id');
                 document.getElementById('noy').value = id;
                //  $.ajax({
                //   type: 'POST',
                //   url: 'updateBalanceBefore.php',
                //   data: {id:id},
                //   success: function(msg){ 
                //   }
                //  });
              }); 
            
        </script>
        
         <script>
         $('button').click(function(){
             localStorage.setItem('xxx',$(this).attr("id"));
         });
         
        //  function kaki(){
        //     alert("check kaki"); 
        //  }
         
    //  	$('#kaki2').click(function(){
    //     	var id = localStorage.getItem('xxx');
    //     	alert("id: " + id);
    //     	$('#noy').text(id);
    //     	var cash = $('#money').val();
    //     	console.log(id);
    // 	    document.getElementById("noy").innerHTML= id;
    //     		$.ajax({
    //     			url:"updateBalance.php",
    //     			method:"POST",
    //     			data: {
    //             		id: id,
    //             		cash:cash
    //             		},
    //             		async: true,
    //     			    success:function (data){
    //     				alert(data);
    //     			    },
    //     		});
    //     });

        </script>
            </tbody>
        </table><br/>
        
        <?php 
             $num=$user->get_price();
             $price=intval($num);
             
        ?>
        <script>
        
        function checkChange(){
            var xprice=<?php echo $price ?>;
            var xmoney= document.getElementById("money").value;
            var xchange=0;
            var res="";
            
            if(xmoney>xprice){
                xchange=xmoney-xprice;
                res= "עליך להחזיר "+xchange + " שקלים";
            }
            else{
                xchange=0;
                res= "אין צורך להחזיר עודף במקרה זה";
            }
            
            document.getElementById("change").innerHTML=res;
        }
        
        </script>    

    
        <div class="form-popup" id="myForm">
         <!-- Pop up form to update students balance after the teacher collected cash --->                    
          <form action="updateBalance.php" method="post" class="form-container">
            <h2>הזנת כסף במזומן</h2>
            
            <input type="hidden" id="noy" name="idstudent"  readonly="readonly">
            
            <label><b>הזן את הסכום ששולם לך במזומן</b></label>
            <input type="text" id="money"  style="width:85%;" placeholder="כמה כסף קיבלת?" name="cash" pattern="[0-9]+" title="הכנס בבקשה רק מספרים" required>
            
            </br><button  style="width:85%;" type="button" class="btn btn-success" onclick="checkChange()">כמה עודף עלי להחזיר? </button>
            </br><div id="change"></br></div>
            <!--</br><div id="noy" name="noy"></br></div>-->
            <button style="width:85%;background-color: #efd809;margin-bottom: 15px !important;" name="submit" class="btn btn-success">עדכן יתרת תלמיד</button>
            <button style="width:85%;" class="btn btn-cancel" id="cancel" onclick="closeForm()">סגור חלון</button>
          </form>
        </div>
    </section>
    
    <section>
    <div class="card container">
    <h1 align:"left" >הוספת פגישה</h1>
          <script>
            function addmeeting(){
              let date = document.getElementById('date').value;
              date = date.split('-')[2]+'-'+date.split('-')[1]+'-'+date.split('-')[0];
              let stime = document.getElementById('stime').value;
              let etime = document.getElementById('etime').value;
              let tid = '<?php echo $user_id; ?>';
              $.ajax({
                url: 'calendarAPI.php',
                type:'POST',
                async: false,
                dataType: 'json',
                data: "function=add&date="+date+"&stime="+stime+"&etime="+etime+"&tid="+tid,
                success: function(resp){
                  if(resp.success){
                    alert('פגישה נוספה בהצלחה ועודכנה בלוח השנה');
                    document.getElementById('calendar_iframe').contentWindow.location.reload();
                  }else{
                    alert('שגיאה בהוספת פגישה');
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
                תאריך: <input type="date" id="date" class="form-control" required />
                </div>
            <div class="form-group">
                זמן התחלה: <input type="time" id="stime" class="form-control" required />
                </div>
            <div class="form-group">
                זמן סיום: <input type="time" id="etime" class="form-control" required />
                </div>
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-primary">הוסף</button>
                </div>
              </form>
            </div>
    </section>
    
    <iframe src="calendar.php" id="calendar_iframe" frameBorder="0"></iframe>
   
  </body>
    
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
    
  
    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    function log_out(){
            window.location='logout.php';
    }
    
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    
     function cash() {
        $.ajax({
        type:"POST",
        url: "updateBalance.php",
        data: ({studentID: <?php echo $id ?>}),
        success: function(){
    }
    
   });
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    
    function alert1() {
     /*swal("כל הכבוד","עידכנת את יתרת התלמיד!", "succes")*/;
     swal({
        title: "עדכנת את יתרת התלמיד!",
        text: " כל הכבוד! ",
        timer: 10000,
        showConfirmButton: false
    });
     
        /* swal({
          title: "אתה בטוח שברצונך לעדכן את יתרת התלמיד?",
          text: "ברגע שתעדכן לא תוכל לשנות את יתרת התלמיד",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("יתרת התלמיד עודכנה בהצלחה!", {
              icon: "success",
            });
          } else {
            swal("הפעולה בוטלה!");
          }
        });*/
    }
    
      
      
    </script>


</body>
</html>
