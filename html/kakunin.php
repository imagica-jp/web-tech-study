
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

$ans1 = 1000 * $h1;
$ans2 = 1100 * $h2;
$ans3 = 1200 * $h3;
$ans4 = 1500 * $h4;
$ans5 = 2000 * $h5;

$all = $ans1 + $ans2 + $ans3 + $ans4 + $ans5;

?>
 
<!DOCTYPE html>
<html>
<head>
    <title>確認画面</title>
</head>
    
    <body>
    <h1>会計確認</h1>
    <p>ログイン中</p>
    <br>

こちらでよろしいですか？<br><br>

マルゲリータ 1000円 × <?php echo $h1; ?>個 = <?php echo $ans1; ?> 円<br>
てりやきチキン 1100円 ×　<?php echo $h2; ?>個 = <?php echo $ans2; ?> 円<br>
シーフード 1200円 × <?php echo $h3; ?>個 = <?php echo $ans3; ?> 円<br>
カルビ 1500円 × <?php echo $h4; ?>個 = <?php echo $ans4; ?> 円<br>
ミックス 2000円 × <?php echo $h5; ?>個 = <?php echo $ans5; ?> 円<br><br>

合計<?php echo $all; ?>円

<form method="post" action="orei.php">
    <input type="submit" name="completion" value="注文完了">
</form>
<br>
<form method="post" action="select.php">
    <input type="submit" name="back" value="戻る">
    <input type="submit" name="logout" value="ログアウト">
</form>
 
</body>
</html>