<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="#" class="link text-white ps-3">IMPU</a>
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
          <li class="nav-item ">
            <a href="#" class="link text-white ps-3">LOGIN</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

    <!-- banner -->
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="../img/clsu-1.jpg" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="d-flex justify-content-center align-items-center h-100 text-center">
                <h2 class="text-white mb-0">INFORMATION MANAGEMENT AND PUBLICATION UNIT</h2>
            </div>
            </div>
            <!-- <div class="hover-overlay">
            <div class="mask" style="background-color: hsla(0, 0%,98%, 0.2)"></div>
            </div> -->
        </a>
    </div>

    <!-- brief history -->
    <!-- <div class="p-5 text-center">
        <p>"This unit is designed to assist in the best practice of student affairs and
        services in the university through the aid of research, publication and
        information management. The IMPU shall be responsible for the collection,
        organization, and control over the planning, processing, evaluating and
        reporting of relevant information in order to meet client objectives and to
        enable efficient and effective delivery of services."</p>
    </div> -->

    <!-- student handbook -->
    <!-- <div class="p-2 col-sm-2 card_title text-white">
        <h5>Student Handbook</h5>
    </div> -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">STUDENT HANDBOOK</p>
          <p class="tag-sub">Read the student handbook from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>
    <div class="mt-3 container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card shadows">
                    <div class="card-body">
                        <h5 class="card-title">Handbook</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-auto">
                        <h6>Student_handbook.pdf</h6>
                    </div>
                    <div class="col-md justify-content-end d-flex">
                        <a href="#" class="btn btn-danger">Download</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadows">
                <div class="card-body">
                    <h5 class="card-title">Links</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- publication -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">PUBLICATION</p>
          <p class="tag-sub">See all the publication from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
          <a href="../Publications/all_publications.php">
            <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
          </a>
      </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <a href="../Publications/publication_details_1.php">
                  <div class="card h-100 shadows">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      <img src="../img/clsu-1.jpg" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.
                        </p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col">
                <div class="card h-100 shadows">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      <img src="../img/clsu-1.jpg" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Research and evaluation -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">RESEARCH AND EVALUATION</p>
          <p class="tag-sub">See all the research and evaluation from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
          <a href="../Research_&_Evaluation/reasearch_page_1.php">
            <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
          </a>
      </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <a href="../Research_&_Evaluation/reasearch_details_1.php">
                  <div class="card h-100 shadows">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="../img/clsu-1.jpg" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.
                        </p>
                    </div>
                  </div>
                </a>
            </div>
            <div class="col">
                <div class="card h-100 shadows">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      <img src="../img/clsu-1.jpg" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                </div>
                </div>
            </div>
        </div>
    </div>  

    <?php
       include '../Components/footer.php';
    ?>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>