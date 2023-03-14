<?php 

require "./user.php";
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}

$conn = connect();
$query = "INSERT INTO health_tracker (user_id,date,steps_taken,calories_burnt) VALUES (?,?,?,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isii",$user->id,$_POST["date"],$_POST["steps"],$_POST["calories"]);
$stmt->execute();

header("Location: ./health.php");
?>