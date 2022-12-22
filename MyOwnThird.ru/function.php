<?php
function getPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM `posts`");
    $postList = [];

    while ($post = mysqli_fetch_assoc($posts)) {
        $postList[] = $post;
    }

    echo json_encode($postList);
}

function getPost($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$id'");
    if (mysqli_num_rows($post) == 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Post not found"
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function addPost($connect, $data) {
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "INSERT INTO `posts` (`title`, `body`) VALUES ('$title', '$body')");
    http_response_code(201);
    $res = [
        "status" => true,
        "message" => "Post was added",
        "id" => mysqli_insert_id($connect)
    ];

    echo json_encode($res);
}

function updatePost($connect, $data, $id) {
    $title = $data['title'];
    $body = $data['body'];

    $post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$id'");
    if (mysqli_num_rows($post) == 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Post, which need update, not found"
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, "UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `posts`.`id` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => "Post was updated"
        ];

        echo json_encode($res);
        getPost($connect, $id);
    }
}

function deletePost($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$id'");
    if (mysqli_num_rows($post) == 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Post, which need delete, not found"
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, "DELETE FROM posts WHERE `posts`.`id` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => "Post was deleted"
        ];

        echo json_encode($res);
    }
}
?>