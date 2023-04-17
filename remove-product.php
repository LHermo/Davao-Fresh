<?php
include 'conn.php';

// Get ID parameter from POST data
$id = $_POST['prd_id'];

// Prepare SQL query to delete row
// $sql = "DELETE FROM ProductsTbl WHERE prd_id = $id";
// if ($conn->query($sql) === TRUE) {
//   echo "Row deleted successfully";
// } else {
//   echo "Error deleting row: ";
// }

// // Close database connection
// $conn=null;

$prd_id = $_POST['prd_id'];

$sql = "DELETE FROM ProductTbl WHERE prd_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$prd_id]);

header('Location: adm_products.php');
exit;
