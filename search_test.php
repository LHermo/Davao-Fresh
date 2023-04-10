<?php
include 'conn.php';
include 'functions.php';

$query = "SELECT OrderTbl.*, AccountTbl.acc_name
    FROM OrderTbl
    INNER JOIN AccountTbl 
    ON OrderTbl.acc_id = AccountTbl.acc_id 
    WHERE OrderTbl.ord_id LIKE '%$searchTerm%'
    OR AccountTbl.acc_id LIKE '%$searchTerm%'
    OR AccountTbl.acc_name LIKE '%$searchTerm%'
    OR OrderTbl.ord_status LIKE '%$searchTerm%'
    OR OrderTbl.ord_totalprice LIKE '%$searchTerm%'
    OR OrderTbl.ord_dt LIKE '%$searchTerm%'";

searchOrders($conn, 'getOrderTable','OrderTbl',
                $query);
?>
    <form method="post">
        <label for="searchTerm">Search:</label>
        <input type="text" name="searchTerm" id="searchTerm">
        <input type="submit" name="search" value="Search">
    </form> 