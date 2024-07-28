<?php

include "../../connect.php";

$orderid = filterRequest("ordersid");
$userid = filterRequest("usersid");



$data = array(
    "orders_status" =>1
);

updateData("orders" , $data ,"orders_id = $orderid AND orders_status = 0");

// sendGCM("Success","The Order Has been Approv","userss$userid", "none","refreshorderpending");
// insertNotify("title","body",$userid,"userss$userid","none","refreshorderpending");


insertNotify("تحختتنالتابللتب" , "The Order Has been Approv" , $userid , "serss$userid" , "none" , "refreshorderpending");

?>