<?php

use core\Application;
$this->title = "Home";
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=Application::$app->router->title?></title>
    <!-- Bootstrab 4 CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="/assets/css/uikit.min.css" />
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <!-- My CSS  -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/preloader.css">
    <!-- JQuery  -->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
</head>
<body>

    <div class="preload">
        <div class="loader">Loading...</div>
    </div>

    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white uk-box-shadow-medium">
            <div class="container">
                <a class="navbar-brand" href="/">HOTEL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">ABOUT</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">GALLERY</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">ROOMS</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">CONTACT</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">RESTAURANT</a>
                    </li>
                    <li class="nav-item" id="booknow">
                    <a class="text-center nav-link active" aria-current="page" href="#">BOOK NOW</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{content}}
    </main>

    <footer>
        <div id="overlay" class="p-5">
        <div class="row w-75 m-auto">
            <div class="col-12 col-md">
                <ul class="list-unstyled">
                    <li class="lh-lg"><a href="/">home</a></li>
                    <li class="lh-lg"><a href="/">about</a></li>
                    <li class="lh-lg"><a href="/">gallery</a></li>
                </ul>
            </div>
            <div class="col-12 col-md">
            <ul class="list-unstyled">
                    <li class="lh-lg"><a href="/">rooms</a></li>
                    <li class="lh-lg"><a href="/">contact</a></li>
                    <li class="lh-lg"><a href="/">restaurant</a></li>
                </ul>
            </div>
            <div class="col-12 col-md">
            <ul class="list-unstyled">
                    <li class="lh-lg"><span uk-icon="location"></span>203 Fake St. Mountain View, San Francisco, California, USA</li>
                    <li class="lh-lg"><span uk-icon="receiver"></span>01144435326</li>
                    <li class="lh-lg"><span uk-icon="mail"></span>info@yourdomain.com</li>
                </ul>
            </div>
            <div class="col-12 col-md">
                <a href="#" class="lh-lg">book now <span uk-icon="arrow-right"></span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="m-1 p-4 mx-auto text-center">© 2020 All rights reserved. Designed & developed by <a href="https://web.facebook.com/SamirHussein011">Samir Ebrahim</a></p>
            </div>
        </div>
        </div>
    </footer>

    <!-- Bootstrab 4 JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- UIkit JS -->
    <script src="/assets/js/uikit.min.js"></script>
    <script src="/assets/js/uikit-icons.min.js"></script>
    <!-- My script -->
    <script src="/assets/js/script.js"></script>
    <!-- preloader function -->
    <script>
        $(window).on("load",function(){
            $(".preload").fadeOut("slow");
        });
    </script>
</body>
</html>