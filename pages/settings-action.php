<?php 

require "./user.php";
// ensures user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}

// finds out which setting has been changed and uses the user class to update the database
if (isset($_POST["first_name"])){
    $user->first_name = $_POST["first_name"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
if (isset($_POST["last_name"])){
    $user->last_name = $_POST["last_name"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
if (isset($_POST["email"])){
    $user->email = $_POST["email"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
if (isset($_POST["country"])){
    $user->country = $_POST["country"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
if (isset($_POST["postcode"])){
    $user->postcode = $_POST["postcode"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
if (isset($_POST["theme"])){
    $user->theme = $_POST["theme"];
    $user->update();
    $_SESSION["notification"]="8";
    header("Location: ./settings.php");
}
// uses the user id to find the correct row in the preferences table and updates the values it updates all at once so that the user can change multiple preferences at once
if (isset($_POST["uv_level"]) || isset($_POST["wind"]) || isset($_POST["sun"]) || isset($_POST["visibility"]) || isset($_POST["air_quality"]) || isset($_POST["humidity"])){
    if (isset($_POST["wind"])){
        $wind = 1;
    }
    else {
        $wind = 0;
    }
    if (isset($_POST["air_quality"])){
        $air_quality = 1;
    }
    else {
        $air_quality = 0;
    }
    if (isset($_POST["humidity"])){
        $humidity = 1;
    }
    else {
        $humidity = 0;
    }
    if (isset($_POST["uv_level"])){
        $uv_level = 1;
    }
    else {
        $uv_level = 0;
    }
    if (isset($_POST["sun"])){
        $sun = 1;
    }
    else {
        $sun = 0;
    }
    if (isset($_POST["visibility"])){
        $visibility = 1;
    }
    else {
        $visibility = 0;
    }
    if (isset($_POST["precipitation"])){
        $precipitation = 1;
    }
    else {
        $precipitation = 0;
    }
    $conn = connect();
    $query = "UPDATE preferences SET wind=?,air_quality=?,humidity=?,uv_level=?,sun=?,visibility=?,precipitation=? WHERE user_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiiiiiii",$wind,$air_quality,$humidity,$uv_level,$sun,$visibility,$precipitation,$user->id);
    $stmt->execute();
    $_SESSION["notification"]="8";
   // header("Location: ./settings.php");
}
// checks the current password is correct and that the new password and verify password match, if they do not match or the current password is incorrect the user is sent back to the settings page with an error message
if (isset($_POST["current_password"])){
    $current_password = $_POST["current_password"];
    $new_poassword = $_POST["new_password"];
    $verify_password = $_POST["verify_password"];
    if (User::login($user->email, $current_password)){
        if ($new_password == $verify_password){
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $user->password = $hash;
            $user->update();
            $_SESSION["notification"]="8";
            header("Location: ./settings.php");
        }
        else{
            $_SESSION["notification"] = "2";
            header("Location: ./settings.php");
        }
    }
    else {
        $_SESSION["notification"] = "7";
        header("Location: ./settings.php");
    }
}
else {
    header("Location: ./settings.php");
}
?>