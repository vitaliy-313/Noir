<?php

use App\models\Order;

if (!isset($_SESSION['auth']) || !$_SESSION["auth"]) {
    header("Location: /app/admin/tables/create.php");
    die();
}
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.auth/header.all.php"; ?>
<link rel="stylesheet" href="/css/style.profile.css">
<div class="profile">
    <div class="profile-header">
        <img class="profile-image" src="/upload/user.icon/user_person_profile_avatar_icon_190943 1.png" alt="">
        <div class="prodile-info">
            <p><?= $user->surname ?> <?= $user->name ?></p>
            <p><?= $user->phone ?></p>
        </div>
    </div>
    <div class="frofile-orders">
        <h1 class="order-text">Мои заказы</h1>
        <?php foreach ($orders as $order) : ?>
            <div class="order">
                <div class="order-id">
                    <?php if ($order->status_id == 1) : ?>
                        <div class="status_id_1"></div>
                    <?php elseif ($order->status_id == 2) : ?>
                        <div class="status_id_2"></div>
                    <?php endif ?>
                    <p>Заказ-<?= $order->id ?></p>
                </div>
                <p><?= $order->created_order ?></p>
                <?php foreach (Order::findInClientProduct($order->id) as $product) : ?>


                    <p><?= $product->product ?></p>
                    <p class="product-order-price"><?= $product->product_price ?></p>

                <?php endforeach ?>

                <div class="order-price">
                    <p>Итог:<?= $order->AllPrice ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>

<button class="out-btn"><a class="out" href="/app/users/logout.php">Выйти</a></button>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>