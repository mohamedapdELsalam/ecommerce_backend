
<?php

include "../connect.php";

$orderId = filterRequest("orderId");
$userId = filterRequest("userId");
$adminId =filterRequest("adminId");
$stmt = $con->prepare("UPDATE orders SET orders_status = 3 WHERE orders_status = 2 AND orders_id = ?");
$stmt->execute(array($orderId));
$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
    insertNotification("delivery confirm" ,"i,am confirmed the order :$orderId",$adminId,"admins$adminId","none");
    insertNotification("welcome" ,"your order become on the way",$userId,"users$userId","refreshOrders");
}else{
    echo json_encode(array("status" => "success"));
}