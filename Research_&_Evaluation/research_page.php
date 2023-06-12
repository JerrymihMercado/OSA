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
          header("location:../Research_&_Evaluation/research_page.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../Research_&_Evaluation/research_page.php");
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error_login'] = "error";
            session_unset($_SESSION['status_error_login']);
    }
}
if(isset($_POST["handle_submit"])){

    // $id = $_GET['publication_ID']; 
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
        $sql = "INSERT INTO research_and_eval SET 
            image='$directory',
            title = '$titles',
            date_created='$created_at',
            descriptions='$descriptions',
            is_archive=0;";
            
        if (mysqli_query($conn, $sql)) {
                $_SESSION['status_success_added'] = "success";
                header("location:../Research_&_Evaluation/research_page.php");
            
        } else {
              $_SESSION['status_error'] = "error";
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
        <img src="../img/clsu-1.jpg" class="banner__img" />
        <a href="#!">
            <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
            <div class="d-flex justify-content-center align-items-center h-100 text-center">
                <h2 class="text-white mb-0">RESEARCH AND EVALUATION</h2>
            </div>
            </div>
        </a>
    </div> 

    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">RESEARCH & EVALUATION</p>
          <p class="tag-sub">See all the research and evaluation from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

  <!-- Button trigger modal -->
  <div class="container d-flex justify-content-end mt-3">
    <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 1) {
              echo '<button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#add_page">
                      Add New Record
                    </button>';
          }
      }else{
          echo '';
      }
    ?>
  </div>

  <div class="modal fade" id="add_page" tabindex="-1" aria-labelledby="add_page" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Page</h1>
                <i data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
               
                <div class="mb-3">
                    <label for="myfile">Image<span class="text-danger"> *</span></label>
                    <img class="card-img-top movie_input_img" id="output" src="../img/Default_images.svg" alt="Card image" style="width: 100%; height: auto; ">
                    <input type="file" class="form-control mt-2" id="myfile"  name="myfile" accept="image/*" onchange="loadFile(event)" required/>
                </div>
                <div class="mb-3">
                    <label for="title">Title<span class="text-danger"> *</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Input Title" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description<span class="text-danger"> *</span></label>
                    <textarea class="form-control" id="mytextarea" name="description"></textarea>
                </div>
            </div>
            <div class="modal-footer pt-4 ">                  
                <button type="reset" name = "" class="btn mx-auto w-100 btn-light fw-semibold" data-mdb-dismiss="modal">Cancel</button>
                <button type="submit" name = "handle_submit" class="btn mx-auto w-100 btn-success fw-semibold" >Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- <div class="container pt-5">
      <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
              <a href="../Research_&_Evaluation/research_details.php">
                  <div class="card h-100 shadows">
                  <img src="../img/Rectangle 266.png" class="card-img-top" alt="clsu-image"/>
                  <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">
                      This is a longer card with supporting text below as a natural lead-in to
                      additional content. This content is a little bit longer.
                      </p>
                  </div>
              </div>
              </a>
          </div>
          <div class="col">
              <div class="card h-100 shadows">
              <img src="../img/Rectangle 266.png" class="card-img-top" alt="Palm Springs Road"/>
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>
          <div class="col">
              <div class="card h-100 shadows">
              <img src="../img/Rectangle 266.png" class="card-img-top" alt="Los Angeles Skyscrapers"/>
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
              </div>
              </div>
          </div>
      
      </div>
  </div> -->
  <div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $sql = "SELECT * FROM research_and_eval WHERE is_archive=0";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="col">
          <div class="card h-100 shadows">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;"/>
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
              <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title']; ?></h5>
                  <p class="card-text">
                    <?php 
                      $details = substr($row['descriptions'],0,300);
                      if($row['descriptions'] > 90){
                        echo $details?> ...
                    <?php }?>
                  </p>
                  
                  
              </div>
              <div class="card-footer bg-transparent border-0">
                <a href="<?php echo '../Research_&_Evaluation/research_details.php?RandD_ID=' . $row['id']; ?>">
                  <button class="btn btn-success shadow-0 px-4">View Details</button>
                </a>
              </div>
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

<?php include_once '../Components/footer.php' ?>

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
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>