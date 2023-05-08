<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
session_start();
if (isset($_SESSION['id'])) {
    $idChecker = $_SESSION['id'];

    require_once("backend/conn.php");
    $query = "SELECT * FROM users WHERE id=:id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $idChecker]);

    $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: accountSignin&Signup.php?msg=U bent nog niet ingelogd");
}
?>

<body>
    <div class="background">
        <div class="background-gradient">
            <header>
                <?php require_once('header.php') ?>
            </header>

            <div class="container">
                <p>Selecteer een afdeling:</p><br>

                <!-- Afdeling selector  -->
                <div class="department-buttons">
                    <a href="userPage.php?afdeling=Horeca">Horeca</a>
                    <a href="userPage.php?afdeling=Personeel">Personeel</a>
                    <a href="userPage.php?afdeling=Techniek">Techniek</a>
                    <a href="userPage.php?afdeling=Inkoop">Inkoop</a>
                    <a href="userPage.php?afdeling=Klantenservice">Klantenservice</a>
                    <a href="userPage.php?afdeling=Groen">Groen</a>
                    <a href="userPage.php?afdeling=noFilter">Alle</a>
                    <a href="userPage.php?afdeling=User">Persoonlijke taken</a>
                </div><br>

                <!-- Afdeling checker -->
                <?php
                    if ($_GET['afdeling'] == null or !isset($_GET['afdeling'])) {
                        header("Location: userPage.php?afdeling=Horeca");
                    }
                    elseif ($_GET['afdeling'] == "noFilter") {
                        require_once("backend/conn.php");
                        $query = "SELECT * FROM taken ORDER BY deadline";
                        $statement = $conn->prepare($query);
                        $statement->execute();

                        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                    } 
                    elseif ($_GET['afdeling'] == "User") {
                        require_once("backend/conn.php");
                        $query = "SELECT * FROM taken WHERE user = :user ORDER BY deadline";
                        $statement = $conn->prepare($query);
                        $statement->execute([":user" => $userAccount['naam']]);

                        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                    } 
                    else {
                        $afdeling = $_GET['afdeling'];

                        require_once("backend/conn.php");
                        $query = "SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY deadline";
                        $statement = $conn->prepare($query);
                        $statement->execute([":afdeling" => $afdeling]);

                        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                    }
                ?>

                <!-- Table for displaying tasks -->
                <?php if (count($tasks) > 0): ?>
                    <table>
                        <tr>
                            <th>Titel</th>
                            <th>Afdeling</th>
                            <th>Status</th>
                            <th>deadline</th>
                            <th>Gebruiker</th>
                            <th>Edit</th>
                        </tr>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td>
                                    <?php echo ($task['titel']) ?>
                                </td>
                                <td>
                                    <?php echo ($task['afdeling']) ?>
                                </td>
                                <td>
                                    <?php echo ($task['status']) ?>
                                </td>
                                <td>
                                    <?php echo ($task['deadline']) ?>
                                </td>
                                <td>
                                    <?php echo ($task['user']) ?>
                                </td>
                                <td><a href="task/edit.php?id=<?php echo $task['id'] ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php else: ?>
                    <p>Je hebt geen taken voor deze afdeling.</p>
                <?php endif ?>

                <!-- User settings and details -->
                <form action="backend/accountController.php" method="post">
                    <input type="hidden" name="action" value="Logout">
                    <input type="submit" value="logout">
                </form>
            </div>

            <footer>
                <?php require_once('footer.php') ?>
            </footer>
        </div>
    </div>
</body>

</html>