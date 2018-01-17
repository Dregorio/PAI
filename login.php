<?php

    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password']))){
        header('Location: index.php');
        exit();
    }

    require_once "connectionInfo.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name); //@ wyciszenie php nie rzuca bledem na ekran

    if ($conn->connect_errno != 0){
        echo "Error: ".$conn->connect_errno." Opis: ".$conn->connect_error;
    }
    else{
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        //$password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if ($result = @$conn->query(
            sprintf("SELECT u.login, u.password, r.type FROM user u
                            INNER JOIN rights r ON u.id_rights = r.id_rights
                            AND u.login='%s'",
            mysqli_real_escape_string($conn,$login))))
        {
            $how_many_users = $result->num_rows;
            if ($how_many_users > 0){

                $row = $result->fetch_assoc();

                if (password_verify($password, $row['password'])){
                    $_SESSION['signin'] = true;
                    $_SESSION['rights'] = $row['type'];

                    $_SESSION['login'] = $row['login'];

                    unset($_SESSION['error']);
                    if ($row['rights'] == 0) {
                        header('Location: admin.php');
                    }
                    else{
                        header('Location: main.php');
                    }
                } else {
                    $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php');
                }

                $result->close();
            }
            else{
                $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }

        $conn->close();
    }




