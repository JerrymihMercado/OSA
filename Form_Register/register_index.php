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
        if($password == $confirm_password){
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
        }else{
            echo '<script language="javascript">';
            echo 'alert("Password is not match")';
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
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
     <?php include '../Links/link.php' ?> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <link rel="stylesheet" href="../css/mdb.min.css" />
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
                                <!-- <div class="col-md-6">
                                    <div class="form-outline " >
                                    <input type="email" id="form12" class="form-control" />
                                    <label class="form-label" for="form12">Last Name</label>
                                    </div>
                                </div> -->
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
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script  type="text/javascript">
        var button = document.getElementById("submit");
        var clickBtn = document.getElementsByClassName('terms')[0];

        // Disable the button on initial page load
        button.disabled = true;

        //add event listener
        clickBtn.addEventListener('click', function(event) {
            button.disabled = !button.disabled;
        });
        const form =document.getElementById(form);
        const fullname =document.getElementById(fullname);
        const email =document.getElementById(email );
        const password =document.getElementById(password);
        const confirm_password =document.getElementById(confirm_password);
        
        form.addEventListener('submit', e => {
            e.preventDefault();

            validateInputs();
        });
        const setError = (element, message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');

            errorDisplay.innerText = message;
            inputControl.classlist.add('error');
            inputControl.classlist.remove('success');
            
        } 
        const setSucess = element => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');

            errorDisplay.innerText = message;
            inputControl.classlist.add('sucess');
            inputControl.classlist.remove('remove');

        };
        const isValidEmail = email =>{
            const re = /^([a-zA-Z0-9\\-])+\\.([a-zA-Z0-9\\-])+@(clsu.edu.ph)$/;
            return re.test(String(email).toLowerCase());
        }
        const validateInputs = () => {
            const fullnameValue = fullname.value.trim();
            const emailValue = emailname.value.trim();
            const passwordValue = password.value.trim();
            const confirm_passwordValue = confirm_password.value.trim();

            if(fullnameValue === ''){
                setError(fullname, 'Username is requred');
            }else{
                setSucess(fullname);
            }

            if(emailValue === ''){
                setError(email, 'Email is requred');
            }else if(!isValidEmail(emailValue)){
                setError(email, 'Provide a valid email address');

                }else {
                    setSucess(email);
                }
            if(passwordValue === ''){
                setError(password, 'Password is requred');
            } else if (passwordValue.length < 8 ){
                setError(password, 'Password must be at least 8 characters.')
            } else{
                setSucess(password);
            }

            if(confirm_passwordValue === ''){
                setError(confirm_password, 'please confirm your password');
            } else if(password !== passwordValue){
                setError(confirm_password, "Password Doesn't match");
            } else{
                setSucess(confirm_password);
            }
            
        };
        
        

        
</script>
</body>
</html>