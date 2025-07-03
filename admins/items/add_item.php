<?php

include "../../connect.php";

$nameAr = filterRequest("nameAr");
$nameEn = filterRequest("nameEn");
$nameDe = filterRequest("nameDe");
$nameSp = filterRequest("nameSp");
$descAr = filterRequest("descAr");
$descEn = filterRequest("descEn");
$descDe = filterRequest("descDe");
$descSp = filterRequest("descSp");
$price = filterRequest("price");
$discount = filterRequest("discount");
$count = filterRequest("count");
$active = filterRequest("active");
$categoryId  = filterRequest("categoryId");

$imageRequest  =  imageUpload("image", "/upload/items/");
$imageData = json_decode($imageRequest, true);
if ($imageData["status"] != "success") {
    echo $imageRequest;
    return;
}
$imageName = $imageData["imageName"];

$variantsJson = $_POST["variants"] ?? "[]"; 
$variants = json_decode($variantsJson, true);

$stmt = $con->prepare("INSERT INTO items (
    items_name_ar, items_name_en, items_name_de , items_name_sp , 
    items_desc_ar , items_desc_en , items_desc_de , items_desc_sp ,
    items_price , items_discount , items_count ,
    items_active , items_image , items_categories )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([
    $nameAr, $nameEn, $nameDe, $nameSp,
    $descAr, $descEn, $descDe, $descSp,
    $price, $discount, $count,
    $active, $imageName, $categoryId
]);

$count = $stmt->rowCount();

$countSuccess = 0;
if ($count > 0) {
    $itemId = $con->lastInsertId();

    if (!empty($variants)) {
        foreach ($variants as $v) {
            $stmtVar = $con->prepare("INSERT INTO item_variants(
                item_id, item_color, item_size, variant_price, variant_count,variant_discount)
                VALUES (?, ?, ?, ?, ?,?)");

            $stmtVar->execute([
                $itemId,
                $v["itemColor"],
                $v["itemSize"],
                $v["itemPrice"],
                $v["itemCount"],
                $v["itemDiscount"],
            ]);
           $countSuccess = $stmt->rowCount();
        }
    }

    echo json_encode([
        "status" => "success",
        "item_id" => $itemId,
        "countSuccess" => $countSuccess
    ]);
} else {
    echo json_encode(["status" => "fail"]);
}

?>
