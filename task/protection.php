<?php
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