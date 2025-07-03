<?php
include "../../connect.php";
$itemId = filterRequest("itemId");
getAllData("item_variants_view","items_id = ?",array($itemId));
?>