<?php
    include_once 'assets/template/header.php';
?>

<div class="container">

    <h2 style="color:green; text-align:center; padding:20px;">Add More Location</h2>

<!----------------------------------Add Location Form--------------------------------------------------- -->

<form method="POST" action="" id="passwordchange">

    <h3 style="color: brown; text-align:center; padding:10px;">CedCab</h3>

 

  <div class="mb-3">
    <label for="name" class="form-label">Location Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Location Name You want to add" required>
  </div>


  <div class="mb-3">
    <label for="distance" class="form-label">Add Distance from Charbagh</label>
    <input type="number" class="form-control" name="distance" id="distance" placeholder="Enter Distance from Charbagh" required>
  </div>

 

  <input type="submit" name="locationSubmit" id="locationSubmit" class="btn btn-outline-success" value="Add">

  
</form>

<table class="table table-success table-striped" id="locationTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>

</div>


</div>

<div class="modal" id="mylocationinfo" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Location Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body-locationinfo">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<?php
    include_once 'assets/template/footer.php';
?>


<script>

    $(document).ready(function(){

        GetAllLocation();

        GetUserImage();

// -----------------------------On click function on form------------------------------------------------------

        $('#locationSubmit').on('click',function(){

            var name = $('#name').val();
            var distance = $('#distance').val();
        

            $.ajax({
                url:'../Helper.php',
                type:'POST',
                data:{
                    'name':name,
                    'distance':distance,
                    'action':'AddLocation',
                },
                success:function(res){
                    console.log(res);
                    
                    if(res==1) {

                        alert("Location Added SuccessFully");
                        // $(window).attr("location","index.php");
                        location.reload();
                        
                    }else {

                        alert("Something went wrong!!! Try again");

                    }

                }
            });

        });



    });


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



function GetAllLocation() {

  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'action':'GetAllLocation',
    },
    success:function(res){
      var data = JSON.parse(res);
    // $('#AllUsers').html(data.length);

    $('#locationTable thead').append(' <tr><th scope="col">Location Id</th><th scope="col">Name</th><th scope="col">Distance</th><th scope="col">Is Available</th><th scope="col">Action</th><th scope="col">View Details</th></tr>');
    
    for(var i = 0; i<data.length;i++) {

      if(data[i]['is_available']=='1'){

      $('#locationTable tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['distance']+'</td><td>Available</td><td><button class="btn btn-outline-danger" onclick="makeitunavailable('+data[i]['id']+')">NotAvailable</button></td><td><button class="btn btn-outline-info" onclick="getlocationinfo('+data[i]['id']+')">view</button></td></tr>');

      }else if(data[i]['is_available']=='0'){

        $('#locationTable tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['distance']+'</td><td>Not Available</td><td><button class="btn btn-outline-danger" onclick="makeitavailable('+data[i]['id']+')">Available</button></td><td><button class="btn btn-outline-info" onclick="getlocationinfo('+data[i]['id']+')">view</button></td></tr>');

      }

    }
    }
  });
}


function makeitavailable(id){

    var location_id = id;
    $.ajax({
        url:'../Helper.php',
        type:'POST',
        data:{
            'location_id':location_id,
            'action':'MakeItAvailable',
        },
        success:function(res){

    if(res==1) {

alert("Now Location is Available!!!");
location.reload();

}else {

alert("Something went wrong!!!!");
location.reload();

}
        }
    });
    
}


function makeitunavailable(id){

var location_id = id;
$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'location_id':location_id,
        'action':'MakeItUnAvailable',
    },
    success:function(res){

if(res==1) {

alert("Now Location is UnAvailable!!!");
location.reload();

}else {

alert("Something went wrong!!!!");
location.reload();

}
    }
});

}


function getlocationinfo(id){
    var location_id = id;
    $.ajax({
        url:'../Helper.php',
        type:'POST',
        data:{
            'id':id,
            'action':'GetLocationInfo',
        },
        success:function(res){

            var data = JSON.parse(res);

    if(data[0]['is_available']==1){


        $('.modal-body-locationinfo').html("<p> Id : <b style='color:brown'>"+data[0]['id']+"</b></p><p>Location Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>Location Distance : <b style='color:brown'>"+data[0]['distance']+"</b></p><p>Location Status : <b style='color:brown'>UnBlocked</b></p>");
          
          $('#mylocationinfo').modal('show');



    }else{


        $('.modal-body-locationinfo').html("<p> Id : <b style='color:brown'>"+data[0]['id']+"</b></p><p>Location Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>Location Distance : <b style='color:brown'>"+data[0]['distance']+"</b></p><p>Location Status : <b style='color:brown'>Blocked</b></p>");
          
          $('#mylocationinfo').modal('show');

    }

        
        }
    })
}



</script>