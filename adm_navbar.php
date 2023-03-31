<style>
    body {
        margin: 0;
    }

    nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        font-family: Montserrat, sans-serif;
        font-weight: 400;
        font-size: 1.10rem;
        /* 20px converted to rem */
        padding-inline: 10%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: height 0.3s ease-out;
        height: 116px;
    }

    .logo {
        margin-right: 1rem;
    }

    ul {
        list-style: none;
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0;
    }
    li {
        margin: 0;
        padding: 1rem;
    }

    .icons li:first-child {
    margin-right: -20px;
    }

    .icons li:last-child {
    margin-left: -20px;
    }

    a {
        display: block;
        color: #1b1b1b;
        padding: 1rem;
        text-decoration: none;
    }

    .icons {
        display: flex;
        align-items: center;
    }

    img {
        height: 1.5rem;
        width: 1.5rem;
        margin-left: 0.5rem;
    }

    @media screen and (max-width: 768px) {
        nav {
            flex-wrap: wrap;
            padding: 1rem;
        }

        .logo {
            margin: 0;
            order: 1;
        }

        ul {
            flex-basis: 100%;
            justify-content: space-between;
            order: 3;
            margin: 1rem 0;

            margin: 0;
            padding: 0;
            text-align: center;   
        }

        li {
            padding: 0.5rem;
        }

        .icons {
            order: 2;
            margin-left: auto;
            margin-top: 2rem;
        }

        .icons li{
            padding-left: 2rem;
        }

        a {
            padding: 0.5rem;
        }
        .scrolled ul {
            margin-top: -28px;
        }

    }

    .scrolled {
        /* height: 50px; */
        height: 80px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        padding-top: 0;
        padding-bottom: 0;
    }
</style>
<script>
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        var nav = document.querySelector("nav");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            nav.classList.add("scrolled");
            nav.style.boxShadow = "0 2px 4px rgba(0, 0, 0, 0.2)";
        } else {
            nav.classList.remove("scrolled");
            nav.style.boxShadow = "none";
        }
    }
</script>

<nav>
    <div class="logo">
        <a href="#"><img style="width: 137px;" src="assets/LOGO - Davao Fresh.svg" alt="Logo"></a>
    </div>
    <ul>
        <!-- <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li> -->
        <li <?php if ($_SERVER['PHP_SELF']=='/adm_products.php' ) { 
            echo 'class="active"' ; } ?>>
                <a href="adm_products.php">Products</a>
        </li>
        <li <?php if ($_SERVER['PHP_SELF']=='/adm_customers.php' ) { 
            echo 'class="active"' ; } ?>>
                <a href="adm_customers.php">Customers</a>
        </li>
        <li <?php if ($_SERVER['PHP_SELF']=='/adm_orders.php' ) { 
            echo 'class="active"' ; } ?>>
                <a href="adm_orders.php">Orders</a></li>
        <li <?php if ($_SERVER['PHP_SELF']=='/adm_reports.php' ) { 
            echo 'class="active"' ; } ?>>
                <a href="adm_reports.php">Reports</a></li>
    </ul>
    <div class="icons">
    <ul>
        <li <?php if ($_SERVER['PHP_SELF']=='/login.php' ) { 
            echo 'class="active"' ; } ?>>
                <a href="login.php" style="color: #E85757;">Logout</a></li>
    </ul>
    </div>
</nav>