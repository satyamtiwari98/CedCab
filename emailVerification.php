<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['email'])) {

$email = $_POST['email'];
$name = $email;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "satyamtiwari1598@gmail.com";
$mail->Password = "yourPassword";
$mail->Port = 465;
$mail->SMTPSecure = "ssl";
$otpForVerification = rand(1001,9999);
$_SESSION['emailotp'] = $otpForVerification;

$mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->addAddress($email);
$mail->Subject = ("$email");
$mail->Body = 'Your OTP for Verification is: '.$otpForVerification;



if($mail->send()) {

   echo $_SESSION['emailotp'];

} else {

    echo "<h1>Error 404 </h1>";

}

}else {
    die("You are not allowed to access it..!!!!");
}