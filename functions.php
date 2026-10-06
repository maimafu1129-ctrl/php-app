<?php

require_once('connection.php');
// csrf 2
// 新しいセッションを作成
session_start();

// エスケープ処理
function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// SESSIONにtokenを格納する
// csrf 3
function setToken()
{
    // 現在のセッションに紐づくデータを保持・操作するため
    // ビン・トゥ・ヘックス　オープンエスエスエル・ランダム・スード・バイツ
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}

// SESSIONに格納されたtokenのチェックを行い、SESSIONにエラー文を格納する
// csrf 8
function checkToken($token)
{

    // からの時or $tokenと一致しない場合　empty=からの時
    // csrf 9
    if (empty($_SESSION['token']) || ($_SESSION['token'] !== $token)) {
        $_SESSION['err'] = '不正な操作です';
        redirectToPostedPage();
    }
}

// csrf 13
function unsetError()
{
    // リロード、ページ移動でエラー分が表示されなくなる
    $_SESSION['err'] = '';
}

// csrf 10
function redirectToPostedPage()
{
    //リダイレクト
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// ~ 省略 ~



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
    // csrf 7
    // サーバー、ブラウザを照らし合わせるのに、データを保存する前に行う必要がある為
    checkToken($post['token']); // 追記
    validate($post);
    $path = getRefererPath();
    switch ($path) {
        case '/new.php':
            createTodoData($post['content']);
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php':
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }

}

function getRefererPath()
{
    // 連想配列
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}

function validate($post)
// 入力内容に制限機能を設定することができる
{
    // contentキーが存在しない場合
    if (isset($post['content']) && $post['content'] === '') {
        $_SESSION['err'] = '入力がありません';
        redirectToPostedPage();
    }
}
