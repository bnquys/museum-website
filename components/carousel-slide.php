<?php

require_once 'vendor/autoload.php';

$imageManager = new JsonDataManager(__DIR__ . '/../../assets/data/carousel_img.json');
$textManager = new JsonDataManager(__DIR__ . '/../../assets/data/carousel_text.json');
$introText = $textManager->read('carousel_text');

?>

<div
    id="carouselExample"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-interval="3000"
>
    <div
        class="position-absolute top-50 start-50 translate-middle text-center text-white"
        style="z-index: 10"
    >
        <p class="mv-bt">Openning on 21st February, 2018</p>
        <h1 class="mv-bt">"Our World, Our Nature,<br> Our Museum"</h1>
        <p class="mv-bt" style="letter-spacing: 1px">
			Journey through the evolving relationship between humans and nature.
            This exhibition highlights changing landscapes, endangered species,
            and the impact of modern life on the environment.
        </p>
        <a
            href="portal.php"
            class="btn btn-success rounded-0 fw-bold text-uppercase"
        >
            Get Started
        </a>
    </div>
    <div class="carousel-inner bg-darker">
        <div class="carousel-item active">
            <img
                src="https://picsum.photos/1920/1080?random=1"
                class="d-block w-100 vh-100 object-fit-cover"
                alt="..."
            />
        </div>
        <div class="carousel-item">
            <img
                src="https://picsum.photos/1920/1080?random=2"
                class="d-block w-100 vh-100 object-fit-cover"
                alt="..."
            />
        </div>
        <div class="carousel-item">
            <img
                src="https://picsum.photos/1920/1080?random=3"
                class="d-block w-100 vh-100 object-fit-cover"
                alt="..."
            />
        </div>
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
