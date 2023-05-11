<?php
session_start();

// Empty the cart
unset($_SESSION['cart']);

// Redirect to the shopping cart page
header('Location: basket.php');
exit();
