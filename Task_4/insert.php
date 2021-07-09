<?php
    // POSTデータ取得
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass= $_POST["pass"];

    if ( $email == "" || $pass == "" ){
        exit("未入力の項目があります");
    }
    else if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/", $_POST["email"])) {
        exit("メールアドレスの形式で入力してください");
    } else if ( mb_strlen( $pass ) < 8  ){
        exit("8文字以上でパスワードを設定してください");
    } else {
        // DB接続
        include("funcs.php");
        $pdo = db_connect();

        // データ登録SQL作成
        $stmt = $pdo->prepare("SELECT * FROM t_table WHERE name IN('$name')");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $status = $stmt->execute();

        if ($status==false){
            $error = $stmt->errorInfo();
            exit("ErrorQuery:".$error[2]);
        }else{
            $result = $stmt->fetch();
            if($result > 0){
                exit("登録済みのユーザー名です");
            }else{
                $random = mt_rand(1,5);
                $img = "";
                if ( $random === 1 ) {
                    $img = "img/1.jpg";
                } else if ( $random === 2 ) {
                    $img = "img/2.jpg";
                } else if ( $random === 3 ) {
                    $img = "img/3.jpg";
                } else if ( $random === 4 ) {
                    $img = "img/4.jpg";
                } else if ( $random === 5 ) {
                    $img = "img/5.jpg";
                }

                // データ登録SQL作成
                $stmt = $pdo->prepare("INSERT INTO t_table(id, name, email, pass, img, indate )VALUES(NULL, :name, :email, :pass, :img, sysdate())");
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
                $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
                $stmt->bindValue(':img', $img, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
                $status = $stmt->execute();

                // データ登録処理後
                if ($status==false) {
                    $error = $stmt->errorInfo();
                    exit("QueryError:".$error[2]);
                } else {
                    header("Location: login.php");
                    exit;
                }
            }
        }
    }
?>