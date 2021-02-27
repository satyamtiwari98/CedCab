<?php

include_once 'Dbcon.php';

class Location extends Dbcon{

    const table_location = 'tbl_location';
    public $connect;
    public $location;
    public $distance;
    public $is_available;
    public  $arr = array();


    public function __construct()
    {
        $lets_connect = new Dbcon();
        $this->connect=$lets_connect->connect;
        
    }


// ------------------------------Get Option in the dropdown from the database---------------------------------

    public function GetOptions() {

        try {
       
        $sqlQuery = "Select * from `".self::table_location."`";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {

            $i=0;

            while($row = $result->fetch_assoc()) {
            
              $this->arr[$i]=$row;
              ++$i;

            }

        }

        return $this->arr;

    } catch(Exception $e) {

        return $e;

    }

    }


// --------------------------Get Distance Name from The database---------------------------------------------


    public function GetDistanceName($distance) {

        try {

        $this->distance = $distance;

        $sqlQuery = "select `name` from `".self::table_location."` where `distance`='$this->distance'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            
            return $result->fetch_assoc();
            
        }else {

            return "Not Found!!!";

        }

    } catch(Exception $e) {

        return $e;

    }

    }

// ----------------------------------Add Location----------------------------------------

    public function AddLocation($name,$distance){
        try {

        $this->name = $name;
        $this->distance = $distance;

        $sqlQuery = "insert into .`".self::table_location."` (`name`,`distance`,`is_availabe`) values('$this->name','$this->distance','1')";

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


// -----------------------------------Get All Location-----------------------------------

    public function GetAllLocation(){

        try {

        $sqlQuery = "Select * from `".self::table_location."`";

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


    // ------------------------------------Get Location Information----------------------


    public function GetLocationInfo($id){
        try {
        $this->location = $id;

        $sqlQuery = "select * from `".self::table_location."` where `id`='$this->location'";

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

    // --------------------------------------Make It Available--------------------------

    public function MakeItAvailable($location_id){

        try{

        $this->location = $location_id;


        $sqlQuery = "update `".self::table_location."` set `is_available`='1' where `id`='$this->location'";

        $result = $this->connect->query($sqlQuery);


        if($result == true) {

            return 1;

        }else {

            return 0;

        }

    } catch(Exception $e) {

        return $e;

    }

    }


    // -----------------------------Make It Un Available---------------------------------


    public function MakeItUnAvailable($location_id){

        try{

        $this->location = $location_id;


        $sqlQuery = "update `".self::table_location."` set `is_available`='0' where `id`='$this->location'";

        $result = $this->connect->query($sqlQuery);


        if($result == true) {

            return 1;

        }else {

            return 0;

        }

    } catch(Exception $e) {

        return $e;

    }

    }




}