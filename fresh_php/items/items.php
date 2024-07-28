
<?php
include "../connect.php";

 $categoryid = filterRequest("id");


// getAllData("items1view"," 1 = 1");

// getAllData("items1view"," categories_id = $categoryid");

$userid = filterRequest("usersid");

$stmt = $con-> prepare("SELECT items1view.*, 1 AS favorite,(items_price - (items_price * items_discount / 100)) AS itemspricediscount  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid=$userid
WHERE categories_id = $categoryid
UNION ALL
SELECT * , 0 AS favorite,(items_price - (items_price * items_discount / 100)) AS itemspricediscount FROM items1view
WHERE items_cat = $categoryid AND items_id NOT IN (SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid=$userid)");
// $stmt = $con-> prepare("SELECT items1view.*, 1 AS favorite FROM items1view
// INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid=$userid
// WHERE categories_id = $categoryid
// UNION ALL
// SELECT * , 0 AS favorite FROM items1view
// WHERE categories_id = $categoryid AND items_id != (SELECT items1view.items_id FROM items1view
// INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid=$userid)");

$stmt-> execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success" , "data" => $data));
}else{
    echo json_encode(array("status" => "failure"));
    
}

// $stmt = $con-> prepare("SELECT items1view.*, 1 AS favorite FROM items1view
// INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid = $userid
//  WHERE categories_id = $categoryid
//   UNION SELECT *, 0 AS favorite FROM items1view 
//   WHERE categories_id = $categoryid AND items_id NOT IN (SELECT items1view.items_id FROM items1view
//    INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid = $userid)");

// $stmt = $con-> prepare("SELECT items1view.*, 1 AS favorite FROM items1view
//  INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid = $userid
//   WHERE categories_id = $categoryid 
//   UNION SELECT items1view.*, 0 AS favorite FROM items1view LEFT JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid = $userid WHERE categories_id = $categoryid AND favorite.favorite_itemsid IS NULL");
?>

