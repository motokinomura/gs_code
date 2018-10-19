<head>
<meta charset="utf-8">
<title>File書き込み</title>
</head>
<body>
<?php
include("funcs.php");
$pdo = db_con();
$name = $_POST["name"];
$desc = $_POST["desc"];

// if($name){
    $sql = "INSERT INTO product (name,comment,indate)VALUES( :name,:comment,sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $desc, PDO::PARAM_STR);
    $status = $stmt->execute();

    //４．データ登録処理後
    if($status==false){
    sqlError($stmt);
    }else{
    header("location: /");
    exit;
    }
// }
?>

<p>書き込みました</p>

</body>
</html>