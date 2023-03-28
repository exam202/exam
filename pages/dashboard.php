<?php 
require "./user.php";
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}
$conn = connect();
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

    <title>Dashboard</title>
  </head>
  
  <body>
    <?php include "nav.php";
    // Checks if the user has submitted a report and displays a notification if they have
    if (isset($_SESSION["notification"])){
        if ($_SESSION["notification"]=="5"){
            echo '<div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Your report has been submitted!
            </div>';               
            $_SESSION["notification"]="";
        }
        
    }
    else {
        $_SESSION["notification"]="";
    }
    ?>

    

    <div class="container">
        <div class="row pt-5">  
            <!-- Weather Card loaded from seperate file -->
            <div class="col-md-6 px-1 py-1">
                <?php include "forecast.php"?>
            </div>
            
            <!-- Weather Tips Card -->
            <div class="col-md-3 px-1 py-1">
                <div class="shadow card" style="height:100%;max-height:300px">
                    <div class="card-body">
                        <h4 class="card-title">Weather Tips</h4>
                        <?php 
                        if (isset($_SESSION["rain"])){
                            if ($_SESSION["rain"]==true){
                                echo "<p>We advise you bring a coat with you today.</p>";
                                $_SESSION["rain"]=="";
                            } 
                        }
                        if (isset($_SESSION["cold"])){
                            if ($_SESSION["cold"]==true){
                                echo "<p>We advise you to wear thick layers today.</p>";
                                $_SESSION["cold"]=="";
                            }
                        }
                        if (isset($_SESSION["hot"])){
                            if ($_SESSION["hot"]==true){
                                echo "<p>We advise you to wear thin layers today.</p>";
                                $_SESSION["hot"]=="";
                            }
                        }
                        ?>
                        <form method="POST">
                            <div class="row">
                            <label for="location">Change Location</label>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Change</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
                
            </div>
            <!-- Health Tracker Card -->
            <div class="col-md-3 px-1 py-1">
                <div class="shadow card" style="height:100%;max-height:300px">
                    <div class="card-body">
                        <h4 class="card-title">Health Tracker</h4>
                        <a href="health.php">
                        <img src='../images/health-tracker.png' alt='Weather Icon' style="height:90%"><br>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Displays an error message if the user has entered an incorrect location -->
        <?php if (isset($_SESSION["notification"]) and $_SESSION["notification"] == "6"){
                echo 
                '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    You entered a location which is invalid or we cannot provide at the minute! We have displayed the weather for your default location instead.
                </div>'; 
            } ?>
        <!-- Checks the user preferences and loads the card for them if the user has them selected -->
        <div class="row">  
            <!-- Wind Speed -->
            <?php if($user->preferences["wind"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Wind Speed</h4>
                            <h3> <?php echo $wind ?> mph</h3>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#wind_tips">View Tips</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Air Quality -->
            <?php if($user->preferences["air_quality"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Air Quality</h4>
                            <h3> <?php echo $aqi ?></h3>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#air_quality_tips">View Tips</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- UV Level -->
            <?php if($user->preferences["uv_level"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">UV Level</h4>
                            <h3> <?php echo $uv_level?></h3>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#uv_level_tips">View Tips</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Humidity -->
            <?php if($user->preferences["humidity"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Humidity</h4>
                            <h3> <?php echo $humidity?>%</h3>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#humidity_tips">View Tips</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Sunset and sunrise -->
            <?php if($user->preferences["sun"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Sunrise</h4>
                            <h3> <?php echo $sunrise?></h3>
                            <h4 class="card-title">Sunset</h4>
                            <h3> <?php echo $sunset?></h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Visibility -->
            <?php if($user->preferences["visibility"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Visibility</h4>
                            <h3> <?php echo $visibility?> Miles</h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Precipitation -->
            <?php if($user->preferences["precipitation"] == 1):?>
                <div class="col-md-3 px-1 py-1">
                    <div class="shadow card" style="height:100%;max-height:300px">
                        <div class="card-body">
                            <h4 class="card-title">Total Precipitation</h4>
                            <h3> <?php echo $precipitation?> mm</h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Modals -->

    <!-- Edit Location Modal --> 
    <div class="modal fade" id="editlocation" tabindex="-1" aria-labelledby="editlocation_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editlocation_label">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <label for="location">Enter Postcode OR City Name:</label>
                        <input type="text" id="location" name="location" required>
                        <button type="submit" class="btn btn-primary">Get Weather</button>
                    </form>
                </div>
            </div>
        </div>    
    </div>

    <!-- Wind Tips Modal -->   
    <div class="modal fade" id="wind_tips" tabindex="-1" aria-labelledby="wind_tips_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wind_tips_label">Wind Tips</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php 
                        // Get the tips from the database and displays them in order of severity 
                        $sql = "SELECT * FROM tips WHERE preference='wind' ORDER BY severity ASC";
                        $result = mysqli_query($conn,$sql);
                        while ($row = $result->fetch_assoc()){
                            $severity = $row["severity"];
                            if($severity == 1){
                                $severity = "High";
                            }else if($severity == 2){
                                $severity = "Medium";
                            }else{
                                $severity = "Low";
                            }
                            echo '<p>'.$row["tip"].' - Severity: '.$severity.'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>    
    </div>
    
    <!-- Air Quality Tips Modal -->   
    <div class="modal fade" id="air_quality_tips" tabindex="-1" aria-labelledby="air_quality_tips_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="air_quality_tips_label">Air Quality Tips</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php 
                        // Get the tips from the database and displays them in order of severity 
                        $sql = "SELECT * FROM tips WHERE preference='air_quality' ORDER BY severity ASC";
                        $result = mysqli_query($conn,$sql);
                        while ($row = $result->fetch_assoc()){
                            $severity = $row["severity"];
                            if($severity == 1){
                                $severity = "High";
                            }else if($severity == 2){
                                $severity = "Medium";
                            }else{
                                $severity = "Low";
                            }
                            echo '<p>'.$row["tip"].' - Severity: '.$severity.'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>    
    </div>

    <!-- UV Level Tips Modal -->   
    <div class="modal fade" id="uv_level_tips" tabindex="-1" aria-labelledby="uv_level_tips_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uv_level_tips_label">UV Level Tips</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php 
                        // Get the tips from the database and displays them in order of severity 
                        $sql = "SELECT * FROM tips WHERE preference='uv_level' ORDER BY severity ASC";
                        $result = mysqli_query($conn,$sql);
                        while ($row = $result->fetch_assoc()){
                            $severity = $row["severity"];
                            if($severity == 1){
                                $severity = "High";
                            }else if($severity == 2){
                                $severity = "Medium";
                            }else{
                                $severity = "Low";
                            }
                            echo '<p>'.$row["tip"].' - Severity: '.$severity.'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>    
    </div>

    <!-- Humidity Tips Modal -->   
    <div class="modal fade" id="humidity_tips" tabindex="-1" aria-labelledby="humidity_tips_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="humidity_tips_label">Humidity Tips</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php 
                        // Get the tips from the database and displays them in order of severity 
                        $sql = "SELECT * FROM tips WHERE preference='humidity' ORDER BY severity ASC";
                        $result = mysqli_query($conn,$sql);
                        while ($row = $result->fetch_assoc()){
                            $severity = $row["severity"];
                            if($severity == 1){
                                $severity = "High";
                            }else if($severity == 2){
                                $severity = "Medium";
                            }else{
                                $severity = "Low";
                            }
                            echo '<p>'.$row["tip"].' - Severity: '.$severity.'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>    
    </div>

    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>