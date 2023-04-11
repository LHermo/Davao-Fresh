<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-product-modal">Add New Product</button>

    <div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="add-product-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-product-modal-label">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="add-product-form" method="post" action="submit-product.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product-name">Product Name:</label>
                            <input type="text" class="form-control" id="product-name" name="product-name" required>
                        </div>
                        <div class="form-group">
                            <label for="product-price">Price:</label>
                            <input type="number" class="form-control" id="product-price" name="product-price" required>
                        </div>
                        <div class="form-group">
                            <label for="product-unit">Product Unit:</label>
                            <input type="text" class="form-control" id="product-unit" name="product-unit" required>
                        </div>
                        <div class="form-group">
                            <label for="product-category">Category:</label>
                            <select class="form-control" id="product-category" name="product-category" required>
                                <option value="">-- Select Category --</option>
                                <option value="FRUITS">Fruits</option>
                                <option value="VEGETABLES">Vegetables</option>
                                <option value="GRAINS">Grains</option>
                                <option value="HERBS & SPICES">Herbs & Spices</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product-image">Image URL:</label>
                            <textarea class="form-control" id="product-image" name="product-image" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
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
                alert("An error occurred while submitting the form: " + error); // Display error message
            }
        });
    });
</script>

</html>