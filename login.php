<?php  
session_start();

// ------------------------------------------Session Check-----------------------------------------------

if(isset($_SESSION['user']['email_id'])) {


  header('location:user/index.php');


}

  include "assets/template/header.php";

?>


<h1 class="loginheading">Login Form</h1>

<div class="loginform">

<!---------------------------------------------Login Form----------------------------------------------->

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


<?php include "assets/template/footer.php"; ?>

<script>

$(document).ready(function() {

  $('#submitLogin').click(function(e) {

    e.preventDefault();

    var email = $('#email').val();
    var password = $('#password').val();

    if(email != '' && password != '') {

    $.ajax({
      url:'Helper.php',
      type:'POST',
      data:{
        'email':email,
        'password':password,
        'action':'LoginCheck',
      },
      success:function(res) {

        console.log(res);

        if (res==1) {
            
            alert("Congrats Admin!!! You have successfully Logged In.");
            $(window).attr("location","admin/index.php");

        }else if (res== 0) {
          
            alert("Congrats !!! You have successfully Logged In.");
            $(window).attr("location","user/index.php");

        }else if(res == -1) {

            alert('Your account is been blocked by admin !!!');

        }else {

            alert('You have entered wrong email / password !!!');

        }

      }

    });

  } else {

    alert("Please provide valid details!!!");

  }

  });

});

</script>
