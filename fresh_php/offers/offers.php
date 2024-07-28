


 
<?php
include "../connect.php";

 // $categoryid = filterRequest("id");


// $userid = filterRequest("usersid");

$stmt = $con-> prepare("SELECT items1view.*, 1 AS favorite,(items_price - (items_price * items_discount / 100)) AS itemspricedisont  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id
WHERE items_discount != 0
UNION ALL
SELECT * , 0 AS favorite,(items_price - (items_price * items_discount / 100)) AS itemspricedisont FROM items1view
WHERE items_discount !=0  AND items_id NOT IN (SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id )");


$stmt-> execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success" , "data" => $data));
}else{
    echo json_encode(array("status" => "failure"));
    
}

?>