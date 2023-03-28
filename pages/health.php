<?php 
//ensures the user is logged in and sends them to the login page if they are not
require "./user.php";
$conn = connect();
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

        <title>Health Tracker</title>
    </head>
    
    <body>
        <?php include "nav.php";
        if ($_SESSION["notification"]=="10"){
          echo 
          '<div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              Graph has been updated!
          </div>';
        } 
        ?>
      
        <div class="container">
            <div class="row pt-3">  
                <div class="col-md-6 px-1 py-1">
                    <div class="shadow card" style="height:500px">
                        <div class="card-body">
                            <!-- chart location for calories -->
                            <div id="caloriesChart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-1 py-1">
                    <div class="shadow card" style="height:500px">
                        <div class="card-body">
                            <!-- chart location for steps -->
                            <div id="stepsChart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-1 py-1">
                    <div class="shadow card" style="height:100%">
                        <div class="card-body">
                        <h3 class="card-title pl">Edit Time Period on Graphs</h3>
                            <!-- form for changing the time period -->
                            <form action="health-action.php" method="POST">
                              <div class="form-check">
                                <label for="days">Enter Amount of Days:</label>
                                <input type="int" id="days" name="days" required>
                                <button type="submit" class="btn btn-primary btn-sm">Change</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 px-1 py-1">
                    <div class="shadow card">
                        <div class="card-body">
                            <h3 class="card-title">Enter your health data</h3>
                            <!-- form for entering health data -->
                            <form action="health-action.php" method="POST">
                                <div class="form-check">
                                    <label for="date">Enter the date:</label>
                                    <input class="form-control" type="date" id="date" name="date" required>
                                    <label for="steps">Enter the number of steps you took:</label>
                                    <input class="form-control" type="text" id="steps" name="steps" required>
                                    <label for="calories">Enter the number of calories you burnt:</label>
                                    <input class="form-control" type="text" id="calories" name="calories" required>
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
      </div>
      

      <!-- jQuery, Popper.js and Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      
      <!-- Canvasjs -->
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

      <!-- Plotting Graphs -->

      <!-- Getting the data -->
      <?php 

      $sql = "SELECT * FROM health_tracker WHERE user_id = '$user->id' ORDER BY date DESC";
      $result = mysqli_query($conn,$sql);
      if (isset($_SESSION["days"])){
        $difference = $_SESSION["days"];
      }
      else {
        $difference = 7;
      }
      $timestamp = strtotime("-$difference days");
      $period = date("Y-m-d", $timestamp);

      $calDataPoints = array();
      $stepsDataPoints = array();

      while ($row = $result->fetch_assoc()){
        
        if ($row["date"] >= $period){
          array_push($calDataPoints, array("y" => $row["calories_burnt"], "label" => $row["date"]));
          array_push($stepsDataPoints, array("y" => $row["steps_taken"], "label" => $row["date"]));
        }
      }
      
      ?>

      <script>
      
      window.onload = function() {

      // Plotting the graph for calories burnt
      var $title = "Calories Burnt - <?php echo $difference?> Days";
      var caloriesChart = new CanvasJS.Chart("caloriesChart", {
        animationEnabled: true,
        title:{
          text: $title
        },
        axisY: {
          title: "Calories Burnt",
          includeZero: true,
        },
        data: [{
          type: "bar",
          yValueFormatString: "###",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($calDataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });

      // Plotting the graph for steps taken
      var $title = "Steps Taken - <?php echo $difference?> Days";
      var stepsChart = new CanvasJS.Chart("stepsChart", {
        animationEnabled: true,
        title:{
          text: $title
        },
        axisY: {
          title: "Steps Taken",
          includeZero: true,
        },
        data: [{
          type: "bar",
          yValueFormatString: "###",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($stepsDataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      
      stepsChart.render();
      caloriesChart.render();
      }
      </script>
    </body>
</html>