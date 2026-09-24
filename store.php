<?php
// 関数を使えるように設定
require_once('functions.php');

// 全ての引数の受け渡し
savePostedData($_POST);
// 処理が終わったらindex.phpへ移動
header('Location: ./index.php');
// 処理を終了
exit;