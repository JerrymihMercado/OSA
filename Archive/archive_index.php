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
if (isset($_POST['announcement_unarchive'])) {
 
    $aid = $_POST['announcement_id'];
    
    $unarchive = 0;
     
    $sql = "UPDATE announcement SET is_archive='$unarchive' WHERE id=".$aid;
    if (mysqli_query($conn, $sql)) {
          $_SESSION['status_success_archive'] = "success";
          header("location:../Archive/archive_index.php");
    } else {
          echo '<script language="javascript">';
          echo 'alert("error")';
          echo '</script>';
    }

}
if (isset($_POST['publication_unarchive'])) {
 
    $pid = $_POST['publication_id'];
    $unarchive = 0;
  

    $sql = "UPDATE publish_post SET is_archive='$unarchive' WHERE id=".$pid;
    if (mysqli_query($conn, $sql)) {
          $_SESSION['status_success_archive'] = "success";
          header("location:../Archive/archive_index.php");
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
      .card-margin {
          margin-bottom: 1.875rem;
      }

      .card {
          border: 0;
          box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
          -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
          -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
          -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      }
      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #ffffff;
          background-clip: border-box;
          border: 1px solid #e6e4e9;
          border-radius: 8px;
      }

      .card .card-header.no-border {
          border: 0;
      }
      .card .card-header {
          background: none;
          padding: 0 0.9375rem;
          font-weight: 500;
          display: flex;
          align-items: center;
          min-height: 50px;
      }
      .card-header:first-child {
          border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
      }

      .widget-49 .widget-49-title-wrapper {
        display: flex;
        align-items: center;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #edf1fc;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
        color: #4e73e5;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
        color: #4e73e5;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fcfcfd;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-day {
        color: #dde1e9;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-month {
        color: #dde1e9;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-success {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #e8faf8;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
        color: #17d1bd;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
        color: #17d1bd;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-info {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebf7ff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
        color: #36afff;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
        color: #36afff;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-warning {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: floralwhite;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-day {
        color: #FFC868;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-month {
        color: #FFC868;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-danger {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #feeeef;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-day {
        color: #F95062;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-month {
        color: #F95062;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-light {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fefeff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-day {
        color: #f7f9fa;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-month {
        color: #f7f9fa;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-dark {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebedee;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-day {
        color: #394856;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-month {
        color: #394856;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-base {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #f0fafb;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-day {
        color: #68CBD7;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-month {
        color: #68CBD7;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
        display: flex;
        flex-direction: column;
        margin-left: 1rem;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
        color: #3c4142;
        font-size: 14px;
      }

      .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
        color: #B1BAC5;
        font-size: 13px;
      }

      .widget-49 .widget-49-meeting-points {
        font-weight: 400;
        font-size: 13px;
        margin-top: .5rem;
      }

      .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
        display: list-item;
        color: #727686;
      }

      .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
        margin-left: .5rem;
      }

      .widget-49 .widget-49-meeting-action {
        text-align: right;
      }

      .widget-49 .widget-49-meeting-action a {
        text-transform: uppercase;
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
          while ($row = mysqli_fetch_assoc($res)) {
            $date = date_create($row['date_created']);
            $day = date_format($date, "d");
            $month = date_format($date, "M");
            $hours = date_format($date, "G:i a");
                    ?>
      <div class="col-lg-4">
          <div class="card card-margin shadows">
              <div class="card-header no-border">
                  <!-- <h5 class="card-title">MOM</h5> -->
              </div>
              <div class="card-body pt-0">
                  <div class="widget-49">
                      <div class="widget-49-title-wrapper">
                          <div class="widget-49-date-primary">
                              <span class="widget-49-date-day"><?php echo $day?></span>
                              <span class="widget-49-date-month"><?php echo $month?></span>
                          </div>
                          <div class="widget-49-meeting-info">
                              <span class="widget-49-pro-title"><?php echo $row['title']; ?></span>
                              <span class="widget-49-meeting-time"><?php echo $hours?></span>
                          </div>
                      </div>
                      <ol class="widget-49-meeting-points">
                          <li class="widget-49-meeting-item"><span><?php echo $row['descriptions']; ?></span></li>
                      </ol>
                      <div class="widget-49-meeting-action">
                          <form method="POST">
                            <input type="hidden" name="announcement_id" value="<?php echo $row['id']; ?>">
                            <button name="announcement_unarchive" class="btn btn-sm btn-flash-border-primary bg-danger text-white">
                              Unarchive
                            </button>
                          </form>
                      </div>
                  </div>
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
          while ($row = mysqli_fetch_assoc($res)) {
            $date = date_create($row['date_created']);
            $day = date_format($date, "d");
            $month = date_format($date, "M");
            $hours = date_format($date, "G:i a");
                    ?>
      <div class="col-lg-4">
          <div class="card card-margin shadows">
              <div class="card-header no-border">
                  <!-- <h5 class="card-title">MOM</h5> -->
              </div>
              <div class="card-body pt-0">
                  <div class="widget-49">
                      <div class="widget-49-title-wrapper">
                          <div class="widget-49-date-primary">
                              <span class="widget-49-date-day"><?php echo $day?></span>
                              <span class="widget-49-date-month"><?php echo $month?></span>
                          </div>
                          <div class="widget-49-meeting-info">
                              <span class="widget-49-pro-title"><?php echo $row['title']; ?></span>
                              <span class="widget-49-meeting-time"><?php echo $hours?></span>
                          </div>
                      </div>
                      <ol class="widget-49-meeting-points">
                          <li class="widget-49-meeting-item"><span><?php echo $row['descriptions']; ?></span></li>
                      </ol>
                      <div class="widget-49-meeting-action">
                        <form method="POST">
                            <input type="hidden" name="publication_id" value="<?php echo $row['id']; ?>">
                            <button name="publication_unarchive" class="btn btn-sm btn-flash-border-primary bg-danger text-white">
                              Unarchive
                            </button>
                          </form>
                      </div>
                  </div>
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
          while ($row = mysqli_fetch_assoc($res)) {
            $date = date_create($row['date_created']);
            $day = date_format($date, "d");
            $month = date_format($date, "M");
            $hours = date_format($date, "G:i a");
                    ?>
      <div class="col-lg-4">
          <div class="card card-margin shadows">
              <div class="card-header no-border">
                  <!-- <h5 class="card-title">MOM</h5> -->
              </div>
              <div class="card-body pt-0">
                  <div class="widget-49">
                      <div class="widget-49-title-wrapper">
                          <div class="widget-49-date-primary">
                              <span class="widget-49-date-day"><?php echo $day?></span>
                              <span class="widget-49-date-month"><?php echo $month?></span>
                          </div>
                          <div class="widget-49-meeting-info">
                              <span class="widget-49-pro-title"><?php echo $row['title']; ?></span>
                              <span class="widget-49-meeting-time"><?php echo $hours?></span>
                          </div>
                      </div>
                      <ol class="widget-49-meeting-points">
                          <li class="widget-49-meeting-item"><span><?php echo $row['descriptions']; ?></span></li>
                      </ol>
                      <div class="widget-49-meeting-action">
                        <form method="POST">
                          <button class="btn btn-sm btn-flash-border-primary bg-danger text-white">
                            Unarchive
                          </button>
                        </form>
                      </div>
                  </div>
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
