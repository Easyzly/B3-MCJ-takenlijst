<!doctype html>
<html lang="nl">
<?php session_start(); ?>
<head>
    <title></title>
    <?php require_once 'head.php'; ?>
    <?php 
        if(isset($_SESSION['id'])){
            $idChecker = $_SESSION['id'];

            require_once("backend/conn.php");
            $query = "SELECT * FROM users WHERE id=:id";
            $statement = $conn->prepare($query);
            $statement->execute([ ":id" => $idChecker]);

            header("Location: userPage.php");
    
            $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
            $username = $userAccount['username'];
        }
        else{
            if(isset($_GET['msg'])) { echo($_GET['msg']); };
            
            $username = null;
        }
    ?>
</head>

<?php      
    if($_GET['status'] == null or !isset($_GET['status'])){
        header("Location: accountSignin&Signup.php?status=Signin");
    }
    else{
        $status = $_GET['status'];
    }
?>

<!-- Main forms -->

<body>
    <main>
    <?php if($status == "Signin"): ?>
        <form action="backend/accountController.php" method="post">
            <input type="hidden" name="action" value="Signin">
            <div class="form-group">
                <label for="username">username: </label>
                <input type="text" name="username" id="username" value="<?php echo($username) ?>">
            </div>
            <div class="form-group">
                <label for="password">password: </label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" value="login">
        </form>
        <a href="accountSignin&Signup.php?status=Signup">I dont have an account yet</a>
    <?php endif ?>

    <?php if($status == "Signup"): ?>
        <form action="backend/accountController.php" method="post">
            <input type="hidden" name="action" value="Signup">
            <div class="form-group">
                <label for="name">naam: </label>
                <input type="text" name="naam" id="naam">
            </div>
            <div class="form-group">
                <label for="username">username: </label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">password: </label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" value="signup">
        </form>

        <a href="accountSignin&Signup.php?status=Signin">I already have an account</a>
    <?php endif ?>




    </main>

    <footer>
        <?php require_once("footer.php"); ?>
    </footer>
</body>
</html>
