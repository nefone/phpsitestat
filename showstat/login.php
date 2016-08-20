<?php
session_start();

function Login($usetname) {
    if ($username == '') return false;
    
    $_SESSION['username'] = $username;
    
    if ($remember) {
        setcookie('username', $username, time() + 3600*24*7);
    }
    return true;
} 


function LogOut() {
    setcookie('usetname', '', time()-1);
    unset($_SESSION['username']);
}


if ($enter_stat) {
    Header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
</head>
    <body>
        <form method="POST">
            <input type="password" name="username">
            <input type="submit" value="Войти">
        </form>
    </body>
</html>