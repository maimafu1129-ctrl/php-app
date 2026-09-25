<?php
// エラー表示設定　エラーを画面に表示する、１はON！
ini_set('display_errors', 1); 
// phpが起動する時にも発生するエラー表示
ini_set('display_startup_errors', 1);
// phpのエラーを幅広く報告する設定
error_reporting(E_ALL);
// phpでエラーが起きた時、自分で作ったerrorHandlerという関数を使って処理する
set_error_handler('errorHandler');
// ４つの引数を受け取っている　エラー番号、エラー内容、エラーが発生したファイル、エラーが発生した番号
function errorHandler($errNo, $errStr, $errFile, $errLine)
{
   var_dump($errNo);
   exit; 
    // もしエラー番号がNOTICEまたはWARNINGっだったら
    if ($errNo === E_NOTICE || $errNo === E_WARNING) {
        // 三項演算子　$errNo が E_NOTICE なら$errTitle = 'Notice'そうでなければ$errTitle = 'Warning'！
        $errTitle = $errNo === E_NOTICE ? 'Notice' : 'Warning';

        // エラー内容をHTMLとして安全に表示できる形
        $escapedErrStr = htmlspecialchars($errStr);
        // ファイル名も同じように安全な表示にする
        $escapedErrFile = htmlspecialchars($errFile);

        // 画面に文字を表示　'</b>: 'の意味！
        echo '<b>' . $errTitle . '</b>: '
        // エラー内容をつなげる
            . $escapedErrStr
            // ファイル名をつなげる
            . ' in <b>' . $escapedErrFile . '</b>'
            // 何行目でエラーが発生したかをつなげる
            . ' on line <b>' . $errLine . '</b>';


            // そこでphpの処理を終了する
        exit;
    }

    // 条件に該当しなかった場合はFalseで返す
    return false;
}
// DB設定　phpからDBをつなげる
// define定数を作成　DSNという名前、データベース名　php＿lesson、ホスト→localhost、MySQLのソケット → /tmp/mysql.sock
define('DSN', 'mysql:dbname=php_lesson;host=localhost;unix_socket=/tmp/mysql.sock');
// DBユーザー名
define('DB_USER', 'root');
// DBパスワード
define('DB_PASSWORD', 'mmmgiz1228');


?>