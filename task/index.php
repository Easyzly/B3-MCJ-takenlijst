<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../head.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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

<body>
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

            <?php
            require_once("../backend/conn.php");
            $query = "SELECT * FROM taken WHERE status <> 'done' ORDER BY deadline";
            $statement = $conn->prepare($query);
            $statement->execute();

            $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <!-- Table for displaying tasks -->
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Gebruiker</th>
                    <th>Categorie</th>
                    <th>Edit</th>
                    <th>Done</th>
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
                        <td>
                            <?php echo ($task['kleur']) ?>
                        </td>
                        <td><a href="edit.php?id=<?php echo $task['id'] ?>">Edit</a></td>
                        <td><a href="../backend/doneController.php?id=<?php echo $task['id'] ?>">Done</a></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <footer>
                <?php require_once('../footer.php'); ?>
            </footer>
        </div>
    </div>
</body>

</html>