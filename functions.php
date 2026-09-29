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
    $path = getRefererPath();
    switch ($path) {
        case '/new.php':
            createTodoData($post['content']);
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php': // 追記
            deleteTodoData($post['id']); // 追記
            break; // 追記
        default:
            break;
    }
}

function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}