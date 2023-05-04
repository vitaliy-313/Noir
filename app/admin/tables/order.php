<?php

use App\models\Order;
use App\models\Statuses;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$orders = Order::all();

$statuses = Statuses::all();

if (isset($_GET["category"])) {
if ($_GET["category"] != "all") {
$orders = Order::ordersByStatuses($_GET["category"]);
}
}

json_encode($orders, JSON_UNESCAPED_UNICODE);


include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/order/admin.order.view.php";
