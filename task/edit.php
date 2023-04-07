<head>
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
</head>


<?php 
    require_once("../backend/conn.php");

    $id = $_GET['id'];
    $query = "SELECT * FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
    $task = $statement->fetch(PDO::FETCH_ASSOC)
?>

    <!-- create form -->
    <form action="../backend/taskController.php" method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value=<?php echo($id) ?>>
        <div class="form-group">
            <label for="title">titel: </label>
            <input type="text" name="titel" id="titel" value="<?php echo($task['titel']); ?>">
        </div>
        <div class="form-group">
            <label for="department">afdeling: </label>
            <select name="department" id="department">
                <option value="<?php echo($task['afdeling']); ?>"><?php echo($task['afdeling']); ?></option>
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
            <input type="text" name="discription" id="discription" value="<?php echo($task['beschrijving']) ?>">
        </div>
        <div class="form-group">
            <label for="status">status: </label>
            <select name="status" id="status">
                <option value="<?php echo($task['status']); ?>"><?php echo($task['status']); ?></option>
                <option value="done">done</option>
                <option value="inprogress">inprogress</option>
                <option value="todo">todo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deadline">deadline: </label>
            <input type="date" name="deadline" id="deadline" value="<?php echo($task['deadline']); ?>">
        </div>        
        <input type="submit" value="edit">
    </form>

    <form action="../backend/taskController.php" method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value=<?php echo($id) ?>>
        <input type="submit" value="delete">
    </form>