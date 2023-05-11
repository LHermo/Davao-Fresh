<?php
include 'conn.php';
include 'functions.php';

$ordId = $_POST['id'];

$stmt = $conn->prepare("SELECT *
FROM ProductTbl  
JOIN OrderItemTbl ON ProductTbl.prd_id = OrderItemTbl.prd_id 
JOIN OrderTbl ON OrderItemTbl.ord_id = OrderTbl.ord_id 
JOIN accounttbl ON accounttbl.acc_id = ordertbl.acc_id
WHERE OrderTbl.ord_id = :id");

$stmt->execute(["id" => $ordId]);
$stmt->execute();

// function getData($conn, $ordId, $column)
// {
//     $query = $conn->prepare("SELECT $column
//         FROM ProductTbl 
//         JOIN OrderItemTbl ON ProductTbl.prd_id = OrderItemTbl.prd_id 
//         JOIN OrderTbl ON OrderItemTbl.ord_id = OrderTbl.ord_id 
//         JOIN accounttbl ON accounttbl.acc_id = ordertbl.acc_id
//         WHERE OrderTbl.ord_id = :id");

//     $query->execute(["id" => $ordId]);
//     $query->execute();
//     $data = $query->fetchColumn();
//     echo $data;
// }
function getSubTotal($conn, $ordId)
{
    $query = $conn->prepare("SELECT SUM(prd_price * orditem_qty)
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
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Required dependencies for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="icon" href="assets/icon-green.svg">
    <link rel="stylesheet" href="newstyle.css">
    <title>Orders</title>
</head>

<body class="bg-light min-height-100">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Side bar code starts here -->
            <?php
            $active_tab = 'orders';
            include 'adm_navbar.php';
            ?>
            <!-- Content na ni diri -->
            <div class="col-6 p-4 my-5 ml-5 mr-2 bg-white rounded">

                <h3>Order #<?php getData($conn, $ordId, 'OrderTbl.ord_id') ?> <button type="button" class="btn btn-outline-secondary" onclick="location.href='adm_orders.php'" style="float: right;">Back to Orders</button>
                </h3>
                <hr>
                <!-- Order table -->
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch()) : ?>
                            <tr>
                                <td><?php echo $row['orditem_qty']; ?></td>
                                <td>
                                    <p class="mb-1">₱ <?php echo $row['prd_price']; ?>.00</p>
                                    <p class="text-muted mb-0 small"><?php echo $row['prd_unit']; ?></p>
                                </td>
                                <th scope="row">
                                    ₱ <?php echo ($row['orditem_qty'] * $row['prd_price']); ?>.00
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $row['prd_img']; ?>" style="width: 55px; height: 45px; margin-right: 20px" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?php echo $row['prd_name']; ?></p>
                                            <p class="text-muted mb-0 small"><?php echo $row['prd_cat']; ?></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-3 my-5 ml-2 mr-5">
                <div class="row p-4 bg-white rounded mb-3">
                    <h6>Order #<?php getData($conn, $ordId, 'OrderTbl.ord_id'); ?></h6>
                    <hr class="mb-5">
                    <small class="text-muted">Placed on <?php getData($conn, $ordId, 'OrderTbl.ord_dt'); ?></small>
                    <dd class="col-sm-5">
                        <p>Delivery fee:</p>
                        <p>Subtotal</p>
                        <p>Order Total</p>
                    </dd>
                    <dd class="col-sm-7">
                        <p>₱ 50.00</p>
                        <p>₱ <?php getSubtotal($conn, $ordId); ?>.00</p>
                        <p>₱ <?php getData($conn, $ordId, 'ord_totalprice'); ?>.00</p>
                    </dd>
                    <select class="form-control" name="status" onchange="updateStatus(this.value, <?php echo $ordId; ?>)">
                        <option disabled selected><?php getData($conn, $ordId, 'ord_status'); ?></option>
                        <option value="Pending">Pending</option>
                        <option value="On Process">On Process</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
                <div class="row p-4 bg-white rounded">
                    <h2 class="mb-4">Customer Details:</h2>
                    <dd class="col-sm-3">
                        <p><i class="material-icons text-black m-0">badge</i></p>
                        <p><i class="material-icons text-black">pending</i></p>
                        <p><i class="material-icons text-black">call</i></p>
                        <p><i class="material-icons text-black">alternate_email</i></p>
                        <p><i class="material-icons text-black">home</i></p>
                        <p><i class="material-icons text-black">subtitles</i></p>
                    </dd>
                    <dd class="col-sm-9">
                        <p>Name: <?php getData($conn, $ordId, 'acc_name'); ?></p>
                        <p>Status: <?php getData($conn, $ordId, 'acc_status'); ?></p>
                        <p>Phone: <?php getData($conn, $ordId, 'acc_phone'); ?></p>
                        <p>Email: <?php getData($conn, $ordId, 'acc_email'); ?></p>
                        <p>Address: <?php getData($conn, $ordId, 'acc_addr'); ?></p>
                        <p>Zip: <?php getData($conn, $ordId, 'acc_zip'); ?></p>
                    </dd>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function updateStatus(newStatus, ordId) {
        $.ajax({
            url: "edit-order.php",
            method: "POST",
            data: {
                status: newStatus,
                id: ordId
            },
            success: function(response) {
                alert("Order status updated successfully!")
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error updating account status: " + error);
            }
        });
    }
</script>