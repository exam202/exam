<?php 
    include "./user.php"; 
    session_start();
    //ensures the user is logged in and sends them to the login page if they are not
    if (isset($_SESSION["user"]) == false){
        header("Location: ./");
    }
    else {
        // check if user is admin 
        $user = User::load_by_id($_SESSION["user"]);
        if ($user->level!="admin"){
            header("Location: dashboard.php");
        }
    }
    $conn = connect();
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

        <?php 
            $id = $_GET["id"];
            $user = User::load_by_id($id);
            if ($user->level == "user"){
                $_SESSION["notification"] = "100";
            }
            else if ($user->level == "admin"){
                $user->level = "moderator";
            }
            else if ($user->level == "moderator"){
                $user->level = "user";
            }
            $user->update();
            
            header("Location: admin-manage-user.php");
            
        ?>
    </body> 
</html>