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

$sql = "INSERT INTO verification_token SET token='$token';";
 if (mysqli_query($conn, $sql)) {
            // header("location:../Announcement/all_announcement.php");
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            // unset($_POST['handle_submit']);
            
        } else {
            echo mysqli_error($conn);
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
$body = '  <body>
                <div class="fluid-container" style="padding: 5% 20% 10px">
                    <div class="card-box"
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
                                alt="email_logo"
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
                            <h3 class="card-text-content">Good day, <b>Student</b></h3>
                            <p>
                                <b>Token:</b>'.$token.' 
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
    $mail->Subject = "Reset Password";
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
    if ( $mail->Send() ) {
        $_SESSION['status_success_send'] = "success";
        $ciphering = "AES-128-CTR";
        $option = 0;
        $encryption_iv = '1234567890123456';
        $encryption_key = "info";
        $encryption_email = openssl_encrypt($email,$ciphering,$encryption_key,$option,$encryption_iv);
        header("location:../Forgot_Password/forgot_pass.php?email=$encryption_email");
    }else{
        echo 'Message could not be sent. Mailer Error: '[$mail->ErrorInfo];
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
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">
    <?php
      include '../Links/link.php';
    ?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col border">
            <form method="POST">
                <div class="form-outline">
                    <input type="email" id="email_reset_pass"  name="email_reset_pass" class="form-control" />
                    <label class="form-label" for="email_reset_pass">Email</label>
                </div>
                <button class="btn btn-danger mt-4" name="reset">Send Verification</button>
            </form>
        </div>
        <div class="col border">
            image here
        </div>
    </div>
</div>

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