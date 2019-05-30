<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

  <title>fiTcher</title>
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

  <!--- Google fonts --->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

  <!--w3 icons-->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="CSS/modern-business.css" rel="stylesheet">
  <link href="CSS/homePage.css" rel="stylesheet">
</head>
 <script>
        function log_out(){
                window.location='logout.php';
            }
 </script>
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
              <a class="dropdown-item" href="<?php echo $url;?>"><i class='fas fa-user-circle'></i> אזור אישי</a>
              <a class="dropdown-item" href="#" onclick='log_out();'><i class='fas fa-sign-out-alt'></i> התנתקות</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">צור קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#choosenT">מורים נבחרים</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="homePageLoginNew.php">עמוד הבית</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>First Slide</h3>
            <p>This is a description for the first slide.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Second Slide</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Third Slide</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <div class="trol">
  <div class="container"> 

    <!-- Portfolio Section -->
    <h1 class="my-4 centro">מתאימים לך אישית</h1>

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
            <p class="card-text">צפייה ועדכון הפרטים האישיים ובמורים</p>
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
            <p class="card-text">ממליצים לך על מורים המתאימים לפרופיל שלך ולמבחנים שלך</p>
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
            <p class="card-text">קביעת שיעור בהתאם ליומן המורה</p>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Project Five</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Project Six</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
          </div>
        </div>
      </div> -->
    </div>
    <!--/.row-->
    
    <!-- Features Section -->
    <!-- <div class="row">
      <div class="col-lg-6">
        <h2>Modern Business Features</h2>
        <p>The Modern Business template by Start Bootstrap includes:</p>
        <ul>
          <li>
            <strong>Bootstrap v4</strong>
          </li>
          <li>jQuery</li>
          <li>Font Awesome</li>
          <li>Working contact form with validation</li>
          <li>Unstyled page elements for easy customization</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
      </div>
      <div class="col-lg-6">
        <img class="img-fluid rounded" src="images/logo.png" alt="">
      </div>
    </div> -->
    <!-- /.row -->
    <hr>
    <div class="registartion">
    <h1  id="regi" class="my-4 centro">הרשמה</h1>

    <!-- Marketing Icons Section -->
    <div class="row" id="aria">
      <div class="col-lg-6 mb-6 centro">
        <!-- <div class="card h-100"> -->
          <!-- <h4 class="card-header">תלמיד</h4> -->
          <div class="card-body">
            <img src="Images/student.png" height=95 width=90> 
          </div>
          <div class="card-footer">
            <a href="#" class="btn some">אני תלמיד</a>
          </div>
        <!-- </div> -->
      </div>
      <div class="col-lg-6 mb-6 centro">
        <!-- <div class="card h-100"> -->
          <!-- <h4 class="card-header">מורה</h4> -->
          <div class="card-body">
            <img src="Images/education.png" height=90 width=90> 
          </div>
          <div class="card-footer">
            <a href="#" class="btn">אני מורה</a>
          </div>
        <!-- </div> -->
      </div>
      <!-- <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Card Title</h4>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div> -->
    </div>
    <!-- /.row -->
    </div>

    <h1 class="my-4 centro">המורים הנבחרים שלנו</h1>

    <div class="row" id="choosenT">
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <img class="center2" src="Images/logo.png" height=70 width=120>
          <div class="card-body">
            <h4 class="card-title cardi">תשלום נוח</h4>
            <p class="card-text">תשלום עבור שיעורים בכרטיס אשראי ובמזומן</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <img class="center2" src="Images/logo.png" height=70 width=120>
          <div class="card-body">
            <h4 class="card-title cardi">תשלום נוח</h4>
            <p class="card-text">תשלום עבור שיעורים בכרטיס אשראי ובמזומן</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100 centro">
          <img class="center2" src="Images/logo.png" height=70 width=120>
          <div class="card-body">
            <h4 class="card-title cardi">תשלום נוח</h4>
            <p class="card-text">תשלום עבור שיעורים בכרטיס אשראי ובמזומן</p>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Project Five</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Project Six</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
          </div>
        </div>
      </div> -->
    </div>

    <!-- Call to Action Section -->
    <!-- <div class="row mb-4">
      <div class="col-md-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
      </div>
      <div class="col-md-4">
        <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
      </div>
    </div> -->

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
