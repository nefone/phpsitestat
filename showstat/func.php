<?php
//перенаправляем на index.php если пользователь хочет открыть func.php
if (preg_match("/func.php/", $_SERVER['PHP_SELF'])){
    header("location: ../index.php");
    die();
}

//функция показа статистики
function showStat()
{    
    $link = mysqli_connect("localhost", "root", "", "site_stat");
    
    if(!$link){
		echo "Не удалось подкллючиться к БД : (" . mysqli_connect_errno() . ")";
		exit();
	}
	
	$result = mysqli_query($link, "SELECT * FROM statistika");
	
	if(mysqli_num_rows($result) <= 0){
		echo "<h2>Посещений нет :(</h2>";
	} else {
		$visit_count = mysqli_num_rows($result);
	}
	
	if($result){
		echo "<b>Всего посещений:</b> " .$visit_count;
		echo "<table><tr class=\"heads\"><td>Браузер</td><td>IP</td><td>Хост</td><td>Ссылка</td><td>Страница</td><td>Время визита</td></tr>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr class=\"counters\"><td>". $row['user_agent'] . "</td>";
			echo "<td><a target=\"_blank\" href=\"who.php?ip=".$row['remote_addr']."\">". $row['remote_addr'] . "</a></td>";
			echo "<td>". $row['remote_host'] . "</td>";
			echo "<td>". $row['referer'] . "</td>";
			echo "<td>". $row['request_uri'] . "</td>";
			echo "<td>". $row['cur_time'] . "</td></tr>";
		}
		echo "</table>";
	}	
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