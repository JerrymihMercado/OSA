<?php
session_start();
include 'mysql_connect.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_email = openssl_encrypt($email,$ciphering,$encryption_key,$option,$encryption_iv);

    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_password = openssl_encrypt($password,$ciphering,$encryption_key,$option,$encryption_iv);

    $sql = "SELECT * FROM account
      WHERE email = '$encryption_email'
      AND password = '$encryption_password'";
    
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        $ciphering = "AES-128-CTR";
        $option = 0;
        $decryption_key = "info";
        $decryption_iv = '1234567890123456';
        $decryption = openssl_decrypt($row['email'],$ciphering,$decryption_key,$option,$decryption_iv);
        $session_email = $decryption;

        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['email'] = $session_email;
        $_SESSION['course'] = $row['course'];
        
        $_SESSION['role'] = $row['role'];
        
        if ($row['role'] == 1) {    
          header("location:index.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:index.php");
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error'] = "error";
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
    <link rel="stylesheet" href="./Style/style_about.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    
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
          </div>
      </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid navi-section">
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
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="index.php" active>HOME</a>
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
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item me-2">
                        <a href="./Archive/archive_index.php" class="nav-link text-white">
                          ARCHIVES
                        </a>
                      </li>';
                }
            }else{
                echo '';
            }
          ?>
        </ul>
      </div>
      <div class="d-flex align-items-center">
        <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                    echo '<li class="nav-item-out">
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
              echo '<li class="nav-item-out">
                        <div class="btn-group shadow-0">
                        <a type="button" class="link text-white ps-3" data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                            Login / Register
                        </a>
                        </div>
                    </li>
                  ';
            }
          ?> 
      </div>
    </div>
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
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <a href="Staff/all_staffs.php">
          <div class="card h-100 shadows border">
          <img src="img/Hired-pana.png" class="card-img-top" alt="administration_image"/>
          <div class="card-body">
            <h5 class="card-title mt-5 text-center">Information Management and Publication Unit</h5>
          </div>
        </div>
        </a>
      </div>
      <div class="col">
        <div class="card h-100 shadows border">
          <img src="img/Hired-pana.png" class="card-img-top" alt="administration_image"/>
          <div class="card-body">
            <h5 class="card-title mt-5 text-center">Career Development and Employment Services Unit</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadows border">
          <img src="img/Hired-pana.png" class="card-img-top" alt="administration_image"/>
          <div class="card-body">
            <h5 class="card-title mt-5 text-center">Guidance Service Unit</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadows border">
          <img src="img/Hired-pana.png" class="card-img-top" alt="administration_image"/>
          <div class="card-body">
            <h5 class="card-title mt-5 text-center">Student Organization Unit</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadows border">
          <img src="img/Hired-pana.png" class="card-img-top" alt="administration_image"/>
          <div class="card-body">
            <h5 class="card-title mt-5 text-center">Student Organization Unit</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Login-->
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
            <div class="form-outline mb-2">
              <input type="password" id="password" name="password" class="form-control" required/>
              <label class="form-label" for="password">Password</label>
            </div>
            <div class="row mb-4">
                  <a href="#!">Forgot password?</a>
            </div>
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
            <div class="pt-3 text-center">
              <a href="./Form_Register/register_index.php" class="text-success">Register Account</a>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-5 footer-section " >
    <footer class="text-center text-lg-start bg-light text-muted " style="background-image: url(img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">
      <section class="">
        <div class="container-fluid text-md-start pt-3 px-5">
          <div class="row mt-3" >
            <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mb-4">
              <img src="img/white-logo.png" alt="" class="footer-logo text-center" style="height: 88px;">
              <h4 class="text-white fw-semibold mt-2">OFFICE OF STUDENT AFFAIRS</h5>
              <p class="text-white fw-light">Science City of Muñoz, Nueva Ecija</p>
              <small class="text-white fw-light" style="font-size: 13px;">© Copyright 2023 Central Luzon State University All Rights Reserved</small>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
              <h5 class="text-uppercase fw-semibold mb-4 " style="color: #cdfb13;">Contact</h5>
              <p class="text-white"><i class="fas fa-location-dot "></i> Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines</p>
              <p class="text-white">
                <i class="fas fa-envelope me-3 "></i>
                osa@clsu.edu.ph
              </p>
              <p class="text-white"><i class="fas fa-phone me-3 "></i> (044) 940 7030</p>
            </div>          
            <div class="col-auto mx-auto mb-4">
              <h5 class="text-uppercase fw-semibold mb-4" style="color: #cdfb13;">
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
          </div>
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
