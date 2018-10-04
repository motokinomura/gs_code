<?php
include("funcs.php");
$pdo = db_con();

$productId = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM product WHERE id=".$productId);
$status = $stmt->execute();
$view="";
if($status==false) {
	sqlError($stmt);
}else{
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<form method="post" action="product_update.php">
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>コメント：<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$productId?>">
     <input type="submit" value="送信">
</form>
<!-- Main[End] -->


</body>
</html>

