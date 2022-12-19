<?php
$date = [
    "fullName" => $_POST['fio'],
    "login" => $_POST['login'],
    "mail" => $_POST['mail'],
    "password" => $_POST['password'],
    "avatar" => $_FILES['avatar']
];

function uploadImage($image) {
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $filename = uniqid()."." . $extension;
    move_uploaded_file($image['tmp_name'], "uploads/" . $filename);
    return $filename;
}

$filename = uploadimage($_FILES['avatar']);

$date["avatar"] = $filename;

$connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
$sql = "INSERT INTO `users` (full_name, login, email, avatar, password) VALUES (:fullName, :login, :mail, :avatar, :password)";
$statment = $connect->prepare($sql);
$result = $statment->execute($date);
?>