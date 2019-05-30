
<?php include_once("Includes/database.php");
$connect= new Database();
$connect= $connect->get_connection();
function make_query($connect)
{
 $query = "SELECT * FROM teachers ORDER BY id ASC";
 $result = mysqli_query($connect, $query);
 return $result;
}

function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($connect)
{
 $output = '';
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
    <div class="col-lg-8">
         <div class="container1"> 
            <div class="item"> 
                <img alt="Avatar" style="width:150px; position:flex; left:150px;" src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'"/>
                <h2>'.$row["fullName"].'</h2>
                <h4><span>'.$row['description'].'</span><br>'.$row['experience'].'</h4>
            </div>
        </div>
    </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>FiTcher</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon" sizes="64x64"/>
  <!-- Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Favicons -->
  <link href="Images/favicon.png" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,900&amp;subset=hebrew" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <meta name="google-signin-client_id" content="980137532081-mao101e815frqfpbqamam2t665t3feuo.apps.googleusercontent.com">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  
  <!-- Main Stylesheet File -->
  <link href="CSS/style.css" rel="stylesheet">
  
  <script src="JS/cityautocomplete.js"></script>
  <script src="JS/subjectautocomplete.js"></script>
 <style>
    .container1 {
  /*background-color: #eee;*/
  border-radius: 5px;
  padding: 16px;
  margin: 16px 0;
}

/* Clear floats after containers */
.container1::after {
  content: "";
  clear: both;
  display: table;
}

/* Float images inside the container to the left. Add a right margin, and style the image as a circle */
.container1 img {
  float: left;
  margin-right: 20px;
  border-radius: 50%;
  margin-left: 200px;
}

/* Increase the font-size of a span element */
.container1 span {
  font-size: 20px;
  margin-right: 15px;
}

/* Add media queries for responsiveness. This will center both the text and the image inside the container */
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
     
     
 </style>
  
</head>

<body>

  <!--==========================  Header  ============================-->
  <header id="header" >
    <div class="container">

      <div class="logo float-left">
        
        <a href="#intro" class="scrollto"><img src="Images/Picture1.png" alt="" class="img-fluid"></a>
      </div>
        
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
           <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <a href="indexTeacher.php">Deep Drop Down 1</a>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
          <li><a href="#contact">צור קשר</a></li>
          <li><a href="#find_me_teacher">מצא לי מורה</a></il>
          <li><a href="#recommended_teachers">מורים מומלצים</a></li>
          <li><a href="#about">קצת עלינו</a></li>
          <li class="active"><a href="#intro">דף הבית</a></li>
        </ul>
        
          
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">
      <div class="intro-img">
      <!-- <img src="Images/intro-img.svg" alt="" class="img-fluid">-->
      </div>
 
      <div class="intro-info" dir="rtl">
        <h2 align="right">הפלטפורמה היחידה<br> שמשלבת מציאת מורה פרטי<br> וקביעת שיעור ביומן המורה</h2>

        <div>
          <a href="#loginTeacher" class="btn-get-started scrollto">הרשם כמורה</a>
          <a href="#loginStudent" class="btn-get-started scrollto">הרשם כתלמיד</a>
        </div>
      </div>

    </div>
  </section>
<!--==========================
      Search Section
    ============================-->  
  <section id="search">
    <div class="container" dir="rtl">
       <div class="row search-container">
          <header class="section-header" >
            <h3>חיפוש מורה פרטי</h3>
              <p><form class="introSearch" action="/action_page.php">
                  <input type='text' name="subject" id='subjectText' placeholder="הזן מקצוע לימוד">
                  <input type='text' name="city" id='cityText' placeholder="הזן עיר מגורים">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form></p>
           </header>
        </div>
      </div>
    </section>

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">       
          
         <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
            <h3>קצת עלינו</h3>
            <p> קצת על הצוות: <strong>אלה ברזלב, נוי רז ונעם צינס</strong><br>סטודנטים לתואר ראשון במערכות מידע, הלומדים במכללה האקדמית תל אביב יפו</p>
            <h3>?מה עושה הפלטפורמה</h3>
            <p>המטרה העיקרית היא לקשר בין מורים פרטים ותלמידים בבתי ספר יסודים ועל יסודים</p>
            <div class="icon-box wow fadeInUp">
              <div class="icon"><i class="fas fa-yin-yang"></i></div>
              <h4 class="title"><a href="">יצירת התאמה</a></h4>
              <p class="description">יצרת התאמה אופטימלית בין תלמיד למורה הפרטי על פי פרמטרים של עיר, המלצות, ניסון וסרטון קצר המציג את שיטת הלימוד של המורה הפרטי </p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-calendar"></i></div>
              <h4 class="title"><a href=""> שיפור הנגישות לקביעת שיעורים</a></h4>
              <p class="description">שיפור הנגישות לקביעת שיעורים פרטים באמצעות צפייה ושירון השיעור ביומן המורה הפרטי</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-credit-card"></i></div>
              <h4 class="title"><a href="">ייעול גביית התשלומים </a></h4>
              <p class="description"> ביצוע תשלום למורה הפרטי באשראי ישירות דרך הפלטפרומה צפיה בדוחות המפרטים את יתרות תשלום לתלמיד בעבור כלל השיעורים הפרטיים  </p>
            </div>

          </div>

          <div class="col-lg-6 content order-lg-1 order-2" dir="rtl">
            <img src="Images/educationNew.jpg" class="img-fluid" alt="" style="border-radius: 45px">
          </div>
        </div>

        </div>

      </div>
    </section><!-- #about -->

   
      <!--==========================
      Clients Section
    ============================-->
    <section id="testimonials" class="section-bg">

               <h1 align="center">המרצים המובחרים שלנו</h1>
               <h3 align="center">ייתנו לכם מענה בכל אשר תבקשו</h2>
               <br />
               <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php echo make_slide_indicators($connect); ?>
                </ol>
            
                <div class="carousel-inner">
                 <?php echo make_slides($connect); ?>
                </div>
                <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                 <span class="glyphicon glyphicon-chevron-left"></span>
                 <span class="sr-only">Previous</span>
                </a>
            
                <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                 <span class="glyphicon glyphicon-chevron-right"></span>
                 <span class="sr-only">Next</span>
                </a>
        </div>



    </section><!-- #testimonials -->

   

<!--==========================   Footer   ============================-->
<footer id="footer" dir="rtl">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        
          <div class="col-lg-4 col-md-6 footer-info" dir="rtl">
              <h3 class="title">fiTcher</h3>
              <p>יוצרים פלטפורמה שנועדה לקשר בין מורים פרטיים לתלמידים. הפלטפורמה תאפשר לבצע התאמה אופטימלית בין תלמיד למורה פרטי ותשפר את הנגישות לקביעת מועדי שיעורים, דרכי התקשורת וגביית התשלומים בין המורים לתלמידים.</p>
          </div>

          <div class="col-lg-4 col-md-6 footer-contact">
              <div>
                <h5>צור קשר</h5>
                <div class="icon"><i class="fas fa-map-marker-alt"></i>  רחוב רבנו ירוחם 2 , תל אביב-יפו </div> 
                <div class="icon"><i class="fas fa-phone"></i><strong> טלפון:  </strong> 052-3567122</div>
                <div class="icon"><i class="far fa-envelope"></i><strong> אימייל: </strong> noamzins2@gmail.com</div>
              </div>
          </div>
      </div>
    </div>
  </div>
</footer>
<!----------- #footer -------------->

  <!-- JavaScript Libraries -->
  
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  
  <!-- Template Main Javascript File -->
  <script src="JS/main.js"></script>
 

</body>
</html>
