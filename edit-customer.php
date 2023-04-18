<?php
include 'conn.php';

// Get the status and ID parameters from the AJAX request
$newStatus = $_POST["status"];
$accId = $_POST["id"];

$stmt = $conn->prepare("UPDATE AccountTbl SET acc_status = :status WHERE acc_id = :id");
$stmt->execute(["status" => $newStatus, "id" => $accId]);

// Return a success message
echo "Account status updated successfully.";
