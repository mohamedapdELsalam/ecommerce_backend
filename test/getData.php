<?php

include"../connect.php";

$userId = filterRequest("id");

$stmt = $con->prepare("SELECT * FROM `test` WHERE test_user = ?");
$stmt->execute(array($userId));
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($count > 0 ){
    echo json_encode(array("status" => "success" , "data" => $data));
}else{
    echo json_encode(array("status" => "fail" , "message" => "error"));
}

?>