
<?php

include "connect.php";

$userId = filterRequest("userId");

$allData= array();
$allData["status"] = "success";
$allData["categories"] = getAllData("categories","categories_id != 0",null,"",false);
$allData["items"] = getAllData("items_view","items_active =1",null,"",false);
$allData["items_discount"] = getAllData("items_view","items_discount != 0 AND items_active =1",null,"",false);
$allData["topItems"] = getAllData("topselling","items_active =1",null,"",false);
echo json_encode($allData);



?>

