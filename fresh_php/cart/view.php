<?php
//105
include "../connect.php";

$usersid = filterRequest("usersid");


$data = getAllData("cartview", "cart_usersid =$usersid",null, false);

$stmt = $con-> prepare("SELECT SUM(itemsprice) AS totalprice ,COUNT(countitems) AS totalcount FROM cartview
WHERE cartview.cart_usersid=$usersid
GROUP BY cart_usersid");

$stmt->execute();

$datacountprice = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(array(
    "status" => "success",
    "datacart" => $data,
    "countprice" => $datacountprice
));


