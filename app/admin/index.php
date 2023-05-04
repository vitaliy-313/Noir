<?php


include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/index.view.php";
