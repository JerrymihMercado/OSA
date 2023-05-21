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
            <a href="#" class="link text-white ps-3">ABOUT US</a>
          </li>
          <li class="nav-item ">
            <a href="../Section/impu.php" class="link text-white ps-3">IMPU</a>
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

    <div class="mt-3 p-3">
        <nav aria-label="breadcrumb">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../Section/impu.php">Publication</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
            </nav>
        </nav>
    </div>

    <div class="p-3">
      <h5>CAGawaran: Pasiklabin ang Pusong Aggies 2023</h5>
      <p>05-21-23</p>
    </div>

    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <img src="../img/Rectangle 298.png" class="card-img-top" alt="Palm Springs Road"/>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <img src="../img/Rectangle 298.png" class="card-img-top" alt="Palm Springs Road"/>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="container-fluid mt-5">
      <p>ICYMI | In celebration of 116th Founding Anniversary of Central Luzon State University (CLSU), College of Agriculture (CAg) launched various activities for CAg students, April 11.
      With the theme “CAGarawan: Pasiklabin ang Pusong Aggies” different activities such as tug-of-war, agawang buko, color fun run, and open mic live band were conducted.
      Agawan ng Buko: Akin lang ang BJ Ko
      Winner: Denver Luces
      TIKAS: Tibay at Lakas ng Aggies</p>
    </div>

    <?php
       include '../Components/footer.php';
    ?>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>