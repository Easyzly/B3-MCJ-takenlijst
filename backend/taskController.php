<?php

    $action = $_POST['action'];

    if( $action == "create"){

        $titel = $_POST['titel'];
        $discription = $_POST['discription'];
        $department = $_POST['department'];
        $deadline = $_POST['deadline'];
        $username = $_POST['username'];
        $color = $_POST['color'];

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

        if(empty($deadline)){
            header("Location: ../task/create.php?msg=Geen afdeling opgegeven");
            die();
        }

        if(empty($color)){
            header("Location: ../task/create.php?msg=Geen kleur gekozen");
        }

        $titel = strip_tags($titel);
        $discription = strip_tags($discription);
        $department = strip_tags($department);
        $deadline = strip_tags($deadline);
        $username = strip_tags($username);
        $color = strip_tags($color);

        require_once("conn.php");
        $query = "INSERT INTO taken(titel, beschrijving, afdeling,deadline,user,kleur) VALUES (:titel, :beschrijving, :afdeling,:deadline,:user,:color)";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":titel" => $titel,
            ":beschrijving" => $discription,
            ":afdeling" => $department,
            ":deadline" => $deadline,
            ":user" => $username,
            ":color" => $color
        ]);

        header("Location: ../task/index.php");
    }
    elseif($action == "edit"){
        $title = $_POST['titel'];
        $discription = $_POST['discription'];
        $status = $_POST['status'];
        $id = $_POST['id'];
        $department = $_POST['department'];
        $deadline = $_POST['deadline'];
        $user = $_POST['user'];
        $color = $_POST['color'];

        $titel = strip_tags($titel);
        $discription = strip_tags($discription);
        $status = strip_tags($status);
        $id = strip_tags($id);
        $department = strip_tags($department);
        $deadline = strip_tags($deadline);
        $user = strip_tags($user);
        $color = strip_tags($color);

        require_once("conn.php");
        $query = "UPDATE taken SET titel = :titel, afdeling = :afdeling, status = :status, beschrijving = :beschrijving, deadline = :deadline, user = :user, kleur = :color WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":titel" => $title,
            ":beschrijving" => $discription,
            ":status" => $status,
            ":id" => $id,
            ":afdeling" => $department,
            ":deadline" => $deadline,
            ":user" => $user,
            ":color" => $color
        ]);
        header("Location: ../task/index.php");

    }
    elseif($action == "delete"){
        $id = $_POST['id'];

        require_once("conn.php");
        $query = "DELETE FROM taken WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([ ":id" => $id]);

        header("Location: ../task/index.php");
    }
?>