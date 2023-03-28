<?php 
require "./user.php";
//ensures the user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    // check if user is admin or moderator
    $user = User::load_by_id($_SESSION["user"]);
    if ($user->level!="admin"){
        if ($user->level!="moderator"){
            header("Location: dashboard.php");
        }
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

    <title>Admin Dashboard</title>
  </head>
  
  <body>
    <?php include "nav.php";
    $conn = connect();
    $sql = "SELECT * FROM reports WHERE solved=0";
    $result = mysqli_query($conn,$sql);
    ?>

    <div class="container">
        <div class="row pt-5">  
            <div class="col-md-6 px-1">
                <!-- Displays Active issues in 1 section -->
                <div class="shadow card" style="height:100%;max-height:300px">
                    <div class="card-body">
                        <h4 class="card-title">Active Issues</h4>
                        <?php while ($row = $result->fetch_assoc()){
                            echo '<a href="admin-manage-issue.php?id='.$row["id"].'">'.$row["title"].'</a><br>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-1">
                <!-- Links to other admin areas -->
                <div class="shadow card" style="height:32%;max-height:300px">
                    <div class="card-body">
                        <a href="admin-manage-issue.php"><h4 class="card-title">Manage Issues</h4></a>
                    </div>
                </div>
                <div class="shadow card my-1" style="height:32%;max-height:300px">
                    <div class="card-body">
                        <a href="admin-manage-tip.php"><h4 class="card-title">Manage Tips</h4></a>
                    </div>
                </div>
                <div class="shadow card" style="height:32%;max-height:300px">
                    <div class="card-body">
                        <a href="admin-manage-user.php"><h4 class="card-title">Manage Users</h4></a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>