<?php 

require("user.php");
$conn = connect();
// takes the user input and stores it in variables
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$verify_password = $_POST['verify_password'];
$country = $_POST['country'];
$postcode = $_POST['postcode'];
// checks if the passwords match and gives and error if they do not 
if ($password != $verify_password){
    $_SESSION['notification']="2";
    header("Location: ./");
}
else {
    // uses user class to add the user to the database
    $user = new User(0,$first_name,$last_name,$email,$password,$country,$postcode,"","sandstone.css","");
    $user->add();
    header("Location: ./");
}

?>