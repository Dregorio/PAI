<?php

    session_start();

    if (!isset($_SESSION['signin']))
    {
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['click']) && $_POST['click'])
    {
        $everything_OK=true;

        $login = $_POST['login'];

        if ((strlen($login) < 3) || (strlen($login)>20))
        {
            $everything_OK=false;
            $_SESSION['e_login']="Login musi posiadć od 3 do 20 znaków!";
        }

        if (ctype_alnum($login) == false)
        {
            $everything_OK=false;
            $_SESSION['e_login']="Login może składać się tylko z liter i cyfr, nie używaj polskich znaków!";
        }

        $email = $_POST['email'];
        $emailF = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailF, FILTER_VALIDATE_EMAIL) == false) || ($emailF!=$email))
        {
            $everything_OK=false;
            $_SESSION['e_email']="Podaj poprawny adres email!";
        }

        $password1 = $_POST['password'];
        $password2 = $_POST['password2'];

        if ((strlen($password1)<8) || (strlen($password1)>20))
        {
            $everything_OK=false;
            $_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków!";
        }

        if ($password1!=$password2)
        {
            $everything_OK=false;
            $_SESSION['e_password']="Podane hasła różnią się!";
        }

        $hash_password = password_hash($password1, PASSWORD_DEFAULT);

        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $rights = $_POST['rights'];
        $role = $_POST['roles'];

        $street = $_POST['street'];
        $home_number = $_POST['home_number'];
        $flat_number = $_POST['flat_number'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
        $phone = $_POST['phone_number'];

        //Zapamietać wprwadzone dane
        $_SESSION['s_login'] = $login;
        $_SESSION['s_email'] = $email;
        $_SESSION['s_password1'] = $password1;
        $_SESSION['s_password2'] = $password2;

        require_once "connectionInfo.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $conn = @new mysqli($host, $db_user, $db_password, $db_name);

            if ($conn->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_error());
            }
            else
            {
                //czy mail istnieje?
                $result = $conn->query("SELECT u.id_user FROM user u WHERE u.email='$email'");

                if (!$result)
                    throw new Exception($conn->error);

                $how_many_emails = $result->num_rows;
                if ($how_many_emails>0)
                {
                    $everything_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego maila!";
                }

                //czy nick jest juz zarezerwowany
                $result = $conn->query("SELECT u.id_user FROM user u WHERE u.login='$login'");

                if(!$result)
                    throw new Exception($conn->error);

                $how_many_logins = $result->num_rows;
                if ($how_many_logins>0)
                {
                    $everything_OK=false;
                    $_SESSION['e_login']="Istnieje już użytkownik o takim loginie! Zmień go.";
                }

                if ($everything_OK==true)
                {
                    if ($conn->query("INSERT INTO address VALUES (NULL, $street, $home_number, $flat_number, $postal_code, $city)"))
                    {
                        $result = $conn->query("SELECT a.id_address FROM address a WHERE a.street='$street' AND a.home_number='$home_number' AND a.flat_number='$flat_number' AND a.postal_code='$postal_code' AND a.city='$city'");
                        $id_address = $result->fetch_field();

                        $id = $id_address['id_address'];

                        if ($conn->query("INSERT INTO user VALUES (NULL, $login, $password1, $f_name, $l_name,
                                          $id, $rights, $email, $phone, NULL, NULL, $role)"))
                        {
                            $_SESSION['register_complete'] = true;
                            header('Location: registerComplete.php');
                        }
                        else
                        {
                            $_SESSION['e_registration'] = "Nie udało się zarejestrować użytkownika";
                        }

                    }
                    else
                    {
                        throw new Exception($conn->error);
                    }
                }

                $conn->close();

            }
        }
        catch (Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Skontaktuj się z administratorem :P !</span>';
			echo '<br />Informacja developerska: '.$e;
        }


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

    <div class="userCreator">
        <h1>Kreator nowego użytkownika!</h1>

        <form action="userCreator.php" method="post">
            <input type="text" name="login" placeholder="Podaj login!" required="required" />
            <input type="password" name="password" placeholder="Podaj hasło!" required="required" />
            <input type="password" name="password2" placeholder="Powtórz hasło!" required="required" />
            <input type="text" name="f_name" placeholder="Podaj imię!" required="required" />
            <input type="text" name="l_name" placeholder="Podaj nazwisko!" required="required" />
            <input type="text" name="email" placeholder="Podaj e-mail!" required="required" />
            <input type="text" name="phone" placeholder="Podaj numer telefonu!" required="required" />
            <input type="text" name="city" placeholder="Podaj miasto!" required="required" />
            <input type="text" name="street" placeholder="Podaj adres zamieszkania!" required="required" />
            <input type="text" name="home_number" placeholder="Podaj numer domu!" required="required" />
            <input type="text" name="flat_number" placeholder="Podaj numer mieszkania!" />
            <input type="text" name="post_code" placeholder="Podaj kod pocztowy!" required="required" />

            <select name="rights">
                <option id="0" value="0">Admin</option>
                <option id="1" value="1">Moderator</option>
                <option id="2" value="2">Zwykły użytkownik</option>
            </select>

            <select name="roles">
                <option id="0" value="1">Nauczyciel</option>
                <option id="1" value="2">Uczeń</option>
            </select>
<p>

</p>
            <input type="text" name="group" placeholder="Podaj grupę ucznia" />
            <input type="text" name="academic_title" placeholder="Podaj tytuł akademicki!" />
<p>

</p>
            <button type="submit" name="click" class="btn btn-primary btn-block btn-large">Utwórz konto</button>
        </form>


    </div>

</body>
</html>

