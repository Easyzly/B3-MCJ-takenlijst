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
    
            $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
            echo($userAccount['username']);

            $username = $userAccount['username'];
        }
        else{
            echo($_GET['msg']);
            $username = null;
        }
    ?>
</head>

<!-- Main forms -->
<body>
    <main>
        <form action="backend/accountController.php" method="post">
            <input type="hidden" name="action" value="Signin">
            <div class="form-group">
                <label for="username">username: </label>
                <input type="text" name="username" id="username" value="<?php echo($username) ?>">
            </div>
            <div class="form-group">
                <label for="password">password: </label>
                <input type="text" name="password" id="password">
            </div>
            <input type="submit" value="login">
        </form>

        <form action="backend/accountController.php" method="post">
            <input type="hidden" name="action" value="Logout">
            <input type="submit" value="logout">
        </form>

    </main>

    <footer>
        <?php require_once("footer.php"); ?>
    </footer>
</body>
</html>
