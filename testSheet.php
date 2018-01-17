<?php

session_start();

if ((!isset($_SESSION['signin'])) && (!$_SESSION['signin']==true))
{
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TestSheet</title>
</head>
<body>
    <h1>Kreator testu</h1>
    <form action="testCreator.php" method="post">
        <input type="text" name="login" placeholder="Login" required="required" />
        <input type="password" name="password" placeholder="Hasło" required="required" />
    
        <button type="submit" class="btn btn-primary btn-block btn-large">Zaloguj</button>
    </form>
</body>
</html>