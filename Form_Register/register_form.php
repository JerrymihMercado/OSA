<?php
session_start();
include '../mysql_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSA | Register</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <?php include '../Links/link.php'; ?> 
</head>
<body>
    <div class="container">
        <form action="" method="post" onsubmit="return validateForm();">
            <div class="col-md-4 pt-2">
                <div class="form-outline ">
                    <input type="text" id="student_id" class="form-control" name="student_id"/>
                    <label class="form-label" for="form12">Student ID</label>
                </div>
                <p id="error_id" class="text-danger"></p>
            </div>
            <div class="col-md-12 pt-3">
                <div class="form-outline">
                    <input type="text" id="fullname" class="form-control" name="fullname"/>
                    <label class="form-label" for="form12">Full Name</label>
                </div>
                <p id="error" class="text-danger"></p>
            </div>
            <button type="submit" class="btn btn-primary mt-2">
                Submit
            </button>
        </form>

    </div>
    <script>
    function validateForm(){  
        let valid = event.preventDefault();
        var name = document.getElementById("fullname").value;
        var school_id = document.getElementById("student_id").value;
        
        if(school_id == ''){
            document.getElementById("error_id").innerHTML="Enter valid id";
            valid = false;
        }
        if (name == '')
        {
            document.getElementById("error").innerHTML="Enter Fullname";
            valid = false;
        }
        if(valid){
            return true;
        }
    }
</script>
</body>
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</html>