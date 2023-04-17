<?php
include 'conn.php';

// Get the product data from the POST request
$id = $_POST['edit-id'];
$name = $_POST['edit-name'];
$price = $_POST['edit-price'];
$unit = $_POST['edit-unit'];
$cat = $_POST['edit-cat'];
$img = $_POST['edit-img'];

// Prepare the update query
$sql = "UPDATE ProductTbl SET prd_name = :name, prd_price = :price, prd_unit = :unit, prd_cat = :cat, prd_img = :img WHERE prd_id = :id";
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':unit', $unit);
$stmt->bindParam(':cat', $cat);
$stmt->bindParam(':img', $img);
$stmt->bindParam(':id', $id);

// Execute the query
if ($stmt->execute()) {
    // Query executed successfully
    // echo '<script>$("#success-modal").modal("show");</script>';
    header('Location: adm_products.php');
    exit;
} else {
    // Query failed to execute
    // Display an error message
    echo 'Failed to update product data.';
}
?>

<script>
    document.getElementById("edit-product-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form from submitting normally
        // Get the input field values
        var productId = document.getElementById("edit-id").value;
        var productName = document.getElementById("edit-name").value;
        var productPrice = document.getElementById("edit-price").value;
        var productUnit = document.getElementById("edit-unit").value;
        var productCategory = document.getElementById("edit-cat").value;
        var productImage = document.getElementById("edit-img").value;

        // Make an AJAX call to update the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "edit-product.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response from the server
                console.log(this.responseText);
                // Hide the modal
                $('#edit-product-modal').modal('hide');
            }
        };
        xhr.send("edit-id=" + encodeURIComponent(productId) + "&edit-name=" + encodeURIComponent(productName) + "&edit-price=" + encodeURIComponent(productPrice) + "&edit-unit=" + encodeURIComponent(productUnit) + "&edit-cat=" + encodeURIComponent(productCategory) + "&edit-img=" + encodeURIComponent(productImage));
    });
</script>