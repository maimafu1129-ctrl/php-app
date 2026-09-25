<!-- connection.phpにある処理を呼び出して、アプリ側から使いやすくする場所 -->
<?php
// connection.phpを読み込む　これでconnection.phpで設定した関数を使える
require_once('connection.php');

// TODO一覧を取得
// getTodoList() が呼ばれたら、getAllRecords()を呼びます。そして、その結果を返します。
// index.php ->getTodoList()->getAllRecords()->MySQL->TODO一覧

// getSelectedTodo(3)-> $id = 3 ->getTodoTextById(3)-> $id = 3->DBからID 3を取得
function getTodoList()
{
    return getAllRecords();
}

function createData($post)
{

    createTodoData($post['test']);  // ここを追記

}
// 選択したTODOを取得
function getSelectedTodo($id)
{
    return getTodoTextById($id);
}


// POSTされたデータを保存
// store.php からPOSTデータを受け取ります。 例$post の中身は、$post = [ 'action' => 'update','id' => '3','content' => 'PHPを勉強する'];
// 米山のみ
// function savePostedData($post)
// {
//     // action の値によって処理を変えます。例えば、create → 新規作成　update → 更新　delete → 削除
//     switch ($post['action']) {

//         case 'create':
//             createTodoData($post['content']);
//             break;

//         case 'update':
//             updateTodoData($post);
//             break;

//         case 'delete':
//             deleteTodoData($post['id']);
//             break;

//         default:
//             break;
//     }
// }