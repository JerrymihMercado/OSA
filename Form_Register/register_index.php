<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 0;

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
    
    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_iv = '1234567890123456';
    $encryption_key = "info";
    $encryption_confirm_password = openssl_encrypt($confirm_password,$ciphering,$encryption_key,$option,$encryption_iv);
    
    $check_user = "SELECT * FROM account
      WHERE email = '$encryption_email'";

    $check_result = mysqli_query($conn, $check_user);
    $count = mysqli_num_rows($check_result);
    
     
    if($count > 0){
        $_SESSION['status_exist'] = "error";

    }
    else{
        $sql = "INSERT INTO account SET 
            fullname='$fullname',
            gender='$gender',
            course='$course',
            email = '$encryption_email',
            password='$encryption_password',
            confirm_password='$encryption_confirm_password',
            role='$role';";
    
            if (mysqli_query($conn, $sql)) {
                $_SESSION['status_success'] = "success";

                
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
    <title>OSA | Register Account</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
     <?php include '../Links/link.php' ?> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../Style/style.css">
</head>
<style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }
    .form-outline .error input{
        border-color:red;
    }
    .form-outline .error{
        color: red;
}
  </style>
<body>
   

    <div class="container">
        

        <div class="p-4">
            <div>
                <h4 class="fw-bold">Register Your Account</h4>
                <p class="text-muted">Please <span class="text-primary"><a href="../index.php">Login</a></span> if you already have an account.</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-5 pt-5">
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" class="form-control form-control-lg" id="fullname" name="fullname" required/>
                                <label for="fullname" class="form-label" >Fullname</label>
                            </div>
                            <p id="errorid" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" id="gender" name="gender" required />
                            <label for="gender" class="form-label">Gender</label>
                            </div>
                            <p id="error_gender" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" id="course" name="course" required />
                            <label for="course" class="form-label">course</label>
                            </div>
                            <p id="error_course" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required />
                            <label for="email" class="form-label">Email</label>
                            
                            </div>
                            <p id="error_email" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required/>
                            <label for="password" class="form-label">Password</label>
                            </div>
                            <p id="error_password" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required/>
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                            </div>
                            <p id="error_confirm_password" class="text-danger"></p>
                            <p id="error_not_match" class="text-warning"></p>
                        </div>
                        <div class="col">
                            <button class="btn btn-light fw-semibold shadows" type="submit" name="submit" style="width: 100%;">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <img src="../img/register.svg" alt="">
                </div>
            </div>
        </div>
     
    </div>

    <script>
        (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
        // function checkPassword(form) {
        //         fullname = form.fullname.value;
        //         gender = form.gender.value;
        //         course = form.course.value;
        //         email = form.email.value;
        //         password = form.password.value;
        //         confirm_password = form.confirm_password.value;

        //         let regex = /[A-Za-z]+\.[A-Za-z0-9]+@clsu2\.edu\.ph/i;

        //         if (fullname == '')
        //             document.getElementById("errorid").innerHTML = "Enter your full name";
        //         if (gender == '')
        //             document.getElementById("error_gender").innerHTML = "Enter your gender";
        //         if (course == '')
        //             document.getElementById("error_course").innerHTML = "Enter your course";
        //         if (email == '')
        //             document.getElementById("error_email").innerHTML = "Enter your email";
        //         if (password == '')
        //             document.getElementById("error_password").innerHTML = "Enter your password";
        //         if (confirm_password == '')
        //             document.getElementById("error_confirm_password").innerHTML = "Enter your confirm password";

        //         if(regex.test(email)){
        //             alert("true");
        //         }
                    
                
        //         else if(email != regex.test(email)){
        //             alert ("\nEmail is not valid") 
        //         }
                    

                
        //         if (password != confirm_password) {
        //             document.getElementById("error_not_match").innerHTML = "Enter your password again";

        //         }
  
        //         else{
        //             return true;
        //         }
        // }
       
    </script>
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
            title: 'Record Successfully Added!'
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
    ?>




    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>
</html>