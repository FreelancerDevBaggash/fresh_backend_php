<?php

include "../connect.php" ;

$email = filterRequest("email");

$verfiy = filterRequest("verifycode");  

$stmt = $con->prepare(" SELECT * FROM users WHERE email = '$email' AND users_verfiycode = '$verfiy'") ;

$stmt->execute() ;

$count = $stmt->rowCount();

   result($count) ;


?> 