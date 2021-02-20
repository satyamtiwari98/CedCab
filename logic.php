<?php 
  include "array.php";
  include "Cab.php";

  if(isset($_POST['Pickup'])) {
    $pickupPoint = $_POST['Pickup'];
    
    $dropPoint = $_POST['Drop'];
    
    $cabType = $_POST['cabType'];
    
    $luggage = isset($_POST['weight'])?$_POST['weight']:'Not Allowed';
    
    foreach($location as $x=>$val){
      if($x==$pickupPoint){
        $distance1=$val;
      }
      if($x==$dropPoint){
        $distance2=$val;
      }
    }
    $totalDistance = abs($distance1-$distance2);

    $obj = new Cab($cabType,$luggage,$distance1,$distance2);

    $fare = $obj->calculateFare();
   
    echo "<p>PickUp Point : <b style='color:brown'>$pickupPoint</b></p><p>Drop Point : <b style='color:brown'>$dropPoint</b></p><p>CabType : <b style='color:brown'>$cabType</b></p><p>TotalDistance : <b style='color:brown'>$totalDistance km</b></p><p>Luggage weight : <b style='color:brown'>$luggage kg</b></p><p>Total Fare : <b style='color:brown'>Rs.$fare</b></p>";
    
  }


?>