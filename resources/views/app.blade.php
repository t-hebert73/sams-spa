<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <?php

        $title = '';
        $description = '';
        if($page) {

            $title = $page->title . ' | Alesco Salon & Aesthetics';
            $description = substr(strip_tags($page->content), 0, 300);

            switch(strtolower($page->type)) {
                case 'home':
                    $title = "Alesco Salon & Aesthetics";
                    $description = "Alesco Salon & Aesthetics is an Aveda salon and spa located in downtown Thorold. We offer a wide range of hair styling and spa services for women and men.";
                    break;

                case 'gallery':
                    $description = 'View the gallery for Alesco Salon & Aesthetics';
                    break;

                case 'contact':
                    $description = 'Alesco Salon & Aesthetics. 133 Front Street N. Thorold, Ontario, L2V 0A3';
                    break;

                case 'services':
                    $description = 'Alesco Salon & Aesthetics is an Aveda salon and spa located in downtown Thorold. We offer a wide range of hair styling and spa services for women and men.';
                    break;
            }
        } else {
            $title = 'Page Not Found';
            $description = '';
        }

        ?>

        <title><?php echo $title; ?></title>

        <meta name="description" content="<?php echo $description; ?>"/>
        <meta name="keywords" content="Alesco, Salon, Thorold, Hair, Aesthetics, Aveda, Spa"/>

        <link href="/css/app.css" rel="stylesheet"/>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">

        <meta property="og:title" content="<?php echo $title; ?>">
        <meta property="og:description" content="<?php echo $description; ?>">
        <meta property="og:site_name" content="Alesco Salon & Aesthetics">
        <meta property="og:url" content="<?php echo url()->full(); ?>">
        <meta property="og:type" content="website">
        <meta property="og:image" content="https://alescosalon.ca/images/alesco-logo.png">

    </head>
    <body>
        <div id="main_app">
            <main-app>
                <div style="height: 0px; overflow: hidden;">

                    <header>
                        <nav>
                            <li class="nav-item">
                                <a href="/" class="nav-link" title="Home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/about" class="nav-link" title="About">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="/services" class="nav-link" title="Services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a href="/gallery" class="nav-link" title="Gallery">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a href="/contact" class="nav-link" title="Contact">Contact</a>
                            </li>
                        </nav>
                    </header>

                    <main>
                        <?php


                            if($page) {
                                echo '<h1>' . $page->title . '</h1>';

                                echo html_entity_decode($page->content);

                                switch(strtolower($page->type)) {
                                    case 'home':
                                        ?>

                                        <div>
                                            <p>Alesco Salon & Aesthetics is an Aveda salon and spa located in downtown Thorold. We offer a wide range of hair styling and spa services for women and men. </p>
                                        </div>

                                        <?php
                                        break;

                                    case 'gallery':
                                        ?>
                                        <div class="gallery">
                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery1.jpg" alt="Gallery Photo #1" title="Gallery Photo 1">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery2.jpg" alt="Gallery Photo #2" title="Gallery Photo 2">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery3.jpg" alt="Gallery Photo #3" title="Gallery Photo 3">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery4.jpg" alt="Gallery Photo #4" title="Gallery Photo 4">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery5.jpg" alt="Gallery Photo #5" title="Gallery Photo 5">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery6.jpg" alt="Gallery Photo #6" title="Gallery Photo 6">
                                            </div>

                                            <div class="gallery-photo">
                                                <img src="https://alescosalon.ca/images/gallery/gallery7.jpg" alt="Gallery Photo #7" title="Gallery Photo 7">
                                            </div>

                                        </div>
                                        <?php
                                        break;

                                    case 'contact':
                                        ?>

                                        <div class="address">
                                            <p>Alesco Salon & Aesthetics</p>
                                            <p>133 Front Street N. Thorold, Ontario, L2V 0A3</p>
                                        </div>

                                        <div class="social-media">
                                            <a href="https://www.facebook.com/alescosalonandaesthetics/" target="_blank" title="Alesco Salon on Facebook">Facebook</a>
                                            <a href="https://www.instagram.com/explore/locations/890235954441523/alesco-salon-aesthetics/?hl=en" target="_blank" title="Alesco Salon on Instagram">Instagram</a>
                                        </div>

                                        <?php
                                        break;

                                    case 'services':
                                        ?>

                                        <div>
                                            <p>Alesco Salon & Aesthetics is an Aveda salon and spa located in downtown Thorold. We offer a wide range of hair styling and spa services for women and men. </p>
                                        </div>

                                        <?php
                                        break;
                                }
                            }

                        ?>
                    </main>

                    <footer>
                        <p>©2018 Alesco Salon. All Rights Reserved</p>
                    </footer>
                </div>
            </main-app>
        </div>

        <footer>
            <script async src="/js/app.js"></script>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59455628-4"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-59455628-4');
            </script>

        </footer>
    </body>
</html>
