
<?php
 
session_start();
 
if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
    exit;
}
 
//ログアウト機能
if(isset($_POST['logout'])){
    
    $_SESSION = [];
    session_destroy();
 
    header('Location: login.php');
    exit;
}

$h1 = $_POST['hensu1'];
$h2 = $_POST['hensu2'];
$h3 = $_POST['hensu3'];
$h4 = $_POST['hensu4'];
$h5 = $_POST['hensu5'];

$message = '';
    if(isset($_POST['kaikei'])){
        if ($h1 + $h2 + $h3 + $h4 + $h5==0){
            $message = 'ピザを1枚以上選んでください';
            header("Location: select.php");
            exit;
        }
    }

 
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>ピザ選択画面</title>
</head>
    
    <body>
    <h1>ピザ選択</h1>
    <p>ログイン中</p>
    <br>

<p style="color: red"><?php echo $message ?></p>
<form method="post" action="kakunin.php">
    マルゲリータ 1000円 ×
        <input type = "text" name = "hensu1" value = "0">個<br>
    てりやきチキン 1100円 ×
        <input type = "text" name = "hensu2" value = "0">個<br>
    シーフード 1200円 ×
        <input type = "text" name = "hensu3" value = "0">個<br>
    カルビ 1500円 ×
        <input type = "text" name = "hensu4" value = "0">個<br>
    ミックス 2000円 ×
        <input type = "text" name = "hensu5" value = "0">個<br><p>
        
        <input type="submit" name="kaikei" value="会計"></p>
        <input type="submit" name="logout" value="ログアウト">
</form>


 
</body>
</html>