<?php
session_start();
require_once('conn.php');

function getDataBySession($column, $conn, $sessionVar)
{
    $sessionVar = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT $column FROM AccountTbl WHERE acc_email=:email");
    $stmt->bindParam(':email', $sessionVar);
    $stmt->execute();
    $data = $stmt->fetchColumn();
    echo $data;
}
// pagkuha sa iD ni user ra ni
?>
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
        $active_tab = 'home';
        include 'usr_navbar.php';
        ?>

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
                    <button class="button-main spaced colored" onclick="location.href='products.php'"> Start Shopping</button>
                    <button class="button-main bordered" onclick="location.href='signUp.php'">Sign Up</button>
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
    </footer>
</body>

<script>
    // sa home dropdown ni
    // const selectElement = document.querySelector('#home-dropdown');
    // selectElement.addEventListener('change', (event) => {
    //     const selectedValue = event.target.value;
    //     if (selectedValue === 'logout') {
    //         window.location.href = 'logout.php';
    //     } else if (selectedValue === 'basket') {
    //         window.location.href = 'basket.php';
    //     }
    // });

    // Sa Navbar animations ni
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
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
    }
    // Get the dropdown button and content
    var dropdownBtn = document.querySelector(".dropdown-btn");
    var dropdownContent = document.querySelector(".dropdown-content");

    // Toggle the dropdown content when the button is clicked
    dropdownBtn.addEventListener("click", function() {
        dropdownContent.classList.toggle("show");
    });

    // Close the dropdown content when the user clicks outside of it
    window.addEventListener("click", function(event) {
        if (!event.target.matches(".dropdown-btn")) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var dropdown = dropdowns[i];
                if (dropdown.classList.contains("show")) {
                    dropdown.classList.remove("show");
                }
            }
        }
    });
</script>

</html>

<?php
$pdo = null;
?>