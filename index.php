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
  <?php include './header.php'?>

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

  <div class="p-2 col-sm-2 card_title text-white mt-5">
    <h5>Announcement</h5>
  </div>
  <div class="col justify-content-end d-flex p-3">
      <a href="Announcement/all_announcement.php">View all</a>
  </div>
  <div class="p-2">
    <div class="container-fluid mt-4">
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
