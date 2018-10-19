<?php
// $file = "data/product.csv";
// echo $ret = exec( 'wc -l '.$file );

// $fp = fopen("data/product.csv","r");
// for( $count = 0; fgets( $fp ); $count++ );
// $count = $count+1;
?>

<html>
<head>
<meta charset="utf-8">
<title>POST練習</title>
</head>
<body>
<form action="product_write.php" method="post">
	名前: <input type="text" name="name">
	説明: <textarea type="text" name="desc"></textarea>
	<input type="submit" value="送信">
</form>
</body>
</html>