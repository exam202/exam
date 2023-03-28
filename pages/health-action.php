<?php 
//ensures the user is logged in and sends them to the login page if they are not
require "./user.php";
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}
// takes the user input and inserts it into the database
$conn = connect();

if (isset($_POST["days"])){
    $_SESSION["days"] = $_POST["days"];
    $_SESSION["notification"]="10";
}
else {
    $query = "INSERT INTO health_tracker (user_id,date,steps_taken,calories_burnt) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isii",$user->id,$_POST["date"],$_POST["steps"],$_POST["calories"]);
    $stmt->execute();
    $_SESSION["notification"]="10";
}
header("Location: ./health.php");
?>