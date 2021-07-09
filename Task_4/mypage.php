<?php
  session_start();
  include("funcs.php");
  loginCheck();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>マイページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/mypage.css">
</head>

  <body>
    <div id="wrapper">

      <header>マイページ</header>

      <ul>
        <li><a href="edit_user.php">ユーザー情報</a></li>
        <li><a href="logout.php">ログアウト</a></li>
        <li><a href="delete.php">退会する</a></li>
      </ul>

      <footer><p>Copyright © 2021</p></footer>

    </div>
  </body>

</html>
