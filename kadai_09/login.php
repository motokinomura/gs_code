<?php
session_start();
include("funcs.php");
$pdo = db_con();

// $userId = $_POST["userId"];
$userName = $_POST["userName"];
$userPw = $_POST["userPw"];

if ( isset( $_POST['login'] ) ) {
    $sql = "SELECT * FROM user WHERE lid=:lid AND lpw=:lpw AND life_flg=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':lid',$userName,PDO::PARAM_STR);
    $stmt->bindValue(':lpw',$userPw,PDO::PARAM_STR);
    $res = $stmt->execute();
    $view="";
    if($res==false) {
        // sqlError($res);
        $error = $stmt->errorinfo();
        exit("QueryError:".$error[2]);
    }
    // else{
    //     while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    //         $_SESSION["USERID"] = $result["id"];
    //         $_SESSION["NAME"] = $result["name"];
    //     }
    //     header("location: /login.php");
	// 	exit;
    // }
    $val = $stmt->fetch();
    // var_dump($val);
    if($val["id"]!=""){
        $_SESSION["chk_ssid"] = session_id();
        $_SESSION["kanri_flg"] = $val["kanri_flg"];
        $_SESSION["name"] = $val["name"];
        header("location: index.php");
    }else{
        header("location: login.php");
    }
    exit();
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

<form class="" action="login.php" method="post">
    <!-- <input type="hidden" name="userId" id="userId" value=""> -->
    <input type="text" name="userName" id="userName" placeholder="アドレスを入力" value="">
    <input type="password" name="userPw" id="userPw" value="">
    <input type="submit" name="login" valie="名前を登録">
</form>
<div style="margin-top:40px;"><a href="/registration.php">新規登録</a></div>
</main>
<footer>
	<?php include("footer.php") ?>
</footer>
</div>

<script>
    // if (!localStorage.getItem("userName")) {
    //     localStorage.setItem("userName","<?=$userName?>");
    // }
</script>
</body>
</html>