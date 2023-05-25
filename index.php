<?php

session_start();
include 'mysql_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   

    $sql = "SELECT * FROM account
      WHERE email = '$email'
      AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $email;
        $_SESSION['role'] = $row['role'];
        
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
        if ($row['role'] == 1) {    
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            header("location:index.php#login");
        }
        else {
            header("location:index.php");
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
          }
    } else {
        echo '<script language="javascript">';
        echo 'alert("error")';
        echo '</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="img/logo.png" class="icon">
    <link rel="stylesheet" href="./Style/style.css">
    <!-- <link rel="stylesheet" href="./Style/style_about.css"> -->
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <style>
      a,
      a:hover,
      a:focus,
      a:active {
          text-decoration: none;
          color: inherit;
      }
  </style>
  <body>
   
    <div class="container-fluid header-title">
    <div class="row">
      <div class="col-md-1 ">
        <img src="./img/clsu-logo.png" alt="" class="logo">
      </div>
      <div class="col">
        <div class="logo-title">
          <p class="pt-3 ps-3 header1">Central Luzon State University</p>
          <p class="ps-3 header2">Science City of Muñoz, Nueva Ecija, Philippines 3120</p>
        </div>  
      </div>
    </div>
  </div>  
  <div class="container-fluid">
    <div class="row">
      <nav class="navbar main-header-mid navbar-expand-md">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a href="index.php" class="link-home text-white active">HOME</a>
          </li>
          <li class="nav-item ">
            <a href="about_us.php" class="link text-white ps-3">ABOUT US</a>
          </li>
          <li class="nav-item ">
            <a href="Section/impu.php" class="link text-white ps-3">IMPU</a>
          </li>
          <li class="nav-item ">
            <a href="CDESU/cdesu.php" class="link text-white ps-3">CDESU</a>
          </li>
          <li class="nav-item ">
            <a href="GSU/gsu_index.php" class="link text-white ps-3">GSU</a>
          </li>
          <li class="nav-item ">
            <a href="SOU/sou_index.php" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="SDB/sdb_index.php" class="link text-white ps-3">SDB</a>
          </li>
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                    echo '<li class="nav-item">
                            <div class="btn-group shadow-0">
                            <a type="button" class="link text-white ps-3 dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                                LOGOUT
                            </a>
                            <ul class="dropdown-menu">
                                
                                <form action="logout.php" method="POST">
                                    <li><button class="dropdown-item rounded-5" name="logout">Logout</button></li>
                                </form>
                            </ul>
                            </div>
                        </li>';
                }
            }else{
                echo '<li class="nav-item">
                        <a href="" class="text-white ps-3 " data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                          LOGIN
                        </a>
                      </li>';
            }
          ?>
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                    echo '';
                }
            }else{
                echo '<li class="nav-item">
                        <a href="./Form_Register/register_index.php" class="text-white ps-3">
                          Register?
                        </a>
                      </li>';
            }
          ?>
          
        </ul>
      </nav>
    </div>
  </div>

  <div class="carousel-section">
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/banner1.png" class="d-block w-100" alt="Wild Landscape"/>
        <div class="carousel-caption" style="padding-top: 15vh">
          <h1>OFFICE OF STUDENT AFFAIRS</h1>
          <p>The Office for Student Affairs takes charge of the campus life of the students, 
              their welfare and discipline, and dormitory facilities. As such, it guides and 
              supervises the recognized student organizations, the student councils, the 
              COMELECs; and conducts capability-building seminars for the organization 
              advisers. The OSA looks into all student-initiated and student-related 
              activities.
          </p>
          <!-- <div class="pt-5">
            <button class="btn btn-success">Read More</button>
          </div> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/banner2.png" class="d-block w-100" alt="Camera"/>
        <div class="carousel-caption" style="padding-top: 15vh">
          <h1>CLSU MENTAL HEALTH PROVIDERS</h1>
          <p>The Guidance Services Unit of OSA is providing online and  tele counseling services for all CLSU students. Counselors and mental health professionals can be reached by students through their Messenger account and mobile numbers.
          </p>
          <!-- <div class="pt-5">
            <button class="btn btn-success">Read More</button>
          </div> -->
        </div>
      </div>
        <!-- <div class="carousel-item">
          <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits"/>
        </div> -->
      </div>
      <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- <div class="p-2 col-sm-2 card_title text-white mt-5">
    <h5>Announcement</h5>
  </div> -->
  <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
        <p class="tag-info">ANNOUNCEMENT</p>
        <p class="tag-sub ">Read the latest announcement from the Office of Student Affairs(OSA)</p>
      </div>

    </div>
  </div>
  <div class="container">
      <div class="col justify-content-end d-flex mb-3">
          <a href="Announcement/all_announcement.php">
            <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
          </a>
      </div>
    </div>
  <div class="container">
    <div class="row">
        <div class="col-12">
          <a href="Announcement/announcement_details.php">
            <div class="card mb-3 shadows" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                          <img src="img/osa-announcement.jpg" class="card-img" alt=""/>
                          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                      </div>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border">Attended the Leadership Seminar</h5>
                        <p class="card-text">
                          <small class="tag-sub">05-09-23</small>
                        </p>
                        <p class="card-text px-4">
                        OSA shall promFor those who attended the Leadership Seminar last April 14, 2023 at CLSU Auditorium, you may now claim your certificate of participation at Office of Student Affairs.
                        <br>
                        Note: Students may only claim their certificate during office hours.
                        </p>
                    </div>
                </div>
            </div>
          </a>
        </div>
      </div>
        <div class="col-12">
          <a href="Announcement/announcement_details.php">
            <div class="card mb-3 shadows" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                          <img src="img/osa-announcement.jpg" class="card-img" alt=""/>
                          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                      </div>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border">Attended the Leadership Seminar</h5>
                        <p class="card-text">
                          <small class="tag-sub">05-09-23</small>
                        </p>
                        <p class="card-text px-4">
                        OSA shall promFor those who attended the Leadership Seminar last April 14, 2023 at CLSU Auditorium, you may now claim your certificate of participation at Office of Student Affairs.
                        <br>
                        Note: Students may only claim their certificate during office hours.
                        </p>
                    </div>
                </div>
            </div>
          </a>
        </div>
      </div>
    </div>    
  </div>

  <!-- Modal -->
  <div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" required/>
              <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" required/>
              <label class="form-label" for="password">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              
                  <a href="#!">Forgot password?</a>
            </div>
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  

  <div class="mt-5 footer-section " >
    <footer class="text-center text-lg-start bg-light text-muted " style="background-image: url(img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">
      <!-- Section: Links  -->
      <section class="">
        <div class="container-fluid  text-md-start pt-3 " >
          <!-- Grid row -->
          <div class="row mt-3" >
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mb-4">
              <!-- Content -->
              <img src="img/logo-clsu.jpg" alt="" class="footer-logo text-center">
              
              <p class="text-white" style="font-size: 25px; font-weight:500;">OFFICE OF STUDENT AFFAIRS</p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4 " style="color: #cdfb13;">Contact</h6>
              <p class="text-white"><i class="fas fa-location-dot "></i> Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines</p>
              <p class="text-white">
                <i class="fas fa-envelope me-3 "></i>
                osa@clsu.edu.ph
              </p>
              <p class="text-white"><i class="fas fa-phone me-3 "></i> (044) 940 7030</p>
              <!-- <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> -->
            </div>
            <!-- Grid column -->
          
            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4" style="color: #cdfb13;">
                SOCIAL MEDIA
              </h6>
              <div>
                <a href="https://www.facebook.com/officeofstudentaffairsCLSU" target="_blank" class="me-3 text-reset">
                  <i class="fab fa-facebook-square fa-lg text-white"></i>
                </a>
                <a href="https://twitter.com/clsu_official?lang=en" target="_blank" class="me-3 text-reset">
                  <i class="fab fa-twitter fa-lg text-white"></i>
                </a>
                <a href="" class="me-3 text-reset">
                  <i class="fab fa-google fa-lg text-white"></i>
                </a>
                <a href="" class="me-3 text-reset">
                  <i class="fab fa-instagram fa-lg text-white"></i>
                </a>
                <a href="" class="me-3 text-reset">
                  <i class="fab fa-linkedin fa-lg text-white"></i>
                </a>
                
              </div>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-1 text-white" style="background: -webkit-linear-gradient(0deg, #008102, #93d12d);">
        © Copyright 2023 Central Luzon State University All Rights Reserved
        <!-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a> -->
      </div>
      <!-- Copyright -->
    </footer>
  </div>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
