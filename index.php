<?php

use App\models\Category;
use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


$categories = Category::all();
$products = Product::five();

include $_SERVER["DOCUMENT_ROOT"] ."/views/products/index.view.php";