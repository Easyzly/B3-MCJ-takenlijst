<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../head.php'; ?>
    <?php require_once("protection.php"); ?>
    <title>Tasks</title>
</head>

<body>
    <header>
        <?php require_once("../header.php"); ?>
    </header>

    <main>
        <div class="background">

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
        </div>
    </main>

    <footer>
        <?php require_once('../footer.php'); ?>
    </footer>
</body>

</html>