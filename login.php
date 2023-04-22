<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database to check if the email and password match an account
    $sql = "SELECT * FROM AccountTbl WHERE acc_email=:email AND acc_pwd=:password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':email' => $email,
        ':password' => $password
    ));
    $result = $stmt->fetch();

    // If the query returns a row, the account exists and the login is successful
    if ($result) {
        // Store the email and role in the session for future use
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $result["acc_role"];

        // Redirect the user based on their role
        if ($result["acc_role"] == "admin") {
            header("Location: adm_customers.php");
            exit();
        } elseif ($result["acc_role"] == "customer") {
            header("Location: home.php");
            exit();
        }
    } else {
        // If the query returns zero rows, the account does not exist
        echo "<script>alert('Account does not exist.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.ico">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
</head>
<style>
    @media (min-width: 768px) {
        .gradient-form {
            height: 100vh !important;
        }
    }

    @media (min-width: 769px) {
        .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    }

    button {
        border: none;
        background: #58A65C;
        padding: 12px 30px;
        border-radius: 30px;
        color: white;
        font-weight: bold;
        font-size: 15px;
        transition: .4s;
    }
</style>

<body>
    <section class="vh-100" style="background: url(assets/cabbage-bg.png); font-family: 'Montserrat', sans-serif;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="assets/box-of-vegetables.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span><img src="assets/logo.svg" style="height:50px;"></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label" for="email">Email address</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button type="submit">Login</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="signUp.php" style="color: #393f81;">Register here</a></p>
                                        <a href="about.php" class="small text-muted">Learn more about Davao Fresh</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>