<?php

use App\models\Category;
use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.auth/header.all.php"; ?>

<link rel="stylesheet" href="/css/style.menu.css">

<div id="menu-coffe" class="menu-coffe-position">

    <?php foreach ($categories as $category) : ?>

        <div class="category_title">
            <h2 class="category_name"><?= $category->name ?></h2>
            <img class="category-img" src="/upload/menu/<?= $category->image ?>" alt="">
        </div>
        <div class="col menu-cards">
        <?php foreach (Category::productsByCategory($category->id) as $product) : ?>
            
                <div class="card">
                    <img src="/upload/menu/<?= $product->photo ?>" class="card-img-top card-upload" alt="<?= $product->photo ?>">
                    <div class="card-data-btnbody">
                        <h5 class="card-title"><?= $product->name ?></h5>
                        <p class="card-text"><?= $product->description_mini ?></p>
                        <p class="card-price"> от

                            <?= Product::minPriceProduct($product->id)->minPrice ?> ₽

                        </p>
                        <div class="item-end">
                        <a href="/app/tables/products/show.php?id=<?= $product->id ?>" class="btn btn-primary detail">Подробно</a>
                        
                        <a href="/app/tables/products/show.php?id=<?= $product->id ?>" class="btn btn-primary detail"><img src="/upload/icons/basket-img.png" alt="" class="btn-basket" data-btn-id="<?= $product->id ?>"> </a>

                        </div>
                        
                    </div>
                </div>

        <?php endforeach ?>
        </div>


    <?php endforeach ?>

</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>