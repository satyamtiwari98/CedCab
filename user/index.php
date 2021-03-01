<?php

    include_once "assets/template/header.php";

?>
<!-----------------------------------User DashBoard------------------------------------------------------ -->

<div class="dashboard">

<!--------------------------------------Pending Rides Card------------------------------------------------- -->

<div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <h5 class="card-title">Pending Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalPendingRides"></h2>
    
    <button style="text-align: center;" type="button" class="btn btn-success" id="GetPendingRides">Get Pending Rides</button>
  </div>
</div>

<!----------------------------------------Cancelled Rides Card--------------------------------------------- -->


<div class="card" style="width: 18rem;">
 
  <div class="card-body">
    <h5 class="card-title">Cancelled Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalCancelledRides"></h2>

    <button style="text-align: center;" type="button" class="btn btn-success" id="GetCancelledRides">Get Cancelled Rides</button>
  </div>
</div>

<!---------------------------------------Total Expenses Card---------------------------------------------- -->

<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">Total Expenses</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalExpenses"></h2>
    <h5 class="card-title">Total Completed Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalCompletedRides"></h2>

    <button style="text-align: center;" type="button" class="btn btn-success" id="GetCompletedRides">Get All Completed Rides</button>
    
  </div>
</div>

<!-----------------------------------------------All Rides Card----------------------------------------->

<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">All Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalRides"></h2>
    
    <button style="text-align: center;" type="button" class="btn btn-success" id="GetAllRides">Get All Rides</button>
  </div>
</div>



</div>


<!---------------------------------------------Tables Container-------------------------------------------  -->

<div class="container">


<!----------------------------Get Pending Rides Table--------------------------------------------------------->
<h1 id="pendingridesheading">All Pending Rides Available :-</h1>
<table class="table table-success table-striped" id="GetPendingTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>


<!--------------------------------------Get all Rides Table---------------------------------------------->
<h1 id="allridesheading">All Rides Done By You :-</h1>
<table class="table table-success table-striped" id="GetAllRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>
<!----------------------------------Get Cancelled Rides Table-------------------------------------------- -->
<h1 id="cancelledridesheading">All Cancelled Rides :-</h1>
<table class="table table-success table-striped" id="GetCancelledRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>

</div>


<!-----------------------Get Completed Rides Table-------------->
<h1 id="completedridesheading">All Completed Rides By You :-</h1>
<table class="table table-success table-striped" id="GetCompletedRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>

</div>

<!-- ----------------------------------This modal is used to display message on the screen-------------------------------------->

<div class="modal" id="my" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ride Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="BookRide">Book Ride</button>
      </div>
    </div>
  </div>
</div>

<!-----------------------------------View Details Modal------------------------------------------ -->


<div class="modal" id="myinfo" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ride Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body-info">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>



<?php

include_once "assets/template/footer.php";

//Here we are checking wheather the session of ride is set or not

$login_session_duration = 60; 
$current_time = time(); 

if(isset($_SESSION['ride']['bookedTime']) && isset($_SESSION['ride']['pickup'])){

  if(((time() - $_SESSION['ride']['bookedTime']) > $login_session_duration)){ 
    
    echo "Session Expired";
    unset($_SESSION['ride']['pickup']);
    unset($_SESSION['ride']['drop']);
    unset($_SESSION['ride']['cabtype']);
    unset($_SESSION['ride']['fare']);
    unset($_SESSION['ride']['luggage']);
    unset($_SESSION['ride']['totaldistance']);


  } else{

$pickup = $_SESSION['ride']['pickup'];
$drop = $_SESSION['ride']['drop'];
$cab = $_SESSION['ride']['cabtype'];
$luggage = $_SESSION['ride']['luggage'];
$fare = $_SESSION['ride']['fare'];
$totaldistance = $_SESSION['ride']['totaldistance'];
$user = $_SESSION['user']['email_id'];



?>

<script>
$(document).ready(function(){
   
        $('.modal-body').html("<p>PickUp Point : <b style='color:brown'><?php echo $pickup;?></b></p><p>Drop Point : <b style='color:brown'><?php echo $drop; ?></b></p><p>CabType : <b style='color:brown'><?php echo $cab; ?></b></p><p>TotalDistance : <b style='color:brown'><?php echo $totaldistance; ?> km</b></p><p>Luggage weight : <b style='color:brown'><?php echo $luggage; ?> kg</b></p><p>Total Fare : <b style='color:brown'>Rs.<?php echo $fare; ?></b></p>");
            
        $('#my').modal('show');

 
   
});

//-------------------------------------Book Ride Function------------------------------------------------------

$('#BookRide').on('click',function(){

$.ajax({
    url:'../Helper.php',
    type: 'POST',
    data:{
        'pickup':"<?php echo $pickup; ?>",
        'drop':"<?php echo $drop; ?>",
        'cab':"<?php echo $cab; ?>",
        'luggage':"<?php echo $luggage; ?>",
        'fare':"<?php echo $fare; ?>",
        'total':"<?php echo $totaldistance; ?>",
        'user':"<?php echo $user; ?>",
        'action':'BookRide',
    },
    success:function(res){

console.log(res);

        if(res==1) {

            alert("Ride Booked SuccessFully!!!!");
            $('#my').modal('hide');
            location.reload();


        }else {

            alert("Sorry You cannot book This ride!!!");
            $('#my').modal('hide');
            location.reload();

        }

    }

});

});

</script>

<?php

}

}

?>

<script>

$(document).ready(function() {

GetUserImage();

  //-----------------------This function is callled here to get all the expenses of the user----------------------------------
  
GetTotalExpenses();
 
//-------------------------------------------------------------------------------------------------------------
GetPendingRides();

//---------------------------------------------------------------------------------------------------------------

GetAllRides();
$('#GetAllRidesTable').hide();
$('#allridesheading').hide();

// ----------------------------------------------------------------------------------------------------------

GetCanelledRides();
$('#GetCancelledRidesTable').hide();
$('#cancelledridesheading').hide();

//--------------------------------------------------------------------------------------------------------------

GetCompletedRides();
$('#GetCompletedRidesTable').hide();
$('#completedridesheading').hide();

});

//---------------------------Get All Completed Rides of a Particular user--------------------------------------

$('#GetCompletedRides').on('click',function(){

  $('#GetCompletedRidesTable').show();
  $('#GetAllRidesTable').hide();
  $('#GetPendingTable').hide();
  $('#GetCancelledRidesTable').hide();

  $('#completedridesheading').show();
  $('#pendingridesheading').hide();
  $('#allridesheading').hide();
  $('#cancelledridesheading').hide();
  $('#usersheading').hide();

});



function GetCompletedRides() {

var user_id = <?php echo $_SESSION['user']['user_id'];?>;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'user_id':user_id,
    'action':'GetCompletedRides',
  },
  success:function(res){

    var data = JSON.parse(res);
    $('#TotalCompletedRides').html(data.length);

    $('#GetCompletedRidesTable thead').append(' <tr><th scope="col">Ride_Id</th><th scope="col">Ride_Date</th><th scope="col">From</th><th scope="col">To</th><th scope="col">Cab_Type</th><th scope="col">Total_Distance</th><th scope="col">luggage</th><th scope="col">Total_Fare</th><th scope="col">Status</th><th scope="col">View Details</th></tr>');
    
    for(var i = 0; i<data.length;i++) {

      $('#GetCompletedRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-success">Completed</a></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">View</button></td></tr>');

    }
    
  }

});

}


// -----------------------------------------View Details Function starts Here-------------------------------


function getInfo(ride_id) {

  var id = ride_id;

  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'ride_id':id,
      'action':'GetInfo',
    },
    success:function(res) {

      var data = JSON.parse(res);

      if(data[0]['status']==2) {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Completed</b></p>");
            
        $('#myinfo').modal('show');


      }else if(data[0]['status']==1) {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Pending</b></p>");
            
        $('#myinfo').modal('show');

      }else {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Cancelled</b></p>");
            
        $('#myinfo').modal('show');

      }

    }


  })

}

//-------------------------------Get Cancelled Rides Of a particular user--------------------------------------

$('#GetCancelledRides').on('click',function(){

$('#GetCancelledRidesTable').show();
$('#GetCompletedRidesTable').hide();
$('#GetAllRidesTable').hide();
$('#GetPendingTable').hide();

$('#completedridesheading').hide();
$('#pendingridesheading').hide();
$('#allridesheading').hide();
$('#cancelledridesheading').show();
$('#usersheading').hide();


});


function GetCanelledRides(){

var user_id = <?php echo $_SESSION['user']['user_id'];?>;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'user_id':user_id,
    'action':'GetCancelledRides',
  },
  success:function(res){

    var data = JSON.parse(res);
    $('#TotalCancelledRides').html(data.length);

    $('#GetCancelledRidesTable thead').append(' <tr><th scope="col">Ride_Id</th><th scope="col">Ride_Date</th><th scope="col">From</th><th scope="col">To</th><th scope="col">Cab_Type</th><th scope="col">Total_Distance</th><th scope="col">luggage</th><th scope="col">Total_Fare</th><th scope="col">View Details</th></tr>');
    
    for(var i = 0; i<data.length;i++) {

      $('#GetCancelledRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">view</button></td></tr>');

    }
    
  }

});


}



//--------------------------Get all the pending Rides of a Particular user-------------------------------------

$('#GetPendingRides').on('click',function(){

  $('#GetCompletedRidesTable').hide();
  $('#GetAllRidesTable').hide();
  $('#GetPendingTable').show();
  $('#GetCancelledRidesTable').hide();

  $('#completedridesheading').hide();
  $('#pendingridesheading').show();
  $('#allridesheading').hide();
  $('#cancelledridesheading').hide();
  $('#usersheading').hide();

});

function GetPendingRides() {

var user_id = <?php echo $_SESSION['user']['user_id'];?>;

$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'user_id':user_id,
        'action':'GetPendingRides',
    },
    success:function(res) {

      var data = JSON.parse(res);

      $('#TotalPendingRides').html(data.length);
      $('#GetPendingTable thead').append('<tr><th scope="col">Ride_Id</th><th scope="col">Ride_Date</th><th scope="col">From</th><th scope="col">To</th><th scope="col">Cab_Type</th><th scope="col">Total_Distance</th><th scope="col">luggage</th><th scope="col">Total_Fare</th><th scope="col">Status</th><th scope="col">Action</th><th scope="col">View Details</th></tr>');
     
      for(var i = 0; i<data.length;i++) {

        $('#GetPendingTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-outline-danger">Pending</a></td><td><button class="btn btn-danger" onclick="CancelRide('+data[i]["ride_id"]+')">Cancel</a></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">View</button></td></tr>');


      }

    }
});
}

//----------------------------------Get all The Details of Rides of a Particular user--------------------------

$('#GetAllRides').on('click',function() {

$('#GetCompletedRidesTable').hide();
$('#GetAllRidesTable').show();
$('#GetPendingTable').hide();
$('#GetCancelledRidesTable').hide();

$('#completedridesheading').hide();
$('#pendingridesheading').hide();
$('#allridesheading').show();
$('#cancelledridesheading').hide();
$('#usersheading').hide();


});


function GetAllRides() {

  var user_id = <?php echo $_SESSION['user']['user_id']; ?>;

  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'user_id':user_id,
      'action':'GetAllRides',
    },
    success:function(res){

      var data = JSON.parse(res);

      $('#TotalRides').html(data.length);

      $('#GetAllRidesTable thead').append('<tr><th scope="col">Ride_Id</th><th scope="col">Ride_Date</th><th scope="col">From</th><th scope="col">To</th><th scope="col">Cab_Type</th><th scope="col">Total_Distance</th><th scope="col">luggage</th><th scope="col">Total_Fare</th><th scope="col">Status</th><th scope="col">View Details</th></tr>');
      

      for(var i = 0; i<data.length;i++) {

        if(data[i]['status']==1) {

          $('#GetAllRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-outline-danger">Pending</a></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">view</button></td></tr>');

        }else if(data[i]['status']==2) {

          $('#GetAllRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-outline-success">Completed</a></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">view</button></td></tr>');


        }else {

        $('#GetAllRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-outline-primary">Cancelled</a></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">view</button></td></tr>');

        }

      }

    }
  })


}

//------------------------------Get total expenses of a particular user------------------------------------------------

function GetTotalExpenses() {

  var user_id = <?php echo $_SESSION['user']['user_id'];?>;

  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'user_id':user_id,
      'action':'GetTotalExpenses',
    },
    success:function(res){
      var data = JSON.parse(res);

   
      $('#TotalExpenses').html(data["sum(`total_fare`)"]);

    }

  });
  
}


//----------------------------------This function is used to cancel the ride of users choice---------------------------------------------

function CancelRide(ride_id) {

  var id = ride_id;

  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'ride_id':id,
      'action':'CancelRide',
    },
    success:function(res){

      if(res==1) {

        alert("Ride Cancelled Successfully!!!");
        location.reload();

      }else {

        alert("You can Not cancel the ride!!!!")
        location.reload();

      }


    }

  });

}


// ------------------------------------Get User Image function-------------------------------------------------

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