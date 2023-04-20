<?php
include 'conn.php';
include 'functions.php';

// sa pagination ni na code
$results_per_page = 6;
// Retrieve total number of results from the database
$sql = "SELECT COUNT(*) AS count FROM OrderTbl";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_results = $row['count'];

// Count pila ka pages tanan
$total_pages = ceil($total_results / $results_per_page);

// Check if current page number is set, else set it to 1
if (!isset($_GET['page'])) {
    $current_page = 1;
} else {
    $current_page = $_GET['page'];
}
// Calculate the starting and ending positions of the results on the current page
$start = ($current_page - 1) * $results_per_page;
$end = $start + $results_per_page;

$query = "SELECT OrderTbl.*, AccountTbl.acc_name
    FROM OrderTbl
    INNER JOIN AccountTbl 
    ON OrderTbl.acc_id = AccountTbl.acc_id 
    WHERE OrderTbl.ord_id LIKE '%$searchTerm%'
    OR AccountTbl.acc_id LIKE '%$searchTerm%'
    OR AccountTbl.acc_name LIKE '%$searchTerm%'
    OR OrderTbl.ord_status LIKE '%$searchTerm%'
    OR OrderTbl.ord_totalprice LIKE '%$searchTerm%'
    OR OrderTbl.ord_dt LIKE '%$searchTerm%'
    LIMIT $start, $results_per_page";

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

                <!-- Table Title + Description -->
                <div class="p-2">
                    <h4 class="fw-bold">Orders</h4>
                    <p class="small text-muted">
                        Find and search orders and their details on the table below.
                        Thanks for your hard work!</p>
                </div>

                <!-- Table Container -->
                <div style="border: 1.5px solid #DFE2E5; border-radius: 10px;">

                    <div class="container bg-light" style="border-bottom: 1.5px solid #DFE2E5;">
                        <!-- Search bar -->
                        <form method="post">
                            <div class="row align-items-center p-3">
                                <div class="input-group mx-3 my-2">
                                    <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Search orders here (e.g. Karen Smith)">
                                    <div class="input-group-append">
                                        <button type="submit" name="search" value="Search" class="btn btn-primary bg-success" style="border: none;"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Content -->
                    <?php searchOrders(
                        $conn,
                        'getOrderTable',
                        $query
                    );

                    function getOrderTable($conn, $query)
                    {
                        $stmt = $conn->query($query);
                        if ($stmt->rowCount() > 0) { ?>
                            <!-- Orders Table -->
                            <div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
                                <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                                    <thead class="bg-white">
                                        <tr>
                                            <th style="padding-left: 10px;">ID</th>
                                            <th>Status</th>
                                            <th>Client</th>
                                            <th>Total Payment</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $stmt->fetch()) : ?>
                                            <tr>
                                                <td> <!-- ID -->
                                                    <p class="fw-bold mb-1 pl-0"> <?php echo $row['ord_id']; ?> </p>
                                                </td>
                                                <td> <!-- Status -->
                                                    <?php
                                                    if ($row['ord_status'] == 'Delivered') {
                                                        echo '<span class="badge badge-success rounded-pill d-inline">' . $row['ord_status'] . '</span>';
                                                    } else if ($row['ord_status'] == 'On Process') {
                                                        echo '<span class="badge badge-primary rounded-pill d-inline">' . $row['ord_status'] . '</span>';
                                                    } else if ($row['ord_status'] == 'Pending') {
                                                        echo '<span class="badge badge-secondary rounded-pill d-inline">' . $row['ord_status'] . '</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger rounded-pill d-inline">' . $row['ord_status'] . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td> <!-- Client Name + ID -->
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['acc_name']; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <!-- Total Payment -->
                                                    <p class="fw-bold mb-1">₱ <?php echo $row['ord_totalprice']; ?>.00</p>
                                                </td>
                                                <td> <!-- Date -->
                                                    <p class="fw-bold mb-1"> <?php echo $row['ord_dt']; ?></p>
                                                </td>
                                                <td> <!-- Actions -->
                                                    <div class="dropdown">
                                                        <select name="status" onchange="updateStatus(this.value, <?php echo $row['ord_id']; ?>)">
                                                            <option><?php echo $row['ord_status'] ?></option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="On Process">On Process</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </td>

                                                <td> <!-- Actions -->
                                                    <form action="adm_order_details.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $row['ord_id']; ?>">
                                                        <button type="submit" name="view" class="btn btn-sm btn-outline-success px-4">View</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php endwhile;
                                    } else { ?>
                                        <tr>
                                            <div class="p-3 text-center">
                                                <td class="mx-auto">No results found.</td>
                                            </div>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
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

    function viewDetails(ordId) {
        $.ajax({
            url: "adm_order_details.php",
            method: "GET",
            data: {
                id: ordId
            },
            success: function(response) {
                window.location.href = "adm_order_details.php?ord_id=" + ordId;
            },
            error: function(xhr, status, error) {
                alert("Error getting order details: " + error);
            }
        });
    }
</script>