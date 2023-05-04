<?php

use App\models\Category;
use App\models\Volume;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

$categories = Category::all();
$volumes = Volume::all();
$units = Volume::unitsAll();

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/product/admin.product.add.view.php";
