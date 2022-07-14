<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<nav>
    <a href="index.php">Home</a>
    <ul>
        <li><a href="cart.php">Cart</a></li>
        <?php if(isset($_SESSION['user'])): ?>
        <li><a href="logout.php"><?php echo $_SESSION['user']['name'];?>(Logout)</a></li>
        <?php else: ?>
        <li><a href="login.php">login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>