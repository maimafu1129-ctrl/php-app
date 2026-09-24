<?php

require_once('connection.php');

// TODO一覧を取得
function getTodoList()
{
    return getAllRecords();
}

// 選択したTODOを取得
function getSelectedTodo($id)
{
    return getTodoTextById($id);
}

// POSTされたデータを保存
function savePostedData($post)
{
    switch ($post['action']) {

        case 'create':
            createTodoData($post['content']);
            break;

        case 'update':
            updateTodoData($post);
            break;

        case 'delete':
            deleteTodoData($post['id']);
            break;

        default:
            break;
    }
}