<?php
//138
include "../connect.php";

$usersid = filterRequest("usersid");
$addressid = filterRequest("addressid");
$orderstype = filterRequest("orderstype");
$pricedelivery = filterRequest("pricedelivery");
$orderspric = filterRequest("ordersprice");
$couponid = filterRequest("couponid");
$paymentmethod = filterRequest("paymentmethod");
$coupondiscount = filterRequest("coupondiscount");


if($orderstype ==1){
    $pricedelivery =0;
}



$totalepeice = $orderspric + $pricedelivery;

 

$now = date("Y-m-d H:i:s");

$checkcoupon = getData("coupon","coupon_id = '$couponid' AND coupon_expiredate > '$now' AND coupon_count > 0",null,false);

if($checkcoupon > 0){
    $totalepeice = $totalepeice - $orderspric * $coupondiscount / 100;
    $stmt =$con-> prepare("UPDATE `coupon` SET `coupon_count`=`coupon_count` - 1 WHERE coupon_id = '$couponid' ");
    $stmt->execute();

}






$data = array(
    "orders_usersid" => $usersid,
    "orders_address" => $addressid,
    "orders_type" => $orderstype,
    "orders_pricedelivery" => $pricedelivery,
    "orders_price" => $orderspric,
    "orders_coupon" => $couponid,
    "orders_totalprice" => $totalepeice,
    "orders_paymentmethod" => $paymentmethod,
);

$count = insertData("orders",$data, false);

if($count > 0){
    $stmt =$con-> prepare("SELECT MAX(orders_id) FROM orders");
    $stmt->execute();
    $maxid =$stmt->fetchColumn();

    $data = array("cart_orders" => $maxid);
    updateData("cart", $data, "cart_usersid = $usersid AND cart_orders = 0 ");

}

?>







