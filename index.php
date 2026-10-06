<?php
// csrf 1 
// リクワイヤーワンス
require_once('functions.php');
header('Set-Cookie: userId=123');
// csrf 4
setToken();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>

<body>
  <!--  csrf 11 -->
<?php if (!empty($_SESSION['err'])): ?> 
    <p><?= $_SESSION['err']; ?></p> 
  <?php endif; ?> 
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

          <td><?= e($todo['id']); ?></td>
          <td><?= e($todo['content']); ?></td>

          <td>
            <!-- ？はここから情報の追加 -->
             <a href="edit.php?id=<?= e($todo['id']); ?>">更新</a>
          </td>

          <td>
            <form action="store.php" method="post">

              <input type="hidden" name="id" value="<?= e($todo['id']); ?>">
              <!--  csrf 5 -->
              <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>"> 
              <button type="submit">削除</button>

            </form>
          </td>

        </tr>

      <?php endforeach; ?>

    </table>
  </div>

   <!-- csrf 12 -->
  <?php unsetError(); ?>
</body>

</html>