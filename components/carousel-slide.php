<?php

require_once 'vendor/autoload.php';

use Museum\Utils\HtmlManipulator;
use Museum\Utils\JsonDataManager;

$imageManager = new JsonDataManager(__DIR__.'/../assets/data/carousel_img.json');
$textManager = new JsonDataManager(__DIR__.'/../assets/data/carousel_text.json');
$introText = $textManager->read('carousel_text');

?>

<div
    id="carouselExample"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-interval="<?= htmlspecialchars($introText["interval"])?>"
>
    <div
        class="position-absolute top-50 start-50 translate-middle text-center text-white"
        style="z-index: 10"
    >
        <p class="mv-bt"><?= htmlspecialchars($introText["opening_date"])?></p>
        <h1 class="mv-bt"><?= $introText["title"]?></h1>
        <p class="mv-bt" style="letter-spacing: 1px"><?= $introText["description"]?></p>
        <a
            href="portal.php"
            class="btn btn-success rounded-0 fw-bold text-uppercase"
        >
            Get Started
        </a>
    </div>
    <div class="carousel-inner bg-darker">
        <?php
            $carouselItems = $imageManager->readAll();
            usort($carouselItems, fn($a, $b) => (int)$a['id'] <=> (int)$b['id']);
            foreach ($carouselItems as $item):
        ?>
        <div class="carousel-item active">
            <img
                src="<?= htmlspecialchars($item['image_url']) ?>"
                class="d-block w-100 vh-100 object-fit-cover"
                alt="<?= htmlspecialchars($item['description']) ?>"
            />
        </div>
        <?php endforeach;?>
    </div>
    <button
        class="carousel-control-prev d-none"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="prev"
    >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button
        class="carousel-control-next d-none"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="next"
    >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
