<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="assets/css/bootstrap.css" />
        <title>Blog</title>
		<?php include "components/favicon.php";?>

        <link rel="stylesheet" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/carousel-banner.css" />
        <link rel="stylesheet" href="assets/css/boots-cus.css" />
        <link rel="stylesheet" href="assets/css/header.css" />
		<link rel="stylesheet" href="assets/css/blog.css">
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- Link jQuery for DropDown menu -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            include "components/navbar.php";
            $name = "Blog";
            include "components/banner.php";
        ?>

        <section class="container d-flex flex-column flex-lg-row gap-5">
            <div id="post" class="d-flex flex-column gap-4">
                <div class="card border-0">
                    <img
                        src="https://picsum.photos/500/300?random=1"
                        class="card-img-top"
                        alt="..."
                    />
                    <div class="card-body">
                        <p>
                            <a href="#">Art</a>, <a href="#">Technology</a>,
                            <a href="#">Fashion</a>
                        </p>
                        <h2>
                            <a href="#"
                                >Cartridge Is Better Than Ever A Discount
                                Toner</a
                            >
                        </h2>
                        <p class="card-text">
                            MCSE boot camps have its supporters and its
                            detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can
                            get the MCSE study materials yourself at a fraction
                            of the camp price. However, who has the willpower to
                            actually sit through a self-imposed MCSE training.
                            who has the willpower to actually sit through a
                            self-imposed MCSE training.
                        </p>
                        <div class="d-flex gap-3">
                            <p>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-heart"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"
                                    />
                                </svg>

                                4 likes
                            </p>
                            <p>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chat"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"
                                    />
                                </svg>
                                06 comments
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <img
                        src="https://picsum.photos/500/300?random=2"
                        class="card-img-top"
                        alt="..."
                    />
                    <div class="card-body">
                        <p>
                            <a href="#">Art</a>, <a href="#">Technology</a>,
                            <a href="#">Fashion</a>
                        </p>
                        <h2>
                            <a href="#"
                                >Cartridge Is Better Than Ever A Discount
                                Toner</a
                            >
                        </h2>
                        <p class="card-text">
                            MCSE boot camps have its supporters and its
                            detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can
                            get the MCSE study materials yourself at a fraction
                            of the camp price. However, who has the willpower to
                            actually sit through a self-imposed MCSE training.
                            who has the willpower to actually sit through a
                            self-imposed MCSE training.
                        </p>
                        <div class="d-flex gap-3">
                            <p>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-heart"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"
                                    />
                                </svg>

                                4 likes
                            </p>
                            <p>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chat"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"
                                    />
                                </svg>
                                06 comments
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column w-100 gap-4">
                <!-- Search box -->
                <form action="#" class="container-fluid">
                    <div class="row row-cols-2 border p-5 p-auto">
                        <div class="col-10 p-0">
                            <input
                                type="email"
                                class="form-control rounded-0 text-gray fw-light border-0"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Search Posts"
                                style="background-color: rgb(226, 243, 226)"
                            />
                        </div>
                        <div class="col-2 p-0">
                            <button
                                type="button"
                                class="btn btn-success rounded-0 fw-bold text-uppercase fs-6 p-0 pb-1 px-1 ms-1"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="25"
                                    height="25"
                                    fill="currentColor"
                                    class="bi bi-arrow-right"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Previewer -->
                <div class="card rounded-0 py-2">
                    <img
                        src="https://picsum.photos/500"
                        class="card-img-top mx-auto my-4 rounded-0"
                        style="width: 40%"
                        alt="..."
                    />
                    <div class="card-body">
                        <h5 class="card-title text-center">Adele Gonzalez</h5>
                        <p class="card-text text-center">
                            MCSE boot camps have its supporters and its
                            detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can
                            get.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href=""
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="var(--dark-cl)"
                                    class="bi bi-facebook me-1 hover-link"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"
                                    />
                                </svg>
                            </a>
                            <a href="">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="var(--dark-cl)"
                                    class="bi bi-twitter-x me-1 hover-link"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"
                                    /></svg></a
                            ><a href=""
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="var(--dark-cl)"
                                    class="bi bi-globe-americas hover-link"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"
                                    /></svg
                            ></a>
                        </div>
                    </div>
                </div>
                <!-- Post Categories -->
                <div class="container-fluid border">
                    <h3 class="p-2 pt-3">Post Categories</h3>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">An item</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">An item</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">An item</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">An item</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">An item</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Recent posts -->
                <div class="container-fluid border">
                    <h3 class="p-2 pt-3">Recent Posts</h3>
                    <ul class="list-group">
                        <li class="list-group-item border-0">
                            <div>
                                <img
                                    src="https://picsum.photos/500?random=1"
                                    alt=""
                                    class="w-25 float-start me-2"
                                />
                                <div>
                                    <p class="h5">
                                        Home Audio Recording For Everyone
                                    </p>
                                    <p class="mb-1">02 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0">
                            <div>
                                <img
                                    src="https://picsum.photos/500?random=2"
                                    alt=""
                                    class="w-25 float-start me-2"
                                />
                                <div>
                                    <p class="h5">
                                        Home Audio Recording For Everyone
                                    </p>
                                    <p>02 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0">
                            <div>
                                <img
                                    src="https://picsum.photos/500?random=3"
                                    alt=""
                                    class="w-25 float-start me-2"
                                />
                                <div>
                                    <p class="h5">
                                        Home Audio Recording For Everyone
                                    </p>
                                    <p>02 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0">
                            <div>
                                <img
                                    src="https://picsum.photos/500?random=4"
                                    alt=""
                                    class="w-25 float-start me-2"
                                />
                                <div>
                                    <p class="h5">
                                        Home Audio Recording For Everyone
                                    </p>
                                    <p>02 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0">
                            <div>
                                <img
                                    src="https://picsum.photos/500?random=5"
                                    alt=""
                                    class="w-25 float-start me-2"
                                />
                                <div>
                                    <p class="h5">
                                        Home Audio Recording For Everyone
                                    </p>
                                    <p>02 hours ago</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Post archive -->
                <div class="container-fluid border">
                    <h3 class="p-2 pt-3">Post Archive</h3>
                    <ul class="list-group list-group-flush px-4 mb-3">
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Dec</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Nov</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Oct</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Sep</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Aug</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Jul</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Jun</p>
                                <p class="mb-0">15</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Tag clouds -->
                <div class="container-fluid border">
                    <h3 class="p-2 pt-3">Tag clouds</h3>
                    <div class="d-flex flex-wrap gap-1 px-3 mb-3">
                        <a href="#" class="border p-2">Lifestyle</a
                        ><a href="#" class="border p-2">Art</a
                        ><a href="#" class="border p-2">Adventure</a
                        ><a href="#" class="border p-2">Food</a
                        ><a href="#" class="border p-2">Technology</a
                        ><a href="#" class="border p-2">Fashion</a
                        ><a href="#" class="border p-2">Art</a
                        ><a href="#" class="border p-2">Adventure</a
                        ><a href="#" class="border p-2">Food</a
                        ><a href="#" class="border p-2">Technology</a
                        ><a href="#" class="border p-2">Fashion</a>
                    </div>
                </div>
            </div>
        </section>

        <?php 
            include "components/footer.php";
        ?>
        <script src="./assets/js/dropdown-menu.js"></script>
        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/sip.js"></script>
    </body>
</html>
