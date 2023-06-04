<?php
session_start();
include '../mysql_connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
          header("location:../Announcement/all_announcement.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../Announcement/all_announcement.php");
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error'] = "error";
    }
}
if(isset($_POST['send_message'])){
require '../includes/PHPMailer.php';
require '../includes/SMTP.php';
require '../includes/Exception.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$sql = "UPDATE complainant_message SET 
        is_send=1
        WHERE id=".$id;
        
if (mysqli_query($conn, $sql)) {
        $_SESSION['status_success_send']= "success";
        
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
                                Complained Message
                            </h1>
                            <br />
                            <h3 class="card-text-content">Good day, <b>' . $name . '</b></h3>
                            <p>
                                '.$message.'
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
$mail->Subject = "OSA Feedback";
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
    <script src="https://cdn.tiny.cloud/1/n46xtsacbhbxjsimv4eyp5etxtgm41hzte71yebrsou8dm4r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
  <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">ALL COMPLAINTS</p>
          <p class="tag-sub">Here all the student complains</p>
        </div>

      </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $sql = "SELECT * FROM complainant_message WHERE is_send=0";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
            <div class="col">
                <div class="card h-100 shadows">
                <img src="<?php echo $row['user_file'];?>" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                <div class="card-body">
                    <p class="card-title"><b>Name:</b> <?php echo $row['user_name'];?></p>
                    <p class="card-title"><b>Course:</b> <?php echo $row['user_course'];?></p>
                    <p class="card-text">
                        <b>Message:</b> <?php echo $row['user_message'];?>
                    </p>     
                </div>
                <div class="card-footer bg-transparent border-0">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                        <input type="hidden" name="name" value="<?php echo $row['user_name'];?>"/>
                        <input type="hidden" name="email" value="<?php echo $row['user_email'];?>"/>
                        <div class="form-outline">
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            <label class="form-label" for="message">Send A Message</label>
                        </div>
                        <div class="error_message mt-2">
                            <div class="alert alert-danger justify-content-center d-flex" role="alert">
                                Please input a message
                            </div>
                        </div>
                        <button type="submit" name="send_message" class="btn btn-dark mt-2 show" onclick="spinner()">Send Message</button>
                        <button class="btn btn-dark mt-2 load" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </form>
                </div>
                </div>
            </div>
            <?php     
            }
    }else{?>
        <div class="container p-2 mt-5 accordion justify-content-center d-flex">
            <h1 class="text-warning mt-5">No Data Found!</h1>
        </div>
    <?php  }
            ?>  
        </div>
    </div>
  </div>

<script type="text/javascript">               
    function spinner() {
        let message = document.getElementById('message').value;
        if(message == ''){
            document.getElementsByClassName("error_message")[0].style.display = "block";
        }else{
            document.getElementsByClassName("load")[0].style.display = "block";
            document.getElementsByClassName("show")[0].style.display = "none";
            document.getElementsByClassName("error_message")[0].style.display = "none";
        }
    }
</script>
<?php include_once '../Components/footer.php' ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script>
         tinymce.init({
        selector: '#mytextarea',
         toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    </script>
</body>
</html>