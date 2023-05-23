<?php

session_start();
include 'mysql_connect.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    $sql = "SELECT * FROM login
      WHERE email = '$username'
      AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $username;
        $_SESSION['is_admin'] = $row['is_admin'];
        

        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
                if ($row['is_admin'] == 1) {    
                    echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
                    header("location:index.php#login");
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Office of Student Affairs</title>
    <link rel="stylesheet" href="./Style/style.css">
    <!-- <link rel="stylesheet" href="./Style/style_about.css"> -->
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active{
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }
  </style>
  <body>
    <!-- Start your project here--> 
    <!-- Start your project here-->
    <div class="container-fluid header-title">
    <div class="row">
      <div class="col-md-1 ">
        <img src="./img/clsu-logo.png" alt="" class="logo">
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
            <a href="index.php" class="link-home text-white active">HOME</a>
          </li>
          <li class="nav-item ">
            <a href="about_us.php" class="link text-white ps-3">ABOUT US</a>
          </li>
          <li class="nav-item ">
            <a href="Section/impu.php" class="link text-white ps-3">IMPU</a>
          </li>
          <li class="nav-item ">
            <a href="CDESU/cdesu.php" class="link text-white ps-3">CDESU</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">GSU</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">SDB</a>
          </li>
          <!-- <li class="nav-item ">
            <a href="#" class="link text-white ps-3" >LOGIN</a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="" class="text-white ps-3 " data-mdb-toggle="modal" data-mdb-target="#login_Modal">
              LOGIN
            </a>
          </li> -->
          <?php
                        if (isset($_SESSION['is_admin'])) {
                            if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 0) {
                                echo ' <li class="nav-item">
            
                                    <form action="logout.php" method="POST">
                                        <button name="logout" class="btn btn-danger"  > Logout</button>
                                    </form>
                                
          </li>';
                                
                            }
                        } else {
                            echo '  <li class="nav-item">
            <a href="" class="text-white ps-3 " data-mdb-toggle="modal" data-mdb-target="#login_Modal">
              LOGIN
            </a>
          </li>';
                                    
                        }

                        ?>
        </ul>
      </nav>
    </div>
  </div>

  <div class="carousel-section">
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/banner1.png" class="d-block w-100" alt="Wild Landscape"/>
        <div class="carousel-caption ">
          <h1>OFFICE OF STUDENT AFFAIRS</h1>
          <p>The Office for Student Affairs takes charge of the campus life of the students, 
              their welfare and discipline, and dormitory facilities. As such, it guides and 
              supervises the recognized student organizations, the student councils, the 
              COMELECs; and conducts capability-building seminars for the organization 
              advisers. The OSA looks into all student-initiated and student-related 
              activities.
          </p>
          <div class="pt-5">
            <button class="btn btn-success">Read More</button>
          </div>
        </div>
      </div>
        <div class="carousel-item">
          <img src="img/banner2.png" class="d-block w-100" alt="Camera"/>
          <div class="carousel-caption ">
            <h1>CLSU MENTAL HEALTH PROVIDERS</h1>
            <p>The Guidance Services Unit of OSA is providing online and  tele counseling services for all CLSU students. Counselors and mental health professionals can be reached by students through their Messenger account and mobile numbers.
            </p>
            <div class="pt-5">
              <button class="btn btn-success">Read More</button>
            </div>
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
          <p class="tag-info">ANNOUNCEMENT</p>
          <p class="tag-sub ">Read the latest announcemnet from the Office of Student Affairs(OSA)</p>
        </div>

      </div>

    </div>
  <div class="container">
  <div class="col justify-content-end d-flex p-3">
      <a href="Announcement/all_announcement.php">View all</a>
  </div>             
  </div>
  <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-5 h-100">
            
            <div class="row no-gutter">
              <div class="col-md-3 card-pic">
                <!-- <img src="img/Rectangle 266.png" class="card-img-top card-image" alt="Hollywood Sign on The Hill"/> -->
                  <img src="img/osa-picture.jpg" alt="" class="pic card-img  ">
              </div>
              <div class="col-md-9">
                <div class="card-body ">
                  <h5 class="text-success">OSA MISSION</h5>
                  <div class="borders" >
                    <p class="text-muted ">05-22-23</p>
                    <p class=" mission-info1">OSA shall promote the development of the students’ talents,
                      potentials and leadership capabilities through its program thrusts that promote
                      self- awareness, self-growth and development, self- management, cooperative
                      </p>
                      
                          <button type="button" class="btn btn-success shadow" data-mdb-ripple-color="dark">View Details</button>
                    </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  <!-- <div class="p-2">
    <div class="container mt-4">
        <div class="col g-4">
            <div class="card mb-3" style="max-width: 100%;">
              <div class="row g-0">
                  <div class="col-md-4">
                      <img
                          src="./img/osa-picture.jpg"
                          alt="Trendy Pants and Shoes"
                          class="img-fluid rounded-start"
                      />
                      </div>
                      <div class="col-md-8">
                      <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">
                          This is a wider card with supporting text below as a natural lead-in to
                          additional content. This content is a little bit longer.
                          </p>
                          <p class="text-muted">05-22-23</p>
                          <button type="button" class="btn btn-success shadow" data-mdb-ripple-color="dark">View Details</button>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card mb-3" style="max-width: 100%;">
              <div class="row g-0">
                  <div class="col-md-4">
                      <img
                          src="./img/osa-picture.jpg"
                          alt="Trendy Pants and Shoes"
                          class="img-fluid rounded-start"
                      />
                      </div>
                      <div class="col-md-8">
                      <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">
                          This is a wider card with supporting text below as a natural lead-in to
                          additional content. This content is a little bit longer.
                          </p>
                          <p class="text-muted">05-22-23</p>
                          <button type="button" class="btn btn-success shadow" data-mdb-ripple-color="dark">View Details</button>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
        
  </div> -->

  <!-- login modal -->
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#login_Modal">
    Launch demo modal
  </button> -->

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
              <input type="text" id="username" name="username" class="form-control" />
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


  <?php include './Components/footer.php'?>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
