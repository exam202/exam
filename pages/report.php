<?php 
require "./user.php";
// ensures user is logged in and sends them to the login page if they are not
if (isset($_SESSION["user"]) == false){
    header("Location: ./");
}
else {
    $user = User::load_by_id($_SESSION["user"]);
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

    <title>Dashboard</title>
  </head>
  
  <body>
    <?php include "nav.php"; ?>
    <div class="container pt-5">
      <!-- form for submitting a report -->
      <form action="report-action.php" method="POST">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required maxlength="63"></input>
        <div class="form-group">
          <label for="issue">Issue</label>
          <textarea type="text" class="form-control" id="issue" name="issue" placeholder="Enter Issue" rows="20" cols="50" required maxlength="2047"></textarea>
        </div>
        <center>
        <button type="submit" class="btn btn-primary">Submit</button>
        </center>
      </form>
      
    </div>
        <!-- jQuery, Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>