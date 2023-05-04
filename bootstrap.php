<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] ."/app/config/db.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/helpers/Connection.php";

include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Product.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Category.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Basket.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Order.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Client.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Syrup.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Statuses.php";
include $_SERVER["DOCUMENT_ROOT"] ."/app/models/Volume.php";