<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../head.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start();
    if (isset($_SESSION['id'])) {
        $idChecker = $_SESSION['id'];

        require_once("../backend/conn.php");
        $query = "SELECT * FROM users WHERE id=:id";
        $statement = $conn->prepare($query);
        $statement->execute([":id" => $idChecker]);

        $userAccount = $statement->fetch(PDO::FETCH_ASSOC);

    } else {
        header("Location: ../accountSignin&Signup.php?msg=U bent nog niet ingelogd");
    }
    ?>
</head>

<body>
    <!-- Header -->
    <div class="background">
        <div class="background-gradient">
            <header>
                <?php require_once("../header.php"); ?>
            </header>

            <div class="subHeader">
                <a href="create.php">Aanmaken</a>
                <a href="done.php">Klaar</a>
                <a href="afdeling.php">Afdeling</a>
            </div>

            <!-- create form -->
            <form action="../backend/taskController.php" method="post">
                <div class="form-container">
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="username" value="<?php echo ($userAccount['naam']) ?>">
                    <div class="form-group">
                        <label for="title">Titel: </label>
                        <input type="text" name="titel" id="titel">
                    </div>
                    <div class="form-group">
                        <label for="discription">Beschrijving: </label>
                        <input type="text" name="discription" id="discription">
                    </div>
                    <div class="form-group">
                        <label for="department">Afdeling: </label>
                        <select name="department" id="department">
                            <option value="Horeca">Horeca</option>
                            <option value="Personeel">Personeel</option>
                            <option value="Techniek">Techniek</option>
                            <option value="Inkoop">Inkoop</option>
                            <option value="Klantenservice">Klantenservice</option>
                            <option value="Groen">Groen</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline: </label>
                        <input type="date" name="deadline" id="deadline">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Aanmaken">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <?php require_once('../footer.php') ?>
    </footer>
</body>
</html>