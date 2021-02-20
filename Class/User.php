<?php

include 'Dbcon.php';

class User extends Dbcon{

    const table = 'tbl_user';
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

    public function LoginCheck($email_id,$password){

        $this->email_id=$email_id;
        $this->password=$password;

        $sqlQuery = "Select * from `".self::table."` where `email_id`='$this->email_id' and `password`='$this->password'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0){
            $user = $result->fetch_assoc();
            if ($user['is_admin']==1) {
				$res = 1;
				$_SESSION['user'] = $user; 
			}
			elseif ($user['status'] == 1) {
				$res = 0;
				$_SESSION['user'] = $user; 
			}
			else{
				$res = -1;
			}
        }
        else{
			$res = -2;
		}
		return $res;

    }

    public function SignUp($email_id,$name,$password,$mobile){

        $this->email_id = $email_id;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->password = $password;

        $sqlQuery = "INSERT into `".self::table."`(`email_id`,`name`,`dateofsignup`,`mobile`,`status`,`password`,`is_admin`) values ('$this->email_id','$this->name',now(),'$this->mobile','1','$this->password','0')";

        $result = $this->connect->query($sqlQuery);
        if($result == True){
            return 1;
        }else{
            return 0;
        }
    }

}