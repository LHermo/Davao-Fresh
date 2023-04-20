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


// function
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Required dependencies for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="">
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
            <div class="col py-3 bg-white m-4 p-5 rounded shadow-sm">

                <!-- Go back button -->
                <div class="p-2">
                    <button onclick="goBack()">Go Back</button>
                </div>

                <!-- Status Dropdown -->
                <div class="dropdown">
                    <select name="status" onchange="updateStatus(this.value, <?php echo $ordId; ?>)">
                        <option><?php getData($conn, $ordId, 'ord_status') ?></option>
                        <option value="Delivered">Delivered</option>
                        <option value="Pending">Pending</option>
                        <option value="On Process">On Process</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Content -->
                <div style="display: flex;">
                    <div class="my-table table-hover" id="orders-table" style="width: 60%;">
                        <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <tbody>
                                <?php
                                while ($row = $stmt->fetch()) : ?>
                                    <tr>
                                        <td> <!-- ID -->
                                            <p class="fw-bold mb-1 pl-0"> <?php echo $row['prd_id']; ?> </p>
                                        </td>
                                        <td> <!-- Name -->
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo $row['prd_img']; ?>" style="width: 55px; height: 45px; margin-right: 20px" />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['prd_name']; ?></p>
                                                    <p class="text-muted mb-0 small"><?php echo $row['prd_cat']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td> <!-- Quantity -->
                                            <p class="fw-bold mb-1"> <?php echo $row['orditem_qty']; ?></p>
                                        </td>
                                        <td> <!-- Price -->
                                            <p class="fw-bold mb-1">₱ <?php echo $row['prd_price']; ?>.00</p>
                                            <p class="text-muted mb-0 small"><?php echo $row['prd_unit'] ?></p>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div width=40% style="border: 2px solid lightgray; margin-left: 20px; padding: 10px;">
                        <p>Davao Fresh</p>
                        <p> Order date: <?php getData($conn, $ordId, 'ord_dt'); ?></p>
                        <hr>
                        <p> Delivery fee: ₱50.00</p>
                        <p> Sub Total: ₱<?php getSubTotal($conn, $ordId); ?>.00</p>
                        <p> Total: ₱<?php getData($conn, $ordId, 'ord_totalprice'); ?>.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function goBack() {
        window.history.back();
    }

    function updateStatus(newStatus, ordId) {
        // Make an AJAX request to update the account status in the database
        $.ajax({
            url: "edit-order.php",
            method: "POST",
            data: {
                status: newStatus,
                id: ordId
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error updating account status: " + error);
            }
        });
    }
</script>