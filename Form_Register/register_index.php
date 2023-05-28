<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $email = $_POST['email'];

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 0;

    $check_user = "SELECT * FROM account
      WHERE email = '$email'";

    $check_result = mysqli_query($conn, $check_user);
    $count = mysqli_num_rows($check_result);
    
    if($count > 0){
        echo '<script language="javascript">';
        echo 'alert("email is already register!")';
        echo '</script>';
    }
    else{
        $sql = "INSERT INTO account SET 
            fullname='$fullname',
            gender='$gender',
            section='$section',
            email = '$email',
            password='$password',
            confirm_password='$confirm_password',
            role='$role';";
    
            if (mysqli_query($conn, $sql)) {
                echo '<script language="javascript">';
                echo 'alert("message successfully sent")';
                echo '</script>';
                
            } else {
                echo mysqli_error($conn);
                echo '<script>';
                echo "alert('Error Occur!');" . mysqli_error($conn);
                echo '</script>';
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
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-6 pt-5 text-center">
                <h3 class="text-success fw-bold">CLSU OFFICE OF STUDENT AFFAIRS</h3>
                <div class="pt-5">
                    <img src="../img/login-pic.png" alt="" class="login-pic">
                </div>
            </div>
            <div class="col-md-6 pt-5">
                <div class="card ">
                    <div class="card-body">
                        <h4>Register your account</h4>
                        <div class="row pt-3">
                            <form method="POST" name="form" id="form" >
                                <div class="col-md-12">
                                    <div class="form-outline " >
                                    <input type="text"  name="fullname" id="fullname"class="form-control" />
                                    <label class="form-label" for="fullname">Full Name</label>
                                    </div>
                                </div>
                               
                                <div class="col-md-12 pt-3">
                                    <div class="form-outline " >
                                    <input type="text"  name="gender" id="gender"class="form-control" />
                                    <label class="form-label" for="gender">Gender</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="form-outline " >
                                    <input type="text"  name="section" id="section"class="form-control" />
                                    <label class="form-label" for="section">Section</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="form-outline">
                                        <input type="email"  name="email" id="email"class="form-control" />
                                        <label class="form-label" for="email">Email</label>
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="form-outline">
                                        <input type="password"  name="password" id="password"class="form-control" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="form-outline">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"/>
                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="form-check">
                                        <input class="form-check-input me-2 terms" type="checkbox" value="" id="terms"  />
                                        <label class="form-check-label" for="form2Example3">
                                        I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                        <p id="demo"></p>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row pt-3">
                                <div class="col-6">
                                    <a href="../index.php">Login instead</a>
                                </div>
                                <div class="col-6 d-flex flex-row-reverse">
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-primary" name="submit" id="submit">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <!-- <div class="mt-5">
            
            <form method="POST" class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                    <div class="form-outline">
                        <input type="text" class="form-control" id="fullname" name="fullname" required/>
                        <label for="fullname" class="form-label" >Fullname</label>
                    </div>
                    <p id="errorid" class="text-danger"></p>
                </div>
                <div class="col-md-4">
                    <div class="form-outline">
                    <input type="text" class="form-control" id="gender" name="gender" required />
                    <label for="gender" class="form-label">Gender</label>
                    </div>
                    <p id="error_gender" class="text-danger"></p>
                </div>
                <div class="col-md-4">
                    <div class="form-outline">
                    <input type="text" class="form-control" id="section" name="section" required />
                    <label for="section" class="form-label">Section</label>
                    </div>
                    <p id="error_section" class="text-danger"></p>
                </div>
                <div class="col-md-4">
                    <div class="form-outline">
                    <input type="email" class="form-control" id="email" name="email" required />
                    <label for="email" class="form-label">Email</label>
                    
                    </div>
                    <p id="error_email" class="text-danger"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-outline">
                    <input type="text" class="form-control" id="password" name="password" required/>
                    <label for="password" class="form-label">Password</label>
                    </div>
                    <p id="error_password" class="text-danger"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-outline">
                    <input type="text" class="form-control" id="confirm_password" name="confirm_password" required/>
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    </div>
                    <p id="error_confirm_password" class="text-danger"></p>
                    <p id="error_not_match" class="text-warning"></p>
                </div>
                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required />
                    <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
                </div>
                <div class="col-6">
                    <a href="../index.php">Login instead</a>
                </div>
            </form>

        </div> -->

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
                            <input type="text" class="form-control form-control-lg" id="section" name="section" required />
                            <label for="section" class="form-label">Section</label>
                            </div>
                            <p id="error_section" class="text-danger"></p>
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
                            <input type="text" class="form-control form-control-lg" id="password" name="password" required/>
                            <label for="password" class="form-label">Password</label>
                            </div>
                            <p id="error_password" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required/>
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
        //         section = form.section.value;
        //         email = form.email.value;
        //         password = form.password.value;
        //         confirm_password = form.confirm_password.value;

        //         let regex = /[A-Za-z]+\.[A-Za-z0-9]+@clsu2\.edu\.ph/i;

        //         if (fullname == '')
        //             document.getElementById("errorid").innerHTML = "Enter your full name";
        //         if (gender == '')
        //             document.getElementById("error_gender").innerHTML = "Enter your gender";
        //         if (section == '')
        //             document.getElementById("error_section").innerHTML = "Enter your section";
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




    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>
</html>