<?php
session_start();
include 'conn.php';
include 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body class="m-0">
    <!-- NAVIGATION BAR -->
    <?php
    include 'usr_navbar.php';
    ?>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="text-center">
            <img src="assets/thank-you.png" style="width: 450px; height: auto;" alt="">
            <h1>Thanks for placing an order!</h1>
            <p>We appreciate your business and will process your order as soon as possible.</p>
            <button class="button-main bordered mt-4" onclick="location.href='home.php'">Back to Home</button>
        </div>
    </div>

</body>

</html>