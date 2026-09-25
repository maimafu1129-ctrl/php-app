<!-- 新規作成画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>

<body>

  <h1>新規作成</h1>
<!-- フォームを送信するとstore.phpにPOSTする -->
 <!-- 方法の記述なので型とうの説明はなし -->
  <form action="store.php" method="post">

    <input
      type="hidden"

    >
<!-- ユーザーが登録する場所 -->
    <input
      type="text"
      name="test"
    >
<!-- 作成ボタン -->
    <input
      type="submit"
      value="作成"
    >

  </form>

  <div>
    <a href="index.php">
      一覧へもどる
    </a>
  </div>

</body>

</html>