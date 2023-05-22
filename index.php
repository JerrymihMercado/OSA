<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Office of Student Affairs</title>
    <link rel="stylesheet" href="./Style/style.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body>
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
            <a href="index.php" class="link-home text-white">HOME</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">ABOUT US</a>
          </li>
          <li class="nav-item ">
            <a href="Section/impu.php" class="link text-white ps-3">IMPU</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">CDESU</a>
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
          <li class="nav-item">
            <a href="" class="text-white ps-3 " data-mdb-toggle="modal" data-mdb-target="#login_Modal">
              LOGIN
            </a>
          </li>
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
          <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100" alt="Camera"/>
        </div>
        <div class="carousel-item">
          <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits"/>
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

  <div class="container-fluid pt-5">
    <div class="row">
      <h4 class="announcement text-white pt-2">ANNOUNCEMENTS</h4>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
      <a href="#" class="d-flex justify-content-end p-2">VIEW ALL</a>
        <div class="card">
          <div class="card-body shadow-2">
            <div class="row">
              <div class="col-2">
              <img src="img/testing.jpg" alt="" class="card-img content-img">
              </div>
              <div class="col-9 ps-3">
                <h5 class="pt-4">NEWS I AD Scientific Index: CLSU Ranks 13th, 70 Faculty & Staff Researchers Make it to the List of CLSU Best Scientists</h5>
                <button class="btn btn-success">VIEW DETAILS</button>              
              </div>
              <div class="col-1">
                <p>05-05-2023</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
          <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" class="form-control" />
              <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="password" class="form-control" />
              <label class="form-label" for="password">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              
                  <a href="#!">Forgot password?</a>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Login</button>
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
