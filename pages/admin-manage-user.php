<?php 
require "./user.php";
//ensures the user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    // check if user is admin 
    $user = User::load_by_id($_SESSION["user"]);
    if ($user->level!="admin"){
        header("Location: admin-dashboard.php");
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="../styles/<?php echo $user->theme?>">

    <title>Admin User Management</title>
  </head>
  
  <body>
    <?php include "nav.php";
    // checks if there is a notification to display
    if (isset($_SESSION["notification"])){
        if ($_SESSION["notification"]=="99"){
            echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                You cannot promote an admin!
            </div>';               
            $_SESSION["notification"]="";
        }
        else if ($_SESSION["notification"]=="100"){
            echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                You cannot demote a user!
            </div>';               
            $_SESSION["notification"]="";
        }
        
    }
    else {
        $_SESSION["notification"]="";
    }
    ?>


    <div class="mx-auto pt-5" style="width:600px">
        <!-- Table -->
        <table class="table table-hover">
            <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Level</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        <?php
            
            $conn = connect();
            $query = "SELECT * FROM users";
            $results=mysqli_query($conn,$query);

            // loops through databse and displays all users
            while ($row = mysqli_fetch_array($results)) :?>
            <tr>
                <td><?php echo $row["id"];?></td>
                <td><?php echo $row["email"];?></td>
                <td><?php echo $row["first_name"];?></td>
                <td><?php echo $row["last_name"];?></td>
                <td><?php echo $row["level"];?></td>
                <td><a href="./admin-promote.php?id=<?php echo $row["id"]?>" class="btn btn-success">Promote</a></td>
                <td><a href="./admin-demote.php?id=<?php echo $row["id"]?>" class="btn btn-success">Demote</a></td>
                <td><a href="./admin-delete-user.php?id=<?php echo $row["id"]?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endwhile;?>
        </table>
    </div>
        <!-- jQuery, Popper.js and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>