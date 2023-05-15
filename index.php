<!doctype html>
<html lang="nl">
<?php session_start(); ?>
<div id="headerLocation"></div>

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
    <?php
    if (isset($_SESSION['id'])) {
        $idChecker = $_SESSION['id'];

        require_once("backend/conn.php");
        $query = "SELECT * FROM users WHERE id=:id";
        $statement = $conn->prepare($query);
        $statement->execute([":id" => $idChecker]);

        $userAccount = $statement->fetch(PDO::FETCH_ASSOC);
    }
    ?>
</head>



<body>
    <header>
        <?php require_once("header.php"); ?>
    </header>


    <main>
        <div class="background">
            <img class="logo" src="img/logo-big-v3.png" alt="devLandLogo">
            <!-- Widget group -->
            <div class="WidgetBlock">
                <h2>Aankondigingen</h2>
                <p>"Maak je leven gemakkelijker met onze nieuwe takenlijst website! Of je nu op zoek bent naar een
                    betere manier om je dagelijkse taken te beheren of om je werk beter te organiseren, onze
                    takenlijst website biedt de oplossing die je nodig hebt.</p>
            </div>
            <div class="WidgetBlock">
                <h2>Over ons</h2>
                <p>Developerland is opgericht door een team van gepassioneerde technologieliefhebbers met als doel
                    een uniek pretpark te creëren dat gericht is op het verkennen en ervaren van de nieuwste
                    technologische innovaties.</p>
                <p>Onze medewerkers zijn allemaal experts op hun gebied en zijn gepassioneerd over het delen van hun
                    kennis en enthousiasme met anderen. We bieden educatieve workshops en presentaties aan om
                    bezoekers te informeren over de nieuwste trends en ontwikkelingen op het gebied van technologie,
                    zodat ze geïnspireerd kunnen worden om hun eigen creativiteit en innovatie te verkennen.</p>
            </div>
            <div class="WidgetBlock imgtype">
                <h2>Het Team</h2>
            </div>
            <br>
        </div>
    </main>

    <footer>
        <?php require_once("footer.php") ?>
    </footer>
</body>

</html>