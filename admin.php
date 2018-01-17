<?php

    session_start();

    if (!isset($_SESSION['signin']))
    {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>

    <?php
        echo "<p>Witaj w kreatorze tworenia uzytowników ".$_SESSION['login'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>'."</br></br>";
    ?>

    <p>Idz do tworzenia nowego użytkownika. [ <a href='userCreator.php'>Kreator użytkownika!</a> ]</p>
    <p>Idz do tworzenia nowego testu. [ <a href='testCreator.php'>Test Kreator!</a> ]</p>



</body>
</html>