<?php
//87
include "../connect.php";

$id = filterRequest("id");

getAllData("myfovorite","favorite_usersid = ? ", array($id));
