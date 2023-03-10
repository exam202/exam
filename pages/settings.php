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
            
            <!-- First name -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="first_name">First Name</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input required type="text" class="form-control" id="first_name" name="first_name" placeholder="<?php echo $user->first_name?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#firstname">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Last name -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="last_name">Last Name</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input required type="text" class="form-control" id="last_name" name="last_name" placeholder="<?php echo $user->last_name?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#lastname">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input required type="text" class="form-control" id="email" name="email" placeholder="<?php echo $user->email?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#emailmodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Country -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="country_label">Country</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input required type="text" class="form-control" id="country_label" name="country" placeholder="<?php echo $user->country?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#countrymodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Postcode -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="postcode_label">Postcode</label>
                        <div class="row"> 
                            <div class="col-md-8">
                                <input required type="text" class="form-control" id="postcode_label" name="postcode" placeholder="<?php echo $user->postcode?>" readonly="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#postcodemodal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
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

            <!-- Theme -->
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

            <!-- Password -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col-md-10">
                                <button type="button" id="password" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#passwordmodal" style="width:95%;">Edit Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This section contains the modals for each of the settings -->

        <!-- Modal for the first name input required -->
        <div class="modal fade" id="firstname" tabindex="-1" aria-labelledby="firstname_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="firstname_label">First Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input required type="text"
                                class="form-control" name="first_name"  aria-describedby="helpId" value="<?php echo $user->first_name?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your first name above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for the last name input required -->
        <div class="modal fade" id="lastname" tabindex="-1" aria-labelledby="lastname_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lastname_label">Last Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input required type="text"
                                class="form-control" name="last_name"  aria-describedby="helpId" value="<?php echo $user->last_name?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your last name above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for the email input required -->
        <div class="modal fade" id="emailmodal" tabindex="-1" aria-labelledby="email_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="email_label">Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <input required type="email"
                                class="form-control" name="email"  aria-describedby="helpId" value="<?php echo $user->email?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your email above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for the country selection -->
        <div class="modal fade" id="countrymodal" tabindex="-1" aria-labelledby="country_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="country_label">Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select id="country" name="country" aria-describedby="helpId" class="form-control">
                            <option value="United Kingdom">United Kingdom</option>
                        </select>
                        <small id="helpId" class="form-text text-muted pb-2">More countries will be added in the future</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for the Postcode selection -->
        <div class="modal fade" id="postcodemodal" tabindex="-1" aria-labelledby="postcode_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postcode_label">Postcode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="settings-action.php" method="post">
                            <input required type="text"
                                class="form-control" name="postcode"  aria-describedby="helpId" value="<?php echo $user->postcode?>">
                            <small id="helpId" class="form-text text-muted pb-2">Enter your postcode above</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for the Preference selection -->
        <div class="modal fade" id="preferencesmodal" tabindex="-1" aria-labelledby="preference_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="preference_label">Preference</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <fieldset class="form-group">
                                <span>Please check all which you would like to see.</span>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="checkbox" value="" id="hayfever" name="hayfever" <?php if ($user->preferences["hayfever"] =="1"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="hayfever">
                                    Hayfever
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="checkbox" value="" id="wind" name="wind" <?php if ($user->preferences["wind"] =="1"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="wind">
                                    Wind
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="checkbox" value="" id="air_quality" name="air_quality" <?php if ($user->preferences["air_quality"] =="1"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="air_quality">
                                    Air Quality
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="checkbox" value="" id="humidity" name="humidity" <?php if ($user->preferences["humidity"] =="1"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="humidity">
                                    Humidity
                                    </label>
                                </div>

                            </fieldset>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for the Theme selection -->
        <div class="modal fade" id="thememodal" tabindex="-1" aria-labelledby="theme_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theme_label">Theme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="cyborg" value="cyborg.css"
                                    <?php if ($user->theme == "cyborg.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="cyborg">
                                    Cyborg
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="flatly" value="flatly.css"
                                    <?php if ($user->theme == "flatly.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="flatly">
                                    Flatly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="journal" value="journal.css"
                                    <?php if ($user->theme == "journal.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="journal">
                                    Journal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="sandstone" value="sandstone.css"
                                    <?php if ($user->theme == "sandstone.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="sandstone">
                                    Sandstone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="slate" value="slate.css"
                                    <?php if ($user->theme == "slate.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="slate">
                                    Slate
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input required class="form-check-input"required  type="radio" name="theme" id="superhero" value="superhero.css"
                                    <?php if ($user->theme == "superhero.css"){echo 'checked=""';}?>>
                                    <label class="form-check-label" for="superhero">
                                    Superhero
                                    </label>
                                </div>
                                
                                
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal for Password changing -->
        <div class="modal fade" id="passwordmodal" tabindex="-1" aria-labelledby="password_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="password_label">Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="settings-action.php" method="post">
                            <fieldset class="form-group">
                                <div class="form-group">
                                    <label for="current_password" class="form-label mt-4">Password</label>
                                    <input required type="password" class="form-control" id="current_password" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password" class="form-label mt-4">New Password</label>
                                    <input required type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="verify_password" class="form-label mt-4">Verify Password</label>
                                    <input required type="password" class="form-control" id="verify_password" name="verify_password">
                                </div>
                                
                                
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
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