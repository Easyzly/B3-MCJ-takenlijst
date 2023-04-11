<?php
    session_start();
    
    if(!isset($_POST['action'])){
        header("Location: ../accountSignin&Signup.php");
    }
    else{
        $action = $_POST['action'];
    }

    if($action == "Signin"){
        if(isset($_POST['username'])){ $username = $_POST['username']; } else{ header("Location: ../accountSignin&Signup.php?msg=no username assigned"); }
        if(isset($_POST['password'])){ $password = $_POST['password']; } else{ header("Location: ../accountSignin&Signup.php?msg=no password assigned"); }

        require_once("conn.php");
        $query = "SELECT * FROM users WHERE username=:username";
        $statement = $conn->prepare($query);
        $statement->execute([ ":username" => $username]);
        $userAccount = $statement->fetch(PDO::FETCH_ASSOC);

        if($userAccount && password_verify($password,$userAccount['password'])){
            $_SESSION['id'] = $userAccount['id'];
            header("Location: ../userPage.php");
        }
        else{
            session_abort();
            header("Location: ../accountSignin&Signup.php?msg=wrong password!");
        }
    }

    if($action == "Logout"){
        if(isset($_SESSION['id'])){
            session_unset();
            session_destroy();
            header("Location: ../index.php?msg=Logout succes");
        }
        else{
            header("Location: ../accountSignin&Signup.php?msg=You must be logged in");
        }
    }

    if($action == "Signup"){
        if(isset($_POST['username'])){ $username = $_POST['username']; } else{ header("Location: ../accountSignin&Signup.php?msg=no username assigned"); }
        if(isset($_POST['name'])){ $name = $_POST['name']; } else{ header("Location: ../accountSignin&Signup.php?msg=no name assigned"); }
        if(isset($_POST['password'])){ $password = $_POST['password']; } else{ header("Location: ../accountSignin&Signup.php?msg=no password assigned"); }

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        require_once("conn.php");

        // Check if username already exists
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $statement = $conn->prepare($query);
        $statement->execute([":username" => $username]);
        if ($statement->fetchColumn() > 0) {
            header("Location: ../accountSignin&Signup.php?status=username already exists");
            exit();
        }
        
        // Insert new account
        $query = "INSERT INTO users(naam,password,username) VALUES(:naam,:password,:username)";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":naam" => $name,
            ":password" => $hashedpassword,
            ":username" => $username
        ]);
        
        header("Location: ../userPage.php");
    }
    
?>