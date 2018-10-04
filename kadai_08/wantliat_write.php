<?php
session_start();
if (isset($_SESSION["USERID"])){

include("funcs.php");
$pdo = db_con();
$wantedId = $_POST["wantedId"];
$userId = $_SESSION["USERID"];

// if($name){
    $sql = "INSERT INTO want_list (product_id,user_id,indate)VALUES( :product_id,:user_id,sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':product_id', $wantedId, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $status = $stmt->execute();

    //４．データ登録処理後
    if($status==false){
    sqlError($stmt);
    }else{
    header("location: wanted_product.php");
    exit;
    }
// }
}
?>
