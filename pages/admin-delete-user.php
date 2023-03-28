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

    $id = $_GET["id"];
    $user = User::load_by_id($id);
    $user->delete();
            
    header("Location: admin-manage-user.php");
            
        ?>
    </body> 
</html>