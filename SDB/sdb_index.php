<?php

session_start();
include '../mysql_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){ 
    // File upload configuration 
    $targetDir = "../upload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', NOW()),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO code_of_conduct_images (file_name, uploaded_on) VALUES $insertValuesSQL"); 
            if($insert){ 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = "Upload failed! ".$errorMsg; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
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

    <!-- Button trigger modal -->
    <div class="container d-flex justify-content-end">
        <button type="button" class="btn btn-primary fw-semibold" data-mdb-toggle="modal" data-mdb-target="#upload">
            Upload Files
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="upload" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="upload">Upload File</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                
                <?php if(!empty($statusMsg)){?>
                    <div class="rounded" style="background-color: #FFEBEE;">
                        <p class="text-dark p-3"> <?php echo $statusMsg; ?></p>
                    </div>
                <?php }?>
                <label class="form-label" for="file">Select Image Files to Upload:</label>
                <input type="file" name="files[]" multiple class="form-control" id="file" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <!-- <?php if(!empty($statusMsg)){?>
        <p class="status-msg"> <?php echo $statusMsg; ?></p>
    <?php }?>
    <form method="POST" enctype="multipart/form-data">
        Select Image Files to Upload:
        <input type="file" name="files[]" multiple >
        <input type="submit" name="submit" value="UPLOAD">
    </form> -->
    <?php
        // Include the database configuration file
      

        // Get images from the database
        $query = $conn->query("SELECT * FROM code_of_conduct_images ORDER BY id DESC");

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageURL = '../upload/'.$row["file_name"];
        ?>
            <img src="<?php echo $imageURL; ?>" alt="" />
        <?php }
        }else{ ?>
            <p>No image(s) found...</p>
    <?php } ?> 
    
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