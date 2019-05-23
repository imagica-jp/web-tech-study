<?php
// デバッグ
// var_dump($_GET);

$dsn = "mysql:dbname=penguin;host=mysql";
$user = "root";  // ユーザー名
$pass = "password";  // ユーザー名のパスワード
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    $stmt =  $pdo->prepare('DELETE FROM todo_list WHERE id = ?') ;
    $stmt->bindValue(1,(int)$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    // リダイレクト処理
    header("Location: todo_list.php");
    exit;
} catch (PDOException $e) {
    exit('データベース操作エラー。'.$e->getMessage());
}
?>
