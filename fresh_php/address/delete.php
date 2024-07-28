<?php
//101
include "../connect.php";

$addressid = filterRequest("addressid");



deleteData(
    "address","address_id = $addressid"
);



?>