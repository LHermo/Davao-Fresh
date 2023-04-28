<?php
session_start();
include 'conn.php';
include 'functions.php';

// $cart = $_SESSION['cart'];
$email = $_SESSION['email'];
$acc_id = getDataBySession('acc_id', $conn, $email);
$order_status = "Pending";
$order_date = date("Y-m-d");
$total_price = 0;

if (isset($_POST['place_order'])) { //Kung na click na si button
    try {
        $cart = $_SESSION['cart'];

        // Sa OrderTbl
        $order_stmt = $conn->prepare("INSERT INTO OrderTbl (acc_id, ord_status, ord_totalprice, ord_dt) VALUES (?, ?, ?, ?)");
        $order_stmt->execute([$acc_id, $order_status, $total_price, $order_date]);
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
        $total_price += $row['prd_price'] * $quantity;
    }
?>
    <form method="POST" name="place_order" onclick="showSuccessMsg()">
        <button type="submit" name="place_order"> Place My Order </button>
    </form>
    <div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
        <p>Order Total: ₱<?php echo $total_price; ?>.00</p>
        <p>Order Date: <?php echo $order_date; ?></p>

        <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
            <?php
            foreach ($cart as $productId => $quantity) {
                $stmt = $conn->prepare("SELECT * FROM ProductTbl WHERE prd_id = ?");
                $stmt->execute([$productId]);
                $row = $stmt->fetch();
            ?>
                <tr>
                    <td style="width: 15%; padding-left: 50px;">
                        <p class="fw-bold mb-1"> <?php echo $row['prd_id']; ?> </p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $row['prd_img']; ?>" style="width: 55px; height: 45px; margin-right: 20px" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['prd_name']; ?></p>
                                <p class="text-muted mb-0 small"><?php echo $row['prd_cat']; ?></p>
                            </div>
                        </div>
                    </td>
                    <!-- Price + Unit of Measurement  -->
                    <td>
                        <p class="quantity">Quantity: <?php echo $quantity ?></p>
                        <p class="price">Price: ₱ <?php echo $row['prd_price'] * $quantity ?>.00</p>
                        <!-- <p class="fw-bold mb-1" style="font-weight: 500;">₱ <?php echo $row['prd_price']; ?>.00</p>
                <p class="text-muted mb-0 small"><?php echo $row['prd_unit']; ?></p> -->
                    </td>
                    <!-- Actions  -->
                    <td>
                        <form method="POST">
                            <button type="submit" name="delete_product" value="<?php echo $productId; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
                if (isset($_POST['delete_product'])) {
                    $productIdToDelete = $_POST['delete_product'];
                    unset($_SESSION['cart'][$productIdToDelete]);
                }
            } ?>
        </table>
    </div> <?php
        } else {
            echo "<p>Your basket is empty</p>";
        }
            ?>
<script>
    function showSuccessMsg() {
        alert("You have placed an order successfully!");
    }
</script>