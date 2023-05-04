<?php

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<div>
    <h1>Номер заказа :<?= $order[0]->orderId ?></h1>
    <h2>Статус :<?= $order[0]->statusName ?></h2>
    <h2>Имя клиента :<?= $order[0]->clientName ?></h2>
    <h4>Создание :<?= $order[0]->created_at ?></h4>
    <h4>Оформление :<?= $order[0]->dateOrder ?></h4>
    продукты
    <table>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Цена</th>
            <th>Цена сиропа</th>
            <th>Кол-во</th>
            <th>Категория</th>
            <th>Картинка</th>
        </tr>
        <tbody class="product-container">
            <?php foreach($order as $product):?>
            <tr class="product-position">
                <th><?= $product->id ?></th>
                <th><?= $product->name ?></th>
                <th><?= $product->product_price ?></th>
                <th><?= $product->syrup_price ?></th>
                <th><?= $product->count ?></th>
                <th><?= $product->category ?></th>
                <th><img style=" width: 150px; " src="/upload/<?= $product->image ?>" alt=""></th>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>

</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>