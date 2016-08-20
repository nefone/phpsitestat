<?php
function Login($usetname) {
    if ($username == '') return false;
    
    
}


function LogOut() {
    
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