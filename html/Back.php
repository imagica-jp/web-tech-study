<?php

session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "kosuke";  // ユーザー名
$db['pass'] = "rakunaru08";  // ユーザー名のパスワード
$db['dbname'] = "pizzasite";  // データベース名

$link = mysql_connect($db['host'], $db['user'], $db['pass']);
$db_selected = mysql_select_db('pizzasite', $link);

$errorMessage = "";
// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>未選択</title>
</head>
<body>
    <h1>ピザが選択されていません</h1>
    <br>
    注文は完了していません。ピザを選んでください。

</form>
<br>


        <form action="Main.php">
            <input type="submit" value="戻る">
        </form>
        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
 
</body>
</html>
