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
    <link rel="stylesheet" href="">
    <link rel="icon" href="assets/icon-green.svg">
    <link rel="stylesheet" href="newstyle.css">
    <title>Orders</title>
</head>


<body class="bg-light min-height-100">
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- Side bar code starts here -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background: #214D34; min-height: 870px;">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

                    <!-- Si Logo -->
                    <a href="adm_products.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline" style="margin: 20px 0px;"><img style="width: 180px;" src="assets/LOGO - Davao Fresh Dark.svg" alt=""></span>
                    </a>
                    <!-- Si Menu tabs -->
                    <ul style="margin-top: 30px; width: 100%;" class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item w-100 change-when-hovered">
                            <a href="adm_products.php" class="nav-link d-flex align-items-center px-2 text-white">
                                <i class="material-icons text-white">inventory</i><span class="ms-1 d-none d-sm-inline" style="padding-left: 10px;">Products</span>
                            </a>
                        </li>
                        <li class="w-100 change-when-hovered">
                            <a href="adm_customers.php" class="nav-link px-2 d-flex align-items-center">
                                <i class="material-icons text-white">diversity_3</i><span class="ms-1 d-none d-sm-inline text-white " style="padding-left: 10px;">Customers</span></a>
                        </li>
                        <li class="w-100 change-when-hovered">
                            <a href="adm_orders.php" class="active nav-link px-2 d-flex align-items-center">
                                <i class="material-icons text-white">receipt_long</i><span class="ms-1 d-none d-sm-inline text-white" style="padding-left: 10px;">Orders</span>
                            </a>
                        </li>
                        <li class="w-100 change-when-hovered">
                            <a href="adm_reports.php" class="nav-link px-2 d-flex align-items-center">
                                <i class="material-icons text-white">query_stats</i><span class="ms-1 d-none d-sm-inline text-white" style="padding-left: 10px;">Reports</span>
                            </a>
                        </li>
                    </ul>
                    <hr>

                    <!-- Si Logout -->
                    <ul class="nav nav=pills flex-column w-100">
                        <li class="text-align-middle change-when-hovered">
                            <a href="login.php" class="nav-link px-2 d-flex align-items-center">
                                <i class="material-icons text-white">logout</i><span class="ms-1 d-none d-sm-inline text-white" style="padding-left: 10px;">Logout</span>
                            </a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content na ni diri -->
            <div class="col py-3 bg-white m-4 p-5 rounded shadow-sm">

                <!-- Table Title + Description -->
                <div class="p-2">
                    <h4 class="fw-bold">Orders</h4>
                    <p class="small text-muted">
                        Find and search order details on the table below.
                        Thanks for your hard work!</p>
                </div>

                <!-- Table Container -->
                <div style="border: 1.5px solid #DFE2E5; border-radius: 10px;">

                    <div class="container bg-light" style="border-bottom: 1.5px solid #DFE2E5;">
                        <!-- Search Bar -->
                        <form method="post">
                            <div class="row align-items-center p-3">
                                <div class="input-group mx-3 my-2">
                                    <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Search orders here (e.g. Karen Smith)">
                                    <div class="input-group-append">
                                        <button type="submit" name="search" value="Search" class="btn btn-primary bg-success" style="border: none;"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <!-- Pagination here -->
                                <!-- <div class="col-md-2">
                                        <ul class="pagination  m-0">
                                            <?php
                                            // for ($page = 1; $page <= $total_pages; $page++) {
                                            //     if ($page == $current_page) {
                                            //         echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                            //     } else {
                                            //         echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
                                            //     }
                                            // }
                                            ?>
                                            <ul>
                                    </div> -->
                            </div>
                        </form>
                    </div>

                    <!-- Table Content -->
                    <?php searchOrders(
                        $conn,
                        'getOrderTable',
                        'OrderTbl',
                        $query
                    );

                    function getOrderTable($conn, $query) {
                        $stmt = $conn->query($query);
                        if ($stmt->rowCount() > 0) { ?>

                            <!-- Full Order Table diri -->
                            <div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
                                <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                                    <thead class="bg-white">
                                        <tr>
                                            <th style="padding-left: 10px;">ID</th>
                                            <th>Status</th>
                                            <th>Client</th>
                                            <th>Total Payment</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $stmt->fetch()) : ?>
                                            <tr>
                                                <td> <!-- Order ID -->
                                                    <p class="fw-bold mb-1 pl-0"> <?php echo $row['ord_id']; ?> </p>
                                                </td>
                                                <td> <!-- Order Status -->
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
                                                <td> <!-- User Name + ID -->
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['acc_name']; ?></p>
                                                            <p class="text-muted mb-0 small">User ID: <?php echo $row['acc_id']; ?>'</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <!-- Total Price sa Order -->
                                                    <p class="fw-bold mb-1">₱ <?php echo $row['ord_totalprice']; ?> .00</p>
                                                </td>
                                                <td> <!-- Order Date -->
                                                    <p class="fw-bold mb-1"> <?php echo $row['ord_dt']; ?></p>
                                                </td>
                                                <td> <!-- Actions -->
                                                    <button type="button" class="btn btn-sm btn-outline-success px-4">View</button>
                                                    <button type="button" class="btn btn-sm btn-outline-primary px-4">Edit</button>
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
                <!-- end of products table -->
            </div>
        </div>
    </div>
</body>