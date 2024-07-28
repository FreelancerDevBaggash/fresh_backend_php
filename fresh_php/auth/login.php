<?php


include "../connect.php";

$password = sha1($_POST['password']);
$email = filterRequest("email");
// $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND users_approve = 1 ");
// $stmt->execute(array($email, $password));
// $count = $stmt->rowCount();
 //result($count) ;
//getData("users" , "email = ? AND password = ? AND users_approve = 1 " , array($email , $password)) ;
getData("users" , "email = ? AND password = ? " , array($email , $password)) ;

?>