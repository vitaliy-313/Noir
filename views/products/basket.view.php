<?php

use app\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.auth/header.all.php"; ?>
<link rel="stylesheet" href="/css/style.basket.css">

<p class="message"></p>
<div id="basket" class="basket-position">

    <?php foreach ($basket as $product) : ?>
        <div class="card">
            <div class="card-data-btnbody">
                <img src="/upload/menu/<?= $product->photo ?> " class="card-img-top card-upload" alt="<?= $product->photo ?>">
                <div class="card-option">
                    <h5 class="card-title" data-product-id="<?= $product->product_id ?>"><?= $product->product_name ?></h5>
                    <div class="card-volumes">
                        <?php foreach (Product::volumes($product->product_id) as $volume) : ?>
                            <div class="card-volume">
                                <input type="radio" <?php if ($product->volume_id == $volume->id) : echo ("checked");
                                                    endif; ?> name="volume<?= $product->product_id ?>" id="<?= $product->product_id ?><?= $volume->id ?>" data-volume-id="<?= $volume->id ?>" data-product-id="<?= $product->product_id ?>" value="<?= $volume->name ?>" class="card-checked">
                                <label class="volume-label" for="<?= $product->product_id ?><?= $volume->id ?>"><?= $volume->name ?><?= $volume->units ?></label>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div>
                        <p>Доп. сироп</p>
                        <select name="syrup" id="syrap" class="syrup" data-product-id=<?= $product->product_id ?>>
                            <?php foreach ($syraps as $syrap) : ?>
                                <option value="<?= $syrap->id ?>"><?= $syrap->name ?> </option>
                            <? endforeach ?>
                        </select>
                    </div>

                </div>
                <div class="update-count">
                    <img class="btn-image btn-basket-minus" data-product-id=<?= $product->product_id ?> src="/upload/icons/minus.png" alt="">
                    <p class="count count-<?= $product->count ?>" data-count=<?= $product->product_id ?>> <?= $product->count ?></p>
                    <img class="btn-basket-plus btn-image " data-product-id=<?= $product->product_id ?> src="/upload/icons/plus.png" alt="">
                    <img class="btn-image btn-basket-delete" data-product-id=<?= $product->product_id ?> src="/upload/icons/close.png" alt="">
                </div>
                <p class="card-price" data-price-position=<?= $product->product_id ?>><?= $product->price ?>₽</p>
            </div>

        </div>
    <?php endforeach ?>
    <form action="/app/tables/basket/order.php" method="POST">
        <div class="basket-info-all">
            <div class="up-basket-form1">
                <p class="totalPrice basket-info " name="totalPrice">итого: <?= $totalPrice ?>₽</p>
                <p class="totalCount basket-info">итоговое количество: <?= $totalCount ?>/шт.</p>
            </div>
            <div class="up-basket-form">

                <button class="up-basket">оформить заказ</button> <br> <br>
    </form>
    <button class="clear up-basket" name="clear-btn">очистить корзину</button>
</div>
</div>
</div>



<script src="/assets/script/basket.js"></script>
<script src="/assets/script/fetch.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>