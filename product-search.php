<?php
include 'conn.php';
include 'functions.php';
session_start();

if (isset($_GET['query'])) {
    $query = $_GET['query'];
}

$stmt = $conn->prepare("SELECT *
    FROM ProductTbl
    WHERE prd_name LIKE '%$query%'
    OR prd_cat LIKE '%$query%'
    OR prd_price LIKE '%$query%'
    OR prd_unit LIKE '%$query%'");

$stmt->execute();

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

        <!-- Main Content -->
        <div class="products-hero">
            <div class="search-div" style="margin-bottom: 50px;">
                <form method="GET" action="product-search.php">
                    <input class="search-bar" type="text" name="query" placeholder="Search products (e.g. Romaine Lettuce)">
                </form>
            </div>
        </div>
        <div class="categ">
            <div class="cat-name">Search results:</div>
        </div>
        <div class="all-products">
            <?php
            if ($stmt->rowCount() == 0) {
                echo "<div style='margin-inline:8%;'> No products found. </div>";
            } else {
                // display search results
                $counter = 0;
                while ($row = $stmt->fetch()) :
                    if ($counter % 5 == 0) {
                        if ($counter > 0) {
                            echo '</div>';
                        }
                        echo '<div class="cards-row">';
                    }
            ?>
                    <div class="product-card" style="margin-top: 18px;">
                        <div class="product-card-content">
                            <div class="price">
                                <span class="cost">₱ <?php echo $row['prd_price'] ?>.00<span>
                                        <span class="description">/ <?php echo $row['prd_unit'] ?></span>
                            </div>
                            <div class="product-image"><img src=<?php echo $row['prd_img'] ?>></div>
                            <div class="product-details">
                                <p class="category"><?php echo $row['prd_cat'] ?></p>
                                <p class="name"><?php echo $row['prd_name'] ?></p>
                            </div>
                            <div class="quantity-selector">
                                <button class="plus-btn" onclick="decrement(<?php echo $row['prd_id'] ?>)">-</button>
                                <input class="quantity-input" type="number" id="quantity-input-<?php echo $row['prd_id'] ?>" min="0" value="0">
                                <button class="minus-btn" onclick="increment(<?php echo $row['prd_id'] ?>)">+</button>
                            </div>
                            <button class="button-products" type="button" name="add_to_basket" onclick="addToCart(<?php echo $row['prd_id'] ?>)">Add to Basket</button>
                        </div>
                    </div>
            <?php
                    $counter++;
                endwhile;

                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div style="margin-top: 150px;"></div>
</body>

</html>