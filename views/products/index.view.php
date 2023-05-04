<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; ?>
<link rel="stylesheet" href="/css/style.index.css">

<img class="nav-image-img" src="/upload/index.coffe.header.png" alt="">
</div>
<div class="ind-classic">СLASSICAL</div>
<div class="top-3-product">
    <?php foreach ($products as $product) : ?>
        <a href="/app/tables/products/show.php?id=<?= $product->id?>" class="col">
            <div class="card">
                <img src="/upload/menu/<?= $product->photo ?> " class="card-img-top card-upload" alt="<?= $product->photo ?>">
                <div class="card-data-btnbody">
                    <h5 class="card-title"><?= $product->name ?></h5>
                    <p class="card-text"> Цена:
                        <?= Product::minPriceVolumeProduct($product->id)->price ?> ₽
                        <?= Product::minPriceVolumeProduct($product->id)->volume ?>ml
                    </p>
                </div>
            </div>
        </ф>
    <?php endforeach ?>
</div>
<a href="/app/tables/products/menu.php" class="ind-classic">Заказать кофе</a>

<div class="aboutAs">
    <div class="aboutAsText">
        <p class="As">О нас</p>
        <p class="about">Кофейня «Noir» занимается изготовлением классического кофе на основе
            зерен Арабики и Робуста, а также созданием авторских напитков. </p>
    </div>

    <img class="image-coffee" src="/upload/coffee-image.png" alt="">
</div>
<div class="music">
    <p>Музыка для добавления в плейлист</p>
    <div class="music-real">
        <p>music</p>
    </div>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>