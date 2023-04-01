<?php
include 'conn.php';
// include 'adm_navbar.php';

$results_per_page = 10;

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
    <link rel="icon" href="assets/icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <img src="" alt="">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="newstyle.css">
    <title>Davao Fresh</title>
  </head>
    
  <body>
    <div style="border: 1.5px solid #DFE2E5; border-radius: 10px; margin-inline:10%; margin-bottom: 5%;">
      <div class="bg-light" style="padding: 15px 30px; border-bottom: 1.5px solid #DFE2E5;">';
      echo '
        <ul class="pagination justify-content-end">';
        for ($page = 1; $page <= $total_pages; $page++) { if ($page==$current_page) {
          echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>' ; } else {
          echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>' ; }
          }
  echo '<ul>';
      //Search ni diri
      echo '
      <div class="input-group rounded">
        <input type="search" class="form-control rounded" style= "width: 500px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      </div>
      </div>
      <div class="my-table table-hover table-striped" style="margin: 30px;">
          <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
            <thead class="bg-white">
              <tr>
                <th style="padding-left: 50px;">ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>';
foreach ($results as $row) {
  // Product ID + Img + Name + Category
  echo
  '<tr>
                    <td style="width: 15%; padding-left: 50px;">
                        <p class="fw-bold mb-1"> ' . $row['prd_id'] . '</p>
                    </td>
                    <td>
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
                  <td>
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
                </tr>';
}
echo
'</tbody>
          </table>
        </div>
      </div> 
    <footer class="bg-light text-center text-lg-start">
      <div class="small text-center p-3" style="background-color: #e2fc51;">
        <span>Developed by </span>
        <span><a href="https://www.facebook.com/libby.hermo" target="_blank" style="font-weight: 700;">Libby Marowen Hermo</a></span>
        <span>and </span>
        <span><a href="https://www.facebook.com/cristine.albisocomajes.3" target="_blank" style="font-weight: 700;"> Ma. Cristine Joy Comajes</a></span>
      </div>
    </footer>   
    </body>';