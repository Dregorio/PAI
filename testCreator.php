<?php

    session_start();

    if (!isset($_SESSION['signin']))
    {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>PAI</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script type="text/javascript" src='js/script.js'> </script>
</head>
<body>
    <script>
        createTestSheet(5);
    </script>
</body>
</html>
