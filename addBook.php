<?php
$date = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "yearOfRelease" => $_POST['year_of_release'],
    "genre" => $_POST['genre'],
    "cover" => $_FILES['cover']
];

$dateAuthor = [
    'author' => $_POST['author']
];

function uploadImage($image) {
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $filename = uniqid()."." . $extension;
    move_uploaded_file($image['tmp_name'], "uploadsCover/" . $filename);
    return $filename;
}

$filename = uploadimage($_FILES['cover']);

$date["cover"] = $filename;

$connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
$sql = "INSERT INTO `books` (name_book, description, year_of_release, genre, cover) VALUES (:name, :description, :yearOfRelease, :genre, :cover)";
$statment = $connect->prepare($sql);
$result = $statment->execute($date);
$bookId = $connect->lastInsertId();
echo $bookId;

$sql = "INSERT INTO `authors` (name_author) VALUES (:author)";
$statment = $connect->prepare($sql);
$result = $statment->execute($dateAuthor);
$authorId = $connect->lastInsertId();
echo $authorId;

$dateId = [
    'id_book' => $bookId,
    'id_author' => $authorId
];

$sql = "INSERT INTO `authors_and_books` (id_book, id_author) VALUES (:id_book, :id_author)";
$statment = $connect->prepare($sql);
$result = $statment->execute($dateId);
?>