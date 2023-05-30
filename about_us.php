<?php
session_start();

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
    <link rel="stylesheet" href="./Style/style_about.css">
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
    ul,li
      {
          list-style-type: none;
      }
</style>
  <body>

    <div class="logo-header ">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                    <div class="logo mr-xs-3">
                        <img src="./img/clsu-logo.png" alt="" >
                        
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
            <a class="nav-link text-white" href="index.php">HOME</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="about_us.php">ABOUT US</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="Section/impu.php">IMPU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="CDESU/cdesu.php">CDESU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="GSU/gsu_index.php">GSU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="SOU/sou_index.php">SOU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="SDB/sdb_index.php">SDB</a>
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
                                
                                <form action="logout.php" method="POST">
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
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="img/banner1.png" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="row text-center">
              <div class="col-12 pt-3">
                <img src="img/white-logo.png" alt="" class="banner_logo ">
              </div>
              <div class="col-12 pt-3">
                 <h4 class="text-white mb-0 fw-bold">OFFICE OF STUDENT AFFAIRS</h4>
              </div>

            </div>
   
            </div>
        </a>
    </div>
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OVERVIEW</p>
          <p class="tag-sub ">The OSA serves as the center of information, activities, and services related to the co-curricular and extra-curricular needs of students. It also promotes the development of students’ talents, potentials, and leadership capabilities through its program thrusts of self-growth and awareness, cooperative living and learning, leadership development and enhancement, productive use of leisure, and enhanced cross-cultural adjustment.</p>
        </div>

      </div>
    </div>

    <div class="container pt-4">
      <!-- <div class="row">
        <div class="col-12">
          <div class="card shadows">
            <div class="row no-gutter">
              <div class="col-md-3">
                  <img src="img/osa-logo.jpg" alt="" class="card-img ">
              </div>
              <div class="col-md-9 ">
                <div class="card-body ">
                  <h5 class="text-success">OSA MISSION</h5>
                  <div class="borders " >
                    <p class=" mission-info ms-2">OSA shall promote the development of the students’ talents,
                      potentials and leadership capabilities through its program thrusts that promote
                      self- awareness, self-growth and development, self- management, cooperative
                      living and learning, leadership advancement, social responsibility, nationalism
                      and patriotism and wise use and management of relevant information.</p>
                    </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
        
        <div class="col-12 pt-3">
          <div class="card shadows">
            <div class="row no-gutter">
              <div class="col-md-3">
                  <img src="img/osa-picture.jpg" alt="" class="card-img ">
              </div>
              <div class="col-md-9 order-md-first" >
                <div class="card-body ">
                  <h5 class="text-success">OSA VISION</h5>
                  <div class="borders" >
                  <p class="vision-info ps-3">OSA-CLSU as a model center for student personnel services
                      supportive of the co-curricular and extra-curricular needs of its clients for their
                      well- rounded growth and development</p>
                    </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </div> -->
      <div class="card mb-3 shadows border">
        <div class="row g-0">
          <div class="col-md-4">
            <img
              src="img/osa-logo.jpg"
              alt="Trendy Pants and Shoes"
              class="img-fluid rounded-start"
              style="height: 40vh; object-fit: cover;"
            />
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title fw-semibold">OSA MISSION</h4>
              <p class="card-text">
                OSA shall promote the development of the students’ talents,
                potentials and leadership capabilities through its program thrusts that promote
                self- awareness, self-growth and development, self- management, cooperative
                living and learning, leadership advancement, social responsibility, nationalism
                and patriotism and wise use and management of relevant information.
              </p>
            
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3 shadows border">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title fw-semibold">OSA VISION</h5>
              <p class="card-text">
                OSA-CLSU as a model center for student personnel services
                supportive of the co-curricular and extra-curricular needs of its clients for their
                well- rounded growth and development
              </p>
            
            </div>
          </div>
          <div class="col-md-4">
            <img
              src="img/osa-logo.jpg"
              alt="Trendy Pants and Shoes"
              class="img-fluid rounded-end"
              style="height: 40vh; object-fit: cover;"
            />
          </div>
        </div>
      </div>
    </div>

    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OSA ADMINISTRATION</p>
          <p class="tag-sub ">Meet all the Administrators and Staffs</p>
        </div>

      </div>

    </div>

    <div class="container mb-5">
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
          <a href="Staff/all_staffs.php">
            <div class="card h-100 shadows">
            <img src="./img/Dude Crew (900 × 500 px).png" class="card-img-top" alt="clsu-image"/>
            <div class="card-body">
              <h5 class="card-title mt-5 text-center">Information Management and Publication Unit</h5>
            </div>
          </div>
          </a>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew.png" class="card-img-top" alt="Palm Springs Road"/>
            <div class="card-body">
              <h5 class="card-title mt-5 text-center">Career Development and Employment Services Unit</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew (900 × 500 px).png" class="card-img-top" alt="Los Angeles Skyscrapers"/>
            <div class="card-body">
              <h5 class="card-title mt-5 text-center">Guidance Service Unit</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew.png" class="card-img-top" alt="Skyscrapers"/>
            <div class="card-body">
              <h5 class="card-title mt-5 text-center">Student Organization Unit</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <footer class="text-center text-lg-start bg-light text-muted" style="background-image: url(img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">

  
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
              <img src="img/white-logo.png" alt="" class="footer-logo text-center" style="height: 88px;">
              <h4 class="text-white fw-bold mt-2">OFFICE OF STUDENT AFFAIRS</h5>
              <p class="text-white fw-lighter">Science City of Muñoz, Nueva Ecija</p>
              <p class="text-white" style="font-size: 13px;">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
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
      
    </footer>
  </div>





    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
