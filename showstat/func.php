<?php
//перенаправляем на index.php если пользователь хочет открыть func.php
if (preg_match("/func.php/", $_SERVER['PHP_SELF'])){
    header("location: ../index.php");
    die();
}


$fileName="stat.txt"; //имя файла со статистикой
$maxVisitors=30; //количество отоброжаемых записей

function showStat () {
    global $fileName;
    //открываю файл и вывожу начало таблицы
    $fbase = file($fileName);
    $fbase = array_reverse($fbase);
    $count = sizeOf($fbase);
    echo "Всего посещений: $count<br><br>";
    echo "<table><tr class=\"heads\"><td>Браузер</td><td>IP</td><td>Хост</td><td>Ссылка</td><td>Страница</td><td>Время визита</td></tr>";
    //запускаю цикл выводы статистики
    for ($i=0; $i<100; $i++) {
        if ($i>=sizeof($fbase)) {break;}
        $s=$fbase[$i];
        //разделяю
        $strr=explode("::", $s);
        if (empty($strr)) {break;}
        //вывожу данные
        echo "<tr class=\"counters\"><td>$strr[0]</td><td>$strr[1]</td><td>$strr[2]</td><td>$strr[3]</td><td>$strr[4]</td><td>$strr[5]</td></tr>";
    }
    echo "</table>";
}

?>