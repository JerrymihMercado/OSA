<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
      include '../Links/link.php';
    ?>
</head>
<body>
  
    <?php
        include '../Components/header.php';
    ?>

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
                <li class="breadcrumb-item"><a href="../index.php">Publication</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All</li>
            </ol>
            </nav>
        </nav>
    </div>

    <div class="container-fluid mt-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100">
                <img src="../img/clsu-1.jpg" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                    This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.
                    </p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="../img/clsu-1.jpg" class="card-img-top" alt="Palm Springs Road"/>
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