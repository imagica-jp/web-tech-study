<?php

$link = mysql_connect("localhost","kosuke","");
mysql_query("create database if not exists test2 default character set utf8");
$result = mysql_query("show databases");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo $row[0];
		echo "<br>";
}
?>