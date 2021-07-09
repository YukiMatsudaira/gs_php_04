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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>レシピ選択</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/select_recipe.css">
</head>

  <body>
    <div id="wrapper">

      <header>
        <ul>
          <li><a href="mypage.php"><img src="img/user_icon.png" alt="ユーザー情報"></a></li>
          <li><img src="img/favorite_icon.png" alt="お気に入り"></li>
        </ul>
      </header>

      <img class="recipe" src="<?=$row['img']?>" alt="レシピ">

      <div class="recipe_wrap">
        <ul>
          <li><img src="img/cancel_icon.png" alt="ユーザー情報"></li>
          <li><img src="img/movie_icon.png" alt="お気に入り"></li>
        </ul>
      </div>

      <footer><p>Copyright © 2021</p></footer>

    </div>
  </body>

</html>
