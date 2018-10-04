	<?php session_start(); ?>
	<ul>
		<li><a href="/">トップページ</a></li>
		<?php if (isset($_SESSION["USERID"])): ?><li><a id="wanted_product" href="wanted_product.php?userid=false">お気に入りリスト</a></li><?php endif; ?>
		<li><a href="product_input.php">リストにうちの子を登録</a></li>
		<li class="inputNameBlk">
        <?php if (!isset($_SESSION["USERID"])): ?>
		<form class="" action="login.php" method="post">
			<!-- <input type="hidden" name="userId" id="userId" value=""> -->
			<input type="text" name="userId" id="userId" placeholder="ユーザー名を入力" value="">
			<input type="submit" name="login" valie="名前を登録">
		</form>
		<?php elseif (isset($_SESSION["USERID"])): ?>
		<div class='loginName'><span>こんにちは</span> <?=$_SESSION["NAME"]?><span>さん</span></div>
		<form class="" action="logout.php" method="post"> <button type="submit" name="logout">ログアウト</button></form>
		<?php endif; ?>
		</li>
	</ul>