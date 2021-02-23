<?php

include_once 'Dbcon.php';
session_start();

class User extends Dbcon {

    const table_user = 'tbl_user';
    public $connect;
    public $user_id;
    public $email_id;
    public $name;
    public $date_of_signup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;

    public function __construct()
    {
        $lets_connect = new Dbcon();
        $this->connect=$lets_connect->connect;
        
    }

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

    public function SignUp($email_id,$name,$password,$mobile) {

        try {

        $this->email_id = $email_id;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->password = $password;



        $sqlQuery = "INSERT into `".self::table_user."`(`email_id`,`name`,`dateofsignup`,`mobile`,`status`,`password`,`is_admin`) values ('$this->email_id','$this->name',now(),'$this->mobile','1','$this->password','0')";

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