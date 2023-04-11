<?php 

$id = $_GET['id'];
require_once("conn.php");
        $query = "UPDATE taken SET status = :status WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":status" => 'done',
            ":id" => $id
        ]);
        header("Location: ../task/done.php");

?>