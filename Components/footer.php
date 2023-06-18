<div class="mt-5 footer-section " >
    <footer class="text-center text-lg-start bg-light text-muted " style="background-image: url(../img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">
        <section class="">
        <div class="container-fluid text-md-start pt-3 px-5">
            <div class="row mt-3" >
            <div class="col-md-4 mx-auto mb-4">
                <img src="../img/white-logo.png" alt="" class="footer-logo text-center" style="height: 88px;">
                <h4 class="text-white fw-semibold mt-2">OFFICE OF STUDENT AFFAIRS</h5>
                <p class="text-white fw-light">Science City of Muñoz, Nueva Ecija</p>
                <small class="text-white fw-light" style="font-size: 13px;">© Copyright 2023 Central Luzon State University All Rights Reserved</small>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <h5 class="text-uppercase fw-semibold mb-4 " style="color: #cdfb13;">Contact</h5>
                <p class="text-white"><i class="fas fa-location-dot "></i> Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines</p>
                <p class="text-white">
                <i class="fas fa-envelope me-3 "></i>
                osa@clsu.edu.ph
                </p>
                <p class="text-white"><i class="fas fa-phone me-3 "></i> (044) 940 7030</p>
            </div>          
            <div class="col-auto mx-auto mb-4">
                <h5 class="text-uppercase fw-semibold mb-4" style="color: #cdfb13;">
                SOCIAL MEDIA
                </h5>
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
            </div>
        </div>
        </section>
    </footer>
</div>
<script src="../js/sweetalert2.js"></script>
    <?php
      if(isset($_SESSION['status_success_admin']) ){ ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Welcome Back Admin!'
            })
        </script>
        <?php
            unset($_SESSION['status_success_admin']);
    }
    if(isset($_SESSION['status_success_user']) ){
        ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Welcome <?php echo $_SESSION['fullname']?>!'
            })
        </script>
        <?php
        unset($_SESSION['status_success_user']);
    }
    
    if(isset($_SESSION['status_error'])){
        ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'error',
            title: 'Credentials error'
            })

        </script>
        <?php
        unset($_SESSION['status_error']);
    }
    if(isset($_SESSION['status_success_send']) ){ ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Email Send!'
            })
        </script>
        <?php
            unset($_SESSION['status_success_send']);
    }
    if(isset($_SESSION['status_success_added']) ){ ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Record Successfully Added!'
            })
        </script>
        <?php
            unset($_SESSION['status_success_added']);
    }
    if(isset($_SESSION['status_success_update']) ){
        ?>
        <script>
             const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Record Successfully Updated!'
            })

        </script>
        <?php
        unset($_SESSION['status_success_update']);
    }
    if(isset($_SESSION['status_success_archive']) ){
        ?>
        <script>
             const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Record Successfully Archive!'
            })

        </script>
        <?php
        unset($_SESSION['status_success_archive']);
    }
    if(isset($_SESSION['status_success_unarchive']) ){
        ?>
        <script>
             const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: 'Record Successfully Unarchive!'
            })

        </script>
        <?php
        unset($_SESSION['status_success_unarchive']);
    }
?>