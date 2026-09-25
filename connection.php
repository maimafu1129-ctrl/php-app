<!-- phpとMysqlを繋ぐ場所 -->
<?php
// confing.phpを読み込む　これを読み込むことでDSN、DB_USER、DB_PASSWORDが使える
require_once('config.php');

// PDOクラスのインスタンス化
// connectPdo()という関数を作る
function connectPdo()
{
    // tryでDB接続を試す
    try {
        // PDOというphpに用意されているクラスを使って、DBに接続している
        // 作ったPDOインスタンスを呼び出し元に返す
        return new PDO(DSN, DB_USER, DB_PASSWORD);
        // DB接続でエラーが起きた時場合、こちらに来る　エラー内容を表示　＄eはエラー情報　getMessage()でエラーメッセージを取得
    } catch (PDOException $e) {
        // getMessage
        // echo $e->getMessage();
        var_dump($e->getMessage());
        exit;
        // 処理を終了
        exit();
    }
}

// 全てのTODOを取得　引数はなし
function getAllRecords()
{
    // DBと通信するためのPDOインスタンス
    $dbh = connectPdo();

    // SQLを作成　todosテーブルから全部の列を取得する。ただし deleted_at が NULL のものだけ
    // 削除せれていないTODOだけを取得
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';

    // : データベース接続を表すPDOオブジェクト（$dbh）を使って、
    // SQL文（$sql）を直接実行します。->fetchAll(): 実行結果として得られた
    // 結果セットから、すべての行を配列にして取得します。
    return $dbh->query($sql)->fetchAll();
}

// TODOを新規作成
function createTodoData($todoText)

{
    // DB接続
    $dbh = connectPdo();

    // INSERT文
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';

    // SQLを実行
    $dbh->query($sql);

}
// 米山のみ
// TODOを更新
function updateTodoData($post)
{
    $dbh = connectPdo();

    $sql = 'UPDATE todos SET content = "'
        . $post['content']
        . '" WHERE id = '
        . $post['id'];

    $dbh->query($sql);
}

// 指定されたIDからTODOの内容を取得
function getTodoTextById($id)
{
    $dbh = connectPdo();

    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = ' . $id;

    // SQLを実行して１件を取得する
    $data = $dbh->query($sql)->fetch();

    // TODOの内容だけを呼び出し元に返す
    return $data['content'];
}

// TODOを削除
function deleteTodoData($id)
{
    // DB接続
    $dbh = connectPdo();

    // 現在日時を取得
    $now = date('Y-m-d H:i:s');

    $sql = 'UPDATE todos SET deleted_at = "'
        . $now
        . '" WHERE id = '
        . $id;

        // sql実行　これで削除日時が入る
    $dbh->query($sql);
}