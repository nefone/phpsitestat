<?php
    session_start();
    include("func.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Статистика посещений</title>
    <style>
        body{
            text-decoration-color: #000000;
            font-family: Arial;
            font-size: 12px;
        }
        tr.heads{
            color: #FFFFFF;
            background-color: #808080;
        }
        tr.counters{
            color: #0000A0;
            background-color: #CECECE;
        }
        table{
            width: 100%;
            padding: 2px;
            border-spacing: 2px;
        }
    </style>
</head>
<body>

<?php
showStat();
?>

</body>
</html>