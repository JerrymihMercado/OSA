<?php

session_start();
include '../mysql_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['upload'])){ 
    // File upload configuration 
    $targetDir = "../upload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', NOW()),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO code_of_conduct_images (file_name, uploaded_on) VALUES $insertValuesSQL"); 
            if($insert){ 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = "Upload failed! ".$errorMsg; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
if (isset($_POST['submitMail'])) {

	require '../includes/PHPMailer.php';
	require '../includes/SMTP.php';
	require '../includes/Exception.php';

    $fullname = $_SESSION['fullname'];
    $course = $_SESSION['course'];
    $email = $_SESSION['email'];
    $message = $_POST['message'];
    $user_message = str_replace("'","\'",$message);

    $date = date_create();
    $stamp = date_format($date, "Y");
    $temp = $_FILES['myfile']['tmp_name'];
    $directory = "../Complain_upload/" . $stamp . $_FILES['myfile']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "INSERT INTO complainant_message SET 
                user_file='$directory',
                user_name = '$fullname',
                user_course = '$course',
                user_email = '$email',
                user_message='$user_message';";
            
    if (mysqli_query($conn, $sql)) {
            unset($_POST['submitMail']);
            
        } else {
            echo mysqli_error($conn);
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
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
                                    Complained Received
                                </h1>
                                <br />
                                <h3 class="card-text-content">Good day, <b>' . $_SESSION['fullname'] . '</b></h3>
                                <p>
                                    We truly appreciate you taking the time to share your relevant concerns with us. 
                                    Rest assured that we will evaluate your situation as soon as possible. Please wait until you receive an official email message from the Office of Student Affairs.
                                </p>
                                <p>Thank You!</p>

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
        $mail->Subject = "Complained";
    //Set sender email
        $mail->setFrom('noreply.clsu.osa@gmail.com');
    //Enable HTML
        $mail->isHTML(true);
    //Attachment
        // $mail->addAttachment('img/attachment.png');
    //Email body
        $mail->Body = $body;
    //Add recipient
        $mail->addAddress($_SESSION['email']);
        // $mail->addAddress('noreply.clsu.osa@gmail.com');
    //Finally send email
        if ( $mail->Send() ) {
            $_SESSION['status_success_send'] = "success";
            // session_unset($_SESSION['status_success_send']);
        }else{
            echo 'Message could not be sent. Mailer Error: '[$mail->ErrorInfo];
        }
    //Closing smtp connection
        $mail->smtpClose();
}
if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
    $sql = "SELECT * FROM  code_of_conduct_images WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $conduct_image = mysqli_fetch_assoc($result);
    }
}
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

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

    $sql = "SELECT * FROM account
      WHERE email = '$encryption_email'
      AND password = '$encryption_password'";
    
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
        $_SESSION['email'] = $session_email;
        $_SESSION['course'] = $row['course'];
        
        $_SESSION['role'] = $row['role'];
        
        if ($row['role'] == 1) {    
          header("location:../SDB/sdb_index.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../SDB/sdb_index.php");
          session_unset($_SESSION['status_success_user']);
          }
    } else {
            $_SESSION['status_error'] = "error";
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
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <?php
      include '../Links/link.php';
    ?>
    
</head>
<style>
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }
    .img-blur{
        filter: blur(4px);
    }
    .chat-bot{
        display: none; /* Hidden by default */
        position: fixed; /* Fixed/sticky position */
        bottom: 20px; /* Place the button at the bottom of the page */
        right: 30px; /* Place the button 30px from the right */
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        color: white; /* Text color */
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 15px; /* Some padding */
        border-radius: 10px; /* Rounded corners */
        font-size: 18px; /* Increase font size */    
    }
    textarea {
        overflow-y: scroll;
        height: 100px;
        resize: none; /* Remove this if you want the user to resize the textarea */
    }

</style>
<body>
<div class="logo-header ">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                <div class="logo mr-xs-3">
                    <img src="../img/clsu-logo.png" alt="" >
                    
                </div>
                <div class="logo-text m-xs-0">
                    <span class="logo-title">Central Luzon State University</span>
                    <span class="logo-sub">Science City of Muñoz, Nueva Ecija, Philippines 3120</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../Components/header.php'; ?>

<!-- banner -->
<div class="bg-image ripple" data-mdb-ripple-color="light">
    <img src="../img/banner1.png" class="banner__img" />
    <a href="#!">
        <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
        <div class="d-flex justify-content-center align-items-center h-100 text-center">
            <h2 class="text-white mb-0">CLSU STUDENT CODE OF CONDUCT AND DISCIPLINE</h2>
        </div>
        </div>
    </a>
</div>

<div class="container pt-5">
    <div class="row">
    <div class="osa-tag">
        <p class="tag-info">CODE OF CONDUCT AND DISCIPLINE</p>
        <p class="tag-sub">Read the student conduct and discipline from the Office of Student Affairs(OSA)</p>
    </div>
    </div>
</div>

<!-- Button trigger modal -->
<?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
            echo '<div class="container d-flex justify-content-end">
                        <button type="button" class="btn btn-primary fw-semibold" data-mdb-toggle="modal" data-mdb-target="#upload">
                            Upload Files
                        </button>
                    </div>';
        }
    }else{
        echo '';
    }
?>

<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <?php
        $sql = "SELECT * FROM code_of_conduct_images";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
          while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="col">
            <div class="card h-100 shadows">
                <img src="../upload/<?php echo $row['file_name']?>" class="card-img-top" alt="<?php echo $row['file_name']?>"/>
            </div>
        </div> 
        <?php     
            }
    }else{?>
        <div class="container p-2 justify-content-center d-flex">
            <h1 class="text-warning">No Data Found!</h1>
        </div>
    <?php  }
            ?>   
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="upload" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="upload">Upload File</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
        
                <?php if(!empty($statusMsg)){?>
                    <div class="rounded" style="background-color: #B3E5FC;">
                        <p class="text-dark p-3"> <?php echo $statusMsg; ?></p>
                    </div>
            <?php }?>

                <label class="form-label" for="file">Select Image Files to Upload:</label>
                <input type="file" name="files[]" multiple class="form-control" id="file" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                <button type="submit" name="upload" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="container">
    
</div>

<?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 0) {
            echo ' <div class="p-5 chat-bot d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-lg btn-floating" data-mdb-toggle="modal" data-mdb-target="#chatModal">
                            <i class="fas fa-comment"></i>
                        </button>
                    </div>';
        }
    } else {
        echo '';         
    }

?>
<!-- Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="chatModal">Form</h5>
                <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST" enctype="multipart/form-data">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="form-outline mb-4">
                        <p> <b>Fullname:</b> <?php echo $_SESSION['fullname'];?> </p>
                    </div>
                    <!-- course input -->
                    <div class="form-outline mb-4">
                        <p> <b>Course:</b> <?php echo $_SESSION['course'];?> </p>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                       <p> <b>Email:</b> <?php echo $_SESSION['email'];?> </p>
                    </div>
                    <!-- Upload file -->
                    <div class="mb-4">
                        <label class="form-label" for="myfile">Optional</label>
                        <input type="file" class="form-control" id="myfile" name="myfile" multiple/>
                    </div>
                    <!-- Message input -->
                    <div class="form-outline mb-4">
                        <textarea class="form-control border rounded" id="message" rows="4" name="message" required></textarea>
                        <label class="form-label" for="message">State your concern here</label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submitMail" id="submitMail" class="btn btn-primary btn-rounded shadows">Send &nbsp; <i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once '../Components/footer.php' ?>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.setAttribute("class", "out");
    };
    
</script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>
</html>