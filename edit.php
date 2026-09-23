<?php

require_once('functions.php');

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

    <input
      type="hidden"
      name="action"
      value="update"
    >

    <input
      type="hidden"
      name="id"
      value="<?= $_GET['id']; ?>"
    >

    <input
      type="text"
      name="content"
      value="<?= htmlspecialchars($todo); ?>"
    >

    <input
      type="submit"
      value="更新"
    >

  </form>

  <div>
    <a href="index.php">
      一覧へもどる
    </a>
  </div>

</body>

</html>