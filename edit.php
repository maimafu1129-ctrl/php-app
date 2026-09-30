<!-- すでに登録されているデータの編集 -->
 <!-- 米山のみ -->
<?php
// 関数を読み取り
require_once('functions.php');
// URLのGETパラメーター
// $_GET スパーグローバル変数（）定義済み変数
// IDなどを指定してページを表示
// var_dump($_GET);
// exit;
$todo = getSelectedTodo($_GET['id']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>

<body>

  <h1>編集</h1>

  <form action="store.php" method="post">

    <input type="hidden" name="action" value="update">
<!-- データを取得するために記載が必要 -->

    <!-- 編集 -->
    <input type="hidden" name="id" value="<?= e($_GET['id']); ?>"> 
    <input type="text" name="content" value="<?= e($todo); ?>"> 
      

    <input type="submit" value="更新" >

  </form>

  <div>
    <a href="index.php">
      一覧へもどる
    </a>
  </div>

</body>

</html>