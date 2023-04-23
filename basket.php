<?php
// session_start();
// include 'conn.php';

// if (!empty($_SESSION['basket'])) {
//     foreach ($_SESSION['basket'] as $product_id => $quantity) {
//         // Retrieve the product information from the database using $product_id
//         // Display the product information along with the quantity
//         $query = $conn->prepare("SELECT prd_name FROM ProductTbl WHERE prd_id = '$product_id'");
//         $query->execute();
//         $name = $query->fetchColumn();

//         echo "<p>Product: $product_id, $name - $quantity pcs</p>";
//     }
// } else {
//     echo "<p>Your basket is empty.</p>";
// }

session_start();
include 'conn.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
} else {
}

$cart = $_SESSION['cart'];
?>
<button> Place My Order </button>
<div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
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
                    <p>delete</p>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>