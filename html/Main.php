<?php

session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "kosuke";  // ユーザー名
$db['pass'] = "rakunaru08";  // ユーザー名のパスワード
$db['dbname'] = "pizzasite";  // データベース名
// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
$link = mysql_connect($db['host'], $db['user'], $db['pass']);
/*if (!$link) {
    die('接続失敗です。'.mysql_error());
    }
    print('<p>接続に成功しました。</p>');*/
$db_selected = mysql_select_db('pizzasite', $link);
/*if (!$db_selected){
        die('データベース選択失敗です。'.mysql_error());
    }
    print('<p>pizzasiteデータベースを選択しました。</p>');
 */

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
    </head>
    <body>
        <h1>ピザを選択してください</h1><!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
        <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん。</p>
        <!-- ユーザー名をechoで表示 -->

        <form action="Result.php" method="POST">
        <!--
            <? php/*
            mysql_set_charset('utf8'); 
            $result = mysql_query('SELECT pizzamenu,price FROM menu where id=1');
            $row = mysql_fetch_assoc($result);
            print($row['pizzamenu']);
            print($row['price'].'円'); 
             */ ?>
            <input type = "text" name = "hensu1" value = "0">枚<br>-->



        <?php //メイン画面で戻った時detailidが0の行は削除
        mysql_set_charset('utf8');
        $sql = "delete from pizzasite.orderdetail where detailid=0";
        $result_flag = mysql_query($sql);


        $result = mysql_query('SELECT * FROM menu');

        while ($row = mysql_fetch_assoc($result)) {
            print('<p>');
            print($row['pizzamenu']);
            print($row['price']);
            print('円');
            print('<input type = "text" name = "hensu[]" value = "0">枚<br>');
        }
        ?>

        <input type="submit" id="sum" name="sum" value="会計">

        </form>

        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
    </body>
</html>
