<?php
// -----------------------------------This is User Class Which deals with user table---------------------------

include_once 'Dbcon.php';
session_start();

class User extends Dbcon {

    const table_user = 'tbl_user'; // This the table name of user
    public $connect;
    public $user_id;
    public $email_id;
    public $name;
    public $date_of_signup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;
    public $file;

    public function __construct()
    {
        $lets_connect = new Dbcon();
        $this->connect=$lets_connect->connect;
        
    }

// -------------------------------------Login Check Function------------------------------------------------

    public function LoginCheck($email_id,$password) {

        try {

        $this->email_id = $email_id;
        $this->password = $password;

        $sqlQuery = "Select * from `".self::table_user."` where `email_id`='$this->email_id' and `password`='$this->password' and `status`='1'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {

            $user = $result->fetch_assoc();

            if ($user['is_admin']==1) {

				$res = 1;
				$_SESSION['admin']['email_id'] = $user['email_id'];
                $_SESSION['admin']['name'] = $user['name'];
                $_SESSION['admin']['mobile'] = $user['mobile'];
                $_SESSION['admin']['is_admin'] = $user['is_admin'];
                $_SESSION['admin']['user_id'] = $user['user_id'];

			}
			elseif ($user['status'] == 1) {

				$res = 0;
                $_SESSION['user']['email_id'] = $user['email_id'];
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['mobile'] = $user['mobile'];
                $_SESSION['user']['is_admin'] = $user['is_admin'];
                $_SESSION['user']['user_id'] = $user['user_id'];


			}else {

				$res = -1;

			}

        }else {

			$res = -2;

		}

		return $res;

    } catch(Exception $e) {

        return $e;

    }

    }


// ----------------------------------------Email Check Function---------------------------------------------

    public function CheckEmail($email_id) {

        try {

        $this->email_id = $email_id;
        $checkexistence = "select * from `".self::table_user."` where `email_id` = '$this->email_id'";

        $checkexistenceResult = $this->connect->query($checkexistence);

        if($checkexistenceResult->num_rows>0) {

            return 2;

        }else {

            return 0;

        }

    }
    catch(Exception $e) {

        return $e;

    }

    }


// -----------------------------------Mobile Number Check Function--------------------------------------------


    public function CheckMobile($mobile) {

        try {

        $this->mobile = $mobile;
        $checkexistence = "select * from `".self::table_user."` where `mobile` = '$this->mobile'";
        $checkexistenceResult = $this->connect->query($checkexistence);

        if($checkexistenceResult->num_rows>0) {

            return 2;

        }else {

            return 0;

        }

    } catch(Exception $e) {

        return $e;

    }

    }

// -----------------------------------This function is used to get the users id using its email id------------

    public function GetID($user) {

        try {

        $this->email_id = $user;

        $sqlQuery = "select `user_id` from `".self::table_user."` where `email_id`='$this->email_id'";

        $result = $this->connect->query($sqlQuery);
        if($result->num_rows>0){
            
            return $result->fetch_assoc();
            
        }else{
            return "Not Found!!!";
        }

    } catch(Exception $e) {

        return $e;

    }
        
    }


// ---------------------------------Signup or user Registration Function--------------------------------------


    public function SignUp($email_id,$name,$password,$mobile,$targetfile) {

        try {

        $this->email_id = $email_id;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->password = $password;
        $this->file = $targetfile;
    



        $sqlQuery = "INSERT into `".self::table_user."`(`email_id`,`name`,`dateofsignup`,`mobile`,`status`,`password`,`is_admin`,`img`) values ('$this->email_id','$this->name',now(),'$this->mobile','1','$this->password','0','$this->file')";

        $result = $this->connect->query($sqlQuery);

        if($result == True) {

            return 1;

        }else {

            return 0;

        }

    } catch(Exception $e) {

        return $e;

    }
    
    }

// -----------------------------Get User Image Function------------------------------------------------------

    public function GetUserImage($user_id){

        try {

        $this->user_id = $user_id;

        $sqlQuery = "select `img` from `".self::table_user."` where `user_id`='$this->user_id'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0){
            
            return $result->fetch_assoc();
            
        }else{
            return "Not Found!!!";
        }

    } catch(Exception $e) {

        return $e;

    }


    }

// ---------------------------------------Change Password Function---------------------------------------------

    public function ChangePassword($currentPassword,$password,$email_id){

        try {

        $currentPassword = $currentPassword;
        $this->password = $password;
        $this->email_id = $email_id;

        $sqlQuery = "update `".self::table_user."` set `password`='$this->password' where `password`='$currentPassword' and `email_id`='$this->email_id'";

        $result = $this->connect->query($sqlQuery);

        if ($result == True) {
            
            return 1;

          } else {
            
            return 0;
          }

        } catch(Exception $e) {

            return $e;
    
        }

    }


// --------------------------------Edit Profile --------------------------------------------------------------

    public function editProfile($name,$file,$email){

        try {

        $this->name = $name;
        $this->file = $file;
        $this->email_id = $email;

        $sqlQuery = "update `".self::table_user."` set `name`='$this->name',`img`='$this->file' where `email_id`='$this->email_id'";
        

        if ($this->connect->query($sqlQuery) == TRUE) {
            
            return 1;

          } else {

        
            return 0;

          }

        } catch(Exception $e) {

            return $e;
    
        }

    }


// -------------------------------------Get All Users Details----------------------------

    public function GetAllUser(){
        try {
        $sqlQuery = "Select * from `".self::table_user."`";
        $result = $this->connect->query($sqlQuery);
        
        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;


    } catch(Exception $e) {

        return $e;

    }


    }

    // --------------------------------------Get User Information-----------------------

    public function GetUserInfo($user_id) {

        try {

        $this->user_id = $user_id;
        $sqlQuery = "Select * from `".self::table_user."`  where `user_id`='$this->user_id'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;

    } catch(Exception $e) {

        return $e;

    }



    }

// --------------------------------------Block User-------------------------------------


    public function BlockUser($user_id) {

        try {

        $this->user_id = $user_id;

    

            $sqlQuery = "update `".self::table_user."` set `status`='0' where `user_id`='$this->user_id' and `status`='1'";

            $result = $this->connect->query($sqlQuery);
    
    
            if($result == True) {
    
                return 1;
    
            }else {
    
                return 0;
    
            }

        
     

    } catch(Exception $e) {

        return $e;

    }

    }


// -----------------------------------------UnBlock User---------------------------------


    public function UnBlockUser($user_id) {

        try {

        $this->user_id = $user_id;

    

            $sqlQuery = "update `".self::table_user."` set `status`='1' where `user_id`='$this->user_id' and `status`='0'";

            $result = $this->connect->query($sqlQuery);
    
    
            if($result == True) {
    
                return 1;
    
            }else {
    
                return 0;
    
            }

        
     

    } catch(Exception $e) {

        return $e;

    }

    }






}