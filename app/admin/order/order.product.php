
<?php

use App\models\Order;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

$order= Order::find($_GET['id']);

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/order/order.product.view.php";
