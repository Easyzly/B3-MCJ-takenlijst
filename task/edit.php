<head>
    <?php
    require_once('../head.php');
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

<?php
require_once("../backend/conn.php");

$id = $_GET['id'];
$query = "SELECT * FROM taken WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([":id" => $id]);
$task = $statement->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <div class="background">
        <div class="background-gradient">
            <header>
                <?php require_once("../header.php"); ?>
            </header>

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
    <footer>
        <?php require_once('../footer.php') ?>
    </footer>
</body>