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

    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';

    $dbh->query($sql);
}

// TODOを更新
function updateTodoData($post)
{
    $dbh = connectPdo();

    // todosテーブルのcontentを更新するSQL文の最初の部分
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    // $postという連想配列から、contentというキーの値を取り出して、SQL文につなげる

        // $sqlに入っているSQL文をデータベースに送って実行する
    $dbh->query($sql);
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
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = ' . $id;
        // todosテーブルの中から、idが$idと一致するレコードだけを対象にする
    $dbh->query($sql);
}

// IDからTODOの内容を取得
function getTodoTextById($id)
{
    $dbh = connectPdo();

    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = ' . $id;

    $data = $dbh->query($sql)->fetch();

    // 返り値
    return $data['content'];
}
