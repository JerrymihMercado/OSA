<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 0;

    $check_user = "SELECT * FROM login
      WHERE email = '$email'";

    $check_result = mysqli_query($conn, $check_user);
    $count = mysqli_num_rows($check_result);

    if($count > 0){
        echo '<script language="javascript">';
        echo 'alert("email is already register!")';
        echo '</script>';
    }
    else{
        $sql = "INSERT INTO login SET 
            username='$username',
            fullname='$fname',
            email = '$email',
            password='$password',
            is_admin='$role';";
    
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
    <title>Document</title>
    <?php include '../Links/link.php' ?>
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                        <form method="POST" class="mx-1 mx-md-4">

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="fname" name="fname" class="form-control" />
                                <label class="form-label" for="fname">Your Name</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="username" name="username" class="form-control" />
                                <label class="form-label" for="username">Username</label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="email" id="email" name="email" class="form-control" />
                                <label class="form-label" for="email">Your Email</label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="password" id="password" name="password" class="form-control" />
                                <label class="form-label" for="password">Password</label>
                                </div>
                            </div>
                            

                            <!-- <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="password" id="form3Example4cd" class="form-control" />
                                <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                </div>
                            </div> -->

                            <div class="form-check d-flex justify-content-center mb-5">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                <label class="form-check-label" for="form2Example3">
                                I agree all statements in <a href="#!">Terms of service</a>
                                </label>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>

                        </form>

                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                        <img src="../img/draw1.png"
                        class="img-fluid" alt="Sample image">

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>
</html>