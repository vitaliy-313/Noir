<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$ProductByCategories = Product::viewByCategory($_GET["id"]);

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/categories/category.product.view.php";
