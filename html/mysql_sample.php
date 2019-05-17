<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MYSQL</title>
    <?php
    $dsn = "mysql:dbname=mysql_test;host=mysql";
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
    <h1>ユーザーリスト</h1>

    <?php
    $stmt = $pdo->query("SELECT * FROM user_list");
    echo "<table><tr><th>名前</th><th>年齢</th></tr>";
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $row['name'];
        echo "</td>";

        echo "<td>";
        echo $row['age'];
        echo "</td>";
    }
    echo "</table>";


    ?>

</body>
</html>
