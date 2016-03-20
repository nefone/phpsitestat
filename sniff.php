<?php
//перенаправляем на index.php если пользователь хочет открыть sniff.php
if (preg_match("/sniff.php/", $_SERVER['PHP_SELF'])){
    header("location: index.php");
    die();
}

function saveUserData(){
    $curTime=date("d.m.Y @ H.m.s"); //текущее время и дата
    //подготавливаем данные для записи
    if (empty($_SERVER['HTTP_USER_AGENT'])){$_SERVER['HTTP_USER_AGENT']="Unknown";}
    if (empty($_SERVER['REMOTE_ADDR'])){$_SERVER['REMOTE_ADDR']="Not Resolved";}
    if (empty($_SERVER['REMOTE_HOST'])){$_SERVER['REMOTE_HOST']="Unknown";}
    if (empty($_SERVER['HTTP_REFERER'])){$_SERVER['HTTP_REFERER']="No Referer";}
    if (empty($_SERVER['REQUEST_URI'])){$_SERVER['REQUEST_URI']="Unknown";}

    $data_ = $_SERVER['HTTP_USER_AGENT']."::".$_SERVER['REMOTE_ADDR']."::".$_SERVER['REMOTE_HOST']."::".$_SERVER['HTTP_REFERER']."::".$_SERVER['REQUEST_URI']."::".$curTime."\r\n";
    //разделителем будут два ":"
    //далее записываем данные в файл
    if (file_exists("showstat/stat.txt")){
        $f=fopen("showstat/stat.txt", "a+t");
        fputs($f, $data_);
        fclose($f);
    }
}
?>
