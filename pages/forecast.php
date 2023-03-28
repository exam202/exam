<?php 
//ensures the user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}

    // Get weather and air quality data from weatherapi.com API

    if(isset($_POST['location'])) { // If user has entered a location
        if ($_POST['location'] == "" || $_POST['location'] == null){ // checks if the user has entered a location
            $location = str_replace(' ', '', $user->postcode);
        }
        else {
        $location = str_replace(' ', '', $_POST['location']); 
        }
    }
    else {
        $location = str_replace(' ', '', $user->postcode);
    }

    $apiKey = "19f268e57a9f47c6bc0131424230803"; 
    $url = "https://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$location&aqi=yes";

    // Use cURL to retrieve data from API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $weatherData = json_decode($data, true);

    if (isset($weatherData["error"]["message"])){
        $error = true;

        $location = str_replace(' ', '', $user->postcode);
        $url = "https://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$location&aqi=yes";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch); 
        $weatherData = json_decode($data, true);
    }
    $city = $weatherData['location']['name'];
    $region = $weatherData['location']['region'];
    $country = $weatherData['location']['country'];
    $localtime = $weatherData['location']['localtime'];
    $localtime = date("H", strtotime($localtime));

    // gets the weather data for the preferences
    $humidity = $weatherData["current"]['humidity'];
    $wind = $weatherData["current"]['wind_mph'];
    $uv_level = $weatherData["current"]['uv'];
    $aqi = $weatherData['current']['air_quality']['gb-defra-index'];
    $sunrise = $weatherData['forecast']['forecastday'][0]['astro']['sunrise'];
    $sunset = $weatherData['forecast']['forecastday'][0]['astro']['sunset'];
    $visibility = $weatherData['forecast']['forecastday'][0]['day']['avgvis_miles'];
    $precipitation = $weatherData['forecast']['forecastday'][0]['day']['totalprecip_mm'];

    $hour= $weatherData["forecast"]["forecastday"][0]["hour"];
?>
<!-- Display weather data -->
<div class="shadow card" style="height:100%;max-height:300px">
    <div class="card-body">
        <h4 class="card-title">Forecast for <?php echo $city . ", " . $region . ", " . $country?></h4>
        <!-- Makes the card have an internal scroll bar to save space on the dashboard -->
        <div class="px-4 py-1" style="height:100%;max-height:300px;position:relative;">
            <div class="row" style="max-height:100%;overflow:auto;">
                <table style="border:1px solid grey;">
                    <tr>
                        <?php 
                            // loops through and prints out the time for each hour
                            for ($x = 0; $x <= 23; $x++) {
                                $time = $hour[$x]['time'];
                                $time = substr($time, 11, 5);
                                // echos the time for each hour
                                echo 
                                '<th style="border:1px solid grey;">
                                    <h3 class="card-subtitle mx-2 my-2 text-muted">'. $time .'</h6>
                                </th>';
                            }
                            echo '</tr>';

                            
                            // loops through and prints out the temperature for each hour
                            echo '<tr>';
                            for ($x = 0; $x <= 23; $x++) {
                                $tempC = $hour[$x]['temp_c'];
                                
                                if ($x == $localtime){
                                    echo 
                                '<td style="border-right:1px solid grey;background-color:#D4F1F4;" id="current_time">';
                                }
                                else {
                                    echo 
                                '<td style="border-right:1px solid grey;">';
                                }
                            
                                echo
                                '   <h3>'. $tempC .'&#8451</h3>
                                </td>'."\r";
                            }
                            echo '</tr>';
                            // loops through and prints out the weather condition for each hour
                            echo '<tr>';
                            for ($x = 0; $x <= 23; $x++) {
                                $condition = $hour[$x]['condition']['text'];
                                if ($x == $localtime){
                                    echo 
                                '<td style="border-right:1px solid grey;background-color:#D4F1F4;" id="current_time">';
                                }
                                else {
                                    echo 
                                '<td style="border-right:1px solid grey;">';
                                }
                                echo
                                '   <h6 class="text-muted">'. $condition .'</h3>
                                </td>'."\r";
                            }
                            echo '</tr>';
                            // loops through and prints out the weather condition icon for each hour
                            echo '<tr>';
                            for ($x = 0; $x <= 23; $x++) {
                                $icon = $hour[$x]['condition']['icon'];
                                if ($x == $localtime){
                                    echo 
                                '<td style="border-right:1px solid grey;background-color:#D4F1F4;" id="current_time">';
                                }
                                else {
                                    echo 
                                '<td style="border-right:1px solid grey;">';
                                }
                                echo
                                '   <img src="https:' . $icon . '" alt="weather icon" style="width:50px;height:50px;">
                                </td>'."\r";
                            }
                            echo '</tr>';
                            
                            
                            // finds the current temperature and sets the session variables for hot and cold
                            $feels_like = $weatherData["current"]['feelslike_c'];
                            if ($feels_like < 13){
                                $_SESSION["cold"] = true;
                            }
                            else if ($feels_like > 13){
                                $_SESSION["hot"] = true;
                            }

                            
                            curl_close($ch);
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>