<?php

class Dbcon {

    private $ServerName="localhost"; // Your Host Name
    private $DataBase="cedcab"; // Your DataBase Name
    private $UserName="root"; // Your User name
    private $password=""; // Your Password
    public $connect;

    function __construct()
    {
        $this->connect =  new mysqli($this->ServerName, $this->UserName, $this->password, $this->DataBase);
        
    }
}