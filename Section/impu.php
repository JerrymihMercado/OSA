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

if(isset($_POST["handle_upload"])){
   
    $date = date_create();
    $stamp = date_format($date, "d-m-Y");
    $temp = $_FILES['handbook']['tmp_name'];
    $directory = "../Handbook/".$_FILES['handbook']['name'];   

    if (move_uploaded_file($temp, $directory)) {
        $sql = "UPDATE student_handbook SET 
            file_name='$directory',
            uploaded_on='$stamp'
            WHERE id=1;";
            
    if (mysqli_query($conn, $sql)) {
            header("location:../Section/impu.php");
            $_SESSION['status_success_added'] = "success";
            unset($_POST['handle_upload']);
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
<style>
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }
    .view-pdf-button .btn {
      margin-top: -30vh;
      position: absolute;
      font-weight: 600;
      display: none;
    }
    .card-handbook:hover{
      .btn{
        display: block;
      }

    }
</style>
<body style="background-color: #fdfdfd">

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
            <form method="POST">
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

                            $sql = "SELECT * FROM student_handbook WHERE id=1";
                            $res = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while ($row = mysqli_fetch_assoc($res)) {
                              echo '<div class="d-flex justify-content-center view-pdf-button">
                                      <a href="'.$row['file_name'].'" target="_blank" class="btn btn-light shadows px-5"><i class="fas fa-eye"></i> View</a>
                                      </div>';
                              }
                            }
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
                            $sql = "SELECT * FROM student_handbook WHERE id=1";
                            $res = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while ($row = mysqli_fetch_assoc($res)) {
                              echo '<a href="'.$row['file_name'].'" download class="btn btn-danger">Download</a>';
                                }
                            }
                            }elseif($_SESSION['role'] == 1){
                              echo '<button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#upload">
                                      <i class="fas fa-cloud-arrow-up"></i> Upload Handbook
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
          <div class="card h-100 shadows border">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;"/>
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
              <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title']; ?></h5>
                  <p class="card-text" align="justify">
                    <?php 
                      $details = substr($row['descriptions'],0,300);
                    if($row['descriptions'] > 90){
                      echo $details?>
                  <?php }?>
                  </p>
              </div>
              <div class="card-footer bg-transparent border-0 justify-content-end d-flex">
                <a href="<?php echo '../Publications/publication_page.php?publication_ID=' . $row['id']; ?>">
                  <button class="btn btn-dark shadow-0 px-4"><i class="fas fa-eye"></i> View Page</button>
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

  <div class="container mt-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $sql = "SELECT * FROM research_and_eval WHERE is_archive=0 limit 3";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
          while ($row = mysqli_fetch_assoc($res)) {?>
          <div class="col">
            <div class="card h-100 shadows border">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                  <img src="../upload/<?php echo $row['image']; ?>" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;"/>
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text" align="justify">
                      <?php 
                        $details = substr($row['descriptions'],0,300);
                      if($row['descriptions'] > 90){
                        echo $details?>...
                    <?php }?>
                    </p>
                    
                </div>
                <div class="card-footer bg-transparent border-0 justify-content-end d-flex">
                  <a href="<?php echo '../Research_&_Evaluation/research_details.php?RandD_ID=' . $row['id']; ?>">
                    <button class="btn btn-dark shadow-0 px-4"><i class="fas fa-eye"></i> View Details</button>
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
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>
</html>