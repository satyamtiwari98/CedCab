//----------------------This function is used for cedtype : Micro where luggage is not allowed----------------


function luggageNotAllowed() {

    var a = document.getElementById('cabType').value;
    var luggage = document.getElementById('luggage');
    
    if(a == 'CedMicro') {
    
        luggage.disabled = true;
        luggage.value = "notAllowed";
        luggage.placeholder = "Luggage Facility is not allowed for Ced Micro";

    }else {

        luggage.disabled = false;
        luggage.value = "";
        luggage.placeholder = "Enter Luggage in KG";

    }

}



$(document).ready(function () {

    letsGetOptions(); // This is function invoking on document load

// -------------------------------This is to activate the modal to display the booked ride details-------------------------------


  $("#subId").click(function (e) {

      e.preventDefault();
      var distance1 = $('#pickUp').val();
      var distance2 = $('#drop').val();
      var cabtype = $('#cabType').val();
      var weight = $('#luggage').val();

     
      if(distance1 != '' && distance2 != '' && cabtype != '' && weight != '' ){

      $.ajax({

          url: 'Helper.php',
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

              }
              
           
          }
      );
        } else {

            alert("Please provide valid details!!!!");
            
        }

  });





});

//---------------------------------------This is to get the options in the dropdown-----------------------

function letsGetOptions(){
    var select1 = $('#pickUp');
    var select2 = $('#drop');

    $.ajax({
        url:'Helper.php',
        type:'POST',
        data:{
            'action':'letsGetOption'
        },
        success:function(res){
        
            var location = JSON.parse(res);

            for(var i =0;i<location.length;i++){
                let option = "<option value="+location[i]['distance']+">"+location[i]['name']+"</option>";
                select1.append(option);
                select2.append(option);
            }
        }
    });
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

// ---------------------------------Book Ride-----------------------------------------------------------

$('#BookRide').click(function(){
    $.ajax({
        url:'Helper.php',
        type:'POST',
        data:{
            'action':'redirectBookRide',
        },
        success:function(res){
            if(res==1) {
                $(window).attr("location","user/index.php");
               
            }else{
                alert("Please login To book Ride");
                $(window).attr("location","login.php");
            }
        }
    })
})

