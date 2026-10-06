<?php

require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

// 全てのTODOを取得
function getAllRecords()
{
    $dbh = connectPdo();

    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';

    return $dbh->query($sql)->fetchAll();
}

// TODOを新規作成
function createTodoData($todoText)
{
    $dbh = connectPdo();
    // プレスホルダー　仮の文字を指定している（イメージ）プレスホルダー名
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)';

    // $ステートメント SQLを使用する準備　プリペアメソッド　実行　pdoステートメント
    $stmt = $dbh->prepare($sql);
    // 仮の文字に対して入力したい文字の値をプレスホルダーにバインドする。PDO::PARAM_STR　文字列として認識させた上でバインドする。
    // 実際に入力したい値の変換方法を文字列を指定　存在しない
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR);
    var_dump(PDO::PARAM_STR);
    exit;
    // エグゼキュート 数が合わないとき
    $stmt->execute();
}

// TODOを更新
function updateTodoData($post)
{
    $dbh = connectPdo();
    // プレスホルダー（仮の値）
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    // 第一引数は、対象となる文字列（今回は :todoText ） 第二引数は、保存したい値（今回の場合は、$todoText） 第三引数は、保存したい値のデータ型を指定
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR);
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT);
    $stmt->execute();
}
// TODOを削除
// DBの更新
function deleteTodoData($id)
{
    // データベース接続情報を取得
    $dbh = connectPdo();

    // 現在の日時を取得
    $now = date('Y-m-d H:i:s');

    // todosテーブルのデータを更新する
    $sql = 'UPDATE todos SET deleted_at = :deletedAt WHERE id = :id';
    $stmt = $dbh-> prepare($sql);
    $stmt-> bindValue(':deletedAt', $now, PDO::PARAM_STR);
    $stmt-> bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt-> execute();
}

// IDからTODOの内容を取得
function getTodoTextById($id)
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = :id';
    $stmt = $dbh-> prepare($sql);
    $stmt-> bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt-> execute();
    $data = $stmt->fetch();
    return $data['content'];
}
