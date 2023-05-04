<?php

use app\models\Basket;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

//получаем поток для работы с данными
$stream = file_get_contents("php://input");

if ($stream != null) {
    //декодируем полученные данные
    $product_id = json_decode($stream)->data->product_id;
    $volume_id = json_decode($stream)->data->volume_id;
    $syrup_id = json_decode($stream)->data->syrup_id??null;
    $action = json_decode($stream)->action;
    $user_id = $_SESSION["id"];

    $basketInProduct =  match ($action) {
        "add" => Basket::add($product_id, $user_id, $volume_id),
        "dec" => Basket::deс($product_id, $user_id),
        "delete" => Basket::deleteProduct($product_id, $user_id),
        "clear" => Basket::clear($user_id),
        "addSyrup" => Basket::addSyrup($product_id, $user_id, $syrup_id),
        "changeVolume"=>Basket::changeVolume($product_id, $user_id, $volume_id)
    };
    echo json_encode([
        "basketProduct" => $basketInProduct,
        "totalPrice" => Basket::totalPrice($user_id),
        "totalCount" => Basket::totalCount($user_id),
    ], JSON_UNESCAPED_UNICODE);
}
