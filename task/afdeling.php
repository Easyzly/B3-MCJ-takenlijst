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
                    <footer>
                        <?php require_once('../footer.php') ?>
                    </footer>
                <?php else: ?>
                    <p>Je hebt geen taken voor deze afdeling.</p>
                <?php endif ?>
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
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Gebruiker</th>
                    <th>Categorie</th>
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
                        <td>
                            <?php echo ($task['kleur']) ?>
                        </td>
                        <td><a href="edit.php?id=<?php echo $task['id'] ?>">Edit</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
            
            <footer>
                <?php require_once('../footer.php') ?>
            </footer>
        </div>
    </div>
</body>

</html>