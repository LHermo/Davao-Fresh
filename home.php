<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="home.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">

    <title>Davao Fresh</title>
</head>

<body>
    <div class="hero">
        <!-- NAVBAR -->
        <nav>
            <img class="logo" src="assets/LOGO - Davao Fresh.svg"></img>
            <ul>
                <li><a href="home.php" style="font-weight: 400;"> Home </a></li>
                <li><a href="fruits.php"> Fruits </a></li>
                <li><a href="#"> Shopping Basket </a></li>
                <li><a href="search.php"> Search </a></li>
                <li><a href="about.php"> About </a></li>
            </ul>
            <ul>
                <li><a href="#" style="font-weight: 700;"> Login</a></li>
            </ul>
            <!-- <button type="button">Login / Sign Up</button> -->
            <!-- <ul>
                <li style="padding: 5px;"><a href="#"><img src="assets/basket-icon.svg"></a></li>
                <li><a href="#"><img src="assets/person-icon.svg"></a></li>
            </ul> -->
        </nav>
        <div class="main-content">
            <div class="flex-child-element" style="padding-left: 10%; justify-content: center;">
                <div style="padding-top: 120px;">
                    <h1> Make a fresh</h1>
                    <h1> food delivery</h1>
                </div>
                <div style="padding-top: 50px; padding-bottom: 40px; line-height: auto;">
                    <p style="font-size: 1.1rem">Online shopping from a great selection at Davao Fresh Store. Pick your
                        basket now and start
                        shopping!</p>
                </div>
                <div>
                    <span>
                        <button class="colored-button" style="margin-right: 18px;">Start Shopping</button>
                        <!-- Tarungon ni, informal ning margin-right-->
                        <button class="bordered-button"> Sign Up </button>
                    </span>
                </div>
            </div>

            <!-- RIGHT PANEL NA THIS -->
            <div class=" flex-child-element" style="clear: right;">
                <img class="wrapper mySlides w3-animate-right" src="assets/banana-only.png" style="z-index: 1;">
                <img src="assets/ellipse.png" style="position: absolute; top: 1; right: 0;">
            </div>
        </div>

        <!-- FOOTER -->
        <div class=" footer">
            <p> Developed by Libby Marowen Hermo and Ma. Cristine Joy Comajes</p>
        </div>
    </div>
    </div>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) { myIndex = 1 }
            x[myIndex - 1].style.display = "block";
        }
    </script>
</body>

</html>