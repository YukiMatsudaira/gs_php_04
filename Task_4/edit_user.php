<?php
  session_start();
  include("funcs.php");
  loginCheck();

  try {
      $pdo = new PDO('mysql:dbname=dog_db;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
  }

  $id = $_SESSION["id"];
  
  $sql = "SELECT * FROM t_table WHERE id=:id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT); //idは数値なのでINT
  $status = $stmt->execute();

  $view="";
  if ($status==false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  } else {
    $row = $stmt->fetch();
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="wrapper">

    <header>わんこ飯</header>

    <!-- ここからinsert.phpにデータを送る -->
    <form method="post" action="update.php">
      <div class="jumbotron">
        <label>ユーザー名：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
        <label>Email 　　：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
        <label>パスワード：<input type="text" name="pass" value="<?=$row["pass"]?>"></label>
        <p>パスワードは8文字以上で設定してください</p>
        <input type='hidden' name="id" value="<?=$row["id"]?>">
        <input class="btn" type="submit" value="登録">
      </div>
    </form>

    <img src="img/buhi.png" alt="フレンチブルドッグ">

    <footer><p>Copyright © 2021</p></footer>

  </div>
</body>

</html>
