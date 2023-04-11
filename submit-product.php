<?php
include 'conn.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $prd_name = $_POST["product-name"];
    $prd_price = $_POST["product-price"];
    $prd_unit = $_POST["product-unit"];
    $prd_category = $_POST["product-category"];
    $prd_img = $_POST["product-image"];

    try {
        $stmt = $conn->prepare("INSERT INTO ProductTbl (prd_name, prd_price, prd_unit, prd_cat, prd_img) VALUES (:prd_name, :prd_price, :prd_unit, :prd_cat, :prd_img)");
        // Bind parameters
        $stmt->bindParam(":prd_name", $prd_name);
        $stmt->bindParam(":prd_price", $prd_price);
        $stmt->bindParam(":prd_unit", $prd_unit);
        $stmt->bindParam(":prd_cat", $prd_category);
        $stmt->bindParam(":prd_img", $prd_img);
        $stmt->execute();

        echo "Product added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
