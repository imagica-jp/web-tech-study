
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
print('<p>pizzasiteデータベースを選択しました。</p>');*/


mysql_set_charset('utf8'); 
            //orderテーブル完成
$mname = $_SESSION["NAME"];

            $sql = "INSERT INTO pizzasite.order(name) VALUES('$mname')";
            $result_flag = mysql_query($sql);
                    //この時点で10001以上の$mnameが入力される
                //print $mname;
                print('<p>');

                    //detailidの最大値取得
                    $testd = mysql_query("SELECT detailid FROM pizzasite.order 
                        where detailid= (SELECT MAX(detailid) FROM pizzasite.order)");
                    $row = mysql_fetch_assoc($testd);
                    //   print($row['detailid'].'左が現在のdetailid。');
                    $dnumber = $row['detailid'] + 1;
                    //$dnumberがdetailidの最大値
                    //   print($dnumber.'左は追加したいdetailid');
                    //    print('<p>');
                    
                    //masteridの最大値取得
                    $testm = mysql_query("SELECT masterid FROM pizzasite.order 
                        where masterid= (SELECT MAX(masterid) FROM pizzasite.order)");
                        $row = mysql_fetch_assoc($testm);
                    //    print($row['masterid'].'左が現在のmasterid。右は確認用→');
                    $mid = $row['masterid'];
                    //   print($mid);
                    //   print('<p>');

                    $sql = "update pizzasite.order set detailid = '$dnumber' where masterid = '$mid'";
                    $result_flag = mysql_query($sql);
                            
                                //
                        $testod = mysql_query("SELECT detailid FROM pizzasite.orderdetail 
                        where detailid= (SELECT MAX(detailid) FROM pizzasite.orderdetail)");
                    $row = mysql_fetch_assoc($testod);
                        $odid = $row['detailid'] + 1;
                    $sql = "update pizzasite.orderdetail set detailid = '$odid' where detailid = 0";
                    $result_flag = mysql_query($sql);

/*
            $result = mysql_query('SELECT * FROM menu');
            $i=0;                 
            while ($row = mysql_fetch_assoc($result)){                 
            print($row['pizzamenu']);
            print($row['price'].'円');
                print ($_POST["cp"][$i]);
                print('枚 ');
            print('<p>');
                        
                        $i=$i+1;
                    }
  
 */


?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>注文完了画面</title>
    </head>
    <body>
        <h1>注文完了致しました</h1><!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
    お買い上げありがとうございました。

     <form action="Main.php">
            <input type="submit" value="メインページに戻る">
        </form>

        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
    </body>
</html>
