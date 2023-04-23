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
        <?php
        $active_tab = 'about';
        include 'usr_navbar.php';
        ?>

        <!-- MAIN CONTENT -->
        <div class="products-hero" style="margin-inline: 10%;">
            <h1>What is Davao Fresh?</h1>
            <div style="height: 70px;"></div>
            <div>
                <img src="assets/farmer.jpg" style="float: left; height: 400px; width: auto; margin-right: 30px; box-shadow: 5px 5px 10px lightgray;" alt="">

            </div>
            <div>
                <p style="text-align: justify; text-justify: inter-word; word-break: break-all;">
                    DavaoFresh is an ecommerce website that was started in 2023.
                    We offer a wide variety of fruits and vegetables, all of which are sourced from local farmers in Davao City.
                    Delivering healthy foods straight to your doors. Incurring security, efficiency
                    and easy online shopping experience to all customers nationwide.
                </p>
                <p style="text-align: justify; text-justify: inter-word; overflow-wrap: break-word;">
                    DavaoFresh offers customer service and FREE SHIPPING for
                    first time customers REGION-WIDE. We uphold the goal of providing fresh and healthy produce to our customers. We believe that by
                    eating healthy, we can live healthier lives. That's why we only sell the freshest and most delicious fruits and vegetables
                    available. Thank you for considering Davao Fresh as your go-to source for fresh produce!
                </p>
            </div>

            <button class="button-main bordered" style="margin-top: 50px;" onclick="location.href=''">Contact Us</button>
        </div>
    </div>
</body>

</html>
<script>
    // navbar animations
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('nav');
        if (window.pageYOffset > 0) {
            navbar.classList.add('nav-shadow');
        } else {
            navbar.classList.remove('nav-shadow');
        }
    });

    window.onscroll = function() {
        scrollFunction()
    };

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
</script>