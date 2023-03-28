<?php 
    include "./user.php"; 
    //ensures the user is logged in and sends them to the login page if they are not
    session_start();
    if (isset($_SESSION["user"]) == false){
        header("Location: ./");
    }
    else {
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
            // finds what level the user is currently and promotes them to the next level 
            if ($user->level=="user"){
                $user->level = "moderator";
            }
            else if ($user->level=="moderator"){
                $user->level = "admin";
            }
            else if ($user->level=="admin"){
                // as admin is the highest it will display an error message back on the user management section
                $_SESSION["notification"] = "99";
            }
            $user->update();
            
            header("Location: admin-manage-user.php");
            
        ?>
    </body> 
</html>