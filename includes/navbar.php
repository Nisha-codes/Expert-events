<?php
$user_logged_in  = isset($_SESSION['auth_user']);
$admin_logged_in  = isset($_SESSION['auth_admin']);
$current_file_name = $_SERVER['PHP_SELF'];
$on_this_page = $current_file_name === '/users/users-dashboard.php';

?>
<header class="header">
    <a href="../index.php" class="logo">
        <em>Expert Events</em>
    </a>
    <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a class="main-nav-link" href="../packages.php">Packages</a></li>
            <?php
            if (!$user_logged_in && !$admin_logged_in){
                ?>
                <li><a class="main-nav-link" href="../auth/users/signup.php">Create Account</a></li>
                <li>
                    <a class="main-nav-link" href="../auth/users/signin.php">Log in</a>
                </li>
            <?php }?>
            <li><a class="main-nav-link" href="#sub">Contact Us</a></li>
            <?php
            if ($user_logged_in && !$on_this_page){
                ?>
                <li><a class="main-nav-link" href="../users/users-dashboard.php">Dashboard</a></li>
            <?php }?>
            <?php
            if (!$user_logged_in && $admin_logged_in &&  $_SERVER['PHP_SELF']!== '/admins/admin-dashboard.php'){
                ?>
                <li><a class="main-nav-link" href="../admins/admin-dashboard.php">Dashboard</a></li>
            <?php }?>
            <?php
            if ($user_logged_in && !$admin_logged_in){
                ?>
                <li><a class="main-nav-link" href="../auth/users/signout.php">Logout</a></li>
            <?php }?>
            <?php
            if (!$user_logged_in && $admin_logged_in){
            ?>
            <li><a class="main-nav-link" href="../auth/admins/signout.php">Logout</a></li>
            <?php }?>

        </ul>
    </nav>
</header>

