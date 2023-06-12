<?php

session_start();
include '../mysql_connect.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_email = openssl_encrypt($email,$ciphering,$encryption_key,$option,$encryption_iv);

    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_password = openssl_encrypt($password,$ciphering,$encryption_key,$option,$encryption_iv);

    $sql = "SELECT * FROM account
      WHERE email = '$encryption_email'
      AND password = '$encryption_password'";
    
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        $ciphering = "AES-128-CTR";
        $option = 0;
        $decryption_key = "info";
        $decryption_iv = '1234567890123456';
        $decryption = openssl_decrypt($row['email'],$ciphering,$decryption_key,$option,$decryption_iv);
        $session_email = $decryption;

        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['email'] = $session_email;
        $_SESSION['course'] = $row['course'];
        
        $_SESSION['role'] = $row['role'];
        
        if ($row['role'] == 1) {    
          header("location:../CDESU/cdesu_details.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../CDESU/cdesu_details.php");
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error'] = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">

    <?php
      include '../Links/link.php';
    ?>
</head>
<body>
  
<div class="logo-header ">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                    <div class="logo mr-xs-3">
                        <img src="../img/clsu-logo.png" alt="" >
                        
                    </div>
                    <div class="logo-text m-xs-0">
                        <span class="logo-title">Central Luzon State University</span>
                        <span class="logo-sub">Science City of Muñoz, Nueva Ecija, Philippines 3120</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include '../Components/header.php'; ?>
  <!-- <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
        <p class="tag-info">PEPSI COMPANY</p>
        <p class="tag-sub">Please read the description of the job from the Career Development and Employment Services Unit- OSA</p>
      </div>
    </div>
  </div>

  <div class="container pt-5">
    <div class="mt-3">
        <h4 class="">Call for Applications for the CHED SCHOLARSHIP PROGRAM FOR FUTURE STATISTICIANS FOR AY 2023-2024.</h4>
        <p class="text-muted">05-22-23</p>
    </div>
  </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="../img/banner1.jpg" class="img-fluid"/>
                        <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                <div class="card-body bg-dark text-white">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card border shadows">
                <div class="card-body">
                    <div class="osa-tag">
                      <p class="tag-info">Job Details</p>
                      <p class="tag-sub">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                </div>
                <div class="card mt-2 border shadows">
                <div class="card-body">
                    <div class="osa-tag">
                      <p class="tag-info">Center Details</p>
                      <p class="tag-sub">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div> -->
<div class="container">
    <div class="mb-3">
        <img src="../img/Under construction-bro.svg" class="card-img-top" alt="Wild Landscape" style="height: 70vh"/>
    </div>
</div>

<?php include_once '../Components/footer.php' ?>
<script src="../js/sweetalert2.js"></script>
  <?php
    if(isset($_SESSION['status_success_admin']) ){
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
        
    }
  ?>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>