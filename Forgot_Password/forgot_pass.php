<?php
session_start();
include '../mysql_connect.php';

// if(isset($_SESSION['token'])){
//     header("location:../Forgot_Password/forgot_pass.php");
// }

if (isset($_POST['submit'])) {
    $email = $_GET['email'];
    $token = $_POST['token'];
    $id = $_GET['id'];

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_password = openssl_encrypt($password,$ciphering,$encryption_key,$option,$encryption_iv);

    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_confirm_password = openssl_encrypt($confirm_password,$ciphering,$encryption_key,$option,$encryption_iv);

    $regex_pass = '/^\S*(?=\S{6,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[!@#$%^&*? ])\S*$/';
    if($_SESSION['token'] != $token){
        $_SESSION['status_token'] = "error";
    }
    else if($encryption_password != $encryption_confirm_password){
        $_SESSION['status_pass'] = "error";
    }
    else if(preg_match($regex_pass, $password)==0){
        $_SESSION['status_length'] = "error"; 
    }
    else{
        $sql = "UPDATE account SET 
                password='$encryption_password',
                confirm_password='$encryption_confirm_password'
                WHERE id=".$id;
                unset($_SESSION['token']); 
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['status_success'] = "success";
                    header( "refresh:3;url=../index.php" );

                } else {
                    $_SESSION['status_error'] = "error";

                }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSA | Forgot Password</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
     <?php include '../Links/link.php' ?> 
    <link rel="stylesheet" href="../Style/style.css">
</head>
<body style="background-color: #fdfdfd">
<div class="container-fluid">
    <div class="row " >
        <div class="right-side col-md-6 text-center d-none d-md-block">
            <div class="logo-con pt-5">
                <img src="../img/white-logo.png" alt="" style="height: 250px; width: 250px;">
            </div>
            <div class="title-con mt-4">
                <h1 class="text-white">CLSU</h1>
                <p class="text-white">OFFICE OF STUDENT AFFAIRS </p>
            </div>
            <footer class="footer-left">
                <p class="text-white">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
            </footer>
        </div>
        <div class="col-md-6  pt-4">
            <div class="form-title px-5">
                <a href="../index.php" class="text-dark">
                    <i class="fas fa-arrow-left-long"></i> Back
                </a>
                <h3 class="text-center fw-semibold">Create new password</h3>
                <p class="text-center">Your new password must be different from previous used passwords.</p>
            </div>
            <div class="col px-5 mt-5">
                <div class="container">
                <!-- <p>Check your email for token verification, Thank you!</p> -->
                <form method="POST">
                    <!-- token -->
                    <div class="form-outline mb-4">
                        <input type="text" id="token" name="token" class="form-control" required/>
                        <label class="form-label" for="token">Token</label>
                    </div>
                    <!-- Password -->
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" required/>
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <!-- Confirm Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required/>
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Reset Password</button>
                </form>
                </div>
            </div>
        </div>
        <div class="footer-mobile">
            <footer>
                <p class="m-0">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
            </footer>
        </div>
    </div>
</div>
    
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="../js/sweetalert2.js"></script>
    <?php
    if(isset($_SESSION['status_success']) ){
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
            title: 'Password Successfully Reset!'
            })

        </script>
        <?php
        unset($_SESSION['status_success']);
    }
    
    if(isset($_SESSION['status_error'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
           
            })

        </script>
        <?php
        unset($_SESSION['status_error']);
    }
    if(isset($_SESSION['status_exist'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email is already registered',
           
            })

        </script>
        <?php
        unset($_SESSION['status_exist']);
    }
    if(isset($_SESSION['status_pass'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Password Not Match',
           
            })

        </script>
        <?php
        unset($_SESSION['status_pass']);
    }
    if(isset($_SESSION['status_token'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid token or not match',
           
            })

        </script>
        <?php
        unset($_SESSION['status_token']);
    }
    if(isset($_SESSION['status_invalid_email'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid Email clsu account only!',
           
            })

        </script>
        <?php
        unset($_SESSION['status_invalid_email']);
    }
    if(isset($_SESSION['status_length'])){
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The password must 8 character long that consist of Capital, small letters, numbers, symbols.',
           
            })

        </script>
        <?php
        unset($_SESSION['status_length']);
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
            session_unset($_SESSION['status_success_send']);
    }
    ?>
</body>
</html>