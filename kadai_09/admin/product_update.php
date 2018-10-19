<?php
$name = $_POST["name"];
$comment = $_POST["comment"];
$id = $_POST["id"];

//2. DB接続します
include "../funcs.php";
$pdo = db_con();

//３．データ登録SQL作成
$sql = "UPDATE product SET name=:name,comment=:comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: /admin/product_list.php");
    exit;
}
?>