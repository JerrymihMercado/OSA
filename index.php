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
    <?php include './Components/header.php'?>

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
      <h4 class="announce text-white pt-2">ANNOUNCEMENTS</h4>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col">
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
  <?php include './Components/footer.php'?>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
