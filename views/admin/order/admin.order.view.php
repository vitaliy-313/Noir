<?php

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>

<link rel="stylesheet" href="/css/admin.order.css">

<form class="filter-check" action="/app/admin/tables/order.php">
    <div class="form-check filter">
        <input class="form-check-input" type="radio" name="category" id="all" checked onchange="this.form.submit()" value="all">
        <label class="form-check-label" for="all">
            все заказы
        </label>
    </div>

    <div class="filterAll">
        <?php foreach ($statuses as $status) : ?>
            <div class="form-check ">
                <input class="form-check-input" type="radio" name="category" id="<?= $status->id ?>" value="<?= $status->id ?> " onchange="this.form.submit()" <?= isset($_GET["category"]) && $_GET["category"] == $status->id ? "checked" : "" ?>>
                <label class="form-check-label" for="<?= $status->id ?>">
                    <?= $status->name ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>
</form>

<table class="order-table">
    <tr>
        <th>Id</th>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Статус</th>
        <th>Оформления</th>
        <th>общая стоимость</th>
        <th>общее количество</th>
        <th colspan="2">Взаимодействия</th>
    </tr>
    <tbody>
        <tr>
            <?php foreach ($orders as $item) : ?>
        <tr>
            <th><?= $item->orderId ?></th>  
            <th><?= $item->clientName ?></th>
            <th><?= $item->phone ?></th>
            <th><?= $item->statusName ?></th>
            <th><?= $item->dataOrder ?></th>
            <th><?= $item->pricePosition?></th>
            <th><?= $item->COUNT?></th>
            <th class="th-btn"><a href="/app/admin/order/order.product.php?id=<?= $item->orderId ?>" name="btn" class="btn btn-order">Подробно</a> </th>
            <th class="th-btn">
                <a href="/app/admin/order/order.update.form.php?id=<?= $item->orderId ?>&reason_cancel&status_id=2" name="btn" class="btn btn-order order-confirm">Подтвертить </a>
                <!-- =============отменить -->

                <a name="btn-cancel" class="btn btn-order order-cancel">Отменить</a>
                <br>
                <form action="/app/admin/order/order.update.form.php?id=&status_id=3">
                    <div class="div-reason">
                        <input type="hidden" name="id" value="<?= $item->orderId ?>">
                        <label class="reason_cancel" for="reason_cancel">причина</label>
                        <br>
                        <textarea class="reason_cancel" name="reason_cancel" id="reason_cancel" cols="30" rows="5"></textarea>
                        <p  style="color:red;"><?=$_SESSION["error"]["reason_cancel"]?? ""?></p>
                        <button name="status_id" class="btn btn-order" value="3">Сохранить</button>
                    </div>
                </form>
            </th>
        </tr>
    <?php endforeach ?>
    </tr>
    </tbody>
</table>

<script defer src="/assets/script/admin/load.order.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>