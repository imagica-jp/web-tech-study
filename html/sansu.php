<html>
<head>
<title>sansu.php</title>
</head>
<body>
<?php
$h1 = $_GET['hensu1'];
$h2 = $_GET['hensu2'];
$se = $_GET['selectenzan'];

switch($se){
case"+":
$answer = $h1 + $h2;
break;

case"-":
$answer = $h1 - $h2;
break;

case"*":
$answer = $h1 * $h2;
break;

case"/":
$answer = $h1 / $h2;
break;

defalut:
break;
}

print($h1."".$se."".$h2."=".$answer."\n");
?>
<br/>
<br/>
<a href="#" onclick="history.back(); return false;">modoru</a>
</body>
</html>



