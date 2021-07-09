<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="wrapper">

    <header>わんこ飯</header>

    <!-- ここからinsert.phpにデータを送る -->
    <form method="post" action="insert.php">
      <div class="jumbotron">
        <label>ユーザー名：<input type="text" name="name"></label><br>
        <label>Email 　　：<input type="text" name="email"></label><br>
        <label>パスワード：<input type="text" name="pass"></label>
        <p>パスワードは8文字以上で設定してください</p>
        <input class="btn" type="submit" value="登録">
      </div>
    </form>

    <img src="img/buhi.png" alt="フレンチブルドッグ">

    <footer><p>Copyright © 2021</p></footer>

  </div>
</body>

</html>
