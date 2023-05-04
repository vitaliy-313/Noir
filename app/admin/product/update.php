<?php

use App\models\Category;
use App\models\Product;
use App\models\Volume;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$id = $_GET['id'];
$product = Product::find($id);
$categories = Category::all();

$volumes = Volume::all();
$units = Volume::unitsAll();

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/product/admin.product.update.php";
