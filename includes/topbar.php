  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    

    <?php if (isset($_SESSION['username'])): ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="logout.php" class="nav-link text-danger">Logout</a>
        </li>
    <?php else: ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="login.php" class="nav-link">Login</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="signup.php" class="nav-link">Signup</a>
        </li>
    <?php endif; ?>
</ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
<br>