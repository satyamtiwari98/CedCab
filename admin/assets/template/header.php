<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']['is_admin']==1) {

  echo $_SESSION['admin']['email_id'];

}else {

  die("Sorry you are not allowed to enter!!!");

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
   
    <link rel="stylesheet" href="assets/stylesheet/style.css">
    <title>CEDCAB</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="container-fluid">

    <a class="navbar-brand" href="index.php">CEDCAB</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">AboutUS</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="edit.php">EditYourProfile</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="addlocation.php">Add Location</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="password.php">Change Password</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">LogOut</a>
        </li>
        
      </ul>
    </div>

 <?php echo "Hello  <b style='color:brown;'> ".$_SESSION['admin']['name']."</b>";  ?>
 <img src="" id="userImg" alt="This is image" height="20px" width="40px"/>
 
  </div>
</nav>

