<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>`

<header class="header">
    <div class="flex">
    <a href="admin_page.php" class="logo"><?php echo (getenv('STORE_NAME') ?: 'MerchHub'); ?><span> Admin</span></a>

        <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_products.php">products</a>
            <a href="admin_orders.php">orders</a>
            <a href="admin_users.php">users</a>
            <a href="admin_contacts.php">messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo htmlspecialchars($_SESSION['admin_name'], ENT_QUOTES, 'UTF-8'); ?></span></p>
            <p>email : <span><?php echo htmlspecialchars($_SESSION['admin_email'], ENT_QUOTES, 'UTF-8'); ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
            <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
        </div>
    </div>
</header>