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

   <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">RESEARCH & EVALUATION DETAILS</p>
          <p class="tag-sub">Please read the details of R&E from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="mt-3">
        <h4>CAGawaran: Pasiklabin ang Pusong Aggies 2023</h4>
        <p><i class="fas fa-calendar text-success"></i> 05-22-23</p>
    </div>
    </div>

    <div class="container">
        <div class="card shadows mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                <img
                    src="../img/announcement_img.png"
                    alt="Trendy Pants and Shoes"
                    class="img-fluid rounded-start"
                />
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                    ICYMI | In celebration of 116th Founding Anniversary of Central Luzon State University (CLSU), College of Agriculture (CAg) launched various activities for CAg students, April 11.
                    With the theme “CAGarawan: Pasiklabin ang Pusong Aggies” different activities such as tug-of-war, agawang buko, color fun run, and open mic live band were conducted.
                    Agawan ng Buko: Akin lang ang BJ Ko
                    Winner: Denver Luces
                    TIKAS: Tibay at Lakas ng Aggies
                    </p>
                    
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