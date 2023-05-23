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
    .chat-bot{
        position: -webkit-sticky; /* Safari */
        position: sticky;
        bottom: 0;        
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

    
    <div class="p-5 chat-bot d-flex justify-content-end">
        <button type="button" class="btn btn-success btn-lg btn-floating" data-mdb-toggle="modal" data-mdb-target="#chatModal">
            <i class="fas fa-comment"></i>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="chatModal">Chat Me</h5>
                <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-start mb-4">
                        <img src="../img/avatar.png"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                        <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                            <p class="small mb-0">Hello and thank you for visiting MDBootstrap. Please click the video
                                below.</p>
                        </div>
                        </div>

                        <div class="d-flex flex-row justify-content-end mb-4">
                            <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                            <p class="small mb-0">Thank you, I really like your product.</p>
                            </div>
                            <img src="../img/Dude Crew (900 × 500 px).png"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        </div>
                        <div class="form-outline">
                            <textarea class="form-control" id="textAreaExample" rows="4"></textarea>
                            <label class="form-label" for="textAreaExample">Type your message</label>
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    

    <div class="mt-5 footer-section " >
        <footer class="text-center text-lg-start bg-light text-muted ">
        
            <!-- Section: Links  -->
            <section class="" style="background-image: url(../img/banner1.png);  background-size:100rem, 100rem; background-repeat: no-repeat;align-items: center; ">
            <div class="container-fluid  text-md-start pt-3 ">
                <!-- Grid row -->
                <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <img src="../img/clsu-logo.png " alt="" class="footer-logo text-center" style=" width: 5.5rem;">
                    
                    <p class="text-white" style="font-size: 25px; font-weight:500;">OFFICE OF STUDENT AFFAIRS</p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 " style="color: #cdfb13;">Contact</h6>
                    <p class="text-white"><i class="fas fa-location-dot "></i> Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines</p>
                    <p class="text-white">
                    <i class="fas fa-envelope me-3 "></i>
                    osa@clsu.edu.ph
                    </p>
                    <p class="text-white"><i class="fas fa-phone me-3 "></i> (044) 940 7030</p>
                    <!-- <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> -->
                </div>
                <!-- Grid column -->
                
                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4" style="color: #cdfb13;">
                    SOCIAL MEDIA
                    </h6>
                    <div>
                    <a href="https://www.facebook.com/officeofstudentaffairsCLSU" target="_blank" class="me-3 text-reset">
                        <i class="fab fa-facebook-square fa-lg text-white"></i>
                    </a>
                    <a href="https://twitter.com/clsu_official?lang=en" target="_blank" class="me-3 text-reset">
                        <i class="fab fa-twitter fa-lg text-white"></i>
                    </a>
                    <a href="" class="me-3 text-reset">
                        <i class="fab fa-google fa-lg text-white"></i>
                    </a>
                    <a href="" class="me-3 text-reset">
                        <i class="fab fa-instagram fa-lg text-white"></i>
                    </a>
                    <a href="" class="me-3 text-reset">
                        <i class="fab fa-linkedin fa-lg text-white"></i>
                    </a>
                    
                    </div>
                </div>
                <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-1 text-white" style="background: -webkit-linear-gradient(0deg, #008102, #93d12d);">
            © Copyright 2023 Central Luzon State University All Rights Reserved
            <!-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a> -->
            </div>
            <!-- Copyright -->
        </footer>
    </div>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>
</html>