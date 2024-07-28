<?php
include "../connect.php";

$email = filterRequest("email");

$verfiycode     = rand(10000 , 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE email = ? ");
$stmt->execute(array($email));
$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    $data = array("users_verfiycode" => $verfiycode );
    updateData("users", $data, "email = '$email'", fales);
    sendEmail($email, "Verfiy Code Fresh", "verfiy code $verfiycode");
}

?> 