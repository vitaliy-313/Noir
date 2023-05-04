<?php

use app\models\Basket;
use App\models\Syrup;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
$user_id = $_SESSION["id"];
$basket = Basket::get_basket($user_id);
$syraps = Syrup::all();
$totalPrice = Basket::totalPrice($user_id);
$totalCount = Basket::totalCount($user_id);

include $_SERVER["DOCUMENT_ROOT"] . "/views/products/basket.view.php";
