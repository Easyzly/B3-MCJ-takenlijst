<?php

    $action = $_POST['action'];

    if( $action == "create"){

        $titel = $_POST['titel'];
        $discription = $_POST['discription'];
        $department = $_POST['department'];

        // Check for empty inputs
        if(empty($titel)){
            header("Location: ../task/create.php?msg=Geen titel opgegeven");
            die();
        }
        
        if(empty($discription)){
            header("Location: ../task/create.php?msg=Geen beschrijving opgegeven");
            die();
        }

        if(empty($department)){
            header("Location: ../task/create.php?msg=Geen afdeling opgegeven");
            die();
        }

        require_once("conn.php");
        $query = "INSERT INTO taken(titel, beschrijving, afdeling) VALUES (:titel, :beschrijving, :afdeling)";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":titel" => $titel,
            ":beschrijving" => $discription,
            ":afdeling" => $department
        ]);

        header("Location: ../task/index.php");
    }
?>