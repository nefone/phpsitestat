<?php
//перенаправляем на index.php если пользователь хочет открыть sniff.php
if (preg_match("/sniff.php/", $_SERVER['PHP_SELF'])){
    header("location: index.php");
    die();
}

function saveUserData(){
    //подготавливаем данные для записи
    if (empty($_SERVER['HTTP_USER_AGENT'])){$_SERVER['HTTP_USER_AGENT']="Unknown";}
    if (empty($_SERVER['REMOTE_ADDR'])){$_SERVER['REMOTE_ADDR']="Not Resolved";}
    if (empty($_SERVER['REMOTE_HOST'])){$_SERVER['REMOTE_HOST']="Unknown";}
    if (empty($_SERVER['HTTP_REFERER'])){$_SERVER['HTTP_REFERER']="No Referer";}
    if (empty($_SERVER['REQUEST_URI'])){$_SERVER['REQUEST_URI']="Unknown";}
    
    //задаем переменные
    $user_agent =  htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
    $remote_addr = htmlspecialchars($_SERVER['REMOTE_ADDR']);
    $remote_host = htmlspecialchars($_SERVER['REMOTE_HOST']);
    $refer = 	   htmlspecialchars($_SERVER['HTTP_REFERER']);
    $request_uri = htmlspecialchars($_SERVER['REQUEST_URI']);
	$cur_time     = date("d.m.Y @ H.m.s"); //текущее время и дата
	
	//записываем данные в БД	
	$link = mysqli_connect("localhost", "root", "", "site_stat");
	
	if(!$link){
		echo "Не удалось подключиться к MySQL: (" . mysqli_connect_errno(). ")";
		exit();
	}
    
    $statement = mysqli_prepare($link, "INSERT INTO statistika(user_agent,remote_addr,remote_host,referer,request_uri,cur_time) VALUES(?,?,?,?,?,?)");
    
    if($statement){
		mysqli_stmt_bind_param($statement, "ssssss", $user_agent, $remote_addr, $remote_host, $refer, $request_uri, $cur_time);		
		mysqli_stmt_execute($statement);		
		mysqli_stmt_close($statement);
	}
	
	mysqli_close($link);

}
?>