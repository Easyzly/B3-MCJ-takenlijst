<!doctype html>
<html lang="nl">
<?php session_start(); ?>
<div id="headerLocation"></div>
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
            <div class="background-gradient">
                <header>
                    <?php require_once("header.php"); ?>
                </header>
                <img class="logo" src="img/logo-big-v3.png" alt="devLandLogo">
            </div>
        </div>

    </div>

    <div class="h2Title">
        <h2>Over ons</h2>
    </div>
    <div class="announcements-wrapper">
        <div class="announcements">
            <div class="announcementsPic">
                <img src="img/teamPic.jpg" alt="teamPic">
            </div>
            <div class="announcementsText">
                <h3>voorbeeld aankondiging</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora numquam in quo cumque, fuga sint
                    iste, veritatis neque ipsa impedit commodi maiores, enim dolorum nesciunt tempore vitae molestias
                    est exercitationem!</p>
            </div>
        </div>
    </div>
    <br>

    <footer>
        <?php require_once("footer.php") ?>
    </footer>
</body>
</html>
