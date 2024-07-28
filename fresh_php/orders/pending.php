<?php

include "../connect.php";

$usersid = filterRequest("id");


getAllData('ordersview' , "orders_usersid = '$usersid' AND orders_status != 4");

?>