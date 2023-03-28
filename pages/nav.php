<?php 
// this is used on every page other than the login and sign up and is pulled in using the include function
$user = User::load_by_id($_SESSION["user"]);

$active_dashboard = "";
$active_health = "";
$active_report = "";
$active_admin_dashboard = "";
$active_settings = "";

// finds what page the user is on and sets the active class for the navbar


if (str_contains($_SERVER["PHP_SELF"],"admin")){
  $active_admin_dashboard = "active";
}
else if (str_ends_with($_SERVER["PHP_SELF"],"dashboard.php")){
  $active_dashboard = "active";
}
else if (str_ends_with($_SERVER["PHP_SELF"],"health.php")){
  $active_health = "active";
}
else if (str_ends_with($_SERVER["PHP_SELF"],"report.php")){
  $active_report = "active";
}
else if (str_ends_with($_SERVER["PHP_SELF"],"settings.php")){
  $active_settings = "active";
}
?>
<style> /* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-static-top" >
  <div class="container-fluid">
    <a class="navbar-brand mx-3" href="./dashboard.php">Health Advice Group</a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mx-3" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li>
          <a class="nav-link <?php echo $active_dashboard ?> " href="./dashboard.php">Dashboard</a>
        </li>
        <li>
          <a class="nav-link <?php echo $active_health ?> " href="./health.php">Health Tracker</a>
        </li>
        <li>
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
                  Coming Soon!
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
            if ($user->level=="admin" || $user->level=="moderator"):?>
            <li>
              <a class="nav-link <?php echo $active_admin_dashboard ?>" href="./admin-dashboard.php">Admin Panel</a>
            </li>
            <?php endif;?>

          <li>
            <a class="nav-link <?php echo $active_report ?>" href="./report.php">Issue Report</a>
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