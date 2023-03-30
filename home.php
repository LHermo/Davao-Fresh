<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="assets/icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">

    <title>Davao Fresh</title>
</head>

<body>
    <div class="main-content">
        <!-- NAVIGATION BAR -->
        <nav class="nav">
            <img class="logo" src="assets/LOGO - Davao Fresh.svg"></img>
            <ul style="display: inline-block;">
                <li class="active"><a href="home.php"> Home </a></li>
                <li><a href="products.html"> Products </a></li>
                <li><a href="about.php"> About Us</a></li>
            </ul>
            <ul>
                <li><a href="basket.php"><img class="icon" src="assets/shopping-basket.svg" alt="Shopping Basket"></a>
                </li>
                <li><a href="login.php"><img class="icon" src="assets/user.svg" alt="Login"></a></li>
            </ul>
        </nav>

        <!-- THE CONTENT -->
        <div class="hero">
            <div class="panel left">
                <div class="title">
                    <h1>Make a fresh</h1>
                    <h1>food delivery</h1>
                </div>
                <div class="home-paragraph">
                    <p>Online shopping from a great selection at Davao Fresh Store. Pick
                        your basket now and start
                        shopping!</p>
                </div>
                <div>
                    <button class="button-main spaced colored"> Start Shopping</button>
                    <button class="button-main bordered"> Sign Up</button>
                </div>
            </div>
            <div class="panel right">
                <div style="position: relative; clear: right;">
                    <img class="wrapper mySlides w3-animate-right banana" src="assets/banana-only.png">
                    <img class="banana-bg" src="assets/ellipse.png">
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <footer class="footer navbar-fixed-bottom">
        <p>Developed by </p>
        <p><a href="https://www.facebook.com/libby.hermo" target="_blank">Libby Marowen D. Hermo</a></p>
        <p>and </p>
        <p><a href="https://www.facebook.com/cristine.albisocomajes.3" target="_blank">Ma. Cristine Joy
                Comajes</a></p>
    </footer>
</body>

<script>
    // Sa Navbar animations ni
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('nav');
        if (window.pageYOffset > 0) {
            navbar.classList.add('nav-shadow');
        } else {
            navbar.classList.remove('nav-shadow');
        }
    });

    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            document.querySelector("nav").style.padding = "1% 10%";
            document.querySelector("nav").style.height = "50px";
            document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
        } else {
            document.querySelector("nav").style.padding = "2% 10%";
            document.querySelector("nav").style.height = "60px";
            document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
        }
    }

    // Sa Banana Animations ni 
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

</html>