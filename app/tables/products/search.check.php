<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

//декадируем JSON Данные (категории)
if (isset($_GET['category'])) {
    $categories = json_decode($_GET['category']);
}
if (!isset($categories) || empty($categories) || $categories == "all") {
    $products = Product::all();
} else {
    $products = Product::productsByManyCategory($categories);
}
echo json_encode($products, JSON_UNESCAPED_UNICODE);
