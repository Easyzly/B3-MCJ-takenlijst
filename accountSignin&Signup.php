<!doctype html>
<html lang="nl">
<?php session_start(); ?>

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
    <?php
    if (isset($_SESSION['id'])) {
        $idChecker = $_SESSION['id'];

        require_once("backend/conn.php");
        $query = "SELECT * FROM users WHERE id=:id";
        $statement = $conn->prepare($query);
        $statement->execute([":id" => $idChecker]);

        header("Location: userPage.php");

        $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
        $username = $userAccount['username'];
    } else {
        if (isset($_GET['msg'])) {
            echo ($_GET['msg']);
        }
        ;

        $username = null;
    }
    ?>
</head>

<?php
if ($_GET['status'] == null or !isset($_GET['status'])) {
    header("Location: accountSignin&Signup.php?status=Signin");
} else {
    $status = $_GET['status'];
}
?>

<!-- Main forms -->

<?php if ($status == "username already exists") {
    echo ($status);
} ?>

<body>
    <header>
        <?php require_once("header.php"); ?>
    </header>

    <main>
        <div class="background">
            <!-- Login form -->
            <?php if ($status == "Signin" or $status == "username already exists"): ?>
                <form action="backend/accountController.php" method="post">
                    <div class="form-container">
                        <input type="hidden" name="action" value="Signin">
                        <div class="form-group">
                            <label for="username">Gebruikersnaam: </label>
                            <input type="text" name="username" id="username" value="<?php echo ($username) ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Wachtwoord: </label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <input class="input" type="submit" value="Log in">
                            <a href="accountSignin&Signup.php?status=Signup">I don't have an account</a>
                        </div>
                    </div>
                </form>
            <?php endif ?>

            <!-- Signup form -->
            <?php if ($status == "Signup"): ?>
                <form action="backend\accountController.php" method="post">
                    <div class="form-container">
                        <input type="hidden" name="action" value="Signup">
                        <div class="form-group">
                            <label for="name">Naam: </label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="username">Gebruikersnaam: </label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Wachtwoord: </label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <input class="input" type="submit" value="Sign up">
                            <a href="accountSignin&Signup.php?status=Signin">I already have an account</a>
                        </div>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </main>


    <footer>
        <?php require_once("footer.php"); ?>
    </footer>
</body>

</html>