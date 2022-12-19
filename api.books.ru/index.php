<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');


header('Content-type: json/application');
require 'connect.php';
require 'function.php';

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$param = $params[1];
// if (isset($params[1]) && $params[1] != null && (int)$params[1] > 0) {
//     $id = $params[1];
// } else if (isset($params[1]) && $params[1] != null && (int)$params[1] == 0) {
//     $genre = $params[1];
// } else if (!isset($params[1])) {

// }

switch ($method) {
    case 'GET':
        if ($type === 'books') {
            getBooks($connect, $param);
            // if (isset($id)) {
            //     getPost($connect, $id);
            // } else if (isset($genre)) {
            //     getPostsSortGenre($connect, $genre);
            // } else {
            //     getPosts($connect);
            // }
        } else {
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Books not found"
            ];
            echo json_encode($res);
        }
        break;
        
    // case 'POST':
    //     if ($type === 'books' ) {
    //         addPost($connect, $_POST, $_FILES);
    //     }
    //     break;

    // case 'PATCH':
    //     if ($type === 'books') {
    //         if (isset($id)) {
    //             $data = file_get_contents('php://input');
    //             $data = json_decode($data, true);
    //             updatePost($connect, $data, $id);
    //         } else {
    //             http_response_code(404);
    //             $res = [
    //                 "status" => false,
    //                 "message" => "Post, which need update, not found"
    //             ];
    //             echo json_encode($res);
    //         }
    //     }
    //     break;

    case 'DELETE':
        if ($type === 'books') {
            if (isset($param) && (int)$param > 0) {
                deleteBook($connect, $param);
            } else {
                http_response_code(404);
                $res = [
                    "status" => false,
                    "message" => "Book, which need delete, not found"
                ];
                echo json_encode($res);
            }
        }
        break;
}
?>