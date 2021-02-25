<?php  include "template/header.php"; ?>

<div class="register">

    <h1 class="registerHeading">Registeration Form</h1>

<!----------------------------------------Signup Form--------------------------------------------------->

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

 <div class="mb-3">
 <label for="file" class="form-label">File To Upload</label>
  <input type="file" class="form-control" name="file" id="file" placeholder="File">
 </div>

  <input type="submit" name="signupSubmit" id="signupSubmit" class="btn btn-success" value="Signup">

  <a href="login.php" style="color: green;">Login Here</a>
</form>

</div>

<?php include "template/footer.php"; ?>

<script>

$(document).ready(function() {

//---------------------------------SignUp Submit button Logic And Email Verification--------------------------------------

  $('#signupSubmit').on('click',function(e) {

    e.preventDefault();

    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var formdata = new FormData();

    formdata.append('name',$('#name').val());
    formdata.append('email',$('#email').val());
    formdata.append('mobile',$('#mobile').val());
    formdata.append('password',$('#password').val());
    formdata.append('file',$('input[type=file]')[0].files[0]);
    formdata.append('action','SignUp');

  if(name != ''&& email != '' && mobile != '' && password != '') {

    $.ajax({
            url:'emailVerification.php',
            type:'POST',
            data:{
              'email':email,
            },
            success:function(otp) {

              console.log('Otp'+otp);

              var otpre = prompt("Enter Otp Reciecved On Your Email Id :- ");

              if(otpre==otp) {

                alert("Congrats OTP Verified Successfully");

               //------Calling function to store the whole data into database-----------
               RigesterUser(formdata);

              }else {

                alert("OTP Entered By is wrong!!!");

              }

            }

          });

        }else {

          alert("Please Provide Some Details First!!!!");

        }

 
  });

});

//----------------------Signup Function---------------------------------

function RigesterUser(formdata){

                     $.ajax({

                        url:'Helper.php',
                        type:'POST',
                        enctype:"multipart/form-data",
                        contentType:false,
                        data:formdata,
                        cache:false,
                        processData:false,
                        success:function(res) {

                            console.log(res);

                            if(res==1) {
                          
                            alert("Registered Successfully !!!");
                            $(window).attr("location","login.php");
            
          
                            }else {

                                 alert("OOPS something is wrong try again!!!");

                            }

                            }

                          });


}


// --------------------------------------Email On Change------------------------------------------------------

$('#email').on('change',function(e) {

    e.preventDefault();

    var mail = $('#email').val();

    $.ajax({
      url:'Helper.php',
      type:'POST',
      data:{
        'email':mail,
        'action':'CheckEmail'
      },
      success:function(res) {

        console.log(res);

        if(res==2) {

          $('#emailHelp').html("Email Entered is already registered try another one..!!!");
        $( "#mobile" ).prop( "disabled", true );
        $( "#password" ).prop( "disabled", true );


        }else {

          $('#emailHelp').html("We'll never share your email with anyone else.");
        $( "#mobile" ).prop( "disabled", false );
        $( "#password" ).prop( "disabled", false );
      
        }
       
      }

    });


  });

  // -----------------------------------Mobile On Change--------------------------------------------------------

  $('#mobile').on('change',function(e) {

    e.preventDefault();

    var mobile = $('#mobile').val();

    $.ajax({
      url:'Helper.php',
      type:'POST',
      data:{
        'mobile':mobile,
        'action':'CheckMobile',
      },
      success:function(res) {

        console.log(res);

        if(res==2) {

          $('#mobileHelp').html("Mobile Entered is already registered try another one..!!!");

        }else if(res==0) {

          $('#mobileHelp').html("We'll never share your mobile with anyone else.");
      
        }
       
      }

    });


  });

</script>