<?php 
require "./user.php";
//ensures the user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    // check if user is admin or moderator
    $user = User::load_by_id($_SESSION["user"]);
    if ($user->level!="admin"){
        if ($user->level!="moderator"){
            header("Location: dashboard.php");
        }
    }
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

    <title>Admin Tip Management</title>
  </head>
  
  <body>
    <?php 
    include "nav.php";
    $conn = connect();
    
    ?>

    <div class="container">
        <div class="row pt-5">  
            <div class="col-md-12 px-1">
                <div class="row">
                    <!-- Button to trigger new tip modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_tip" style="max-width:100px">New Tip</button>
                    <!-- Modal conataining form -->
                    <div class="modal fade" id="new_tip" tabindex="-1" aria-labelledby="new_tip_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="new_tip_label">New Tip</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="admin-new-tip-action.php">
                                        <label for="preference">Preference</label>
                                        <select id="preference" name="preference" class="form-control">
                                            <option value="wind">Wind</option>    
                                            <option value="air_quality">Air Quality</option>    
                                            <option value="humidity">Humidity</option>
                                            <option value="uv_level">UV Level</option>
                                        </select>
                                        <label for="severity">Severity</label>
                                        <select id="severity" name="severity" class="form-control">
                                            <option value="1">High</option>
                                            <option value="2">Medium</option>
                                            <option value="3">Low</option>
                                        </select>
                                        <label for="tip">Tip</label>
                                        <textarea id="tip" name="tip" class="form-control" maxlength="63"></textarea>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row py-2">
                        <!-- Card for current wind tips -->
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">Wind</h4>
                                    <?php 
                                        $sql = "SELECT * FROM tips WHERE preference='wind'";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = $result->fetch_assoc()){
                                            echo '<p>'.$row["tip"].'</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Card for current air quality tips -->
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">Air Quality</h4>
                                    <?php 
                                        $sql = "SELECT * FROM tips WHERE preference='air_quality'";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = $result->fetch_assoc()){
                                            echo '<p>'.$row["tip"].'</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <!-- Card for current humidity tips -->
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">Humidity</h4>
                                    <?php 
                                        $sql = "SELECT * FROM tips WHERE preference='humidity'";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = $result->fetch_assoc()){
                                            echo '<p>'.$row["tip"].'</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Card for current uv level tips -->
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">UV Level</h4>
                                    <?php 
                                        $sql = "SELECT * FROM tips WHERE preference='uv_level'";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = $result->fetch_assoc()){
                                            echo '<p>'.$row["tip"].'</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>