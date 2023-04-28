<?php
session_start();
include 'conn.php';
include 'functions.php';

$email = $_SESSION['email'];
$acc_id = getDataBySession('acc_id', $conn, $email);
$order_status = "Pending";
$order_date = date("Y-m-d");
$subtotal = 0;

if (isset($_POST['place_order'])) { //Kung na click na si button
    try {
        $cart = $_SESSION['cart'];

        // Sa OrderTbl
        $total = $subtotal + 50;
        $order_stmt = $conn->prepare("INSERT INTO OrderTbl (acc_id, ord_status, ord_totalprice, ord_dt) VALUES (?, ?, ?, ?)");
        $order_stmt->execute([$acc_id, $order_status, $total, $order_date]);
        $order_id = $conn->lastInsertId();

        // Sa OrderItemTbl
        $orditem_stmt = $conn->prepare("INSERT INTO OrderItemTbl (ord_id, prd_id, orditem_qty) VALUES (?, ?, ?)");
        foreach ($cart as $productId => $quantity) {
            $orditem_stmt->execute([$order_id, $productId, $quantity]);
        }

        $_SESSION['cart'] = array(); //I empty na ang cart
        header("Location: products.php");
        exit();
    } catch (PDOException $e) {
        echo "Ang error kayyyy: " . $e->getMessage();
    }
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $productId => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_id = ?");
        $stmt->execute([$productId]);
        $row = $stmt->fetch();
        $subtotal += $row['prd_price'] * $quantity;
    } ?>
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
                                <div class="col-md-12 fs-5 fw-bold">Shopping Basket</div>
                            </div>
                            <hr>
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
                                                        <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['prd_name']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%;"> <!-- Price + Unit of Measurement  -->
                                                <p class="fw-bold mb-1" style="font-weight: 500;">₱<?php echo $row['prd_price']; ?>
                                                    <span class=" mb-0 fw-normal">/ <?php echo $row['prd_unit'] ?></span>
                                                </p>
                                                <p class="text-muted mb-0 small">Qty: <?php echo $quantity; ?> <?php
                                                                                                                if ($row['prd_unit'] == "per piece") {
                                                                                                                    if ($quantity > 1) {
                                                                                                                        echo 'pcs';
                                                                                                                    } else {
                                                                                                                        echo 'pc';
                                                                                                                    }
                                                                                                                } else if ($row['prd_unit'] == "per kilo") {
                                                                                                                    if ($quantity > 1) {
                                                                                                                        echo 'kgs';
                                                                                                                    } else {
                                                                                                                        echo 'kg';
                                                                                                                    }
                                                                                                                } else if ($row['prd_unit'] == "per gram") {
                                                                                                                    if ($quantity > 1) {
                                                                                                                        echo 'grams';
                                                                                                                    } else {
                                                                                                                        echo 'gram';
                                                                                                                    }
                                                                                                                } ?></p>
                                            </td>

                                            <td style="width: 10%;"> <!-- Actions  -->
                                                <form method="POST" action="remove-product.php">
                                                    <input type="hidden" name="id" value="<?php echo $row['prd_id']; ?>">
                                                    <a href="https://example.com/delete" onclick="deleteItem()">
                                                        <i class="material-icons" style="color: #E75644">delete_forever</i>
                                                    </a>

                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
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
                                    <div class="col-md-6 fw-bold">Subtotal</div>
                                    <div class="col-md-6"> ₱<?php echo $subtotal; ?>.00</div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-md-6 fw-bold">Delivery</div>
                                    <div class="col-md-6">₱50.00</div>
                                </div>
                                <hr class="m-0">
                                <div class="row mt-4">
                                    <div class="col-md-6 fw-bold">Total</div>
                                    <div class="col-md-6 fw-bold">₱<?php echo $total ?>.00</div>
                                </div>
                                <form method="POST" name="place_order" onclick="showSuccessMsg()">
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
<?php } else {
    echo "<p>Your basket is empty</p>";
} ?>
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

    function showSuccessMsg() {
        alert("You have placed an order successfully!");
    }
</script>