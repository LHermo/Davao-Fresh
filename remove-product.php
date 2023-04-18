<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM ProductTbl WHERE prd_id = ?");
    $stmt->execute([$id]);
    header('Location: adm_products.php');
    exit;
}

$conn = null;
