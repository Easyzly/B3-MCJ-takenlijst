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
            }
        ?>
</head>
<body>
    <main>
        <div class="background">
            <header>
                <a href="index.html" class="heartbeatLogo">Developerland</a>
                <?php require_once("header.php"); ?>
                <img class="accountLogo" src="img/accountlogo.png" width="50" alt="accountLogo">
            </header>
            
            <img class="devLandLogo" class="imageButtons" src="img/logo-big-v3.png" alt="devLandLogo">
        </div>
        <div class="imageButtons">
            <div class="imageButton">
                
            </div>
        </div>

        


    </main>
    <footer>

    </footer>
</body>
</html>
