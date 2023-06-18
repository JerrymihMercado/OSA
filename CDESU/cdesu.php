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
          header("location:../CDESU/cdesu.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../CDESU/cdesu.php");
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
<body style="background-color: #fdfdfd">
  <?php include '../Components/header.php'; ?>
     
 
  <!-- banner -->
    <div class="bg-image ripple" data-mdb-ripple-color="light">
        <img src="../img/banner1.png" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="d-flex justify-content-center align-items-center h-100 text-center">
                <h2 class="text-white mb-0">Career Development and Employment Services Unit- OSA, CLSU</h2>
            </div>
            </div>
        </a>
    </div> 

    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">LATEST JOB POST</p>
          <p class="tag-sub">See all the latest post from the Career Development and Employment Services Unit- OSA</p>
        </div>
      </div>
    </div>
    <div class="container">
        <a href="../CDESU/cdesu_details.php">
            <div class="mb-3">
                <img src="../img/Under construction-bro.svg" class="card-img-top" alt="Wild Landscape" style="height: 70vh"/>
            </div>
        </a>
    </div>

<?php include_once '../Components/footer.php' ?>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>