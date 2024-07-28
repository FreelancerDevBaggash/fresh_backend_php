
<?php
//110
include "../connect.php";
$searsh = filterRequest("searsh");

getAlldata("items1view","items_name_en LIKE '%$searsh%' OR items_name_ar LIKE '%$searsh%'");