<?php
session_start();
include '../mysql_connect.php';
if (isset($_GET['RandD_ID'])) {
    $id = $_GET['RandD_ID'];
    $sql = "SELECT * FROM research_and_eval WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $research_and_eval = mysqli_fetch_assoc($result);
    }
}
if(isset($_POST["handle_submit_update"])){
   
    $id = $research_and_eval['id'];
    $title = $_POST['title'];
    $titles = str_replace("'","\'",$title);
    $date_created = date_create();
    $created_at = date_format($date_created, "Y-M-d");
    $description = stripslashes($_POST['description']);
    $descriptions = str_replace("'","\'",$description);

    $date = date_create();
    $stamp = date_format($date, "Y");
    $temp = $_FILES['myfile']['tmp_name'];
    $directory = "../upload/".$_FILES['myfile']['name'];   
    if (move_uploaded_file($temp, $directory)) {
        $sql = "UPDATE research_and_eval SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions'
            WHERE id=".$id;
            
    if (mysqli_query($conn, $sql)) {
            $_SESSION['status_success_update'] = "success";
            header("location:../Research_&_Evaluation/research_details.php?RandD_ID=".$id);
            unlink("../upload/".$research_and_eval['image']);
            session_unset($_SESSION['status_success_update']);
        } else {
            echo mysqli_error($conn);
            $_SESSION['status_error'] = "error";
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
    }
    
}
if (isset($_POST['submit'])) {
    $id = $research_and_eval['id'];
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
          header("location:../Research_&_Evaluation/research_details.php?RandD_ID=".$id);
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../Research_&_Evaluation/research_details.php?RandD_ID=".$id);
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error'] = "error";
    }
}
if (isset($_POST['archive'])) {
 
    $id = $research_and_eval['id'];
    $archive = 1;
     
    $sql = "UPDATE research_and_eval SET is_archive='$archive' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
          $_SESSION['status_success'] = "success";
          header("location:../Research_&_Evaluation/research_page.php");
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
    <script src="https://cdn.tiny.cloud/1/n46xtsacbhbxjsimv4eyp5etxtgm41hzte71yebrsou8dm4r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <?php
      include '../Links/link.php';
    ?>
</head>
<style>
  .fa-circle-exclamation{
      font-size: 110px;
      width: fit-content;
      margin-left: 35%;
      padding: 10px;
      margin-top: -15%;
      margin-bottom: 5%;
      background-color: #fff;
      border-radius: 50%;
      position: absolute;
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
        <p class="tag-info">RESEARCH & EVALUATION DETAILS</p>
        <p class="tag-sub">Please read the details of R&E from the Office of Student Affairs(OSA)</p>
      </div>
    </div>
  </div>

<div class="container p-2 mt-2">
    <img src="../upload/<?php echo $research_and_eval['image']; ?>" class="img-fluid rounded shadows border" alt="" style="width: 100vw; height: 50vh; object-fit: cover"/>
    <div class="col">
      <div class="card-body">
        <div class="row mt-3">
          <div class="col ">
            <h5><?php echo $research_and_eval['title'];?></h5>
          </div>
          <div class="col text-muted d-flex justify-content-end">
            <p><?php echo $research_and_eval['date_created'];?></p>
          </div>
        </div>
        <p class="card-text description-left-border mt-5">
          <?php echo $research_and_eval['descriptions'];?>
        </p>         
      </div>
    </div>
    <div class="row mt-5">
        <div class="col">
          
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '
                    <button class="btn btn-success fw-semibold" data-mdb-toggle="modal" data-mdb-target="#update_publication">Update</button>
                    <button class="btn btn-danger fw-semibold" data-mdb-toggle="modal" data-mdb-target="#archive">Archive</button>';
                }
            }else{
                echo '';
            }
          ?>
        </div>
      </div>
  </div>
  <!-- Update Modal -->
   <div class="modal fade" id="update_publication" tabindex="-1" aria-labelledby="update_publication" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Update Record</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
               
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../upload/<?php echo $research_and_eval['image']; ?>" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" value="<?php echo $research_and_eval['image']; ?>"/>
                </div>
                <div class="mb-3">
                    <label for="title">Title<span class="text-danger"> *</span></label>
                    <input value="<?php echo $research_and_eval['title']; ?>" type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control" id="mytextarea" name="description"><?php echo $research_and_eval['descriptions']; ?></textarea>
                </div>
            </div>
            <div class="modal-footer pt-4 ">                  
                <button type="submit" name="handle_submit_update" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

   <!-- archive modal -->
  <div class="modal fade" id="archive" tabindex="-1" role="dialog" aria-labelledby="archive" aria-hidden="true">
      <div class="modal-dialog">
          <form method="POST">  
              <div class="modal-content">
                  <div class="modal-header bg-danger text-white p-4">
                      <h5 class="modal-title" id="exampleModalLabel"></h5>
                      <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body ">
                      <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                      <div class="col content-modal mt-5">
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Post</h4>
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this post?</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-mdb-dismiss="modal">
                          Cancel
                      </button>
                     
                      <button type="submit" name="archive" class="btn btn-danger px-4" >
                          archive
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>

<?php include_once '../Components/footer.php' ?>
    <script>
      var loadFile = function(event) {
          var image = document.getElementById('output');
          image.src = URL.createObjectURL(event.target.files[0]);
          image.setAttribute("class", "out");
      };
      
  </>
  <script>
    tinymce.init({
    selector: '#mytextarea',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>