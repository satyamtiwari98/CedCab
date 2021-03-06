<?php
//----------------------------------This is Helper File--------------------------------------------------------

    include_once "Class/User.php";
    include_once "Class/Location.php";
    include_once "Class/Ride.php";
    

if(isset($_POST['action'])) {

    $action = $_POST['action'];

    switch($action) {
//---------------------------------Login Check---------------------------------------------------------------- 
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

//------------------------------------Email Check-------------------------------------------------------------
        case 'CheckEmail':
            $email_id = $_POST['email'];
            $userObj = new User();
            $result = $userObj->CheckEmail($email_id);
            echo $result;
            break;

//--------------------------------------Mobile Check-----------------------------------------------------------

        case 'CheckMobile':
            $mobile = $_POST['mobile'];
            $userObj = new User();
            $result = $userObj->CheckMobile($mobile);
            echo $result;
            break;

//---------------------------------------SingnUp or User Registeration-----------------------------------------

        case 'SignUp':
            $target_dir = "assets/uploads/";
            $targetfile = $_FILES['file']['name'];
            $target_file = $target_dir . basename($targetfile);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // $target_file .=$imageFileType;


            $email_id = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $mobile = $_POST['mobile'];

            $check = getimagesize($_FILES["file"]["tmp_name"]);

            if($check !== false) {

                $uploadOk = 1;

            } else {

                $uploadOk = 0;

            }

            if (file_exists($target_file)) {

                $uploadOk = 0;

            }

            if ($_FILES["file"]["size"] > 500000) {

                    $uploadOk = 0;

                }

            if ($uploadOk == 0) {

                echo "Sorry, your file was not uploaded.";

            } else {

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                    // echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";

                } else {

                    // echo "Sorry, there was an error uploading your file.";
                }

                }
        
            $UserObject = new User();
            $result = $UserObject->SignUp($email_id,$name,$password,$mobile,$targetfile);
        
            echo $result;

            break;

// -------------------------------------Edit Profile-------------------------------------


        case 'editProfile':
            $target_dir = "assets/uploads/";
            $targetfile = $_FILES['file']['name'];
            $target_file = $target_dir . basename($targetfile);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $name = $_POST['name'];
            $email = $_POST['email'];


            $check = getimagesize($_FILES["file"]["tmp_name"]);

            if($check !== false) {

                $uploadOk = 1;

            } else {

                $uploadOk = 0;

            }

            if (file_exists($target_file)) {

                $uploadOk = 1;

            }

            if ($_FILES["file"]["size"] > 500000) {

                    $uploadOk = 0;

                }

            if ($uploadOk == 0) {

                echo "Sorry, your file was not uploaded.";

            } else {

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                    // echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";

                } else {

                    // echo "Sorry, there was an error uploading your file.";
                }

                }

                $UserObject = new User();
                $result = $UserObject->editProfile($name,$targetfile,$email);
                // die($result);
            
                echo $result;
    
                break;



//------------------------------------To Get Options in the Pickup and Drop location dropdown------------------------------------------------

        case 'letsGetOption':
            $locationObject = new Location();

            $result = $locationObject->GetOptions();
            echo json_encode($result);

            break;

//-------------------------------------Calculate Fare---------------------------------------------------------

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

// -----------------------------------------Redirect For Booking Ride------------------------------------------
        
        case 'redirectBookRide':
            if(isset($_SESSION['user']['email_id'])) {

                echo "1";

            }else if(isset($_SESSION['admin']['email_id'])) {

                echo "2";

            }else {

                echo "0";

            }

            break;

// --------------------------------------Book Ride-------------------------------------------------------------

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

// ------------------------------------Get all Pending Rides details-------------------------------------------

        case 'GetPendingRides':
            $user_id = $_POST['user_id'];
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];

            $rideObject = new Ride();
            $result = $rideObject->GetPendingRides($user_id,$select1,$select2);

            echo json_encode($result);

            break;


// ------------------------------Get Pending Rides For Admin-----------------------------

        case 'GetPendingRidesAdmin':
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];
    
            $rideObject = new Ride();
            $result = $rideObject->GetPendingRidesAdmin($select1,$select2);
    
            echo json_encode($result);
    
            break;

// ------------------------------------Get All Rides details---------------------------------------------------

        case 'GetAllRides':
            $user_id = $_POST['user_id'];
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];

            $rideObject = new Ride();
            $result = $rideObject->GetAllRides($user_id,$select1,$select2);

            echo json_encode($result);

            break;

// ------------------------------------Get All Rides For Admin---------------------------

        case 'GetAllRidesAdmin':
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];
    
            $rideObject = new Ride();
            $result = $rideObject->GetAllRidesAdmin($select1,$select2);
    
            echo json_encode($result);
    
            break;

// -------------------------Get all completed rides details--------------------------------------------------

        case 'GetCompletedRides':
            $user_id = $_POST['user_id'];
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];

            $rideObject = new Ride();
            $result = $rideObject->GetCompletedRides($user_id,$select1,$select2);

            echo json_encode($result);

            break;

// -----------------------------Get Completed Rides For Admin-------------------------


        case 'GetCompletedRidesAdmin':
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];

            $rideObject = new Ride();
            $result = $rideObject->GetCompletedRidesAdmin($select1,$select2);
    
            echo json_encode($result);
    
            break;

// ---------------------Get all Cancelled Rides Details--------------------------------------------------------

        case 'GetCancelledRides':
            $user_id = $_POST['user_id'];
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];

            $rideObject = new Ride();
            $result = $rideObject->GetCancelledRides($user_id,$select1,$select2);

            echo json_encode($result);

            break;

// --------------------------------Get Cancel Rides Form Admin---------------------------


        case 'GetCancelledRidesAdmin':
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];
    
            $rideObject = new Ride();
            $result = $rideObject->GetCancelledRidesAdmin($select1,$select2);
    
            echo json_encode($result);
    
            break;


// ---------------------------------Change Password-----------------------------------------



        case 'ChangePassword':
            $currentPassword = $_POST['currentPassword'];
            $password = $_POST['password'];
            $email_id = $_POST['email_id'];

            $userObject = new User();
            $result = $userObject->ChangePassword($currentPassword,$password,$email_id);

            echo $result;

            break;


// -------------------------Get total expenses of a particular user--------------------------------------------

        case 'GetTotalExpenses':
            $user_id = $_POST['user_id'];

            $rideObject = new Ride();
            $result = $rideObject->GetTotalExpenses($user_id);
            
            echo json_encode($result);

            break;

// ---------------------------Get Total Earnings of Admin-------------------------------

        case 'GetTotalEarningAdmin':
    
            $rideObject = new Ride();
            $result = $rideObject->GetTotalEarningAdmin();
                
            echo json_encode($result);
    
            break;

// -----------------------------------Cancel Pending Rides-----------------------------------------------------

        case 'CancelRide':
            $ride_id = $_POST['ride_id'];

            $rideObject = new Ride();
            $result = $rideObject->CancelRide($ride_id);

            echo $result;

            break;

// ---------------------------Delete Location--------------------------------------------

        case 'DeleteLocation':
            $location_id = $_POST['location_id'];

            $locationObject = new Location();
            $result = $locationObject->DeleteLocation($location_id);

            echo $result;
            break;

// ---------------------------------Approve Rides---------------------------------------

        case 'ApproveRide':
            $ride_id = $_POST['ride_id'];
    
            $rideObject = new Ride();
            $result = $rideObject->ApproveRide($ride_id);
    
            echo $result;
    
            break;

// --------------------------------------Get User Image on User Dashboard-------------------------------------

        case 'GetUserImage':
            $user_id = $_POST['user_id'];

            $userObject = new User();
            $result = $userObject->GetUserImage($user_id);

            echo json_encode($result);
            break;

// ------------------------------------Get User Ride Info-----------------------------------------------------

        case 'GetInfo':
            $ride_id = $_POST['ride_id'];

            $rideObject = new Ride();
            $result = $rideObject->GetInfo($ride_id);

            echo json_encode($result);
            break;

// ----------------------------------Get All Users Details------------------------------


        case 'GetAllUser':
            $userObject = new User();
            $result = $userObject->GetAllUser();

            echo json_encode($result);
            break;

// ---------------------------------Get Users Info--------------------------------------


        case 'GetUserInfo':
            $user_id = $_POST['user_id'];
    
            $userObject = new User();
            $result = $userObject->GetUserInfo($user_id);
    
            echo json_encode($result);
            break;

// ---------------------------------Block User-----------------------------------------


        case 'BlockUser':
            $user_id = $_POST['user_id'];
        
            $userObject = new User();
            $result = $userObject->BlockUser($user_id);
                
        
            echo $result;
        
            break;

// ---------------------------------Un Block User----------------------------------------


        case 'UnBlockUser':
            $user_id = $_POST['user_id'];
            
            $userObject = new User();
            $result = $userObject->UnBlockUser($user_id);
                    
            
            echo $result;
            
            break;


// -----------------------------Add Location--------------------------------------------

        case 'AddLocation':
            $name = $_POST['name'];
            $distance = $_POST['distance'];

            $locationObject = new Location();
            $result = $locationObject->AddLocation($name,$distance);

            echo $result;

            break;


// ---------------------------Get All Location------------------------------------------

        case 'GetAllLocation':

            $locationObject = new Location();
            $result = $locationObject->GetAllLocation();

            echo json_encode($result);

            break;

// ---------------------------Get Location Info-----------------------------------------

        case 'GetLocationInfo':
            $id = $_POST['id'];

            $locationObject = new Location();
            $result = $locationObject->GetLocationInfo($id);

            echo json_encode($result);

            break;

// -----------------------Edit Location Information-------------------------------------

        case 'EditLocationInfo':
            $id = $_POST['id'];
    
            $locationObject = new Location();
            $result = $locationObject->EditLocationInfo($id);
    
            echo json_encode($result);
    
            break;

// ---------------------------Update Location-------------------------------------------

        case 'UpdateLocation':
            $name = $_POST['name'];
            $distance = $_POST['distance'];
            $is_available = $_POST['is_available'];
            $id = $_POST['id'];

            $locationObject = new Location();
            $result = $locationObject->UpdateLocation($name,$distance,$is_available,$id);

            echo $result;
            break;

// ------------------------------Make It Available--------------------------------------

        case 'MakeItAvailable':
            $location_id = $_POST['location_id'];

            $locationObject = new Location();
            $result = $locationObject->MakeItAvailable($location_id);

            echo $result;

            break;

// ------------------------------Make It UnAvailable----------------------------------

        case 'MakeItUnAvailable':
                $location_id = $_POST['location_id'];
    
                $locationObject = new Location();
                $result = $locationObject->MakeItUnAvailable($location_id);
    
                echo $result;
    
                break;

            
    

    


    }

} else {

    die("You are not allowed to access it.");

}