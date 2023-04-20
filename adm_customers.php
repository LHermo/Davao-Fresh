<?php
include 'conn.php';
include 'functions.php';

// sa pagination ni na code
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

$query = "SELECT * FROM AccountTbl
    WHERE acc_role = 'Customer'
    AND (acc_id LIKE '%$searchTerm%'
    OR acc_zip LIKE '%$searchTerm%'
    OR acc_email LIKE '%$searchTerm%'
    OR acc_city LIKE '%$searchTerm%'
    OR acc_status LIKE '%$searchTerm%'
    OR acc_name LIKE '%$searchTerm%'
    OR acc_addr LIKE '%$searchTerm%'
    OR acc_phone LIKE '%$searchTerm%')
    LIMIT $start, $results_per_page";

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

    <link rel="stylesheet" href="">
    <link rel="icon" href="assets/icon-green.svg">
    <link rel="stylesheet" href="newstyle.css">
    <title>Customers</title>
</head>

<body class="bg-light min-height-100">
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- Side bar code starts here -->
            <?php
            $active_tab = 'customers';
            include 'adm_navbar.php';
            ?>

            <!-- Content na ni diri -->
            <div class="col py-3 bg-white m-4 p-5 rounded shadow-sm">

                <!-- Table Title + Description -->
                <div class="p-2">
                    <h4 class="fw-bold">Customers</h4>
                    <p class="small text-muted">
                        Find and search customer details on the table below.
                        Thanks for your hard work!</p>
                </div>

                <!-- Table Container -->
                <div style="border: 1.5px solid #DFE2E5; border-radius: 10px;">

                    <div class="container bg-light" style="border-bottom: 1.5px solid #DFE2E5;">
                        <!-- Search bar -->
                        <form method="post">
                            <div class="row align-items-center p-3">
                                <div class="input-group mx-3 my-2">
                                    <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Search customers here (e.g. Karen Smith)">
                                    <div class="input-group-append">
                                        <button type="submit" name="search" value="Search" class="btn btn-primary bg-success" style="border: none;"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Content -->
                    <?php getCustomerTable(
                        $conn,
                        'getAccountTable',
                        $query
                    );

                    function getAccountTable($conn, $query)
                    {
                        $stmt = $conn->query($query);
                        if ($stmt->rowCount() > 0) { ?>
                            <!-- Full Customers in Account Table -->
                            <div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
                                <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                                    <thead class="bg-white">
                                        <tr>
                                            <th style="padding-left: 10px;">ID</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $stmt->fetch()) : ?>
                                            <tr>
                                                <td> <!-- Customer ID -->
                                                    <p class="fw-bold mb-1 pl-0"> <?php echo $row['acc_id']; ?> </p>
                                                </td>
                                                <td> <!-- Customer Name + email -->
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1" style="font-weight: 500;"><?php echo $row['acc_name']; ?></p>
                                                            <p class="text-muted mb-0 small"><?php echo $row['acc_email'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <!-- Address -->
                                                    <p class="fw-bold mb-1"><?php echo $row['acc_addr']; ?></p>
                                                </td>
                                                <td> <!-- Phone -->
                                                    <p class="fw-bold mb-1"> <?php echo $row['acc_phone']; ?></p>
                                                </td>
                                                <td> <!-- Actions -->
                                                    <div class="dropdown">
                                                        <select name="status" onchange="updateStatus(this.value, <?php echo $row['acc_id']; ?>)">
                                                            <option value="active"><?php echo $row['acc_status'] ?></option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="blocked">Blocked</option>
                                                        </select>
                                                    </div>

                                                    <!-- <div class="dropdown">
                                                        <?php
                                                        if ($row['acc_status'] == 'active') {
                                                            echo '<button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $row['acc_status'] . '</button>';
                                                        } else if ($row['acc_status'] == 'inactive') {
                                                            echo '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $row['acc_status'] . '</button>';
                                                        } else {
                                                            echo '<button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $row['acc_status'] . '</button>';
                                                        }
                                                        ?>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#" value="active">Active</a>
                                                            <a class="dropdown-item" href="#" value="inactive">Inactive</a>
                                                            <a class="dropdown-item" href="#" value="blocked">Blocked</a>
                                                        </div>
                                                    </div> -->
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
    // Sa dropdown sa edit status ni
    const dropdownButton = document.getElementById('dropdownMenuButton');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');

    dropdownItems.forEach(item => {
        item.addEventListener('click', () => {
            dropdownButton.innerHTML = item.innerHTML;
        });
    });

    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();

        // Close dropdown when clicking outside of it
        $(document).on('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest('.dropdown').length) {
                $('.dropdown-toggle').dropdown('hide');
            }
        });
    });

    // Para mu close dayun
    $(document).ready(function() {
        $(".dropdown-menu a").click(function() {
            var selectedOption = $(this).text();
            $(this).parents(".dropdown").find('.dropdown-toggle').html(selectedOption);
            $(this).parents(".dropdown").find('.dropdown-toggle').addClass('selected-' + selectedOption.toLowerCase());
            $(this).parents(".dropdown").find('.dropdown-toggle').dropdown('toggle');
        });
    });

    // color change
    const dropdown = document.querySelector('.dropdown');
    const options = dropdown.querySelectorAll('.dropdown-menu .dropdown-item');

    options.forEach((option) => {
        option.addEventListener('click', function() {
            const status = option.textContent;
            const btn = dropdown.querySelector('.dropdown-toggle');

            if (status === 'Active') {
                btn.classList.remove('btn-secondary', 'btn-danger');
                btn.classList.add('btn-success');
            } else if (status === 'Inactive') {
                btn.classList.remove('btn-success', 'btn-danger');
                btn.classList.add('btn-secondary');
            } else if (status === 'Blocked') {
                btn.classList.remove('btn-success', 'btn-secondary');
                btn.classList.add('btn-danger');
            }

            btn.textContent = status;
        });
    });

    function updateStatus(newStatus, accId) {
        $.ajax({
            url: "edit-customer.php",
            method: "POST",
            data: {
                status: newStatus,
                id: accId
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