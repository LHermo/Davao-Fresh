<?php
session_start();
include 'conn.php';
include 'functions.php';

$acc_id;
$order_status = "Pending";
$order_date = date("Y-m-d");
$subtotal = 0;
$email;
$total = 0;

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $acc_id = getDataBySession('acc_id', $conn, $email);
}
// remove product form cart button
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header("Location: basket.php");
    exit();
}

function resetCart()
{
    $_SESSION['cart'] = array();
}
// adding sa cart
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    foreach ($cart as $productId => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_id = ?");
        $stmt->execute([$productId]);
        $row = $stmt->fetch();
        $subtotal += $row['prd_price'] * $quantity;
    }
    $total = $subtotal + 50;

    // placing sa order
    if (isset($_POST['place_order'])) { //Kung na click na si button
        try {
            $cart = $_SESSION['cart'];
            // Sa OrderTbl
            $order_stmt = $conn->prepare("INSERT INTO OrderTbl (acc_id, ord_status, ord_totalprice, ord_dt) VALUES (?, ?, ?, ?)");
            $order_stmt->execute([$acc_id, $order_status, $total, $order_date]);
            $order_id = $conn->lastInsertId();

            // Sa OrderItemTbl
            $orditem_stmt = $conn->prepare("INSERT INTO OrderItemTbl (ord_id, prd_id, orditem_qty) VALUES (?, ?, ?)");
            foreach ($cart as $productId => $quantity) {
                $orditem_stmt->execute([$order_id, $productId, $quantity]);
            }

            $_SESSION['cart'] = array(); //I empty na ang cart
            echo "<script> alert('You have placed an order successfully!')</script>";
            // header("Location: products.php");
            echo "<script> location.href='thankyou.php'</script>";
            exit();
        } catch (PDOException $e) {
            echo "Ang error kayyyy: " . $e->getMessage();
        }
    }
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <title>Davao Fresh</title>
    </head>
    <style>
        .material-symbols-outlined {
            color: #E75644;
        }

        .plus-btn,
        .minus-btn {
            background-color: lightgray;
        }

        .plus-btn:hover,
        .minus-btn:hover {
            background-color: #1b1b1b;
        }
    </style>

    <body>
        <div class="main-content" style="margin-inline: 8%;">
            <!-- NAVIGATION BAR -->
            <?php
            include 'usr_navbar.php';
            ?>

            <!-- CONTENT -->
            <div class="container-fluid mx-0" style="margin-top: 120px;">
                <div class="row">
                    <div class="col-md-6" style="width: 65%;">
                        <div class="container p-4">
                            <!-- Order Products diri -->
                            <div class="row pb-4">
                                <div class="col-md-4 fs-5 fw-bold">Shopping Basket</div>
                                <div class="col-md-8  d-flex justify-content-end ">
                                    <button class="btn rounded-pill btn-outline-danger ms-3" onclick="emptyCart()">Reset cart</button>
                                    <button class="btn rounded-pill btn-outline-dark ms-3" onclick="location.href='products.php'">← Add more to cart</button>
                                </div>
                            </div>
                            <hr style=" border: 1px solid lightgray">
                            <!-- Repeat stuff repeat stuff repeat stuff -->
                            <?php foreach ($cart as $productId => $quantity) {
                                $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_id = ?");
                                $stmt->execute([$productId]);
                                $row = $stmt->fetch();
                            ?>
                                <div class="row my-2">
                                    <table>
                                        <tr>
                                            <td class="ps-3" style="width: 65%;">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo $row['prd_img']; ?>" style="width: 55px; height: 45px; margin-right: 20px" />
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['prd_name']; ?>
                                                            <span class="text-muted mb-0 small fw-light">× <?php echo $quantity; ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%;"> <!-- Price + Unit of Measurement  -->
                                                <p class="mb-1">₱<?php echo $row['prd_price']; ?>
                                                    <span class="mb-0 text-muted small">/ <?php echo $row['prd_unit'] ?></span>
                                                </p>

                                            </td>
                                            <td>
                                                <div class="quantity-selector" style="margin: auto; padding-right: 30px;">
                                                    <button class="plus-btn" onclick="decrementBasket(<?php echo $row['prd_id'] ?>)">-</button>
                                                    <input class="quantity-input" type="number" id="quantity-input-<?php echo $row['prd_id'] ?>" min="0" value=<?php echo $quantity ?>>
                                                    <button class="minus-btn" onclick="incrementBasket(<?php echo $row['prd_id'] ?>)">+</button>
                                                </div>
                                            </td>
                                            <td style="width: 10%;"> <!-- Actions  -->
                                                <a href="basket.php?delete=<?php echo $productId; ?>">
                                                    <i class="material-icons" style="color: #E75644">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <hr style="border: 1px solid lightgray">
                            <?php } ?>
                            <!-- End ni repeat stuff repeat stuff repeat stuff -->
                        </div>
                    </div>
                    <div class="col-md-6" style="width: 35%;">
                        <div class="container bg-light p-5 mx-0">
                            <div class=" row">
                                <!-- Receipt diri -->
                                <div class="row fw-bold mb-4">
                                    <div class="col-md-12">Order Summary</div>
                                </div>
                                <hr class="m-0">
                                <div class="row py-3 px-0 m-0">
                                    <?php foreach ($cart as $productId => $quantity) {
                                        $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_id = ?");
                                        $stmt->execute([$productId]);
                                        $row = $stmt->fetch(); ?>
                                        <div class="row m-0">
                                            <div class="col-md-8 m-0 px-0"><?php echo $row['prd_name']; ?></div>
                                            <div class="col-md-4 m-0 px-0">₱<?php echo $row['prd_price']; ?>.00 × <?php echo $quantity ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr class="m-0">
                                <div class="row pt-3">
                                    <div class="col-md-8 fw-bold">Subtotal</div>
                                    <div class="col-md-4"> ₱<?php echo $subtotal; ?>.00</div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-md-8 fw-bold">Delivery</div>
                                    <div class="col-md-4">₱50.00</div>
                                </div>
                                <hr class="m-0">
                                <div class="row mt-4">
                                    <div class="col-md-8 fw-bold">Total</div>
                                    <div class="col-md-4 fw-bold">₱<?php echo $total ?>.00</div>
                                </div>
                                <form method="POST" name="place_order" onsubmit="return confirmOrder()">
                                    <div class="row pt-5">
                                        <div class="col-md-12">
                                            <button type="submit" name="place_order" class="button-main bordered" style="padding: 10px; width: 100%;">Place Order</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } else { ?>
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
                <img src="assets/empty-basket.png" style="width: 300px; height: auto;" alt="">
                <h1>Your basket is empty.</h1>
                <p>Browse through our catalog of products</p>
                <button class="button-main bordered mt-4" onclick="location.href='products.php'">Browse Products</button>
            </div>
        </div>

    </body>

    </html>
<?php } ?>
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

    document.getElementById("quantity-input-<?php echo $row['prd_id'] ?>").addEventListener("change", function(event) {
        var newQuantity = parseInt(event.target.value);
        updateQuantity(<?php echo $row['prd_id'] ?>, newQuantity);
    });

    function incrementBasket(productId) {
        var quantityInput = document.getElementById("quantity-input-" + productId);
        var newQuantity = parseInt(quantityInput.value) + 1;
        quantityInput.value = newQuantity;
        updateQuantity(productId, newQuantity);
    }

    function decrementBasket(productId) {
        var quantityInput = document.getElementById("quantity-input-" + productId);
        var newQuantity = parseInt(quantityInput.value) - 1;
        if (newQuantity < 0) {
            newQuantity = 0;
        }
        quantityInput.value = newQuantity;
        updateQuantity(productId, newQuantity);
    }

    function updateQuantity(productId, newQuantity) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Update the cart in the UI with the new quantity
            }
        };
        xhttp.open("POST", "update-cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("productId=" + productId + "&quantity=" + newQuantity);
        location.reload();
    }

    function emptyCart() {
        if (confirm('Are you sure you want to empty your basket?')) {
            location.href = 'empty-cart.php';
        }
    }

    function confirmOrder() {
        if (confirm("Are you sure you want to place this order?")) {
            return true; // proceed with form submission
        } else {
            return false; // cancel form submission
        }
    }
</script>