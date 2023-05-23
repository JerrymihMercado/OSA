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
    .img-blur{
        filter: blur(4px);
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
            <a href="#" class="link text-white ps-3">SOU</a>
          </li>
          <li class="nav-item ">
            <a href="" class="link text-white ps-3">SDB</a>
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
                <h2 class="text-white mb-0">CLSU STUDENT CODE OF CONDUCT AND DISCIPLINE</h2>
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
          <p class="tag-info">CODE OF CONDUCT AND DISCIPLINE</p>
          <p class="tag-sub">Read the student conduct and discipline from the Office of Student Affairs(OSA)</p>
        </div>

      </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center mt-5">
            <a href="https://unsplash.it/1200/768.jpg?image=261" target="_blank" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                <img src="../img/Rectangle 273.png" class="img-fluid shadows">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=260" target="_blank" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                <img src="../img/Rectangle 273.png" class="img-fluid img-blur shadows">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=263" target="_blank" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                <img src="../img/Rectangle 273.png" class="img-fluid img-blur shadows">
            </a>
            <!-- elements not showing, use data-remote or data-src-->
            <div data-toggle="lightbox" data-gallery="hidden-images" data-src="https://unsplash.it/1200/768.jpg?image=264" data-title="Hidden item 1"></div>
            <div data-toggle="lightbox" data-gallery="hidden-images" data-src="https://www.youtube.com/embed/dQw4w9WgXcQ" data-title="Hidden item 2"></div>
            <div data-toggle="lightbox" data-gallery="hidden-images" data-src="https://unsplash.it/1200/768.jpg?image=265" data-title="Hidden item 3"></div>
            <div data-toggle="lightbox" data-gallery="hidden-images" data-src="https://unsplash.it/1200/768.jpg?image=266" data-title="Hidden item 4"></div>
            <div data-toggle="lightbox" data-gallery="hidden-images" data-src="https://unsplash.it/1200/768.jpg?image=267" data-title="Hidden item 5"></div>
        </div>
    </div>

    <?php
       include '../Components/footer.php';
    ?>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>
</html>