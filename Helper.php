<?php
    include "Class/User.php";
    include "Class/Location.php";
    // session_start();
if(isset($_POST['action'])){

    $action = $_POST['action'];

    switch($action){
        case 'LoginCheck':
            $email_id = $_POST['email'];
            $password = $_POST['password'];
            $UserObject = new User();
            $result = $UserObject->LoginCheck($email_id,$password);

            if ($result==1) {
                // $_SESSION['email_id'] = $email_id;
            }
            elseif ($result == 0) {
                // $_SESSION['email_id'] = $email_id;
            }
       
            echo $result;
            break;


        case 'EmailCheck':
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


    }

} else {

    die("You are not allowed to access it.");

}