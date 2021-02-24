<?php
// session_start();
    include_once "Class/User.php";
    include_once "Class/Location.php";
    include_once "Class/Ride.php";
    

if(isset($_POST['action'])){

    $action = $_POST['action'];

    switch($action){
        case 'LoginCheck':
            $email_id = $_POST['email'];
            $password = $_POST['password'];

            $UserObject = new User();
            $result = $UserObject->LoginCheck($email_id,$password);

            if ($result==1) {
                
            } elseif ($result == 0) {
                
            
            }
       
            echo $result;
            break;


        case 'CheckEmail':
            $email_id = $_POST['email'];
            $userObj = new User();
            $result = $userObj->CheckEmail($email_id);
            echo $result;
            break;


        case 'CheckMobile':
            $mobile = $_POST['mobile'];
            $userObj = new User();
            $result = $userObj->CheckMobile($mobile);
            echo $result;
            break;


        case 'SignUp':
            $email_id = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $mobile = $_POST['mobile'];
        
            $UserObject = new User();
            $result = $UserObject->SignUp($email_id,$name,$password,$mobile);
        
            echo $result;

            break;



        case 'letsGetOption':
            $locationObject = new Location();

            $result = $locationObject->GetOptions();
            echo json_encode($result);

            break;

        case 'CalculateFare':
            $pickupPoint = $_POST['distance1'];
            $dropPoint = $_POST['distance2'];
            $cabType = $_POST['cabtype'];
            $luggage = isset($_POST['weight'])?$_POST['weight']:'Not Allowed';

            $totalDistance = abs($dropPoint-$pickupPoint);
            $locationObject = new Location();
            $distance1 = $locationObject->GetDistanceName($pickupPoint);
            $distance2 = $locationObject->GetDistanceName($dropPoint);


            $rideObject = new Ride();

            $fare = $rideObject->CalculateFare($cabType,$luggage,$pickupPoint,$dropPoint,$totalDistance,$distance1['name'],$distance2['name']);



            $arr = array($distance1['name'],$distance2['name'],$cabType,$totalDistance,$luggage,$fare);
            echo json_encode($arr);

            break;
        
        case 'redirectBookRide':
            if(isset($_SESSION['user']['email_id'])) {

                echo "1";

            }else if(isset($_SESSION['admin']['email_id'])) {

                echo "2";

            }else {

                echo "0";

            }

            break;

        case 'BookRide':
            $pickup = $_POST['pickup'];
            $drop = $_POST['drop'];
            $cab = $_POST['cab'];
            $luggage = $_POST['luggage'];
            $fare = $_POST['fare'];
            $totalDistance = $_POST['total'];


            $user = $_POST['user'];
            $userObject = new User();
            $user_id = $userObject->GetID($user);

            $rideObject = new Ride();
            $result = $rideObject->BookRide($pickup,$drop,$cab,$luggage,$fare,$totalDistance,$user_id['user_id']);
            echo $result;

            break;

        case 'GetPendingRides':
            $user_id = $_POST['user_id'];

            $rideObject = new Ride();
            $result = $rideObject->GetPendingRides($user_id);

            echo json_encode($result);

            break;

        case 'GetAllRides':
            $user_id = $_POST['user_id'];

            $rideObject = new Ride();
            $result = $rideObject->GetAllRides($user_id);

            echo json_encode($result);

            break;

        case 'GetCompletedRides':
            $user_id = $_POST['user_id'];

            $rideObject = new Ride();
            $result = $rideObject->GetCompletedRides($user_id);

            echo json_encode($result);

            break;

    


    }

} else {

    die("You are not allowed to access it.");

}