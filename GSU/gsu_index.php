<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    $sql = "SELECT * FROM login
      WHERE email = '$username'
      AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $username;
        $_SESSION['is_admin'] = $row['is_admin'];
        

        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
                if ($row['is_admin'] == 1) {    
                    echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
                    header("location:../Section/impu.php#login");
                }
                else {
                    header("location:../Section/impu.php");
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">
    <?php
      include '../Links/link.php';
    ?>
    
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
        <img src="../img/clsu-logo.png" alt="" class="logo">
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
            <a href="../index.php" class="link-home text-white">HOME</a>
          </li>
          <li class="nav-item ">
            <a href="../about_us.php" class="link text-white ps-3">ABOUT US</a>
          </li>
          <li class="nav-item ">
            <a href="" class="link text-white ps-3">IMPU</a>
          </li>
          <li class="nav-item ">
            <a href="../CDESU/cdesu.php" class="link text-white ps-3">CDESU</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">GSU</a>
          </li>
          <li class="nav-item ">
            <a href="../SOU/sou_index.php" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="../SDB/sdb_index.php" class="link text-white ps-3">SDB</a>
          </li>
          <?php
            if (isset($_SESSION['is_admin'])) {
                if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 0) {
                    echo '<li class="nav-item">
                            <div class="btn-group shadow-0">
                            <a type="button" class="link text-white ps-3 dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                                LOGOUT
                            </a>
                            <ul class="dropdown-menu">
                                
                                <form action="../logout.php" method="POST">
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
        </ul>
      </nav>
    </div>
  </div>

    <!-- banner -->
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="../img/banner1.png" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="d-flex justify-content-center align-items-center h-100 text-center">
                <h2 class="text-white mb-0">Guidance Service Unit (GSU)</h2>
            </div>
            </div>
            <!-- <div class="hover-overlay">
            <div class="mask" style="background-color: hsla(0, 0%,98%, 0.2)"></div>
            </div> -->
        </a>
    </div>

    <!-- brief history -->
    <div class="container mt-5">
        <p align="justify" class="impu-desc"><span class="fw-bold fs-3 g-0 p-0 m-0 text-success">T</span>his unit provides programs and activities 
        that aim at helping students adjust to college life by helping them 
        understand themselves better, improve interpersonal relationship, make 
        intelligent decisions and prepare for a lifelong career. It provides 
        information to enable the students to explore occupational areas and to 
        identity prospects for employment.</p>
    </div>
     
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OFFICIAL WEBSITE PAGE</p>
          <p class="tag-sub">Visit our official website for Student Organizations Unit (SOU)</p>
        </div>
      </div>
    </div>
    <div class="container p-4">
        <h6 class="fw-bold text-primary">gsu.edu.ph</h6>
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
                <input type="text" id="username" name="username" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
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
      <footer class="text-center text-lg-start bg-light text-muted" style="background-image: url(../img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">

      
        <!-- Section: Links  -->
        <section class="" style="background-image: url(../img/banner1.png);  background-size:100rem, 100rem; background-repeat: no-repeat;align-items: center; ">
          <div class="container-fluid  text-md-start pt-3 ">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-5 mx-auto mb-4">
                <!-- Content -->
                <img src="../img/logo-clsu.jpg" alt="" class="footer-logo text-center" style=" width: 5.5rem;">
                
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


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>