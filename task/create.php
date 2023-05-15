<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../head.php'; ?>
    <?php require_once("protection.php"); ?>
    <title>Create</title>
</head>


<body>
    <header>
        <?php require_once("../header.php"); ?>
    </header>
    <main>
        <!-- Header -->
        <div class="background">
            <div class="background-gradient">


                <div class="subHeader">
                    <a href="create.php">Aanmaken</a>
                    <a href="done.php">Klaar</a>
                    <a href="afdeling.php">Afdeling</a>
                </div>

                <!-- create form -->
                <form action="../backend/taskController.php" method="post">
                    <div class="form-container">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="username" value="<?php echo ($userAccount['id']) ?>">
                        <div class="form-group">
                            <label for="title">Titel: </label>
                            <input type="text" name="titel" id="titel">
                        </div>
                        <div class="form-group">
                            <label for="discription">Beschrijving: </label>
                            <input type="text" name="discription" id="discription">
                        </div>
                        <div class="form-group">
                            <label for="department">Afdeling: </label>
                            <select name="department" id="department">
                                <option value="Horeca">Horeca</option>
                                <option value="Personeel">Personeel</option>
                                <option value="Techniek">Techniek</option>
                                <option value="Inkoop">Inkoop</option>
                                <option value="Klantenservice">Klantenservice</option>
                                <option value="Groen">Groen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="color">Kleur: </label>
                            <select name="color" id="color">
                                <option value="Groen">Groen</option>
                                <option value="Rood">Rood</option>
                                <option value="Paars">Paars</option>
                                <option value="Roze">Roze</option>
                                <option value="Blauw">Blauw</option>
                                <option value="Oranje">Oranje</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Deadline: </label>
                            <input type="date" name="deadline" id="deadline">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Aanmaken">
                        </div>
                    </div>
                </form>
            </div>
    </main>

    <footer>
        <?php require_once('../footer.php') ?>
    </footer>
</body>

</html>