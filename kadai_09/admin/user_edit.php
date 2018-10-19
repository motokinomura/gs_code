<?php
session_start();
include("../funcs.php");
$pdo = db_con();

$sql = "SELECT * FROM user WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id",$_GET["id"],PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
    sqlError($stmt);
}else{
    $row = $stmt->fetch();
}

if(isset($_POST["edit"])){
    if($_POST["userPw"]!=""){
        $sql = "UPDATE user SET name=:name,lid=:lid,lpw=:lpw WHERE id=:id";
    }else{
        $sql = "UPDATE user SET name=:name,lid=:lid WHERE id=:id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id",$_GET["id"],PDO::PARAM_INT);
    $stmt->bindValue(":name",$_POST["userName"],PDO::PARAM_STR);
    $stmt->bindValue(":lid",$_POST["userLId"],PDO::PARAM_STR);
    if($_POST["userPw"]!=""){$stmt->bindValue(":lpw",$_POST["userPw"],PDO::PARAM_STR);}
    $status = $stmt->execute();

    if($status==false){
        sqlError($stmt);
    }else{
        header("location: /admin/user_list.php");
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
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<div class="wraper">
<header>
	<?php include("../header.php") ?>
</header>
<main>
<?=$caution?>
<form class="" action="" method="post">
    <input type="text" name="userName" id="userName" placeholder="ユーザー名を入力" value="<?=$row["name"]?>">
    <input type="email" name="userLId" id="userLId" placeholder="メールアドレスを入力" value="<?=$row["lid"]?>">
    <input type="text" name="userPw" id="userPw" value="">
    <input type="submit" name="edit" valie="名前を登録">
</form>

</main>
<footer>
	<?php include("../footer.php") ?>
</footer>
</div>
</body>
</html>