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
        <!-- <div class="container" style="margin-top: 120px;"> -->
        <div class="container-fluid mx-0" style="margin-top: 120px;">
            <div class="row">
                <div class="col-md-6" style="width: 65%;">
                    <div class="container p-4">
                        <!-- content for first container -->
                        <div class="row pb-4">
                            <div class="col-md-12 fs-5 fw-bold">Shopping Basket</div>
                        </div>
                        <hr>
                        <!-- Repeat stuff repeat stuff repeat stuff -->
                        <div class="row my-2">
                            <table>
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/products/artichokes.png" style="width: 55px; height: 45px; margin-right: 20px" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1" style="font-weight: 500;">Artichokes</p>
                                                <p class="text-muted mb-0 small">VEGETABLES</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td> <!-- Price + Unit of Measurement  -->
                                        <p class="fw-bold mb-1" style="font-weight: 500;">₱ 1000.00</p>
                                        <p class="text-muted mb-0 small">per kilo</p>
                                    </td>
                                    <td> <!-- Quantity Selector -->
                                        <div class="quantity-selector">
                                            <button class="plus-btn" onclick="decrement(<?php echo $row['prd_id'] ?>)">-</button>
                                            <input class="quantity-input" type="number" id="quantity-input-<?php echo $row['prd_id'] ?>" min="0" value="0">
                                            <button class="minus-btn" onclick="increment(<?php echo $row['prd_id'] ?>)">+</button>
                                        </div>
                                    </td>
                                    <td> <!-- Actions  -->
                                        <form method="POST" action="remove-product.php">
                                            <input type="hidden" name="id" value="<?php echo $row['prd_id']; ?>">
                                            <!-- <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-confirm="Are you sure you want to delete this product?">Delete</button> -->
                                            <a href="https://example.com/delete" onclick="deleteItem()">
                                                <i class="material-icons" style="color: #E75644">delete_forever</i>
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <!-- End ni repeat stuff repeat stuff repeat stuff -->
                    </div>
                </div>
                <div class="col-md-6" style="width: 35%;">
                    <div class="container bg-light p-5 mx-0">
                        <div class=" row">
                            <!-- content for second container -->
                            <div class="row fw-bold mb-4">
                                <div class="col-md-12">Order Summary</div>
                            </div>
                            <hr class="m-0">
                            <div class="row py-3">
                                <div class="row">
                                    <div class="col-md-6 m-0">Item name</div>
                                    <div class="col-md-6 m-0">₱000.00</div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row py-3">
                                <div class="col-md-6 fw-bold">Subtotal</div>
                                <div class="col-md-6">₱130.00</div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-6 fw-bold">Delivery</div>
                                <div class="col-md-6">₱50.00</div>
                            </div>
                            <hr class="m-0">
                            <div class="row mt-4">
                                <div class="col-md-6 fw-bold">Total</div>
                                <div class="col-md-6 fw-bold">₱1000.00</div>
                            </div>
                            <div class="row pt-5">
                                <div class="col-md-12">
                                    <button class="button-main bordered" style="padding: 10px; width: 100%;">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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