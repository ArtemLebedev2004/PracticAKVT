<?php
// function uploadImage($image) {
//     $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
//     $filename = uniqid() . '.' . $extension;
//     move_uploaded_file($image['tmp_name'], "uploads/" . $filename);
//     echo "egweg";
//     return $filename;
// }

function addPost($title, $body) {
    $pdo = new PDO('mysql:host=localhost; dbname=api_tester', 'root', '');
    $sql = "INSERT INTO `posts` (title, body) VALUES (:title, :body)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":title", $title);
    $statement->bindParam(":body", $body);
    $statement->execute();
}

function getPost() {
    $pdo = new PDO('mysql:host=localhost; dbname=api_tester', 'root', '');
    $sql = "SELECT * FROM `posts`";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
?>