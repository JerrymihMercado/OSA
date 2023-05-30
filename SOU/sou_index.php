<?php

session_start();

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
<div class="logo-header ">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                    <div class="logo mr-xs-3">
                        <img src="../img/clsu-logo.png" alt="" >
                        
                    </div>
                    <div class="logo-text m-xs-0">
                        <span class="logo-title">Central Luzon State University</span>
                        <span class="logo-sub">Science City of Muñoz, Nueva Ecija, Philippines 3120</span>
                    </div>
                </div>
                <!-- <div class="logo-header-right col-xl-5 col-md-5 col-xs-5">
                        <div class="logo-links">
                            <a href="http://ggc.clsu.edu.ph/" target="_blank">Transparency Seal</a>
                            <a href="about-us/au-contact-us.php">Contact Us</a>
                        </div>
                    </div> -->

            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid navi-section">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars text-white"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <!-- <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img
            src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
            height="15"
            alt="MDB Logo"
            loading="lazy"
          />
        </a> -->
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../index.php">HOME</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../about_us.php">ABOUT US</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../Section/impu.php">IMPU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../CDESU/cdesu.php">CDESU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../GSU/gsu_index.php">GSU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../SOU/sou_index.php">SOU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="../SDB/sdb_index.php">SDB</a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
  
      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <!-- <a class="text-white me-3 " href="#">
            <i class="fas fa-circle-user text-white"></i>
            LOGIN
        </a> -->
        <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
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
                echo '
                        
                      ';
            }
          ?>
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                    echo '';
                }
            }
            // else{
            //     echo '<li class="nav-item">
            //             <a href="./Form_Register/register_index.php" class="text-white ps-3">
            //               REGISTER
            //             </a>
            //           </li>';
            // }
          ?>
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item">
                        <a href="./Archive/archive_index.php" class="text-white ps-3">
                          ARCHIVES
                        </a>
                      </li>';
                }
            }else{
                echo '';
            }
          ?>
  
        
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>

    <!-- banner -->
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="../img/banner1.png" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="d-flex justify-content-center align-items-center h-100 text-center">
                <h2 class="text-white mb-0">Student Organizations Unit (SOU)</h2>
            </div>
            </div>
            <!-- <div class="hover-overlay">
            <div class="mask" style="background-color: hsla(0, 0%,98%, 0.2)"></div>
            </div> -->
        </a>
    </div>

    <!-- brief history -->
    <div class="container mt-5">
        <p align="justify" class="impu-desc"><span class="fw-bold fs-3 g-0 p-0 m-0 text-success">T</span>he Student Organizations Unit is directly involved in the operation, 
            management, and supervision of all recognized student organizations in 
            Central Luzon State University. It is concerned with the planning, programming, 
            and identifying the existing resources that can be fully utilized by the different 
            Student Organizations for the benefit of their members in particular and the 
            CLSU students in general.</p>
    </div>
    <div class="container mt-5">
        <p align="justify" class="impu-desc"><span class="fw-bold fs-3 g-0 p-0 m-0 text-success">T</span>The Student Organizations Unit also organizes other trainings/symposia in 
        cooperation of other units in the campus such as the Guidance Services Unit, 
        University Supreme Student Council, Environmental Management Institute, 
        RM- CARES, etc.</p>
    </div>
     
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">LIST OF OFFICIAL ORGANIZATION</p>
          <p class="tag-sub">Here the list of campus organization</p>
        </div>
      </div>
    </div>
    <div class="container p-4">
        <ul>
          <li>Org 1</li>
          <li>Org 2</li>
          <li>Org 3</li>
          <li>Org 4</li>
        </ul>
    </div>  

    <div class="mt-5 footer-section " >
      <footer class="text-center text-lg-start bg-light text-muted" style="background-image: url(../img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">

      
        <!-- Section: Links  -->
        <section class="" style="background-image: url(../img/banner1.png);  background-size:100rem, 100rem; background-repeat: no-repeat;align-items: center; ">
          <div class="container-fluid  text-md-start pt-3 ">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mb-4">
              <!-- Content -->
                <img src="../img/white-logo.png" alt="" class="footer-logo text-center" style="height: 88px;">
                <h4 class="text-white fw-bold mt-2">OFFICE OF STUDENT AFFAIRS</h5>
                <p class="text-white fw-lighter">Science City of Muñoz, Nueva Ecija</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h5 class="text-uppercase fw-bold mb-4 " style="color: #cdfb13;">Contact</h5>
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
                <h5 class="text-uppercase fw-bold mb-4" style="color: #cdfb13;">
                  SOCIAL MEDIA
                </h5>
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