<?php
    // ログイン認証チェック関数
    function loginCheck(){
        if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
            echo "LOGIN ERROR";
            exit();
          }else{
            session_regenerate_id(true);
            $_SESSION["chk_ssid"] = session_id();
          }
    }

    // DB接続
    function db_connect(){
        try {
            $pdo = new PDO('mysql:dbname=dog_db;charset=utf8;host=localhost','root','root');
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。'.$e->getMessage());
        }
        return $pdo;
    }
?>