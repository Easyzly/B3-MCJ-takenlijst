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
    <main>
        <div class="background">
            <div class="background-gradient">
                <header>
                    <?php require_once("header.php"); ?>
                </header>
                <img class="logo" src="img/logo-big-v3.png" alt="devLandLogo">
                <!-- Widget group -->
                <div class="WidgetBlock">
                    <h2>Aankondigingen</h2>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem facere impedit, provident
                        architecto aperiam velit harum repellat accusamus, cupiditate eum quasi explicabo voluptate
                        mollitia, minima sunt numquam! Aliquam, a magnam.</p>
                </div>
                <br>
                <div class="WidgetBlock">
                    <h2>Over ons</h2>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem facere impedit, provident
                        architecto aperiam velit harum repellat accusamus, cupiditate eum quasi explicabo voluptate
                        mollitia, minima sunt numquam! Aliquam, a magnam.</p>
                </div>
                <br>
                <div class="WidgetBlock imgtype">
                    <h2>Het Team</h2>
                </div>
                <br>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once("footer.php") ?>
    </footer>
</body>

</html>