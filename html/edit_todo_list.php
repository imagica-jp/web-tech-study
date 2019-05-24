<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

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
    <div class="container py-5">
        <div class="card bg-light mb-3">
            <div class="card-header">
                <h1>TODO編集</h1>
             </div>
            <div class="card-body">
            <!-- <?  var_dump($result["done"]) ?> -->
            <div class="card-body">
                <form action="update_todo_list.php" method="post">
                    <div class="form-group">
                        <label for="form-body">内容<small>(必須)</small></label><br>
                        <textarea required name="body" id="form-body" cols="40" rows="2" class="form-control"><?= $result["body"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <div>チェック状態<small>(必須)</small></div>
                        <?php
                        switch($result["done"]){
                        case 0:
                            $checked0 = 'checked';
                            break;
                        case 1:
                            $checked1 = 'checked';
                        }
                        ?>
                        <input type="radio" name="done" id="form-not-done" value="0" <?= $checked0 ?> class="form-check form-check-inline"><label for="form-not-done">未完了</label>
                        <input type="radio" name="done" id="form-done" value="1" <?= $checked1 ?> class="form-check form-check-inline"><label for="form-done">完了</label>
                    </div>
                    <div class="form-group">
                        <label for="form-date">期限日</label>
                        <input type="date" name="expiration" id="form-date" value=<?= $result["expiration"] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="form-priority">優先度<small>(必須)</small></label>
                        <input required type="number" name="priority" min="1" max="10" id="form-priority" value=<?= $result["priority"] ?> class="form-control">
                    </div>
                    <input type="hidden" name="id" value=<?= $result["id"] ?>>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="far fa-paper-plane mr-2"></i>更新
                    </button>
                </form>
            </div>
          </div>
        </div>
        <p>
            <a href="/todo_list.php">TODOリスト一覧に戻る</a>
        </p>
</body>

</html>
