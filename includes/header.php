<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
   <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<header>
    <nav id="main-nav">
        <a href="index.php">
            <img src="assets/images/logo.png" alt="GameVault Logo" class="logo">
        </a>

        <ul class="nav-menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="index.php?genre=Action">Action</a></li>
    <li><a href="index.php?genre=RPG">RPG</a></li>
    <li><a href="index.php?genre=Sports">Sports</a></li>
    <li><a href="index.php?genre=Horror">Horror</a></li>

    <?php if (isset($_SESSION["user_id"])): ?>
        <li><a href="account.php">My Account</a></li>
        <li><a href="favorites.php">Favorites</a></li>
        <li><span class="welcome-badge">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span></li>
        <li><a href="logout.php" class="logout-link">Logout</a></li>
    <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    <?php endif; ?>
</ul>
    </nav>
</header>

<main>

