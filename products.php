<?php
session_start();
include 'conn.php';
include 'functions.php';

// ADD TO BASKET CHECKER
if (isset($_POST['add_to_basket'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $_SESSION['basket'][$product_id] = $quantity;
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

    <title>Davao Fresh</title>
</head>

<body>
    <div class="main-content">
        <!-- NAVIGATION BAR -->
        <?php
        $active_tab = 'products';
        include 'usr_navbar.php';
        ?>

        <!-- MAIN CONTENT -->
        <div class="products-hero">
            <h1>Explore our products</h1>
            <p>Search through our catalog of fruits and vegetables <br>
                locally sourced from Davao farmers</p>
        </div>
        <!-- SEARCHBAR -->
        <div class="search-div">
            <form method="GET" action="product-search.php">
                <input class="search-bar" type="text" name="query" placeholder="Search products (e.g. Brussel Sprouts)">
            </form>
        </div>


        <div class="all-products">
            <!-- vegetables -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Vegetables</div>
                    <div class="desc"><?php countProducts($conn, 'VEGETABLES'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "VEGETABLES"); ?>
            </div>

            <!-- fruits -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Fruits</div>
                    <div class="desc"><?php countProducts($conn, 'FRUITS'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "FRUITS"); ?>
            </div>

            <!-- grains -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Grains</div>
                    <div class="desc"><?php countProducts($conn, 'GRAINS'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "GRAINS"); ?>
            </div>

            <!-- herbs -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Herbs and Spices</div>
                    <div class="desc"><?php countProducts($conn, 'HERBS AND SPICES'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "HERBS AND SPICES"); ?>
            </div>
        </div>
    </div>
    <div style="margin-top: 150px;"></div>

</body>

<script>
    // sa home dropdown ni
    const selectElement = document.querySelector('#home-dropdown');
    selectElement.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        if (selectedValue === 'logout') {
            window.location.href = 'logout.php';
        } else if (selectedValue === 'basket') {
            window.location.href = 'basket.php';
        }
    });
</script>

</html>