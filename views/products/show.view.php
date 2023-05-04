<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.auth/header.all.php"; ?>
<link rel="stylesheet" href="/css/style.show.css">

<div class="container-coffe">

        <img src="/upload/menu/<?= $product->photo ?>" class="card-img-top card-upload" alt="<?= $product->photo ?>">

    <div class="card-body">
        <p class="card-title" data-product-id="<?= $product->id ?>"><?= $product->name ?></p>
        <p class="card-text"><?= $product->description ?></p>
        <div class="card-volumes">
            <?php foreach ($volumes as $volume) : ?>
                <div class="card-volume">
                    <input  type="radio" name="volume" id="volume<?= $volume->id ?>" value="<?= $volume->id ?>" class="card-text card-checked">
                    <label for="volume<?= $volume->id ?>"><?= $volume->name ?><?= $volume->units ?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="item-end">
            <p class="card-text card-price"></p>
            <button data-product-id="<?= $product->id ?>" id="btnOrder">В корзину</button>
        </div>
    </div>

</div>
<script src="/assets/script/fetch.js"></script>
<script src="/assets/script/loudPrice.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>