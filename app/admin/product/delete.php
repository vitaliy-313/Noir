<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

$product = Product::deleteProduct($_POST["id"]);

include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/tables/product.php";
