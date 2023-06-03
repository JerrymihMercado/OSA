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
          header("location:../Section/impu.php");
          $_SESSION['status_success_admin'] = "success";
          session_unset($_SESSION['status_success_admin']);
          
        }
        else {
          $_SESSION['status_success_user'] = "success";
          header("location:../Section/impu.php");
          session_unset($_SESSION['status_success_user']);

          }
    } else {
            $_SESSION['status_error'] = "error";
    }
}
if(isset($_POST['view'])){
  header("content-type: application/pdf");
  readfile('../Handbook/CLSU-STUDENT-HANDBOOK-2022-2023.pdf');
}

if(isset($_POST["handle_upload"])){
   

    $date = date_create();
    $stamp = date_format($date, "d-m-Y");
    $temp = $_FILES['handbook']['tmp_name'];
    $directory = "../Handbook/".$_FILES['handbook']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "INSERT INTO student_handbook SET 
            file_name='$directory',
            uploaded_on='$stamp';";
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Section/impu.php");
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            unset($_POST['handle_upload']);
            
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
    .view-pdf-button .btn{
      margin-top: -30vh;
      position: absolute;
      font-weight: 600;
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
            <h2 class="text-white mb-0">INFORMATION MANAGEMENT AND PUBLICATION UNIT</h2>
        </div>
        </div>
    </a>
</div>

<!-- brief history -->
<div class="container mt-5">
    <div class="osa-tag">
      <p class="tag-info">OVERVIEW</p>
      <p class="tag-sub ">
        This unit is designed to assist in the best practice of student affairs and
        services in the university through the aid of research, publication and
        information management. The IMPU shall be responsible for the collection,
        organization, and control over the planning, processing, evaluating and
        reporting of relevant information in order to meet client objectives and to
        enable efficient and effective delivery of services.
      </p>
    </div>
</div>
<div class="container pt-5">
  <div class="row">
    <div class="osa-tag">
      <p class="tag-info">STUDENT HANDBOOK</p>
      <p class="tag-sub">Read the student handbook from the Office of Student Affairs(OSA)</p>
    </div>

  </div>
</div>
<div class="mt-3 container">
    <div class="row">
        <div class="col-sm-6">
          <form action="" method="POST">
            <div class="card shadows card-handbook">
                <img
                  src="../img/studenthandbook.png"
                  class="img-fluid hover-shadow"
                  alt="Los Angeles Skyscrapers"
                  style="height: 60vh; object-fit: cover;"
                />
                  <?php
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                            echo '<div class="d-flex justify-content-center view-pdf-button">
                                    <button class="btn btn-light shadows px-5" name="view">View</button>
                                  </div>';
                        }
                    }else{
                        echo '';
                    }
                  ?>
              </div>
          </form>
            
            <div class="row mt-3">
                <div class="col-auto">
                    
                  <?php
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                            echo '';
                        }
                    }else{
                        echo '<h6>Please <span><a class="text-primary " data-mdb-toggle="modal" data-mdb-target="#login_Modal" style="cursor: pointer;">
                      login
                    </a></span>to view and download the student handbook.</h6>';
                    }
                  ?>
                </div>
                <div class="col-md justify-content-end d-flex">
                  <?php
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 0) {
                            echo '<a href="https://drive.google.com/uc?export=download&id=1FylpFFT3UyuQndDfatJ1R0jbZ5_2QwW4" class="btn btn-danger">Download</a>';
                        }elseif($_SESSION['role'] == 1){
                            echo '<button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#upload">
                                    Upload Handbook
                                  </button>';
                        }
                    }
                  ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- publication -->
<div class="container pt-5">
  <div class="row">
    <div class="osa-tag">
      <p class="tag-info">PUBLICATION</p>
      <p class="tag-sub">See all the publication from the Office of Student Affairs(OSA)</p>
    </div>
  </div>
</div>

<div class="container">
  <div class="col justify-content-end d-flex p-3">
      <a href="../Publications/all_publications.php">
        <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
      </a>
  </div>
</div>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $sql = "SELECT * FROM publication_page limit 3";
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
                  <p class="card-text" align="justify">
                    <?php echo $row['descriptions']; ?>
                  </p>
                  
              </div>
              <div class="card-footer bg-transparent border-0">
                <a href="<?php echo '../Publications/publication_page.php?publication_ID=' . $row['id']; ?>">
                  <button class="btn btn-success px-4">View More</button>
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
<!-- Research and evaluation -->
<div class="container pt-5">
  <div class="row">
    <div class="osa-tag">
      <p class="tag-info">RESEARCH AND EVALUATION</p>
      <p class="tag-sub">See all the research and evaluation from the Office of Student Affairs(OSA)</p>
    </div>

  </div>
</div>

<div class="container">
  <div class="col justify-content-end d-flex p-3">
      <a href="../Research_&_Evaluation/research_page.php">
        <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All <i class="fas fa-angle-right"></i></button>
      </a>
  </div>
</div>

<!-- <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <a href="../Research_&_Evaluation/research_details.php">
              <div class="card h-100 shadows">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="../img/clsu-1.jpg" class="card-img-top" alt="clsu-image"/>
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
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
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                  <img src="../img/clsu-1.jpg" class="card-img-top" alt="clsu-image"/>
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a short card.</p>
            </div>
            </div>
        </div>
    </div>
</div>   -->
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $sql = "SELECT * FROM research_and_eval limit 3";
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
                  <p class="card-text" align="justify">
                    <?php echo $row['descriptions']; ?>
                  </p>
                  
              </div>
              <div class="card-footer bg-transparent border-0">
                <a href="<?php echo '../Research_&_Evaluation/research_details.php?RandD_ID=' . $row['id']; ?>">
                  <button class="btn btn-success px-4">View More</button>
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

<!--Upload Modal -->
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Student Handbook</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <label class="form-label" for="handbook">Upload</label>
          <input type="file" class="form-control" id="handbook" name="handbook"/>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="handle_upload">Save changes</button>
        </div>
      </form>
    </div>
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
</body>
</html>