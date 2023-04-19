<?php
include 'conn.php';

// Get the status and ID parameters from the AJAX request
$newStatus = $_POST["status"];
$ordId = $_POST["id"];

$stmt = $conn->prepare("UPDATE OrderTbl SET ord_status = :status WHERE ord_id = :id");
$stmt->execute(["status" => $newStatus, "id" => $ordId]);

// Return a success message
echo "Account status updated successfully.";
