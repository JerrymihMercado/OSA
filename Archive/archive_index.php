<?php

session_start();
include '../mysql_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM account
      WHERE email = '$email'
      AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $email;
        $_SESSION['role'] = $row['role'];
        
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
        if ($row['role'] == 1) {    
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            header("location:index.php#login");
        }
        else {
            header("location:index.php");
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
          }
    } else {
        echo '<script language="javascript">';
        echo 'alert("error")';
        echo '</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>OSA | Archives</title>
    <link rel="icon" href ="../img/logo.png" class="icon">
    <link rel="stylesheet" href="../Style/style.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    
    <link rel="stylesheet" href="../css/mdb.min.css" />
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
        <p class="tag-info">Announcement</p>
        <p class="tag-sub ">See all archives here</p>
      </div>

    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
            <?php
              $sql = "SELECT * FROM announcement WHERE is_archive=1";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="col-12">
            <div class="card mb-3 shadows border" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                    <img src="../upload/<?php echo $row['image']; ?>" class="img-fluid rounded-start" alt=""/>

                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border"><?php echo $row['title']; ?></h5>
                        <p class="card-text">
                          <small class="tag-sub"><?php echo $row['date_created']; ?></small>
                        </p>
                        <p class="card-text px-4">
                          <?php echo $row['descriptions']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      </div>
                  <?php     
                }
            }
            ?> 
    </div>    
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
        <p class="tag-info">Publication</p>
        <p class="tag-sub ">See all archives here</p>
      </div>

    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
            <?php
              $sql = "SELECT * FROM publish_post WHERE is_archive=1";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="col-12">
            <div class="card mb-3 shadows border" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                    <img src="../upload/<?php echo $row['image']; ?>" class="img-fluid rounded-start" alt=""/>

                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border"><?php echo $row['title']; ?></h5>
                        <p class="card-text">
                          <small class="tag-sub"><?php echo $row['date_created']; ?></small>
                        </p>
                        <p class="card-text px-4">
                          <?php echo $row['descriptions']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      </div>
                  <?php     
                }
            }
            ?> 
    </div>    
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="osa-tag">
        <p class="tag-info">Research and Evalualtion</p>
        <p class="tag-sub ">See all archives here</p>
      </div>

    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
            <?php
              $sql = "SELECT * FROM research_and_eval WHERE is_archive=1";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  while ($row = mysqli_fetch_assoc($res)) {?>
        <div class="col-12">
            <div class="card mb-3 shadows border" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                    <img src="../upload/<?php echo $row['image']; ?>" class="img-fluid rounded-start" alt=""/>

                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title title-left-border"><?php echo $row['title']; ?></h5>
                        <p class="card-text">
                          <small class="tag-sub"><?php echo $row['date_created']; ?></small>
                        </p>
                        <p class="card-text px-4">
                          <?php echo $row['descriptions']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      </div>
                  <?php     
                }
            }
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
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
