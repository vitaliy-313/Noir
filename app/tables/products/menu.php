<?php

use App\models\Category;
use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$categories = Category::all();

include $_SERVER["DOCUMENT_ROOT"] . "/views/products/menu.view.php";
