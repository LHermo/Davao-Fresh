<?php
session_start();
require_once('conn.php');
include 'functions.php';

function detailRow($title, $detail)
{
    echo '<div class="row">
                        <div class="col-md-4">
                            <p class="text-muted fw-bold">' . $title . ' </p>
                        </div>
                        <div class="col-md-8">
                            <p class="">' . $detail . '</p>
                        </div>
                    </div>';
}

$email = $_SESSION['email'];
$accID = getDataBySession('acc_id', $conn, $email);

function getUserInfo($conn, $accID, $column)
{
    $stmt = $conn->prepare("SELECT $column FROM AccountTbl WHERE acc_ID=:accID");
    $stmt->bindParam(':accID', $accID);
    $stmt->execute();
    $data = $stmt->fetchColumn();
    return $data;
}
$stmt = $conn->prepare("SELECT * FROM OrderTbl JOIN AccountTbl ON AccountTbl.acc_id = OrderTbl.acc_id WHERE AccountTbl.acc_id = $accID");
$stmt->execute();
$data = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="assets/icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Davao Fresh</title>
</head>

<body>
    <div class="main-content">
        <!-- NAVIGATION BAR -->
        <?php
        include 'usr_navbar.php';
        ?>

        <!-- THE CONTENT -->
        <div class="container" style="width: 100%; margin-top: 120px;">
            <div class="row">
                <!-- Left panel -->
                <div class="col-4 bg-light p-4" style="height: 85vh;">
                    <figure class="figure m-1">
                        <img src="assets/user.jpg" class="figure-img img-fluid rounded" style="width: 100px; height: auto;">
                    </figure>
                    <button type="submit" class="btn btn-outline-dark" style="float: right;">Edit</button>
                    <p class="fs-4 fw-bold"><?php echo getUserInfo($conn, $accID, 'acc_name'); ?></p>

                    <?php detailRow("Email", $email); ?>
                    <?php detailRow("Phone", getUserInfo($conn, $accID, 'acc_phone')) ?>
                    <hr class="my-5">
                    <h5 class="fw-bold mb-3">Shipping Address</h5>
                    <?php detailRow("Address", getUserInfo($conn, $accID, 'acc_addr')); ?>
                    <?php detailRow("City", getUserInfo($conn, $accID, 'acc_city')); ?>
                    <?php detailRow("ZIP", getUserInfo($conn, $accID, 'acc_zip')); ?>
                </div>
                <!-- Right panel -->
                <!-- <div class="col-8 p-4">
                    <h4>Edit Details <button type="submit" class="btn btn-primary" style="float: right;">Save Changes</button></h4>
                    <hr class="mb-5">
                    <form>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" value="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" class="form-control" id="phone" value="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="addr" class="form-label">Address</label>
                            <input type="addr" class="form-control" id="addr" value="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="city" class="form-control" id="city" value="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="zip" class="form-control" id="zip" value="name@example.com">
                        </div>
                    </form>
                </div> -->
                <div class="col-8 p-4">
                    <h4>Order History</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Items</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <tr>
                                    <th scope="row"><?php echo $row['ord_ID'] ?></th>
                                    <td><?php echo $row['ord_dt'] ?></td>
                                    <td><?php echo $row['ord_status'] ?></td>
                                    <td><?php echo $row['ord_totalprice'] ?></td>
                                    <td colspan="2">@items</td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<?php
$pdo = null;
?>