<?php

include "../connect.php";

$id = filterRequest("id");


getAllData("ordersdetailsview","cart_orders = $id");
?>
