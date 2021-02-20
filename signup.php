<?php

  include "Class/User.php";
  include "template/header.php";


  if(isset($_POST['signupSubmit'])){

    $email_id = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    $UserObject = new User();
    $result = $UserObject->SignUp($email_id,$name,$password,$mobile);

    if($result==1){
      header('location:login.php');
    }else{
      echo "Sorry You Cannot Register!!!";
    }
  }

?>
<div class="register">
    <h1 class="registerHeading">Registeration Form</h1>

<form method="POST" action="" id="register">
    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>

    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Your Name" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Your Email Address" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="mobile" class="form-label">Mobile Number</label>
    <input type="Number" class="form-control" name="mobile" id="mobile" aria-describedby="mobileHelp" placeholder="Enter Your Mobile Number" required>
    <div id="mobileHelp" class="form-text">We'll never share your Mobile Number with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required>
  </div>
 
  <input type="submit" name="signupSubmit" id="signupSubmit" class="btn btn-success" value="Signup">
  <a href="login.php" style="color: green;">Login Here</a>
</form>

</div>
<?php include "template/footer.php"; ?>