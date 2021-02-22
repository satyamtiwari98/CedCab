function luggageNotAllowed() {

    var a = document.getElementById('cabType').value;
    var luggage = document.getElementById('luggage');
    
    if(a == 'CedMicro') {
    
        luggage.disabled = true;
        luggage.value = "not allowed";
        luggage.placeholder = "Luggage Facility is not allowed for Ced Micro";

    }else {

        luggage.disabled = false;
        luggage.placeholder = "Enter Luggage in KG";

    }

}



$(document).ready(function () {

    letsGetOptions();

  $("#subId").click(function (e) {

      e.preventDefault();

      $.ajax({

          url: 'logic.php',
          type: 'POST',
          datatype: 'html',
          data: $('#myform').serialize(),

          success: function (res) {
          
            $('.modal-body').html(res);
            $('#my').modal('show');

              }
              
           
          }
      );

  });


});

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
            // console.log(res);
            var location = JSON.parse(res);
            // console.log(location[0]['id']);
            for(var i =0;i<location.length;i++){
                let option = "<option value="+location[i]['distance']+">"+location[i]['name']+"</option>";
                select1.append(option);
                select2.append(option);
            }
        }
    });
}


$("#pickUp").on("change",function() {

    $("#drop option").show();
    $(`#drop option[value=${$(this).val()}]`).hide();
    
    });


    
$("#drop").on("change",function() {

    $("#pickUp option").show();
    $(`#pickUp option[value=${$(this).val()}]`).hide();

    });
