<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirm-pass"];


    $stmt = $conn->prepare("INSERT INTO AccountTbl (acc_name, acc_email, acc_pwd, acc_addr, acc_city, acc_zip, acc_phone, acc_role, acc_status) VALUES (:name, :email, :password, :address, :city, :zip, :phone, 'customer','active')");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":zip", $zip);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":password", $password);

    $stmt->execute();

    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create an account</title>
</head>
<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }
</style>

<body>
    <section class="h-100 h-custom" style="background: url('assets/cabbage-bg.png')">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">

                        <!-- <img src="assets/signup-hero.png" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: auto; width: 600px;" alt="Sample photo"> -->
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" onsubmit="return validateForm()" class="px-md-2">
                                <h4 class="pb-2">Create an account</h4>
                                <div class="form-outline mb-4">
                                    <input type="text" name="name" id="name" class="form-control" required />
                                    <label class="form-label" for="name">Name</label>

                                    <input type="text" name="email" id="email" class="form-control" required />
                                    <label class="form-label" for="form3Example1q">Email</label>
                                </div>

                                <div class="row">
                                    <div>
                                        <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                                        <label class="form-label" for="address">Address</label>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="city" id="city" class="form-control" required />
                                        <label class="form-label" for="city">City</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="zip" id="zip" class="form-control" required />
                                        <label class="form-label" for="zip">Zip</label>
                                    </div>
                                    <div class="mb-4">
                                        <input type="number" name="phone" id="phone" class="form-control" required />
                                        <label class="form-label" for="phone">Phone</label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="password" name="password" id="password" class="form-control" required />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="confirm-pass" id="confirm-pass" class="form-control" required />
                                        <label class="form-label" for="confirm-pass">Confirm Password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-end">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPass = document.getElementById("confirm-pass").value;

        if (password != confirmPass) {
            alert("The password fields must match.");
            return false;
        }
        return true;
    }
</script>

</html>