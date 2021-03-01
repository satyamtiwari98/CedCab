<?php
    include_once 'assets/template/header.php';
    $id = $_GET['id'];
?>
<div class="container">
<!-- ---------------------------Edit Location Form----------------------------------- -->

<form method="POST" action="" id="EditLocation" style="width: 50%; padding:20px;">

    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>

 

  <div class="mb-3">
    <label for="name" class="form-label">Location Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Location Name You want to add" required>
  </div>


  <div class="mb-3">
    <label for="distance" class="form-label">Add Distance from Charbagh</label>
    <input type="number" class="form-control" name="distance" id="distance" placeholder="Enter Distance from Charbagh" required>
  </div>

  <div class="mb-3">
    <label for="status" class="form-label">Is Available</label>
    <input type="number" class="form-control" name="is_available" id="is_available" placeholder="Currently this location is available for user or not" required>
  </div>
 

  <input type="submit" name="editSubmit" id="editSubmit" class="btn btn-outline-success" value="Update">

  
</form>

</div>


<?php
    include_once 'assets/template/footer.php';
?>
<script>
$(document).ready(function(){

  GetUserImage(); // This function is called to show the users profile pic on the header

  editlocation(); // This function is called to get the previous details of the location according to the id we recieved through get method

// ------------------------------Updates the location table with new data---------------

  $('#editSubmit').on('click',function(e){
    e.preventDefault();

    var location_id = '<?php echo $id; ?>';

    var name = $('#name').val();
    var distance = $('#distance').val();
    var is_available = $('#is_available').val();

    $.ajax({
      url:'../Helper.php',
      type:'POST',
      data:{
        'name':name,
        'distance':distance,
        'is_available':is_available,
        'id':location_id,
        'action':'UpdateLocation',
      },
      success:function(res){

        if(res == 1){
          alert("Location Details Have been Updated Successfully!!!!!");
          location.reload();
        }else{
          alert("Something went wrong please try again!!!");
          location.reload();
        }

      }
    });



  });
});

// ---------------------------------Edit Location Function-----------------------------

function editlocation(){

    var location_id = '<?php echo $id; ?>';
    
    $.ajax({
        url:'../Helper.php',
        type:'POST',
        data:{
            'id':location_id,
            'action':'EditLocationInfo',
        },
        success:function(res){

            var data = JSON.parse(res);
            console.log(data);

        $('#name').attr('value',data[0]['name']);
        $('#distance').attr('value',data[0]['distance']);
        $('#is_available').attr('value',data[0]['is_available']);

        
        }
    });
}


// ------------------------------Get User Image Function------------------------------------------------------

function GetUserImage() {

var user_id = '<?php echo $_SESSION['admin']['user_id'];?>';

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