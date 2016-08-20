<?php
//перенаправляем на index.php если пользователь хочет открыть func.php
if (preg_match("/func.php/", $_SERVER['PHP_SELF'])){
    header("location: ../index.php");
    die();
}


$fileName="stat.txt"; //имя файла со статистикой
$maxVisitors=30; //количество отоброжаемых записей

//функция показа статистики
function showStat()
{
    global $fileName;
    //открываю файл и вывожу начало таблицы
    $fbase = file($fileName);
    $fbase = array_reverse($fbase);
    $count = sizeOf($fbase);
    echo "Всего посещений: $count<br><br>";
    echo "<table><tr class=\"heads\"><td>Браузер</td><td>IP</td><td>Хост</td><td>Ссылка</td><td>Страница</td><td>Время визита</td></tr>";
    //запускаю цикл выводы статистики
    for ($i=0; $i<100; $i++)
    {
        if ($i>=sizeof($fbase)) {break;}
        $s=$fbase[$i];
        //разделяю
        $strr=explode("::", $s);
        if (empty($strr)) {break;}
        //вывожу данные
        echo "<tr class=\"counters\"><td>$strr[0]</td><td><a href=\"who.php?ip=$strr[1]\">$strr[1]</a></td><td>$strr[2]</td><td>$strr[3]</td><td>$strr[4]</td><td>$strr[5]</td></tr>";
    }
    echo "</table>";
}

//функция whois для показа инфо об IP 
function whoIp($ip)
{
	if (!preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $ip))
	{
		echo "Format IP is bad!";
 		return;
	} 
	$sock = fsockopen("whois.ripe.net", 43, $errno, $errstr);
	echo("<b>Info about IP: ".$ip."</b><br>");
	if (!$sock)
	{
		echo("$errno ($errstr)");
		return;
    }
    else
    {
		fputs($sock, $ip."\r\n");
		while(!feof($sock))
		{
			echo(str_replace(":",":&nbsp;&nbsp;", fgets($sock, 128))."<br>");
		}
		
	}
	fclose($sock);
}