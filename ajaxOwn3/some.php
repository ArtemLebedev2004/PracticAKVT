<?php
$data = [
    "title" => $_POST['title'],
    "content" => $_POST['content']
];

$connect = new PDO('mysql:host=localhost; dbname=api_tester', 'root', '');
$sql = "INSERT INTO `posts` (title, body) VALUES (:title, :content)";
$statement = $connect->prepare($sql);
$result = $statement->execute($data);
?>