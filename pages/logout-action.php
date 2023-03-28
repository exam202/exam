<?php 
    include "./connect.php"; 
    session_start();
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

        <?php 
            $conn = connect();

            session_destroy();
            $_SESSION["notification"] = "9";
            header("Location: ./");
        ?>
    </body> 
</html>