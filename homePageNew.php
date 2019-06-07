<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon" sizes="32x32"/>

  <title>fiTcher - Home Page</title>

  <!--- Google Fonts --->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  
  <!---fontawesome --->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="CSS/modern-business.css" rel="stylesheet">
  <link href="CSS/homePage.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container" id="navia">
      <a class="navbar-brand" href="homePageNew.php"><img src="Images/logo.png" height=70 width=120></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="newLogin.php">התחברות</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">צור קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#regi">הרשמה</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="homePageNew.php">עמוד הבית</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('Images/backgroundHome.png')">
          <div class="carousel-caption d-none d-md-block">
            <h1 class="mainImg">fi<span class="Tletter">T</span>cher</h1>
            <p class="mainSent">להצלחה בלימודים צריך שני צדדים</p>
            <a href="#regi" class="btn some" style="background-color:green;">הירשמו עכשיו</a>
          </div>
        </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="trol">
  <div class="container"> 

    <!-- Portfolio Section -->
    <h1 class="my-4 centro">מה אנחנו מציעים</h1>

    <div class="row">
      <div class="col-lg-3 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <div class="pic"> 
              <img class="center2" src="Images/pay.png" height=90 width=90>
          </div>
          <div class="card-body">
            <h4 class="card-title cardi">תשלום נוח</h4>
            <p class="card-text"><strong>פתרון מצויין לשני הצדדים</strong><br>עבור התלמיד - תשלום בכרטיס אשראי<br>עבור המורה - ניהול תשלומים במזומן</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <div class="pic">
          <img class="center2" src="Images/card.png" height=90 width=90>
          </div>
          <div class="card-body">
            <h4 class="card-title cardi">פרופיל לניהול אישי</h4>
            <p class="card-text">גישה נוחה לפרופיל ולפעולות החשובות לך</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <div class="pic">
              <img class="center2" src="Images/yin-yang.png" height=80 width=80>
          </div>
          <div class="card-body">
            <h4 class="card-title cardi">יצירת התאמה</h4>
            <p class="card-text">ממליצים לך על מורים בהתאם להעדפות האישיות שלך</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <div class="pic">
          <img id="pic" class="center2" src="Images/calendar.png" height=90 width=90>
          </div>
          <div class="card-body">
            <h4 class="card-title cardi">שיעור בלחיצת כפתור</h4>
            <p class="card-text">קביעת שיעור בקלות בהתאם ליומן המורה</p>
          </div>
        </div>
      </div>
    </div>
    
    <hr>
    
    <div class="registartion">
    <h1  id="regi" class="my-4 centro">הרשמה</h1>

    <!-- Marketing Icons Section -->
    <div class="row" id="aria">
      <div class="col-lg-6 mb-6 centro">
          <div class="card-body" style="width:100%; height:50%;">
            <img src="Images/studentReg.png" width=140> 
          </div>
          <div class="card-footer">
            <a href="NewRegistration.php" class="btn some">אני תלמיד</a>
          </div>
        <!-- </div> -->
      </div>
      <div class="col-lg-6 mb-6 centro">
          <div class="card-body" style="width:100%; height:49%;">
            <img src="Images/teacherReg.png"  width=140> 
          </div>
          <div class="card-footer">
            <a href="NewTeacherRegistration.php" class="btn">אני מורה</a>
          </div>
        <!-- </div> -->
      </div>

    </div>
    <!-- /.row -->
    </div>
    
    <hr>
    <h1 dir="rtl" class="my-4 centro">עושים לכם את זה קל יותר...</h1>
    <div class="row" id="choosenT">
      <div class="col-lg-6 col-sm-6 portfolio-item">
        <div dir="rtl" class="card h-100 centro">
          <img class="center2" src="Images/paypal-logo.png" height=90 width=95>
          <div class="card-body">
            <h4 class="card-title cardi">תשלום באשראי עם PayPal</h4>
            <p class="card-text"> ביצוע תשלום מאובטח יותר</P>
          </div>
        </div>
      </div>
      <div dir="rtl" class="col-lg-6 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <img class="center2" src="Images/whatsappimg.png" height=90 width=95>
          <div class="card-body">
            <h4 class="card-title cardi">WhatsApp בלחיצת כפתור</h4>
            <p class="card-text">תקשורת פשוטה עם המורה</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark" id="footer">
    <div class="container">
      <p class="m-0 text-center text-white">© fiTcher 2019 </p>
      <p class="m-0 text-center text-white">אלה ברזלב            |              נעם צינס              |              נוי רז</p> 
      <p class="m-0 text-center text-white">fitcher@gmail.com </p>
      </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
