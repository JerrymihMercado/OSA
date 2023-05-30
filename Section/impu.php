<?php

session_start();
include '../mysql_connect.php';

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
            header("location:../Section/impu.php#login");
        }
        else {
            header("location:../Section/impu.php#login");
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
if(isset($_POST['view'])){
  header("content-type: application/pdf");
  readfile('../Handbook/CLSU-STUDENT-HANDBOOK-2022-2023.pdf');
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
    .view-pdf-button .btn{
      margin-top: -30vh;
      position: absolute;
      font-weight: 600;
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
                <h2 class="text-white mb-0">INFORMATION MANAGEMENT AND PUBLICATION UNIT</h2>
            </div>
            </div>
            <!-- <div class="hover-overlay">
            <div class="mask" style="background-color: hsla(0, 0%,98%, 0.2)"></div>
            </div> -->
        </a>
    </div>

    <!-- brief history -->
    <div class="container mt-5">
        <p align="justify" class="impu-desc"><span class="fw-bold fs-3 g-0 p-0 m-0 text-success">T</span>his unit is designed to assist in the best practice of student affairs and
        services in the university through the aid of research, publication and
        information management. The IMPU shall be responsible for the collection,
        organization, and control over the planning, processing, evaluating and
        reporting of relevant information in order to meet client objectives and to
        enable efficient and effective delivery of services.</p>
    </div>
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">STUDENT HANDBOOK</p>
          <p class="tag-sub">Read the student handbook from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>
    <div class="mt-3 container">
        <div class="row">
            <div class="col-sm-6">
              <form action="" method="POST">
                <div class="card shadows card-handbook">
                    <img
                      src="../img/studenthandbook.png"
                      class="img-fluid hover-shadow"
                      alt="Los Angeles Skyscrapers"
                      style="height: 60vh; object-fit: cover;"
                    />
                     <?php
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                                echo '<div class="d-flex justify-content-center view-pdf-button">
                                        <button class="btn btn-light shadows px-5" name="view">View</button>
                                      </div>';
                            }
                        }else{
                            echo '';
                        }
                      ?>
                  </div>
              </form>
                
                <div class="row mt-3">
                    <div class="col-auto">
                        
                      <?php
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                                echo '';
                            }
                        }else{
                            echo '<h6>Please <span><a class="text-primary " data-mdb-toggle="modal" data-mdb-target="#login_Modal" style="cursor: pointer;">
                          login
                        </a></span>to view and download the student handbook</h6>';
                        }
                      ?>
                    </div>
                    <div class="col-md justify-content-end d-flex">
                      <?php
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                                echo '<a href="https://drive.google.com/uc?export=download&id=1FylpFFT3UyuQndDfatJ1R0jbZ5_2QwW4" class="btn btn-danger">Download</a>';
                            }
                        }else{
                            echo '';
                        }
                      ?>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="card shadows">
                <div class="card-body">
                    <h5 class="card-title">Links</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    
                </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- publication -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">PUBLICATION</p>
          <p class="tag-sub">See all the publication from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
          <a href="../Publications/all_publications.php">
            <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
          </a>
      </div>
    </div>

    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php
          $sql = "SELECT * FROM publication_page";
          $res = mysqli_query($conn, $sql);
          if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
            <div class="col">
                <a href="<?php echo '../Publications/publication_page.php?publication_ID=' . $row['id']; ?>">
                  <div class="card h-100 shadows">
                      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;"/>
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                      </div>
                      <div class="card-body">
                          <h5 class="card-title"><?php echo $row['title']; ?></h5>
                          <p class="card-text" align="justify">
                            <?php echo $row['descriptions']; ?>
                          </p>
                      </div>
                  </div>
                </a>
            </div>
            
            <?php     
              }
          }
          ?> 
        </div>
    </div>
    <!-- Research and evaluation -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">RESEARCH AND EVALUATION</p>
          <p class="tag-sub">See all the research and evaluation from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
          <a href="../Research_&_Evaluation/reasearch_page_1.php">
            <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
          </a>
      </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <a href="../Research_&_Evaluation/reasearch_details_1.php">
                  <div class="card h-100 shadows">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="../img/clsu-1.jpg" class="card-img-top" alt="clsu-image"/>
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.
                        </p>
                    </div>
                  </div>
                </a>
            </div>
            <div class="col">
                <div class="card h-100 shadows">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      <img src="../img/clsu-1.jpg" class="card-img-top" alt="clsu-image"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                </div>
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
                <input type="text" id="email" name="email" class="form-control" required/>
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
    <footer class="text-center text-lg-start bg-light text-muted " style="background-image: url(../img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>