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
        <p class="tag-info">THE FLOWMAN</p>
        <p class="tag-sub">See all the latest publish here</p>
      </div>

    </div>
  </div>

    <div class="container">
      <div class="p-2">
        <div class="card mb-3 bg-success text-white shadows" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      <img
                        src="../img/Rectangle 290.png"
                        alt="Trendy Pants and Shoes"
                        class="img-fluid rounded-start"
                      />
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </div>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.
                        </p>
                        <p class="card-text">
                        <small class="text-white">Last updated 3 mins ago</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
                    
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                 
                  </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                </div>
                </div>
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
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
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