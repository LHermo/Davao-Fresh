<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Add Product Form diri -->
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
    </div> <!-- End of Add Product Form -->

    <!-- Edit Product Form diri -->
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
    </div> <!-- End of Edit Product Form -->
</body>

</html>