<?php
session_start();
include("funcs.php");
$pdo = db_con();

// $userId = $_POST["userId"];
echo $userId = $_POST["userId"];

if ( isset( $_POST['login'] ) ) {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id=".$userId);
    $status = $stmt->execute();
    $view="";
    if($status==false) {
        sqlError($stmt);
    }else{
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            $_SESSION["USERID"] = $result["id"];
            $_SESSION["NAME"] = $result["name"];
        }
        header("location: /");
		exit;
    }

  }
?>

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



<p><?php echo $_SESSION["NAME"]; ?></p>
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