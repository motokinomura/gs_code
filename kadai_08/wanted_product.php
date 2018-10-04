<html>
<head>
	<meta charset="utf-8">
	<title>リストページ</title>
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
	<h2>お気に入りリスト</h2>
	<ul class="contsList">
<?php
include("funcs.php");
$pdo = db_con();

/*===================================
　お気に入りのproductを抽出
===================================*/
$stmt = $pdo->prepare("SELECT * FROM want_list WHERE user_id=".$_SESSION["USERID"]);
$status = $stmt->execute();
$view="";
$wantlistArray = array();
if($status==false) {
	sqlError($stmt);
}else{
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
		// $starsum = $starsum+$result["star"];
		// echo $result["star"];
		// echo $result["product_id"];
		array_push($wantlistArray,$result["product_id"]);
	}
}
// var_dump($wantlistArray);



/*===================================
　1項目の星の設定
===================================*/
$stmt = $pdo->prepare("SELECT count(*) FROM product");
$status = $stmt->execute();
$view="";
if($status==false) {
	sqlError($stmt);
}else{
	$productCount = $stmt->fetchColumn();
}
$oneProStarCount = array();
for ($i=1; $i <= $productCount ; $i++) { 
		$stmt = $pdo->prepare("SELECT count(*) FROM product_comment WHERE product_id=".$i);
		$status = $stmt->execute();
		$view="";
		if($status==false) {
		sqlError($stmt);
		}else{
		$count = $stmt->fetchColumn();
		}

		$starsum = 0;
		$stmt = $pdo->prepare("SELECT star FROM product_comment WHERE product_id=".$i);
		$status = $stmt->execute();
		$view="";
		if($status==false) {
			sqlError($stmt);
		}else{
			while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$starsum = $starsum+$result["star"];
				// echo $result["star"];
			}
			// echo $i."-".$starsum.',';
		}
		if($count!=0){
			$starCount = $starsum/$count;
		}else{
			$starCount = 5;
		}
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
		$oneProStarCount[$i] = $commentReputationOne;
}
/*===================================
　一覧の表示
===================================*/
$stmt = $pdo->prepare("SELECT * FROM product");
$status = $stmt->execute();
$view="";
if($status==false) {
	sqlError($stmt);
}else{
	$s = 0;
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
		
	$s++;
	//$wantlistArrayにidがある場合のみli内を表示
	if(in_array($result["id"],$wantlistArray)){
	$view .= '<li><a href="product.php?id='.$result["id"].'">
					<div class="contImg" style="background:url(img/img'.$result["id"].'.jpg) center no-repeat; background-size:cover;"></div>
					<div class="bottomBlk">
						<p class="name">'.$result["name"].'</p>
						<div class="reputation">'.$oneProStarCount[$s].'</div>
					</div>
			</a></li>';
	}
	}
}
echo $view;
?>


	</ul>
</main>
<footer>
	<?php include("footer.php") ?>
</footer>
</div>
</body>
</html>