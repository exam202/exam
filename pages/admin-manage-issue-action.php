<?php 
    include "./user.php"; 
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
            $conn = connect();
            $query = "UPDATE reports SET solved=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii",$_POST["solved"],$_POST["id"]);
            $stmt->execute();
            header("Location: admin-manage-issue.php");
        ?>
    </body> 
</html>