<?php
require_once("backend/config.php");
?>

<a class="HeartbeatLogo" href="<?php echo $base_url ?>/index.php">Developerland</a>

<nav>
    <a href="<?php echo $base_url ?>/index.php">Home</a>
    <a href="<?php echo $base_url ?>/task/index.php">Taken</a>
</nav>

<?php if (empty($_SESSION['id'])): ?>
    <div class="LoginStyling">
        <p><a href="accountSignin&Signup.php?status=Signin">Login</a> / <a href="accountSignin&Signup.php?status=Signup">Signup</a></p>
    </div>

<?php endif ?>

<?php if (isset($_SESSION['id'])): ?>
    <a href="<?php echo $base_url ?>/userPage.php"><img src="<?php echo $base_url; ?>/img/accountlogo.png" width="50"
            alt="account logo"></a>
<?php endif ?>