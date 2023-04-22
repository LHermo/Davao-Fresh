<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background: #214D34; min-height: 870px;">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

        <!-- Si Logo -->
        <a href="adm_products.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline" style="margin: 20px 0px;"><img style="width: 180px;" src="assets/LOGO - Davao Fresh Dark.svg" alt=""></span>
        </a>
        <!-- Si Menu tabs -->
        <ul style="margin-top: 30px; width: 100%;" class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item w-100 change-when-hovered">
                <a href="adm_products.php" class="<?php echo ($active_tab == 'products') ? 'active' : ''; ?> nav-link d-flex align-items-center px-2 text-white">
                    <i class="material-icons text-white">inventory</i><span class="ms-1 d-none d-sm-inline" style="padding-left: 10px;">Products</span>
                </a>
            </li>
            <li class="w-100 change-when-hovered">
                <a href="adm_customers.php" class="<?php echo ($active_tab == 'customers') ? 'active' : ''; ?> nav-link px-2 d-flex align-items-center">
                    <i class="material-icons text-white">diversity_3</i><span class="ms-1 d-none d-sm-inline text-white " style="padding-left: 10px;">Customers</span></a>
            </li>
            <li class="w-100 change-when-hovered">
                <a href="adm_orders.php" class="<?php echo ($active_tab == 'orders') ? 'active' : ''; ?> nav-link px-2 d-flex align-items-center">
                    <i class="material-icons text-white">receipt_long</i><span class="ms-1 d-none d-sm-inline text-white" style="padding-left: 10px;">Orders</span>
                </a>
            </li>
        </ul>
        <hr>

        <!-- Si Logout -->
        <ul class="nav nav=pills flex-column w-100">
            <li class="text-align-middle change-when-hovered">
                <a href="logout.php" class="nav-link px-2 d-flex align-items-center">
                    <i class="material-icons text-white">logout</i><span class="ms-1 d-none d-sm-inline text-white" style="padding-left: 10px;">Logout</span>
                </a>
            </li>
            </li>
        </ul>
    </div>
</div>