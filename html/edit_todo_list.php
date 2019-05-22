<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集</title>
    <?php
        $dsn = "mysql:dbname=penguin;host=mysql";
        $user = "root";  // ユーザー名
        $pass = "password";  // ユーザー名のパスワード
        try {
           $pdo = new PDO($dsn,$user,$pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
        } catch (PDOException $e) {
            exit('データベース接続失敗。'.$e->getMessage());
        }
        $prepare = $pdo->prepare('SELECT * FROM todo_list WHERE id = ?');
        $prepare->bindValue(1,(int)$_GET['id'],PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetch();
    ?>
</head>

<body>
    <h1>TODO編集</h1>
    <!-- <?  var_dump($result["done"]) ?> -->
    <div>
        <form action="update_todo_list.php" method="post">
            <div>
                <label for="form-body">内容<small>(必須)</small></label><br>
                <textarea required name="body" id="form-body" cols="40" rows="2"><?= $result["body"] ?></textarea>
            </div>
            <div>
                チェック状態
                <?php
                switch($result["done"]){
                case 0:
                    $checked0 = 'checked';
                    break;
                case 1:
                    $checked1 = 'checked';
                }
                ?>
                <input type="radio" name="done" id="form-not-done" value="0" <?= $checked0 ?>><label for="form-not-done">未完了</label>
                <input type="radio" name="done" id="form-done" value="1" <?= $checked1 ?>><label for="form-done">完了</label>
            </div>
            <div>
                <label for="form-date">期限日</label>
                <input type="date" name="expiration" id="form-date" value=<?= $result["expiration"] ?>>
            </div>
            <div>
                <label for="form-priority">優先度<small>(必須)</small></label>
                <input required type="number" name="priority" min="1" max="10" id="form-priority" value=<?= $result["priority"] ?>>
            </div>
            <input type="hidden" name="id" value=<?= $result["id"] ?>>
            <input type="submit" name="submit" value="更新">
        </form>
    </div>

    <p>
        <a href="/todo_list.php">TODOリスト一覧に戻る</a>
    </p>
</body>

</html>
