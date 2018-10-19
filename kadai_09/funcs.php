<?php
//共通に使う関数を記述

function h($a)
{
    return htmlspecialchars($a, ENT_QUOTES);
}

function db_con(){
    try {
        return $pdo = new PDO('mysql:dbname=gs_kadai07;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DB_CONRCTION_ERROR:'.$e->getMessage());
    }
}

function sqlError($stmt){
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}