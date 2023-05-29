<?php

session_start();
include '../mysql_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
            header("location:../SDB/sdb_index.php#login");
        }
        else {
            header("location:../SDB/sdb_index.php#login");
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
if (isset($_POST['submitMail'])) {

	require '../includes/PHPMailer.php';
	require '../includes/SMTP.php';
	require '../includes/Exception.php';

    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $user_message = str_replace("'","\'",$message);
 
    $sql = "INSERT INTO complainant_message SET 
            user_file=0,
            user_name = '$fullname',
            user_course = '$course',
            user_email = '$email',
            user_message='$user_message';";
            
    if (mysqli_query($conn, $sql)) {
           
            unset($_POST['handle_submit']);
            
        } else {
            echo mysqli_error($conn);
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
    
     $body = '  <body>
                    <div class="fluid-container" style="padding: 5% 20% 10px">
                        <div class="card-box"
                            style="
                                display: block;
                                justify-content: center;
                                border: 1px solid #f5f5f5f5;
                                border-radius: 10px;
                            "
                        >
                            <div
                                class="img-card"
                                align="center"
                                style="width: 100%; margin-top: 30px"
                            >
                                <img
                                    src="https://i.imgur.com/DTcwEeE.png"
                                    alt="email_logo"
                                    style="height: 150px"
                                />
                            </div>
                            <div
                                class="card-body-container"
                                style="width: 84%; margin: 8% 0% 0% 8%"
                            >
                                <h1
                                    class="card-title-name"
                                    align="center"
                                    style="color: #006000"
                                >
                                    Complained Received
                                </h1>
                                <br />
                                <h3 class="card-text-content">Good day, <b>' . $_POST['fullname'] . '</b></h3>
                                <p>
                                    We truly appreciate you taking the time to share your relevant concerns with us. 
                                    Rest assured that we will evaluate your situation as soon as possible. Please wait until you receive an official email message from the Office of Student Affairs.
                                </p>
                                <p>Thank You!</p>

                            </div>
                            <div
                                class="card-footer-name"
                                align="center"
                                style="
                                    background: #006000;
                                    color: #ffff;
                                    border-radius: 3px;
                                    padding: 10px;
                                "
                            >
                                <b>CLSU | Office of Student Affairs</b>
                            </div>
                        </div>
                    </div>
                </body>';
    //Create instance of PHPMailer
        $mail = new PHPMailer();
    //Set mailer to use smtp
        $mail->isSMTP();
    //Define smtp host
        $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
        $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
    //Port to connect smtp
        $mail->Port = "587";
    //Set gmail username
        $mail->Username = "noreply.clsu.osa@gmail.com";
    //Set gmail password
        $mail->Password = "vxysdrlygvebegfg";
    //Email subject
        $mail->Subject = "Complained";
    //Set sender email
        $mail->setFrom('noreply.clsu.osa@gmail.com');
    //Enable HTML
        $mail->isHTML(true);
    //Attachment
        // $mail->addAttachment('img/attachment.png');
    //Email body
        $mail->Body = $body;
    //Add recipient
        $mail->addAddress($_POST['email']);
        // $mail->addAddress('noreply.clsu.osa@gmail.com');
    //Finally send email
        if ( $mail->Send() ) {
            $_SESSION['status_success'] = "success";
        }else{
            echo 'Message could not be sent. Mailer Error: '[$mail->ErrorInfo];
        }
    //Closing smtp connection
        $mail->smtpClose();
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
    .img-blur{
        filter: blur(4px);
    }
    .chat-bot{
        position: -webkit-sticky;
        position: sticky;
        bottom: 0;        
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
            <a href="../Section/impu.php" class="link text-white ps-3">IMPU</a>
          </li>
          <li class="nav-item ">
            <a href="../CDESU/cdesu.php" class="link text-white ps-3">CDESU</a>
          </li>
          <li class="nav-item ">
            <a href="../GSU/gsu_index.php" class="link text-white ps-3">GSU</a>
          </li>
          <li class="nav-item ">
            <a href="../SOU/sou_index.php" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="" class="link text-white ps-3">SDB</a>
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
                                
                                <form action="../logout.php" method="POST">
                                    <li><button class="dropdown-item rounded-5" name="logout">Logout</button></li>
                                </form>
                            </ul>
                            </div>
                        </li>';
                }
            }else{
                echo '';
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
                <h2 class="text-white mb-0">CLSU STUDENT CODE OF CONDUCT AND DISCIPLINE</h2>
            </div>
            </div>
            <!-- <div class="hover-overlay">
            <div class="mask" style="background-color: hsla(0, 0%,98%, 0.2)"></div>
            </div> -->
        </a>
    </div>

    
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">CODE OF CONDUCT AND DISCIPLINE</p>
          <p class="tag-sub">Read the student conduct and discipline from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>
    
    <!-- Modal gallery -->
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="bg-image hover-overlay ripple shadow-1-strong rounded shadows" data-ripple-color="light">
                    <img src="../img/conduct-1.png" class="w-100"/>
                    <a href="#!" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="bg-image hover-overlay ripple shadow-1-strong rounded shadows" data-ripple-color="light">
                    <img src="../img/conduct-2.png" class="w-100"/>
                    <a href="#!" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="bg-image hover-overlay ripple shadow-1-strong rounded shadows" data-ripple-color="light">
                    <img src="../img/conduct-3.png" class="w-100"/>
                    <a href="#!" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                    </a>
                </div>
            </div>
            <!-- <div class="col">
                <div class="card h-100">
                
                </div>
            </div> -->
        </div>
        <section class="">
       
            <!-- Section: Modals -->
            <section class="">
                <!-- Modal 1 -->
                <div
                class="modal fade"
                id="exampleModal1"
                tabindex="-1"
                aria-labelledby="exampleModal1Label"
                aria-hidden="true"
                >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <img
                        src="../img/conduct-1.png"
                        class="w-100"
                        />

                    <div class="text-center py-3">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Close
                        </button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal 2 -->
                <div
                class="modal fade"
                id="exampleModal2"
                tabindex="-1"
                aria-labelledby="exampleModal2Label"
                aria-hidden="true"
                >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <img
                        src="../img/conduct-2.png"
                        class="w-100"
                        />

                    <div class="text-center py-3">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Close
                        </button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal 3 -->
                <div
                class="modal fade"
                id="exampleModal3"
                tabindex="-1"
                aria-labelledby="exampleModal3Label"
                aria-hidden="true"
                >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <img
                        src="../img/conduct-3.png"
                        class="w-100"
                        />

                    <div class="text-center py-3">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Close
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- Section: Modals -->
        </section>
    </div>
    <!-- Modal gallery -->

   <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 0) {
                echo ' <div class="p-5 chat-bot d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-lg btn-floating" data-mdb-toggle="modal" data-mdb-target="#chatModal">
                                <i class="fas fa-comment"></i>
                            </button>
                        </div>';
            }
        } else {
            echo '';         
        }

    ?>

    <!-- Modal -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="chatModal">Tell me something</h5>
                    <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form method="POST">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="fullname" name="fullname" class="form-control" required/>
                                    <label class="form-label" for="fullname">Fullname</label>
                                </div>
                            </div>
                            
                        </div>
                        <!-- course input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="course" name="course" class="form-control"  required/>
                            <label class="form-label" for="course">Course</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control"  required/>
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <!-- Upload file -->
                        <!-- <div class="mb-4">
                            <label class="form-label" for="myfile">Optional</label>
                            <input type="file" class="form-control" id="myfile" name="myfile" multiple/>
                        </div> -->
                        

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="message" rows="4" name="message" required></textarea>
                            <label class="form-label" for="message">State your concern here</label>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" name="submitMail" id="submitMail" class="btn btn-primary btn-rounded shadows">Send <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
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
                <input type="email" id="email" name="email" class="form-control" />
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
                    <h5 class="text-uppercase fw-bold mb-4 " style="color: #cdfb13;">Contact</h6>
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

    <script src="../js/sweetalert2.js"></script>
    <?php
    if(isset($_SESSION['status_success']) ){
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
            title: 'Email Send!'
            })

        </script>
        <?php
        unset($_SESSION['status_success']);
    }
    ?>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.setAttribute("class", "out");
    };
    
</script>
</body>
</html>