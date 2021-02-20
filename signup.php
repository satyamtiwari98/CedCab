<?php include "template/header.php"; ?>
<div class="register">
    <h1 class="registerHeading">Registeration Form</h1>
<form method="POST" action="" id="register">
    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Your Email Address" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Enter Your Password" required>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
<?php include "template/footer.php"; ?>