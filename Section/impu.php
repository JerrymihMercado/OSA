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

    <!-- brief history -->
    <div class="p-5 text-center">
        <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores dolorem, cupiditate hic consequatur aspernatur ut ratione fuga vel recusandae dolorum repellat! Asperiores delectus neque ipsam! Vero dolore qui veritatis perspiciatis. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate necessitatibus, perspiciatis culpa consectetur debitis iure quas facilis, quos sed esse reiciendis expedita unde cupiditate ipsum temporibus alias obcaecati nesciunt rem!"</p>
    </div>

    <!-- student handbook -->
    <div class="p-2 col-sm-2 card_title text-white">
        <h5>Student Handbook</h5>
    </div>
    

    <div class="mt-3 container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
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
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Links</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- publication -->
    <div class="mt-3 p-2 col-sm-2 card_title text-white">
        <h5>Publication</h5>
    </div>
    <div class="col justify-content-end d-flex p-3">
        <a href="./all_publications.php">View all</a>
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
    <!-- Research and evaluation -->
    <div class="mt-3 p-2 col-sm-2 card_title text-white">
        <h5>Research and Evaluation</h5>
    </div>
    <div class="col justify-content-end d-flex p-3">
        <a href="#!">View all</a>
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