<?php
// デバッグ
// var_dump($_POST);

$dsn = "mysql:dbname=penguin;host=mysql";
$user = "root";  // ユーザー名
$pass = "password";  // ユーザー名のパスワード
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    $stmt =  $pdo->prepare('INSERT INTO todo_list (body, done, expiration, priority) VALUES(:body, :done, :expiration, :priority)');    $date = new DateTime($_POST['expiration']);
    $stmt->bindParam(':body', $_POST['body'], PDO::PARAM_STR);
    $stmt->bindParam(':done', $_POST['done'], PDO::PARAM_INT);

    // 期限日に関しては受け取ったパラメータをDBに保存できるフォーマットに編集して:expirationにbindParamします
    $date = NULL;
    if(! empty($_POST['expiration'])) {
        $date = new DateTime($_POST['expiration']);
        // var_dump($date->format('Y-m-d'));
    }
    if(is_null($date)){
        $stmt->bindParam(':expiration', $date, PDO::PARAM_NULL);
    }else{
        $stmt->bindParam(':expiration', $date->format('Y-m-d'), PDO::PARAM_STR);
    }

    $stmt->bindParam(':priority', $_POST['priority'], PDO::PARAM_INT);
    $stmt->execute();
    // リダイレクト処理
    header("Location: todo_list.php");
    exit;
} catch (PDOException $e) {
    exit('データベース操作エラー。'.$e->getMessage());
}
?>
