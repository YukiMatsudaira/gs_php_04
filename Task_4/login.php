<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="wrapper">

    <header>わんこ飯</header>
    
    <!-- ここからinsert.phpにデータを送る -->
    <form method="post" action="login_act.php">
      <div class="jumbotron">
        <label>ユーザー名：<input type="text" name="name"></label><br>
        <label>パスワード：<input type="text" name="pass"></label><br>
        <input class="btn" type="submit" value="ログイン">
      </div>
    </form>

    <a class="navbar-brand" href="new.php">新規登録がまだの方</a>

    <img src="img/buhi.png" alt="フレンチブルドッグ">

    <footer><p>Copyright © 2021</p></footer>

  </div>
</body>

</html>
