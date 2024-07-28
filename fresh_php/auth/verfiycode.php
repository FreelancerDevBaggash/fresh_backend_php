<?php

include "../connect.php" ;

$email = filterRequest("email");

$verfiy = filterRequest("verifycode");  

$stmt = $con->prepare(" SELECT * FROM users WHERE email = '$email' AND users_verfiycode = '$verfiy'") ;

$stmt->execute() ;

$count = $stmt->rowCount();

if ($count > 0) {

    $data = array("users_approve" => "1") ;

    updateData("users" , $data , "email = '$email'") ;

}else {
    printFailure("verifycode not Correct") ;
}

?> 