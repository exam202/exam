<?php 
require "./user.php";
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="../styles/<?php echo $user->theme?>">

        <title>Settings</title>
    </head>
    <body>
    <?php include "nav.php"; ?>
    <div class="container">
      <div class="row pt-5">
        <div class="col-md-3">
        </div>
        <!-- This section will show the user their current settings and have a button which will open a modal for them to change it -->
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="first_name">First Name</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?php echo $user->first_name?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#firstname">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="last_name">Last Name</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?php echo $user->last_name?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#lastname">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $user->email?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#emailmodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="country">Country</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="country" name="country" placeholder="<?php echo $user->country?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#countrymodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="county">County</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="county" name="county" placeholder="<?php echo $user->county?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#countymodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="preferences">Preferences</label>
                        <div class="row">
                            <div class="col-md-10">
                                <button type="button" id="preferences" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#preferencesmodal" style="width:95%;">Edit Preferences</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="theme">Theme</label>
                        <div class="row">
                            <div class="col-md-10">
                                <button type="button" id="theme" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#thememodal" style="width:95%;">Edit Theme</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col-md-10">
                                <button type="button" id="password" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#password" style="width:95%;">Edit Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- This section contains the modals for each of the settings -->
        <div class="modal fade" id="firstname" tabindex="-1" aria-labelledby="firstname_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="firstname_label">First Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input type="text"
                                class="form-control" name="first_name"  aria-describedby="helpId" value="<?php echo $user->first_name?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your first name above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lastname" tabindex="-1" aria-labelledby="lastname_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lastname_label">Last Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input type="text"
                                class="form-control" name="last_name"  aria-describedby="helpId" value="<?php echo $user->last_name?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your last name above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="emailmodal" tabindex="-1" aria-labelledby="email_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="email_label">Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input type="text"
                                class="form-control" name="email"  aria-describedby="helpId" value="<?php echo $user->email?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your email above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="countrymodal" tabindex="-1" aria-labelledby="country_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="country_label">Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input type="text"
                                class="form-control" name="country"  aria-describedby="helpId" value="<?php echo $user->country?>">
                            <small id="helpId" class="form-text text-muted pb-2">Select your country above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="countymodal" tabindex="-1" aria-labelledby="county_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="county_label">County</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input type="text"
                                class="form-control" name="County"  aria-describedby="helpId" value="<?php echo $user->county?>">
                            <small id="helpId" class="form-text text-muted pb-2">Select your county above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
        </div>
    </div> 
</div>

    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>