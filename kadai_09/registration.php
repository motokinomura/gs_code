<?php
session_start();
include("funcs.php");
$pdo = db_con();
$caution = "";
if(isset($_GET["status"])){
    if($_GET["status"]=="duplication"){
        $caution = "<p style='color:red;'>入力されたアドレスが既に存在します</p>";
    }
}

if(isset($_POST["registration"])){
    $sql = "SELECT * FROM user WHERE lid=:lid AND life_flg=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":lid",$_POST["userLId"],PDO::PARAM_STR);
    $status = $stmt->execute();
    // var_dump($status);var_dump($stmt);
    if($status==false){
        sqlError($stmt);
    }else{
        $row = $stmt->fetch();
        if($row==true){
            header("location: /registration.php?status=duplication");
            exit;
        }
    }

    $sql = "INSERT INTO user(name,indate,lid,lpw,kanri_flg,life_flg)VALUES(:name,sysdate(),:lid,:lpw,0,0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":name",$_POST["userName"],PDO::PARAM_STR);
    $stmt->bindValue(":lid",$_POST["userLId"],PDO::PARAM_STR);
    $stmt->bindValue(":lpw",$_POST["userPw"],PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sqlError($stmt);
    }else{
        $_SESSION["chk_ssid"] = session_id();
        $_SESSION["kanri_flg"] = 0;
        $_SESSION["name"] = $_POST["userName"];
        header("location: /");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
	<script src="js/jquery-2.1.3.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="wraper">
<header>
	<?php include("header.php") ?>
</header>
<main>
<?=$caution?>
<form class="" action="" method="post">
    <input type="text" name="userName" id="userName" placeholder="ユーザー名を入力" value="">
    <input type="email" name="userLId" id="userLId" placeholder="メールアドレスを入力" value="">
    <input type="password" name="userPw" id="userPw" value="">
    <input type="submit" name="registration" valie="名前を登録">
</form>

</main>
<footer>
	<?php include("footer.php") ?>
</footer>
</div>
</body>
</html>