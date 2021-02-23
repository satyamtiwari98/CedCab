<?php
session_start();
if(isset($_SESSION['user']['email_id'])){

    session_destroy();
header("location:../index.php");


}else{
    echo "Logout will not work";
}

