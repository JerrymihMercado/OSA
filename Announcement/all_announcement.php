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

if(isset($_POST["handle_submit"])){
   
    $title = $_POST['title'];
    $titles = str_replace("'","\'",$title);
    date_default_timezone_set("Asia/Manila");
    $date_created = date_create();
    $created_at = date_format($date_created, "Y-M-d h:i a");
    $description = stripslashes($_POST['description']);
    $descriptions = str_replace("'","\'",$description);

    $date = date_create();
    $stamp = date_format($date, "Y");
    $temp = $_FILES['myfile']['tmp_name'];
    $directory = "../upload/".$_FILES['myfile']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "INSERT INTO announcement SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0;";
            $_SESSION['status_success_added'] = "success";
      if (mysqli_query($conn, $sql)) {
            $_SESSION['status_success_added'] = "success";
            header("location:../Announcement/all_announcement.php");
            session_unset($_SESSION['status_success_added']);
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
    <?php include '../Links/link.php'; ?>
</head>

<body style="background-color: #fdfdfd">

  <?php include '../Components/header.php'; ?>

  <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
        <p class="tag-info">ANNOUNCEMENT LIST</p>
        <p class="tag-sub">Access all announcements from the Office of Student Affairs (OSA)</p>
      </div>
    </div>
  </div>

  <div class="container d-flex justify-content-end mb-3">
    <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 1) {
              echo '<button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_announcement">
                      <i class="fas fa-notes-medical"></i> Add Announcement
                    </button>';
          }
      }else{
          echo '';
      }
    ?>
  </div>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php
      $sql = "SELECT * FROM announcement WHERE is_archive=0";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
          while ($row = mysqli_fetch_assoc($res)) {?>
      <div class="col">
        <div class="card mb-3 shadows h-100 border">
          <div class="card-header">
            <h6><?php echo $row['title']; ?></h6>
            <small><?php echo $row['date_created']; ?></small>
          </div>
          <div class="card-body">
            <p>
              <?php 
                $details = $row['descriptions'];
                echo substr_replace($details, '...', 100);
               ?>
            </p>
          </div>
          <div class="card-footer justify-content-end d-flex border-0">
            <a href="<?php echo '../Announcement/announcement_details.php?announcement_id=' . $row['id']; ?>" class="card-text">
              <button class="btn btn-dark shadow-0"><i class="fas fa-eye"></i> View Details</button>
            </a>
          </div>

        </div>
      </div>
      <?php     
              }
        }else{?>
            <div class="container p-2 justify-content-center d-flex mt-5">
                <h1 class="text-warning mt-5">No Data Found!</h1>
            </div>
        <?php  }
                ?>
    </div>
  </div>

   <!-- Add Announcement Modal -->
  <div class="modal fade" id="add_announcement" tabindex="-1" aria-labelledby="add_announcement" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Announcement</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../img/Default_images.svg" alt="default-image" style="width: 100%; height: 20vh; object-fit: cover;">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Announcement Title<span class="text-danger"> *</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title Name" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control" id="mytextarea" name="description"></textarea>
                </div>
            </div>
            <div class="modal-footer pt-4 ">                  
                <button type="reset" name = "" class="btn mx-auto w-100 btn-light fw-semibold" data-mdb-dismiss="modal" >Cancel</button>
                <button type="submit" name = "handle_submit" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<?php include_once '../Components/footer.php' ?>

<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
<!-- Display preview image function -->
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.setAttribute("class", "out");
    };
</script>

<!-- tiny mce function -->
<script>
    tinymce.init({
    selector: "#mytextarea",
    plugins: "fullpage",
    fullpage_default_doctype: "<!DOCTYPE html>"
  });
</script>

</body>
</html>