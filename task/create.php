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
        if(isset($_SESSION['id'])){
            $idChecker = $_SESSION['id'];

            require_once("../backend/conn.php");
            $query = "SELECT * FROM users WHERE id=:id";
            $statement = $conn->prepare($query);
            $statement->execute([ ":id" => $idChecker]);
    
            $userAccount = $statement->fetch(PDO::FETCH_ASSOC);

        }
        else{
            header("Location: ../accountSignin&Signup.php?msg=U bent nog niet ingelogd");
        }
    ?>
</head>
<body>
    <!-- Header -->
    <?php require_once("../header.php"); ?>

    <!-- create form -->
    <form action="../backend/taskController.php" method="post">
        <input type="hidden" name="action" value="create">
        <input type="hidden" name="user" value="<?php echo($userAccount['id']) ?>">
        <div class="form-group">
            <label for="title">titel: </label>
            <input type="text" name="titel" id="titel">
        </div>
        <div class="form-group">
            <label for="department">afdeling: </label>
            <select name="department" id="department">
                <option value="Horeca">Horeca</option>
                <option value="Personeel">Personeel</option>
                <option value="Techniek">Techniek</option>
                <option value="Inkoop">Inkoop</option>
                <option value="Klantenservice">Klantenservice</option>
                <option value="Groen">Groen</option>
            </select>
        </div>
        <div class="from-group">
            <label for="discription">beschrijving: </label>
            <input type="text" name="discription" id="discription">
        </div>
        <div class="form-group">
            <label for="deadline">deadline: </label>
            <input type="date" name="deadline" id="deadline">
        </div>
        
        <input type="submit" value="submit">
    </form>


</body>
</html>

