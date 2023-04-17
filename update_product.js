document.getElementById("edit-product-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally
    // Get the input field values
    var productId = document.getElementById("edit-id").value;
    var productName = document.getElementById("edit-name").value;
    var productPrice = document.getElementById("edit-price").value;
    var productUnit = document.getElementById("edit-unit").value;
    var productCategory = document.getElementById("edita-cat").value;
    var productImage = document.getElementById("edit-img").value;

    // Make an AJAX call to update the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "edit-product.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Handle the response from the server
            console.log(this.responseText);
            // Hide the modal
            $('#edit-product-modal').modal('hide');
        }
    };
    xhr.send("edit-id=" + encodeURIComponent(productId) + "&edit-name=" + encodeURIComponent(productName) + "&edit-price=" + encodeURIComponent(productPrice) + "&edit-unit=" + encodeURIComponent(productUnit) + "&edit-cat=" + encodeURIComponent(productCategory) + "&edit-img=" + encodeURIComponent(productImage));
});

// GOOD TO REMOVE