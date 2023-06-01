<?php
session_start();
include '../mysql_connect.php';
if (isset($_GET['publication_ID'])) {
    $id = $_GET['publication_ID'];
    $sql = "SELECT * FROM  publication_page WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $publication = mysqli_fetch_assoc($result);
    }
}
if(isset($_POST["handle_submit"])){

    $id = $_GET['publication_ID']; 
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
        $sql = "INSERT INTO publish_post SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0,
            own_by='$id';";
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Publications/publication_page.php?publication_ID=".$id);
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            unset($_POST['handle_submit']);
            
        } else {
            echo mysqli_error($conn);
            echo '<script>';
            echo "alert('Error Occur!');" . mysqli_error($conn);
            echo '</script>';
        }
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
          header("location:../Publications/all_publications.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../Publications/all_publications.php");
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
      <p class="tag-info text-capitalize"><?php echo $publication['title']; ?></p>
      <p class="tag-sub">See all the latest publish here</p>
    </div>
  </div>
</div>
<div class="container d-flex justify-content-end mb-3">
    <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 1) {
              echo '<button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#add_post">
                      Add Publication Post
                    </button>';
          }
      }else{
          echo '';
      }
    ?>
  </div>
  <div class="container">
    <div>
      <?php
        $id = $_GET['publication_ID']; 
        $sql = "SELECT * FROM publish_post WHERE own_by=$id AND is_archive=0 ORDER BY date_created desc limit 1 ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="card mb-3 shadows border" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                   <img src="../upload/<?php echo $row['image']; ?>" class="img-fluid rounded-start" alt="" style="height: 40vh; object-fit: cover;"/>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border"><?php echo $row['title']; ?></h5>
                        <p class="card-text">
                          <small class="tag-sub text-muted fs-6"><?php echo $row['date_created']; ?></small>
                        </p>
                        <p class="card-text px-4">
                          <?php echo $row['descriptions']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php     
            }?>
     
      <?php }
              ?>
    </div>
  </div>

  

  <div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="add_post" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
               
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../img/Default_images.svg" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Post Title<span class="text-danger"> *</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
                </div>
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control" id="mytextarea" name="description"></textarea>
                </div>
            <div class="modal-footer pt-4 ">                  
                <button type="submit" name = "handle_submit" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
    
  <div class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $id = $_GET['publication_ID']; 
        $sql = "SELECT * FROM publish_post WHERE own_by=$id AND is_archive=0";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {?>
          <div class="col">
            <div class="card h-100 shadows">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="clsu-image" style="height: 35vh; object-fit: cover;"/>
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
              <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title']; ?></h5>
                  <!-- <p class="card-text" align="justify">
                      <?php echo $row['descriptions']; ?>
                    </p> -->
              </div>
              <div class="card-footer bg-transparent border-0">
                <a href="<?php echo '../Publications/publication_details.php?publication_ID=' . $row['id']; ?>">
                  <button class="btn btn-success px-4">View Details</button>
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

<?php include_once '../Components/footer.php' ?>

<script src="../js/sweetalert2.js"></script>
  <?php
    if(isset($_SESSION['status_success_admin']) ){
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
            title: 'Welcome Back Admin!'
            })

        </script>
        <?php
            unset($_SESSION['status_success_admin']);
        
    }
    if(isset($_SESSION['status_success_user']) ){
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
            title: 'Welcome <?php echo $_SESSION['fullname']?>!'
            })
        </script>
        <?php
        unset($_SESSION['status_success_user']);
    }
    if(isset($_SESSION['status_error'])){
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
            icon: 'error',
            title: 'Credentials error'
            })

        </script>
        <?php
        
    }
  ?>
<!-- MDB -->
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