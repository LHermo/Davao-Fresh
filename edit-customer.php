<?php
include 'conn.php';

try {

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get data from AJAX request
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Prepare and execute UPDATE statement
    $stmt = $conn->prepare("UPDATE AccountTbl SET acc_status = :status WHERE prd_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    // Return success message
    echo "Data updated successfully!";
} catch (PDOException $e) {
    // Return error message
    echo "Error: " . $e->getMessage();
}

// Close PDO connection
$conn = null;
