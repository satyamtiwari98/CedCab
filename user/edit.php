<?php
    include_once 'assets/template/header.php'
?>


<div class="container">

<h2 style="color: green; text-align:center; padding:20px;">Upload Your Profile Photo</h2>

<!----------------------------Edit Profile Form----------------------------------------------------------- -->

<form method="POST" action="" id="editProfile" style="width: 50%;">

    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>

    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['user']['name']; ?>"  placeholder="Enter Your Name" required>
  </div>

 
 <div class="mb-3">
 <label for="file" class="form-label">File To Upload</label>
  <input type="file" class="form-control" name="file" id="file" placeholder="File">
 </div>

  <input type="submit" name="editSubmit" id="editSubmit" class="btn btn-success" value="Save">

  
</form>

</div>

<?php
    include_once 'assets/template/footer.php'
?>

<script>

    $(document).ready(function(){

        GetUserImage();

// ----------------------------------Edit Profile On Form Submission-----------------------------------------

        $('#editSubmit').on('click',function(){
            var email_id = '<?php echo $_SESSION['user']['email_id']; ?>';
            var formdata = new FormData();

            formdata.append('name',$('#name').val());
            formdata.append('email',email_id);
            formdata.append('file',$('input[type=file]')[0].files[0]);
            formdata.append('action','editProfile');


            if($('#name').val() != '' && $('input[type=file]')[0].files[0] != ''){

                $.ajax({
                    url:'../Helper.php',
                    type:'POST',
                    enctype:'multipart/form-data',
                    contentType:false,
                    data:formdata,
                    cache:false,
                    processData:false,
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            alert("Profile Updated Successfully!!!!");
                            $(window).attr("location","index.php");
                        }else {
                            alert("OOps Something went wrong!!!!");
                        }
                    }
                });

            }



        });

    });


// ------------------------------------Get User Image Function------------------------------------------------

    function GetUserImage() {

        var user_id = <?php echo $_SESSION['user']['user_id'];?>;

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