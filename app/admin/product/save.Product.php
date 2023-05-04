<?php
use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

//получаем поток для работы с данными
$stream =file_get_contents("php://input");

if ($stream != null){
    //декодируем полученные данные
    $product_id=json_decode($stream)->data;
    $action = json_decode($stream)->action;
    $delImage = Product::find($product_id)->image;

    unlink("D:/Новая папка (2)/OSPanel/domains/php-demo-floris-fetch-check/upload/" . $delImage);
    $Product = match($action){   
       "delete"=> Product::deleteProduct($product_id),
    };
    echo json_encode([
        "Product" => $Product,
    ], JSON_UNESCAPED_UNICODE);
}