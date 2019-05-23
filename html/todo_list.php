<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penguin</title>
    <!-- <link href="css/reset.css" rel="stylesheet" type="text/css"> -->
    <!-- <link href="css/css.css" rel="stylesheet" type="text/css"> -->
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
    <h1>Todoリスト</h1>

    <?php
    $stmt = $pdo->query("SELECT * FROM todo_list");
    echo "<table><tr><th>内容</th><th>チェック</th><th>期限</th><th>優先度</th><th></th></tr>";
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $row['body'];
        echo "</td>";

        echo "<td>";
        echo $row['done'];
        echo "</td>";

        echo "<td>";
        echo $row['expiration'];
        echo "</td>";

        echo "<td>";
        echo $row['priority'];
        echo "</td>";

        echo "<td>";
        echo '<a href="/edit_todo_list.php?id=' . $row['id'] . '">編集</a> ';
        echo '<a href="/delete_todo_list.php?id=' . $row['id'] . '">削除</a>';
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";


    ?>
    <p>
        <a href="/new_todo_list.html">新規作成</a>
    </p>
</body>
</html>
