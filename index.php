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
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body style="background-color: #fdfdfd">
   
  <div class="logo-header ">
      <div class="container-fluid">
          <div class="row d-flex justify-content-between">
              <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                  <div class="logo mr-xs-3">
                      <img src="./img/clsu-logo.png" alt="CLSU_LOGO">
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
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item me-2">
                        <a href="Complain/complain_index.php" class="nav-link text-white">
                            COMPLAINS
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
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/banner2.png" class="d-block w-100" alt="Camera"/>
        <div class="carousel-caption">
          <h1>CLSU MENTAL HEALTH PROVIDERS</h1>
          <p>The Guidance Services Unit of OSA is providing online and  tele counseling services for all CLSU students. Counselors and mental health professionals can be reached by students through their Messenger account and mobile numbers.
          </p>
        </div>
      </div>
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
  <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
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
        <?php
            $sql = "SELECT * FROM announcement WHERE is_archive=0 limit 4";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="row g-0">
          <div class="card mb-3 shadows border">
            <div class="card-header">
              <div class="row">
                <div class="col">
                  <h6><?php echo $row['title']; ?></h6>
                </div>
                <div class="col justify-content-end d-flex">
                  <small><?php echo $row['date_created']; ?></small>
                </div>
                </div>
            </div>
            <div class="card-body">
                <p>
                  <?php 
                    $details = substr($row['descriptions'],0,350);
                    if($details > 350){
                        echo $details?>...
                    <?php }else{
                        echo '';
                    }?>
                </p>
            </div>
            <div class="card-footer border-0 justify-content-end d-flex">
                <a href="<?php echo 'Announcement/announcement_details.php?announcement_id=' . $row['id']; ?>" class="card-text">
                  <button class="btn btn-dark shadow-0"><i class="fas fa-eye"></i> View Details</button>
                </a>
              </div>
          </div>
        </div>
        <?php     
                }
        }else{?>
            <div class="container p-2 justify-content-center d-flex">
                <h1 class="text-warning">No Data Found!</h1>
            </div>
        <?php  }
                ?>
      </div>
    </div>
  </div>

  
  <!-- Login Modal -->
  <div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header border-0">
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="justify-content-center d-flex" style="height: 50px; margin-top: -5vh;">
            <img src="img/logo.png" alt="login-logo" class="shadow rounded-circle">
          </div>
          <div class="py-2 justify-content-center d-flex">
            <h5>CLSU Account for OSA</h5>
          </div>
          <div class="text-center">
            <p>Log in with the credentials of your account to get more accurate view of office of student affairs.</p>
          </div>
          <form method="POST">
              <!-- Email input -->
              <div class="form-outline mb-3 mt-4">
                  <input type="email" id="email" name="email" class="form-control" required/>
                  <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-2">
                  <input type="password" id="password" name="password" class="form-control" required/>
                  <label class="form-label" for="password">Password</label>
              </div>
              <div class="mb-4 justify-content-end d-flex">
                <a href="Forgot_Password/send_reset_pass.php" class="text-muted">Forgot password?</a>
              </div>
              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Continue</button>
              <div class="pt-3 text-center">
                  Don't have an account? <a href="Form_Register/register_index.php" class="text-success">Register Here</a>
              </div>
          </form>
        </div>
        </div>
    </div>
  </div>
  <!-- Footer -->
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
  <script>
    document.addEventListener('contextmenu', (e) => e.preventDefault());

    function ctrlShiftKey(e, keyCode) {
    return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
    }

    document.onkeydown = (e) => {
    if (
        event.keyCode === 123 ||
        ctrlShiftKey(e, 'I') ||
        ctrlShiftKey(e, 'J') ||
        ctrlShiftKey(e, 'C') ||
        (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
    )
        return false;
    };
  </script>
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
        
    }
    ?>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
