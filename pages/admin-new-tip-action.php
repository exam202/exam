<?php 
    include "./user.php"; 
    //ensures the user is logged in and sends them to the login page if they are not
    if (isset($_SESSION["user"]) == false){
        header("Location: ./");
    }
    else {
        $user = User::load_by_id($_SESSION["user"]);
        // check if user is admin
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
            $query = "INSERT INTO tips (preference,tip,severity) VALUES (?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss",$_POST["preference"],$_POST["tip"],$_POST["severity"]);
            $stmt->execute();
            header("Location: admin-manage-tip.php");
        ?>
    </body> 
</html>