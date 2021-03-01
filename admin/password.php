<?php
    include_once 'assets/template/header.php';
?>

<div class="container">

    <h2 style="color:green; text-align:center; padding:20px;">Update Your Password</h2>

<!----------------------------------Password Change Form--------------------------------------------------- -->

<form method="POST" action="" id="passwordchange">

    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>

 

  <div class="mb-3">
    <label for="currentpassword" class="form-label">Current Password</label>
    <input type="password" class="form-control" name="currentpassword" id="currentpassword" placeholder="Enter Your Current Password" required>
  </div>


  <div class="mb-3">
    <label for="password" class="form-label">New Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your New Password" required>
  </div>

 

  <input type="submit" name="passwordSubmit" id="passwordSubmit" class="btn btn-outline-success" value="save">

  
</form>

</div>

<?php
    include_once 'assets/template/footer.php';
?>

<script>

    $(document).ready(function(){

        GetUserImage();

// -----------------------------On click function on form------------------------------------------------------

        $('#passwordSubmit').on('click',function(){

            var currentPassword = $('#currentpassword').val();
            var password = $('#password').val();
            var email_id = '<?php echo $_SESSION['admin']['email_id']; ?>';

            $.ajax({
                url:'../Helper.php',
                type:'POST',
                data:{
                    'currentPassword':currentPassword,
                    'password':password,
                    'email_id':email_id,
                    'action':'ChangePassword',
                },
                success:function(res){
                    
                    if(res==1) {

                        alert("Password Changed SuccessFully");
                        $(window).attr("location","index.php");
                        
                    }else {

                        alert("Your Current Password Do not matched!!! Try again");

                    }

                }
            });

        });



    });


// ------------------------------Get User Image Function------------------------------------------------------

function GetUserImage() {

var user_id = <?php echo $_SESSION['admin']['user_id'];?>;

$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'user_id':user_id,
        'action':'GetUserImage',
    },
    success:function(res) {

    var data = JSON.parse(res);

    $('#userImg').attr("src","../assets/uploads/"+data['img']+"");


    }

});


}
</script>