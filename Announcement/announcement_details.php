<?php
session_start();
include '../mysql_connect.php';
if (isset($_GET['announcement_id'])) {
    $id = $_GET['announcement_id'];
    $sql = "SELECT * FROM  announcement WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $announcement_details = mysqli_fetch_assoc($result);
    }
}
if (isset($_POST['archive'])) {
 
    $id = $announcement_details['id'];
    $archive = 1;
     
    $sql = "UPDATE announcement SET is_archive='$archive' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
          echo '<script language="javascript">';
          echo 'alert("message successfully sent")';
          echo '</script>';
          header("location:../index.php#login");
    } else {
          echo '<script language="javascript">';
          echo 'alert("error")';
          echo '</script>';
    }
}
if(isset($_POST["handle_submit_update"])){
   
    $id = $announcement_details['id'];
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
        $sql = "UPDATE announcement SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0
            WHERE id=".$id;
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Announcement/announcement_details.php?announcement_id=".$id);
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            unlink("../upload/".$announcement_details['image']);
            unset($_POST['handle_submit_update']);
            
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
    .fa-circle-exclamation{
      font-size: 110px;
      width: fit-content;
      margin-left: 35%;
      padding: 10px;
      margin-top: -15%;
      margin-bottom: 5%;
      background-color: #fff;
      border-radius: 50%;
      position: absolute;
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
            <a href="#" class="link text-white ps-3">GSU</a>
          </li>
          <li class="nav-item ">
            <a href="../SOU/sou_index.php" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="../SDB/sdb_index.php" class="link text-white ps-3">SDB</a>
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
  <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">ANNOUNCEMENT DETAILS</p>
          <p class="tag-sub">Here are the detail of the announcements provided by the Office of Student Affairs (OSA)</p>
        </div>

      </div>
    </div>

  <div class="container pt-5">
    <div class="mt-3">
        <h4><?php echo $announcement_details['title']; ?></h4>
        <p><i class="fas fa-calendar-days"></i> <?php echo $announcement_details['date_created']; ?></p>
    </div>
  </div>

  <div class="container">
      <div class="card mb-3 shadows border">
          <div class="row g-0">
              <div class="col-md-4">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="../upload/<?php echo $announcement_details['image']; ?>" class="card-img" alt=""/>
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text description-left-border">
                      <?php echo $announcement_details['descriptions']; ?>
                    </p>
                </div>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col">
          
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '
                    <button class="btn btn-success fw-semibold" data-mdb-toggle="modal" data-mdb-target="#update_announcement">Update</button>
                    <button class="btn btn-danger fw-semibold" data-mdb-toggle="modal" data-mdb-target="#archive">Archive</button>';
                }
            }else{
                echo '';
            }
          ?>
        </div>
      </div>

  </div>
  <div class="container d-flex justify-content-center">
      <a href="../Announcement/all_announcement.php" class="btn btn-success shadows">View More Announcement</a>
  </div>

  <!-- archive modal -->
  <div class="modal fade" id="archive" tabindex="-1" role="dialog" aria-labelledby="archive" aria-hidden="true">
      <div class="modal-dialog">
          <form method="POST">  
              <div class="modal-content">
                  <div class="modal-header bg-danger text-white p-4">
                      <h5 class="modal-title" id="exampleModalLabel"></h5>
                      <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body ">
                      <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                      <div class="col content-modal mt-5">
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Announcement</h4>
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this announcement?</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-mdb-dismiss="modal">
                          Cancel
                      </button>
                     
                      <button type="submit" name="archive" class="btn btn-danger px-4" >
                          archive
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>

  <!-- Update Announcement -->
  <div class="modal fade" id="update_announcement" tabindex="-1" aria-labelledby="update_announcement" aria-hidden="true">
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
                    <img class="card-img-top movie_input_img" id="output" src="../upload/<?php echo $announcement_details['image']; ?>" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Announcement Title<span class="text-danger"> *</span></label>
                    <input value="<?php echo $announcement_details['title']; ?>" type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control " rows="5" id="description" name="description" minlength="30" maxlength="5000" required><?php echo $announcement_details['descriptions']; ?></textarea>
                </div>
            </div>
            <div class="modal-footer pt-4 ">                  
                <button type="submit" name="handle_submit_update" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
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


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>

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