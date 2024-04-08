<?php
include_once "./includes/connAct.php";
include_once "./includes/nav.php";
?>

<html lang="en">

<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/gallery.css">

</head>

<!--body-->

<body>
    <div class="center-div">
        <h1>MathArt's Gallery</h1>
    </div>
    <section class="container">
        <div class="slider-wrapper">
            <div class="slider">
                <img id="slide-1" src="./assets/messbox.png" alt="Shaded Optical Illusion on White Paper">
                <img id="slide-2" src="./assets/davincihedron.jpg" alt="Davinci-esque Dodecahedron on White Paper">
                <img id="slide-3" src="./assets/octiral.jpg" alt="Octagonal Spirals on White Paper">
                <img id="slide-4" src="./assets/shadecahedron.jpg" alt="Shaded Dodecahedron Inception on White Paper">
                <img id="slide-5" src="./assets/spiragon.jpg" alt="Vibrant Pentagonal Spirals on White Paper">
                <img id="slide-6" src="./assets/spiraliphus.jpg" alt="Dragon of Spirals on White Paper">
                <img id="slide-7" src="./assets/vibraflower.jpg" alt="Vibrant Flower of Circles on White Paper">
            </div>
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
                <a href="#slide-4"></a>
                <a href="#slide-5"></a>
                <a href="#slide-6"></a>
                <a href="#slide-7"></a>
            </div>
        </div>
    </section>
</body>

</html>