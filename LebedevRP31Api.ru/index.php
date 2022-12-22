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
if (isset($params[1]) && $params[1] != null) {
    $id = $params[1];
}

switch ($method) {
    case 'GET':
        if ($type === 'posts') {
            if (isset($id)) {
                getPost($connect, $id);
            } else {
                getPosts($connect);
            }
        }
        break;
        
    case 'POST':
        if ($type === 'posts') {
            addPost($connect, $_POST);
        }
        break;

    case 'PATCH':
        if ($type === 'posts') {
            if (isset($id)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                updatePost($connect, $data, $id);
            } else {
                http_response_code(404);
                $res = [
                    "status" => false,
                    "message" => "Post, which need update, not found"
                ];
                echo json_encode($res);
            }
        }
        break;

    case 'DELETE':
        if ($type === 'posts') {
            if (isset($id)) {
                deletePost($connect, $id);
            } else {
                http_response_code(404);
                $res = [
                    "status" => false,
                    "message" => "Post, which need delete, not found"
                ];
                echo json_encode($res);
            }
        }
        break;
}
?>