<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include 'conn.php';

$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
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
function countProducts($conn, $category)
{
    $stmt = $conn->prepare("SELECT COUNT(prd_cat) FROM ProductTbl WHERE prd_cat = '$category'");
    $stmt->execute();
    $data = $stmt->fetchColumn();
    echo $data;
}
function getDataBySession($column, $conn, $sessionVar)
{
    $sessionVar = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT $column FROM AccountTbl WHERE acc_email=:email");
    $stmt->bindParam(':email', $sessionVar);
    $stmt->execute();
    $data = $stmt->fetchColumn();
    return $data;
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
                <!-- This with the placeholder thang -->
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
function getData($conn, $ordId, $column)
{
    $query = $conn->prepare("SELECT $column
        FROM ProductTbl 
        JOIN OrderItemTbl ON ProductTbl.prd_id = OrderItemTbl.prd_id 
        JOIN OrderTbl ON OrderItemTbl.ord_id = OrderTbl.ord_id 
        JOIN accounttbl ON accounttbl.acc_id = ordertbl.acc_id
        WHERE OrderTbl.ord_id = :id");

    $query->execute(["id" => $ordId]);
    $query->execute();
    $data = $query->fetchColumn();
    echo $data;
}
?>
<script>
    function addToCart(productId) {
        var quantity = document.getElementById("quantity-input-" + productId).value;

        // Check if the user is logged in
        var isLoggedIn = <?php echo isset($_SESSION['email']) && $_SESSION['email'] ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            alert("Please log in to add products to your cart.");
            return;
        }

        // Check if 0 ang quantity
        if (quantity == 0) {
            alert("Please specify the product quantity.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Product successfully added!");
            }
        };
        xhr.send("productId=" + productId + "&quantity=" + quantity);
    }


    function increment(index) {
        var inputField = document.getElementById("quantity-input-" + index);
        var value = parseInt(inputField.value);
        inputField.value = value + 1;
    }

    function decrement(index) {
        var inputField = document.getElementById("quantity-input-" + index);
        var value = parseInt(inputField.value);
        if (inputField.value != 0) {
            inputField.value = value - 1;
        }
    }
</script>