<?php
include("funcs.php");
$pdo = db_con();

$productId = $_GET["id"];

/*===================================
　コメントの登録
===================================*/
	$postCommentId = $_POST["commentId"];
	$postComment = $_POST["comment"];
	$postReputation = $_POST["commentReputation"];
	$post_user_id = 0;

	if($postComment){
		$sql = "INSERT INTO product_comment (user_id,comment,product_id,star,indate)VALUES( :user_id,:comment,:product_id,:star,sysdate())";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':user_id', $post_user_id, PDO::PARAM_INT);
		$stmt->bindValue(':comment', $postComment, PDO::PARAM_STR);
		$stmt->bindValue(':product_id', $postCommentId, PDO::PARAM_INT);
		$stmt->bindValue(':star', $postReputation, PDO::PARAM_INT);
		$status = $stmt->execute();

		//４．データ登録処理後
		if($status==false){
		sqlError($stmt);
		}else{
		header("location: product.php?id=".$productId);
		exit;
		}
	}
/*===================================
　このページの星の設定
===================================*/
	$stmt = $pdo->prepare("SELECT count(*) FROM product_comment WHERE product_id=".$productId);
	$status = $stmt->execute();
	$view="";
	if($status==false) {
	sqlError($stmt);
	}else{
	$count = $stmt->fetchColumn();
	}
	//   echo $count;

	//   ↓うまく動かせない！！！↓
	// $stmt = $pdo->prepare("SELECT SUM(star) FROM product_comment WHERE product_id=".$productId);
	//   ↑うまく動かせない！！！↑
	$starsum = 0;
	$stmt = $pdo->prepare("SELECT star FROM product_comment WHERE product_id=".$productId);
	$status = $stmt->execute();
	$view="";
	if($status==false) {
		sqlError($stmt);
	}else{
		while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$starsum = $starsum+$result["star"];
			// echo $result["star"];
		}
		// echo $starsum;
	}
	$starCount = $starsum/$count;
	if($starCount>=5){
		$commentReputationOne = '★★★★★';
	}elseif($starCount>=4){
		$commentReputationOne = '★★★★☆';
	}elseif($starCount>=3){
		$commentReputationOne = '★★★☆☆';
	}elseif($starCount>=2){
		$commentReputationOne = '★★☆☆☆';
	}else{
		$commentReputationOne = '★☆☆☆☆';
	}


/*===================================
　商品？ブロック
===================================*/
$stmt = $pdo->prepare("SELECT * FROM product WHERE id=".$productId);
$status = $stmt->execute();
$view="";
if($status==false) {
	sqlError($stmt);
}else{
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
	$productBlk .= '<section class="productBlk">
			<div class="imgBlk" style="background:url(img/img'.$productId.'.jpg) center no-repeat; background-size:cover;"></div>
			<div class="descBlk">
				<div class="reputation">'.$commentReputationOne.'</div>
				<p class="name">'.$result["name"].'</p>
				<div class="desc">'.$result["comment"].'</div>
				<form style="margin-top:30px" id="wantForm" action="wantliat_write.php" method="post">
					<input type="hidden" name="wantedId" id="wantedId" value="'.$productId.'">
					<input type="submit" value="お気に入りリストに追加">
				</form>
			</div>
		</section>';
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>商品ページ</title>
	<script src="js/jquery-2.1.3.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
<div class="wraper">
<header>
	<?php include("header.php") ?>
</header>
<main>
	<?=$productBlk?>
	<section class="commentBlk">
		<h2>コメントを書く</h2>
		<form class="commentForm" action="product.php?id=<?php echo $productId ?>" method="post">
			<input type="hidden" name="commentId" id="commentId" value="<?php echo $productId ?>">
			<select name="commentReputation">
				<option value="1">★1</option>
				<option value="2">★2</option>
				<option value="3">★3</option>
				<option value="4">★4</option>
				<option value="5">★5</option>
			</select>
			<textarea name="comment" id="comment"></textarea>
			<input type="submit" value="送信">
		</form>
		<h2>コメントリスト</h2>
		<ul class="commentList">
		<?php

		// //文字作成
		// $file = fopen("data/comment.csv","r");	// ファイル読み込み
		// while (!feof($file)) {

		// 	// fgetsでファイルを読み込み、変数に格納
		// 	$usersComment = fgets($file);
		// 	$usersComment = explode(",",$usersComment);

		// 	if($usersComment[3]==5){
		// 		$commentReputationOne = '<div class="reputation">★★★★★</div>';
		// 	}elseif($usersComment[3]==4){
		// 		$commentReputationOne = '<div class="reputation">★★★★☆</div>';
		// 	}elseif($usersComment[3]==3){
		// 		$commentReputationOne = '<div class="reputation">★★★☆☆</div>';
		// 	}elseif($usersComment[3]==2){
		// 		$commentReputationOne = '<div class="reputation">★★☆☆☆</div>';
		// 	}else{
		// 		$commentReputationOne = '<div class="reputation">★☆☆☆☆</div>';
		// 	}
			
		// 	if($usersComment[0]==$productId){
		// 	echo '<li>
		// 	<div class="name">'.$usersComment[1].$commentReputationOne.'</div>
		// 	<p class="txt">'.$usersComment[2].'</p>
		// 	</li>';
		// 	};
		// }
		// fclose($file);

		$stmt = $pdo->prepare("SELECT * FROM product_comment LEFT JOIN user ON product_comment.user_id = user.id WHERE product_comment.product_id=".$productId." ORDER BY product_comment.indate DESC");
		$status = $stmt->execute();
		$view="";
		if($status==false) {
			sqlError($stmt);
			// echo "aaa";
		}else{
			while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
				/*  表示する名前
				===================================*/
				if($result["name"]){
					$commentname = $result["name"];
				}else{
					$commentname = "匿名コメント";
				}
				/*  表示する星の数
				===================================*/
				if($result["star"]==5){
					$commentReputationOne = '<div class="reputation">★★★★★</div>';
				}elseif($result["star"]==4){
					$commentReputationOne = '<div class="reputation">★★★★☆</div>';
				}elseif($result["star"]==3){
					$commentReputationOne = '<div class="reputation">★★★☆☆</div>';
				}elseif($result["star"]==2){
					$commentReputationOne = '<div class="reputation">★★☆☆☆</div>';
				}else{
					$commentReputationOne = '<div class="reputation">★☆☆☆☆</div>';
				}

				echo '<li>
				<div class="name">'.$commentname.'<div class="reputation">'.$commentReputationOne.'</div></div>
				<p class="txt">'.$result["comment"].'</p>
				</li>';
			}
		}

		?>
			<!-- <li>
				<p class="name">teat</p>
				<p class="txt">とても可愛い</p>
			</li>
			<li>
				<p class="name">teat</p>
				<p class="txt">とても可愛い</p>
			</li>
			<li>
				<p class="name">teat</p>
				<p class="txt">とても可愛い</p>
			</li> -->
		</ul>
	</section>
</main>
<footer>
	<?php include("footer.php") ?>
</footer>
</div>

</body>
</html>