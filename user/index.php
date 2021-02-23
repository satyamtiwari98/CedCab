<?php
include_once "header.php";

// session_destroy();
?>

<div class="dashboard">


<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Completed Rides</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-success">Get Completed Rides</a>
  </div>
</div>


<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Pending Rides</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-success">Get Pending Rides</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">All Rides</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-success">Get All Rides</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Total Expenses</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-success">Get Total Expenses</a>
  </div>
</div>




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

}






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
        }else{
            alert("Sorry You cannot book This ride!!!");
        }

    }
})

});

</script>