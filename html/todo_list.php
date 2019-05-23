<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penguin</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="css/font.css" rel="stylesheet" type="text/css">
    <?php
    $dsn = "mysql:dbname=penguin;host=mysql";
    $user = "root";  // ユーザー名
    $pass = "password";  // ユーザー名のパスワード
    try {
    $pdo = new PDO($dsn,$user,$pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    } catch (PDOException $e) {
    exit('データベース接続失敗。'.$e->getMessage());
    }
    ?>
</head>
<body>
    <div class="container py-5">
        <div class="card bg-light mb-3">
            <div class="card-header">
                <h1><i class="fas fa-tasks mr-3"></i>Todoリスト</h1>
            </div>
            <div class="card-body">
                <?php
                $stmt = $pdo->query("SELECT * FROM todo_list");
                echo "<table class='table table-bordered table-hover'><tr><th>内容</th><th>チェック</th><th>期限</th><th>優先度</th><th></th></tr>";
                while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['body'];
                    echo "</td>";

                    echo "<td>";
                    echo boolval($row['done']) ? '完了' : '未完了';
                    echo "</td>";

                    echo "<td>";
                    echo $row['expiration'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['priority'];
                    echo "</td>";

                    echo "<td>";
                    echo '<a href="/edit_todo_list.php?id=' . $row['id'] . '" class="btn btn-info mr-1" role="button"><i class="fas fa-edit mr-1"></i>編集</a>';
                    echo '<a href="/delete_todo_list.php?id=' . $row['id'] . '" class="btn btn-danger" role="button"><i class="fas fa-trash-alt mr-1"></i>削除</a>';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                <p>
                    <a href="/new_todo_list.html" class="btn btn-primary" role="button"><i class="far fa-plus-square mr-1"></i>新規作成</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
