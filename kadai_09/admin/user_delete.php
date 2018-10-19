<?php
session_start();
include("../funcs.php");
$pdo = db_con();

if($_SESSION["kanri_flg"]==0){
    header("location: ../login.php");
}
$sql = "UPDATE user SET life_flg=1 WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$_GET["id"],PDO::PARAM_INT);
$status = $stmt->execute();

if($status == false){
    sqlError($stmt);
}else{
    header("location: /admin/user_list.php");
}