<?php
session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $email = $_GET['email'];
    $token = $_POST['token'];

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

    $query = "SELECT * FROM verification_token WHERE token = '$token'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if($row['token'] == $token){
            $sql = "SELECT * FROM account
            WHERE email = '$email'";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                
                if($encryption_password == $encryption_confirm_password){
                    $sql = "UPDATE account SET 
                    password='$encryption_password',
                    confirm_password='$encryption_confirm_password'
                    WHERE id=".$row['id'];
            
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['status_success'] = "success";

                    } else {
                        $_SESSION['status_error'] = "error";

                    }
                }else{
                    $_SESSION['status_pass'] = "error";
                }
            } else {
                    $_SESSION['status_error'] = "error";
            }
        }
    }else{
            echo '<script language="javascript">';
            echo 'alert("invalid token")';
            echo '</script>';
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
    <!-- Google Fonts Roboto -->
    
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../Style/style.css">
</head>
<body>
    <div class="container">
        <p>Check your email for token verification, Thank you!</p>
        <form method="POST">
            <div class="form-outline">
                <input type="text" id="token" name="token" class="form-control" />
                <label class="form-label" for="token">Token</label>
            </div>
            <div class="form-outline">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-outline">
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
            <label class="form-label" for="confirm_password">Confirm Password</label>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-success">Reset</button>
            <a href="../index.php">← Login</a>
        </form>
    </div>

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
    ?>
</body>
</html>