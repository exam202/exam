<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="../styles/flatly.css">

    <title>Welcome</title>
  </head>
  <body>
    <!-- Using php sessions to display an error message if the user has an incorrect password or an issue with their password when signing up -->
    <?php
        session_start();
        if (isset($_SESSION["notification"])){
            if ($_SESSION["notification"]=="1"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>Your password is incorrect!
                </div>';         
                      
            }
            else if ($_SESSION["notification"]=="2"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>Your passwords did not match!
                </div>';
            }
            else if ($_SESSION["notification"]=="3"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>The email you entered is already associated with an account!
                </div>';
            }
            else if ($_SESSION["notification"]=="4"){
                echo '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success! </strong>Your account has been created!
                </div>';
            }
            else if ($_SESSION["notification"]=="9"){
                echo '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    You have been logged out!
                </div>';
            }
        }
        $_SESSION["notification"]="";
        
    ?>
    <div class="container">
      <div class="row pt-5">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
        <!-- links to show the correct form for login and sign up, the php is checking the error and making sure the user is on the correct form -->
        <ul class="nav nav-tabs" role="tablist">
            <image src="../images/logo.png" alt="logo" height="40px" class="pr-1">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($_SESSION["notification"]=="1" || $_SESSION["notification"]==""){
                echo "active";}?>" data-bs-toggle="tab" href="#login" aria-selected="true" role="tab" tabindex="-1">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($_SESSION["notification"]=="2" || $_SESSION["notification"]=="3"){
                echo "active";}?>" data-bs-toggle="tab" href="#signup" aria-selected="false" role="tab">Sign Up</a>
            </li>
            </ul>
            <!-- form for login -->
            <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade <?php if ($_SESSION["notification"]=="1" || $_SESSION["notification"]==""){
                echo "active show";}?> " id="login" role="tabpanel">
                <form action="login-action.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- form for sign up -->
            <div class="tab-pane fade <?php if ($_SESSION["notification"]=="2" || $_SESSION["notification"]=="3"){
                echo "active show";}?>" id="signup" role="tabpanel">
                <form action="signup-action.php" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="verify_password">Verify Password</label>
                        <input type="password" class="form-control" id="verify_password" name="verify_password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>      
                        <select id="country" name="country" class="form-control">
                            <option value="United Kingdom">United Kingdom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode">
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>



            
            

        </div>
        <div class="col-md-3">
        </div>
      </div>
    
    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
<?php
//unsets the password error
$_SESSION["notification"]="";
?>