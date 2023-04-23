<nav class="nav">
    <img class="logo" src="assets/LOGO - Davao Fresh.svg"></img>
    <ul style="display: inline-block;">
        <li class="<?php echo ($active_tab == 'home') ? 'active' : ''; ?>"><a href="home.php"> Home </a></li>
        <li class="<?php echo ($active_tab == 'products') ? 'active' : ''; ?>"><a href=" products.php"> Products </a></li>
        <li class="<?php echo ($active_tab == 'about') ? 'active' : ''; ?>"><a href="about.php"> About Us</a></li>

    </ul>
    <?php if (isset($_SESSION['email'])) : ?>
        <select id="home-dropdown" style="height: 24px; border: none; font-size: 1rem; outline: none;">
            <option value="" selected disabled hidden>
                <?php
                $email = $_SESSION['email'];
                getDataBySession('acc_name', $conn, $email);
                ?></option>
            <option value="basket">My Basket</option>
            <option value="history">Order History</option>
            <option value="settings">Settings</option>
            <option value="logout">Logout</option>
        </select>
        <?php echo "</ul>" ?>
    <?php else : ?>
        <ul>
            <li><a href="login.php">Login</a></li>
        </ul>
    <?php endif; ?>
</nav>

<script>
    const selectElement = document.querySelector('#home-dropdown');
    selectElement.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        if (selectedValue === 'logout') {
            window.location.href = 'logout.php';
        } else if (selectedValue === 'basket') {
            window.location.href = 'basket.php';
        }
    });
</script>