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
            $user = User::login($email, $password);
            var_dump($user);
            if ($user == false){
                $_SESSION["index_error"]="1";
                header("Location: ./");
            }
            else{
                $_SESSION["user"]= $user->id;
                header("Location: ./dashboard.php");
            }
        ?>
    </body> 
</html>