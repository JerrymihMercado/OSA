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
              if (isset($_SESSION['is_admin'])) {
                  if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 0) {
                      echo '<li class="nav-item">
                              <form action="logout.php" method="POST">
                                  <button name="logout" class="btn btn-danger"  > Logout</button>
                              </form>
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
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="img/banner1.png" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="row text-center">
              <div class="col-12 pt-3">
                <img src="img/white-logo.png" alt="" class="banner_logo ">
              </div>
              <div class="col-12 pt-3">
                 <h2 class="text-white mb-0">OFFICE OF STUDENT AFFAIRS</h2>
              </div>

            </div>
            <!-- <div class="d-flex justify-content-center align-items-center h-100 text-center">
                
            <h2 class="text-white mb-0">OFFICE OF STUDENT AFFAIRS</h2>
            </div> -->
            </div>
        </a>
    </div>
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OVERVIEW</p>
          <p>The OSA serves as the center of information, activities, and services related to the co-curricular and extra-curricular needs of students. It also promotes the development of students’ talents, potentials, and leadership capabilities through its program thrusts of self-growth and awareness, cooperative living and learning, leadership development and enhancement, productive use of leisure, and enhanced cross-cultural adjustment.</p>
        </div>

      </div>
    </div>

    <div class="container pt-4">
      <div class="row">
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
      </div>
    </div>

    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OSA ADMINISTRATION</p>
          <p class="tag-sub ">Meet the Administrators and Staff</p>
        </div>

      </div>

    </div>

    <div class="container mb-5">
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew (900 × 500 px).png" class="card-img-top" alt="clsu-image"/>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">
                This is a longer card with supporting text below as a natural lead-in to
                additional content. This content is a little bit longer.
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew.png" class="card-img-top" alt="Palm Springs Road"/>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a short card.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew (900 × 500 px).png" class="card-img-top" alt="Los Angeles Skyscrapers"/>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadows">
            <img src="./img/Dude Crew.png" class="card-img-top" alt="Skyscrapers"/>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">
                This is a longer card with supporting text below as a natural lead-in to
                additional content. This content is a little bit longer.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <footer class="text-center text-lg-start bg-light text-muted" style="background-image: url(img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">

  
    <!-- Section: Links  -->
    <section class="" >
      <div class="container-fluid  text-md-start pt-3 ">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <img src="./img/logo-clsu.jpg" alt="" class="footer-logo text-center" style=" width: 5.5rem;">
            
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
    <!-- End your project here-->





    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
