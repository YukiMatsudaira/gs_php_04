<?php
    session_start();
    include("funcs.php");
    loginCheck();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $id = $_POST["id"];

    if ( $name == "" || $email == "" || $pass == "" ){
        exit("未入力の項目があります");
    } else if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/", $_POST["email"])) {
        exit("メールアドレスの形式で入力してください");
    } else if ( mb_strlen( $pass ) < 8  ){
        exit("8文字以上でパスワードを設定してください");
    } else {
        // DB接続
        try {
            $pdo = new PDO('mysql:dbname=dog_db;charset=utf8;host=localhost','root','root');
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。'.$e->getMessage());
        }

        // データ登録SQL作成
        $stmt = $pdo->prepare("SELECT * FROM t_table WHERE name IN('$name')");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $status = $stmt->execute();

        if ($status==false){
            $error = $stmt->errorInfo();
            exit("ErrorQuery:".$error[2]);
        }else{
            $result = $stmt->fetch();
            if($result > 0 && $name != $_SESSION["name"] ){
                exit("登録済みのユーザー名です");
            } else{
                $stmt = $pdo->prepare("UPDATE t_table SET name=:name, email=:email, pass=:pass WHERE id=:id");
                $stmt->bindValue(':name', $name, PDO::PARAM_STR); 
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $status = $stmt->execute();

                if ($status==false) {
                    $error = $stmt->errorInfo();
                    exit("QueryError:".$error[2]);
                } else {
                    $_SESSION["name"] = $name;
                    header("Location: mypage.php");
                    exit;
                }
            }
        }
    }
?>