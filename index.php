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
            <div class="logoCont">
                <img class="imageButtons" src="img/logo-big-v3.png" alt="devLandLogo">
            </div>
        </div>

    </div>
    <div class="tripleImg">
        <div class="infoLink">
            <a href="info.php"><img src="img/infoLogo.jpg" alt="info" width="300" height="300"></a>
        </div>
        <div class="DevlandLink">
            <a href="#headerLocation"><img src="img/logo-big-v3.png" alt="bigLogo" width="300"></a>
        </div>
        <div class="TakenLink">
            <a href="taskPage.php"><img src="img/taskImg.jpg" alt="taskImg" width="300"></a>
        </div>
    </div>

    <hr>

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
    <div class="task-wrapper">
        <div class="taskText">
            
        </div>
        <div class="taskPic">

        </div>
    </div>

    <footer>
        <?php require_once("require_files/footer.php") ?>
    </footer>
</body>
</html>
