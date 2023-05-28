<?php
session_start();
include '../mysql_connect.php';
if (isset($_GET['publication_ID'])) {
    $id = $_GET['publication_ID'];
    $sql = "SELECT * FROM  publication_page WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $publication = mysqli_fetch_assoc($result);
    }
}
if(isset($_POST["handle_submit"])){

    $id = $_GET['publication_ID']; 
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
        $sql = "INSERT INTO publish_post SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            own_by='$id';";
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Publications/publication_page.php?publication_ID=".$id);
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
        <p class="tag-info text-capitalize"><?php echo $publication['title']; ?></p>
        <p class="tag-sub">See all the latest publish here</p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="">
      <?php
        $id = $_GET['publication_ID']; 
        $sql = "SELECT * FROM publish_post WHERE own_by=$id ORDER BY date_created desc limit 1";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="card mb-3 shadows" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                          <img src="../upload/<?php echo $row['image']; ?>" class="card-img" alt="" style="height: 40vh; object-fit: cover;"/>
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

  <div class="container d-flex justify-content-end mb-3">
    <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 1) {
              echo '<button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#add_post">
                      Add Publication Post
                    </button>';
          }
      }else{
          echo '';
      }
    ?>
  </div>

  <div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="add_post" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
               
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../img/avatar.png" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Page Title<span class="text-danger"> *</span></label>
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
        $id = $_GET['publication_ID']; 
        $sql = "SELECT * FROM publish_post WHERE own_by=$id";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
          <div class="col">
              <a href="<?php echo '../Publications/publication_details.php?publication_ID=' . $row['id']; ?>">
                  <div class="card h-100 shadows">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                          <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="clsu-image"/>
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