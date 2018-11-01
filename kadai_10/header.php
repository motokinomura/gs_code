	<?php session_start(); ?>
	<ul>
		<li><a href="/">トップページ</a></li>
		<?php if (isset($_SESSION["chk_ssid"])): ?><li><a id="wanted_product" href="/wanted_product.php?userid=false">お気に入りリスト</a></li><?php endif; ?>
		<li><a href="/product_input.php">リストにうちの子を登録</a></li>
		<?php if($_SESSION["kanri_flg"]==1):?>
			<li><a href="/admin/">管理者機能一覧へ</a></li>
		<?php endif;?>
		<li class="inputNameBlk">
        <?php if (!isset($_SESSION["chk_ssid"])): ?>
			<a href="/login.php">ログインページへ</a>
		<?php elseif (isset($_SESSION["chk_ssid"])): ?>
		<div class='loginName'><span>こんにちは</span> <?=$_SESSION["name"]?><span>さん</span></div>
		<form class="" action="/logout.php" method="post"> <button type="submit" name="logout">ログアウト</button></form>
		<?php endif; ?>
		</li>
	</ul>