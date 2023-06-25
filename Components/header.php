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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid navi-section">
        <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../index.php" active>HOME</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../about_us.php">ABOUT US</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../Section/impu.php">IMPU</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../CDESU/cdesu.php">CDESU</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../GSU/gsu_index.php">GSU</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../SOU/sou_index.php">SOU</a>
            </li>
            <li class="nav-item me-2">
            <a class="nav-link text-white" href="../SDB/sdb_index.php">SDB</a>
            </li>
            <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item me-2">
                        <a href="../Archive/archive_index.php" class="nav-link text-white">
                            ARCHIVES
                        </a>
                        </li>';
                }
            }else{
                echo '';
            }
            ?>
            <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item me-2">
                        <a href="../Complain/complain_index.php" class="nav-link text-white">
                            COMPLAINS
                        </a>
                        </li>';
                }
            }else{
                echo '';
            }
            ?>
        </ul>
        </div>
        <div class="d-flex align-items-center">
        <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
                    echo '<li class="nav-item-out">
                            <div class="btn-group shadow-0">
                            <a type="button" class="link text-white ps-3 dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                                LOGOUT
                            </a>
                            <ul class="dropdown-menu">
                                
                                <form action="../logout.php" method="POST">
                                    <li><button class="dropdown-item rounded-5" name="logout">Logout</button></li>
                                </form>
                            </ul>
                            </div>
                        </li>';
                }
            }else{
                echo '<li class="nav-item-out">
                        <div class="btn-group shadow-0">
                        <a type="button" class="link text-white ps-3" data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                            Login / Register
                        </a>
                        </div>
                    </li>
                    ';
            }
            ?> 
        </div>
    </div>
</nav>
<!-- Modal Login-->
<div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header border-0">
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="justify-content-center d-flex" style="height: 50px;">
            <img src="../img/logo.png" alt="login-logo" class="shadow rounded-circle">
          </div>
          <div class="py-2 justify-content-center d-flex">
            <h5>CLSU Account for OSA</h5>
          </div>
          <div class="text-center">
            <p>Log in with the credentials of your account to get more accurate view of office of student affairs.</p>
          </div>
          <form method="POST">
              <!-- Email input -->
              <div class="form-outline mb-3 mt-4">
                  <input type="email" id="email" name="email" class="form-control" required/>
                  <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-2">
                  <input type="password" id="password" name="password" class="form-control" required/>
                  <label class="form-label" for="password">Password</label>
              </div>
              <div class="mb-4 justify-content-end d-flex">
                <a href="../Forgot_Password/send_reset_pass.php" class="text-muted">Forgot password?</a>
              </div>
              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Continue</button>
              <div class="pt-3 text-center">
                  Don't have an account? <a href="../Form_Register/register_index.php" class="text-success">Register Here</a>
              </div>
          </form>
        </div>
        </div>
    </div>
  </div>