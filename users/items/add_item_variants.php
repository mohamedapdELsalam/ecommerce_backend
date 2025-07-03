<?php
include "../../connect.php";

$itemId = filterRequest("itemId");
$itemColor = filterRequest("itemColor");
$itemSize = filterRequest("itemSize");
$itemPrice = filterRequest("itemPrice");
$itemCount = filterRequest("itemCount");


$stmt = $con->prepare("INSERT INTO 
 item_variants(item_id,item_color,item_size,variant_price,variant_count)
 VALUES (?,?,?,?,?)");
 $stmt->execute(array($itemId,$itemColor,$itemSize,$itemPrice,$itemCount));
$count = $stmt->rowCount();
if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "success"));
}
