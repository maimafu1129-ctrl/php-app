<?php

require_once('functions.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>

<body>

  <h1>TODO一覧</h1>

  <div>
    <a href="new.php">新規作成</a>
  </div>

  <br>

  <div>
    <table>

      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>

      <?php foreach (getTodoList() as $todo): ?>

        <tr>

          <td>
            <?= $todo['id']; ?>
          </td>

          <td>
            <?= htmlspecialchars($todo['content']); ?>
          </td>

          <td>
            <a href="edit.php?id=<?= $todo['id']; ?>">
              編集
            </a>
          </td>

          <td>
            <form action="store.php" method="post">

              <input
                type="hidden"
                name="action"
                value="delete"
              >

              <input
                type="hidden"
                name="id"
                value="<?= $todo['id']; ?>"
              >

              <button type="submit">
                削除
              </button>

            </form>
          </td>

        </tr>

      <?php endforeach; ?>

    </table>
  </div>

</body>

</html>