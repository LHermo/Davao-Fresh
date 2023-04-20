<?php
include 'conn.php';

$searchTerm = '';
if (isset($_POST['search'])) { // Check if the search form has been submitted
    $searchTerm = $_POST['searchTerm']; // Set the $searchTerm variable to the submitted value
}

function searchOrders($conn, $tableFunction, $query)
{
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT OrderTbl.*, AccountTbl.acc_name 
                                 FROM OrderTbl 
                                 JOIN AccountTbl 
                                 ON OrderTbl.acc_id = AccountTbl.acc_id");
    }
}

function getCustomerTable($conn, $tableFunction, $query)
{
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT * FROM AccountTbl WHERE acc_role = 'customer'");
    }
}

function displayProducts($conn, $tableFunction, $firstquery, $query)
{
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, $firstquery);
    }
}

function displayTable($conn, $tableFunction, $tableName, $query)
{
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT * FROM $tableName");
    }
}

function getCatalog($conn, $category)
{
    $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_cat = '$category'");
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

    // close the final row div
    echo '</div>';
}
