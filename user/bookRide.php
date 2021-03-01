<?php 
    
    include_once "assets/template/header.php";
    include_once "array.php";


?>

<div class="main">

<h1>Book a City Taxi to your destination in town</h1>

<h4>Choose from a range of categories and prices</h4>


<!-------------------------------------Fare Calculation Form-------------------------------------------------->


<div class="formSection">
    <h2 id="formSectionH2">City Taxi</h2>
    <hr>
    <h5>Your everyday travel partner</h5>
    <p>AC Cabs for point to point travel</p>


    <form action="" method="post" id="myform">
    <div class="input-group mb-3 mySelect">
  <label class="input-group-text" for="pickUp">PickUP</label>
  <select name="Pickup" class="form-select pick" id="pickUp" required>
    <option selected>PickUP Location</option>
  </select>
</div>
<div class="input-group mb-3 mySelect">
  <label class="input-group-text" for="drop">Drop</label>
  <select name="Drop" class="form-select drop" id="drop" required >
    <option selected>Drop Location</option>
  </select>
</div>
<div class="input-group mb-3 mySelect">
  <label class="input-group-text" for="cabType">CAB Type</label>
  <select name="cabType" class="form-select" id="cabType" onchange="luggageNotAllowed();" required>
    <option selected>Select CAB Type</option>
    <?php
    $length = count($cabType);
    for($i = 0;$i<$length;$i++){
        echo "<option value=".$cabType[$i].">$cabType[$i]</option>";
    }
    ?>
  </select>
</div>
<div class="input-group mb-3 mySelect">
  <label class="input-group-text" for="luggage">Luggages</label>
  <input type="text" class="form-control" placeholder="Enter Luggage in KG" name="weight" id="luggage">
</div>
<div class="input-group mb-3 mySelect">
    
<input type="submit" class="btn btn-success myBtn" value="Calculate Fare" name="submit" id="subId" >
</div>
    </form>

</div>

</div>


<!----------------------------------------Modal---------------------------------------------------------------------->

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
    include "assets/template/footer.php";
        
        ?>



<script>


//---------------------------------------This is to get the options in the dropdown-----------------------

function letsGetOptions() {

var select1 = $('#pickUp');
var select2 = $('#drop');

$.ajax({
    url:'../Helper.php',
    type:'POST',
    data:{
        'action':'letsGetOption'
    },
    success:function(res){
    
        var location = JSON.parse(res);

        for(var i =0;i<location.length;i++) {

            let option = "<option value="+location[i]['distance']+">"+location[i]['name']+"</option>";
            select1.append(option);
            select2.append(option);

        }

    }

});

}


$(document).ready(function () {

  GetUserImage();

  letsGetOptions(); // This is function invoking on document load



// -------------------------------This is to activate the modal to display the booked ride details-------------------------------


$("#subId").click(function (e) {

  e.preventDefault();
  
  var distance1 = $('#pickUp').val();
  var distance2 = $('#drop').val();
  var cabtype = $('#cabType').val();
  var weight = $('#luggage').val();

 
  if(distance1 != '' && distance2 != '' && cabtype != '' && weight != '' ) {

  $.ajax({

      url: '../Helper.php',
      type: 'POST',
      data: {
          'distance1':distance1,
          'distance2':distance2,
          'cabtype':cabtype,
          'weight':weight,
          'action':'CalculateFare',
      },

      success: function (res) {
          var arr = JSON.parse(res);
      
        $('.modal-body').html("<p>PickUp Point : <b style='color:brown'>"+arr[0]+"</b></p><p>Drop Point : <b style='color:brown'>"+arr[1]+"</b></p><p>CabType : <b style='color:brown'>"+arr[2]+"</b></p><p>TotalDistance : <b style='color:brown'>"+arr[3]+" km</b></p><p>Luggage weight : <b style='color:brown'>"+arr[4]+" kg</b></p><p>Total Fare : <b style='color:brown'>Rs."+arr[5]+"</b></p>");

        $('#my').modal('show');


        $('#BookRide').on('click',function() {


            $.ajax({
                url:'../Helper.php',
                type: 'POST',
                data:{
                    'pickup':arr[0],
                    'drop':arr[1],
                    'cab':arr[2],
                    'luggage':arr[4],
                    'fare':arr[5],
                    'total':arr[3],
                    'user':"<?php echo $_SESSION['user']['email_id']; ?>",
                    'action':'BookRide',
                },
                success:function(res) {

            console.log(res);

                    if(res==1) {

                        alert("Ride Booked SuccessFully!!!!");
                        $('#my').modal('hide');
                        // location.reload();
                        $(window).attr("location","index.php");

            
                    }else {

                        alert("Sorry You cannot book This ride!!!");
                        $('#my').modal('hide');
                        location.reload();

                    }
            
                }

            });

            
            });


          }
          
       
      }

  );

    } else {

        alert("Please provide valid details!!!!");
        
    }


});

});


//----------------------This function is used for cedtype : Micro where luggage is not allowed----------------


function luggageNotAllowed() {

var a = document.getElementById('cabType').value;
var luggage = document.getElementById('luggage');

if(a == 'CedMicro') {

    luggage.disabled = true;
    luggage.value = "0";
    luggage.placeholder = "Luggage Facility is not allowed for Ced Micro";

}else {

    luggage.disabled = false;
    luggage.value = "";
    luggage.placeholder = "Enter Luggage in KG";

}

}




// -------------------------------------Drop and Pickup Dropdown-----------------------------------------------


$("#pickUp").on("change",function() {

$("#drop option").show();
$(`#drop option[value=${$(this).val()}]`).hide();

});



$("#drop").on("change",function() {

$("#pickUp option").show();
$(`#pickUp option[value=${$(this).val()}]`).hide();

});


// ----------------------------Get User Image------------------------------------------


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
    console.log(data);

    $('#userImg').attr("src","../assets/uploads/"+data['img']+"");

    $('#userImg').attr("alt","/uploads/"+data['img']+"");


  }

});


}



</script>