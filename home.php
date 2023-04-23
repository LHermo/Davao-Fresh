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
</script>

</html>

<?php
$pdo = null;
?>