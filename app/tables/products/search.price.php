<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

//декадируем JSON Данные (категории)
$price=0;

if (isset($_GET['volume_id']) && isset($_GET['product_id'])) {
    $price = Product::priceProductByVolume($_GET['product_id'], $_GET['volume_id']);
}
echo json_encode($price, JSON_UNESCAPED_UNICODE);
