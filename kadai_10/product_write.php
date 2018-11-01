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

// var_dump($_FILES["upfile"]["name"]);
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "img/uploads/";  //画像ファイル保管先

    
    //***File名の変更***
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
    $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
   

    $img="";  //画像表示orError文字を保持する変数
    // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_name ) ) {
            chmod( $file_name, 0644 );
            $img = '<img src="'. $file_name . '" >'; 
        } else {
            $img = "Error:アップロードできませんでした。"; 
        }
    }
    // FileUpload [--End--]
}else{
    $img = "画像が送信されていません"; 
    header("location: /");
    // exit;
}

// if($name){
    $sql = "INSERT INTO product (name,comment,indate,img_url)VALUES( :name,:comment,sysdate(),:image)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $desc, PDO::PARAM_STR);
    $stmt->bindValue(':image', $file_name, PDO::PARAM_STR);
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
<?=$img;?>

<p>書き込みました</p>
</body>
</html>