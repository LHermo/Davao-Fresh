<?php
include 'conn.php';

$newStatus = $_POST["status"];
$ordId = $_POST["id"];

$stmt = $conn->prepare("UPDATE OrderTbl SET ord_status = :status WHERE ord_id = :id");
$stmt->execute(["status" => $newStatus, "id" => $ordId]);

echo "Account status updated successfully.";
