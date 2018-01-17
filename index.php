<?php

    session_start();

    if (isset($_SESSION['signin']) && $_SESSION['signin']==true && isset($_SESSION['rights']) && $_SESSION['rights'] == 2)
    {
        header('Location: main.php');
        exit();
    }
    elseif (isset($_SESSION['signin']) && $_SESSION['signin']==true && isset($_SESSION['rights']) && $_SESSION['rights'] == 0)
    {
        header('Location: admin.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> <!-- obsługa ie jakby to było komu potrzebne-->
    <title>PAI</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <input type="text" name="login" placeholder="Login" required="required" />
            <input type="password" name="password" placeholder="Hasło" required="required" />

            <button type="submit" class="btn btn-primary btn-block btn-large">Zaloguj</button>
        </form>
        <?php
            if(isset($_SESSION['error']))    echo $_SESSION['error']; unset($_SESSION['error']);
        ?>
    </div>
</body>
</html>