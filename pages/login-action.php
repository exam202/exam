<?php 
    include "./user.php"; 
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

        <?php 
            $conn = connect();
            $email = $_POST['email'];
            $password = $_POST['password'];
            // takes the user input and runs the login function from user.php
            $user = User::login($email, $password);
            var_dump($user);
            if ($user == false){
                // if their details are incorrect, they are sent back to the login page
                $_SESSION["notification"]="1";
                header("Location: ./");
            }
            else{
                // if their details are correct, they are sent to the dashboard and puts their user id in the session
                $_SESSION["user"]= $user->id;
                header("Location: ./dashboard.php");
            }
        ?>
    </body> 
</html>