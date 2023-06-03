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
          header("location:../GSU/gsu_index.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../GSU/gsu_index.php");
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
     
<div class="bg-image ripple" data-mdb-ripple-color="light">
  <img src="../img/banner1.png" class="banner__img" />
  <a href="#!">
      <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
      <div class="d-flex justify-content-center align-items-center h-100 text-center">
          <h2 class="text-white mb-0">Guidance Service Unit (GSU)</h2>
      </div>
      </div>
  </a>
</div>

<div class="container mt-5">
  <div class="osa-tag">
    <p class="tag-info">OVERVIEW</p>
    <p class="tag-sub ">
      This unit provides programs and activities 
      that aim at helping students adjust to college life by helping them 
      understand themselves better, improve interpersonal relationship, make 
      intelligent decisions and prepare for a lifelong career. It provides 
      information to enable the students to explore occupational areas and to 
      identity prospects for employment.
    </p>
  </div>
</div>
<div class="container pt-5">
  <div class="row">
    <div class="osa-tag">
      <p class="tag-info">OFFICIAL WEBSITE PAGE</p>
      <p class="tag-sub">Visit our official website for Student Organizations Unit (SOU)</p>
    </div>
  </div>
</div>
<div class="container p-4">
    <h6 class="fw-bold text-primary">gsu.edu.ph</h6>
</div>

<?php include_once '../Components/footer.php' ?>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>