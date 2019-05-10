<?php
require 'password.php';

// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "kosuke";  // ユーザー名
$db['pass'] = "rakunaru08";  // ユーザー名のパスワード
$db['dbname'] = "pizzasite";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

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

$i = 0;
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM userData');
while ($row = mysql_fetch_assoc($result)) {
    $yetname[] = $row['name'];
    
        /*print($row['name'] . 'さん<br>');
        print($yetname[$i] . 'さん<br>');
        print('<p>');*/
        $i = $i + 1;
    
}
$end = $i;
$i =1;

if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"])
        && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8',
            $db['host'],$db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn,$db['user'],$db['pass'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            //if($_POST["username"] != "$yetname[$i]"){
    
            $stmt = $pdo->prepare("INSERT INTO userData(name, password) VALUES (?, ?)");
            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));
              //パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue
              //(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  
            // 登録した(DB側でauto_incrementした)IDを$useridに入れる
            $signUpMessage = '登録が完了しました。あなたの登録IDは ' . $userid . ' です。
            パスワードは ' . $password . ' です。';  // ログイン時に使用するIDとパスワード
            
            /*}else{
                $errorMessage = 'そのユーザー名は既に使用されております';
            } */



        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    } else if ($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。または未入力です。';
    }

    


}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <div><font color="#ff0000">
                <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff">
                <?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                <label for="username">ユーザー名登録</label>
                <input type="text" id="username" name="username" 
                value="<?php if (!empty($_POST["username"])) {
                    echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード登録</label>
                <input type="password" id="password" name="password" value="">
                <br>
                <label for="password2">パスワード(確認用)</label>
                <input type="password" id="password2" name="password2" value="">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
            </fieldset>
        </form>
        <br>
        <form action="Login.php">
            <input type="submit" value="戻る">
        </form>
    </body>
</html>