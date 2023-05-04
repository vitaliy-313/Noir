<?php

use App\models\Category;
use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

if (isset($_POST['btn'])) {

    Category::add($_POST["name"]);
    unset($_SESSION);
}
header("Location: /app/admin/tables/category.php");
