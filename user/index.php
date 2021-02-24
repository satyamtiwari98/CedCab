<?php
include_once "header.php";

// session_destroy();
?>

<div class="dashboard">

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Completed Rides</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
    <button type="button" class="btn btn-success" id="GetCompletedRides">Get Completed Rides</button>
  </div>
</div>


<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Pending Rides</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
    <button type="button" class="btn btn-success" id="GetPendingRides">Get Pending Rides</button>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">All Rides</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
    <button type="button" class="btn btn-success" id="GetAllRides">Get All Rides</button>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Total Expenses</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
    <button type="button" class="btn btn-success" id="GetTotalExpenses">Get Total Expenses</button>
  </div>
</div>




</div>

<div class="container">


<table class="table table-success table-striped" id="GetPendingTable">
<thead>
    <tr>
      <th scope="col">Ride_Id</th>
      <th scope="col">Ride_Date</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Cab_Type</th>
      <th scope="col">Total_Distance</th>
      <th scope="col">luggage</th>
      <th scope="col">Total_Fare</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<table class="table table-success table-striped" id="GetAllRidesTable">
<thead>
    <tr>
      <th scope="col">Ride_Id</th>
      <th scope="col">Ride_Date</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Cab_Type</th>
      <th scope="col">Total_Distance</th>
      <th scope="col">luggage</th>
      <th scope="col">Total_Fare</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<table class="table table-success table-striped" id="GetCompletedRidesTable">
<thead>
    <tr>
      <th scope="col">Ride_Id</th>
      <th scope="col">Ride_Date</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Cab_Type</th>
      <th scope="col">Total_Distance</th>
      <th scope="col">luggage</th>
      <th scope="col">Total_Fare</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

</div>



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



<?php

include_once "footer.php";
if(isset($_SESSION['ride']['pickup'])){

$pickup = $_SESSION['ride']['pickup'];
$drop = $_SESSION['ride']['drop'];
$cab = $_SESSION['ride']['cabtype'];
$luggage = $_SESSION['ride']['luggage'];
$fare = $_SESSION['ride']['fare'];
$totaldistance = $_SESSION['ride']['totaldistance'];
$user = $_SESSION['user']['email_id'];
echo $cab;

?>

<script>
$(document).ready(function(){
   
        $('.modal-body').html("<p>PickUp Point : <b style='color:brown'><?php echo $pickup;?></b></p><p>Drop Point : <b style='color:brown'><?php echo $drop; ?></b></p><p>CabType : <b style='color:brown'><?php echo $cab; ?></b></p><p>TotalDistance : <b style='color:brown'><?php echo $totaldistance; ?> km</b></p><p>Luggage weight : <b style='color:brown'><?php echo $luggage; ?> kg</b></p><p>Total Fare : <b style='color:brown'>Rs.<?php echo $fare; ?></b></p>");
            
            $('#my').modal('show');

 
   
});

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
        if(res==1){
            alert("Ride Booked SuccessFully!!!!");
            $('#my').modal('hide');

        }else{
            alert("Sorry You cannot book This ride!!!");
            $('#my').modal('hide');
        }

    }
});

});

</script>

<?php

}

?>

<script>

$(document).ready(function(){
GetPendingRides();
GetAllRides();
$('#GetAllRidesTable').hide();
GetCompletedRides();
$('#GetCompletedRidesTable').hide();

});

$('#GetCompletedRides').on('click',function(){

  $('#GetCompletedRidesTable').show();
  $('#GetAllRidesTable').hide();
  $('#GetPendingTable').hide();


});

$('#GetPendingRides').on('click',function(){

  $('#GetCompletedRidesTable').hide();
  $('#GetAllRidesTable').hide();
  $('#GetPendingTable').show();

});

$('#GetAllRides').on('click',function(){

$('#GetCompletedRidesTable').hide();
$('#GetAllRidesTable').show();
$('#GetPendingTable').hide();

});


function GetPendingRides(){

var user_id = <?php echo $_SESSION['user']['user_id'];?>;
$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'user_id':user_id,
        'action':'GetPendingRides',
    },
    success:function(res){
      var data = JSON.parse(res);
        console.log(data);
      for(var i = 0; i<data.length;i++){
        $('#GetPendingTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td>'+data[i]['status']+'</td></tr>');

      }

    }
});
}

function GetAllRides(){

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
        console.log(data);
      for(var i = 0; i<data.length;i++){
        $('#GetAllRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td>'+data[i]['status']+'</td></tr>');

      }

    }
  })


}

function GetCompletedRides(){

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
        console.log(data);
      for(var i = 0; i<data.length;i++){
        $('#GetCompletedRidesTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td>'+data[i]['status']+'</td></tr>');

      }
      
    }
  })
}


</script>