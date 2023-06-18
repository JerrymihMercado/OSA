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
if (isset($_POST['announcement_unarchive_submit']) && isset($_POST['announce_id_input'])) {
 
    $aid = $_POST['announce_id_input'];
    
    $unarchive = 0;
     
    $sql = "UPDATE announcement SET is_archive='$unarchive' WHERE id=".$aid;
    if (mysqli_query($conn, $sql)) {
          $_SESSION['status_success_unarchive'] = "success";
          header("location:../Archive/archive_index.php");
          session_unset($_SESSION['status_success_unarchive']);
    } else {
          echo '<script language="javascript">';
          echo 'alert("error")';
          echo '</script>';
    }

}
if (isset($_POST['publication_unarchive_submit'])) {
 
    $pid = $_POST['post_id_input'];
    $unarchive = 0;
  

    $sql = "UPDATE publish_post SET is_archive='$unarchive' WHERE id=".$pid;
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status_success_unarchive'] = "success";
        header("location:../Archive/archive_index.php");
        session_unset($_SESSION['status_success_unarchive']);
    } else {
          echo '<script language="javascript">';
          echo 'alert("error")';
          echo '</script>';
    }
}
if (isset($_POST['research_unarchive_submit'])) {
 
    $pid = $_POST['research_post_id_input'];
    $unarchive = 0;
  

    $sql = "UPDATE research_and_eval SET is_archive='$unarchive' WHERE id=".$pid;
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status_success_unarchive'] = "success";
        header("location:../Archive/archive_index.php");
        session_unset($_SESSION['status_success_unarchive']);
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
<body style="background-color: #fdfdfd">

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
                        <button class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="setID(<?php echo $row['id']; ?>)" data-mdb-toggle="modal" data-mdb-target="#announcement_unarchive">
                          Unarchive
                        </button>
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
                        <button name="publication_unarchive" class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="getID(<?php echo $row['id']; ?>)" data-mdb-toggle="modal" data-mdb-target="#publication_unarchive">
                          Unarchive
                        </button>
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
                        <button name="research_unarchive" class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="getID2(<?php echo $row['id']; ?>)" data-mdb-toggle="modal" data-mdb-target="#research_unarchive">
                          Unarchive
                        </button>
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
  <!-- Announcement Unarchive Modal -->
  <div class="modal fade" id="announcement_unarchive" tabindex="-1" role="dialog" aria-labelledby="announcement_unarchive" aria-hidden="true">
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
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Unarchive Announcement</h4>
                          <div class="form-group">
                              <input type="hidden" class="form-control" placeholder="Enter id" id="announce_id_input" name="announce_id_input" required>
                          </div>
                          
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to unarchive this announcement? <span id="anno"> </p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-mdb-dismiss="modal">
                          Cancel
                      </button>
                     
                      <button type="submit" name="announcement_unarchive_submit" class="btn btn-danger px-4" >
                          archive
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  <!-- Research Unarchive Modal -->
  <div class="modal fade" id="research_unarchive" tabindex="-1" role="dialog" aria-labelledby="research_unarchive" aria-hidden="true">
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
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Unarchive Research Post</h4>
                          <div class="form-group">
                              <input type="hidden" class="form-control" placeholder="Enter id" id="research_post_id_input" name="research_post_id_input" required>
                          </div>
                          
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to unarchive this Post? <span id="research_post"> </p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-mdb-dismiss="modal">
                          Cancel
                      </button>
                     
                      <button type="submit" name="research_unarchive_submit" class="btn btn-danger px-4" >
                          archive
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  <!-- Publication Unarchive Modal -->
  <div class="modal fade" id="publication_unarchive" tabindex="-1" role="dialog" aria-labelledby="publication_unarchive" aria-hidden="true">
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
                          <h4 class="justify-content-center d-flex fw-semibold pt-3">Unarchive Publication</h4>
                          <div class="form-group">
                              <input type="hidden" class="form-control" placeholder="Enter id" id="post_id_input" name="post_id_input" required>
                          </div>
                          
                          <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to unarchive this Post? <span id="post"> </p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-mdb-dismiss="modal">
                          Cancel
                      </button>
                     
                      <button type="submit" name="publication_unarchive_submit" class="btn btn-danger px-4" >
                          archive
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>

<script>
  function setID(id) {
      let announce_id = document.getElementById("anno");
      announce_id.innerText = id;
      document.getElementById("announce_id_input").value = id
      
  }
  function getID(id) {
      let announce_id = document.getElementById("post");
      announce_id.innerText = id;
      document.getElementById("post_id_input").value = id
      
  }
  function getID2(id) {
      let announce_id = document.getElementById("research_post");
      announce_id.innerText = id;
      document.getElementById("research_post_id_input").value = id
      
  }
</script>

<?php include_once '../Components/footer.php' ?>
<!-- MDB -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<!-- Custom scripts -->
</body>
</html>
