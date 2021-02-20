function luggageNotAllowed() {

    var a = document.getElementById('cabType').value;
    var luggage = document.getElementById('luggage');
    
    if(a == 'CedMicro') {
    
        luggage.disabled = true;
        luggage.value="not allowed";
        luggage.placeholder="Luggage Facility is not allowed for Ced Micro";

    }else {

        luggage.disabled = false;
        luggage.placeholder = "Enter Luggage in KG";

    }

}



$(document).ready(function () {

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

  $("#pickUp").on("change",function(){
    $("#drop option").show();
    $(`#drop option[value=${$(this).val()}]`).hide();
    
    });
    
    $("#drop").on("change",function(){
    $("#pickUp option").show();
    $(`#pickUp option[value=${$(this).val()}]`).hide();
    });

});


