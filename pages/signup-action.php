<?php 

require("user.php");
$conn = connect();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$verify_password = $_POST['verify_password'];
$country = $_POST['country'];
$county = $_POST['county'];

if ($password != $verify_password){
    $_SESSION['index_error']="2";
    header("Location: ./");
}
else {
    $user = new User(0,$first_name,$last_name,$email,$password,$country,$county,"","bootstrap.min.css");
    $user->add();
    header("Location: ./");
}

?>