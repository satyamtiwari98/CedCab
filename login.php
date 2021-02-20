<?php
    include "Class/User.php";
    include "template/header.php";

    if(isset($_POST['submitLogin'])){
        $email_id = $_POST['email'];
        $password = $_POST['password'];
        $UserObject = new User();
        $result = $UserObject->LoginCheck($email_id,$password);

        if ($result==1) {
            header('location: admin/index.php');
        }
        elseif ($result == 0) {
            header('location: user/index.php');
        }
        else if($result == -1){
            echo "Your account is been blocked by admin !";
        }
        else{
            echo "You have entered wrong email / password !";
        }
    }

 ?>
<h1 class="loginheading">Login Form</h1>
<div class="loginform">
<form method="POST" action="" id="loginForm">
    <h3 style="text-align: center; color:brown; border-radius:50%; padding:10px;">CedCab</h3>
  <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter your Email Address" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="checkme">
    <label class="form-check-label" for="checkme">Check me out</label>
  </div>
  <input type="submit" name="submitLogin" id="submitLogin" class="btn btn-success" value="Login">
  <a href="signup.php" style="color: green;">Register Here</a>
</form>
</div>

<?php include "template/footer.php"; ?>
