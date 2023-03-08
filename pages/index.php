<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="../styles/bootstrap.min (3).css">

    <title>Welcome</title>
  </head>
  <body>
    <!-- Using php sessions to display an error message if the user has an incorrect password or an issue with their password when signing up -->
    <?php
        require("user.php");
        if (isset($_SESSION["index_error"])){
            if ($_SESSION["index_error"]=="1"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>Your password is incorrect!
                </div>';               
            }
            else if ($_SESSION["index_error"]=="2"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>Your passwords did not match!
                </div>';
            }
            else if ($_SESSION["index_error"]=="3"){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh no! </strong>The email you entered is already associated with an account!
                </div>';
            }
        }
        else {
            $_SESSION["index_error"]="";
        }
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
                <a class="nav-link <?php if ($_SESSION["index_error"]=="1" || $_SESSION["index_error"]==""){
                echo "active";}?>" data-bs-toggle="tab" href="#login" aria-selected="true" role="tab" tabindex="-1">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($_SESSION["index_error"]=="2" || $_SESSION["index_error"]=="3"){
                echo "active";}?>" data-bs-toggle="tab" href="#signup" aria-selected="false" role="tab">Sign Up</a>
            </li>
            </ul>
            <!-- forms for login and sign up -->
            <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade <?php if ($_SESSION["index_error"]=="1" || $_SESSION["index_error"]==""){
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
            <div class="tab-pane fade <?php if ($_SESSION["index_error"]=="2" || $_SESSION["index_error"]=="3"){
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
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
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
                        <label for="county">County</label>
                        <select id="county" name="county" class="form-control">
                            <optgroup label="England">
                                <option>Bedfordshire</option>
                                <option>Berkshire</option>
                                <option>Bristol</option>
                                <option>Buckinghamshire</option>
                                <option>Cambridgeshire</option>
                                <option>Cheshire</option>
                                <option>City of London</option>
                                <option>Cornwall</option>
                                <option>Cumbria</option>
                                <option>Derbyshire</option>
                                <option>Devon</option>
                                <option>Dorset</option>
                                <option>Durham</option>
                                <option>East Riding of Yorkshire</option>
                                <option>East Sussex</option>
                                <option>Essex</option>
                                <option>Gloucestershire</option>
                                <option>Greater London</option>
                                <option>Greater Manchester</option>
                                <option>Hampshire</option>
                                <option>Herefordshire</option>
                                <option>Hertfordshire</option>
                                <option>Isle of Wight</option>
                                <option>Kent</option>
                                <option>Lancashire</option>
                                <option>Leicestershire</option>
                                <option>Lincolnshire</option>
                                <option>Merseyside</option>
                                <option>Norfolk</option>
                                <option>North Yorkshire</option>
                                <option>Northamptonshire</option>
                                <option>Northumberland</option>
                                <option>Nottinghamshire</option>
                                <option>Oxfordshire</option>
                                <option>Rutland</option>
                                <option>Shropshire</option>
                                <option>Somerset</option>
                                <option>South Yorkshire</option>
                                <option>Staffordshire</option>
                                <option>Suffolk</option>
                                <option>Surrey</option>
                                <option>Tyne and Wear</option>
                                <option>Warwickshire</option>
                                <option>West Midlands</option>
                                <option>West Sussex</option>
                                <option>West Yorkshire</option>
                                <option>Wiltshire</option>
                                <option>Worcestershire</option>
                            </optgroup>
                            <optgroup label="Wales">
                                <option>Anglesey</option>
                                <option>Brecknockshire</option>
                                <option>Caernarfonshire</option>
                                <option>Carmarthenshire</option>
                                <option>Cardiganshire</option>
                                <option>Denbighshire</option>
                                <option>Flintshire</option>
                                <option>Glamorgan</option>
                                <option>Merioneth</option>
                                <option>Monmouthshire</option>
                                <option>Montgomeryshire</option>
                                <option>Pembrokeshire</option>
                                <option>Radnorshire</option>
                            </optgroup>
                            <optgroup label="Scotland">
                                <option>Aberdeenshire</option>
                                <option>Angus</option>
                                <option>Argyllshire</option>
                                <option>Ayrshire</option>
                                <option>Banffshire</option>
                                <option>Berwickshire</option>
                                <option>Buteshire</option>
                                <option>Cromartyshire</option>
                                <option>Caithness</option>
                                <option>Clackmannanshire</option>
                                <option>Dumfriesshire</option>
                                <option>Dunbartonshire</option>
                                <option>East Lothian</option>
                                <option>Fife</option>
                                <option>Inverness-shire</option>
                                <option>Kincardineshire</option>
                                <option>Kinross</option>
                                <option>Kirkcudbrightshire</option>
                                <option>Lanarkshire</option>
                                <option>Midlothian</option>
                                <option>Morayshire</option>
                                <option>Nairnshire</option>
                                <option>Orkney</option>
                                <option>Peeblesshire</option>
                                <option>Perthshire</option>
                                <option>Renfrewshire</option>
                                <option>Ross-shire</option>
                                <option>Roxburghshire</option>
                                <option>Selkirkshire</option>
                                <option>Shetland</option>
                                <option>Stirlingshire</option>
                                <option>Sutherland</option>
                                <option>West Lothian</option>
                                <option>Wigtownshire</option>
                            </optgroup>
                            <optgroup label="Northern Ireland">
                                <option>Antrim</option>
                                <option>Armagh</option>
                                <option>Down</option>
                                <option>Fermanagh</option>
                                <option>Londonderry</option>
                                <option>Tyrone</option>
                            </optgroup>
                        </select>
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
$_SESSION["index_error"]="";
?>