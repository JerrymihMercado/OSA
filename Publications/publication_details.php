<?php
session_start();
include '../mysql_connect.php';
if (isset($_GET['publication_ID'])) {
    $id = $_GET['publication_ID'];
    $sql = "SELECT * FROM  publish_post WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $publish = mysqli_fetch_assoc($result);
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
        <p class="tag-info">THE PUBLICATION DETAILS</p>
        <p class="tag-sub">Please free to read our new publish</p>
      </div>

    </div>
  </div>

  <!-- <div class="container pt-5">
    <div class="mt-3">
        <h4><?php echo $publish['title'];?></h4>
        <p><i class="fas fa-calendar-days"></i> <?php echo $publish['date_created'];?></p>
    </div>
  </div> -->

  <!-- <div class="container">
      <div class="card mb-3 shadows border">
          <div class="row g-0">
              <div class="col-md-4">
                <div class=" hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="../upload/<?php echo $publish['image']; ?>" class="img-fluid rounded-start" alt="" />
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                    
                    <p class="card-text description-left-border">
                      <?php echo $publish['descriptions'];?>
                    </p>
                    
                    
                </div>
              </div>
          </div>
      </div>
  </div> -->

  <div class="container">
    <img src="../upload/<?php echo $publish['image']; ?>" class="img-fluid rounded" alt="" style="width: 100vw; height: 50vh; object-fit: cover"/>
    <div class="col boder">
      <div class="card-body">
        <div class="row mt-3">
          <div class="col ">
            <h5><?php echo $publish['title'];?></h5>
          </div>
          <div class="col text-muted d-flex justify-content-end">
            <p><?php echo $publish['date_created'];?></p>
          </div>
        </div>
        <p class="card-text description-left-border mt-5">
          <?php echo $publish['descriptions'];?>
        </p>         
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
</div>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>