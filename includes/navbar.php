<?php
$logged_in  = isset($_SESSION['auth_user']);
?>
<header class="header">
    <a href="#" class="logo">
        <em>Expert Events</em>
    </a>
    <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a class="main-nav-link" href="../packages.php">Packages</a></li>
            <?php
            if (!$logged_in){
                ?>
                <li><a class="main-nav-link" href="../signup.php">Create Account</a></li>
                <li>
                    <a class="main-nav-link" href="../signin.php">Log in</a>
                </li>
            <?php }?>
            <li><a class="main-nav-link" href="#sub">Contact Us</a></li>
            <?php
            if ($logged_in){
                ?>
                <li><a class="main-nav-link" href="../signout.php">Logout</a></li>
            <?php }?>

        </ul>
    </nav>
</header>

