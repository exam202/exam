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

    <title>Dashboard</title>
  </head>
  
  <body>
    <?php include "nav.php"; 


    // Get weather and air quality data from weatherapi.com API

    if(isset($_POST['location'])) { // If user has entered a location
    $location = str_replace(' ', '', $_POST['location']); // Remove spaces from input
    }
    else {
        $location = str_replace(' ', '', $user->postcode); // If user hasnt entered a location, use their saved location and remove spaces
    }

    $apiKey = "19f268e57a9f47c6bc0131424230803"; 
    $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$location&aqi=yes";

    // Use cURL to retrieve data from API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    if($data === false) {
        echo "Error retrieving data from API: " . curl_error($ch);
    } else {
        $weatherData = json_decode($data, true);

        if($weatherData === null || isset($weatherData['error'])) {
        echo "Error retrieving data from API: " . $weatherData['error']['message'];
        } 
        else {
        // Extract relevant data from API response
        $city = $weatherData['location']['name'];
        $region = $weatherData['location']['region'];
        $country = $weatherData['location']['country'];
        $tempC = $weatherData['current']['temp_c'];
        $condition = $weatherData['current']['condition']['text'];
        $icon = $weatherData['current']['condition']['icon'];
        $aqi = $weatherData['current']['air_quality']['gb-defra-index'];
        $humidity = $weatherData['current']['humidity'];
        $wind = $weatherData['current']['wind_mph'];
        $uv = $weatherData['current']['uv'];
        }
    }

    curl_close($ch);
    ?>

    

    <div class="container">
        <div class="row pt-5">  
            <div class="col-md-6 px-1 py-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Current Weather for <?php echo $city,", ", $region,", ", $country ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $condition ?></h6>
                        <p class="card-text">Temperature: <?php echo $tempC ?></p>
                        <img src='<?php echo $icon ?>' alt='Weather Icon'><br>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editlocation">Edit Location</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-1 py-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Current Weather for <?php echo $city,", ", $region,", ", $country ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $condition ?></h6>
                        <p class="card-text">Temperature: <?php echo $tempC ?></p>
                        <img src='<?php echo $icon ?>' alt='Weather Icon'><br>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editlocation">Edit Location</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-md-3 px-1 py-1">
                f
            </div>
            <div class="col-md-3 px-1 py-1">
                f
            </div>
            <div class="col-md-3 px-1 py-1">
                f
            </div>
            <div class="col-md-3 px-1 py-1">
                f
            </div>
        </div>
    </div>


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
    </div>
    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>