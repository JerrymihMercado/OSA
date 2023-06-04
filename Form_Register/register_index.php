<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
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
    
    $str = $email;
    $pattern = "/[A-Za-z]+\.[A-Za-z0-9]+@clsu2\.edu\.ph/i";

    // $pass_regex = "/^.*(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&?@.']).*$/";

    if($count > 0){
        $_SESSION['status_exist'] = "error";
    }
    // else if($encryption_password != $pass_regex){
    //     $_SESSION['status_length'] = "error";
    // }
    else if($encryption_password != $encryption_confirm_password){
        $_SESSION['status_pass'] = "error";
        
    }
    else if(preg_match($pattern, $str)==0){
        $_SESSION['status_invalid_email'] = "error";
    }
    else{
        $sql = "INSERT INTO account SET 
            student_id='$student_id',
            fullname='$fullname',
            gender='$gender',
            college='$college',
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Google Fonts Roboto -->
    
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
<div class="container-fluid">
    <div class="row " >
        <div class="right-side col-md-6 text-center d-none d-md-block">
            <div class="logo-con pt-5">
                <img src="../img/white-logo.png" alt="" style="height: 250px; width: 250px;">
            </div>
            <div class="title-con mt-3 ">
                <h1 class="text-white">CLSU</h1>
                <p class="text-white">OFFICE OF STUDENT AFFAIRS</p>
                <a href="../index.php">
                    <button class="btn btn-light btn-login shadow-0">Login</button>
                </a>
            </div>
            <footer class="footer-left">
                <p class="text-white">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
            </footer>
        </div>
        <div class="col-md-6  pt-4">
            <div class="form-title">
                <h3 class="text-center">Registration for Student</h3>
                <p class="text-center">Please provide all information requested below</p>
            </div>
          
          <div class="form-info container mt-5 px-2">
            <h6>Personal information</h6>
            <form method="POST" class="needs-validation" novalidate>
            <div class="row ">
                <div class="col-md-4 pt-2">
                    <div class="form-outline ">
                        <input type="text" id="student_id" class="form-control" name="student_id" required/>
                        <label class="form-label" for="form12">Student ID</label>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 pt-3">
                    <div class="form-outline ">
                        <input type="text" id="fullname" class="form-control" name="fullname" required/>
                        <label class="form-label" for="form12">Full Name</label>
                    </div>
                    <p id="errorid" class="text-danger"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 pt-3">
                    <select class="form-select" aria-label="Default select example" name="college" id="college" required>
                        <option selected value="0">Choose your college</option>
                        <option value="COLLEGE OF AGRICULTURE">COLLEGE OF AGRICULTURE</option>
                        <option value="COLLEGE OF ARTS AND SOCIAL SCIENCES">COLLEGE OF ARTS AND SOCIAL SCIENCES</option>
                        <option value="COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY">COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY</option>
                        <option value="COLLEGE OF EDUCATION">COLLEGE OF EDUCATION</option>
                        <option value="COLLEGE OF ENGINEERING">COLLEGE OF ENGINEERING</option>
                        <option value="COLLEGE OF FISHERIES">COLLEGE OF FISHERIES</option>
                        <option value="COLLEGE OF HOME SCIENCE AND INDUSTRY">COLLEGE OF HOME SCIENCE AND INDUSTRY</option>
                        <option value="COLLEGE OF VETERINARY SCIENCE AND MEDICINE">COLLEGE OF VETERINARY SCIENCE AND MEDICINE</option>
                        <option value="COLLEGE OF SCIENCE">COLLEGE OF SCIENCE</option>
                    </select>
                </div>
                <div class="col-md-5 pt-3">
                    <select class="form-select" aria-label="Default select example" name="course" id="course"required>
                        <option selected value="">Choose your course</option>
                       
                    </select>
                </div>
            </div>
            
                <div class="row">
                    <div class="col-md-6 pt-3">
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender" required>
                            <option selected >Choose your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>  
                        </select>
                        <p id="error_gender" class="text-danger"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pt-3">
                        <div class="form-outline ">
                            <input type="email" id="email" class="form-control" name="email" required/>
                            <label class="form-label" for="form12">Email</label>
                        </div>
                        <p id="error_email" class="text-danger"></p>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-6 pt-3">
                    <div class="form-outline ">
                        <input type="password"  class="form-control" id="password" name="password" required/>
                        <label class="form-label" for="form12">Password</label>
                    </div>
                    <p id="error_password" class="text-danger"></p>
                </div>
                <div class="col-md-6 pt-3">
                    <div class="form-outline ">
                        <input type="password"  class="form-control" id="confirm_password" name="confirm_password" required/>
                        <label class="form-label" for="form12">Confirm Password</label>
                    </div>
                    <p id="error_confirm_password" class="text-danger"></p>
                    <p id="error_not_match" class="text-warning"></p>
                </div>
            </div>
            <div class="pt-2 button-con">
                <input type="checkbox" onclick="myFunction()"> Show Password
            </div>
            <div class="button-con py-4">
                <button type="reset" class="btn btn">Cancel</button>
                <button type="submit" class="btn btn-success" name="submit">Register</button>
            </div>
          </form>
          </div>
        </div>
        <div class="footer-mobile">
            <footer>
                <p class="m-0">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
            </footer>
        </div>
    </div>
</div>

  <script>
  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x = document.getElementById("confirm_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
$(document).ready(function () {
    $("#college").change(function () {
        var val = $(this).val();
        if (val == "COLLEGE OF AGRICULTURE") {
            $("#course").html("<option value='Bachelor of Science in Agribusiness'>Bachelor of Science in Agribusiness</option><option value='Bachelor of Science in Agriculture'>Bachelor of Science in Agriculture</option>");
        } else if (val == "COLLEGE OF ARTS AND SOCIAL SCIENCES") {
            $("#course").html("<option value='Bachelor of Arts in Filipino'>Bachelor of Arts in Filipino</option><option value='Bachelor of Arts in Literature'>Bachelor of Arts in Literature</option><option value='Bachelor of Arts in Social Sciences'>Bachelor of Arts in Social Sciences</option><option value='Bachelor of Science in Psychology'>Bachelor of Science in Psychology</option><option value='Bachelor of Science in Development Communication'>Bachelor of Science in Development Communication</option>");
        } else if (val == "COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY") {
            $("#course").html("<option value='Bachelor of Science in Accountancy'>Bachelor of Science in Accountancy</option><option value='Bachelor of Science in Business Administration'>Bachelor of Science in Business Administration</option><option value='Bachelor of Science in Entrepreneurship'>Bachelor of Science in Entrepreneurship</option><option value='Bachelor of Science in Management Accounting'>Bachelor of Science in Management Accounting</option>");
        } else if (val == "COLLEGE OF EDUCATION") {
            $("#course").html("<option value='Bachelor of Culture and Arts Education'>Bachelor of Culture and Arts Education</option><option value='Bachelor of Early Childhood Education'>Bachelor of Early Childhood Education</option><option value='Bachelor of Elementary Education'>Bachelor of Elementary Education</option><option value='Bachelor of Secondary Education'>Bachelor of Secondary Education</option>");
        }
        else if (val == "COLLEGE OF ENGINEERING") {
            $("#course").html("<option value='Bachelor of Science in Agricultural and Biosystems Engineering'>Bachelor of Science in Agricultural and Biosystems Engineering</option><option value='Bachelor of Science in Civil Engineering'>Bachelor of Science in Civil Engineering</option><option value='Bachelor of Science in Information Technology'>Bachelor of Science in Information Technology</option><option value='Bachelor of Science in Meteorology'>Bachelor of Science in Meteorology</option>");
        }
        else if (val == "COLLEGE OF FISHERIES") {
            $("#course").html("<option value='Bachelor of Science in Fisheries'>Bachelor of Science in Fisheries</option>");
        }
        else if (val == "COLLEGE OF HOME SCIENCE AND INDUSTRY") {
            $("#course").html("<option value='Bachelor of Science in Fashion and Textile Technology'>Bachelor of Science in Fashion and Textile Technology</option><option value='Bachelor of Science in Hospitality Management'>Bachelor of Science in Hospitality Management</option><option value='Bachelor of Science in Tourism Management'>Bachelor of Science in Tourism Management</option><option value='Bachelor of Science in Food Technology'>Bachelor of Science in Food Technology</option>");
        }
        else if (val == "COLLEGE OF VETERINARY SCIENCE AND MEDICINE") {
            $("#course").html("<option value='Doctor of Veterinary Medicine'>Doctor of Veterinary Medicine</option>");
        }
        else if (val == "COLLEGE OF SCIENCE") {
            $("#course").html("<option value='Bachelor of Science in Biology'>Bachelor of Science in Biology</option><option value='Bachelor of Science in Chemistry'>Bachelor of Science in Chemistry</option><option value='Bachelor of Science in Environmental Science'>Bachelor of Science in Environmental Science</option><option value='Bachelor of Science in Mathematics'>Bachelor of Science in Mathematics</option><option value='Bachelor of Science in Statistics'>Bachelor of Science in Statistics</option>");
        }
        else if (val == "0") {
            $("#course").html("<option value=''>Choose your course</option>");
        }
    });
});
</script>

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




    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>
</html>