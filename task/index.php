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
        if(isset($_SESSION['id'])){
            $idChecker = $_SESSION['id'];

            require_once("../backend/conn.php");
            $query = "SELECT * FROM users WHERE id=:id";
            $statement = $conn->prepare($query);
            $statement->execute([ ":id" => $idChecker]);
    
            $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
            echo($userAccount['username']);
        }
        else{
            header("Location: ../accountSignin&Signup.php?msg=U bent nog niet ingelogd");
        }
    ?>
    
    <body>
        <?php require_once("../header.php"); ?>

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
                <th>deadline</th>
                <th>Gebruiker</th>
                <th>Edit</th>
            </tr>
            <?php foreach($tasks as $task): ?>
                <tr>
                    <td><?php echo($task['titel']) ?></td>
                    <td><?php echo($task['afdeling']) ?></td>
                    <td><?php echo($task['status']) ?></td>
                    <td><?php echo($task['deadline']) ?> </td>
                    <td><?php echo($task['user'])?></td>
                    <td><a href="edit.php?id=<?php echo $task['id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>


