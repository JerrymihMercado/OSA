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
          $_SESSION['status_success_admin'] = "success";
          header("location:index.php");
          
        }
        else {
            header("location:index.php");
            $_SESSION['status_success_user'] = "success";
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
                        <button type="button" class="btn btn-white px-3 me-2" data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                          Login / Register
                        </button>
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

  <div class="carousel-section d-none d-sm-block">
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/banner1.png" class="d-block w-100" alt="Wild Landscape"/>
        <div class="carousel-caption">
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
        <div class="carousel-caption">
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
        <!-- <?php
        if(isset($_SESSION['email']) != ''){
          
          echo 'name"'.$_SESSION['email'].'"';
        }
        ?> -->
        <p class="tag-info">ANNOUNCEMENT</p>
        <p class="tag-sub ">Stay updated with the latest announcements from the Office of Student Affairs (OSA)</p>
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
            <?php
              $sql = "SELECT * FROM announcement WHERE is_archive=0";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  while ($row = mysqli_fetch_assoc($res)) {?>
      <a href="<?php echo 'Announcement/announcement_details.php?announcement_id=' . $row['id']; ?>">
        <div class="col-12">
            <div class="card mb-3 shadows border" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                    <img src="./upload/<?php echo $row['image']; ?>" class="img-fluid rounded-start" alt="" style="height: 35vh; object-fit: cover;"/>

                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border"><?php echo $row['title']; ?></h5>
                        <p class="card-text">
                          <small class="tag-sub"><?php echo $row['date_created']; ?></small>
                        </p>
                        <p class="card-text px-4">
                          <?php echo $row['descriptions']; ?>
                        </p>
                    </div>
                </div>
            </div>
          </a>
        </div>
      </div>
      
      </div>
                  <?php     
                }
            }
            ?> 
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
            <div class="form-outline mb-2">
              <input type="password" id="password" name="password" class="form-control" required/>
              <label class="form-label" for="password">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
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
    <!-- End your project here-->
          


  <script src="js/sweetalert2.js"></script>
    <?php
   
      if(isset($_SESSION['status_success_admin']) ){
          ?>
          <script>
              const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
              })
              Toast.fire({
              icon: 'success',
              title: 'Welcome Back Admin!'
              })

          </script>
          <?php
   
          unset($_SESSION['status_success_admin']);
      }

    if(isset($_SESSION['status_success_user']) ){
        ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Welcome <?php echo $_SESSION['fullname']?>!'
            })

        </script>
        <?php
        unset($_SESSION['status_success_user']);
    }
    
    if(isset($_SESSION['status_error'])){
        ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'error',
            title: 'Credentials error'
            })

        </script>
        <?php
        unset($_SESSION['status_error']);
    }
    ?>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
