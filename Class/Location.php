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

    public function GetOptions(){
       
        $sqlQuery = "Select * from `".self::table_location."`";
// die($sqlQuery);
        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
            // $loc = $result->fetch_assoc();
              $this->arr[$i]=$row;
              ++$i;
            }
        }

        return $this->arr;

    }

    public function GetDistanceName($distance){

        $this->distance = $distance;
        $sqlQuery = "select `name` from `".self::table_location."` where `distance`='$this->distance'";
        $result = $this->connect->query($sqlQuery);
        if($result->num_rows>0){
            // 
            return $result->fetch_assoc();
            
        }else{
            return "Not Found!!!";
        }



    }





}