<?php
session_start();
include '../mysql_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



if(isset($_POST['reset'])){
    require '../includes/PHPMailer.php';
    require '../includes/SMTP.php';
    require '../includes/Exception.php';

    $email = $_POST['email_reset_pass'];
    $token = uniqid();
    $_SESSION['token'] = $token;

    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_email = openssl_encrypt($email,$ciphering,$encryption_key,$option,$encryption_iv);

    $sql = "SELECT * FROM account
      WHERE email = '$encryption_email'";
    
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
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $session_email;
        

    }
$body = '<body style="background-color: #fdfdfd">
            <div class="fluid-container" style="padding: 5% 20% 10px">
                <div
                    class="card-box"
                    style="
                        display: block;
                        justify-content: center;
                        border: 1px solid #f5f5f5f5;
                        border-radius: 10px;
                    "
                >
                    <div
                        class="img-card"
                        align="center"
                        style="width: 100%; margin-top: 30px"
                    >
                        <img
                            src="https://i.imgur.com/DTcwEeE.png"
                            alt="emailSend"
                            style="height: 150px"
                        />
                    </div>
                    <div
                        class="card-body-container"
                        style="width: 84%; margin: 8% 0% 0% 8%"
                    >
                        <h1
                            class="card-title-name"
                            align="center"
                            style="color: #006000"
                        >
                            Forgot Password
                        </h1>
                        <br />
                        <p class="card-text-content">Hi, <b>'.@$_SESSION['fullname'].'</b></p>
                        <p>
                            A request to reset password was received from
                            <b>OSA Portal System</b> associated with your
                            <span style="color: #006000; text-decoration: none"
                                ><b>'.$email.'</b></span
                            >
                            account.
                        </p>
                        <h3>Token: '.$token.' </h3>

                        <p align="center">
                            If you did not initiate this request, please ignore this
                            email. No changes have been made to your account yet.
                        </p>
                    </div>
                    <div
                        class="card-footer-name"
                        align="center"
                        style="
                            background: #006000;
                            color: #ffff;
                            border-radius: 3px;
                            padding: 10px;
                        "
                    >
                        <b>CLSU | Office of Student Affairs</b>
                    </div>
                </div>
            </div>
        </body>';
//Create instance of PHPMailer
    $mail = new PHPMailer();
//Set mailer to use smtp
    $mail->isSMTP();
//Define smtp host
    $mail->Host = "smtp.gmail.com";
//Enable smtp authentication
    $mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
//Port to connect smtp
    $mail->Port = "587";
//Set gmail username
    $mail->Username = "noreply.clsu.osa@gmail.com";
//Set gmail password
    $mail->Password = "vxysdrlygvebegfg";
//Email subject
    $mail->Subject = "Verification Code";
//Set sender email
    $mail->setFrom('noreply.clsu.osa@gmail.com');
//Enable HTML
    $mail->isHTML(true);
//Attachment
    // $mail->addAttachment('img/attachment.png');
//Email body
    $mail->Body = $body;
//Add recipient
    $mail->addAddress($email);
    // $mail->addAddress('noreply.clsu.osa@gmail.com');
//Finally send email
    if($email != @$_SESSION['email']){
        $_SESSION['status_notfound'] = 'error';
        // error_reporting(E_ERROR | E_WARNING | E_PARSE); 
    }else{
        $mail->Send();
        header("location:../Forgot_Password/forgot_pass.php?email=$encryption_email&id=".$_SESSION['id']);
    }
           
//Closing smtp connection
    $mail->smtpClose();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSA | Forgat Password</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">
    <?php
      include '../Links/link.php';
    ?>
</head>
<style>
.load{
    display: none;
}
.show{
    display: block;
}
.error_message{
    display: none;
}
</style>
<body style="background-color: #fdfdfd">
<div class="container-fluid">
    <div class="row " >
        <div class="right-side col-md-6 text-center d-none d-md-block">
            <div class="logo-con pt-5">
                <img src="../img/white-logo.png" alt="" style="height: 250px; width: 250px;">
            </div>
            <div class="title-con mt-4">
                <h1 class="text-white">CLSU</h1>
                <p class="text-white">OFFICE OF STUDENT AFFAIRS</p>
                <!-- <a href="../index.php">
                    <button class="btn btn-light btn-login shadow-0">Login</button>
                </a> -->
            </div>
            <footer class="footer-left">
                <p class="text-white">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
            </footer>
        </div>
        <div class="col-md-6 mt-4">
            <div class="form-title px-5">
                <a href="../index.php" class="text-dark">
                    <i class="fas fa-arrow-left-long"></i> Back
                </a>
                <h3 class="text-center fw-semibold mt-5">Reset Password</h3>
                <p class="text-center">Enter the email associated with your account and  we'll send an email with instructions to reset your password.</p>
            </div>
            <div class="col px-5">
                <div class="container mt-5">
                <!-- <p>Check your email for token verification, Thank you!</p> -->
                    <form method="POST">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email_reset_pass" name="email_reset_pass" class="form-control" required/>
                            <label class="form-label" for="email_reset_pass">Email</label>
                        </div>
                        <div class="error_message">
                            <div class="alert alert-danger justify-content-center d-flex" role="alert">
                                Please Enter Email Address
                            </div>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" name="reset" class="btn btn-dark btn-block show shadow-0" onclick="spinner()">Send Verification Code</button>
                        <button class="btn btn-dark btn-block load" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
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
<script type="text/javascript">               
    function spinner() {
        let email = document.getElementById('email_reset_pass').value;
        if(email == ''){
            document.getElementsByClassName("error_message")[0].style.display = "block";
        }
        else{
            document.getElementsByClassName("load")[0].style.display = "block";
            document.getElementsByClassName("show")[0].style.display = "none";
            document.getElementsByClassName("error_message")[0].style.display = "none";
        }
    }
</script>  
<script src="../js/sweetalert2.js"></script>
    <?php
      
    
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
    if(isset($_SESSION['status_notfound'])){
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
            title: 'Email address not found'
            })

        </script>
        <?php
        unset($_SESSION['status_notfound']);
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
    ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>
</html>