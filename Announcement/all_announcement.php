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
            header("location:../Announcement/all_announcement.php#login");
        }
        else {
            header("location:index.php");
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

if(isset($_POST["handle_submit"])){
   
    $title = $_POST['title'];
    $titles = str_replace("'","\'",$title);
    $date_created = date_create();
    $created_at = date_format($date_created, "Y-M-d");
    $description = stripslashes($_POST['description']);
    $descriptions = str_replace("'","\'",$description);

    $date = date_create();
    $stamp = date_format($date, "Y");
    $temp = $_FILES['myfile']['tmp_name'];
    $directory = "../upload/" . $stamp . $_FILES['myfile']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "INSERT INTO announcement SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0;";
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Announcement/all_announcement.php");
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            unset($_POST['handle_submit']);
            
        } else {
            echo mysqli_error($conn);
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <link rel="stylesheet" href="../css/mdb.min.css" />
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
                                
                                <form action="logout.php" method="POST">
                                    <li><button class="dropdown-item rounded-5" name="logout">Logout</button></li>
                                </form>
                            </ul>
                            </div>
                        </li>';
                }
            }else{
                echo '
                        <a href="" class="text-white ps-3 " data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                        <i class="fas fa-circle-user"></i>
                        LOGIN
                        </a>
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

  <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">ANNOUNCEMENT LIST</p>
          <p class="tag-sub">Access all announcements from the Office of Student Affairs (OSA)</p>
        </div>

      </div>
    </div>

  <div class="container">
    <div class="">
      <?php
        $sql = "SELECT * FROM announcement WHERE is_archive=0 ORDER BY date_created desc limit 1";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
            <div class="card mb-3 shadows border" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                              <img src="<?php echo $row['image']; ?>" class="card-img" alt="" style="height: 35vh; object-fit: cover;"/>
                              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                          </div>
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
            </div>
         <?php     
          }
      }
      ?> 
    </div>
  </div>

  <!-- Button trigger modal -->
  <div class="container d-flex justify-content-end mb-3">
    <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 1) {
              echo '<button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#add_announcement">
                      Add Announcement
                    </button>';
          }
      }else{
          echo '';
      }
    ?>
  </div>
    

  <!-- Add Announcement Modal -->
  <div class="modal fade" id="add_announcement" tabindex="-1" aria-labelledby="add_announcement" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Announcement</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
               
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../img/avatar.png" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Announcement Title<span class="text-danger"> *</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control " rows="5" id="description" name="description" minlength="30" maxlength="5000" required></textarea>
                </div>
            </div>
            <div class="modal-footer pt-4 ">                  
                <button type="submit" name = "handle_submit" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
    
  <div class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
          $sql = "SELECT * FROM announcement WHERE is_archive=0";
          $res = mysqli_query($conn, $sql);
          if(mysqli_num_rows($res) > 0){
              while ($row = mysqli_fetch_assoc($res)) {?>
          <div class="col">
              <a href="<?php echo '../Announcement/announcement_details.php?announcement_id=' . $row['id']; ?>">
                
                  <div class="card h-100 shadows border">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                          <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="clsu-image" style="height: 35vh; object-fit: cover;"/>
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

    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
  <script>
      var loadFile = function(event) {
          var image = document.getElementById('output');
          image.src = URL.createObjectURL(event.target.files[0]);
          image.setAttribute("class", "out");
      };
      
  </script>
</body>
</html>