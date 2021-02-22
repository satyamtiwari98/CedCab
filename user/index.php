<?php

session_start();
if(isset($_SESSION['user']) && $_SESSION['user']['is_admin']==0){
    echo $_SESSION['user']['email_id'];

}else{
    echo "Sorry you are not allowed to enter!!!";
}

session_destroy();