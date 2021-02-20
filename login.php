<?php include "template/header.php"; ?>
<h1 class="loginheading">Login Form</h1>
<div class="loginform">
<form method="POST" action="" id="loginForm">
    <h3 style="text-align: center; color:brown; border-radius:50%; padding:10px;">CedCab</h3>
  <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your Email Address" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Enter your Password" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="checkme">
    <label class="form-check-label" for="checkme">Check me out</label>
  </div>
  <input type="submit" name="submit" id="submit" class="btn btn-success" value="Login">
  <a href="signup.php" style="color: green;">Register Here</a>
</form>
</div>

<?php include "template/footer.php"; ?>