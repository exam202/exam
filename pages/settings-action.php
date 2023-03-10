<?php 

require "./user.php";
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}

if (isset($_POST["first_name"])){
    $user->first_name = $_POST["first_name"];
    $user->update();
    header("Location: ./settings.php");
}
if (isset($_POST["last_name"])){
    $user->last_name = $_POST["last_name"];
    $user->update();
    header("Location: ./settings.php");
}
if (isset($_POST["email"])){
    $user->email = $_POST["email"];
    $user->update();
    header("Location: ./settings.php");
}
if (isset($_POST["country"])){
    $user->country = $_POST["country"];
    $user->update();
    header("Location: ./settings.php");
}
if (isset($_POST["postcode"])){
    $user->postcode = $_POST["postcode"];
    $user->update();
    header("Location: ./settings.php");
}
if (isset($_POST["theme"])){
    $user->theme = $_POST["theme"];
    $user->update();
    header("Location: ./settings.php");
}

if (isset($_POST["hayfever"]) || isset($_POST["wind"]) || isset($_POST["air_quality"]) || isset($_POST["humidity"])){
    if (isset($_POST["hayfever"])){
        $hayfever = "1";
    }
    else {
        $hayfever = "0";
    }
    if (isset($_POST["wind"])){
        $wind = "1";
    }
    else {
        $wind = "0";
    }
    if (isset($_POST["air_quality"])){
        $air_quality = "1";
    }
    else {
        $air_quality = "0";
    }
    if (isset($_POST["humidity"])){
        $humidity = "1";
    }
    else {
        $humidity = "0";
    }
    
    header("Location: ./settings.php");
}

if (isset($_POST["current_password"])){
    $current_password = $_POST["current_password"];
    $new_poassword = $_POST["new_password"];
    $verify_password = $_POST["verify_password"];
    if (User::login($user->email, $current_password)){
        if ($new_password == $verify_password){
            $user->password = $new_password;
            $user->update();
            header("Location: ./settings.php");
        }
        else{
            $_SESSION["settings_error"] = "1";
            header("Location: ./settings.php");
        }
    }
    else {
        $_SESSION["settings_error"] = "2";
        header("Location: ./settings.php");
    }
}
else {
    header("Location: ./settings.php");
}
?>