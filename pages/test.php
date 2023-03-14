<?php


    // Get weather and air quality data from weatherapi.com API

    if(isset($_POST['location'])) { // If user has entered a location
    $location = str_replace(' ', '', $_POST['location']); // Remove spaces from input
    }
    else {
        $location = str_replace(' ', '', 'tr148ry'); // If user hasnt entered a location, use their saved location and remove spaces
    }

    $apiKey = "19f268e57a9f47c6bc0131424230803"; 
    $url = "https://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$location&aqi=yes";

    // Use cURL to retrieve data from API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $weatherData = json_decode($data, true);
    var_dump($weatherData["forecast"]["forecastday"][0]["hour"][0]);

    curl_close($ch);
    ?>
