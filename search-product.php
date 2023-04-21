<!-- <?php
include 'conn.php';
include 'functions.php';

if (isset($_GET['q'])) {
    $query = $_GET['q'];

    var_dump($query);

    $stmt = $conn->prepare("SELECT *
    FROM ProductsTbl
    WHERE prd_name LIKE '%$query%'
    OR prd_cat LIKE '%$query%'
    OR prd_price LIKE '%$query%'
    OR prd_unit LIKE '%$query%'");

    $stmt->execute();

    $counter = 0;
    while ($row = $stmt->fetch()) :
        if ($counter % 5 == 0) {
            if ($counter > 0) {
                echo '</div>';
            }
            echo '<div class="cards-row">';
        }
?>
        <div class="product-card" style="margin-top: 18px;  ">
            <div class="product-card-content">
                <div class="price">
                    <?php echo "sample lang"; ?>
                    <span class="cost">₱ <?php echo $row['prd_price'] ?>.00<span>
                            <span class="description">/ <?php echo $row['prd_unit'] ?></span>
                </div>
                <div class="product-image"><img src=<?php echo $row['prd_img'] ?>></div>
                <div class="product-details">
                    <p class="category"><?php echo $row['prd_cat'] ?></p>
                    <p class="name"><?php echo $row['prd_name'] ?></p>
                </div>
                <div class="quantity-selector">
                    <button class="minus-btn">-</button>
                    <input class="quantity-input" type="text" min="0" value="0">
                    <button class="plus-btn">+</button>
                </div>
                <button class="button-products">Add to basket</button>
            </div>
        </div>
<?php
        $counter++;
    endwhile;

    echo '</div>';
} else {
    echo 'walay';
} -->
