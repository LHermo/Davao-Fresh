<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Removal Confirmatory Modal -->
    <div id="confirmModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Success Modal -->
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="success-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="success-modal-label">Success!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The product data has been updated successfully.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

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
    <div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-product-modal-label">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- EDIT PRODUCT -->
                <form id="edit-product-form" method="post" action="edit-product.php">
                    <div class="modal-body">
                        <input type="hidden" name="edit-id" id="edit-id">
                        <div class="form-group">
                            <label for="edit-name">Product Name:</label>
                            <input type="text" class="form-control" id="edit-name" name="edit-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-price">Price:</label>
                            <input type="number" class="form-control" id="edit-price" name="edit-price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-unit">Product Unit:</label>
                            <input type="text" class="form-control" id="edit-unit" name="edit-unit" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-cat">Category:</label>
                            <select class="form-control" id="edit-cat" name="edit-cat" required>
                                <option value="">-- Select Category --</option>
                                <option value="FRUITS">Fruits</option>
                                <option value="VEGETABLES">Vegetables</option>
                                <option value="GRAINS">Grains</option>
                                <option value="HERBS & SPICES">Herbs & Spices</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-img">Image URL:</label>
                            <textarea class="form-control" id="edit-img" name="edit-img" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-sm btn-primary edit-product-btn" data-toggle="modal" data-target="#editProductModal" data-product-id="<?php echo $row['prd_id']; ?>">Save Changes</button> -->
                        <!-- <button type="submit" class="btn btn-sm btn-primary edit-product-btn" data-toggle="modal" data-target="#edit-product-modal">Save Changes</button> -->
                        <button type="submit" class="btn btn-sm btn-primary edit-product-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- End of Edit Product Form -->
</body>

</html>