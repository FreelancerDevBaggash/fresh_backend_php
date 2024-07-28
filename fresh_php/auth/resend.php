<?php

include "../connect.php";

$email = filterRequest("email");
$verfiycode = rand (10000 , 99999);
$data =array(
    "users_verfiycode" => $verfiycode
);

updateData("users",$data,"email = '$email'");

  //هذه عند ارسال بريد الالكتروني
    //    sendEmail($email , "Verfiy code App Your Email","Verfiy code $verfiycode");
    // printSuccess();
