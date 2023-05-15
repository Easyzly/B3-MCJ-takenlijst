

<head>
    <?php require_once '../head.php'; ?>
    <?php require_once("protection.php"); ?>
    <title>Edit</title>
</head>


<body>
    <header>
        <?php require_once("../header.php"); ?>
    </header>
    <main>
        <div class="background">


            <!-- create form -->
            <form action="../backend/taskController.php" method="post">
                <div class="form-container">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value=<?php echo ($id) ?>>
                    <div class="form-group">
                        <label for="title">Titel: </label>
                        <input type="text" name="titel" id="titel" value="<?php echo ($task['titel']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="department">Afdeling: </label>
                        <select name="department" id="department">
                            <option value="<?php echo ($task['afdeling']); ?>"><?php echo ($task['afdeling']); ?>
                            </option>
                            <option value="Horeca">Horeca</option>
                            <option value="Personeel">Personeel</option>
                            <option value="Techniek">Techniek</option>
                            <option value="Inkoop">Inkoop</option>
                            <option value="Klantenservice">Klantenservice</option>
                            <option value="Groen">Groen</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discription">Beschrijving: </label>
                        <input type="text" name="discription" id="discription"
                            value="<?php echo ($task['beschrijving']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status: </label>
                        <select name="status" id="status">
                            <option value="<?php echo ($task['status']); ?>"><?php echo ($task['status']); ?></option>
                            <option value="done">done</option>
                            <option value="inprogress">inprogress</option>
                            <option value="todo">todo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline: </label>
                        <input type="date" name="deadline" id="deadline" value="<?php echo ($task['deadline']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="user">User: </label>
                        <input type="text" name="user" id="user" value="<?php echo ($task['user']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="color">Kleur: </label>
                        <select name="color" id="color">
                            <option value="Groen" <?php if ($task['kleur'] == "Groen")
                                echo ('selected="selected"') ?>>
                                    Groen</option>
                                <option value="Rood" <?php if ($task['kleur'] == "Rood")
                                echo ('selected="selected"') ?>>Rood
                                </option>
                                <option value="Blauw" <?php if ($task['kleur'] == "Blauw")
                                echo ('selected="selected"') ?>>
                                    Blauw</option>
                                <option value="Paars" <?php if ($task['kleur'] == "Paars")
                                echo ('selected="selected"') ?>>
                                    Paars</option>
                                <option value="Roze" <?php if ($task['kleur'] == "Roze")
                                echo ('selected="selected"') ?>>Roze
                                </option>
                                <option value="Oranje" <?php if ($task['kleur'] == "Oranje")
                                echo ('selected="selected"') ?>>
                                    Oranje</option>
                            </select>
                        </div>
                    <?php print_r($task) ?>
                    <div class="form-group">
                        <input type="submit" value="Wijzigen">
                    </div>
                </div>
            </form>

            <form action="../backend/taskController.php" method="post">
                <div class="form-container">
                    <div class="form-group">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value=<?php echo ($id) ?>>
                        <input type="submit" value="delete">
                    </div>
                </div>
            </form>
        </div>
        </div>
    </main>

    <footer>
        <?php require_once('../footer.php') ?>
    </footer>
</body>