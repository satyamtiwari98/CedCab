<?php include "template/header.php";
    include "array.php"
?>

<div class="main">

<h1>Book a City Taxi to your destination in town</h1>

<h4>Choose from a range of categories and prices</h4>


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



<?php include "template/footer.php"; ?>