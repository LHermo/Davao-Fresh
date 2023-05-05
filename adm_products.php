<?php
include 'conn.php';
include 'functions.php';
include 'modal_forms.php';

// sa pagination ni na code
$results_per_page = 5;
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

$query = "SELECT * FROM ProductTbl
    WHERE prd_id LIKE '%$searchTerm%'
    OR prd_name LIKE '%$searchTerm%'
    OR prd_cat LIKE '%$searchTerm%'
    OR prd_price LIKE '%$searchTerm%'
    OR prd_unit LIKE '%$searchTerm%'
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
  <title>Products</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>


<body class="bg-light min-height-100">


  <div class="container-fluid">
    <div class="row flex-nowrap">

      <!-- Side bar code starts here -->
      <?php
      $active_tab = 'products';
      include 'adm_navbar.php';
      ?>

      <!-- Content na ni diri -->
      <div class="col py-3 bg-white m-4 p-5 rounded shadow-sm">

        <!-- Table Title + Description -->
        <div class="p-2">
          <h4 class="fw-bold">Products</h4>
          <p class="small text-muted">
            Find and search products and their details on the table below.
            Thanks for your hard work!</p>
        </div>

        <!-- Table Container -->
        <div style="border: 1.5px solid #DFE2E5; border-radius: 10px;">

          <div class="container bg-light" style="border-bottom: 1.5px solid #DFE2E5;">
            <!-- Search bar -->
            <form method="post">
              <div class="row align-items-center p-3">
                <!-- Button -->
                <div class="add-product-button col-md-3">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-product-modal">Add New Product</button>
                </div>
                <div class="input-group" style="max-width: 550px;">
                  <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Search orders here (e.g. Karen Smith)">
                  <div class="input-group-append">
                    <button type="submit" name="search" value="Search" class="btn btn-primary bg-success" style="border: none;">
                      <i class="fas fa-search"></i>
                    </button>
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
            </form>
          </div>

          <!-- Table Content -->
          <?php displayProducts(
            $conn,
            'getProductTable',
            "SELECT * FROM ProductTbl LIMIT $start, $results_per_page",
            $query
          );

          function getProductTable($conn, $query)
          {
            $stmt = $conn->query($query);
            if ($stmt->rowCount() > 0) { ?>

              <div class="my-table table-hover table-striped" id="orders-table" style="margin: 30px;">
                <table class="table align-middle mb-0 bg-white" style="border: 1px solid #DFE2E5;">
                  <thead class="bg-white">
                    <tr>
                      <th style="padding-left: 50px;">ID</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = $stmt->fetch()) : ?>
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
                          <p class="fw-bold mb-1" style="font-weight: 500;">₱ <?php echo $row['prd_price']; ?>.00</p>
                          <p class="text-muted mb-0 small"><?php echo $row['prd_unit']; ?></p>
                        </td>
                        <!-- Actions  -->
                        <td>
                          <form method="POST" action="delete-product.php">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit-product-modal" data-id="<?php echo $row['prd_id'] ?>" data-name="<?php echo $row['prd_name'] ?>" data-price="<?php echo $row['prd_price'] ?>" data-unit="<?php echo $row['prd_unit'] ?>" data-cat="<?php echo $row['prd_cat'] ?>" data-img="<?php echo $row['prd_img'] ?>">Edit</button>
                            <input type="hidden" name="id" value="<?php echo $row['prd_id']; ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-confirm="Are you sure you want to delete this product?">Delete</button>
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
  // Add Product
  $(document).ready(function() {
    $('[data-toggle="modal"]').click(function() {
      $($(this).data("target")).modal("show");
    });
  });

  // Handle form submission with AJAX and PDO
  $(document).on("submit", "#add-product-form", function(event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr("action");
    var method = form.attr("method");
    var data = form.serialize();
    $.ajax({
      url: url,
      type: method,
      data: data,
      success: function(response) {
        alert(response); // Display success message
        location.reload(); // Refresh the page
      },
      error: function(xhr, status, error) {
        alert("An error occurred while submitting the form: " + error);
      }
    });
  });

  // Populate data on edit modal
  $(document).on('click', '[data-target="#edit-product-modal"]', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var cat = $(this).data('cat');
    var price = $(this).data('price');
    var unit = $(this).data('unit');
    var img = $(this).data('img');

    $('#edit-id').val(id);
    $('#edit-name').val(name);
    $('#edit-cat').val(cat);
    $('#edit-price').val(price);
    $('#edit-unit').val(unit);
    $('#edit-img').val(img);

    $('#edit-product-modal').modal('show');
  });

  // Remove product
  const deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(button => {
    button.addEventListener('click', event => {
      const message = button.getAttribute('data-confirm');
      if (!confirm(message)) {
        event.preventDefault(); // cancel the default delete action
      }
    });
  });
</script>