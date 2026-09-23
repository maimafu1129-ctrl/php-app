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

    $sql = 'UPDATE todos SET content = "'
        . $post['content']
        . '" WHERE id = '
        . $post['id'];

    $dbh->query($sql);
}

// IDからTODOの内容を取得
function getTodoTextById($id)
{
    $dbh = connectPdo();

    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = ' . $id;

    $data = $dbh->query($sql)->fetch();

    return $data['content'];
}

// TODOを削除
function deleteTodoData($id)
{
    $dbh = connectPdo();

    $now = date('Y-m-d H:i:s');

    $sql = 'UPDATE todos SET deleted_at = "'
        . $now
        . '" WHERE id = '
        . $id;

    $dbh->query($sql);
}