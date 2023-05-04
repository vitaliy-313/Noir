<?php

use App\models\Category;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$categories = Category::all();
include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/product/admin.product.view.php";
