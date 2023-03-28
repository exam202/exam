<?php
require "./user.php";
// ensures user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
}

$conn = connect();
$query = "INSERT INTO reports (user_id,title,issue) VALUES (?,?,?)";
$stmt = $conn->prepare($query);
// uses html special chars to prevent sql injection
$stmt->bind_param("iss", $user->id,$_POST["title"],($_POST["issue"]));
$stmt->execute();
$_SESSION["notification"] = "5";
header("Location: ./dashboard.php");

?>