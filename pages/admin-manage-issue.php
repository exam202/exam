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

    <title>Admin Issue Management</title>
  </head>
  
  <body>
    <?php include "nav.php";
    // checks if an issue has been selected and loads relevant data from database
    $conn = connect();
    if (isset($_GET["id"])){
        $sql = "SELECT * FROM reports WHERE id=".$_GET['id'];
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
    }
    else{
        // if no issue has been selected it will select all active issues
        $sql = "SELECT * FROM reports WHERE solved=0";
        $result = mysqli_query($conn,$sql);
    }
    ?>

    <div class="container">
        <div class="row pt-5">  
            <div class="col-md-12 px-1">
                <?php 
                // if the issue has been selected it will show description and option to mark as solved
                if (isset($_GET["id"])):?>
                    <form action="admin-manage-issue-action.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"></input>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" maxlength="63" readonly="" value="<?php echo $row["title"]; ?>"></input>
                        <div class="form-group">
                            <label for="issue">Issue</label>
                            <textarea type="text" class="form-control" id="issue" name="issue" rows="20" cols="50" maxlength="2047" readonly=""><?php echo $row["issue"]; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="solved">Has this problem been fixed:</label>
                            <select id="solved" name="solved" class="form-control">
                                <option value="0">Not Solved</option>    
                                <option value="1">Solved</option>
                            </select>
                        </div>
                        <center>
                        <a href="admin-manage-issue.php" class="btn btn-secondary">back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </center>
                    </form>
                <?php else:
                    // if it hasnt been selected it will show all unsolved issues and links to mark them as solved?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">Unsolved Issues</h4>
                                    <?php 
                                        while ($row = $result->fetch_assoc()){
                                        echo '<a href="admin-manage-issue.php?id='.$row["id"].'">'.$row["title"].'</a><br>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shadow card" style="height:100%;max-height:300px">
                                <div class="card-body">
                                    <h4 class="card-title">Solved Issues</h4>
                                    <?php 
                                        $sql = "SELECT * FROM reports WHERE solved=1";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = $result->fetch_assoc()){
                                            echo '<a href="admin-manage-issue.php?id='.$row["id"].'">'.$row["title"].'</a><br>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>  
    </div>
    <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>