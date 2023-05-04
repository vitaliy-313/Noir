<?php

use App\models\Client;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

$user = Client::find($_SESSION["id"]);

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/profile.view.php";
