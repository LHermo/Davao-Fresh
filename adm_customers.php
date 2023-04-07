<?php
include 'conn.php';
// include 'adm_navbar.php';

$results_per_page = 6;

// Retrieve total number of results from the database
$sql = "SELECT COUNT(*) AS count FROM AccountTbl";
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

// Data retrieval sa current page
$sql = "SELECT * FROM AccountTbl WHERE acc_role = 'customer' LIMIT $start, $results_per_page";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>

<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="">
    <link rel="icon" href="assets/icon-green.svg">
    <link rel="stylesheet" href="newstyle.css">
    <title>Customers</title>
</head>

<body class="bg-light min-height-100">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Side bar code starts here -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background: #214D34; min-height: 870px;">
                <!-- <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark"> -->
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <!-- Si Logo -->
                    <a href="adm_products.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline" style="margin: 20px 0px;"><img style="width: 180px;" src="assets/LOGO - Davao Fresh Dark.svg" alt=""></span>
                    </a>
                    <!-- Si Menu -->
                    <ul style="margin-top: 30px; width: 100%;" class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item w-100 change-when-hovered">
                            <a href="adm_products.php" class="nav-link d-flex align-items-center px-2 text-white">
                                <i class="material-icons text-white">inventory</i><span class="ms-1 d-none d-sm-inline" style="padding-left: 10px;">Products</span>
                            </a>
                        </li>
                        <li class="w-100 change-when-hovered">
                            <a href="adm_customers.php" class="active nav-link px-2 d-flex align-items-center">
                                <i class="material-icons text-white">diversity_3</i><span class="ms-1 d-none d-sm-inline text-white " style="padding-left: 10px;">Customers</span></a>
                        </li>
                        <li class="w-100 change-when-hovered">
                            <a href="adm_orders.php" class="nav-link px-2 d-flex align-items-center">
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
            </div> <!-- end ni sidebar code -->

            <!-- Content na ni diri -->
            <div class="col py-3 bg-white m-4 p-5 rounded shadow-sm">
                <div class="p-2">
                    <h4 class="fw-bold">Customers</h4>
                    <p class="small text-muted">
                        Find and search customer details on the table below.
                        Thanks for your hard work!</p>
                </div>

                <div style="border: 1.5px solid #DFE2E5; border-radius: 10px;">

                    <!-- ABOVE TABLE -->
                    <div class="container bg-light" style="border-bottom: 1.5px solid #DFE2E5;">
                        <div class="row align-items-center p-3">
                            <!-- Button -->
                            <!-- <div class="add-product-button col-md-3">
                                <button class="adm-table-button" disabled> Add New Customer</button>
                            </div> -->
                            <!-- <div class="col-md-1"></div> -->
                            <!-- Searchbar -->
                            <div class="searchbar col-md-10">
                                <div class="input-group rounded">
                                    <input type="search" class="form-control rounded" style="width: 300px;" placeholder="Search for customers (e.g. Dodong Janjan)" aria-label="Search" aria-describedby="search-addon" />
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="col-md-2">
                                <ul class="pagination  m-0">
                                    <?php
                                    for ($page = 1; $page <= $total_pages; $page++) {
                                        if ($page == $current_page) {
                                            echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                        } else {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
                                        }
                                    }
                                    ?>
                                    <ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-table table-hover table-striped" style="margin: 30px;">
                        <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                            <thead class="bg-white">
                                <tr>
                                    <th style="padding-left: 10px;">ID</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($results as $row) {
                                    echo '
                  <tr>
                      <td>
                          <p class="fw-bold mb-1 pl-0"> ' . $row['acc_id'] .
                                        '</p>
                      </td>
                      <td>';
                                    if ($row['acc_status'] == 'active') {
                                        echo '<span class="badge badge-success rounded-pill d-inline">' . $row['acc_status'] . '</span>';
                                    } else if ($row['acc_status'] == 'inactive') {
                                        echo '<span class="badge badge-secondary rounded-pill d-inline">' . $row['acc_status'] . '</span>';
                                    } else {
                                        echo '<span class="badge badge-danger rounded-pill d-inline">' . $row['acc_status'] . '</span>';
                                    }
                                    //   <p class="fw-bold mb-1"> ' . $row['acc_status'] . '</p>
                                    echo '
                      </td>
                      <td>
                          <div class="d-flex align-items-center">
                              <div class="ms-3">
                                  <p class="fw-bold mb-1" style="font-weight: 500;">' . $row['acc_name'] . '</p>
                                  <p class="text-muted mb-0 small">' . $row['acc_email'] . '</p>
                              </div>
                          </div>
                      </td>
                      <!-- Price + Unit of Measurement  -->
                      <td>
                          <p class="fw-bold mb-1" style="font-weight: 500;">' . $row['acc_addr'] . '</p>
                          <p class="text-muted mb-0 small">' . $row['acc_zip'] . '</p>
                      </td>
                      <td>
                          <p class="fw-bold mb-1"> ' . $row['acc_phone'] . '</p>
                      </td>
                      <!-- Actions  -->
                      <td>
                          <button type="button" class="btn btn-sm btn-outline-primary px-4">Edit Status</button>
                      </td>
                  </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end of products table -->
            </div>
        </div>
    </div>
</body>

</html>