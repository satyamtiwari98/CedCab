<?php

    include_once "assets/template/header.php";

?>
<!-----------------------------------User DashBoard------------------------------------------------------ -->

<div class="dashboard">

<!--------------------------------------Pending Rides Card------------------------------------------------- -->

<div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <h5 class="card-title">All Pending Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalPendingRides"></h2>
    
    <button style="text-align: center;" type="button" class="btn btn-success" id="GetPendingRides">Get All Pending Rides</button>
  </div>
</div>

<!----------------------------------------Cancelled Rides Card--------------------------------------------- -->


<div class="card" style="width: 18rem;">
 
  <div class="card-body">
    <h5 class="card-title">All Cancelled Rides</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="TotalCancelledRides"></h2>

    <button style="text-align: center;" type="button" class="btn btn-success" id="GetCancelledRides">Get All Cancelled Rides</button>
  </div>
</div>

<!---------------------------------------Total Expenses Card---------------------------------------------- -->

<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">Total Earnings</h5>
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


<div class="Dashboard">


<div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <h5 class="card-title">All User Details</h5>
    <h2 style="color: brown; text-align:center; padding:20px;" id="AllUsers"></h2>
    
    <button style="text-align: center;" type="button" class="btn btn-success" id="GetAllUserDetails">Get All User Details</button>
  </div>
</div>

</div>


<!---------------------------------------------Tables Container-------------------------------------------  -->

<div class="container">


<!----------------------------Get Pending Rides Table--------------------------------------------------------->

<table class="table table-success table-striped" id="GetPendingTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>


<!--------------------------------------Get all Rides Table---------------------------------------------->

<table class="table table-success table-striped" id="GetAllRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>
<!----------------------------------Get Cancelled Rides Table-------------------------------------------- -->

<table class="table table-success table-striped" id="GetCancelledRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>

</div>


<!-----------------------Get Completed Rides Table-------------->

<table class="table table-success table-striped" id="GetCompletedRidesTable">
<thead>
  </thead>
  <tbody>
  </tbody>
</table>

</div>


<table class="table table-success table-striped" id="GetAllUserTable">
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

<!--------------------------------------User Details Showing Modal----------------------------------------- -->

<div class="modal" id="myuserinfo" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body-userinfo">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<?php

include_once "assets/template/footer.php";

?>

<script>

$(document).ready(function() {

  GetAllUser();
  $('#GetAllUserTable').hide();

GetUserImage();

  //-----------------------This function is callled here to get all the expenses of the user----------------------------------
  
GetTotalEarningAdmin();
 
//-------------------------------------------------------------------------------------------------------------
GetPendingRidesAdmin();

//---------------------------------------------------------------------------------------------------------------

GetAllRidesAdmin();
$('#GetAllRidesTable').hide();

// ----------------------------------------------------------------------------------------------------------

GetCanelledRidesAdmin();
$('#GetCancelledRidesTable').hide();

//--------------------------------------------------------------------------------------------------------------

GetCompletedRidesAdmin();
$('#GetCompletedRidesTable').hide();

});

//---------------------------Get All Completed Rides of a Particular user--------------------------------------

$('#GetCompletedRides').on('click',function(){

  $('#GetCompletedRidesTable').show();
  $('#GetAllRidesTable').hide();
  $('#GetPendingTable').hide();
  $('#GetCancelledRidesTable').hide();
  $('#GetAllUserTable').hide();


});



function GetCompletedRidesAdmin() {



$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'action':'GetCompletedRidesAdmin',
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
      console.log(data);

      if(data[0]['status']==2) {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>User Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>User Id : <b style='color:brown'>"+data[0]['user_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>User Email : <b style='color:brown'>"+data[0]['email_id']+"</b></p><p>Date Of SignUp : <b style='color:brown'>"+data[0]['dateofsignup']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Completed</b></p>");
            
        $('#myinfo').modal('show');


      }else if(data[0]['status']==1) {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>User Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>User Id : <b style='color:brown'>"+data[0]['user_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>User Email : <b style='color:brown'>"+data[0]['email_id']+"</b></p><p>Date Of SignUp : <b style='color:brown'>"+data[0]['dateofsignup']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Pending</b></p>");
            
        $('#myinfo').modal('show');

      }else {

        $('.modal-body-info').html("<p>Ride Id : <b style='color:brown'>"+data[0]['ride_id']+"</b></p><p>User Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>User Id : <b style='color:brown'>"+data[0]['user_id']+"</b></p><p>Ride Date : <b style='color:brown'>"+data[0]['ride_date']+"</b></p><p>User Email : <b style='color:brown'>"+data[0]['email_id']+"</b></p><p>Date Of SignUp : <b style='color:brown'>"+data[0]['dateofsignup']+"</b></p><p>PickUp Point : <b style='color:brown'>"+data[0]['from']+"</b></p><p>Drop Point : <b style='color:brown'>"+data[0]['to']+"</b></p><p>CabType : <b style='color:brown'>"+data[0]['cab_type']+"</b></p><p>TotalDistance : <b style='color:brown'>"+data[0]['total_distance']+"km</b></p><p>Luggage weight : <b style='color:brown'>"+data[0]['luggage']+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+data[0]['total_fare']+"</b><p>Ride Status : <b style='color:brown'>Cancelled</b></p>");
            
        $('#myinfo').modal('show');

      }

    }


  })

}

$('#GetAllUserDetails').on('click',function(){

  $('#GetCancelledRidesTable').hide();
$('#GetCompletedRidesTable').hide();
$('#GetAllRidesTable').hide();
$('#GetPendingTable').hide();
$('#GetAllUserTable').show();
  
});

function GetAllUser(){
  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'action':'GetAllUser',
    },
    success:function(res){
      var data = JSON.parse(res);
    $('#AllUsers').html(data.length);

    $('#GetAllUserTable thead').append(' <tr><th scope="col">User_Id</th><th scope="col">Date Of SignUp</th><th scope="col">Name</th><th scope="col">Email ID</th><th scope="col">Mobile Number</th><th scope="col">Action</th><th scope="col">View Details</th></tr>');
    
    for(var i = 0; i<data.length;i++) {

      if(data[i]['status']=='1' && data[i]['is_admin']=='0'){

      $('#GetAllUserTable tbody').append('<tr><td>'+data[i]['user_id']+'</td><td>'+data[i]['dateofsignup']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['email_id']+'</td><td>'+data[i]['mobile']+'</td><td><button class="btn btn-outline-danger" onclick="blockUser('+data[i]['user_id']+')">Block</button></td><td><button class="btn btn-outline-info" onclick="getUserInfo('+data[i]['user_id']+')">view</button></td></tr>');

      }else if(data[i]['is_admin']=='0'){

        $('#GetAllUserTable tbody').append('<tr><td>'+data[i]['user_id']+'</td><td>'+data[i]['dateofsignup']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['email_id']+'</td><td>'+data[i]['mobile']+'</td><td><button class="btn btn-outline-danger" onclick="UnblockUser('+data[i]['user_id']+')">UnBlock</button></td><td><button class="btn btn-outline-info" onclick="getUserInfo('+data[i]['user_id']+')">view</button></td></tr>');

      }

    }
    }
  });
}

//-------------------------------Get Cancelled Rides Of a particular user--------------------------------------

$('#GetCancelledRides').on('click',function(){

$('#GetCancelledRidesTable').show();
$('#GetCompletedRidesTable').hide();
$('#GetAllRidesTable').hide();
$('#GetPendingTable').hide();
$('#GetAllUserTable').hide();



});


function GetCanelledRidesAdmin(){



$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'action':'GetCancelledRidesAdmin',
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
  $('#GetAllUserTable').hide();


});

function GetPendingRidesAdmin() {


$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'action':'GetPendingRidesAdmin',
    },
    success:function(res) {

      var data = JSON.parse(res);

      $('#TotalPendingRides').html(data.length);
      $('#GetPendingTable thead').append('<tr><th scope="col">Ride_Id</th><th scope="col">Ride_Date</th><th scope="col">From</th><th scope="col">To</th><th scope="col">Cab_Type</th><th scope="col">Total_Distance</th><th scope="col">luggage</th><th scope="col">Total_Fare</th><th scope="col">Status</th><th scope="col">Action</th><th scope="col">Approve</th><th scope="col">View Details</th></tr>');
     
      for(var i = 0; i<data.length;i++) {

        $('#GetPendingTable tbody').append('<tr><td>'+data[i]['ride_id']+'</td><td>'+data[i]['ride_date']+'</td><td>'+data[i]['from']+'</td><td>'+data[i]['to']+'</td><td>'+data[i]['cab_type']+'</td><td>'+data[i]['total_distance']+'</td><td>'+data[i]['luggage']+'</td><td>'+data[i]['total_fare']+'</td><td><a class="btn btn-outline-danger">Pending</a></td><td><button class="btn btn-danger" onclick="CancelRide('+data[i]["ride_id"]+')">Cancel</button><td><button class="btn btn-outline-success" onclick="ApproveRide('+data[i]["ride_id"]+')">Approve</button></td></td><td><button class="btn btn-outline-info" onclick="getInfo('+data[i]['ride_id']+')">View</button></td></tr>');


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
$('#GetAllUserTable').hide();


});


function GetAllRidesAdmin() {


  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'action':'GetAllRidesAdmin',
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
  });


}

//------------------------------Get total expenses of a particular user------------------------------------------------

function GetTotalEarningAdmin() {


  $.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
      'action':'GetTotalEarningAdmin',
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

function ApproveRide(ride_id) {

var id = ride_id;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'ride_id':id,
    'action':'ApproveRide',
  },
  success:function(res){

    if(res==1) {

      alert("Ride Approved Successfully!!!");
      location.reload();

    }else {

      alert("You can Not Approve the ride because its already cancelled!!!!");
      location.reload();

    }


  }

});

}


function blockUser(user_id) {

var id = user_id;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'user_id':id,
    'action':'BlockUser',
  },
  success:function(res){
    console.log(res);

    if(res==1) {

      alert("User Blocked Successfully!!!");
      location.reload();

    }else {

      alert("You can Not Block the User because its already Blocked!!!!");
      location.reload();

    }


  }

});

}


// ------------------------------------Get User Image function-------------------------------------------------

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

function getUserInfo(user_id) {

var id = user_id;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'user_id':id,
    'action':'GetUserInfo',
  },
  success:function(res) {

    var data = JSON.parse(res);
    console.log(data);

    if(data[0]['status']==1) {

      $('.modal-body-userinfo').html("<p>User Id : <b style='color:brown'>"+data[0]['user_id']+"</b></p><p>User Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>User Email : <b style='color:brown'>"+data[0]['email_id']+"</b></p><p>Date Of SignUp : <b style='color:brown'>"+data[0]['dateofsignup']+"</b></p><p>Mobile Number : <b style='color:brown'>"+data[0]['mobile']+"</b></p><p>User Status : <b style='color:brown'>UnBlocked</b></p>");
          
      $('#myuserinfo').modal('show');


    }else {
      $('.modal-body-userinfo').html("<p>User Id : <b style='color:brown'>"+data[0]['user_id']+"</b></p><p>User Name : <b style='color:brown'>"+data[0]['name']+"</b></p><p>User Email : <b style='color:brown'>"+data[0]['email_id']+"</b></p><p>Date Of SignUp : <b style='color:brown'>"+data[0]['dateofsignup']+"</b></p><p>Mobile Number : <b style='color:brown'>"+data[0]['mobile']+"</b></p><p>User Status : <b style='color:brown'>Blocked</b></p>");
          
          $('#myuserinfo').modal('show');
    }

 

  }


})

}

function UnblockUser(user_id) {

var id = user_id;

$.ajax({
  url:'../Helper.php',
  type:'POST',
  data:{
    'user_id':id,
    'action':'UnBlockUser',
  },
  success:function(res){
    console.log(res);

    if(res==1) {

      alert("User UnBlocked Successfully!!!");
      location.reload();

    }else {

      alert("You can Not UnBlock the User because its already UnBlocked!!!!");
      location.reload();

    }


  }

});

}







</script>