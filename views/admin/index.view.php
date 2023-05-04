<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<link rel="stylesheet" href="/css/admin.index.css">

<div class="card">
    <a href="/app/admin/tables/category.php" class="index-card">
        <div class="card-data-btnbody">
            <h5 class="card-title">Категории</h5>
        </div>
    </a>

    <a href="/app/admin/tables/product.php" class="index-card">
        <div class="card-data-btnbody">
            <h5 class="card-title">Товары</h5>
        </div>
    </a>

    <a href="/app/admin/tables/order.php" class="index-card">
        <div class="card-data-btnbody">
            <h5 class="card-title">Заказы</h5>
        </div>
    </a>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>