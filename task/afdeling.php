<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../head.php'; ?>
    <?php require_once("protection.php"); ?>
    <title>Department</title>
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

            <div class="container">
                <div class="department-buttons">
                    <a href="afdeling.php?afdeling=Horeca">Horeca</a>
                    <a href="afdeling.php?afdeling=Personeel">Personeel</a>
                    <a href="afdeling.php?afdeling=Techniek">Techniek</a>
                    <a href="afdeling.php?afdeling=Inkoop">Inkoop</a>
                    <a href="afdeling.php?afdeling=Klantenservice">Klantenservice</a>
                    <a href="afdeling.php?afdeling=Groen">Groen</a>
                </div>

                <?php
                if ($_GET['afdeling'] == null or !isset($_GET['afdeling'])) {
                    header("Location: afdeling.php?afdeling=Horeca");
                } else {
                    $afdeling = $_GET['afdeling'];
                }

                ?>
                <?php
                require_once("../backend/conn.php");
                $query = "SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY deadline";
                $statement = $conn->prepare($query);
                $statement->execute([":afdeling" => $afdeling]);

                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <!-- Table for displaying tasks -->
                <?php if (count($tasks) > 0): ?>
                    <table>
                        <tr>
                            <th>Titel</th>
                            <th>Afdeling</th>
                            <th>Status</th>
                            <th>Deadline</th>
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
                                <td><a href="edit.php?id=<?php echo $task['id'] ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php else: ?>
                    <p>Je hebt geen taken voor deze afdeling.</p>
                <?php endif ?>
            </div>
    </main>
    <footer>
        <?php require_once('../footer.php') ?>
    </footer>
    </div>
</body>

</html>