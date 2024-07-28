<?php

include "../connect.php";

$username = filterRequest("username");
// $password = sha1("password");
$password = sha1($_POST['password']);
$email = filterRequest("email");
$phone = filterRequest("phone");
$verfiycode     = rand(10000 , 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE email = ? OR users_phone = ? ");
$stmt->execute(array($email, $phone));
$count = $stmt->rowCount();
if ($count > 0) {
    printFailure("PHONE OR EMAIL");
} else {

    $data = array(
        "name" => $username,
        "password" =>  $password,
        "email" => $email,
        "users_phone" => $phone,
        "users_verfiycode" => $verfiycode ,
        
    );
    sendEmail($email , "Verfiy Code Fresh" , "verfiy code $verfiycode ");
    insertData("users" , $data) ; 

}

?>