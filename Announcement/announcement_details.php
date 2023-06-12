<?php
session_start();
include '../mysql_connect.php';
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
if (isset($_GET['announcement_id'])) {
    $id = $_GET['announcement_id'];
    $sql = "SELECT * FROM  announcement WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $announcement_details = mysqli_fetch_assoc($result);
    }
}
if (isset($_POST['archive'])) {
 
    $id = $announcement_details['id'];
    $archive = 1;
     
    $sql = "UPDATE announcement SET is_archive='$archive' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
          $_SESSION['status_success_archive'] = "success";
          header("location:../Announcement/all_announcement.php");
    } else {
          echo '<script language="javascript">';
          echo 'alert("error")';
          echo '</script>';
    }
}
if(isset($_POST["handle_submit_update"])){
   
    $id = $announcement_details['id'];
    $title = $_POST['title'];
    $titles = str_replace("'","\'",$title);
    $date_created = date_create();
    $created_at = date_format($date_created, "Y-M-d");
    $description = stripslashes($_POST['description']);
    $descriptions = str_replace("'","\'",$description);

    $date = date_create();
    $stamp = date_format($date, "Y");
    $temp = $_FILES['myfile']['tmp_name'];
    $directory = "../upload/" . $stamp . $_FILES['myfile']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "UPDATE announcement SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0
            WHERE id=".$id;
            
    if (mysqli_query($conn, $sql)) {
            $_SESSION['status_success_update'] = "success";
            header("location:../Announcement/announcement_details.php?announcement_id=".$id);
            unlink("../upload/".$announcement_details['image']);
            unset($_POST['handle_submit_update']);
            session_unset($_SESSION['status_success_update']);
            
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
    <title>Office of Student Affairs</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">
    <script src="https://cdn.tiny.cloud/1/n46xtsacbhbxjsimv4eyp5etxtgm41hzte71yebrsou8dm4r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
          <p class="tag-info">ANNOUNCEMENT DETAILS</p>
          <p class="tag-sub">Here are the detail of the announcements provided by the Office of Student Affairs (OSA)</p>
        </div>

      </div>
    </div>

  <!-- <div class="container">
      <div class="card mb-3 shadows border mt-5">
          <div class="row g-0">
              <div class="col-md-4">
                <img src="../upload/<?php echo $announcement_details['image']; ?>" class="img-fluid rounded-start" alt="" style="height: 100%; object-fit: cover;"/>

              </div>
              <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text description-left-border">
                      <?php echo $announcement_details['descriptions']; ?>
                    </p>
                </div>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col">
          
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '
                    <button class="btn btn-success fw-semibold" data-mdb-toggle="modal" data-mdb-target="#update_announcement">Update</button>
                    <button class="btn btn-danger fw-semibold" data-mdb-toggle="modal" data-mdb-target="#archive">Archive</button>';
                }
            }else{
                echo '';
            }
          ?>
        </div>
      </div>

  </div> -->
  <div class="container p-2 mt-2">
    <img src="../upload/<?php echo $announcement_details['image']; ?>" class="img-fluid rounded shadows border" alt="" style="width: 100vw; height: 50vh; object-fit: cover"/>
    <div class="col">
      <div class="card-body">
        <div class="row mt-3">
          <div class="col ">
            <h5><?php echo $announcement_details['title'];?></h5>
          </div>
          <div class="col text-muted d-flex justify-content-end">
            <p><?php echo $announcement_details['date_created'];?></p>
          </div>
        </div>
        <p class="card-text description-left-border mt-5">
          <?php echo $announcement_details['descriptions'];?>
        </p>         
      </div>
    </div>
    <div class="row mt-5">
        <div class="col">
          
          <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '
                    <button class="btn btn-success fw-semibold" data-mdb-toggle="modal" data-mdb-target="#update_announcement"><i class="fas fa-pen-to-square"></i> Update</button>
                    <button class="btn btn-danger fw-semibold" data-mdb-toggle="modal" data-mdb-target="#archive"><i class="fas fa-box-archive"></i> Archive</button>';
                }
            }else{
                echo '';
            }
          ?>
        </div>
      </div>
  </div>
  <div class="container d-flex justify-content-center">
      <a href="../Announcement/all_announcement.php" class="btn btn-dark shadows">View More Announcement</a>
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
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Announcement</h4>
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this announcement?</p>
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

<!-- Update Announcement -->
<div class="modal fade" id="update_announcement" tabindex="-1" aria-labelledby="update_announcement" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
              <h5 class="modal-title">Add New Announcement</h1>
              <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              
              <div class="mb-3">
                  <label for="myfile">Image<span class="text-danger"> *</span></label>
                  <img class="card-img-top" id="output" src="../upload/<?php echo $announcement_details['image']; ?>" alt="Card image" style="width: 100%; height: 40vh; object-fit: cover;">
                  <input type="file" class="form-control mt-2" id="myfile" name="myfile" accept="image/*" onchange="loadFile(event)" required/>
              </div>
              <div class="mb-3">
                  <label for="title">Announcement Title<span class="text-danger"> *</span></label>
                  <input value="<?php echo $announcement_details['title']; ?>" type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
              </div>
              <div class="mb-3">
                  <label for="description">Description<span class="text-danger"> *</span></label>
                  <textarea class="form-control " id="mytextarea" name="description"><?php echo $announcement_details['descriptions']; ?></textarea>
              </div>
          </div>
          <div class="modal-footer pt-4 ">                  
              <button type="submit" name="handle_submit_update" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php include_once '../Components/footer.php' ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.setAttribute("class", "out");
    };
    
</script>
<script>
         tinymce.init({
        selector: '#mytextarea',
         toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    </script>
</body>
</html>