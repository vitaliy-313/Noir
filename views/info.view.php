<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; ?>


<link rel="stylesheet" href="/css/info.css">


<div id="carouselExample" class="carousel slide">

    <div class="carousel-inner">
        <?php foreach ($fiveProduct as $key => $value) : ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                <img style="height:450px;     width: 450px;" src="/upload/<?= $value->image ?>" class="d-block w-100" alt="<?= $value->image ?>">
                <p style="color: black;"><?= $value->name ?> </p>
            </div>
        <?php endforeach ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>