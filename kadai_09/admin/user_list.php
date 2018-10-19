<?php
session_start();
include("../funcs.php");
$pdo = db_con();

if($_SESSION["kanri_flg"]==0){
    header("location: ../login.php");
}

// $sql = "SELECT * FROM user";
$stmt = $pdo->prepare("SELECT * FROM user WHERE life_flg = 0");
$res = $stmt->execute();
$view="";

if($res==false){
    $error = $stmt->errorinfo();
    exit("QueryError:".$error[2]);
}
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($result["kanri_flg"]==1){
        $kanri_view = "管理者";
    }else{
        $kanri_view = "一般";
    }
    $view .= "<li><ul>";
    $view .= "<li class='delete'><a href='./user_delete.php?id=".$result["id"]."'>[ × ]</a></li>";
    $view .= "<a href='./user_edit.php?id=".$result["id"]."'>";
    $view .= "<li>ID: ".$result["id"]."</li>";
    $view .= "<li>名前: ".$result["name"]."</li>";
    $view .= "<li>作成日時: ".$result["indate"]."</li>";
    $view .= "<li>ログインID: ".$result["lid"]."</li>";
    $view .= "<li>権限: ".$kanri_view."</li>";
    $view .= "</a>";
    $view .= "</ul></li>";
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
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
<div class="wraper">
<header>
	<?php include("../header.php") ?>
</header>
<main>
<ul class="userList">
    <?=$view?>
</ul>


</main>
<footer>
	<?php include("../footer.php") ?>
</footer>
</div>

</body>
</html>