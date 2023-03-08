<?php 
$user = User::load_by_id($_SESSION["user"]);

$active_dashboard = "";
$active_settings = "";

// finds what page the user is on and sets the active class for the navbar

if (str_ends_with($_SERVER["PHP_SELF"],"dashboard.php")){
  $active_dashboard = "active";
}
else if (str_ends_with($_SERVER["PHP_SELF"],"settings.php")){
  $active_settings = "active";
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-static-top" >
  <div class="container-fluid">
    <a class="navbar-brand" href="./dashboard.php">Health Advice Group</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li>
          <a class="nav-link <?php echo $active_dashboard ?> " href="./dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <!-- Button trigger modal -->
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#tripmode">Trip Mode</a>

        <!-- Modal -->
          <div class="modal fade" id="tripmode" tabindex="-1" aria-labelledby="tripmode_label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tripmode_label">Trip Mode</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                </div>
              </div>
            </div>
          </div>

        </li>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto">
          <?php

          // if the user is an admin, show the admin panel link
            if ($user->level=="Admin"):?>
            <li class="nav-link">
              <a class="nav-link" href="./admin.php">Admin Panel</a>
            </li>
            <?php endif;?>

          <li>
            <a class="nav-link" href="./report.php">Issue Report</a>
          </li>
          <li>
            <a class="nav-link <?php echo $active_settings ?> " href="./settings.php">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout-action.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>