<?php
include 'conn.php';

$results_per_page = 7;

// Retrieve total number of results from the database
$sql = "SELECT COUNT(*) AS count FROM ProductTbl";
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
$sql = "SELECT * FROM ProductTbl LIMIT $start, $results_per_page";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="style.css">

        <link rel="icon" href="assets/icon.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
        
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <img src="" alt="">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="newstyle.css">
    <script src="https://cdn.tailwindcss.com/3.2.4"></script>
        <title>Davao Fresh</title>
    </head>
    
    <body class="with-margin">
    <div style="padding: 10px; margin-inline: 10px;">
        <div class="my-table table-hover">
            <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>';
foreach ($results as $row) {
    // Product Img + Name + Category
    echo
    '<tr>
                    <td style="width: 10%;">
                        <p class="fw-bold mb-1"> ' . $row['prd_id'] . '</p>
                    </td>
                    <td style="width: 50%;">
                        <div class="d-flex align-items-center">
                        <img    
                            src=" ' . $row['prd_img'] . '"
                            style="width: 55px; height: 45px; margin-right: 20px"
                            
                            />
                        <div class="ms-3">
                            <p class="fw-bold mb-1" style="font-weight: 500;">' . $row['prd_name'] . '</p>
                            <p class="text-muted mb-0 small">' . $row['prd_cat'] . '</p>
                        </div>
                        </div>
                    </td>';
    // Price + Unit of Measurement
    echo '
                <td width: 30%;>
                    <!-- <span class="badge badge-success rounded-pill d-inline">Active</span> -->
                    <p class="fw-bold mb-1" style="font-weight: 500;">₱ ' . $row['prd_price'] . '.00</p>
                    <p class="text-muted mb-0 small">' . $row['prd_unit'] . '</p>
                </td> ';
    // Actions
    echo '
                <td>
                    <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                    </td>
                </td>
                </tr>
                ';
}
echo
'</tbody>
            </table>
            </div>
            </div>
        </body>';
// Pagination
echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">';

for ($page = 1; $page <= $total_pages; $page++) {
    if ($page == $current_page) {
        echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
    }
}
echo '</ul></nav>';
