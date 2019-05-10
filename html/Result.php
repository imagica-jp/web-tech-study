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
$db_selected = mysql_select_db('pizzasite', $link);

/*
    $h1 = $_POST['hensu1'];
    $h2 = $_POST['hensu2'];
    $h3 = $_POST['hensu3'];
    $h4 = $_POST['hensu4'];
    $h5 = $_POST['hensu5'];
 */

/*
    for ($i = 0; $i < count($_POST["hensu"]); $i++){
    echo $_POST["hensu"][$i]."　";
  }//配列がこっちにきてるか確認
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>注文確認</title>
</head>
<body>
    <h1>会計確認</h1>
    <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん。</p>
        <!-- ユーザー名をechoで表示 -->
    <br>
 <?php
$i = 0;
$all = 0;
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM menu');
while ($row = mysql_fetch_assoc($result)) {
    $ans[] = $row['price'] * $_POST["hensu"][$i];
    if ($_POST["hensu"][$i] > 0) {
        print($row['pizzamenu']);
        print($row['price'] . '円');
        print($_POST["hensu"][$i]);
        print('枚 ');
        print($ans[$i] . '円<br>');
        print('<p>');
    }
    $all += $ans[$i];
    $cp[] = $_POST["hensu"][$i];
                    //print($cp[$i]);//入力枚数取得確認
    $pm[] = $row['pizzamenu'];
    $pp[] = $row['price'];
    $i = $i + 1;
}
$end = $i;//endには5が入る
               

/*
                $result = mysql_query('SELECT pizzamenu,price FROM menu where id=4');
                $row = mysql_fetch_assoc($result);
                if($h4 >0){
                print($row['pizzamenu']);
                print($row['price'].'円');
                $ans4= $row['price'] * $h4; 
                print ($h4);
                print('枚　');
                print ($ans4);
                print('円</br>');
                }
 */

if ($all > 0) {
    print('合計' . $all . '円です。注文は以上でよろしいですか');
    print('<form method="post" action="orei.php">');
                    
    //1枚以上選択しているピザの情報pizzamenu,price,countpizzaをorderdetailに入力
    for ($i = 0; $i < $end; $i++) {
        if ($cp[$i] > 0) {
            $sql = "INSERT INTO pizzasite.orderdetail(pizzamenu,price,countpizza) 
                            VALUES('$pm[$i]','$pp[$i]','$cp[$i]')";
            $result_flag = mysql_query($sql);
        }
    }

    print('<input type="submit" name="completion" value="注文完了">');
    print('</form>');

} else {
    print('ピザが選択されていません');
}
?>


<br>


        <form action="Main.php">
            <input type="submit" value="戻る">
        </form>
        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
 
</body>
</html>

